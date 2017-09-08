<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		
		//处理业务的代码
		$attach = $data['attach'];
		
		$paras = explode("#",$attach);
			
		//调用购卡接口
		$url = "http://101.201.100.191/cnconsum/App/UserType/card/buy";
		$post_data = array
		(
			'cardCode' => $paras[1],
			'cardLevel' => $paras[2],
			'cardType' => $paras[3],
			'uuid' => $paras[4],
			'muid' => $paras[5],
			'sum' => $paras[6],
		);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		
		//判断是否使用优惠，并调用优惠接口
		$privi = $paras[0];
		switch ($privi)
		{
			case "cp":
				$url = "http://localhost/cnconsum/App/UserType/user/couponMod";
				break;
			case "scp":
				$url = "http://localhost/cnconsum/App/UserType/user/sxlCouponMod";
				break;
			case "rp":
				$url = "http://localhost/cnconsum/App/UserType/user/redPacketMod";
				break;
			default:
				return;
		}
		$privi_con = $paras[7];
		$post_data = array
		(
			'uuid' => $paras[4],
			'content' => $privi_con,
			'type' => "购买储值卡",
		);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		
		
		
		/*$url = "http://101.201.100.191/cnconsum/App/UserType/index/log";
		$post_data = array
		(
			'content' => $attach,
		);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($ch);
		curl_close($ch);*/
		
		
		return true;
	}
}

$notify = new PayNotifyCallBack();
$notify->Handle(false);
