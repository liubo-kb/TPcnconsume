<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册信息</title>
<link href=" /cnconsum/Public/css/page.css" rel="stylesheet" type="text/css"> 
<link href=" /cnconsum/Public/css/nlogin.css" rel="stylesheet" type="text/css"> 
<link href="/cnconsum/Public/css/register.css" rel="stylesheet" type="text/css"> 
<style type="text/css">
#tabs ul li{background:#fff;cursor:pointer;float:left;list-style:none;height:20px;line-height:20px;border:1px solid #aaaaaa;display:inline-block;width:135px;text-align: center;margin-top: 27px;color: white;background-color:#e26666}
.hide{display: none;}
.on{margin-left:140px
	}
	
</style>
<script type="text/javascript">
         window.onload = function(){
             var re_num1 = document.getElementById("re1");
			 var re_num2 = document.getElementById("re2");
			 var re_num3 = document.getElementById("re3");
			 var re_ct1 = document.getElementById("ct1");
			 var re_ct2 = document.getElementById("ct2");
			 var re_ct3 = document.getElementById("ct3");
			 re_num1.onclick = function(){
				 re_num1.style.backgroundColor="#e26666";
				 re_num1.style.color="white";
				 re_num2.style.backgroundColor="#FFF";
				 re_num2.style.color="#000";
				 re_num3.style.backgroundColor="#FFF";
				 re_num3.style.color="#000";
				 re_ct1.style.display = 'block';
				 re_ct2.style.display = 'none';
				 re_ct3.style.display = 'none';
				 }
		      re_num2.onclick = function(){
				 re_num2.style.backgroundColor="#e26666";
				 re_num2.style.color="white";
				 re_num1.style.backgroundColor="#FFF";
				 re_num1.style.color="#000";
				 re_num3.style.backgroundColor="#FFF";
				 re_num3.style.color="#000";
				 re_ct2.style.display = 'block';
				 re_ct1.style.display = 'none';
				 re_ct3.style.display = 'none';
				 }
			  re_num3.onclick = function(){
				 re_num3.style.backgroundColor="#e26666";
				 re_num3.style.color="white";
				 re_num1.style.backgroundColor="#FFF";
				 re_num1.style.color="#000";
				 re_num2.style.backgroundColor="#FFF";
				 re_num2.style.color="#000";
				 re_ct3.style.display = 'block';
				 re_ct1.style.display = 'none';
				 re_ct2.style.display = 'none';
				 }
             
         }
    </script>
</head>

<body>
<div class="w" style="width: 990px;
    margin: 0 auto;
    margin-top: 0px;
    margin-right: auto;
    margin-bottom: 0px;
    margin-left: auto;">
        <div id="logo">
          
                <img src="/cnconsum/Public/image/logo_header.jpg" alt="商城" width="170" height="60">
                
                <a style="margin-left:712px;cursor:pointer;color:#000">了解更多</a><b>|</b>
               <a style="color:#000;cursor:pointer"">反馈意见</a>
              
            </a>
            <b></b>
         </div>
         <div id = "content"style="width: 990px;height:700px;border: 1px #ddd solid;margin-top:15px;margin-bottom:30px">
         <div style="width:990px;height:20px;background-color:#e26666">
        <a style="color:#FFF;margin-left:20px;margin-top:10px;
">欢迎注册商消乐！</a>
         </div>
         <div style="width:700px;height:400px;height: 679px; border: 1px #ddd solid;text-align:center;">
         <div id="tabs">
    <ul>
        <li class="on" id="re1">请填写店主信息</li>
        <li class="info1" id="re2" style="background-color:#FFF;color:#000;">请填写店铺信息</li>
        <li class="info2" id="re3" style="background-color:#FFF;color:#000;">注册完成</li>
    </ul>
    <div style="line-height: 25px;padding:70px;" id="ct1">
        <div id="register" style = "margin-top:10px; ">
         <span class="label" ><b style="color:#e40011;position: absolute;margin-left:-135px;">* </b><b style="margin-left:-124px">昵称</b></span>
        <input type="text" style="width:150px;margin-left:28px;position:absolute" id="username" name="username" class="text" tabindex="1" placeholder="长度不超过6位"> 
        </div>
         <div id="register" style = "margin-top:10px; ">
        <span class="label"><b style="color:#e40011;position: absolute;margin-left:-123px">* </b><b style="margin-left:-112px">推荐人</b></span>
        <input type="text" style="width:150px;margin-left:17px;position:absolute" id="username" name="username" class="text" tabindex="1" placeholder=""> 
        </div>
         <div id="register" style = "margin-top:10px; ">
       <span class="label" ><b style="color:#e40011;position: absolute;margin-left:-132px">* </b><b style="margin-left:-121px">姓名</b></span>
        <input type="text"  style="width:150px;margin-left:30px;position:absolute" id="username" name="username" class="text" tabindex="1" placeholder="请输入你的真实姓名"> 
        </div>
         <div id="register" style = "margin-top:10px;margin-left: 41px; ">
       <span class="label"><b style="color:#e40011;position: absolute;margin-left:-149px">* </b><b style="margin-left:-140px">住宅地址</b></span>
        <input type="text" id="username" style="width:172px;position:absolute;margin-left:7px" name="username" class="text" tabindex="1" placeholder="请输入你现在具体住宅地址"> 
        </div>
        <div id="register" style = "margin-top:10px;margin-left: 107px; ">
       <span class="label"><b style="color:#e40011;position:absolute;margin-left:-9px">* </b><b style="margin-right:205px;">身份证号</b></span>
        <input type="text" id="username" style="width:195px;position:absolute;margin-left:-199px"name="username" class="text" tabindex="1" placeholder="请输入真实有效的18位身份证号"> 
        </div>
          <div id="register" style = "margin-top:10px;margin-left: 107px; ">
       <span class="label" ><b style="color:#e40011;position:absolute;margin-left:-6px">* </b><b style="margin-right:211px;">上传图片</b></span>
        <input type="text" id="username" style="margin-left:-201px;width:230px;position:absolute" name="username"  class="text" tabindex="1" placeholder="你的照片仅用于审核，我们将严格保密"> 
        </div>
          <div id="register" style = "margin-top:10px;margin-left: 135px; ">
       <img src="/cnconsum/Public/image/sf_01.jpg" />
       <img src="/cnconsum/Public/image/sf_02.jpg" style="margin-left:5px" />
       <img src="/cnconsum/Public/image/sf_03.jpg" style="margin-left:5px" /> 
        </div>
     <div id="register" style = "margin-top:10px;margin-left: 8px; ">
       <span class="label" ><b style="color:#e40011;position:absolute;margin-left:-8px;">* </b><b style="margin-right:113px;">开户行</b></span>
        <input type="text" id="username" style="margin-left:-96px;position:absolute;width:150px" name="username" class="text" tabindex="1" placeholder="请输入开户行地址"> 
        </div>
   
     <div id="register" style = "margin-top:10px;margin-left: 111px; ">
   <span class="label"><b style="color:#e40011;position:absolute;margin-left:-9px;">* </b><b style="margin-right:206px;">银行账号</b></span>
    <input type="text" id="username" name="username" style="width:220px;position:absolute;margin-left:-199px;" class="text" tabindex="1" placeholder="法人本人，目前仅支持建行存储卡"> 
    </div>
		    
	     <div class="submit">
			
				<button type="submit"  class="J_Submit" tabindex="3" id="J_SubmitStatic" style="background-color:#e26666;width:68px;margin-top:34px;cursor:pointer;border:#e26666 solid 3px;margin-left:-25px;position:absolute"><b style="color:#FFF">下一步</b></button>
               <button type="submit" style="background-color:#a6a6a6; cursor:pointer; border:3px solid #a6a6a6 ;width:68px; margin-left:95px;position:absolute;margin-top:34px;" class="J_register" tabindex="3" id="J_register" ><b style="color:#FFF">保存</b></button>
			</div>
     </div>       
            
    <div  id="ct2" class="hide"  style="line-height: 25px;padding:70px;">
       <div id="register" style = "margin-top:10px;margin-right: 70px; ">
   <span class="label" ><b style="color:#e40011;">* </b>当前地区</span>
    <input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" placeholder="  陕西省西安市雁塔区"> 
    </div>
        <div id="register" style = "margin-top:10px; margin-right: 70px; ">
   <span class="label" ><b style="color:#e40011;">* </b>详细地址</span>
    <input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" placeholder="  单位地址"> 
    </div>
        <div id="register" style = "margin-top:10px; margin-right: 70px; ">
   <span class="label" ><b style="color:#e40011;">* </b>单位名称</span>
    <input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" placeholder="  单位名字全称"> 
         </div>
     <div id="register" style = "margin-top:10px;margin-right:132px ">
   <span class="label"  ><b style="color:#e40011">* </b>所属行业</span>
    <select name="select" id="select_k1" class="xla_k">
    <option value="请选择">请选择</option>
    <option value="互联网">互联网</option>
    <option value="医疗">医疗</option>
     </div>
     </select>
        <div id="register" style = "margin-top:10px;margin-left:146px;">
    <span class="label" ><b style="color:#e40011;">* </b>营业执照</span>
    <input type="text" style="width:200px" id="username" name="username" class="text" tabindex="1" placeholder="  如无营业执照,请填写情况说明"> 
        </div>
    <div id="register" style = "margin-top:10px;margin-left: -75px;">
   <p><input class="yanzhen"  style="width: 65px;background-color:#e40011;border:3px solid #e40011;margin-left:139px;" name="bnt1" type="button" value="有" /></p>
   <input class="yanzhen" style="margin-top: 5px;width: 65px;background-color:#a6a6a6;border: 3px solid #a6a6a6;margin-left:139px" name="bnt1" type="button" value="无" />
    </div>
    <img src="/cnconsum/Public/image/yyzz.jpg" style="position:absolute;margin-top: -53px; right: 675px;" />
     <div id="register" style = "margin-top:65px;margin-left: -159px;">
        <p><span class="label" ><b style="color:#e40011;position:absolute;margin-left:135px">* </b></span><input class="yanzhen"  style="width: 80px;margin-left:144px;background-color:#e40011;border:3px solid #e40011"name="bnt1" type="button" value="租赁合同" /></p>
   <input class="yanzhen" style="margin-top: 5px;margin-left:145px;width: 80px;background-color:#a6a6a6;border: 3px solid #a6a6a6;" name="bnt1" type="button" value="房产证明" />
     </div>
    <div style="position:absolute;margin-left:270px;margin-top:-57px">
     <img src="/cnconsum/Public/image/zlht_01.jpg" />
     <img src="/cnconsum/Public/image/zlht_02.jpg" /></div>
     
     
     
<div id="register" style = "margin-top:60px;margin-left: 160px;
    position: absolute;">
       
   <span class="label" ><b style="color:#F00;">*</b>法人照片</span>
   <span class="label" ><b style="color:#F00;margin-left:90px">*</b>经营场地照片</span>
   <span class="label" ><b style="color:#F00;margin-left:83px">*</b>营业地水电票</span>
    </div>
     <div id="register" style = "margin-top:100px;margin-left: 161px;
    position: absolute;">
    <img src="/cnconsum/Public/image/fr.jpg" />
    <img src="/cnconsum/Public/image/jycd.jpg" style="margin-left:14px" />
    <img src="/cnconsum/Public/image/sdpj.jpg" style="margin-left:10px" />
    
    </div>
	     <div class="submit" style="position: absolute;
    margin-top: 183px;
    margin-left: 193px;">
			
				<button type="submit"  class="J_Submit" tabindex="3" id="J_SubmitStatic" style="background-color:#e26666;width:68px;margin-top:34px;cursor:pointer;border:#e26666 solid 3px;margin-left:-25px;position:absolute"><b style="color:#FFF">下一步</b></button>
               <button type="submit" style="background-color:#a6a6a6; cursor:pointer; border:3px solid #a6a6a6 ;width:68px; margin-left:95px;position:absolute;margin-top:34px;" class="J_register" tabindex="3" id="J_register" ><b style="color:#FFF">保存</b></button>
			</div>


    </div>
    </div>
       <div class="hide" id="ct3" style="line-height: 25px;padding:70px;">
    <div id="register" style = "margin-top:10px; ">
   <span class="label" ><p><b style="color:#F00;">* </b>紧急联系人（直属亲属）</p></span>
   <span>姓名</span>
    <input type="text" style="width:80px" id="username" name="username" class="text" tabindex="1" > 
    <span style="margin-left:20px">手机</span>
    <input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" > 
    </div>
    <div id="register" style = "margin-top:10px; ">
   <span class="label" ><p><b style="color:#F00;">* </b>紧急联系人（直属亲属）</p></span>
   <span >姓名</span>
    <input type="text" style="width:80px" id="username" name="username" class="text" tabindex="1" > 
    <span style="margin-left:20px">手机</span>
    <input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" > 
    </div>
    <div id="register" style = "margin-top:10px; ">
   <span class="label" ><p><b style="color:#F00;">* </b>紧急联系人（直属亲属）</p></span>
   <span>姓名</span>
    <input type="text" style="width:80px" id="username" name="username" class="text" tabindex="1" > 
    <span style="margin-left:20px">手机</span>
    <input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" > 
    </div>
<div id="register" style = "margin-top:10px; ">
   <span class="label" >备注：授权该公司在联系不到本人的情况下可联络本人紧急联络人。</span>
   
    </div>
         <div class="submit">
                <button type="submit" style="cursor:pointer" id="J_register" class="next_text">
                <a style="color:#FFF;">立即注册</a>
                </button>
			</div>
         <div id="appendchk"  style="margin-top:15px;" class="lg_remember">
                          <label><input type="checkbox" value="1" name="remember" class="check" ><span> <b>我已阅读并同意商消乐</b><a style="color:#09F"><商户使用协议></a></span></label>
                         
                      </div>
                      </div>
                      </div>
                       </div>
    <div class="phone" style="position: absolute;
        width: 190px;
        height: 335px;
        no-repeat -1px -142px;
        right: 235px;
        top: 246px;">
   
            <div style="background-image:url(image/logo-footer1.jpg);;height:50px;background-repeat:no-repeat;"  target="_blank"></div>
           <div style="background-image:url(image/logo-footer2.jpg);;height:50px;margin-top: 20px;background-repeat:no-repeat;"  target="_blank"></div>
           <div style="background:url(image/logo-footer3.jpg);;height:90px;margin-top: 20px;margin-left: 5px;background-repeat:no-repeat;"  target="_blank"></div>

        </div>
</body>
</html>