<?php
	function ajaxRe($status,$tip,$url)
	{
		$result = array(
			'status' => $status, 'tip' => $tip, 'url' => $url
		);
		echo json_encode($result);
	}

	function getImageSrc( $type , $name )
	{
		$dir = "/var/www/html/cnconsum/Public/Uploads/";
		$url = "http://101.201.100.191/cnconsum/Public/Uploads/";

		$src = $dir.$type."/".$name.".png";
		$curl = $url.$type."/".$name.".png";
	
                if( file_exists( $src ) )
                {
			return $curl."?".rand(0,10000);
                }
		else
		{
			return "http://101.201.100.191/cnconsum/Public/image/upbg.png";
		}
	}
	
	function getFormatAdd( $address )
	{
		$str = '市辖区';
                $check = strpos($address,$str);

                if($check == false)
                {
                        $add['province'] = explode('省',$address)[0]."省";
                        $extra = explode('省',$address)[1];
                        $add['city'] = explode('市',$extra)[0]."市";
                        $extra = explode('市',$extra)[1];
                        $add['district'] = explode('区',$extra)[0]."区";
                        $add['location'] = explode('区',$extra)[1];
                }
                else
                {
                        $add['province'] = explode('市辖区',$address)[0];
                        $extra = explode('市辖区',$address)[1];
                        $add['district'] = explode('区',$extra)[0]."区";
                        $add['location'] = explode('区',$extra)[1];
                        $add['city'] = '市辖区';
                }
		
		return $add;

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
		
		if(  $mnum == intval($svip_mnum) )
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


?>
