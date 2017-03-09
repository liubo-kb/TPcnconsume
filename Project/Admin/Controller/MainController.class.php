<?php
namespace Admin\Controller;
use Think\Controller;
class MainController extends Controller 
{
		
	public function settle()
	{
		$this->assign('press_settle',true);

		$data = D('merchant');
               
				
		$page_now = I('post.p');   //当前页码
                $page_sum = $data->count();	//总页数
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
		$table_data = $data->limit($page->firstRow,$page->listRows)->select();

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
		$data = D('merchant');
               
				
		$page_now = I('post.p');   //当前页码
                $page_sum = $data->count();	//总页数
                $page_list = 6;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'auditing', //请求数据的参数地址
                                'type' => 'auditing'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "公司名称","法人","外派时间","外派人员","状态"
                );

                //表内数据索引
                $data_index = array(
                        "store","name","datetime","bname"
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
		$table_data = $data->limit($page->firstRow,$page->listRows)->select();

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
		$data = D('merchant');
               
				
		$page_now = I('post.p');   //当前页码
                $page_sum = $data->count();	//总页数
                $page_list = 6;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'audited', //请求数据的参数地址
                                'type' => 'audited'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "公司名称","法人","外派时间","外派人员","审核结果"
                );

                //表内数据索引
                $data_index = array(
                        "store","name","datetime","bname"
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
		$table_data = $data->limit($page->firstRow,$page->listRows)->select();

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
		$this->assign('account','111');
		$this->assign('press_settle',true);
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

		echo $result;
	}
}
