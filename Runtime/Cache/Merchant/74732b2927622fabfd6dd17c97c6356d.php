<?php if (!defined('THINK_PATH')) exit();?><!--    页面头部        -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title><?php echo ($header["title"]); ?></title>
	<link rel="stylesheet" href="/cnconsum/Public/css/merchant/global.css">
	<script src="/cnconsum/Public/js/merchant/jquery-1.9.1.min.js"></script>
	<script src="/cnconsum/Public/js/zDrag.js" type="text/javascript"></script>
	<script src="/cnconsum/Public/js/zDialog.js" type="text/javascript"></script>
	<script src="/cnconsum/Public/js/merchant/script.js"></script>
	<script src="/cnconsum/Public/js/ajaxcheck.js"></script>
</head>

<body>

<div class="header-f" style="border: 0;">
    <img src="/cnconsum/Public/image/merchant/logo.png" width="119" height="48" />
    <span class="font22kai">商户中心</span>
    <div class="accountbar">
        <span class="uname">您好，<?php echo ($header["account"]); ?></span>
        <a href="" class="maincolor" style="display:none">账户设置</a>&nbsp;&nbsp;
        <a href="../merchant/logout" class="maincolor">退出</a>
    </div>
</div>


<!--	资源文件	-->
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/uploadify.css">
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/workcenter.css">
<script src="/cnconsum/Public/js/merchant/jquery.uploadify.min.js"></script>
<script src="/cnconsum/Public/js/merchant/upload.js"></script>
<script src="/cnconsum/Public/js/merchant/script.js"></script>
<script>
$(function(){
	$(".formatbar label *").click(function(){
		$(".formatbar label").attr('class','lb-fm');
		$(this).parents('label').attr('class','lb-fm-c');
		$(this).parents('label').find('input').attr('checked','checked');
	});
	
	$('#imgfile').uploadify({
		'width': 95,
		'height': 30,
		'buttonClass': 'btn-up1',
		'buttonText':'点击上传',
		'auto': true,
		'fileTypeExts'  : '*.jpg;*.jpge;*.gif;*.png',
		'fileSizeLimit' : '2MB',
		'queueID' : 'list1',
		'swf'      : '/cnconsum/Public/swf/uploadify.swf',
		'uploader' : '../upload/upload',
		//上传时携带的数据
                'formData' : { 'name' : '<?php echo ($img); ?>' , 'type' : 'merchantInfo'},

		'overrideEvents': ['onSelectError','onDialogClose'],
		'onSelectError':function(file, errorCode, errorMsg){
            switch(errorCode) {
                case -110:
                    alert("文件大小超出系统限制");
                    break;
                case -120:
                    alert("文件大小异常！");
                    break;
                case -130:
                    alert("文件类型不正确！");
                    break;
            }
        },
        'onUploadSuccess':function(file,data,response){
        	$('#list1').html('');
        	$('#picfile').val(1);
        	$('#imgview').attr('src','/cnconsum/Public/Uploads/merchantInfoImage/<?php echo ($img); ?>.png');
        }
	});
})
</script>

<div class="container clearfix">
	<!--        左侧菜单        -->
    <div class="menu">
        <h1 class="<?php echo ($press_vip?'msub':'no'); ?>">
		<a href="<?php echo ($menu["vip_href"]); ?>">
			<img src="/cnconsum/Public/image/merchant/huiyuan.png" class="icon-menu" />&nbsp;我的会员
		</a>
	</h1>

        <h1 class="<?php echo ($press_commodity?'msub':'no'); ?>">
		<a href="<?php echo ($menu["commodity_href"]); ?>">
			<img src="/cnconsum/Public/image/merchant/shangpin.png" class="icon-menu" />&nbsp;我的商品
		</a>
	</h1>

        <h1 onClick="showsubmenu(this)" class="<?php echo ($press_jszx?'msub':'no'); ?>">
		<img src="/cnconsum/Public/image/merchant/jiesuan.png" class="icon-menu" />&nbsp;结算中心
		<span class="ic-v">&gt;</span>
	</h1>

	<ul class="submenu" style="display:<?php echo ($fold_js?'block':'none'); ?>">
            <li><a href="<?php echo ($menu["qrcode"]); ?>" class="<?php echo ($press_qrcode?'xz':'no'); ?>">收款码</a></li>
            <li><a href="<?php echo ($menu["xjrz"]); ?>" class="<?php echo ($press_xjrz?'xz':'no'); ?>">现金入账</a></li>
        </ul>

        <h1 onClick="showsubmenu(this)" class="<?php echo ($press_ywzx?'msub':'no'); ?>">
		<img src="/cnconsum/Public/image/merchant/yewu.png" class="icon-menu" />&nbsp;业务中心
		<span class="ic-v">&gt;</span>
	</h1>
	
	
        <ul class="submenu" style="display: <?php echo ($fold_yw?'block':'none'); ?>">
            <li style='display:none'><a href="<?php echo ($menu["hyyq_href"]); ?>">会员延期</a></li>
            <li style='display:none'><a href="<?php echo ($menu["yycl_href"]); ?>">预约处理</a></li>
            <li><a href="<?php echo ($menu["ggts_href"]); ?>">广告推送</a></li>
            <li><a href="<?php echo ($menu["dpgl_href"]); ?>" class="<?php echo ($press_dpgl?'xz':'no'); ?>">店铺管理</a></li>
            <li><a href="<?php echo ($menu["zjtx_href"]); ?>" class="<?php echo ($press_zjtx?'xz':'no'); ?>">资金提现</a></li>
            <li><a href="<?php echo ($menu["glysz_href"]); ?>" class="<?php echo ($press_glysz?'xz':'no'); ?>">管理员设置</a></li>
            <li><a href="<?php echo ($menu["sjjs_href"]); ?>" class="<?php echo ($press_sjjs?'xz':'no'); ?>">商家介绍</a></li>
            <li><a href="<?php echo ($menu["hyzgl_href"]); ?>" class="<?php echo ($press_hyzgl?'xz':'no'); ?>">会员卡管理</a></li>
            <li><a href="<?php echo ($menu["sxed_href"]); ?>" class="<?php echo ($press_sxed?'xz':'no'); ?>">授信额度</a></li>
        </ul>

        <h1 onClick="showsubmenu(this)" class="<?php echo ($press_sjbb?'msub':'no'); ?>">
		<img src="/cnconsum/Public/image/merchant/idata.png" class="icon-menu" />&nbsp;数据报表
		<span class="ic-v">∨</span>
	</h1>

        <ul class="submenu" style="display:<?php echo ($fold_sj?'block':'none'); ?>">
            <li><a href="<?php echo ($menu["data_bk_href"]); ?>" class="<?php echo ($press_bk?'xz':'no'); ?>">办卡记录</a></li>
            <li><a href="<?php echo ($menu["data_xk_href"]); ?>" class="<?php echo ($press_xk?'xz':'no'); ?>">续卡记录</a></li>
	    <li><a href="<?php echo ($menu["data_sj_href"]); ?>" class="<?php echo ($press_xk?'xz':'no'); ?>">升级记录</a></li>
            <li><a href="<?php echo ($menu["data_xf_href"]); ?>" class="<?php echo ($press_xf?'xz':'no'); ?>">消费记录</a></li>
	    <li><a href="<?php echo ($menu["data_xj_href"]); ?>" class="<?php echo ($press_xj?'xz':'no'); ?>">现金记录</a></li>
        </ul>

        <h1 class="<?php echo ($press_account?'msub':'no'); ?>">
		<a href="<?php echo ($menu["account_href"]); ?>">
			<img src="/cnconsum/Public/image/merchant/zhanghu.png" class="icon-menu" />&nbsp;我的账户
		</a>
	</h1>
</div>

	
    <div class="con">
    	<p class="navinfo"><img src="/cnconsum/Public/image/merchant/isjjs.png" />&nbsp;&nbsp;商家介绍</p>
        <div class="cinfo" style="margin-top: 55px;">
    		<form action="../Imgtxt/add" method="post" id="form-infos">
    		<div class="tr-tal">
    			<label>选择版式：</label>
    			<div>
    				<div class="formatbar clearfix">
    					<label for="fm1" class="lb-fm-c">
    						<p class="fmbox">
    							<span class="fup">版式</span><br>
    							<span class="fdw">01</span><br>
    							<input type="radio" name="type" id="fm1" value="0" checked="checked" />
    						</p>
    						<p class="imgf">
    							<img src="/cnconsum/Public/image/merchant/bs01.gif" class="img-fm1" />
    							<span>商户是指有实体经营场所的商家；如知识营销、网络营销、绿色营销、个性化营销、创新营销、整合营销、消费联盟营销、等营销商家。 </span>
    						</p>
    					</label>
    					<label for="fm2" class="lb-fm">
    						<p class="fmbox">
    							<span class="fup">版式</span><br>
    							<span class="fdw">02</span><br>
    							<input type="radio" name="type" id="fm2" value="1" />
    						</p>
    						<p class="imgf">
    							<img src="/cnconsum/Public/image/merchant/bs02.gif" class="img-fm2" />
    							<span>商户是指有实体经营场所的商家；如知识营销、网络营销、绿色营销、个性化营销、创新营销、整合营销、消费联盟营销、等营销商家。 </span>
    						</p>
    					</label>
    					<label for="fm3" class="lb-fm">
    						<p class="fmbox">
    							<span class="fup">版式</span><br>
    							<span class="fdw">03</span><br>
    							<input type="radio" name="type" id="fm3" value="2" />
    						</p>
    						<p class="imgf">
    							<img src="/cnconsum/Public/image/merchant/bs03.gif" class="img-fm3" /><br>
    							<span>商户是指有实体经营场所的商家。</span>
    						</p>
    					</label>
    					<label for="fm4" class="lb-fm">
    						<p class="fmbox">
    							<span class="fup">版式</span><br>
    							<span class="fdw">04</span><br>
    							<input type="radio" name="type" id="fm4" value="3" />
    						</p>
    						<p class="imgf">
    							<img src="/cnconsum/Public/image/merchant/bs04.gif" class="img-fm4" />
    						</p>
    					</label>
    				</div>
    			</div>
		    </div>
		    <div class="tr-tal">
		        <label>上传图片：</label>
		        <div>
		        	<div class="box-up clearfix">
					<div class="box-up-intro">
						<div class="box-view">
							<img src="/cnconsum/Public/image/merchant/loadup.jpg" id="imgview" width="145" height="82" />
							<div id="list1" class="queuew"></div>
						</div>
						<div class="box-upbtn">
							<input id="imgfile" type="file" multiple="false">
							<input type="hidden" name="picfile" id="picfile" />
						</div>
					</div>
					</div>
		        </div>
		    </div>
		    <div class="tr-tal">
		        <label>简介：</label>
		        <div>
		            <textarea name="content" class="txtarea" rows="4" cols="42"></textarea>
			    <input name='image_url' value='<?php echo ($img); ?>.png' style="display:none"/>
		        </div>
		    </div>
		    <div class="tr-tal" style="margin-top: 50px;">
		        <label>&nbsp;</label>
		        <div>
		        	<input type="submit" class="btn-fsub" value="确定" />&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="button" class="btn-freset" value="返回" onclick="javascript:window.location='../Business/sjjs'" />
		        </div>
		    </div>
    		</form>
        </div>
    </div>
</div>

<!--    页面尾部        -->
<div class="footmagt">
</div>

<div class="footer">
        <ul class="footbar">
                <li>咨询电话<br><span class="color53">400-876-5213</span></li>
                <li>微博账号<br><span class="color53">ggxc@cnconsum.com</span></li>
                <li>客服邮箱<br><span class="color53">kf@cnconsum.com</span></li>
		<li style="width: 170px;">
			公众号&nbsp;
			<img src="/cnconsum/Public/image/merchant/rqcode.png" width="70" height="70" />
		</li>
		<li style="width: 170px;">
			下载链接&nbsp;
			<img src="/cnconsum/Public/image/merchant/download.jpg" width="70" height="70" />
		</li>
        </ul>
        <p class="aboutbar">
                <a href="">关于商消乐</a>|
                <a href="">常见问题</a>|
                <a href="">给商消乐提建议</a>
        </p>
        <p class="color38">©2016 cnconsun.com 京ICP备16045900号</p>
</div>

</body>
</html>