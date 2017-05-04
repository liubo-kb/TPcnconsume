var module = angular.module('app.controllers', []);
module.controller('ctrl', ['$scope', '$location',
	function($scope, $location) {

		/*		返回上一页		*/
		$scope.back = function() {
			window.history.back();
		}

		/*		调转到指定页面			*/
		$scope.turn = function(url) {
			$location.path('templates/kashi/' + url);
		}
		
		/*		调转到指定页面			*/
	    $scope.turn = function (url) {
	        $location.path('kashi/' + url);
	    }
        
	}
]);

module.controller('kashiInfoCtrl', ['$scope', '$ionicActionSheet', '$timeout', function($scope, $ionicActionSheet) {
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

module.controller('usernameCtrl', ['$scope', '$ionicActionSheet', function($scope, $ionicActionSheet) {
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


//商铺详情页

module.controller('factsCtrl',['$scope','$http','$ionicActionSheet', function($scope,$http,$ionicActionSheet){
	
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
	
	
	
}]);



module.controller('kashiCtrl',function($scope,$location,$http,$ionicSlideBoxDelegate){
	$scope.keyword='';
	var data={
    			store:$scope.keyword,
    			method:"share"
    		},
    		url='../../App/UserType/CardMarket/get',
    		
    		postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};
			
		   // $scope.keyword = ''; 每次搜索先清空数组内容   
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.cardSeconds=response;
    			console.log($scope.cardSeconds);
		});
		
		
		var crent={
    			store:$scope.keyword,
    			method:"transfer"
    	},
		pofig= {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (crent) {
				        return $.param(crent);
				    }
		};
		
		$http.post(url, crent, pofig).success(function (response) {
    			$scope.cardCengs=response;
    			console.log($scope.cardCengs);
		});
		
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


//家庭共享页面
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

	
})
