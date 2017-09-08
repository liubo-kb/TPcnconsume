$(function(){
	/***首次开始游戏***/
	getGamePoss();
	function getGamePoss(){
		var uuid=localStorage.getItem('uuid');
		$.post(
			'../../../App/Extra/game/start',
			{"uuid":uuid},
			function(data){
				var da=eval("("+data+")");
				console.log(da);
				cNum=Number(da.current_num)+1;
				shu(da);
				initAnswerLength(da.answer_length);
				numFlag();//题号标记
				passJd();//进度指示
				lxJudge(da.answer_type)//题目类型
			}
		);
	}
	
	/***题目请求***/
	function quest(){
		var uuid=localStorage.getItem('uuid');
		$.post(
			'../../../App/Extra/game/getQue',
			{"uuid":uuid},
			function(data){
				var da=eval("("+data+")");
				console.log(da)
				cNum=Number(da.current_num)+1;
				shu(da);
				initAnswerLength(da.answer_length);
				numFlag();//题号标记
				passJd();//进度指示
				lxJudge(da.answer_type);
			}
		);
	}
	
	/*****回答正确数据提交****/
	
	function submit(){
		var uuid=localStorage.getItem('uuid');
		$.post(
			'../../../App/Extra/game/accessCommit',
			{
				"uuid":uuid,
				"use_tool":ues_tool
			},
			function(data){
				var da=eval("("+data+")");
				sjJudge(da);
				//isNinety(cNum);
				
			}
		);
		
		$.post( //判断积分的变化，是否通关
			'../../../App/Extra/game/getQue',
			{"uuid":uuid},
			function(data){
				var re=eval("("+data+")");
				if(re.current_num<50){ 
					if(re.current_integral>=90){
						window.location="redPacket.html";
					}
					$(".reward").html(re.current_integral-jf_flag);
				}else{
					$(".MaskLayer").hide();
					$('.sj').hide();
					$(".failMask").show();
				}
			}
		);
	}
	
	
	
	/***渲染页面中的数据***/
	function shu(obj){
		var num=Number(obj.current_num)+1;
		$('#clip').html(num);
		optionsArr=obj.options;
		answer=obj.answer;
		jf_flag=obj.current_integral;
		$('#daan').html(answer);
		$(".imgTip img").attr('src',obj.answer_image);
		$('.kaTxt img').attr('src',obj.cnt_level.cnt_txt);
		$('.kaImg img').attr('src',obj.cnt_level.cnt_img);
		$("#integral").html(obj.current_integral);
		var sArr=$('.footer span');
		for(var i=0;i<optionsArr.length;i++){
			sArr[i].innerHTML=optionsArr[i];
		}
	}
	
	
	/****初始化答案li****/
	
	function initAnswerLength(num){
		var oUl=$(".answer ul");
		if(arr.length!=0){
			arr=[];
			oUl.html("");
		}
		for(var i=0;i<num;i++){
			oUl.append("<li a="+i+"></li>");
			var aA={$index:'',con:''};
			arr.push(aA);
			
		}
	}
	var optionsArr=[]; //答案选项数组
	var answer;//接受后台返回的正确答案
	var arr=[];//答案暂存数组
	var cNum;
	var ues_tool="no";//是否点击答案按钮直接获得答案
	var jf_flag;//本地积分显示
	
	$(".footer span").click(function(){ //答案选项点击
		var index=getFirstBlank(arr);
		var ss=$(this).html();
		var $index=$(".footer span").index(this);
		arr[index].$index=$index;
		arr[index].con=ss;
		for(var j=0;j<arr.length;j++){
			if(arr[j].con!=""){
				$(".answer li").eq(j).html(arr[j].con);
			}
		}
		console.log(arr)
		$(this).css("visibility","hidden");
		pa();
	})
	
	
	function getFirstBlank(){//获取答案框中第一个空白的位置
		for(var i=0;i<arr.length;i++){
			if(arr[i].con==''){
				return i;
			}
		}
	}
	
	$(".answer ul").on('click','li',function(){  
        var b=$(this).attr('a');
		arr[b].con='';
		$(".footer span").eq(arr[b].$index).css("visibility","visible");
		$(this).html('');
		pa();  
   })  
	
	/*****判断答题是否成功****/
	function pa(){
		if(pd()){
			$(".footer span").addClass("disabled");
			var str='';
			for(var i=0;i<arr.length;i++){
				str+=arr[i].con;
			}
			if(str==answer){
				submit();
				if((Number($('#clip').html())%10!=0)&&(cNum<=50)){
					$(".MaskLayer").show();
				}
				ues_tool="no";
			}else{
				errTip(500,1500);
			}
			str='';
			
		}else{
			$(".footer span").removeClass("disabled");
			$(".answer li").css("color","#000");
		}
	}
	
	
	/***答错文字闪烁提示***/
	function errTip(p,t){
		var a;
		var iTimer=setInterval(function(){
			(typeof a) === 'undefined' ? a = 0 : a++;
		    $(".answer li").css("color",['red', 'black'][a% 2]);
		    if (a > t / p)
		    {
			    clearInterval (iTimer);
			    delete iTimer;
		    }
		},p)
	}
	
	
	/*******返回上一页按钮点击事件******/
	
	$('#return').click(function(){
		window.location='../index.html';
	})
	
	/****点击答案按钮事件***/
	$(".tAnswer").click(function(){
		if(Number($("#integral").html())>=4){//判断是否有足够的积分来使用答案功能
			$(".answeMask").show();
		}else{
			$(".isTip").show();
		}
	});
	
	/****点击求助按钮事件***/
	$(".tHple").click(function(){
		$(".helpMask").show();
	});
	
	/****点击提示按钮事件***/
	$(".tButton").click(function(){
		if(Number($("#integral").html())>=2){ //判断是否有足够的积分使用提示按钮
			$(".tipMask").show();
		}else{
			$(".isTip").show();
		}
	});
	
	/***提示弹窗取消关闭***/
	$("#tipQxBtn").click(function(){
		$(".tipMask").hide();
	})
	/***提示弹窗确定提示***/
	$('#tipSureBtn').click(function(){
		var str="";
		for(var i=0;i<arr.length;i++){
				str+=arr[i].con;
		}
		if(str.length==arr.length){
			for(var i=0;i<arr.length;i++){
				arr[i].con='';
				$(".footer span").eq(arr[i].$index).css("visibility","visible");
			}
			for(var j=0;j<optionsArr.length;j++){
					if(optionsArr[j]==answer[0]){
						arr[0].$index=j;
						arr[0].con=answer[0];
						$(".footer span").eq(j).css("visibility","hidden");
						break;
					}
			}

		}else{
			var index=getFirstBlank(arr);
				for(var j=0;j<optionsArr.length;j++){
					if(optionsArr[j]==answer[index]){
						arr[index].$index=j;
						arr[index].con=answer[index];
						$(".footer span").eq(j).css("visibility","hidden");
						break;
					}
				}
				
		}
		for(var j=0;j<arr.length;j++){
			$(".answer li").eq(j).html(arr[j].con);	
		}
		$(".tipMask").hide();
		tipAnswer();
		pa();	
	})
	
	
	/****点击答案弹窗确定事件***/
	$("#answerBtnQx").click(function(){
		$(".answeMask").hide();
	})
	
	$('#answerBtnSure').click(function(){//答案按钮直接获得答案确定
		
		for(var i=0;i<arr.length;i++){
			for(var s=0;s<optionsArr.length;s++){
				if(optionsArr[s]==answer[i]){
					arr[i].$index=s;
					arr[i].con=answer[i];
					$(".footer span").eq(s).css("visibility","hidden");
				}
			}
		}
		aaa();//将正确的答案放在答案框中
		ues_tool="yes";
		$(".answeMask").hide();
		pa();//判断是否正确
		
		
		
	})
	
	function aaa(){ //将正确的答案放在答案框中
		for(var i=0;i<arr.length;i++){
			$(".answer li").eq(i).html(arr[i].con);
		}
	}
	
	/****点击求助按钮事件***/
	$("#helpQxBtn").click(function(){
		$(".helpMask").hide();
	});
	
	/****下一题按钮事件***/
	$('.nextQ').click(function(){
		for(var i=0;i<arr.length;i++){
			arr[i].$index='';
			arr[i].con='';
			$(".answer li").eq(i).html('');
		}
		$(".footer span").css("visibility","visible");
		$(".footer span").removeClass('disabled');
		quest();
		passJd();
		$('.MaskLayer').hide();
	})
	
	
	function sjJudge(obj){//升级判断函数
		if(obj.state=="yes"){
			$('.sj').show();
			$('.sjImg').css("background-image","url("+obj.upg_img+")");
			$('.sjHc').css("background-image","url("+obj.upg_txt+")");
		}
	}
	
	/*****升级弹窗事件***/
	
	$("#sjGo").click(function(){
		for(var i=0;i<arr.length;i++){
			arr[i].$index='';
			arr[i].con='';
			$(".answer li").eq(i).html('');
		}
		$(".footer span").css("visibility","visible");
		$(".footer span").removeClass('disabled');
		quest();
		$('.sj').hide();
	});
	
	/****升级弹窗分享按钮****/
	$("#sjShare").click(function(){
		$('.sj').hide();
		for(var i=0;i<arr.length;i++){
			arr[i].$index='';
			arr[i].con='';
			$(".answer li").eq(i).html('');
		}
		$(".footer span").css("visibility","visible");
		$(".footer span").removeClass('disabled');
		quest();
		$('.helpMask').show();
		$(".helpCon").hide();
		$(".guideShare").show();
	});
	/****进度条****/
	
	function passJd(){
		var length=$('#pross').width();
		if(Number($('#clip').html())<=10){
			var n=Number($('#clip').html())*0.1;	
		}else{
			if(Number($('#clip').html())%10!=0){
				var n=Number($('#clip').html())%10*0.1;
			}else{
				var n=1;
			}
			
		}
		setTimeout(function(){
			$(".passJd").width(length*n);
		},1000)
		
	}
	
	/****题号标记,进度条题号标记****/
	function numFlag(){
		var lo=Number($('#clip').html());
		if(lo<=10){
			$("#numNow").html(lo);
		}else if(lo>10&&lo%10!=0){
			var i=lo%10;
			$("#numNow").html(i);
		}else if(lo>10&&lo%10==0){
			lo=10;
			$("#numNow").html(lo);
		}
	}
	
	
	
	/****50题成功的判断函数***/
	function isNinety(num){
		if(num==50){
			window.location='prize.html';
		}
	}
	
	
	/*****答案框判断***/
	
	function pd(){
		var cr="";
		for(var i=0;i<arr.length;i++){
			cr+=arr[i].con;
		}
		if(cr.length==arr.length){
			return true;
		}
	}
	
	/****类型判断***/
	function lxJudge(s){
		var sss;
		if(s=="cy"){
			sss="成语";
		}else if(s=="jz"){
			sss="建筑";
		}else if(s=="mrmx"){
			sss="名人明星";
		}else if(s=="sjpp"){
			sss="商标品牌"
		}else if(s=="csgj"){
			sss="城市国家"
		}else{
			sss="影视";
		}
		$("#leixing").html(sss);
	}
	
	
	/***提示按钮积分问题****/
	function tipAnswer(){
		var uuid=localStorage.getItem('uuid');
		$.post(
			'../../../App/Extra/game/use_tip',
			{"uuid":uuid},
			function(data){
				console.log(data);
				var re=eval("("+data+")")
				$("#integral").html(re.current_integral);
			}
		);
	}
	
	/******闯关失败重置题目接口**********/
	
	function reQuest(){
		var uuid=localStorage.getItem('uuid');
		console.log(uuid)
		$.post(
			'../../../App/Extra/game/resetQue',
			{"uuid":uuid},
			function(data){
				quest();
			}
		);
	}
	
	
	/*****题目重置************/
	$("#repeatGame").click(function(){
		$(".reMask").show();
	});
	$(".reBtnQx").click(function(){
		$(".reMask").hide();
	});
	$(".reBtnSure").click(function(){
		reQuest();
		$(".reMask").hide();
	});
	$(".onceMore").click(function(){
		reQuest();
		$(".failMask").hide();
	});
	
	/*****积分不够确定按钮***/
	$(".isTipOrAn").click(function(){
		$(".isTip").hide();
	})
		
	/*****求助按钮确定*********/
	$("#helpSureBtn").click(function(){
		$(".guideShare").show();
		$(".helpCon").hide();
		//share(data);
		return false;
	});
	
	
	/*****分享数据****/
	var data={
 			"title":"1234567890",
 			"link":"http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/乐山大佛.png",
 			"desc":"这就是一次尝试",
 			"imgUrl":"http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/乐山大佛.png",
 			"success":function(){
 				$(".helpMask").hide();
 			},
 			"cancel":function(){
 				alert("取消");
 			}
 		}
	
	/******取消强制分享**********/
	$(".helpMask").click(function(){
		var kkkk=$(".guideShare").css("display");
		if(kkkk=="block"){
			$(".helpMask").hide();
			$(".helpCon").show();
			$(".guideShare").hide();
		}
	});
	
	
	/*****回答正确分享按钮***/
	$(".share").click(function(){
		$(".helpMask").show();
		$(".helpCon").hide();
		$(".guideShare").show();
	});
});
