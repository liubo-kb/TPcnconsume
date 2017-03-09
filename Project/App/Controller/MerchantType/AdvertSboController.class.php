<?php

/*
*       搜索页广告控制器
*	  add() ：添加广告操作
*	  get() ：查询广告操作
*	  onlineAdvertGet()：获取已上线的广告
*	  onlineMerchantGet()：获取已经审核上线的商家	       
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\AdvertSboModel;

class AdvertSboController extends Controller 
{
	
	public function add()
	{
		$advert = D('AdvertSbo');
			
		$record = array(
			'merchant' => post('muid'),
			'content' => post('advert_content'),
			'online_date' => post('online_date'),
			'stay_time' => post('stay_time'),
			'position' => post('advert_position'),
			'advert_eare' => post('advert_eare'),
			'favor' => post('favor'),
			'state' => 'null',
		);
		
		$data['result_code'] = $advert->addWithCheck($record);
		echo json_encode($data);
		
		//echo $advert->getInfo();
	}

	
	public function get()
	{
		$eare = post('eare');
		$favor = post('favor');
		$trade = post('trade');
		            

		$advert = D('AdvertSbo');
		
		$where['favor'] = $favor;
                $where['cn_advert_sbo.state'] = $state;
		
		/*    全城-全部分类    */
		if( $trade == 'all' and $eare == 'all')
		{	
			/*  查询所有广告  */
			$online_advert = $this->onlineAdvertGet($advert,$where);
			

			/*  查询10个上线商家 */	
			$subWhere = "favor = '$favor'";
			$online_merchant = $this->onlineMerchantGet($subWhere);
			 
		}


		/*    某区-全部分类    */
		else if( $trade == 'all' )
                {
                        /*  查询所有广告  */
			$where['advert_eare'] = $eare;
                        $online_advert = $this->onlineAdvertGet($advert,$where);
                        
                        /*  查询10个上线商家 */
                        $subWhere = "favor = '$favor' and advert_eare = '$eare'";
			$where = "address like '%$eare%' ";
                        $online_merchant = $this->onlineMerchantGet($subWhere,$where);
                         
                }
		

		/*    全城-某类    */
		else if( $eare == 'all' )
                {
                        /*  查询所有广告  */
                        $where['trade'] = $trade;
                        $online_advert = $this->onlineAdvertGet($advert,$where);

                        /*  查询10个上线商家 */
                        $subWhere = "favor = '$favor' and trade = '$trade'";
                        $where = "trade = '$trade' ";
                        $online_merchant = $this->onlineMerchantGet($subWhere,$where);

                }
		

		/*    某区-某类    */
		else
                {
                        /*  查询所有广告  */
                        $where['trade'] = $trade;
			$where['advert_eare'] = $eare;
                        $online_advert = $this->onlineAdvertGet($advert,$where);

                        /*  查询10个上线商家 */
                        $subWhere = "favor = '$favor' and trade = '$trade' and advert_eare = '$eare'";
                        $where = "trade = '$trade' and address like '%$eare%'";
                        $online_merchant = $this->onlineMerchantGet($subWhere,$where);

                }
		
		
		$result = array_merge($online_advert,$online_merchant);
		//dump($result);
		echo json_encode($result);
	}
	
	

	public function onlineAdvertGet($advert,$where)
	{
		$online_advert = $advert
                ->field('store,content,address,image_url,phone,muid,longtitude,latitude')
                ->join('cn_merchant ON cn_merchant.phone =  cn_advert_sbo.merchant')
                ->where($where)
                ->order('position asc')
                ->select();
		
		return $online_advert;
	}

	public function onlineMerchantGet($subWhere = "",$where = "")
	{
		if($where != "")
		{
			$where = $where."and ";
		}

		$merchant = M();
                $subQuery = "(select merchant from cn_advert_sbo where state = 'true' and ".$subWhere.") LIMIT 0,10";
               	$query = "select store,address as content,address,image_url,phone,muid,longtitude,latitude from cn_merchant where ".$where." state = 'true' and phone not in ";
                $online_merchant = $merchant->query($query.$subQuery);
		
		return $online_merchant;
	}
	
	

}
