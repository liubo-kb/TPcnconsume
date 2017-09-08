<?php
namespace App\Controller\UserType;
use Think\Controller;
class HPController extends Controller 
{
	private $location;	//定位位置
	private $lat;	//当前位置纬度
	private $lng;	//当前位置经度
	function _initialize()
	{
		$this->location = post('location');
		$this->lat = post('lat');
		$this->lng = post('lng');
	}
	
	public function getData()
	{	
		//获取分类图标
		$data['trade_icon'] = $this->getIcon();
		
		//获取今日头条
		$data['headline'] = $this->getHeadline();
		
		//获取顶部广告
		$data['top_ad'] = $this->getTopAd();
		
		//获取活动广告
		$data['activity_ad'] = $this->getActivityAd();
		
		//获取插入广告
		$data['insert_ad'] = $this->getInsertAd("1");
		
		//获取推荐店铺列表
		$data['stores'] = $this->getStores("1,5");
		
		echo json_encode($data);
		
	}
	
	//下拉加载
	function dropLoad()
	{
		$index = post('index');
		$page = $index.",5";
		$data['stores'] = $this->getStores($page);
		$data['insert_ad'] = $this->getInsertAd($index);
		echo json_encode($data);
	}
	
	function test()
	{  
		$answer = array('我','是','刘','波');
		for($i = 0; $i < 20; $i++)
		{
			$ids[$i] = rand(1,3500);
		}
		$table = D('game_chinese');
		$where['id'] = array('in',$ids);
		$data = $table->field('content')->where($where)->select();
		
		for($i=20,$j=0;$i<24;$i++)
		{
			$data[$i]['content'] = $answer[$j++];
		}
		
		shuffle($data);
		dump($data);
	}
	
	//获取分类图标
	function getIcon()
	{
		$table = M('trade_up');
		$data = $table->select();
		return $data;
	}
	
	//获取今日头条
	function getHeadline()
	{
		$table = D('advert_headline');	
		$where['area'] = array("like","%".$this->location."%");
        $where['state'] = 'ONLINE';
		$data = $table->where($where)->order('place asc')->select();
		return $data;
	}
	
	//获取顶部广告
	function getTopAd()
	{
		$table = D('advert_top');
		$where['address'] = array("like","%".$this->location."%");
		$data = $table->where($where)->select();
		return $data;
	}
	
	//获取活动广告
	function getActivityAd()
	{
		$table = D('advert_activity');	
		$where['eare'] = array("like","%".$this->location."%");
        	$where['state'] = 'ONLINE';
		$data = $table->where($where)->select();
		return $data;
	}
	
	//获取插入广告
	function getInsertAd($index)
	{
		$table = D('advert_insert');	
		$where['eare'] = array("like","%".$this->location."%");
		$where['place'] = $index;
        	$where['state'] = 'ONLINE';
		$data = $table->where($where)->order('start_time asc')->select()[0];
		if($data == null)
		{
			$data = "no_data";
		}
		return $data;
	}
	
	//获取推荐店铺列表
	function getStores($page)
	{
		//根据范围获取店铺列表
		$range = getRange($this->lat,$this->lng,8000);
		$where['latitude'] = array( array("elt",$range['maxLat']) , array("egt",$range['minLat']) );
		$where['longtitude'] = array(	array("elt",$range['maxLng']) , array("egt",$range['minLng']) );
		$where['state'] = array("in",array("true"));
		
		//当前位置
		$para['lat'] = $this->lat;
		$para['lng'] = $this->lng;
		
		$where['address'] = array("like","%".$this->location."%");
		$where['state'] = array("in","true");
		$data = showDataGet($where,"1,1000",$para);
		
		
		$index = ( explode(",",$page)[0] - 1 ) * 12;
		$length = count($data);
		if($index < $length)
		{
			$off = 12;
			$end = $index + $off;
			if($end > $length)
			{
				$off = $length - $index;
			}
			$data = array_slice($data,$index,$off);
		}
		else
		{
			$data = array();
		}
		
		
		return $data;
	}
}
