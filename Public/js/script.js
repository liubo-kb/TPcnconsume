$(function(){
	$('.clearinput').click(function(){
		$(this).parent().find('input[type=text]').val('');
	});
});
function showsubmenu(tag){
	var m = $(tag).next('ul');
	var status = $(m).css('display');
	if(status == 'none'){
		$(tag).addClass('msub');
		$(tag).children('.ic-v').html('∨');
		$(m).show();	
	}else{
		$(tag).removeClass('msub');
		$(tag).children('.ic-v').html('&gt;');
		$(m).hide();	
	}
}
function showtime(tagid){
	var time = new Date();
	var Y = time.getFullYear();
	var m = time.getMonth()+1;
	if(m < 10) m = '0'+m;
	var d = time.getDate();
	if(d < 10) d = '0'+d;
	var H = time.getHours();
	if(H < 10) H = '0'+H;
	var i = time.getMinutes();
	if(i < 10) i = '0'+i;
	var s = time.getSeconds();
	if(s < 10) s = '0'+s;
	$('#'+tagid).text(Y+'-'+m+'-'+d+' '+H+':'+i+':'+s);
}
function setInputVal(fromid, toid){
	var val = $('#'+fromid).html();
	$('#'+toid).val(val);
}
function suredel(msg){
	Dialog.confirm(msg,function(){  });
}
function changeTab(name,cursel,n,hclass,classn){
	for(i=1;i<=n;i++){
		var tab = document.getElementById(name+i);
		var con=document.getElementById(name+'-con-'+i);
		if(i==cursel){
			tab.className = hclass;
			con.style.display = "block"; 
		}else{
			tab.className = classn; 
			con.style.display="none"; 
		}
		
		if(cursel == 1)
		{
			$('#check').val('contact');
		}
		else
		{
			$('#check').val('house');
		}
	}
}


window.onload = function(){
	  var phone = document.getElementById("phone");
	  var code = document.getElementById("code");
	  var password = document.getElementById("password");
	  var repassword = document.getElementById("repassword");
      var recommend = document.getElementById("recommend");
	  clear_phone.onclick = function(){
	  phone.value="";
	  }
	  clear_code.onclick = function(){
	  code.value="";
	  }
	  clear_password.onclick = function(){
	  password.value="";
	  }
	  clear_repassword.onclick = function(){
	  repassword.value="";
	  }
	  clear_recommend.onclick = function(){
	  recommend.value="";
	  }
 }

function register() {
	 
		var ph = $("#phone").val();
        var co = $("#code").val();
		var ps = $("#password").val();
		var reps = $("#repassword").val();
		var rd = $("#recommend").val();
		var msg_alet_phone = document.getElementById("msg_alet_phone");
		var msg_alet_code = document.getElementById("msg_alet_code");
		var msg_alet_password = document.getElementById("msg_alet_password");
		var msg_alet_repassword = document.getElementById("msg_alet_repassword");
		var msg_alet_recommend = document.getElementById("msg_alet_recommend");
		msg_alet_phone.style.display = 'none';
		msg_alet_code.style.display = 'none';
		msg_alet_password.style.display = 'none';
		msg_alet_repassword.style.display = 'none';
		msg_alet_recommend.style.display = 'none';
		 if (ph == "") {
			 $("#msg_alet_phone").html("请输入已验证手机号"); 
			  msg_alet_phone.style.display = 'block';
			  return false;
					 }
			 if(co == ""){
						 $("#msg_alet_code").html("请输入短信验证码"); 
			              msg_alet_code.style.display = 'block';
						   return false;
						 }
			 if(ps == ""){
						 $("#msg_alet_password").html("请输入密码"); 
			              msg_alet_password.style.display = 'block';
						   return false;
							 }
			 if(reps == ""){
						   $("#msg_alet_repassword").html("请输入重复密码"); 
			                msg_alet_repassword.style.display = 'block';
						     return false;
							 }		 
			  if(rd == ""){
						   $("#msg_alet_recommend").html("请输入推荐人"); 
			                 msg_alet_recommend.style.display = 'block';
						      return false;
							 }		 
			 msg_alet_phone.style.display = 'none';
			 msg_alet_code.style.display = 'none';
			 msg_alet_password.style.display = 'none';
			 msg_alet_repassword.style.display = 'none';
			 msg_alet_recommend.style.display = 'none';
			 return false;
}
