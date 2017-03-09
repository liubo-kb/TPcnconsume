<?php if (!defined('THINK_PATH')) exit();?><!--	页面头部	-->
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title><?php echo ($header["title"]); ?></title>
	<link rel="stylesheet" href="/cnconsum/Public/css/merchant/global.css">
	<script src="/cnconsum/Public/js/merchant/jquery-1.9.1.min.js"></script>
	<script src="/cnconsum/Public/js/merchant/script.js"></script>
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
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/select2.min.css">
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/workcenter.css">
<script src="/cnconsum/Public/js/merchant/pages.js" type="text/javascript"></script>
<script src="/cnconsum/Public/js/merchant/select.js" type="text/javascript"></script>
<script src="/cnconsum/Public/js/merchant/select2.min.js" type="text/javascript"></script>
<script>
$(function(){
	$('select').select2({
		width: '90px',
		minimumResultsForSearch: -1
	});
})
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
	
	
    <!--        页面内容        -->     
    <div class="con">
    	<p class="navinfo"><img src="/cnconsum/Public/image/merchant/isjbb.png" />&nbsp;&nbsp;办卡记录</p>
        <div class="cmain">
        	<div class="cinfo1">
        		<p class="ftdt">
		            <select name="time" id="date_select" onchange="dateChange('data_bk')">
		            	<?php if(is_array($date_type_list)): $i = 0; $__LIST__ = $date_type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data == $date_type ): ?><option value="<?php echo ($data); ?>" selected="selected"><?php echo ($text["$data"]); ?></option>
						<?php else: ?>
							 <option value="<?php echo ($data); ?>"><?php echo ($text["$data"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
		            </select>
		            <label class="pdlr1">金额：<span class="fnum"><?php echo ($sum); ?></span>元</label>
		            <label>笔数：<span class="fnum"><?php echo ($num); ?></span>笔</label>
        		</p>
        	</div>
        	<hr class="hr-grey-mg" />
            <div class="cinfo" id="content" style="margin-top: 20px;">
				<table class ='ctable'>
				
					<tr>
						<?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><th><?php echo ($head); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
					</tr>
					
					<?php if(is_array($table_data)): $i = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
							<?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i; if($index == 'user'): elseif($index == 'merchant'): ?>
								<?php elseif($index == 'headimage'): ?>
									<td>
										<img class="img-data" src='/cnconsum/Public/Uploads/headImage/<?php echo ($data["$index"]); ?>'/>
									</td>
								<?php else: ?>
									<td>
										<?php echo ($data["$index"]); ?>
									</td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							<td><a class='abtn' href="data_detail?table=bk&user=<?php echo ($data["user"]); ?>&merchant=<?php echo ($data["merchant"]); ?>&datetime=<?php echo ($data["datetime"]); ?>">详细信息</a></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					
				</table>
		
				<div class="page text-align-r margtop47">
					<?php echo ($page); ?>
				</div>
				
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