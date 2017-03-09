<?php if (!defined('THINK_PATH')) exit();?><!--    页面头部        -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title><?php echo ($header["title"]); ?></title>
	<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
	<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
	<script src="/cnconsum/Public/js/script.js"></script>
</head>

<body>

<div class="header-f" style="border: 0;">
    <img src="/cnconsum/Public/image/logo.png" width="119" height="48" />
    <span class="font22kai">商户中心</span>
    <div class="accountbar">
        <span class="uname">您好，<?php echo ($header["account"]); ?></span>
        <a href="" class="maincolor" style="display:none">账户设置</a>&nbsp;&nbsp;
        <a href="../merchant/logout" class="maincolor">退出</a>
    </div>
</div>


<!--	资源文件	-->
<link rel="stylesheet" href="/cnconsum/Public/css/select2.min.css">
<link rel="stylesheet" href="/cnconsum/Public/css/workcenter.css">
<script src="/cnconsum/Public/js/select2.min.js"></script>
<script>
$(function(){
	$(".radio").click(function(){
		$('.radio span').attr('class','rbd');
		$(this).children('span').attr('class','rbd-c');
	});
	
	$('#form-card').submit(function(){
		var cardid = $('#cardid').val();
		cardid = $.trim(cardid);
		var cardprice = $('#cardprice').val();
		var cardfile = $('#cardfile').val();
		
		if(cardid.length == 0){
			$('.form-msg').html('请填写会员卡编号！');
			return false;
		}
		if(isNaN(cardprice) || cardprice <= 0){
			$('.form-msg').html('请填写价格！');
			return false;
		}
		if(cardfile.length == 0){
			$('.form-msg').html('请上传卡片！');
			return false;
		}
		$('.form-msg').html('');
		return false;
	});
	$('select').select2({
		width: '90px',
		minimumResultsForSearch: -1
	});
})
</script>

<div class="container clearfix">
	<!--        左侧菜单        -->
    <div class="menu">
        <h1 class="<?php echo ($press_vip?'msub':'no'); ?>">
		<a href="<?php echo ($menu["vip_href"]); ?>">
			<img src="/cnconsum/Public/image/huiyuan.png" class="icon-menu" />&nbsp;我的会员
		</a>
	</h1>

        <h1 class="<?php echo ($press_commodity?'msub':'no'); ?>">
		<a href="<?php echo ($menu["commodity_href"]); ?>">
			<img src="/cnconsum/Public/image/shangpin.png" class="icon-menu" />&nbsp;我的商品
		</a>
	</h1>

        <h1 onClick="showsubmenu(this)" class="<?php echo ($press_jszx?'msub':'no'); ?>">
		<img src="/cnconsum/Public/image/jiesuan.png" class="icon-menu" />&nbsp;结算中心
		<span class="ic-v">&gt;</span>
	</h1>

	<ul class="submenu" style="display:<?php echo ($fold_js?'block':'none'); ?>">
            <li><a href="<?php echo ($menu["qrcode"]); ?>" class="<?php echo ($press_qrcode?'xz':'no'); ?>">收款码</a></li>
            <li><a href="<?php echo ($menu["xjrz"]); ?>" class="<?php echo ($press_xjrz?'xz':'no'); ?>">现金入账</a></li>
        </ul>

        <h1 onClick="showsubmenu(this)" class="<?php echo ($press_ywzx?'msub':'no'); ?>">
		<img src="/cnconsum/Public/image/yewu.png" class="icon-menu" />&nbsp;业务中心
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
		<img src="/cnconsum/Public/image/idata.png" class="icon-menu" />&nbsp;数据报表
		<span class="ic-v">∨</span>
	</h1>

        <ul class="submenu" style="display:<?php echo ($fold_sj?'block':'none'); ?>">
            <li><a href="<?php echo ($menu["data_bk_href"]); ?>" class="<?php echo ($press_bk?'xz':'no'); ?>">办卡记录</a></li>
            <li><a href="<?php echo ($menu["data_xk_href"]); ?>" class="<?php echo ($press_xk?'xz':'no'); ?>">续卡记录</a></li>
	    <li><a href="<?php echo ($menu["data_sj_href"]); ?>" class="<?php echo ($press_xk?'xz':'no'); ?>">升级记录</a></li>
            <li><a href="<?php echo ($menu["data_xf_href"]); ?>" class="<?php echo ($press_xf?'xz':'no'); ?>">消费记录</a></li>
	    <li><a href="<?php echo ($menu["data_xj_href"]); ?>" class="<?php echo ($press_xj?'xz':'no'); ?>">现金入账</a></li>
        </ul>

        <h1 class="<?php echo ($press_account?'msub':'no'); ?>">
		<a href="<?php echo ($menu["account_href"]); ?>">
			<img src="/cnconsum/Public/image/zhanghu.png" class="icon-menu" />&nbsp;我的账户
		</a>
	</h1>
</div>

	
    <div class="con">
    	<div class="navinfo"><span class="icon tititem ihy1"></span>&nbsp;&nbsp;会员卡管理</div>
        <div class="cinfo">
    		<form action="xxx.html" method="post" id="form-card">
    		<div class="tbtit titpd1"><img src="/cnconsum/Public/image/add-lg.png" width="22" height="22" />&nbsp;<?php echo ($operate); ?></div>
    		<div class="tr-add">
		        <label><span>*</span>&nbsp;会员卡编号：</label>
		        <div>
		            <input type="text" name="cardid" id="cardid" class="txtadd" style="width: 170px;" />
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>会员卡类型：</label>
		        <div>
		        	<label class="slct">
		            <select name="cardtype">
		            	<option>储值卡</option>
		            </select>
		            </label>
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>会员卡级别：</label>
		        <div>
		        	<label class="slct">
		            <select name="cardlever">
		            	<option>金卡</option>
		            </select>
		            </label>
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>价格：</label>
		        <div>
		            <input type="text" name="cardprice" id="cardprice" class="txtadd" style="width: 85px;" />
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>是否赠送金额：</label>
		        <div>
		        	<label class="radio" for="isgive1">
						<span class="rbd-c"><input type="radio" name="isgive" value="1" id="isgive1" checked="checked" /></span>&nbsp;&nbsp;是
					</label>
					<label class="radio" for="isgive2">
						<span class="rbd"><input type="radio" name="isgive" value="2" id="isgive2" /></span>&nbsp;&nbsp;否
					</label>
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>金额：</label>
		        <div>
		            <input type="text" name="amount" id="amount" class="txtadd" style="width: 85px;" />
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>折扣率：</label>
		        <div>
		            <input type="text" name="discount" id="discount" class="txtadd" style="width: 50px;" />&nbsp;%
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>优惠内容：</label>
		        <div>
		            <input type="text" name="favour" id="favour" class="txtadd" style="width: 140px;" />
		        </div>
		    </div>
		    <div class="tr-add">
		        <label><?php echo ($tip); ?>：</label>
		        <div>
		        	<input id="imgfile" type="file" multiple="false">
					<div id="list1" class="upqueue"></div>
					<input type="hidden" name="cardfile" id="cardfile" />
		        </div>
		    </div>
		    <div class="tr-add">
		        <label>&nbsp;</label>
		        <div>
		        	<p class="form-msg">&nbsp;</p>
		        </div>
		    </div>
		    <div class="tr-add" style="margin-top: 40px;">
		        <label>&nbsp;</label>
		        <div>
		        	<input type="submit" class="btn-fsub" value="确定" />&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="button" class="btn-freset" value="取消" onclick="javascript:window.location='hyzgl.html'" />
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
			<img src="/cnconsum/Public/image/rqcode.png" width="70" height="70" />
		</li>
		<li style="width: 170px;">
			下载链接&nbsp;
			<img src="/cnconsum/Public/image/download.jpg" width="70" height="70" />
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