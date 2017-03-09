<?php if (!defined('THINK_PATH')) exit();?><!--	页面头部	-->
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
    <span class="dot">●</span>
    <span class="font22kai">商户中心</span>
    <div class="accountbar">
        <span class="uname">您好，<?php echo ($header["account"]); ?></span>
        <a href="" class="maincolor">账户设置</a>&nbsp;&nbsp;
        <a href="" class="maincolor">退出</a>
    </div>
</div>


<!--	资源文件	-->
<link rel="stylesheet" href="/cnconsum/Public/css/member.css">
<script src="/cnconsum/Public/js/pages.js"></script>
<style>
body{
	background-color: fff;
}
</style>

<div class="container clearfix">
	<!--	左侧菜单	-->     	
    <div class="menu">
        <h1>
		<a href="<?php echo ($menu["vip_href"]); ?>">
			<span class="icon navitem ihy"></span>&nbsp;我的会员
		</a>
	</h1>

        <h1>
		<a href="<?php echo ($menu["commodity_href"]); ?>">
			<span class="icon navitem isp"></span>&nbsp;我的商品
		</a>
	</h1>

        <h1 onClick="showsubmenu(this)">
		<span class="icon navitem ijs"></span>&nbsp;结算中心
		<span class="ic-v">&gt;</span>
	</h1>

	<ul class="submenu" style="display:none">
            <li><a href="<?php echo ($menu["data_bk_href"]); ?>" class="xz">收款码</a></li>
            <li><a href="<?php echo ($menu["data_xk_href"]); ?>">现金入账</a></li>
        </ul>

        <h1 onClick="showsubmenu(this)">
		<span class="icon navitem iyw"></span>&nbsp;业务中心
		<span class="ic-v">&gt;</span>
	</h1>
	
	
        <ul class="submenu" style="display: none;">
            <li style='display:none'><a href="<?php echo ($menu["hyyq_href"]); ?>">会员延期</a></li>
            <li style='display:none'><a href="<?php echo ($menu["yycl_href"]); ?>">预约处理</a></li>
            <li><a href="<?php echo ($menu["ggts_href"]); ?>">广告推送</a></li>
            <li><a href="<?php echo ($menu["dpgl_href"]); ?>">店铺管理</a></li>
            <li><a href="<?php echo ($menu["zjtx_href"]); ?>" class="xz">资金提现</a></li>
            <li><a href="<?php echo ($menu["glysz_href"]); ?>">管理员设置</a></li>
            <li><a href="<?php echo ($menu["sjjs_href"]); ?>">商家介绍</a></li>
            <li><a href="<?php echo ($menu["hyzgl_href"]); ?>">会员制管理</a></li>
            <li><a href="<?php echo ($menu["sxed_href"]); ?>">授信额度</a></li>
        </ul>

        <h1 class="msub" onClick="showsubmenu(this)">
		<img src="/cnconsum/Public/image/idata.png" />&nbsp;数据报表
		<span class="ic-v">∨</span>
	</h1>

        <ul class="submenu">
            <li><a href="<?php echo ($menu["data_bk_href"]); ?>" class="xz">办卡记录</a></li>
            <li><a href="<?php echo ($menu["data_xk_href"]); ?>">续卡记录</a></li>
	    <li><a href="<?php echo ($menu["data_sj_href"]); ?>">升级记录</a></li>
            <li><a href="<?php echo ($menu["data_xf_href"]); ?>">消费记录</a></li>
	    <li><a href="<?php echo ($menu["data_xj_href"]); ?>">现金支付</a></li>
        </ul>

        <h1>
		<a href="<?php echo ($menu["account_href"]); ?>">
			<span class="icon navitem izh"></span>&nbsp;我的账户
		</a>
	</h1>
</div>
	
	
    <!--        页面内容        -->     
    <div class="con" id="content">

    	<table class ='ctable'>
				<tr>
						<?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><th style='width:120px'><?php echo ($head); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
				</tr>

				<?php if(is_array($table_data)): $i = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
						<?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i;?><td>
								<?php echo ($data["$index"]); ?>
							</td><?php endforeach; endif; else: echo "" ;endif; ?>
						<td><a class='abt' href="#">编辑</a></td>
						<td><a class='abt' href="#">删除</a></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		
		<div class="page text-align-r margtop47">
			<?php echo ($page); ?>
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
                <li>公众号&nbsp;<img src="/cnconsum/Public/image/rqcode.png" /></li>
        </ul>
        <p class="aboutbar">
                <a href="">关于商消乐</a>|
                <a href="">常见问题</a>|
                <a href="">投诉举报</a>|
                <a href="">给商消乐提建议</a>
        </p>
        <p class="color38">©2016 nuomi.com 陕ICP证060807号 陕公网安备110105006181号 工商注册号1101080094</p>
</div>

</body>
</html>