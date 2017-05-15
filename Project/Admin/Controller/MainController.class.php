<?php
namespace Admin\Controller;
use Think\Controller;
class MainController extends Controller 
{
	public function auditAccess()
	{
				
		$account = post('account');
		$muid = post('muid');
		$wherec['account'] = $account;
		$wherec['muid'] = $muid;
		$table = D('auditor_task');
		$auditor = $table->where($where)->select()[0]['sender'];

		$table = D('audit_result');
		$record = array(
			'account' => $auditor, muid => $muid, 'tip' => '审核通过',
			'state' => 'true', 'datetime' => currentTime()
		);
		$result = addWithCheck($table,$record);

		$table = D('merchant');
		$where['muid'] = $muid;
		$set['state'] = 'true';
		$result = setWithCheck($table,$where,$set);
		//echo $result;
		
		$table = D("referrer");
		$where_r['recommend'] = $muid;
		$where_r['type'] = "m";
		$set['state'] = "ONLINE";
		$result = setWithCheck($table,$where_r,$set);


		$referrer_uuid = $table->where($where_r)->select()[0]['referrer'];
	
		

		//检测用户当前级别
                checkUserLevel($referrer_uuid);
               
		  
		
	                 
               //处理推荐红包
               $sum = getSystemPara(currentTime(),'reward_referrer')['merchant']; //获取系统推荐政策
               setRedPacket($referrer_uuid,$sum);
		
	
		
               //更新推荐收入
               setReferrerSum($referrer_uuid,'u',$sum);
		
			
               //设置推荐收入记录
               $record = array('datetime'=>currentTime(),'tip' => '推荐商户奖励', 'sum' => $sum,'type' => 'm', 'id' => $referrer_uuid);
               setIncomeRecord($record);

               //处理送积分
               addIntegral($referrer_uuid,'推荐商户','ref_merchant');
		
		

	}

	public function auditFail()
	{
		$account = post('account');
                $muid = post('muid');
		
                $wherec['account'] = $account;
                $wherec['muid'] = $muid;
                $table = D('auditor_task');
                $data = $table->where($where)->select()[0];
		$auditor = $data['sender'];
		$tip = $data['result'];

                $table = D('audit_result');
                $record = array(
                        'account' => $auditor, muid => $muid, 'tip' => $tip,
                        'state' => 'false', 'datetime' => currentTime()
                );
                $result = addWithCheck($table,$record);




                $table = D('merchant');
                $where['muid'] = $muid;
                $set['state'] = 'false';
                $result = setWithCheck($table,$where,$set);
                echo $result;
	}

	public function removeAuditor()
	{
		$account = get('account');
		$table = D('auditor_ext');
		$where['account'] = $account;
		$table->where($where)->delete();
		$this->auditor();
	}	
	
	public function auditor()
	{
		$this->assign('press_auditor',true);
		$this->assign('title','管理外派人员');

                $data = D('auditor_ext');

                $page_now = I('post.p');   //当前页码
                $page_sum = $data
                ->count();      //总页数
                $page_list = 6;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'auditor', //请求数据的参数地址
                                'type' => 'auditor'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "账号","密码","姓名","添加日期","删除"
                );

                //表内数据索引
                $data_index = array(
                        "account","passwd","name","datetime"
                );

                //初始化无刷新分页类
                $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                $page->setConfig('header','共%TOTAL_ROW%个外派人员');
                $page->setConfig('prev',"<img src='../../Public/image/admin/prev.png' class='img-pg' />");
                $page->setConfig('next',"<img src='../../Public/image/admin/next.png' class='img-pg' />");
                $page->setConfig('first','首页');
                $page->setConfig('last','尾页');
                $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
                $page->lastSuffix = false;

		//分页索引
                $show = $page->show();

                //表内数据
                $table_data = $data
                ->where($where)
                ->limit($page->firstRow,$page->listRows)
                ->select();

                if( !empty( $page_now ) )
                {
                        $info = array($table_head,$table_data,$data_index,$show);
                        $this->ajaxReturn($info);
                }
                else
                {
                        $this->assign('table_head',$table_head); //表单的表头
                        $this->assign('table_data',$table_data); //表单每一行的数据
                        $this->assign('data_index',$data_index); //表单每一行的数据索引
                        $this->assign('page',$show); //分页的索引
                        $this->assign('account',session('account'));
                        $this->assign('i',1);
                        $this->display('auditor');
                }


	}

	public function addAuditor()
	{
		$name = post('name');
		$password = post('password');
		$account = post('account');
		$datetime = currentTime();
		$record = array(
			'account' => $account, 'passwd' => $password,
			'name' => $name, 'datetime' => $datetime
		);

		
		addWithCheck(D('auditor_ext'),$record);

		$this->auditor();
	}
	
	public function settle()
	{
		$this->assign('press_settle',true);
		$this->assign('title','新入驻商户');

		$data = D('merchant');
		$where['state'] = 'null';               

				
		$page_now = I('post.p');   //当前页码
                $page_sum = $data
		->where($where)
		->count();	//总页数
                $page_list = 6;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'settle', //请求数据的参数地址
                                'type' => 'settle'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "公司名称","法人","申请时间","操作"
                );

                //表内数据索引
                $data_index = array(
                        "muid","store","name","datetime"
                );

                //初始化无刷新分页类
                $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                $page->setConfig('header','共%TOTAL_ROW%个商户');
                $page->setConfig('prev',"<img src='../../Public/image/admin/prev.png' class='img-pg' />");
                $page->setConfig('next',"<img src='../../Public/image/admin/next.png' class='img-pg' />");
                $page->setConfig('first','首页');
                $page->setConfig('last','尾页');
                $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
                $page->lastSuffix = false;

                //分页索引
                $show = $page->show();

                //表内数据
		$table_data = $data
		->where($where)
		->limit($page->firstRow,$page->listRows)
		->select();

                if( !empty( $page_now ) )
                {
                        $info = array($table_head,$table_data,$data_index,$show);
                        $this->ajaxReturn($info);
                }
                else
                {
                        $this->assign('table_head',$table_head); //表单的表头
                        $this->assign('table_data',$table_data); //表单每一行的数据
                        $this->assign('data_index',$data_index); //表单每一行的数据索引
                        $this->assign('page',$show); //分页的索引
                        $this->assign('account',session('account'));
			$this->assign('i',1);
                        $this->display('settle');
                }
	}

	public function auditing()
	{
		$this->assign('press_auditing',true);
		$this->assign('title','外审中');

	
		$data = D('merchant');
               
		$where['cn_merchant.state'] = 'auditing';
			
		$page_now = I('post.p');   //当前页码
                $page_sum = $data
		->where($where)
		->count();	//总页数
                $page_list = 6;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'auditing', //请求数据的参数地址
                                'type' => 'auditing'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "公司名称","法人","外派时间","外派人员","外审状态"
                );

                //表内数据索引
                $data_index = array(
                        "store","name","atime","auditor","astate","muid"
                );

                //初始化无刷新分页类
                $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                $page->setConfig('header','共%TOTAL_ROW%个商户');
                $page->setConfig('prev',"<img src='../../Public/image/admin/prev.png' class='img-pg' />");
                $page->setConfig('next',"<img src='../../Public/image/admin/next.png' class='img-pg' />");
                $page->setConfig('first','首页');
                $page->setConfig('last','尾页');
                $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
                $page->lastSuffix = false;

                //分页索引
                $show = $page->show();

                //表内数据
		$table_data = $data
		->where($where)
		->join("cn_auditor_task on cn_merchant.muid = cn_auditor_task.muid")
                ->field("store,name,cn_auditor_task.datetime as atime, cn_auditor_task.account as auditor, cn_auditor_task.state as astate,cn_merchant.muid as muid")
		->limit($page->firstRow,$page->listRows)
		->select();

                if( !empty( $page_now ) )
                {
                        $info = array($table_head,$table_data,$data_index,$show);
                        $this->ajaxReturn($info);
                }
                else
                {
                        $this->assign('table_head',$table_head); //表单的表头
                        $this->assign('table_data',$table_data); //表单每一行的数据
                        $this->assign('data_index',$data_index); //表单每一行的数据索引
                        $this->assign('page',$show); //分页的索引
                        $this->assign('account',session('account'));
			$this->assign('i',1);
                        $this->display('auditing');
                }

	}

	public function audited()
        {
		$this->assign('press_audited',true);	
		$this->assign('title','审核结果');

		$data = D('merchant');
               
		$where['cn_merchant.state'] = array('in',array('true','false'));		
		
		$page_now = I('post.p');   //当前页码
                $page_sum = $data
		 ->join("cn_audit_result on cn_merchant.muid = cn_audit_result.muid")
		->where($where)
		->count();	//总页数
                $page_list = 6;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'audited', //请求数据的参数地址
                                'type' => 'audited'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "公司名称","法人","审核时间","审核人员","审核结果"
                );

                //表内数据索引
                $data_index = array(
                      "store","name","atime","auditor","astate","muid"
                );

                //初始化无刷新分页类
                $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                $page->setConfig('header','共%TOTAL_ROW%个商户');
                $page->setConfig('prev',"<img src='../../Public/image/admin/prev.png' class='img-pg' />");
                $page->setConfig('next',"<img src='../../Public/image/admin/next.png' class='img-pg' />");
                $page->setConfig('first','首页');
                $page->setConfig('last','尾页');
                $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
                $page->lastSuffix = false;

                //分页索引
                $show = $page->show();

                //表内数据
		$table_data = $data
		->where($where)
		->join("cn_audit_result on cn_merchant.muid = cn_audit_result.muid")
                ->field("store,name,cn_audit_result.datetime as atime, cn_audit_result.account as auditor, cn_audit_result.state as astate,cn_merchant.muid as muid")
		->limit($page->firstRow,$page->listRows)
		->select();

                if( !empty( $page_now ) )
                {
                        $info = array($table_head,$table_data,$data_index,$show);
                        $this->ajaxReturn($info);
                }
                else
                {
                        $this->assign('table_head',$table_head); //表单的表头
                        $this->assign('table_data',$table_data); //表单每一行的数据
                        $this->assign('data_index',$data_index); //表单每一行的数据索引
                        $this->assign('page',$show); //分页的索引
                        $this->assign('account',session('account'));
			//$this->assign('i',1);
                        $this->display('audited');
                }
		

        }

	public function handleAudit()
	{
		$where['muid'] = get('muid');
		$table = D('merchant');
		$info = $table->where($where)->select()[0];

		if($info['house_contact'] == '房产证明')
		{
			$this->assign('tip','房产证明');
			$this->assign('dir','houseImage');
		}
		else
		{
			$this->assign('tip','租赁合同');
                        $this->assign('dir','tenancyImage');
		}
	
		$this->assign('info',$info);
		$this->assign('account',session('account'));
		$this->assign('press_settle',true);
		$this->assign('title','审核商户资料');


                $this->display('handle_audit');
	}

	public function failReason()
	{
		$record = array(
			'account' => post('account'),'tip' => post('reason'),'muid' => post('muid'),
			'state' => 'false','datetime' => currentTime()
		);
		$table = D('audit_result');
		$result = addWithCheck($table,$record);
		
		$table = D('merchant');
		$where['muid'] = post('muid');
		$set['state'] = 'false';
		$result = setWithCheck($table,$where,$set);
		echo $result;
	}

	public function setAuditor()
	{
		$account = post('account');
		$selected = post('selected');
		$muid = post('muid');

		$record = array(
			'account' => $selected, 'sender' => $account, 'muid' => $muid, 'datetime' => currentTime(),
			'state' => "auditing", 'result'=>"正在外审中"
		);
		$result = addWithCheck(D('auditor_task'),$record);

		$where['muid'] = $muid;
		$table = D('merchant');
		$set['state'] = 'auditing';
		$table->where($where)->save($set);

		echo json_encode($result);
	}
}
