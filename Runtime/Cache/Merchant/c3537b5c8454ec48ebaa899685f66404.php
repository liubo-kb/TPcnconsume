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


<script src="/cnconsum/Public/js/merchant/jquery.uploadify.min.js"></script>
<script src="/cnconsum/Public/js/merchant/upload.js"></script>
<script src="/cnconsum/Public/js/merchant/script.js"></script>
<script src="/cnconsum/Public/js/merchant/formcheck.js"></script>
<style>
body{
	background-color: #e5e5e5;
}
</style>
<script>
$(function(){

	/*$("#distpicker").distpicker({
                province: "<?php echo ($info["province"]); ?>",
                city: "<?php echo ($info["city"]); ?>",
                district: "<?php echo ($info["district"]); ?>"
        });
	
	$('input[type=text]').placeholder();
	*/

	var para1 = {
		'account':		'<?php echo ($account); ?>',
		'type':			'license',
		'upload_id':	'cfile1',
		'img_id':		'imgview1',
		'bar_id':		'queue1',
		'check_id':		'licensefile'
	};
	config(para1);
	
	var para2 = {
		'account':		'<?php echo ($account); ?>_01',
		'type':			'tenancy',
		'upload_id':	'cfile2',
		'img_id':		'imgview2',
		'bar_id':		'queue2',
		'check_id':		'pacts'
	};
	config(para2);
	
	var para3 = {
		'account':		'<?php echo ($account); ?>_02',
		'type':			'tenancy',
		'upload_id':	'cfile3',
		'img_id':		'imgview3',
		'bar_id':		'queue3',
		'check_id':		'pacte'
	};
	config(para3);
	
	var para4 = {
		'account':		'<?php echo ($account); ?>_01',
		'type':			'house',
		'upload_id':	'cfile4',
		'img_id':		'imgview4',
		'bar_id':		'queue4',
		'check_id':		'proves'
	};
	config(para4);
	
	var para5 = {
		'account':		'<?php echo ($account); ?>_02',
		'type':			'house',
		'upload_id':	'cfile5',
		'img_id':		'imgview5',
		'bar_id':		'queue5',
		'check_id':		'provee'
	};
	config(para5);
	
	var para6 = {
		'account':		'<?php echo ($account); ?>',
		'type':			'lp',
		'upload_id':	'cfile6',
		'img_id':		'imgview6',
		'bar_id':		'queue6',
		'check_id':		'photofile'
	};
	config(para6);
	
	var para7 = {
		'account':		'<?php echo ($account); ?>',
		'type':			'add',
		'upload_id':	'cfile7',
		'img_id':		'imgview7',
		'bar_id':		'queue7',
		'check_id':		'placefile'
	};
	config(para7);
	
	var para8 = {
		'account':		'<?php echo ($account); ?>',
		'type':			'wep',
		'upload_id':	'cfile8',
		'img_id':		'imgview8',
		'bar_id':		'queue8',
		'check_id':		'billfile'
	};
	config(para8);
	
	
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
		<p>完善信息</p>
		<a href="login.html">返回登录页</a>
	</div>
	
	<div class="stepbar">
		<label><img src="/cnconsum/Public/image/merchant/step1.png" /><span class="maincolor">店主信息</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step2-h.png" /><span class="maincolor">店铺信息</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step3.png" /><span class="color53">完成</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step.png" /></label>
	</div>
	<form action="complete_02" method="post" id="form-reginfo-">
	<div class="con-step1">
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
	            <input type="text" name="explain" id="license" class="boxtxt" placeholder="如无营业执照，请填写情况说明" value='<?php echo ($info["explain"]); ?>'/>
	            <span class="clearinput">×</span>
	            <p class="msgbox" id="license-error">&nbsp;</p>
	        </div>
	    </div>
	    <!--租赁合同 房产证明-->
	    <div class="tr-step1">
	        <label>
	        	<div class="nav-up">
				<?php if( $info["check"] == 'house' ): ?><span class="btn-f" id="pact1" onclick="changeTab('pact',1,2,'btn-f-s','btn-f')">租赁合同</span>
	        		<span class="btn-f-s" id="pact2" onclick="changeTab('pact',2,2,'btn-f-s','btn-f')">房产证明</span>
				<?php else: ?>
				<span class="btn-f-s" id="pact1" onclick="changeTab('pact',1,2,'btn-f-s','btn-f')">租赁合同</span>
                                <span class="btn-f" id="pact2" onclick="changeTab('pact',2,2,'btn-f-s','btn-f')">房产证明</span><?php endif; ?>
	        		<p>*</p>
	        	</div>
	        </label>
	        <!--租赁合同-->
		<?php if( $info["check"] == 'contact' ): ?><div id="pact-con-1">
		<?php elseif( $info["check"] == 'house' ): ?>
		<div id="pact-con-1" style="display: none;">
		<?php else: ?>
		<div id="pact-con-1"><?php endif; ?>
	            <div class="box-info box-larg">
	            	<p class="tit-b4">请您上传清晰、无污物、完整的证件原件照片或彩色扫描件。</p>
	            	<div class="box-upf clearfix">
	            		<label>
	            			租赁合同首页
	            			<div class="picview">
	            				<img src="<?php echo ($info["tenancy_01_src"]); ?>" id="imgview2" />
	            				<div id="queue2" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile2" type="file" multiple="false">
						<?php if( $info["tenancy_01_src"] == $default_src ): ?><input type="hidden" name="pacts" id="pacts" />
						<?php else: ?>
							<input type="hidden" name="pacts" id="pacts" value="uploaded"/><?php endif; ?>
				            </div>
	            		</label>
	            		<label>
	            			租赁合同尾页
	            			<div class="picview">
	            				<img src="<?php echo ($info["tenancy_02_src"]); ?>" id="imgview3" />
	            				<div id="queue3" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile3" type="file" multiple="false">
						<?php if( $info["tenancy_02_src"] == $default_src ): ?><input type="hidden" name="pacte" id="pacte" />
						<?php else: ?>
							<input type="hidden" name="pacte" id="pacte" value="uploaded"/><?php endif; ?>
				            </div>
	            		</label>
	            		<label class="label-eg margleft20">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/packs.jpg" class="img-eg" /><br />
		            		首页&nbsp;&nbsp;&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/packs.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            		<label class="label-eg">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/packe.jpg" class="img-eg" /><br />
		            		尾页&nbsp;&nbsp;&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/packe.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            	</div>
	            </div>
	            <p class="msgbox" id="pact-error">&nbsp;</p>
	        </div>
	        <!--房产证明-->
	        <?php if( $info["check"] == 'house' ): ?><div id="pact-con-2">
                <?php else: ?>
                <div id="pact-con-2" style="display: none;"><?php endif; ?>
	            <div class="box-info box-larg">
	            	<p class="tit-b4">请您上传清晰、无污物、完整的证件原件照片或彩色扫描件。</p>
	            	<div class="box-upf clearfix">
	            		<label>
	            			房产证明首页
	            			<div class="picview">
	            				<img src="<?php echo ($info["house_01_src"]); ?>" id="imgview4" />
	            				<div id="queue4" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile4" type="file" multiple="false">
						<?php if( $info["house_01_src"] == $default_src ): ?><input type="hidden" name="proves" id="proves" />
						<?php else: ?>
							 <input type="hidden" name="proves" id="proves" value="uploaded"/><?php endif; ?>
				            </div>
	            		</label>
	            		<label>
	            			房产证明尾页
	            			<div class="picview">
	            				<img src="<?php echo ($info["house_02_src"]); ?>" id="imgview5" />
	            				<div id="queue5" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile5" type="file" multiple="false">
						<?php if( $info["house_02_src"] == $default_src ): ?><input type="hidden" name="provee" id="provee" />
						<?php else: ?>
							<input type="hidden" name="provee" id="provee" value="uploaded"/><?php endif; ?>	
				            </div>
	            		</label>
	            		<label class="label-eg margleft20">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/fczs.jpg" class="img-eg" /><br />
		            		首页&nbsp;&nbsp;&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/fczs.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            		<label class="label-eg">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/fcze.jpg" class="img-eg" /><br />
		            		尾页&nbsp;&nbsp;&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/fcze.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            	</div>
	            </div>
	            <p class="msgbox" id="prove-error">&nbsp;</p>
	        </div>
	    </div>
	    <!--法人照片-->
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>法人照片</label>
	        <div>
	            <div class="box-info wid390">
	            	<p class="tit-b4">请您上传清晰、无污物、完整的证件原件照片或彩色扫描件。</p>
	            	<div class="box-upf clearfix">
	            		<label>
	            			法人正面照片
	            			<div class="picview">
	            				<img src="<?php echo ($info["lp_src"]); ?>" id="imgview6" />
	            				<div id="queue6" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile6" type="file" multiple="false">
						<?php if( $info["lp_src"] == $default_src ): ?><input type="hidden" name="photofile" id="photofile" />
						<?php else: ?>
							<input type="hidden" name="photofile" id="photofile" value="uploaded"/><?php endif; ?>
				            </div>
	            		</label>
	            		<label class="label-eg">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/photo.jpg" class="img-eg" /><br />
		            		正面照片&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/photo.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            	</div>
	            </div>
	            <p class="msgbox">&nbsp;</p>
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
	    <!--营业电水电票-->
	    <div class="tr-step1">
	        <label><span>*&nbsp;</span>营业电水电票</label>
	        <div>
	            <div class="box-info wid390">
	            	<p class="tit-b4">请您上传清晰、无污物、完整的证件原件照片或彩色扫描件。</p>
	            	<div class="box-upf clearfix">
	            		<label>
	            			水电票据照片
	            			<div class="picview">
	            				<img src="<?php echo ($info["wep_src"]); ?>" id="imgview8" />
	            				<div id="queue8" class="upqueue"></div>
	            			</div>
		            		<div class="btn-up">
		            			<input id="cfile8" type="file" multiple="false">
						<?php if( $info["wep_src"] == $default_src ): ?><input type="hidden" name="billfile" id="billfile" />
						<?php else: ?>
							<input type="hidden" name="billfile" id="billfile" value="uploaded"/><?php endif; ?>
				            </div>
	            		</label>
	            		<label class="label-eg">
	            			示例：<br />
		            		<img src="/cnconsum/Public/image/merchant/bill.jpg" class="img-eg" /><br />
		            		正面照片&nbsp;&nbsp;<a href="/cnconsum/Public/image/merchant/bill.jpg" class="mcl" target="_blank">查看大图</a>
	            		</label>
	            	</div>
	            </div>
		    <input type="hidden" name="check" id="check" value="contact"/>
	            <p class="msgbox">&nbsp;</p>
	        </div>
	    </div>
	    <div class="tr-step1 margtop100">
	        <label>&nbsp;</label>
	        <div>
	            <input type="button" value="下一步" class="btn-sub" onclick="javascript:window.location.href='completeView_03';" />&nbsp;&nbsp;&nbsp;&nbsp;
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