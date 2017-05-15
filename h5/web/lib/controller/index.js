var module = angular.module('app.controllers', []);
module.controller('ctrl', ['$scope', '$location',
	function($scope, $location) {

		/*		返回上一页		*/
		$scope.back = function() {
			window.history.back();
		}

		/*   返回我的          */
		
		$scope.goShow =function(){
			$location.path('/tab/myshow');
		}
		
		/*****跳转设置个人资料*****/
		
		$scope.goSet=function(str){
			$scope.item = str;
			//console.log($scope.item);
			$location.path('/setuser');
		}
		
	}

]);




/***************************************************商铺详情页*********************************************/

module.controller('factsCtrl',['$scope','$http','$ionicActionSheet','$ionicPopup', '$timeout',function($scope,$http,$ionicActionSheet,$ionicPopup,$timeout){
	
	var add = window.location.hash;
	console.log(add);
	var str = add.indexOf('s');
	console.log(str);
	var a = add.substr(str+2);
	console.log(a);
	
	function init(){
		var data={
    			muid:a
    		},
    		
		url='../../App/MerchantType/merchant/infoGet',
	
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
			
  
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.storeInfo=response;
    			$scope.str=$scope.storeInfo.store_number;
    			console.log($scope.storeInfo)
		});
		
		$scope.show=function(str){
		var hideSheet = $ionicActionSheet.show({
			cancelOnStateChange: true,
			cssClass: 'action_s',
			titleText: '拨打电话',
			buttons: [
				{
					text: $scope.str
				}
			],
			cancelText: '',
			cancel: function() {
				// add cancel code..
				return true;
			},

			destructiveText: '取消',
			destructiveButtonClicked: function() {

				var x;
				var r = confirm("去意已决吗？");
				if(r == true) {
					x = "你按下了\"确定\"按钮!";
					return true;
				} else {
					x = "你按下了\"取消\"按钮!";
				}
				document.getElementById("demo").innerHTML = x;

			},

			buttonClicked: function() {
				return true;
			}
		});
	}
		
		
	}
	
	init();
	
	function init2(){
		var data={
    			muid:a
    		},
    		
		url='../../App/MerchantType/Info/get',
	
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
			
  
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.godMust=response;
    			console.log($scope.godMust)
		});
	}
	
	init2();
	
	
	 // Triggered on a button click, or some other target
         $scope.showPopup = function() {
           $scope.data = {}

           // 自定义弹窗
           var myPopup = $ionicPopup.show({
            
             subTitle: '已收藏店铺',
             scope: $scope
             
           });
           myPopup.then(function(res) {
             console.log('Tapped!', res);
           });
           $timeout(function() {
              myPopup.close(); // 3秒后关闭弹窗
           }, 3000);
          };
	
	
}]);




/**************************************************卡市页面************************************************/

module.controller('kashiCtrl',function($scope,$http,$ionicSlideBoxDelegate){
		$scope.keyword='';
		var data={
	    			store:$scope.keyword,
					method:"share"
		},
		data2={
    			store:$scope.keyword,
    			method:"transfer"
    	},
		
		url='../../App/UserType/CardMarket/get',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
			
		  
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.cardSeconds=response;
    			for(var i=0; i<$scope.cardSeconds.length; i++){
    				var code = $scope.cardSeconds[i].card_code;
    				//JSON.parse(jsonstr); 可以将json字符串转换成json对象 
					//JSON.stringify(jsonobj); 可以将json对象转换成json对符串 
					//console.log($scope.cardSeconds[i]);
    				var str = JSON.stringify($scope.cardSeconds[i]);
    				//console.log(str);
    				localStorage.setItem(code,str);
    				//console.log(code);
    			}
    			//console.log($scope.cardSeconds);
		});
		
		$http.post(url, data2, postCfg).success(function (response) {
	    			$scope.cardCengs=response;
	    			for(var i=0; i<$scope.cardCengs.length; i++){
    				var code=$scope.cardCengs[i].card_code;
    				//JSON.parse(jsonstr); 可以将json字符串转换成json对象 
					//JSON.stringify(jsonobj); 可以将json对象转换成json对符串 
					//console.log($scope.cardSeconds[i]);
    				var str = JSON.stringify($scope.cardCengs[i]);
    				//console.log(str);
    				localStorage.setItem(code,str);
    				//console.log(code);
    			}
	    			//console.log($scope.cardCengs)
		});
		
		
		$scope.search = function(){ 
    		
    		console.log($scope.keyword);
    		
    		var data={
    			store:$scope.keyword,
    			method:"share"
    		},
    		
    		data2={
    			store:$scope.keyword,
    			method:"transfer"
    		},
    		url='../../App/UserType/CardMarket/get',
    		
    		postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};
			
	    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.cardSeconds=response;
	    			for(var i=0; i<$scope.cardSeconds.length; i++){
	    				var code = $scope.cardSeconds[i].card_code;
	    				//JSON.parse(jsonstr); 可以将json字符串转换成json对象 
						//JSON.stringify(jsonobj); 可以将json对象转换成json对符串 
						//console.log($scope.cardSeconds[i]);
	    				var str = JSON.stringify($scope.cardSeconds[i]);
	    				//console.log(str);
	    				localStorage.setItem(code,str);
	    				//console.log(code);
	    			}
    					//console.log($scope.cardSeconds);
			});
			
			$http.post(url, data2, postCfg).success(function (response) {
	    			$scope.cardCengs=response;
	    			for(var i=0; i<$scope.cardCengs.length; i++){
    				var code=$scope.cardCengs[i].card_code;
    				//JSON.parse(jsonstr); 可以将json字符串转换成json对象 
					//JSON.stringify(jsonobj); 可以将json对象转换成json对符串 
					//console.log($scope.cardSeconds[i]);
    				var str = JSON.stringify($scope.cardCengs[i]);
    				//console.log(str);
    				localStorage.setItem(code,str);
    				//console.log(code);
    			}
	    			//console.log($scope.cardCengs)
			});
    			
    	} 
	
		$scope.tabNames=['二手卡','蹭卡'];
		$scope.slectIndex=0;
		$scope.activeSlide=function(index){//点击时候触发
		 $scope.slectIndex=index;
		 $ionicSlideBoxDelegate.slide(index);
		};
		$scope.slideChanged=function(index){//滑动时候触发
		 $scope.slectIndex=index;
		};
		$scope.pages=["templates/kashi/second.html","templates/kashi/ceng.html"];
		
	
});



/***********************************************卡市详情页**************************************************/

module.controller('kashiInfoCtrl', ['$scope', '$ionicActionSheet', '$timeout', function($scope, $ionicActionSheet) {
	var arr=[];
	var astr = window.location.hash;
	console.log(astr);
	var abb = astr.indexOf('&');
	console.log(abb);
	var cdd = astr.substr(abb+1);
	console.log(cdd);
	
	var dee = localStorage.getItem(cdd);
	var cardJson = JSON.parse(dee);
	console.log(cardJson);
	 arr.push(cardJson);
	 $scope.narr=arr;
	console.log(arr);
	
	$scope.show = function() {
		//Show the action sheet

		var hideSheet = $ionicActionSheet.show({
			cancelOnStateChange: true,
			cssClass: 'action_s',
			titleText: '支付方式',
			buttons: [{
					text: '支付宝支付'
				},
				{
					text: '银联支付'
				}
			],
			cancelText: '',
			cancel: function() {
				// add cancel code..
				return true;
			},

			destructiveText: '撤销',
			destructiveButtonClicked: function() {

				var x;
				var r = confirm("去意已决吗？");
				if(r == true) {
					x = "你按下了\"确定\"按钮!";
					return true;
				} else {
					x = "你按下了\"取消\"按钮!";
				}
				document.getElementById("demo").innerHTML = x;

			},

			buttonClicked: function() {
				return true;
			}
		});

	};
}]);




/*************************************************我的页面*************************************************/

module.controller('myshowCtrl',['$scope','myService','$location',function($scope,myService,$location){
	var vm = $scope;
	
	vm.userInfo = myService.user;
	console.log(vm.userInfo);
	$scope.page=function(){
		if(vm.userInfo){
			$location.path('/user')
		}else{
			$location.path('/denglu')
		}
	}
	
}]);




/*************************************************登录页面*************************************************/

module.controller('entryCtrl',function($scope,$http,$ionicModal){
	
		$scope.phone='15129025534',
		$scope.password='513718'
		
	 $scope.entry=function(){
		  var data={
		    			phone:$scope.phone,
		    			passwd:$scope.password
		    		},
		    		
				url='../../App/UserType/user/login',
			
				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};
					
		  
		    	$http.post(url, data, postCfg).success(function (resp) {
		    			$scope.userInfo = resp
		    			console.log($scope.userInfo);
		    			var result = $scope.userInfo.info[0];
		    			localStorage.setItem('address',result.address);
		    			localStorage.setItem('age',result.age);
		    			localStorage.setItem('datetime',result.datetime);
		    			localStorage.setItem('education',result.education);
		    			localStorage.setItem('headimage',result.headimage);
		    			localStorage.setItem('hobby',result.hobby);
		    			localStorage.setItem('id',result.id);
		    			localStorage.setItem('integral',result.integral);
		    			localStorage.setItem('mail',result.mail);
		    			localStorage.setItem('mate',result.mate);
		    			localStorage.setItem('name',result.name);
		    			localStorage.setItem('nickname',result.nickname);
		    			localStorage.setItem('occupation',result.occupation);
		    			localStorage.setItem('passwd',result.passwd);
		    			localStorage.setItem('pay_passwd',result.pay_passwd);
		    			localStorage.setItem('phone',result.phone);
		    			localStorage.setItem('protocol',result.protocol);
		    			localStorage.setItem('referrer',result.referrer);
		    			localStorage.setItem('remain',result.remain);
		    			localStorage.setItem('sex',result.sex);
		    			localStorage.setItem('user_level',result.user_level);
		    			localStorage.setItem('uuid',result.uuid);
		    			window.location.href='http://www.cnconsum.com/cnconsum/h5/web/index.html#/tab/myshow';
				});
	}
	
	
	$ionicModal.fromTemplateUrl('templates/modal.html', {
	    scope: $scope
	  }).then(function(modal) {
	    $scope.modal = modal;
	  });
	  
	  $scope.createContact = function(u) {        
	    $scope.contacts.push({ name: u.firstName + ' ' + u.lastName });
	    $scope.modal.hide();
	  };
});



/*******************************************个人资料页面********************************************/

module.controller('userCtrl', ['$scope', 'myService','$ionicActionSheet', function($scope,myService,$ionicActionSheet) {
	
	$scope.user=myService.user;
	console.log(myService.user);
	
	$scope.show = function() {
		//Show the action sheet
		wx.config({
						debug: true,
						appId: 'wx0f60f1178d6632ed',
						timestamp: 1,
						nonceStr: '1',
						signature: 'c6b3ceb6ccea0037f8501230bf15fe94502eea86',
						jsApiList: [
							'chooseImage'
							// 所有要调用的 API 都要加到这个列表中
						]
			});
				
			
	
			wx.ready(function () {
	    		// 在这里调用 API
	    
				wx.chooseImage({
					count: 1, // 默认9
					sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
					sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
					success: function(res) {
						var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
					}
				});
		
		});
	};
	
	
	
}]);



/*******************************************设置个人资料********************************************/

module.controller('setUserCtrl',function($scope){
	console.log($scope)
});


/****************************************更换手机号******************************************/

module.controller('setPhoneCtrl',function($scope){
	console.log($scope)
});

/****************************************职业选择设置******************************************/

module.controller('workCtrl',['$scope','setWorkService','myService','$http',function($scope,setWorkService,myService,$http){
	
	var vm = $scope;	
	vm.workList = setWorkService.workList;
	vm.user = myService.user;
	console.log(vm.user);
	vm.data = {
    	work: ""
  	};
  	
	vm.setWork=function(work){
		vm.work=work
		var data={		uuid:vm.user.uuid,
		    			type:vm.user.occupation,
		    			para:vm.work
		    		},
		    		
				url='../../App/UserType/user/accountSet',
			
				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};
					
		  
		    	$http.post(url, data, postCfg).success(function (resp) {
		    			vm.worked = resp
		    			console.log(vm.worked);
		    			localStorage.setItem('occupation',vm.worked.para);
		    			alert('修改成功');
		    			
				})
	};
	
	console.log(vm);

}]);


/****************************************密码修改设置******************************************/

module.controller('setPassCtrl',function($scope){
	console.log($scope);
});


/*************************************我的会员卡-家庭共享********************************************/

module.controller('fshareCtrl',function($scope,$ionicModal){
	
	  $ionicModal.fromTemplateUrl('templates/modal.html', {
	    scope: $scope
	  }).then(function(modal) {
	    $scope.modal = modal;
	  });
	  
	  $scope.createContact = function(u) {        
	    $scope.contacts.push({ name: u.firstName + ' ' + u.lastName });
	    $scope.modal.hide();
	  };
});



