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
        <a href="../login/logout" class="maincolor">退出</a>
    </div>
</div>


<!--	资源文件	-->
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/workcenter.css">
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/select2.min.css">
<script src="/cnconsum/Public/js/merchant/select2.min.js"></script>
<script>
function changecard(tag){
	var val = $(tag).val();
	$('div[id^=card-]').hide();
	$('#card-'+val).show();
}
$(function(){
	$(".radio").click(function(){
		$('.radio span').attr('class','rbd');
		$(this).children('span').attr('class','rbd-c');
		var val = $('input[name=isgive]:checked').val();
		if(val == 2){
			$('#box-addamount').hide();
		}else{
			$('#box-addamount').show();
		}
	});
	$('#dropdown .lb-slct').click(function(event){
		event.stopPropagation();
		var lid = $(this).attr('data-target');
		$('#'+lid).toggle();
	});
	$('#dropdown ul li').click(function(){
		var val = $(this).attr('data-value');
		var name = $(this).attr('data-name');
		$('#dropdown .lb-slct p span').text(name);
		$('#dropdown .lb-slct input').val(val);
		$(this).parent().toggle();
	});
	$(document).click(function(event){
		$("#dropdown ul").hide(); 
	});
	$('select').select2({
		width: '90px',
		minimumResultsForSearch: -1
	});

	$('#submit').click(function(){
		var cardid = $('#cardid').val();
		cardid = $.trim(cardid);
		var cardprice = $('#cardprice').val();
		var format = $('#format').val();
		var checkval = $('input[name=isgive]:checked').val();
		var amount = $('#amount').val();
		var addamount = $('#addamount').val();
		var cardtype = $('#cardtype').val();
		var termvalid = $('#termvalid').val();
		var cardlever = $('#cardlever').val();
		var discount = $('#discount').val();
		var usenum = $('#usenum').val();
		var favour = $('#favour').val();
		
		if(cardid.length == 0){
			$('.form-msg').html('请填写会员卡编号！');
			return false;
		}
		if(cardtype == 1 && (isNaN(discount) || discount == 0)){
			$('.form-msg').html('请填写折扣率！');
			return false;
		}
		if(cardtype == 2 && (isNaN(usenum) || usenum == 0)){
			$('.form-msg').html('请填写使用次数！');
			return false;
		}
		if(isNaN(cardprice) || cardprice <= 0){
			$('.form-msg').html('请填写价格！');
			return false;
		}
		if(favour.trim().length == 0){
			$('.form-msg').html('请填写优惠内容！');
			return false;
		}
		if(format == 0){
			$('.form-msg').html('请选择版式！');
			return false;
		}
		if(checkval == 1){
			if(isNaN(addamount) || addamount == 0){
				$('.form-msg').html('请填写附赠金额！');
				return false;
			}
		}
		$('.form-msg').html('');
		var url = 'add';
		var subdata = {code:cardid,isgive:checkval,sum:amount,addition:addamount,type:cardtype,indate:termvalid,level:cardlever,discount:discount,usenum:usenum,price:cardprice,content:favour,format:format}
		formcheck(url, subdata, 'form-card');
		return false;
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
    	<div class="navinfo"><img src="/cnconsum/Public/image/merchant/info.png" />&nbsp;&nbsp;会员制管理</div>
        <div class="cinfo">
    		<form action="<?php echo ($action); ?>" method="post" id="form-card">
    		<div class="tbtit titpd1"><img src="/cnconsum/Public/image/merchant/add-lg.png" width="22" height="22" />&nbsp;添加会员卡</div>
    		<div class="tr-add cols2">
		        <label>&nbsp;会员卡编号：</label>
		        <div>
		            <input type="text" name="code" id="cardid" class="txtadd" style="width: 170px;" />
		        </div>
		    </div>
		    <div class="tr-add cols2">
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
		    <div class="tr-add cols2" style="display:none">
		        <label>金额：</label>
		        <div>
		            <input type="text" name="sum" id="amount" class="txtadd" style="width: 85px;" />
		        </div>
		    </div>
		    <div class="tr-add cols2" id="box-addamount">
		        <label>附赠金额：</label>
		        <div>
		            <input type="text" name="addition" id="addamount" class="txtadd" style="width: 85px;" />
		        </div>
		    </div>
		    <div class="tr-add cols2">
		        <label>会员卡类型：</label>
		        <div>
		        	<select name="type" id="cardtype" onchange="changecard(this)">
		            	<option value="1">储值卡</option>
		            	<option value="2">计次卡</option>
		           </select>
		        </div>
		    </div>
		    <div class="tr-add cols2">
		        <label>有效期：</label>
		        <div>
		        	<select name="indate" id="termvalid">
		            	<option value="0.5">半年</option>
		            	<option value="1">一年</option>
		            	<option value="2">两年</option>
		            	<option value="3">三年</option>
		            	<option value="0">无限期</option>
		           </select>
		        </div>
		    </div>
		    <div class="tr-add cols2">
		        <label>会员卡级别：</label>
		        <div>
		            <select name="level" id="cardlever">
				<option>普卡</option>
				<option>银卡</option>
				<option>金卡</option>
				<option>铂金卡</option>
		            	<option>黑金卡</option>
				<option>钻卡</option>
		            </select>
		        </div>
		    </div>
		    <div class="tr-add cols2" id="card-1">
		        <label>折扣率：</label>
		        <div>
		            <input type="text" name="discount" id="discount" class="txtadd" style="width: 50px;" />&nbsp;%
		        </div>
		    </div>
		    <div class="tr-add cols2" id="card-2" style="display: none;">
		        <label>使用次数：</label>
		        <div>
		            <input type="text" name="usenum" id="usenum" class="txtadd" style="width: 50px;" />
		        </div>
		    </div>
		    <div class="tr-add cols2">
		        <label>价格：</label>
		        <div>
		            <input type="text" name="price" id="cardprice" class="txtadd" style="width: 85px;" />
		        </div>
		    </div>
		    <div class="tr-add cols2">
		        <label>优惠内容：</label>
		        <div>
		            <input type="text" name="content" id="favour" class="txtadd" style="width: 140px;" />
		        </div>
		    </div>
		    <div class="tr-add fl">
		        <label>选择版式：</label>
		        <div>
		        	<div id="dropdown" class="box-format">
			        	<div class="lb-slct" data-target="fmlist">
			        		<p class="txt-slct"><span>卡片版式</span><label></label></p>
			        		<input type="hidden" name="format" id="format" value="0" />
			        	</div>
			        	<ul class="ul-slct" id="fmlist">
						
						<?php if(is_array($card_temp)): $i = 0; $__LIST__ = $card_temp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="li-fm clearfix" data-value="<?php echo ($list["color"]); ?>" data-name="版式0<?php echo ($list["id"]); ?>">
                                                        	<img src="/cnconsum/Public/Uploads/cardImage/<?php echo ($list["image"]); ?>" width="139" height="85" class="fl"  />
                                                        	<p class="box-fmn fl">
                                                                	<span>版式</span>
                                                                	<span class="writer">0<?php echo ($list["id"]); ?></span>
                                                        	</p>
                                                	</li><?php endforeach; endif; else: echo "" ;endif; ?>
		
			        	</ul>
		        	</div>
		        </div>
		    </div>
		    <div class="tr-add fl"  style="margin-top: 40px;">
		        <label>&nbsp;</label>
		        <div>
		        	<p class="form-msg">&nbsp;</p>
		        </div>
		    </div>
		    <div class="tr-add fl">
		        <label>&nbsp;</label>
		        <div>
		        	<input type="button" id="submit" class="btn-fsub" value="确定" />&nbsp;&nbsp;&nbsp;&nbsp;
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