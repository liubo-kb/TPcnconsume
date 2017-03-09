<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/style.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
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
	<div class="menu">
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
            <li><a href="glysz">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="hyzgl" class="xz">会员制管理</a></li>
            <li><a href="sxed">授信额度</a></li>
            <li><a href="#">数据报表</a></li>
        </ul>
        <h1><a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    <!--left end-->
    <div class="con">
    	<p class="navinfo">位置：首页 &gt; 业务中心 &gt; 会员制管理</p>
        <div class="cmain">
            <p class="ctit">
            	<span class="icon tititem ihy1"></span>&nbsp;&nbsp;会员制管理&nbsp;&nbsp;
            	<span class="icon tititem ivip"></span>
            </p>
            <div class="addbar clearfix">
        		<form action="xxx.html" method="post" id="form-card">
        		<div class="colspan2 margbtm10">
        			<span class="icon tititem iadds"></span>&nbsp;
        			<b>添加会员卡</b>
        		</div>
        		<div class="tb2">
        			<div class="table-row">
				        <label>会员卡编号：</label>
				        <div>
				            <input type="text" name="cardid" id="cardid" class="input-text wid104" />
				        </div>
				    </div>
				    <div class="table-row">
				        <label>会员卡类型：</label>
				        <div>
				            <select name="cardtype" class="select wid75">
				            	<option>储值卡</option>
				            </select>
				        </div>
				    </div>
				    <div class="table-row">
				        <label>会员卡级别：</label>
				        <div>
				            <select name="cardlever" class="select wid75">
				            	<option>金卡</option>
				            </select>
				        </div>
				    </div>
				    <div class="table-row">
				        <label>价格：</label>
				        <div>
				            <input type="text" name="cardprice" id="cardprice" class="input-text wid104" />
				        </div>
				    </div>
				    <div class="table-row">
				        <label>上传卡片：</label>
				        <div>
				        	<div class="uploadbox">
				            	<input type="file" name="cardfile" id="cardfile" class="input-upload" onchange="setImagePreview()" />
				            	<div id="viewdiv">
				            		<img src="/cnconsum/Public/image/card.png" id="cardview" width="115" height="70" style="display: block;" />
				            	</div>
				            </div>
				        </div>
				    </div>
        		</div>
        		<div class="tb2">
        			<div class="table-row">
				        <label class="texalilef">是否赠送金额：</label>
				        <div>
				            <label for="isgive1"><input type="radio" name="isgive" id="isgive1" checked="checked" />&nbsp;是</label>&nbsp;&nbsp;
				            <label for="isgive2"><input type="radio" name="isgive" id="isgive2" />&nbsp;否</label>
				        </div>
				    </div>
				    <div class="table-row">
				        <label class="texalilef">金额：</label>
				        <div>
				            <input type="text" name="amount" id="amount" class="input-text wid75" />
				        </div>
				    </div>
				    <div class="table-row">
				        <label class="texalilef">折扣率：</label>
				        <div>
				            <input type="text" name="discount" id="discount" class="input-text wid75" />&nbsp;%
				        </div>
				    </div>
				    <div class="table-row">
				        <label class="texalilef">优惠内容：</label>
				        <div>
				            <input type="text" name="favour" id="favour" class="input-text wid75" />
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
                                <td><a class='abtn'>查看</a></td>
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
	$('#form-card').submit(function(){
		var cardid = $('#cardid').val();
		var cardprice = $('#cardprice').val();
		
		if(cardid.trim().length == 0){
			$('.form-msg').html('请填写会员卡编号！');
			return false;
		}
		if(isNaN(cardprice) || cardprice <= 0){
			$('.form-msg').html('请填写价格！');
			return false;
		}
		$('.form-msg').html('');
		return false;
	});
</script>
</body>
</html>