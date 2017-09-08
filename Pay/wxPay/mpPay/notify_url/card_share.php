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
			
		//调用使用分享卡接口
		$url = "http://localhost/cnconsum/App/UserType/CardMarket/handleShare";
		$post_data = array
		(
			's_uuid' => $paras[0],
			'b_uuid' => $paras[1],
			'muid' => $paras[2],
			'card_code' => $paras[3],
			'card_level' => $paras[4],
			'card_type' => $paras[5],
			's_sum' => $paras[6],
			'b_sum' => $paras[7],
		);
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		
		return true;
	}
}

$notify = new PayNotifyCallBack();
$notify->Handle(false);
