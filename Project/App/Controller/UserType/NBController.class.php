<?php
namespace App\Controller\UserType;
use Think\Controller;
class NBController extends Controller 
{
	private $location;	//定位位置
	private $lat;	//当前位置纬度
	private $lng;	//当前位置经度
	private $trade;  //当前行业
	function _initialize()
	{
		$this->location = post('location');
		$this->lat = post('lat');
		$this->lng = post('lng');
		$this->trade = post('trade');
	}
	
	public function getData()
	{	
		//获取热门分类
		$data['hot_sort'] = $this->getHotSort();
		
		//获取周边广告
		$data['advert'] = $this->getAdvert();
		
		//获取推荐店铺列表
		$data['stores'] = $this->getStores("1,12");
		
		echo json_encode($data);
		
	}
	
	//下拉加载
	function dropLoad()
	{
		$index = post('index');
		$page = $index.",12";
		$data['stores'] = $this->getStores($page);
		echo json_encode($data);
	}
	
	//获取热门分类
	function getHotSort()
	{
		$table = D('trade_sub');
		$where['state'] = 'hot';
		$data = $table->where($where)->select();
		$j = 0;
		$result[$j] = array("id" => "0000", "icon_url" => "hot.png", "text" => "热门", "state" => "hot");
		for($i=0; $i<count($data); $i++)
		{
			$j++;
			$result[$j] = $data[$i];
		}
		return $result;
	}
	
	//获取滚动广告
	function getAdvert()
	{
		$table = D("nb_advert");
		$data = $table->select();
		return $data;
	}
	
	//获取推荐店铺列表
	function getStores($page)
	{
		//根据范围获取店铺列表
		$range = getRange($this->lat,$this->lng,8000);
		$where['latitude'] = array( array("elt",$range['maxLat']) , array("egt",$range['minLat']) );
		$where['longtitude'] = array(	array("elt",$range['maxLng']) , array("egt",$range['minLng']) );
		$where['state'] = array("in",array("true","complete_not_auth"));
		
		//当前位置
		$para['lat'] = $this->lat;
		$para['lng'] = $this->lng;
		
		$where['trade'] = array("like","%".$this->trade."%");
		$where['address'] = array("like","%".$this->location."%");
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
