<?php
	
	//同步卡市的数据
	function setCardMarket($where,$sum)
	{
		$table = D('card_market');
		$check = $table->where($where)->count();
		
		if($check > 0)
		{
			$remain = $table->where($where)->select()[0]['card_remain'];
			$set['card_remain'] = redAsDouble($remain,$sum);
			saveWithCheck($table,$where,$set);
		}
	}

	//计算广告费用
	function advertPay($type,$table,$para)
	{
		return 20;
	}


	//同步IM账号
	function setImAccount($account,$type,$para)
	{
		$table = D('im_account');
		$where['account'] = $account;
		$set[$type] = $para;
		saveWithCheck($table,$where,$set);
	}

	//处理送积分
	function handleAward($uuid,$type)
	{
		$table = D('user');
		$where['uuid'] = $uuid;
		$check = $table->where($where)->select()[0][$type];
		$flag = "false";		

		//logIn($uuid.$type.$check);
		if($check == '未设置')
		{
			$flag = "20";
			addIntegral($uuid,'完善信息送积分','complete');
		}

		return $flag;

	
	}

	//送积分
	function addIntegral($uuid,$tip,$type,$para = '1')
	{
		$sum = D('integral_scale')->select()[0][$type];
		$sum = multiAsInt($sum,$para);

		//增加积分
		$user = M('user');
                $where['uuid'] = $uuid;
                $data = $user->where($where)->select();
                $remain = $data[0]['integral'];

                $newRemain = addAsInt($remain,$sum);

                $set['integral'] = $newRemain;
                $user->where($where)->save($set);


		//添加积分记录
                $datetime = currentTime();
                $record = array(
                        'uuid' => $uuid, 'type' => $tip, 'integral' => $sum, 'datetime' => $datetime
                );
                addWithCheck(D('mall_consume'),$record);

		
	}
	
	//获取平台参数
        function getSystemPara($date,$type)
        {
		$table = D($type);
                $where["date"] = array("elt",$date);
                $info = $table
                ->where($where)
                ->order('date desc')
                ->select();
                return $info[0];
        }

	//获取用户分类条件参数
	function getUserClassifyPara($date)
        {
                $table = D("user_classify");
                $where["date"] = array("elt",$date);

		$where["level"] = "VIP";
                $info["vip"] = $table
                ->where($where)
                ->order('date desc')
                ->select()[0];

		$where["level"] = "SVIP";
                $info["svip"] = $table
                ->where($where)
                ->order('date desc')
                ->select()[0];		

                return $info;
        }

	//处理红包
	function setRedPacket($uuid,$sum)
	{
		$table = D("red_packet");
		$where['user'] = $uuid;
		$check = $table->where($where)->count();
		if( $check > 0 )
		{
			$remain = $table->where($where)->select()[0]['sum'];
			$set['sum'] = addAsInt($remain,$sum);
			$table->where($where)->save($set); 
		}
		else
		{
			$record = array( 'user' => $uuid, 'sum' => $sum );
			$table->add($record);
		}
		
	}

	//更新推荐收入
	function setReferrerSum($recommend,$type,$sum)
	{
		$table = D("referrer");
                $where['recommend'] = $recommend;
		$where['type'] = $type;
		
		$check = $table->where($where)->count();
		if( $check > 0 )
		{
				
                	$info = $table->where($where)->select();
			$remain = $info[0]['sum'];
			$referrer = $info[0]['referrer'];
                	$set['sum'] = addAsDouble($remain,$sum);
                	$table->where($where)->save($set);
		}
                
	}


	//获取奖励百分比
	function getPercent($referrer)
	{
		//获取推荐人信息：注册日期，身份级别
                $user = D('user');
                $where_u['uuid'] = $referrer;
                $info = $user->where($where_u)->select();
                $datetime = $info[0]['datetime'];
                $user_level = $info[0]['user_level'];

                switch($user_level)
                {
                	case "ORD":
                        	$tb = "reward_ord";
                                break;
                        case "VIP":
                                $tb = "reward_vip";
                                break;
                        case "SVIP":
                                $tb = "reward_svip";
                                break;
                        default:
                                return 0;
                }

                $info = getSystemPara($datetime,$tb);
                $percent['user'] = $info['user_sum'];
                $percent['merchant'] = $info['merchant_sum'];
		return $percent;
                
	}

	//添加收入记录
	function setIncomeRecord($record)
	{
		$table = D("record_income");
		$table->add($record);
	}

	//检测用户级别
	function checkUserLevel($uuid)
	{
		$table = D("referrer");
		$where["referrer"] = $uuid;
		$where["type"] = 'u';
		$unum = $table->where($where)->count();
		$where["type"] = "m";
		$mnum = $table->where($where)->count();		

		$user = D("user");
		$whereu["uuid"] = $uuid;
		$datetime = $user->where($whereu)->select()[0]['datetime']; //用户注册时间
		$user_level = $user->where($whereu)->select()[0]['user_level']; //用户当前级别		

		$ct = currentTime();//当前时间

		$check = getUserClassifyPara($datetime);
			
		$vip_unum = $check['vip']['user_num'];
		$vip_mnum = $check['vip']['merchant_num'];
		$svip_unum = $check['svip']['user_num'];
                $svip_mnum = $check['svip']['merchant_num'];

		if( $unum == intval($vip_unum) and $mnum == intval($vip_mnum) )
		{
			//设置用户级别
			$set['user_level'] = 'VIP';
			$user->where($whereu)->save($set);
			//赠送VIP红包奖励
			$sum = getSystemPara($datetime,"reward_vip")['vip_reward'];
			setRedPacket($uuid,$sum);
			//设置升级奖励记录
			$record = array('datetime' => $ct,'tip' => 'VIP用户奖励','sum' => $sum, 'type' => 'u','id' => $uuid);
			setIncomeRecord($record);
			
		}
		
		if(  $mnum == intval($svip_mnum) and $user_level != "SVIP")
		{
			//设置用户级别
                        $set['user_level'] = 'SVIP';
                        $user->where($whereu)->save($set);
                        //赠送VIP红包奖励
                        $sum = getSystemPara($datetime,"reward_svip")['svip_reward'];
                        setRedPacket($uuid,$sum);
                        //设置升级奖励记录
                        $record = array('datetime' => $ct,'tip' => 'SVIP用户奖励','sum' => $sum, 'type' => 'u','id' => $uuid);
                        setIncomeRecord($record);
		}

		

	}
	
	

	//添加代金券
	function addVoucher($uuid)
	{
                $type = array(
                        "10元",
                        "20元",
                        "50元",
                        "100元",
                        );
                $deadline = array(
                        date("Y-m-d",strtotime("+1 month")),
                        date("Y-m-d",strtotime("+1 month +15 day")),
                        date("Y-m-d",strtotime("+2 month")),
                        date("Y-m-d",strtotime("+2 month")),
                        );

                $num = array(
                        "5",
                        "5",
                        "5",
                        "1",
                        );

                $voucher = M('user_voucher');
                for($i = 0; $i < 4; $i++)
                {
                        $ptype = $type[$i];
                        $pdeadline = $deadline[$i];
                        $pnum = $num[$i];

                        $record_v = array(
                                'user' => $uuid,'type' => $ptype, 'deadline' => $pdeadline,
                                'num' => $pnum
                        );
                        $voucher->add($record_v);

                }
	}	

	//获取展示页店铺信息
	function showDataGet($where,$page)
	{
		$merchant = D('merchant');
		$data = $merchant
		->field('muid,phone,store,image_url,longtitude,latitude')
		->where($where)
		->page($page)
		->select();

		for( $i = 0; $i < count($data); $i++)
		{
			$muid = $data[$i]['muid'];
			
			//获取评星
			$evaluate = D('evaluate');
			$where_s['merchant'] = $muid;

			$count = $evaluate->where($where_s)->count();
			$sum = $evaluate->where($where_s)->sum('stars');
			$stars = addAsInt($sum,'5') / ($count + 1) ;
			
			//$data[$i]['stars'] = $evaluate->where($where_s)->avg('stars');

			$data[$i]['stars'] = $stars;			

			//获取办卡数量
			$card = D('user_card');
			$where_c['merchant'] = $muid;
			$data[$i]['sold'] = $card->where($where_c)->count();

			//获取最低折扣率
			$card = D('merchant_card');
			$where_c['type'] = '储值卡';
			$data[$i]['discount'] = $card->where($where_c)->min('rule');
			
			//获取最大赠送额
			$data[$i]['add'] = $card->where($where_c)->max('addition_sum');

			//是否包含优惠券
			$table = D('merchant_coupon');
			$where_cc['muid'] = $muid;
			$where_cc['state'] = 'true';
			$check = $table->where($where_cc)->count();
			if($check > 0)
			{
				$data[$i]['coupon'] = 'yes';
			}
			else
			{
				$data[$i]['coupon'] = 'no';
			}
			
			//是否上传视频
			$table = D('merchant_video');
			$where_v['merchant'] = $muid;
			$where_v['state'] = 'true';
			$check = $table->where($where_v)->select();		
			if(count($check) > 0)
			{
				$data[$i]['video'] = $check[0]['video'];
			}
			else
			{
				$data[$i]['video'] = 'null';
			}
		}

		return $data;
		
	}

		
	function storeDataGet($muid)
	{
		$merchant = D('merchant');
		$where['muid'] = $muid;
                $result = $merchant
                ->field('muid,phone,store,image_url,address,longtitude,latitude,store_number')
                ->where($where)
                ->select();

		$data['muid'] = $result[0]['muid'];
		$data['phone'] = $result[0]['phone'];
 		$data['image_url'] = $result[0]['image_url'];
 		$data['address'] = $result[0]['address'];
 		$data['longtitude'] = $result[0]['longtitude'];
 		$data['latitude'] = $result[0]['latitude'];
 		$data['store'] = $result[0]['store'];
		$data['store_number'] = $result[0]['store_number'];

		$where_s['merchant'] = $muid;

                //获取评星
		$evaluate = D('evaluate');
		$where_s['merchant'] = $muid;

		$count = $evaluate->where($where_s)->count();
		$sum = $evaluate->where($where_s)->sum('stars');
		$stars = addAsInt($sum,'5') / ($count + 1) ;

		$data['stars'] = $stars;

		//获取评论数量
		$data['evaluate_num'] = $evaluate->where($where_s)->count();

		//获取评论数据
                $data['evaluate_list'] = $evaluate
		->join('cn_user on cn_user.uuid = cn_evaluate.user')
		->field('cn_evaluate.*,nickname,headImage')
		->where($where_s)
		->order('cn_evaluate.datetime desc')
		->page('1,2')
		->select();

                //获取办卡数量
                $card = D('user_card');
                $data['sold'] = $card->where($where_s)->count();
		
		//获取会员卡列表
                $card = D('merchant_card');
		$where_mc['merchant'] = $muid;
		$where_mc['state'] = 'true';
		$where_mc['display_state'] = 'on';
                $data['card_list'] = $card->where($where_mc)->select();

		//获取商品列表
		$commodity = D('commodity');
		$data['commodity_list'] = $commodity->where($where_s)->select();
		
		//获取商家详情
		$info = D('merchant_info');
		$result = $info->where($where_s)->select();
		$data['intro'] = $result[0]['intro'];		
		$data['time'] = $result[0]['time'];
		$data['notice'] = $result[0]['notice'];
		$data['server'] = $result[0]['server'];

		return $data;
		
                
	}

	//处理推荐产生的费用
	function handleReferrer($user,$merchant,$sum)
        {
                //处理用户的推荐费用
		//setReferrer($user,'u',$sum);
		//处理相关商户的推荐费用
		setReferrer($merchant,'m',$sum);
        }



	//处理推荐人的费用
	function setReferrer($recommend,$type,$sum)
        {
               	$referrer = M('referrer');
	       	$where['recommend'] = $recommend;
	       	$where['type'] = $type;
		$check1 = $referrer->where($where)->count();
		
		//处理一级推荐人的费用
		if($check1 > 0)
		{
			//设置推荐人列表的推荐费用
			$data1 = $referrer->where($where)->field('sum,referrer')->select();
			$remain1 = $data1[0]['sum'];
			$referrer1 = $data1[0]['referrer'];
			$newRemain = addAsDouble($remain1,$sum)."元";
			$set1['sum'] = $newRemain;
			$referrer->where($where)->save($set1);

			//实时设置一级推荐人的余额
			setRemain($referrer1,doubleval($sum)*0.01);
				
		}

		$where2['recommend'] = $referrer1;
                $where2['type'] = 'u';
                $check2 = $referrer->where($where2)->count();

		//设置二级推荐人费用
		if($check2 > 0)
		{
			//设置二级推荐人列表的推荐费用
                        $data1 = $referrer->where($where2)->field('sum')->select();
                        $remain1 = $data1[0]['sum'];
                        $newRemain = addAsDouble($remain1,doubleval($sum)*0.01)."元";
                        $set1['sum'] = $newRemain;
                        $referrer->where($where2)->save($set1);
			

			//实时设置二级推荐人的余额
			$data2 = $referrer->where($where2)->field('referrer')->select();
			$referrer2 = $data2[0]['referrer'];
			setRemain($referrer2,doubleval($sum)*0.0005);
		}
		


	
      	}

	

	//实时设置推荐人余额
	function setRemain($referrer,$sum)
	{
		$user = M('user');
                $where['uuid'] = $referrer;
                $data = $user->where($where)->field('remain')->select();
                $remain = $data[0]['remain'];
                $newRemain = addAsDouble($remain,$sum)."元";
                $set['remain'] = $newRemain;
                $user->where($where)->save($set);
	
	}

	//更新商户的营业额
	function setTurnover($merchant,$sum)
	{
		$turnover = M('merchant_turnover');
		$where['merchant'] = $merchant;
		$check = $turnover->where($where)->count();
		if($check > 0)
		{
			$data = $turnover->where($where)->select();
			$remain = $data[0]['sum'];
			$newRemain = addAsDouble($remain,$sum);
			$set['sum'] = $newRemain;
			$turnover->where($where)->save($set);
		}
		else
		{
			$record = array(
				'merchant' => $merchant,'sum' => $sum
			);
			$turnover->add($record);
		}
			
		$merchant_info = M('merchant');
		$where_i['muid'] = $merchant;
		$data = $merchant_info->where($where_i)->select();
		$remain = $data[0]['remain'];
		$new_remain = addAsDouble($remain,$sum)."元";
		$set['remain'] = $new_remain;
		$merchant_info->where($where_i)->save($set);

	}

	//获取其他信息
	function getExtra($merchant,$code,$level)
	{
		$card = M('merchant_card');
		$where['merchant'] = $merchant;
		$where['code'] = $code;
		$where['level'] = $level;

		$data = $card->where($where)->select();
		return $data;
	}
	
	//设置商户余额
	function setMerchantRemain($muid,$sum)
	{
		$merchant = M('merchant');
		$where['muid'] = $muid;
		$data = $merchant->where($where)->select();
		$remain = $data[0]['remain'];
		
		$newRemain = addAsDouble($remain,$sum)."元";
		$set['remain'] = $newRemain;
		$merchant->where($where)->save($set);
		
	}

	//处理积分
	function setIntegral($uuid,$sum)
	{
	
		//logInfo('user:: '.$user);
		//logInfo('sum:: '.$sum);
		$user = M('user');
		$where['uuid'] = $uuid;
                $data = $user->where($where)->select();
                $remain = $data[0]['integral'];
		
		$int_sum = intval($sum)/10;
	
		//logInfo('int_sum:: '.$int_sum);
		
		
		$newRemain = addAsInt($remain,$int_sum);

		//logInfo('newSum:: '.$newRemain);
		$set['integral'] = $newRemain;
		$user->where($where)->save($set);

	}

