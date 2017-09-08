<?php
namespace App\Controller\UserType;
use Think\Controller;
class StoreFilterController extends Controller 
{
	private $lat;	//当前位置纬度
	private $lng;	//当前位置经度
	
	private $location;	//筛选位置
	private $trade;  //筛选行业
	private $pri;		//筛选条件
	
	private $para; //附加条件（距离排序）
	
	function _initialize()
	{
		$this->lat = post('lat');
		$this->lng = post('lng');
		$this->trade = post('trade');
		$this->location = post('location');
		$this->pri = post('pri');
		
		$this->para = null;
	}
	
	public function getData()
	{	
		//获取店铺列表
		$data['stores'] = $this->getStores("1,12");
		echo json_encode($data);
		
	}
	
	
	//获取筛选后的店铺
	function getFilterStores()
	{
		$result['stores'] = $this->filter("1,12");
		echo json_encode($result);
	}
	
	//下拉加载
	function dropLoad()
	{
		$index = post('index');
		$page = $index.",12";
		$data['stores'] = $this->filter($page);
		echo json_encode($data);
	}
	
	//筛选店铺
	function filter( $page )
	{
		//按地点筛选
		if( $this->location != 'null' )
		{
			$where['address'] = array("like","%".$this->location."%");
			$stores = $this->getStores($page,$where);
		}
		//离我最近
		if( $this->pri == 'near' )
		{
			$range = getRange($this->lat,$this->lng,8000);
			$where['latitude'] = array( array("elt",$range['maxLat']) , array("egt",$range['minLat']) );
			$where['longtitude'] = array(	array("elt",$range['maxLng']) , array("egt",$range['minLng']) );
			$this->para['lng'] = $this->lng;
			$this->para['lat'] = $this->lat;
			$stores = $this->getStores("1,100",$where);
			$index = ( explode(",",$page)[0] - 1 ) * 12;
			$length = count($stores);
			if($index < $length)
			{
				$off = 12;
				$end = $index + $off;
				if($end > $length)
				{
					$off = $length - $index;
				}
				$stores = array_slice($stores,$index,$off);
			}
			else
			{
				$stores = array();
			}
		}
		
		//好评优先
		if(	$this->pri == 'best')
		{
			$stores = $this->getStores($page,$where);
		}
		return $stores;
	}
	
	
	//获取推荐店铺列表
	function getStores($page,$where=null)
	{	
		$where['trade'] = array("like","%".$this->trade."%");
		$where['state'] = array("in",array("true","complete_not_auth"));
		$data = showDataGet($where,$page,$this->para);
		return $data;
	}
	
}
