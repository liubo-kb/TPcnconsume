<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/style.css">
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/uploadify.css">
<script src="/cnconsum/Public/js/merchant/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/merchant/jquery.placeholder.min.js"></script>
<script src="/cnconsum/Public/js/merchant/distpicker.data.js"></script>
<script src="/cnconsum/Public/js/merchant/distpicker.js"></script>
<script src="/cnconsum/Public/js/merchant/jquery.validate.min.js"></script>
<script src="/cnconsum/Public/js/merchant/jquery.uploadify.min.js"></script>
<script src="/cnconsum/Public/js/merchant/script.js"></script>
<script src="/cnconsum/Public/js/merchant/formcheck.js"></script>
<script src="/cnconsum/Public/js/merchant/upload.js"></script>
<style>
body{
	background-color: #e5e5e5;
}
</style>

<script>
$(function(){

        $("#distpicker").distpicker({
                province: "<?php echo ($info["province"]); ?>",
                city: "<?php echo ($info["city"]); ?>",
                district: "<?php echo ($info["district"]); ?>"
        });

	$('input[type=text]').placeholder();
	
	var id_front = {
                "account" : "<?php echo ($account); ?>" ,
                "type" : "idFront" ,
                "upload_id" : "cfile1" ,
                "img_id" : "cardview1",
                "bar_id" : "queue1",
		"check_id" : "cardfile1",
        };
        config(id_front);

	var id_back = {
                "account" : "<?php echo ($account); ?>" ,
                "type" : "idBack" ,
                "upload_id" : "cfile2" ,
                "img_id" : "cardview2",
                "bar_id" : "queue2",
                "check_id" : "cardfile2",
        };
        config(id_back);

	var id_hand = {
                "account" : "<?php echo ($account); ?>" ,
                "type" : "idHand" ,
                "upload_id" : "cfile3" ,
                "img_id" : "cardview3",
                "bar_id" : "queue3",
                "check_id" : "cardfile3",
        };
        config(id_hand);	

})
</script>
</head>

<body>
<!--header start-->
<div class="header-f">
	<img src="/cnconsum/Public/image/merchant/logo.png" width="119" height="48" />
    <span class="dot">●</span>
    <span class="font22kai">商户中心</span>
</div>
<!--header end-->
<div class="content">
	
	<div class="headbar">
		<p>完善信息</p>
		<a href="login.html">返回登录页</a>
	</div>
	
	<div class="stepbar">
		<label><img src="/cnconsum/Public/image/merchant/step1.png" /><span class="maincolor">店主信息</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step2.png" /><span class="color53">店铺信息</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step3.png" /><span class="color53">完成</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step.png" /></label>
	</div>
	<form action="complete_01" method="post" id="form-reginfo-">
	<div class="con-step1">
		<div class="tr-step1">
	        <label><span>*&nbsp;</span>姓名</label>
	        <div>
	            <input type="text" name="name" id="uname" class="boxtxt" placeholder="请输入您的真实姓名" value="<?php echo ($info["name"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>住宅地址</label>
	        <div id="distpicker">
	        	<label class="box-select">
		        	<select name="province" id="province">
		        		<option>请选择</option>
		        	</select>
	        	</label>
	        	<label class="box-select">
		        	<select name="city" id="city">
		        		<option>请选择</option>
		        	</select>
	        	</label>
	        	<label class="box-select">
		        	<select name="district" id="district">
		        		<option>请选择</option>
		        	</select>
	        	</label>
	        	<br />
	            <input type="text" name="location" id="adress" class="boxtxt" placeholder="请输入您现在具体住宅地址" value="<?php echo ($info["location"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>身份证号</label>
	        <div>
	            <input type="text" name="id" id="cardid" class="boxtxt" placeholder="请输入真实有效的18位身份证号码" value="<?php echo ($info["id"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1 clearfix">
	        <label class="onlyrow"><span>*&nbsp;</span>上传负责人的身份证信息</label>
	    </div>
	    <div class="tr-step1">
	    	<div class="box-sfz-f">
		        <div class="box-upload box-sfz">
		            <p>您的照片仅用于审核，我们将严格保密</p>
		            <ul class="box-card clearfix">
		            	<li>
		            		身份证正面
		            		<div class="picview">
		            			<img src="<?php echo ($info["id_front_src"]); ?>" id="cardview1" />
		            			<div id="queue1" class="upqueue"></div>
		            		</div>
		            		<div class="btn-up">
				            	<input id="cfile1" type="file" multiple="false">
						<?php if($info["id_front_src"] == $default_src): ?><input type="hidden" name="cardfile1" id="cardfile1" />
						<?php else: ?>
							<input type="hidden" name="cardfile1" id="cardfile1" value="uploaded"/><?php endif; ?>
				            </div>
		            	</li>
		            	<li>
		            		身份证反面
		            		<div class="picview">
		            			<img src="<?php echo ($info["id_back_src"]); ?>" id="cardview2" />
		            			<div id="queue2" class="upqueue"></div>
		            		</div>
		            		<div class="btn-up">
				            	<input id="cfile2" type="file" multiple="false">
						<?php if($info["id_back_src"] == $default_src): ?><input type="hidden" name="cardfile2" id="cardfile2" />
						<?php else: ?>
							<input type="hidden" name="cardfile2" id="cardfile2" value="uploaded"/><?php endif; ?>
				            </div>
		            	</li>
		            	<li>
		            		本人手持身份证
		            		<div class="picview">
		            			<img src="<?php echo ($info["id_hand_src"]); ?>" id="cardview3" />
		            			<div id="queue3" class="upqueue"></div>
		            		</div>
		            		<div class="btn-up">
				            	<input id="cfile3" type="file" multiple="false">
						<?php if($info["id_back_src"] == $default_src): ?><input type="hidden" name="cardfile3" id="cardfile3" />
						<?php else: ?>
							<input type="hidden" name="cardfile3" id="cardfile3" value="uploaded"/><?php endif; ?>
				            </div>
		            	</li>
		            </ul>
		            <ul class="box-sample clearfix">
		            	<li>
		            		示例：
		            		<div class="box-cardex"><img src="/cnconsum/Public/image/merchant/cardz-y.jpg" /></div>
		            		<a href="/cnconsum/Public/image/merchant/cardz-y.jpg" target="_blank">查看大图</a>正面
		            	</li>
		            	<li>
		            		<br />
		            		<div class="box-cardex"><img src="/cnconsum/Public/image/merchant/cardf-y.jpg" /></div>
		            		<a href="/cnconsum/Public/image/merchant/cardf-y.jpg" target="_blank">查看大图</a>反面
		            	</li>
		            	<li>
		            		<br />
		            		<div class="box-cardex"><img src="/cnconsum/Public/image/merchant/cardsc-y.jpg" /></div>
		            		<a href="/cnconsum/Public/image/merchant/cardsc-y.jpg" target="_blank">查看大图</a>手持照
		            	</li>
		            </ul>
		        </div>
		        <p class="msgbox box-msg-sfz">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>开户人</label>
	        <div>
	            <input type="text" name="carduser" id="carduser" class="boxtxt" placeholder="请输入开户本人姓名" value="<?php echo ($info["carduser"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>开户行</label>
	        <div>
	            <input type="text" name="cardbank" id="cardbank" class="boxtxt" placeholder="请输入开户行地址" value="<?php echo ($info["cardbank"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>银行账号</label>
	        <div>
	            <input type="text" name="cardaccount" id="cardaccount" class="boxtxt" placeholder="法人本人，目前仅支持建行储蓄卡"  value="<?php echo ($info["cardaccount"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1 margtop100">
	        <label>&nbsp;</label>
	        <div>
	            <input type="button" value="下一步" class="btn-sub" onclick="javascript:window.location.href='completeView_02';" />&nbsp;&nbsp;&nbsp;&nbsp;
	            <input type="submit" value="保存" class="btn-rs" />
	        </div>
	    </div>
	</div>
	</form>
</div>
<!--footer start-->
<div class="footer">
	<ul class="footbar">
		<li>咨询电话<br><span class="color53">400-876-5213</span></li>
		<li>微博账号<br><span class="color53">ggxc@cnconsum.com</span></li>
		<li>客服邮箱<br><span class="color53">kf@cnconsum.com</span></li>
		<li>公众号&nbsp;<img src="/cnconsum/Public/image/merchant/rqcode.png" /></li>
	</ul>
	<p class="aboutbar">
		<a href="">关于商消乐</a>|
		<a href="">常见问题</a>|
		<a href="">投诉举报</a>|
		<a href="">给商消乐提建议</a>
	</p>
	<p class="color38">©2016 nuomi.com 陕ICP证060807号 陕公网安备110105006181号 工商注册号1101080094</p>
</div>
<!--footer end-->
</body>
</html>