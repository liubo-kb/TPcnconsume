<?php
namespace App\Controller\Extra;
use Think\Controller;
class DrawController extends Controller 
{
	
	function get_rand($proArr)
        {
                $result = '';
                //概率数组的总概率精度
                $proSum = array_sum($proArr);
                //概率数组循环
                foreach ($proArr as $key => $proCur)
                {
                        $randNum = mt_rand(1, $proSum);
                        if ($randNum <= $proCur)
                        {
                                $result = $key;
                                break;
                        }
                        else
                        {
                                $proSum -= $proCur;
                        }
                }
                unset ($proArr);
                return $result;
        }


	function index()
	{
		$uuid = post('uuid');

		//logIn("draw_uuid:".$uuid);		

        	$prize_arr = array(
                	'0' => array( 'id' => 0, 'angle' => '0', 'prize' => '再来一次', 'v' => 1 ),
                	'1' => array( 'id' => 1, 'angle' => '45', 'prize' => '相机一部', 'v' => 1 ),
                	'2' => array( 'id' => 2, 'angle' => '90', 'prize' => 'iphone6s一部', 'v' => 20 ),
                	'3' => array( 'id' => 3, 'angle' => '135', 'prize' => '￥50元代金券', 'v' => 15 ),
                	'4' => array( 'id' => 4, 'angle' => '180', 'prize' => '耳机一部', 'v' => 15 ),
                	'5' => array( 'id' => 5, 'angle' => '225', 'prize' => '￥30元代金券', 'v' => 43 ),
                	'6' => array( 'id' => 6, 'angle' => '270', 'prize' => '手表一块', 'v' => 1 ),
                	'7' => array( 'id' => 7, 'angle' => '315', 'prize' => '咖啡机一台', 'v' => 1 ),
        	);

        	foreach ($prize_arr as $key => $val)
        	{
                	$arr[$val['id']] = $val['v'];
        	}

        	$rid = $this->get_rand($arr); //根据概率获取奖项id
		
        	$res['result'] = $prize_arr[$rid]; //中奖项
	
		//添加中奖纪录
		$record = array(
			'uuid' => $uuid, 'prize' => $prize_arr[$rid]['prize'], 'datetime' => currentTime()
		);
		$table = D('mall_win');
		addWithCheck($table,$record);

		/*修改积分余额*/
                $table = D('user');
                $where['uuid'] = $uuid;
                $integral = $table->where($where)->select()[0]['integral'];
                $set['integral'] = redAsInt($integral,'20');
		$res['remain'] = $set['integral'];
                $table->where($where)->save($set);

                /*记录积分明细*/
                $content = "积分抽奖";
                $table = D('mall_consume');
                $record = array(
                        'uuid' => $uuid, 'type' => $content, 'integral' => "-20", 'datetime' => currentTime()
                );
		$table->add($record);
	
			
		
		$res['win_list'] = $this->getWin();
	
		echo json_encode($res);
	}


	function getWin()
	{
		//获取中奖纪录
                $table = D('mall_win');
                
                $res = $table
                ->where($where_g)
                ->join('cn_user on cn_user.uuid = cn_mall_win.uuid')
                ->field('cn_mall_win.*,nickname,headImage')
                ->page(1,5)
                ->order('cn_mall_win.datetime desc')
                ->select();
		
		return $res;
	}

	function getList()
	{
		$res['win_list'] = $this->getWin();
		echo json_encode($res);
	}
}
