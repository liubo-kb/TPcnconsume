<?php if (!defined('THINK_PATH')) exit();?><!--	页面头部	-->
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
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/workcenter.css">
<script>
        $('#form-pickcash').submit(function(){
                var balance = $('#balance').val();

                if(isNaN(balance) || balance <= 0){
                        $('.form-msg').html('请填写提取余额（例如：1000.00）！');
                        return false;
                }
                $('.form-msg').html('');
                return false;
        });
</script>

<div class="container clearfix">

    <!--	左侧菜单	-->
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


    <!--	页面内容	-->
    <div class="con">
    	<p class="navinfo"><img src="/cnconsum/Public/image/merchant/zjtx.png" />&nbsp;&nbsp;资金提现</p>
        <div class="cmain">
        	<div class="cinfo1">
        		<div class="tr-mbt ftdt">
            		账户余额：&nbsp;&nbsp;<span class="fnum"><?php echo ($data["remain"]); ?></span>&nbsp;&nbsp;元
            	</div>
	            <div class="mgsx">
	            	<a href="../withdraw/txmx" class="abtn-op">账单明细</a>
	            </div>
	            <div class="ftdt">
	            	<label class="pdr"><img src="/cnconsum/Public/image/merchant/ibzj.png"  class="img-zjtx" />&nbsp;保证金：<span class="numl"><?php echo ($data["deposit"]); ?></span>元</label>
	            	<label class="pdr"><img src="/cnconsum/Public/image/merchant/ijlje.png"  class="img-zjtx" />&nbsp;奖励金额：<span class="numl"><?php echo ($data["award"]); ?></span>元</label>
	            </div>
	        </div>
	        <hr class="hr-grey" />
	        <div class="cinfo1" style="margin-top: 0;">
            	<form action="../withdraw/withdraw" method="post" id="form-pickcash">
            	<p class="ftdt">提取余额到银行卡：</p>
            	<div class="mgsx1">
            		<span class="ftdt">提取余额：</span>&nbsp;<input type="text" name="sum" id="balance" value="" style="width: 165px;" class="txtdb" />&nbsp;&nbsp;元<br>
            		<p class="fcl paddleft85">
	            		余额：<span id="money"><?php echo ($data["remain"]); ?></span>元，&nbsp;&nbsp;&nbsp;
	            		<span style="cursor: pointer;" class="maincolor" onclick="setInputVal('money','balance')">全部提取</span>
            		</p>
            	</div>
            	<p class="fcl mgb20">银行卡：<?php echo ($data["bank"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;尾号（<?php echo ($data["account"]); ?>）</p>
            	<p class="ftdt">预计3个工作日内到账</p>
            	<div style="margin: 50px 0;">
            		<p class="form-msg" style="margin-bottom: 10px;">&nbsp;</p>
            		<input type="submit" value="确定" class="btn-fsub" />&nbsp;&nbsp;&nbsp;&nbsp;
                	<input type="reset" class="btn-freset" value="取消" />
            	</div>
            	</form>
	        </div>
        </div>
    </div>
</div>

<!--	页面尾部	-->
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