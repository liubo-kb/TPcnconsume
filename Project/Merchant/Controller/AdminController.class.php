<?php
namespace Merchant\Controller;
use Think\Controller;
class AdminController extends Controller 
{	
	public function add()
        {
		$merchant = session("muid");	
                $account = post('account');
                $position = post('position');
                $sex = post('sex');
                $phone = post('phone');
                $passwd = post('passwd');
                

                $admin = D('Admin');
	

                $person = array(
                        'merchant' => $merchant,
                        'account' => $account,
                        'privi' => $this->getPrivi( $position ),
                        'sex' => $sex,
                        'phone' => $phone,
                        'passwd' => $passwd,
                        'position' => $position,
                );

		//echo json_encode($person);               
 
		$result = $admin->addWithCheck($person);
		switch( $result )
		{
			case '1' :
				ajaxRe('1','添加管理员成功','#');
				break;
			case '1062' :
                                ajaxRe('1062','重复添加','#');
                                break;
			default :
                                ajaxRe('0','未知错误','#');
                                break;
		}		
		

        }

	public function mod()
	{
		$where['merchant']= session('muid');
                $where['account'] = post('account_old');

                $update['account'] = post('account');
                $update['passwd'] = post('passwd');
                $update['position'] = post('position');
                $update['sex'] = post('sex');
                $update['phone'] = post('phone');
                $update['privi'] = $this->getPrivi( post('position') );


                $admin = D('Admin');

                $result = $admin
                ->where($where)
                ->save($update);
		
		if( $result == '1' )
		{
			ajaxRe('1','修改管理员成功','../Business/glysz');
		}
		else
		{
			ajaxRe('2','未知错误','#');
		}		
		
		//$this->success("修改管理员成功","../Business/glysz",3);
	}
	
	public function del()
	{
                $admin = D('Admin');

                $where['merchant'] = session('muid');
                $where['account'] = get('account');

                $result = $admin
                ->where($where)
                ->delete();

		if( $result == '1' )
                {
                        ajaxRe('1','删除管理员成功','../Business/glysz');
                }        
                else
                {
                        ajaxRe('2','未知错误','#');
                }


		//$this->success("删除管理员成功","../Business/glysz",3);
	}
	
	public function getPrivi( $position )
	{
		switch( $position )
                {
                        case "店员":
                                $privi = "shopAs";
                                break;
                        case "店长":
                                $privi = "shopMg";
                                break;
                        case "经营者":
                                $privi = "opeartor";
                                break;
                        default:
                                break;
                }
		
		return $privi;

	}
}
