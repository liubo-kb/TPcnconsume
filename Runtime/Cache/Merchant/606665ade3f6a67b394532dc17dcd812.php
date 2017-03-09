<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/style.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/zDrag.js" type="text/javascript"></script>
<script src="/cnconsum/Public/js/zDialog.js" type="text/javascript"></script>
<script src="/cnconsum/Public/js/script.js"></script>
<script src="/cnconsum/Public/js/pages.js"></script>
<script>
$(function(){
	setInterval("showtime('time')",1000);
});
</script>
</head>

<body>
<!--header start-->
<div class="header">
	<p class="hdr">
    	<span id="time">2016-10-24 10:42:30</span><br>
        <a href="#">了解更多</a> | <a href="#">反馈意见</a>
    </p>
	<img src="/cnconsum/Public/image/logo.png" />
    <img src="/cnconsum/Public/image/slogo.png" class="slogo" />
</div>
<div class="nav">
	<div>
    <p><span class="icon tititem iexit"></span>&nbsp;&nbsp;<a href="#">退出</a></p>
	您好,店面商户<?php echo ($account); ?>,欢迎使用商消乐管理系统! 
    </div>
</div>
<!--header end-->
<div class="container clearfix">
	<!--left start-->
	<div class="menu clearfix">
    	<h1 class="uc"><a href="#"><span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1 class="uc"><a href="#"><span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1 class="uc"><a href="#"><span class="icon navitem ijs"></span>&nbsp;结算中心</a></h1>
        <h1 class="msub" onClick="showsubmenu(this)"><span class="icon navitem iyw"></span>&nbsp;业务中心</h1>
        <ul class="submenu" style="display:block;">
            <li><a href="#">会员延期</a></li>
            <li><a href="#">预约处理</a></li>
            <li><a href="#">广告推送</a></li>
            <li><a href="#">店铺管理</a></li>
            <li><a href="zjtx">资金提现</a></li>
            <li><a href="glysz" class="xz">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="hyzgl">会员制管理</a></li>
            <li><a href="sxed">授信额度</a></li>
            <li><a href="#">数据报表</a></li>
        </ul>
        <h1 class="uc"><a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    <!--left end-->
    <div class="con">
    	<p class="navinfo">位置：首页 &gt; 业务中心 &gt; 管理员设置</p>
        <div class="cmain">
            <p class="ctit">
            	<span class="icon tititem igly"></span>&nbsp;&nbsp;管理员设置&nbsp;&nbsp;
            	<span class="icon tititem ivip"></span>
            </p>
        	<div class="addbar clearfix">
        		<form action="xxx.html" method="post" id="form-manager">
        		<div class="colspan2 margbtm10">
        			<span class="icon tititem iadds"></span>&nbsp;
        			<b>添加管理员</b>
        		</div>
        		<div class="tb2">
        			<div class="table-row">
				        <label>管理员账号：</label>
				        <div>
				            <input type="text" name="account" id="account" class="input-text wid104" />
				        </div>
				    </div>
				    <div class="table-row">
				        <label>密码：</label>
				        <div>
				            <input type="password" name="password" id="password" class="input-text wid104" />
				        </div>
				    </div>
				    <div class="table-row">
				        <label>联系方式：</label>
				        <div>
				            <input type="text" name="contact" id="contact" class="input-text wid104" />
				        </div>
				    </div>
        		</div>
        		<div class="tb2">
        			<div class="table-row">
				        <label class="text-align-r">权限：</label>
				        <div>
				            <select name="power" class="select">
				            	<option>店员</option>
				            </select>
				        </div>
				    </div>
				    <div class="table-row">
				        <label class="text-align-r">性别：</label>
				        <div>
				            <label for="sex1"><input type="radio" name="sex" id="sex1" checked="checked" />&nbsp;男</label>&nbsp;&nbsp;
				            <label for="sex2"><input type="radio" name="sex" id="sex2" />&nbsp;女</label>
				        </div>
				    </div>
        		</div>
        		<div class="colspan2 margtop15 paddleft85">
        			<input type="submit" class="btn-sub wid45" value="确定" />&nbsp;&nbsp;&nbsp;&nbsp;
        			<input type="reset" class="btn-reset wid45" value="取消" />
        			<span class="form-msg"></span>
        		</div>
        		</form>
        	</div>
        	<hr class="hr-grey margleft38" noshade="noshade" />

            <div class="cinfo" id="content">
		<table class ='ctable blocen' width="90%">
                        <tr>
                                <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><th><?php echo ($head); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>

                        <?php if(is_array($table_data)): $i = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                <?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i;?><td><?php echo ($data["$index"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                                <td><a class='abtn'>修改</a></td>
                                <td><a class='abtn' href="javascript:suredel('确定要删除这条信息吗？')">删除</a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
            	<div class="page text-align-r margtop47">
			<?php echo ($page); ?>
            	</div>
            </div>

        </div>
    </div>
    <!--right start-->
    <div class="rcolu">
    	<p class="weather"><img src="/cnconsum/Public/image/sun.png" /><br>今天<br>12℃/18℃</p>
        <p class="adbar"><img src="/cnconsum/Public/image/best.png" /></p>
    </div>
    <!--right end-->
</div>
<script>
	$('#form-manager').submit(function(){
		var account = $('#account').val();
		var pwd = $('#password').val();
		var contact = $('#contact').val();
		
		if(account.trim().length == 0){
			$('.form-msg').html('请填写管理员账号！');
			return false;
		}
		if(pwd.trim().length == 0){
			$('.form-msg').html('请填写密码！');
			return false;
		}
		if(contact.trim().length == 0){
			$('.form-msg').html('请填写联系方式！');
			return false;
		}
		$('.form-msg').html('');
		return false;
	});
</script>
</body>
</html>