<?php
namespace App\Controller\Extra;
use Think\Controller;
class IMController extends Controller 
{
	public function index()
	{
		echo '其它控制器索引';
	}
	
	public function getRec()
	{
		$account = post('account');
		$account = 'u_4a48e91e08';
		$t1 = $cn_user_card;
		$t2 = $cn_user;
		$sql = "select distinct uuid as account,nickname,headImage from cn_user_card,cn_user where user != '$account' and cn_user_card.user = cn_user.uuid and merchant in (select merchant from cn_user_card where user = '$account')";
		$im = M('im_account');
		$result = $im->query($sql);
		echo json_encode($result);
	}
	
	public function search()
	{
		 //$where['store'] = array('like','%'.$store.'%');
		 $im_account = M('im_account');
		 $account = post('account');
		 $type = post('type');
		
		 if( $type == 'phone' ) 
		 {
			 $para = 'phone'; 
		 }
		 else if( $type == 'name' )
		 {
			 $para = 'nickname';
		 }
		 
		 $where[$para] = array('like','%'.$account.'%');
		 $result = $im_account
		 ->where($where)
		 ->field('account,nickname,headImage')
		 ->select();	
 
		 echo json_encode($result);
	}

	public function get()
	{
		 $im_account = M('im_account');
                 $account = post('account');
		 $where['account'] = $account;
		 $result = $im_account
                 ->where($where)
                 ->field('account,nickname,headImage')
                 ->select();
		
		 echo json_encode($result);  
	}

}
