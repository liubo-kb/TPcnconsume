$('.musicButton').click(function(){
	$(".maskIndex").show();
})
/***点击进入游戏规则页面***/
$("#gameRule").click(function(){
		window.location="html/rulePage.html"
})

/***点击进入关卡页面***/
$("#gameLevel").click(function(){
		window.location="html/guanKa.html"
})


/******音乐调节确定按钮*****/
$(".sure").click(function(){
	$(".maskIndex").hide();
})


/*****关闭按钮***/

$("#close").click(function(){
	$(".maskIndex").hide();
})

/****设置音乐音量默认大小为50%****/
//document.getElementById('cd').volume=0.5;
/***音乐关闭按钮***/

$('.closeM').click(function(){
	var w=$('.closeM').width();
	var obj=$('.closeM .icon');
	if(obj.attr('btn')==1){
		$('.closeM').css("background","#D59B21");
		document.getElementById('cd').pause();
		obj.attr('btn','0');
		obj.animate({
			left:'-10px'
		},200)
	}else{
		$('.closeM').css("background","#93D617");
		document.getElementById('cd').play();
		obj.attr('btn','1');
		obj.animate({
			left:w-10
		},200)
	}
	
})

/***音效关闭按钮***/
$('.closeX').click(function(){
	var w=$('.closeX').width();
	var obj=$('.closeX .icon');
	if(obj.attr('btn')==1){
		$('.closeX').css("background","#D59B21");
		document.getElementById('cd').pause();
		obj.attr('btn','0');
		obj.animate({
			left:'-10px'
		},200)
	}else{
		$('.closeX').css("background","#93D617");
		document.getElementById('cd').play();
		obj.attr('btn','1');
		obj.animate({
			left:w-10
		},200)
	}
	
})

/***音量调节按钮**/
var isdrag=false; //移动标记开关
var _x;
document.getElementById("dong").addEventListener('touchend',function(){  
        sdrag = false;  
    });  
document.getElementById("dong").addEventListener('touchstart',selectmouse);  
document.getElementById("dong").addEventListener('touchmove',movemouse); 
function movemouse(e){   
	var $width=document.getElementById('lowOrUp').clientWidth;	
 	 if (isdrag){   
	   	var n = e.touches[0].pageX - _x;  
	   	if(n<0){
	   		n=0;
	   	}
	   	if(n>$width){
	   		n=$width;
	  	 }
	   	var $volume=n/$width;
	   	document.getElementById('cd').volume=$volume;
	  	$("#dong").css("left",n);  
	   	$(".bgJd").width( n);
	  	 return false;   
   }   
}   
function selectmouse(e){   
   isdrag = true;   
  // tx = parseInt(document.getElementById("moveid").style.left+0);   
   _x = e.touches[0].pageX-parseInt($("#dong").css("left"));    
   return false;   
}   

/****点击进入游戏按钮***/
$("#startGame").click(function(){
	window.location="html/guess.php";
})

$(".returnLogin").click(function(){
	window.location="html/login.html";
})

/***获取当前游戏数据***/
getGamePoss();
function getGamePoss() {
	var uuid = localStorage.getItem('uuid');
	$.post(
		'../../App/Extra/game/start', {
			"uuid": uuid
		},
		function(data) {
			var result = eval("(" + data + ")");
			if(result.current_num==0){
				$("#startGame").css("background-image","url(img/ks.png)");
			}else{
				$("#startGame").css("background-image","url(img/goGame.png)");
			}
		}
	);
}
