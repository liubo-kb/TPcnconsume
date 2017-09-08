<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>快速认证</title>
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
var para1 = {
		'account':		'<?php echo ($account); ?>',
		'type':			'license',
		'upload_id':	'cfile1',
		'img_id':		'imgview1',
		'bar_id':		'queue1',
		'check_id':		'licensefile'
	};
config(para1);

var para7 = {
		'account':		'<?php echo ($account); ?>',
		'type':			'add',
		'upload_id':	'cfile7',
		'img_id':		'imgview7',
		'bar_id':		'queue7',
		'check_id':		'placefile'
};
config(para7);


$("#distpicker").distpicker({
                province: "<?php echo ($info["province"]); ?>",
                city: "<?php echo ($info["city"]); ?>",
                district: "<?php echo ($info["district"]); ?>"
        });

$('input[type=text]').placeholder();
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
		<p>快速认证</p>
		<a href="../login/view">返回登录页</a>
	</div>
	
	<form action="complete_quick" method="post" id="form-reginfo-">

		<!--姓名-->    
		<div class="con-step1">
			<div class="tr-step1">
				<label><span>*&nbsp;</span>姓名</label>
	        <div>
				<input type="text" name="phone" value="<?php echo ($phone); ?>" style="display:none"/>
	            <input type="text" name="name" id="uname" class="boxtxt" placeholder="请输入您的真实姓名" value="<?php echo ($info["name"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
		
		
	    <!--身份证号码-->        
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>身份证号</label>
	        <div>
	            <input type="text" name="id" id="cardid" class="boxtxt" placeholder="请输入真实有效的18位身份证号码" value="<?php echo ($info["id"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
		
		
	    <!--店铺地址-->
		<div class="tr-step1">
	        <label><span>*&nbsp;</span>店铺地址</label>
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
	            <input type="text" name="location" id="adress" class="boxtxt" placeholder="请输入您现在具体店铺地址" value="<?php echo ($info["location"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	   </div>
		
		
	    <!--单位名称-->
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>店铺名称</label>
	        <div>
			<input type="text" name="phone" value="<?php echo ($phone); ?>" style="display:none"/>
	            <input type="text" name="store" id="bname" class="boxtxt" placeholder="单位名字全称" value="<?php echo ($info["store"]); ?>"/>
	            <span class="clearinput">×</span>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
		
		
	    <!--店铺电话-->
        <div class="tr-step1">
                <label><span>*&nbsp;</span>店铺电话</label>
                <div>
                    <input type="text" name="store_number" id="bname" class="boxtxt" placeholder="店铺联系方式" value="<?php echo ($info["store_number"]); ?>"/>
                    <span class="clearinput">×</span>
                    <p class="msgbox">&nbsp;</p>
                </div>
            </div>
			
			
	    <!--所属行业-->
	   <div class="tr-step1">
	        <label><span>*&nbsp;</span>所属行业</label>
	        <div>
	        	<label class="box-select">
		        	<select name="trades" id="industry">
					<option >请选择</option>	
					<?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data["trade"] == $info["trade"] ): ?><option selected="selected"><?php echo ($data["trade"]); ?></option>
						<?php else: ?>
							 <option><?php echo ($data["trade"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
		        	</select>
	        	</label>
	        	<p class="msgbox">&nbsp;</p>
	        </div>
	   </div>
		
		
	   	<!--营业执照-->
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>营业执照</label>
	        <div>
	            <div class="box-info wid390">
	            	<p class="tit-b4">请您上传清晰、无污物、完整的证件原件照片或彩色扫描件。</p>
	            	<div class="box-upf clearfix">
	            		<label>
	            			营业执照照片
	            			<div class="picview">
	            				<img src="<?php echo ($info["license_src"]); ?>" id="imgview1" />
	            				<div id="queue1" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile1" type="file" multiple="false">
									<?php if( $info["license_src"] == $default_src ): ?><input type="hidden" name="licensefile" id="licensefile" />
									<?php else: ?>
									<input type="hidden" name="licensefile" id="licensefile" value="uploaded"/><?php endif; ?>
				            </div>
	            		</label>
	            		<label class="label-eg">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/yyzz.jpg" class="img-eg" /><br />
		            		营业执照&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/yyzz.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            	</div>
	            </div>
	        </div>
	    </div>
	    
		
		<!--经营场地照片-->
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>经营场地照片</label>
	        <div>
	            <div class="box-info wid390">
	            	<p class="tit-b4">请您上传清晰、无污物、完整的证件原件照片或彩色扫描件。</p>
	            	<div class="box-upf clearfix">
	            		<label>
	            			门头正面照片
	            			<div class="picview">
	            				<img src="<?php echo ($info["add_src"]); ?>" id="imgview7" />
	            				<div id="queue7" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile7" type="file" multiple="false">
						<?php if( $info["add_src"] == $default_src ): ?><input type="hidden" name="placefile" id="placefile" />
						<?php else: ?>
							<input type="hidden" name="placefile" id="placefile" value="uploaded"/><?php endif; ?>
				            </div>
	            		</label>
	            		<label class="label-eg">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/place.jpg" class="img-eg" /><br />
		            		正面照片&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/place.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            	</div>
	            </div>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
		
		<!-- 保存按钮 -->
	    <div class="tr-step1 margtop100">
	        <label>&nbsp;</label>
	        <div>
	            <input type="submit" value="保存" class="btn-quick"/>
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
		<li>公众号&nbsp;<class="bs" src="/cnconsum/Public/img/rqcode.png" /></li>
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