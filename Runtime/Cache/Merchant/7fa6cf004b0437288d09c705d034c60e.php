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
<link rel="stylesheet" href="/cnconsum/Public/css/workcenter.css">

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

        <h1>
		<span class="icon navitem ijs"></span>&nbsp;结算中心
		<span class="ic-v">&gt;</span>
	</h1>

        <h1 onClick="showsubmenu(this)">
		<span class="icon navitem iyw"></span>&nbsp;业务中心
		<span class="ic-v">&gt;</span>
	</h1>
	
	
        <ul class="submenu" style="display: none;">
            <li><a href="<?php echo ($menu["hyyq_href"]); ?>">会员延期</a></li>
            <li><a href="<?php echo ($menu["yycl_href"]); ?>">预约处理</a></li>
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
    <div class="con">
    	<p class="navinfo"><img src="/cnconsum/Public/image/isjbb.png" />&nbsp;&nbsp;数据报表</p>
        <div class="cmain">
        	<div class="cinfo1">
        		<p class="ftdt">
        			<label class="slct">
		            <select name="time">
		            	<option>今天</option>
		            </select>
		            </label>
		            <label class="pdlr1">金额：<span class="fnum">225.00</span>元</label>
		            <label>笔数：<span class="fnum">16</span>笔</label>
        		</p>
        	</div>
        	<hr class="hr-grey-mg" />
            <div class="cinfo" id="content" style="margin-top: 20px;">
            	<!--<table class ='gridtable' cellpadding = '10'>
				        <tr>
				                <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><th><?php echo ($head); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
				        </tr>
				        <?php if(is_array($table_data)): $i = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
								<?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i;?><td><?php echo ($data["$index"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</table>
				<div>
				        <?php echo ($page); ?>
				</div>-->
            	<table class="ctable">
                  <tr class="alt">
                  	<td><img src="/cnconsum/Public/image/user.gif" /></td>
                    <td>记录编号：TX1456054523 </td>
                    <td>消费日期：2016-11-03 14:20</td>
                    <td>18元</td>
                    <td><a href="datamore.html" class="abtn">详细信息</a></td>
                  </tr>
                  <tr>
                  	<td><img src="/cnconsum/Public/image/user.gif" /></td>
                    <td>记录编号：TX1456054523 </td>
                    <td>消费日期：2016-11-03 14:20</td>
                    <td>18元</td>
                    <td><a href="datamore.html" class="abtn">详细信息</a></td>
                  </tr>
                  <tr class="alt">
                  	<td><img src="/cnconsum/Public/image/user.gif" /></td>
                    <td>记录编号：TX1456054523 </td>
                    <td>消费日期：2016-11-03 14:20</td>
                    <td>18元</td>
                    <td><a href="datamore.html" class="abtn">详细信息</a></td>
                  </tr>
              </table>
            	<div class="page text-align-r margtop47">
            		<div>  
            			<a class="current">1</a>
            			<a class="num" onclick="javascript:dopage(&quot;2&amp;glysz&amp;glysz&quot;)">2</a>
            			<a class="next" onclick="javascript:dopage(&quot;2&amp;glysz&amp;glysz&quot;)">下一页</a>
            			  共5个管理员
            		</div>
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