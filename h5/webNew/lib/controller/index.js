var module = angular.module('app.controllers', ['ionic','app.controllers','app.services','app.directives','app.filters','ls.bmap']);
module.controller('ctrl', ['$scope', '$location','$ionicLoading','$ionicSideMenuDelegate',
	function($scope, $location,$ionicLoading,$ionicSideMenuDelegate) {

		/*		返回上一页		*/
		$scope.back = function() {
			window.history.back();
		}

		/*   切换左侧边菜单栏       */
		$scope.toggleLeftSideMenu = function() {
			console.log('向左')
	    	$ionicSideMenuDelegate.toggleLeft();
	  	};

		/*   返回我的          */
		$scope.goShow =function(){
			$location.path('/tab/myshow');
			return false;
		}

//		$scope.newAdd="正在定位..."
//
//		//加载动画效果；
//		
//  	$ionicLoading.show({
//		    content: 'Loading',
//		    animation: 'fade-in',
//		    showBackdrop: true,
//		    maxWidth: 200,
//		    showDelay: 0
//		});
//
//		// 百度地图API功能
//		var map = new BMap.Map("allMap");
//		var point = new BMap.Point(108.95309828,34.2777999);
//		var geoc = new BMap.Geocoder();
//		var geolocation = new BMap.Geolocation();
//
//		geolocation.getCurrentPosition(function(r){
//			if(this.getStatus() == BMAP_STATUS_SUCCESS){
//				var pointLong = r.point.lng;
//				var pointLat = r.point.lat;
//				//定位当前点坐标
//				var pointA = new BMap.Point(pointLong,pointLat);
//
//				//解析当前坐标点
//				geoc.getLocation(pointA, function(rs){
//
//				//当前位置信息；
//				var addComp = rs.addressComponents;
//				console.log(addComp)
//				//位置信息转化本地存储的字符串形式
//				var newAddComp = JSON.stringify(addComp);
//				console.log(newAddComp)
//				//位置信息省+市+区+街道+号字符串拼接
//				var addressLocation = addComp.province+addComp.city+addComp.district+addComp.street+addComp.streetNumber;
//				
//				var addNeed = addComp.city+addComp.district;
//				
//				$scope.newAdd = addressLocation;
//
//				$ionicLoading.hide();
//				//本地存储位置信息；
//				localStorage.setItem('pointLong',r.point.lng);
//				localStorage.setItem('pointLat',r.point.lat);
//				
//				//存储地理位置信息
//				localStorage.setItem('newAddress',addNeed);
//
//				//定位地址输入框参数
//			   $scope.data={
//			   		add:""
//			   }
//
//				//初始化显示附近地址
//				if($scope.data.add==""){
//					$scope.flag=0;
//					findAdd ($scope.newAdd)
//				}
//
//
//				//搜索
//				$scope.serBtn = function(item){
//					   if(item==""){
//					   		$scope.flag=0;
//							findAdd ($scope.newAdd)
//						}else{
//								$scope.flag=1;
//								$scope.addList=""
//								findAdd(item);
//								//加载动画效果；
//						    	$ionicLoading.show({
//								    content: 'Loading',
//								    animation: 'fade-in',
//								    showBackdrop: true,
//								    maxWidth: 200,
//								    showDelay: 0
//								});
//
//								$timeout(function(){
//									//隐藏加载动画;
//									 $ionicLoading.hide();
//									//获取搜索附近地址
//								}, 3000);
//						}
//					}
//
//
//				//检索附近位置
//
//				function findAdd (str){
//					var options = {
//					onSearchComplete: function(results){
//						// 判断状态是否正确
//						if (local.getStatus() == BMAP_STATUS_SUCCESS){
//							var s = [];
//			                $scope.addList = s;
//							for (var i = 0; i < results.getCurrentNumPois(); i ++){
//								s.push(results.getPoi(i).title + ", " + results.getPoi(i).address);
//							}
//						}
//					  }
//					};
//
//					var local = new BMap.LocalSearch(map, options);
//					local.search(str);
//				}
//
//
//				});
//			}
//			else {
//				alert('failed'+this.getStatus());
//			}
//		},{enableHighAccuracy: true})

}]);


/********************************搜索商铺*******************************/

module.controller("searchCtrl",function($scope,$http,$ionicPopup,$timeout,$ionicLoading){

   var vm = $scope;
   //定义店铺搜索输入
	vm.data={
	   shops:""
	}


	vm.flag=0;

	/*搜索记录相关*/
	  //从localStorage获取搜索时间的数组
	var hisTime;
	//从localStorage获取搜索内容的数组
	var hisItem;
	//从localStorage获取最早的1个搜索时间
	var firstKey;
	function init (){
		    //每次执行都把2个数组置空
		    hisTime = [];
		    hisItem = [];
		    //模拟localStorage本来有的记录
		    //localStorage.setItem("a",12333);
		    //本函数内的两个for循环用到的变量
		    var i=0
		    for(;i<localStorage.length;i++){
		    	//console.log(localStorage);
		      if(!isNaN(localStorage.key(i))){
		        hisItem.unshift(JSON.parse(localStorage.getItem(localStorage.key(i))));
		        //console.log(localStorage.getItem(localStorage.key(i)))
		        //console.log(typeof localStorage.getItem(localStorage.key(i)))
		        hisTime.push(localStorage.key(i));
		      }
		    }
		    vm.hisSer = hisItem;
		    //console.log(vm.hisSer);

  	}
    init();


    //点击搜索店铺
    vm.getStore = function(name){
		if(name==""){
			show("请输入店铺名称")
		}else{
			vm.flag=1;
			//加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});

			$timeout(function(){
				//隐藏加载动画;
				 $ionicLoading.hide();
				//返回页面;
			  var data={
					store:name
				},
				url='../../App/MerchantType/merchant/search',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};

		    	$http.post(url, data, postCfg).success(function (response) {

		    			vm.stores=response;
		    			console.log(vm.stores);
		    			if(vm.stores.length!=0){
		    				var time = (new Date()).getTime();
		    				var data = {};
		    				data.store = vm.stores[0].store;
		    				data.muid = vm.stores[0].muid;
			    			var arrStr=JSON.stringify(data);

							localStorage.setItem(time,arrStr)
		    			}
				})

			}, 1000)
   		}

	}

   vm.detHis=function(){
   	//  confirm 对话框
             var confirmPopup = $ionicPopup.confirm({
               title: '提示',
               template: '<p class="tce">确认删除全部历史记录?</p>'
             });
             confirmPopup.then(function(res) {
               if(res) {
                     var f = 0;
				    for(;f<hisTime.length;f++){
				      localStorage.removeItem(hisTime[f]);
				    }
				   	  vm.hisSer = "";

               } else {
                 console.log('取消删除操作');
               }
             });
   }



     //弹窗提示效果
   function show(str) {
   		 var myPopup = $ionicPopup.show({
	         subTitle:str,
	         scope: $scope,
	       })
           myPopup.then(function(res) {
             console.log(str);
           });
           $timeout(function() {
              myPopup.close(); // 1秒后关闭弹窗
           }, 1000)
   };
})

/********************************商铺详情页******************************/

module.controller('factsCtrl',function($scope,$stateParams,$http,$ionicActionSheet,$ionicPopup,$state,$timeout,$location, $ionicSlideBoxDelegate){

    $scope.max = 5;
    $scope.badTimes = 4;
    $scope.ratingVal = 2;
    $scope.readonly = false;

	 //首页跳转传的muid；
	 $scope.muid = $stateParams.id;
	 console.log($scope.muid);

	 //本地获取uuid
     $scope.uuid = localStorage.getItem('uuid');
     //本地获取登录状态
     $scope.state = localStorage.getItem('entryState');
     console.log($scope.uuid);
     console.log($scope.state);

	//店铺详细信息接口调用
	 getStore($scope.muid,$scope.uuid);

	//安全保障接口调用
	 getSafeImg($scope.muid);
	

	//图文详情，购买须知，安全保障切换
	 $scope.tabNames=['图文详情','购买须知','安全保障'];
		$scope.slectIndex=0;
		$scope.activeSlide=function(index){//点击时候触发
		 $scope.slectIndex=index;
		 $ionicSlideBoxDelegate.slide(index);
		};
		$scope.slideChanged=function(index){//滑动时候触发
		 $scope.slectIndex=index;
		};
		$scope.pages=["templates/home/imgFontInfo.html","templates/home/shopMust.html","templates/home/safety.html"];



	 //定义初始显示页面
	$scope.showMark = 0;
	$scope.mySlide = 0;

	//获取店铺详细信息
    function getStore(muid,uuid){

		var data={
    			muid:muid,
    			uuid:uuid
    		},

		url='../../App/MerchantType/merchant/contentGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.storeInfo=response;
    			console.log($scope.storeInfo);
    			
    			var a = $scope.storeInfo.card_list.count;
    			var b = $scope.storeInfo.card_list.experience;
    			var c = $scope.storeInfo.card_list.meal;
    			var d = $scope.storeInfo.card_list.value;
    			
    			//合并为一个新的数组
    			var red = a.concat(b.concat(c.concat(d)));
    			console.log(red);
    			$scope.newCardList = red;
    			console.log($scope.newCardList);
    			
    			//联系商家所需电话号码
    			$scope.str = $scope.storeInfo.store_number;
    			//五星评论所需数组
    			var newArr=[];
    			newArr.push($scope.storeInfo);
    			$scope.sto = newArr;
    			console.log($scope.sto);
    			
    			//店铺收藏状态判定数据
    			$scope.flag = $scope.storeInfo.collect_state;
    			console.log('flag:'+$scope.flag)
    			
    			if($scope.storeInfo.collect_state == "true"){
    				$scope.stateBtn = "取消收藏"
    			}else{
    				$scope.stateBtn = "收藏店铺"
    			}
    			
		});

	}
    
    
   //点击收起卡片
   
   $scope.retract = function(num){
	   	if(num == 4){
	   		$scope.badTimes = $scope.newCardList.length;
	   	}else if(num == $scope.newCardList.length){
	   		$scope.badTimes = 4;
	   	}
   }
    



/*************************页面初始状态接口获取************************/

	//获取安全保障接口
     function getSafeImg(muid){
     	 var data={
    			muid:muid
    		},

		url='../../App/Extra/Source/insurance',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.safeData=response;
    			console.log($scope.safeData);
		});
     }

/*****************点击后拨打电话、购买会员卡、收藏店铺***************/

	//拨打电话
	$scope.show=function(){
		var hideSheet = $ionicActionSheet.show({
			cancelOnStateChange: true,
			cssClass: 'action_s',
			titleText: "<a class='fn22' href='tel:"+$scope.str+"'>"+$scope.str+"</a>",
			cancelText: '',
			cancel: function() {
				// add cancel code..
				return true;
			},

			destructiveText: '取消',
			destructiveButtonClicked: function() {
				return true;
			},

			buttonClicked: function() {
				return true;
			}
		});
	}





  /***************************购物卡点击跳转****************************/

  //选择其他浏览器对话框
       $scope.showAlert = function() {
         var alertPopup = $ionicPopup.alert({
           title: '提示',
           template: '<p class="tce">请选择其他浏览器进行支付,</p><p class="tce">点击右上角"..."进行操作!</p>'
         });
         alertPopup.then(function(res) {
           console.log('请选择其他浏览器进行支付,点击右上角"..."进行操作!');
         });
       };


		$scope.goods = function(item){
			if(isWeiXin()){
				console.log(" 是来自微信内置浏览器");
				$scope.showAlert();
			}else{
				if($scope.state == "login_access"){

					   console.log("不是来自微信内置浏览器")
						var name = $scope.storeInfo.store;
						var num = 0;
						console.log(item);
						$state.go('goods',{id:JSON.stringify(item),type:name,obj:JSON.stringify(num)});
				}else{
						$location.path('/denglu')
				}

			}

		}

/***************************立即购买弹窗****************************/
  //判断当前是否在微信内置浏览器
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
			console.log(ua);//mozilla/5.0 (iphone; cpu iphone os 9_1 like mac os x) applewebkit/601.1.46 (khtml, like gecko)version/9.0 mobile/13b143 safari/601.1
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
				return true;
			} else {
				return false;
		}
	}

	//立即支付点击事件
     $scope.shop = function() {
     	 var name = $scope.storeInfo.store;
		 var list = $scope.storeInfo.card_list;
		 var cardNum = list.count.length+list.experience.length+list.meal.length+list.value.length;
		 var jsonList = JSON.stringify(list);

	     	console.log(list)
	     	console.log(list.count)
	     	console.log(list.experience)
	     	console.log(list.meal)
	     	console.log(list.value)

     	if(isWeiXin()){
     		console.log(" 是来自微信内置浏览器");
			 $scope.showAlert();
     	}else{
     		if($scope.state == "login_access"){
     			console.log("不是来自微信内置浏览器")
	         	 	if(cardNum>0){
	         			$state.go('setGoods',{id:JSON.stringify(list),type:name});
	      			}else{
	         			var data={
			    			user:$scope.uuid,
			    		},

						url='../../App/UserType/card/get',

						postCfg = {
								    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
								    transformRequest: function (data) {
								        return $.param(data);
								    }
						};

				           // 自定义弹窗
				           var myPopup = $ionicPopup.show({
					             subTitle:"本店暂无卡出售",
					             scope: $scope
				           });

				           myPopup.then(function(res) {

							    	$http.post(url, data, postCfg).success(function (response) {
							    			$scope.shop=response;
							    			console.log($scope.shop);
									});

							});

							$timeout(function() {
								myPopup.close(); // 1秒后关闭弹窗
							}, 1000);

					}

     		}else{
     			$location.path('/denglu')
     		}
     	}
    }



/*****************************设置收藏状态************************/

	//点击收藏店铺操作
     $scope.collect = function(btn) {
     	console.log (btn)
     	console.log($scope.flag);
     	if($scope.state==null){
     		$location.path('/denglu')
     	}else if($scope.state=="login_access"){
     		console.log($scope.state);
     		var newStr;

     		if($scope.flag == "true"){
     			console.log("取消")
     			 newStr = false;
     			//调用设置收藏状态接口
     	    	setCollectState($scope.uuid,$scope.muid,newStr)

     		}else if($scope.flag == "false"){
     			console.log("收藏")
     			newStr = true;
     		//调用设置收藏状态接口
     	    	setCollectState($scope.uuid,$scope.muid,newStr)


     		}
     	}

	}

    //设置收藏状态接口
     function setCollectState (user,merchant,state){
     			var data={
		    			user:user,
						merchant:merchant,
						state:state
		    		},

				url='../../App/UserType/collect/stateSet',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};

				$http.post(url, data, postCfg).success(function (response) {
				    			$scope.coeStore=response;
				    			console.log($scope.coeStore);
				    			if($scope.coeStore.result_code == "false"){
				    				hint("取消收藏成功","false")
				    				$scope.stateBtn = "收藏店铺"
				    			}else if($scope.coeStore.result_code == "true"){
				    				hint("收藏成功","true")
				    				$scope.stateBtn = "取消收藏"
				    			}

				});

     }


	//自定义弹窗
	function hint(str,btnNew){

	   	  var myPopup = $ionicPopup.show({
	            subTitle:str,
	         	scope: $scope
	      });

	       myPopup.then(function(res) {
	       		$scope.flag = btnNew
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);

	}


     //头部点击，返回主页
     $scope.goHome = function(){
     	$state.go('tabs.home',{})
     }

     //初始化
     $scope.couponData={
     	result_code:null
     };

     //领取店铺优惠券
     $scope.getCoupon = function(id,index){
     	console.log(index)
     	if($scope.state == "login_access"){

	         			var data={
			    			uuid:$scope.uuid,
			    			muid:$scope.muid,
			    			coupon_id:id
			    		},

						url='../../App/MerchantType/coupon/receive',

						postCfg = {
								    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
								    transformRequest: function (data) {
								        return $.param(data);
								    }
						};


				    	$http.post(url, data, postCfg).success(function (response) {
				    			$scope.couponData=response;
				    			console.log($scope.couponData);
				    			if($scope.couponData.result_code=='1'){
				    				couponHint('领取成功！')
				    				$(".myMark").eq(index).html('已领取')
				    				$(".myMark").eq(index).css("background-color","#bfbfbf")
				    				$(".markImgBox").eq(index).css("display","block")
				    			}else if($scope.couponData.result_code=='1062'){
				    				couponHint('已经领取过了！')
				    			}else if($scope.couponData.result_code=='0'){
				    				couponHint('已被领取完了！')
				    			}
						});

     		}else{
     			$location.path('/denglu')
     		}
     }

     //领取优惠券弹窗

	function couponHint(str){

	   	  var myPopup = $ionicPopup.show({
	            subTitle:str,
	         	scope: $scope
	      });

	       myPopup.then(function(res) {
	       		console.log(str);
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);

	}

});

/*********************************查看位置*******************************/

module.controller("mapCtrl",function($scope,$stateParams){

		var vm = $scope;
		vm.longNum = $stateParams.id;
		vm.latNum = $stateParams.type;
		console.log(vm.longNum);
		console.log(vm.latNum);
		var map = new BMap.Map("container");
		var point = new BMap.Point(vm.longNum, vm.latNum);
		map.centerAndZoom(point, 15);  // 编写自定义函数，创建标注   钟楼：
		// 定义自定义覆盖物的构造函数

		var marker = new BMap.Marker(point);        // 创建标注
		map.addOverlay(marker);                     // 将标注添加到地图中
});

/*********************************更多商品*******************************/

module.controller("moreShopCtrl",function($scope,$ionicLoading,$stateParams,$http){

	var newArr=[];
	//本地获取用户uuid；
    $scope.uuid = localStorage.getItem('uuid');
	//获取页面间传参
	$scope.storeMuid = $stateParams.id;
	console.log($scope.storeMuid);
	getStoreInfo($scope.storeMuid,$scope.uuid)

	function getStoreInfo(muid,uuid){

		//加载动画效果；
    	$ionicLoading.show({
		    content: 'Loading',
		    animation: 'fade-in',
		    showBackdrop: true,
		    maxWidth: 200,
		    showDelay: 0
		});

		var data={
    			muid:muid,
    			uuid:uuid
    		},

		url='../../App/MerchantType/merchant/contentGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.storeInfo=response;
    			console.log($scope.storeInfo);
    			var newArr=[];
    			newArr.push($scope.storeInfo);
    			$scope.sto = newArr;
    			console.log($scope.sto);
    			$ionicLoading.hide();
		});

	}
})

/********************************图文详情********************************/

module.controller('imgFontMoreCtrl',function($scope,$ionicLoading,$stateParams,$http){

	//获取muid；
	$scope.muid=$stateParams.id;

	 //获取图文详情接口
     getImgData($scope.muid)

     function getImgData(muid){

     		//加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});

     	 var data={
    			muid:muid
    		},

		url='../../App/MerchantType/imgtxt/get',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.imgFontData=response;
    			console.log($scope.imgFontData);
    			$ionicLoading.hide();
		});
     }
})

/********************************更多保障********************************/

module.controller('safeMoreCtrl',function($scope,$ionicLoading,$stateParams,$http){

	//获取muid；
	$scope.muid=$stateParams.id;
	console.log($scope.muid);
	getSafeImg($scope.muid)
    //获取安全保障接口

     function getSafeImg(muid){

     	//加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});


     	 var data={
    			muid:muid
    		},

		url='../../App/Extra/Source/insurance',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.safeData=response;
    			console.log($scope.safeData);

    			$ionicLoading.hide();
		});
     }

   $scope.tab1_checked=true;
   $scope.tab2_checked=false;
   $scope.tab3_checked=false;
   $scope.curtab="tab1";
   $scope.tab1_color={color:'red'};
   $scope.tab2_color="";
   $scope.tab3_color="";
   $scope.sel_tab = function(vtab) {
     if(vtab=="tab1"){
            console.log("------TabController.sel_tab-1");
            $scope.tab1_checked=true;
            $scope.tab2_checked=false;
            $scope.tab3_checked=false;
            $scope.curtab="tab1";
            $scope.tab1_color={color:'red'};
            $scope.tab2_color="";
            $scope.tab3_color="";


     }else if (vtab=="tab2"){
            console.log("------TabController.sel_tab-2");
          $scope.tab1_checked=false;
            $scope.tab2_checked=true;
            $scope.tab3_checked=false;
            $scope.curtab="tab2";
            $scope.tab1_color="";
            $scope.tab2_color={color:'red'};
            $scope.tab3_color="";
     }else if (vtab=="tab3"){
            console.log("------TabController.sel_tab-3");
          $scope.tab1_checked=false;
            $scope.tab2_checked=false;
            $scope.tab3_checked=true;
            $scope.curtab="tab3";
            $scope.tab1_color="";
            $scope.tab2_color="";
            $scope.tab3_color={color:'red'};
     }

    };

})

/*********************************用户评论*******************************/

module.controller('assessCtrl',function($scope,$ionicLoading,$stateParams,$http){
	var vm = $scope;

	//获取muid
	vm.muid = $stateParams.id;
	console.log(vm.muid)

	getMore(1,vm.muid);
	function getMore(index,muid){

		//加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});



		var data={
				index : index,
    			muid : muid
    		},

		url='../../App/UserType/evaluate/get',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.moreAssess=response;
    			console.log(vm.moreAssess)
    			$ionicLoading.hide();
		});
	}

})

/********************************选择购买********************************/

module.controller("setGoodsCtrl",function($scope,$stateParams,$state){

	var vm = $scope;
	//获取店铺卡列表
	vm.cardList = JSON.parse($stateParams.id);
	console.log(vm.cardList);

	//店铺名称
	vm.storeName = $stateParams.type;
	console.log(vm.storeName);
	var index=0;
	vm.send=function(item){
		$state.go('goods',{id:JSON.stringify(item),type:vm.storeName,obj:JSON.stringify(index)});
	}
});

/*********************************结算页面*******************************/

module.controller('goodsCtrl',function($scope,$stateParams,$http,$state,$ionicPopup,$timeout){
	var vm = $scope;
	//本地获取uuid；
	vm.uuid = localStorage.getItem('uuid');
	//获取店铺卡
	vm.unit = JSON.parse($stateParams.id);
	console.log(vm.unit);
	//套餐卡时，调用项目接口
	if(vm.unit.type == "套餐卡"){
		packageItem(vm.unit.muid,vm.unit.code)
	}
	//调用商铺额度接口
	getCardQuota(vm.unit.muid)
	//判断该卡是否办理过接口
	judgeGetCard(vm.uuid,vm.unit.muid,vm.unit.code,vm.unit.level,vm.unit.type)

	//店铺名称
	vm.storeName = $stateParams.type;
	console.log(vm.storeName);
	//优惠券项目
	vm.coupon = JSON.parse($stateParams.obj);
	console.log(vm.coupon);

	vm.func = function(e){
		var couStr = Number(e.pri_condition);
		var price = Number(vm.price);
		return couStr <= price;
	}


	//判断有无优惠方式
	if(vm.coupon=='0'){
		vm.type=''
		vm.info=''
		vm.hint='请选择'
		vm.flag='5'
		vm.delog = 'null#办卡#'+vm.unit.code+'#'+vm.unit.level+'#'+vm.unit.type+'#card_temp_color#'+vm.uuid+'#'+vm.unit.merchant+'#'+vm.unit.price
	}else if(vm.coupon==null){
		vm.type='优惠券已用完'
		vm.info=''
		vm.sent='无可用'
		vm.flag='5'
		vm.delog = 'null#办卡#'+vm.unit.code+'#'+vm.unit.level+'#'+vm.unit.type+'#card_temp_color#'+vm.uuid+'#'+vm.unit.merchant+'#'+vm.unit.price
	}else{
	//判断优惠券类别
	  if(vm.coupon.muid){
	  	vm.type = '商家优惠券'
	  	vm.info = '本次消费可节省'
	  	vm.hint = '已选择1张'
	  	vm.sent='-￥'
	  	vm.flag = 0;
	  	vm.delog = 'cp#办卡#'+vm.unit.code+'#'+vm.unit.level+'#'+vm.unit.type+'#card_temp_color#'+vm.uuid+'#'+vm.unit.merchant+'#'+(vm.unit.price-vm.coupon.sum)+'#'+vm.coupon.coupon_id
	  }else if(vm.coupon.id){
	  	vm.type='商消乐优惠券'
	  	vm.info = '本次消费可节省'
	  	vm.hint = '已选择1张'
	  	vm.sent='-￥'
	  	vm.flag = 1;
	  	vm.delog = 'scp#办卡#'+vm.unit.code+'#'+vm.unit.level+'#'+vm.unit.type+'#card_temp_color#'+vm.uuid+'#'+vm.unit.merchant+'#'+vm.unit.price+'#'+vm.coupon.coupon_id
	  }else{
	  	vm.type='红包'
	  	vm.info = '本次消费可节省'
	  	vm.hint = '红包'
	  	vm.sent='-￥'
	  	vm.flag = 2;
	  	vm.last = vm.unit.price*0.9;
	  	console.log(vm.last);
	  	if(vm.last > vm.coupon){
	  		vm.redPag = vm.coupon;
	  		vm.delog = 'rp#办卡#'+vm.unit.code+'#'+vm.unit.level+'#'+vm.unit.type+'#card_temp_color#'+vm.uuid+'#'+vm.unit.merchant+'#'+vm.unit.price+'#'+vm.redPag
	  	}else{
	  		vm.redPag = vm.last;
	  		vm.delog = 'rp#办卡#'+vm.unit.code+'#'+vm.unit.level+'#'+vm.unit.type+'#card_temp_color#'+vm.uuid+'#'+vm.unit.merchant+'#'+vm.unit.price+'#'+vm.redPag
	  	}

	  }
	}



	//点击某张会员卡，获取其价格；
	vm.send=function(item){
		console.log(item)
		vm.data.card=item;
	}
	//结算页面，点击跳转；
	vm.alipay = function(deg,item){
		var str = vm.quotaData.remain.slice(0,-1)
		vm.storeSum = Number(str);
		if(vm.storeSum<vm.unit.price){
			hint("商家暂停办卡业务")
		}else if(vm.cardData.result_code=="false"){
			$state.go("payCard",{id:deg,type:item})
		}else{
			hint("您已拥有此卡")
		}
	}

	//点击返回商铺详情页
	vm.goGods = function(){
		$state.go('facts',{id:vm.unit.muid})
	}

	//点击跳转优惠大全页面
	vm.goCou = function(card){
		$state.go("allCou",{id:JSON.stringify(vm.unit),type:vm.storeName})
	}

	//套餐卡，包含项目接口
	function packageItem(muid,code){

		var data={
    			muid : muid,
    			code : code
    		},

		url='../../App/MerchantType/MealCard/showOption',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.packageData = response;
    			console.log(vm.packageData)
		});
	}

	//获取商家办卡额度接口
	function getCardQuota(muid){
		var data={
    			muid : muid
    		},

		url='../../App/MerchantType/merchant/authGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.quotaData = response;
    			console.log(vm.quotaData)
		});
	}

	//判断该卡是否办理过接口

	function judgeGetCard(uuid,muid,cardCode,cardLevel,cardType){

		var data={
				uuid : uuid,
    			muid : muid,
    			cardCode : cardCode,
    			cardLevel : cardLevel,
    			cardType : cardType
    		},

		url='../../App/UserType/card/stateGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.cardData = response;
    			console.log(vm.cardData)
		});
	}

	//弹窗提示
	function hint(str){
		var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log(str)
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

})

/********************************优惠大全页面****************************/

module.controller('allCouCtrl',function($scope,$stateParams,$http,$state){

	var vm = $scope;

	//本地获取uuid
    vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);
	//获取goods页面所传来的卡的信息；
	vm.cardInfo = JSON.parse($stateParams.id);
	console.log(vm.cardInfo);
	//店铺muid
	vm.muid = vm.cardInfo.muid;
	//会员卡价格
	vm.price = vm.cardInfo.price;

	console.log(vm.muid);
	console.log(vm.price);

	//获取店铺名称
	vm.storeName = $stateParams.type;
	console.log(vm.storeName);
	//获取商消乐优惠券-调用函数
	getPayCoupon(vm.muid,vm.uuid);
	//获取商铺优惠券券-调用函数
	myQuan(vm.muid,vm.uuid);
	//获取红包-调用函数；
	getRed(vm.uuid)

	//定义要传的值
	vm.data={
		unit:""
	}

	//优惠券过滤器
	vm.func = function(e){
		var couStr = Number(e.pri_condition);
		var price = Number(vm.price);
		return couStr <= price;
	}


	//购买会员卡时,获取平台可用优惠券

	function getPayCoupon(muid,uuid){
		var data = {
					muid : muid,
					uuid : uuid
		},

		url='../../App/UserType/user/getSxlCoupon',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getCoupon = response;
    			console.log(vm.getCoupon);
   		});
	}

	//购买会员卡时,获取商家可用优惠券

	function myQuan(muid,uuid){

		var data = {
					muid : muid,
					uuid : uuid
		},

		url='../../App/MerchantType/coupon/userGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getMyQuan = response;
    			console.log(vm.getMyQuan);

   		});
	}

	//获取红包数据；
	function getRed(uuid){
		var data = {
					uuid : uuid,
		},

		url='../../App/UserType/user/getRedPacket',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 var newArr = [];
    			 vm.getRed = response;
    			 vm.unit = vm.getRed.sum;

    			console.log(vm.getRed);
    			console.log(vm.unit);
   		});
	}


	//跳转结算页面

vm.getCou = function(num){
		console.log(num)
		$state.go('goods',{id:JSON.stringify(vm.cardInfo),type:vm.storeName,obj:JSON.stringify(num)})
	}

});

/********************************办卡支付详情页***************************/

module.controller('payCardCtrl',function($scope,$stateParams){
	var vm = $scope;
	//本地获取uuid；
	vm.uuid = localStorage.getItem('uuid');
	//获取要购买的卡的信息；
	vm.myCard = $stateParams.id;
	console.log(vm.myCard);
	//获取支付价格
	vm.price = $stateParams.type;
	//生成时间戳
	var vNow = new Date();
	var sNow = "";
	sNow += String(vNow.getFullYear());
	sNow += String(vNow.getMonth() + 1);
	sNow += String(vNow.getDate());
	sNow += String(vNow.getHours());
	sNow += String(vNow.getMinutes());
	sNow += String(vNow.getSeconds());
	sNow += String(vNow.getMilliseconds());
	//生成订单号
	vm.payNum = sNow;

	$('form').submit(function(e){
		 var info=$("#a").val();
		 console.log(info);
	})

});

/*********************************卡市页面********************************/

module.controller('kashiCtrl',function($scope,$ionicLoading,$http){

		$scope.keyword='';
		
	//获取当前位置
	
	$scope.AddInfo = localStorage.getItem('newAddress');
	console.log($scope.AddInfo);
	
//	$scope.AddInfo = "西安市雁塔区"

   //页码
	var page = 1;
	var index = 1;
   //上拉加载开关
	var	isLockSecond = false;
	var isLockCeng = false;
	
	//初始化二手卡、蹭卡数据
    $scope.cardSeconds = [];
    $scope.cardCengs = [];
  
   //二手卡页面上拉加载
   
   $scope.loadMoreSecond = function () {
        if(isLockSecond)return;
        isLockSecond=true;
        
        //加载动画效果；
		$ionicLoading.show({
		    content: 'Loading',
			    animation: 'fade-in',
		    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
		});
        
        
        var data={
					address:$scope.AddInfo,
	    			store:$scope.keyword,
					method:'transfer',
					page:page
		},

		url='../../App/UserType/CardMarket/get',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			console.log(page)
    			
    			if (response.length == 0) {
	                $scope.hasmore = true;
	                $ionicLoading.hide();
	                return;
            	}
    			
    			page++;
            	$scope.cardSeconds = $scope.cardSeconds.concat(response);
            	
            	$ionicLoading.hide();
            	
    			for(var i=0; i<$scope.cardSeconds.length; i++){
    				var nickname = $scope.cardSeconds[i].nickname;
    				var code = $scope.cardSeconds[i].card_code;
    				var level = $scope.cardSeconds[i].card_level;
    				var only =nickname+code+level;
    				console.log(typeof only);
    				var str = JSON.stringify($scope.cardSeconds[i]);
    				//console.log(str);
    				localStorage.setItem(only,str);
    				//console.log(code);
    			}
    			//console.log($scope.cardSeconds);
		}).finally(function (error) {
            isLockSecond = false;
            $scope.$broadcast('scroll.infiniteScrollComplete');
            $scope.$broadcast('scroll.refreshComplete');
        })
	};
	

  //蹭卡页面上拉加载
  
  $scope.loadMoreCeng = function () {
        if(isLockCeng)return;
        isLockCeng=true;
        
        //加载动画效果；
		$ionicLoading.show({
		    content: 'Loading',
			    animation: 'fade-in',
		    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
		});
        
        var data={
					address:$scope.AddInfo,
	    			store:$scope.keyword,
					method:'share',
					page:index
		},

		url='../../App/UserType/CardMarket/get',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			console.log(page)
    			
    			if (response.length == 0) {
	                $scope.hasmore = true;
	                $ionicLoading.hide();
	                return;
            	}
    			
    			index++;
            	$scope.cardCengs = $scope.cardCengs.concat(response);
            	$ionicLoading.hide();
            	
    			for(var i=0; i<$scope.cardCengs.length; i++){
    				var nickname = $scope.cardCengs[i].nickname;
    				var code = $scope.cardCengs[i].card_code;
    				var level = $scope.cardCengs[i].card_level;
    				var only =nickname+code+level;
    				console.log(typeof only);
    				var str = JSON.stringify($scope.cardCengs[i]);
    				localStorage.setItem(only,str);
    			}
    			
		}).finally(function (error) {
            isLockCeng = false;
            $scope.$broadcast('scroll.infiniteScrollComplete');
            $scope.$broadcast('scroll.refreshComplete');
        })
	};
        
	//二手卡页面下拉刷新
	$scope.doRefreshSecond = function () {
        page = 1;
        $scope.cardSeconds = [];
        $scope.loadMoreSecond();
   	}
	
	//蹭卡页面下拉刷新
	$scope.doRefreshCeng = function () {
        index = 1;
        $scope.cardCengs = [];
        $scope.loadMoreCeng();
   	}
	
	//页面初始化，调用二手卡，蹭卡列表接口
	$scope.loadMoreCeng();
	$scope.loadMoreSecond();
	
	
	/**************输入框，搜索功能***************/
	
	
	//点击搜索，根据关键字调用接口
	$scope.search = function(str){
		$scope.loadMoreCeng();
		$scope.loadMoreSecond();
	}


});

/*********************************搜索卡页面******************************/

module.controller('searchCardCtrl',function($scope,$ionicLoading,$http){
	
	var vm = $scope ;
	
	//输入框内容初始化
	
	vm.data={
		shops:""
	}
	
	//获取焦点，调用列表接口
	$("#cardSearch").focus(function(){
		storeList(vm.data.shops)
	})
	
	//输入内容搜索
	vm.getStore = function(str){
		storeList(str)
	}
	
	
	
	function storeList(store){
		
		//加载动画效果；
		$ionicLoading.show({
		    content: 'Loading',
			    animation: 'fade-in',
		    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
		});
		
		
		
		var data={
	    			store:store
		},

		url='../../App/UserType/CardMarket/get',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.cardList = response;
    			console.log(vm.cardList)
    			$ionicLoading.hide();
		})
	}
})

/*********************************二手卡详情页****************************/

module.controller('secondCtrl',function($scope,$stateParams,$state,$ionicPopup,$timeout,$location) {

	var vm = $scope;
	//本地获取uuid
	vm.uuid = localStorage.getItem('uuid');
	//本地获取state
	vm.state = localStorage.getItem('entryState');
	//页面间传值，获取muid
	vm.muid = $stateParams.id;
	//页面间传值，获取会员卡唯一的值由'muid,nickname,card_code,card_level组成';
	vm.only = $stateParams.type;

	//本地获取卡市页面存储的唯一值；
	var dee = localStorage.getItem(vm.only);
	var cardJson = JSON.parse(dee);

	console.log(cardJson);
	//获取卡信息；
	vm.myCard = cardJson;
	console.log(vm.myCard);
	console.log(vm.state);
	//选择其他浏览器对话框
   vm.showAlert = function() {
     var alertPopup = $ionicPopup.alert({
       title: '提示',
       template: '请选择其他浏览器进行支付,点击右上角"..."进行操作!'
     });
     alertPopup.then(function(res) {
       console.log('请选择其他浏览器进行支付,点击右上角"..."进行操作!');
     });
   };

	//点击我想要，判断是否在微信浏览器，判断是否蹭自己卡，跳转支付页面
	vm.show = function() {
		if(isWeiXin()){
			console.log(" 是来自微信内置浏览器");
			vm.showAlert()
		}else{
			if(vm.state=="login_access"){
				console.log("不是来自微信内置浏览器")
					if(vm.uuid == vm.myCard.uuid){
						var alertPopup = $ionicPopup.alert({
			               title: '提示',
			               template: "<p class='tce'>不能购买自己的卡！</p>"
			             });
			             alertPopup.then(function(res) {
			               console.log("不能购买自己的卡！");
			             });
					}else{
						$state.go("cardShop",{id:JSON.stringify(vm.myCard)})
				   	}
			}else{
				$location.path('/denglu');
			}
		}

	}



	//判断当前是否在微信内置浏览器
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
			console.log(ua);//mozilla/5.0 (iphone; cpu iphone os 9_1 like mac os x) applewebkit/601.1.46 (khtml, like gecko)version/9.0 mobile/13b143 safari/601.1
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
				return true;
			} else {
				return false;
		}
	}

});

/*********************************二手卡支付详情页************************/

module.controller('cardShopCtrl',function($scope,$stateParams){
	var vm = $scope;

	//页面间传值，获取上一页的卡的信息
	vm.myCard = JSON.parse($stateParams.id);
	//本地获取uuid
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.myCard)
	//生成时间戳
	var vNow = new Date();
	var sNow = "";
	sNow += String(vNow.getFullYear());
	sNow += String(vNow.getMonth() + 1);
	sNow += String(vNow.getDate());
	sNow += String(vNow.getHours());
	sNow += String(vNow.getMinutes());
	sNow += String(vNow.getSeconds());
	sNow += String(vNow.getMilliseconds());

	//生成订单名称
	vm.payNum = sNow;
	//定义支付金额；
	vm.data = {
		money:""
	}

	$('form').submit(function(e){
		 var info=$("#a").val();
		 console.log(info);
	})

});

/***********************************蹭卡详情页****************************/

module.controller('cengCtrl',function($scope,$stateParams,$state,$ionicPopup,$timeout,$location) {

	var vm = $scope;
	//本地获取uuid
	vm.uuid = localStorage.getItem('uuid');
	//本地获取state
	vm.state = localStorage.getItem('entryState');
	//页面间传值，获取muid
	vm.muid = $stateParams.id;
	//页面间传值，获取会员卡唯一的值由'muid,nickname,card_code,card_level组成';
	vm.only = $stateParams.type;

	console.log(vm.muid);
	console.log(vm.only);
	//用唯一的值来获取卡信息
	var dee = localStorage.getItem(vm.only);
	var cardJson = JSON.parse(dee);

	console.log(cardJson);
	vm.myCard = cardJson;
	console.log(vm.myCard);

	//选择其他浏览器对话框
   vm.showAlert = function() {
     var alertPopup = $ionicPopup.alert({
       title: '提示',
       template: '请选择其他浏览器进行支付,点击右上角"..."进行操作!'
     });
     alertPopup.then(function(res) {
       console.log('请选择其他浏览器进行支付,点击右上角"..."进行操作!');
     });
   };


	console.log(vm.state);

	//点击我想要，判断是否在微信浏览器，判断是否蹭自己卡，跳转支付页面
	vm.show = function() {
		if(isWeiXin()){
			console.log(" 是来自微信内置浏览器");
			vm.showAlert()
		}else{
			if(vm.state=="login_access"){
				console.log("不是来自微信内置浏览器")
					if(vm.uuid == vm.myCard.uuid){
						var alertPopup = $ionicPopup.alert({
			               title: '提示',
			               template: "<p class='tce'>不能蹭自己的卡！</p>"
			             });
			             alertPopup.then(function(res) {
			               console.log("不能蹭自己的卡！");
			             });
					}else{
						$state.go("sharePay",{id:JSON.stringify(vm.myCard)})
				   	}
			}else{
				$location.path('/denglu');
			}
		}

	}
	
	
	//判断当前是否在微信内置浏览器
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
			console.log(ua);//mozilla/5.0 (iphone; cpu iphone os 9_1 like mac os x) applewebkit/601.1.46 (khtml, like gecko)version/9.0 mobile/13b143 safari/601.1
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
				return true;
			} else {
				return false;
		}
	}

});

/**********************************蹭卡支付详情页*************************/

module.controller('sharePayCtrl',function($scope,$stateParams,$ionicPopup, $timeout){
	var vm = $scope;

	//获取页面间传值，上一页所传卡的信息
	vm.myCard = JSON.parse($stateParams.id);

	//本地获取uuid
    vm.uuid = localStorage.getItem('uuid');
	console.log(vm.myCard)
	//生成时间戳；
	var vNow = new Date();
	var sNow = "";
	sNow += String(vNow.getFullYear());
	sNow += String(vNow.getMonth() + 1);
	sNow += String(vNow.getDate());
	sNow += String(vNow.getHours());
	sNow += String(vNow.getMinutes());
	sNow += String(vNow.getSeconds());
	sNow += String(vNow.getMilliseconds());
	//时间戳即订单号
	vm.payNum = sNow;
	//定义支付金额，用于存储支付时的金额
	vm.data = {
		money:""
	}

	$('form').submit(function(e){
		 console.log(e);
		 var sty = $("#shopSum").val();
		if(sty==""){
			alert("请输入金额")
			return false;
		}
	})

});

/************************************我的页面*****************************/

module.controller('myshowCtrl',function($scope,$location,$http,$ionicPopup,$timeout){

	var vm = $scope;
	 //本地获取用户uuid
	 vm.uuid = localStorage.getItem('uuid')
	 //本地获取头像信息
     vm.headimage = localStorage.getItem('headimage')
     //本地获取昵称信息
     vm.nickname = localStorage.getItem('nickname')
     //本地获取登录状态
     vm.state = localStorage.getItem('entryState')
     console.log("uuid:"+vm.uuid);
     console.log("headimage:"+vm.headimage);
     console.log("nickname:"+vm.nickname);
	 console.log("state:"+vm.state);
	 
	 init(vm.uuid);
	 
	 
	 //页面打开时，获取签到状态接口
	 function init(uuid){
	 	
	 	var data={
				  uuid:uuid
		},
		
		url='../../App/Extra/mall/getIntegral',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url, data, postCfg).success(function (response) {
				vm.signState = response;
				console.log(vm.signState)
				
				if(vm.signState.signed == 'yes'){
					vm.signStateFont = "已签到"
				}else if(vm.signState.signed == 'no'){
					vm.signStateFont = "签到"
				}
		});
	 	
	 }
	 
	 
	 //判断登录登录状态跳转不同页面
	 vm.goPage=function(item){
		if(vm.state == "login_access"){
			$location.path('/'+item);
		}else if(vm.state == null){
			$location.path('/denglu')
		}
	 };
	 
	
	 //点击签到时，获取接口
	 vm.doSign = function(){
	 	
	 	var data={
				  uuid:vm.uuid
		},
		url='../../App/Extra/mall/sign',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url, data, postCfg).success(function (response) {
				vm.sign = response;
				console.log(vm.sign)
				if(vm.sign.result_code == '1'){
					vm.signStateFont = "已签到"
					hint()
				}
		});
	 	
	 }
	 
	 function hint(){
	 	
	 	 // 自定义弹窗
           var myPopup = $ionicPopup.show({
             title: '签到成功，积分+20！',
             scope: $scope,
           });
           myPopup.then(function(res) {
             console.log('签到成功，积分+20！');
           });
           $timeout(function() {
              myPopup.close(); // 1秒后关闭弹窗
           }, 1000);
	 	
	 }
});

/**********************************个人资料页面***************************/

module.controller('userCtrl',function($scope,$http,fileReader,$location,$ionicActionSheet) {

	var vm = $scope;

	//获取本地存储的uuid;
	vm.uuid=localStorage.getItem('uuid');
	//初始化，获得页面数据函数；
	vm.getInfo=function(uuid){
		var data={
				  uuid:uuid
		},
		url='../../App/UserType/info/get',
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url, data, postCfg).success(function (response) {
				vm.userInfo = response;
				console.log(vm.userInfo)
		});
	}

	//调用初始化页面函数
	vm.getInfo(vm.uuid);

	//点击返回我的页面
	vm.goMyShow = function(){
		$location.path('/tab/myshow')
	}

  	//退出当前账号；
	vm.quit= function(){
						localStorage.removeItem('address');
						localStorage.removeItem('age');
						localStorage.removeItem('datetime');
						localStorage.removeItem('education');
						localStorage.removeItem('headimage');
						localStorage.removeItem('hobby');
						localStorage.removeItem('id');
						localStorage.removeItem('integral');
						localStorage.removeItem('mail');
						localStorage.removeItem('mate');
						localStorage.removeItem('name');
						localStorage.removeItem('nickname');
						localStorage.removeItem('occupation');
						localStorage.removeItem('passwd');
						localStorage.removeItem('pay_passwd');
						localStorage.removeItem('phone');
						localStorage.removeItem('protocol');
						localStorage.removeItem('referrer');
						localStorage.removeItem('remain');
						localStorage.removeItem('sex');
						localStorage.removeItem('user_level');
						localStorage.removeItem('uuid');
						localStorage.removeItem('entryState');
					//跳转我的页面，即myshow;
						$location.path('/tab/myshow');
  	}

});

/**********************************设置个人资料***************************/

module.controller('setUserCtrl',function($scope,$stateParams,$http,$state,$ionicPopup,$timeout){
	var vm = $scope;

	//获取本地存储的uuid；
	vm.uuid=localStorage.getItem('uuid');
	//获取要修改的哪一个项目：例如：地址；
	vm.useItem = $stateParams.id;
	console.log($stateParams.id);
	//获取修改的哪一个项目：例如：nickname；用于本地修改数据的名称；
	vm.type = $stateParams.type;
	console.log($stateParams.type);
	//定义接收选择结果变量
	vm.data = {
    	name: ""
  	};

  	//修改成功后弹窗提示效果；
	vm.hint = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"修改成功！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		$state.go('user',{})
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

	//修改失败弹窗效果；
	vm.fash = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"不能为空！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log('修改内容为空！')
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}
  	//设置要修改的项目；
	vm.setItem = function(name){
		if(name==''){
			vm.fash();
		}else{
					var data={
								uuid:vm.uuid,
				    			type:vm.type,
				    			para:name
			    		},

					url='../../App/UserType/user/accountSet',

					postCfg = {
							    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
							    transformRequest: function (data) {
							        return $.param(data);
							    }
					};

			    	$http.post(url, data, postCfg).success(function(response) {
			    			vm.message=response;
			    			console.log($scope.message);
			    			localStorage.setItem(vm.type,name);
			    			vm.hint();
					});
	 		  }
		}

});

/**********************************其它选项设置***************************/

module.controller('setOtherCtrl',function($scope,$stateParams,$http,$ionicPopup,$timeout,$state){
	var vm = $scope;

	//获取本地存储的uuid；
	vm.uuid = localStorage.getItem('uuid');
	//获取判断页面显示条件：0：性别，1：教育，2：婚姻；
	vm.page = $stateParams.page;
	console.log(vm.page);
	//获取要修改的哪一个项目：例如：地址；
	vm.useItem = $stateParams.id;
	console.log(vm.useItem);
	//获取修改的哪一个项目：例如：nickname；用于本地修改数据的名称；
	vm.type = $stateParams.type;
	console.log(vm.type);
	//定义接收选择结果变量
	vm.data = {
    	secet: "请选择"
  	};

  	//修改成功后弹窗提示效果；
	vm.hint = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"修改成功！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		$state.go('user',{})
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

	//修改失败弹窗效果；
	vm.fash = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"请选择修改内容！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log('未选择修改内容！')
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

  	//设置要修改的项目；
	vm.setCheck = function(secet){

		if(secet=="请选择"){
			vm.fash()
		}else{
				var data={
							uuid:vm.uuid,
			    			type:vm.type,
			    			para:secet
		    		},

				url='../../App/UserType/user/accountSet',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};


		    	$http.post(url, data, postCfg).success(function (response) {
		    			vm.setck=response;
		    			console.log(vm.setck)
		    			localStorage.setItem(vm.type,secet);
		    			vm.hint();
				});
		}
	}
});

/**********************************带有选项设置***************************/

module.controller('setSelectCtrl',function($scope,$stateParams,$http,$state,$ionicPopup,$timeout){
	var vm = $scope;

	//获取本地存储的uuid；
	vm.uuid = localStorage.getItem('uuid');
	//获取要修改的哪一个项目：例如：地址；
	vm.useItem = $stateParams.id;
	console.log(vm.useItem);
	//获取修改的哪一个项目：例如：nickname；用于本地修改数据的名称；
	vm.type = $stateParams.type;
	console.log(vm.type);


	//定义接收选择结果变量
	vm.data = {
    	result: ""
  	};

  	//定义回调函数
    vm.callback=function(value){
        alert( "回调函数获得结果："+ value);
        return false;
    }
    vm.serverData={loadLazyTime:""};

     //模拟默认时间从服务端加载 获取其他获取方式
    $timeout(function () {
        vm.serverData.loadLazyTime="2017-08-16 10:00";
    },1000)


    //修改成功后弹窗提示效果；
	vm.hint = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"修改成功！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		$state.go('user',{})
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

    //设置要修改的项目；
	vm.setCheck = function(result){
		var data={
					uuid:vm.uuid,
	    			type:vm.type,
	    			para:result
    		},

		url='../../App/UserType/user/accountSet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.setck=response;
    			console.log($scope.setck);
    			localStorage.setItem(vm.type,result);
    			vm.hint();
		});
	}
});

/**********************************职业选择设置***************************/

module.controller('workCtrl',function($scope,setWorkService,$http,$ionicPopup,$timeout,$state){

	var vm = $scope;

	//获取本地职业服务模块；
	vm.workList = setWorkService.workList;

	//获取本地存储的uuid；
	vm.uuid = localStorage.getItem('uuid');

	//定义接收选择结果变量
	vm.data = {
    	work: ""
  	};

  	//修改成功后弹窗提示效果；
	vm.hint = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"修改成功！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		$state.go('user',{})
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

	//修改失败弹窗效果；
	vm.fash = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"请选择修改内容！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log('未选择修改内容！')
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}


  	//设置要修改的项目
	vm.setWork=function(work){
		if(work==''){
			vm.fash()
		}else{
				var data={
						uuid:vm.uuid,
		    			type:"occupation",
		    			para:work
		    		},

				url='../../App/UserType/user/accountSet',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};


		    	$http.post(url, data, postCfg).success(function (resp) {
		    			vm.worked = resp;
		    			console.log(vm.worked);
		    			localStorage.setItem('occupation',vm.worked.para);
		    			vm.hint()
				})
		   }
	};

});

/************************************密码管理*****************************/

/***************登录密码修改设置****************/

module.controller('setPassCtrl',function($scope,$stateParams,$http,$state,$ionicPopup,$timeout){

	var vm = $scope;

	//获取本地存储的uuid；
	vm.uuid = localStorage.getItem('uuid');
	//获取本地存储的passwd；
	vm.passwd = localStorage.getItem('passwd');
	//获取修改的哪一个项目：例如：nickname；用于本地修改数据的名称；
	vm.type = $stateParams.type;
	console.log(vm.type);

	//定义接收选择结果变量
	vm.data = {
    	pwdOld:"",
    	pwdNew:''
  	};

  	//修改成功后弹窗提示效果；
	vm.hint = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"修改成功！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		$state.go('user',{})
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

	//修改失败弹窗效果；
	vm.fash = function(str){
		var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log('密码未修改成功！')
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

	//设置要修改的密码
	vm.setPass=function(passOld, passNew){
		if(passOld == '' || passOld != vm.passwd){
			vm.fash("原密码输入错误！")
		}else if(passOld.length < 6){
			vm.fash("原密码长度不能小于6位！")
		}else if(passNew=='' || passNew.length < 6){
			vm.fash("新密码长度不能小于6位！")
		}else if(passOld == passNew){
			vm.fash("新密码和原密码相同！")
		}else{
			var data={
					uuid:vm.uuid,
	    			type:vm.type,
	    			pwd_old:passOld,
					pwd_new:passNew
    		},

			url='../../App/UserType/user/accountSet',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};


	    	$http.post(url, data, postCfg).success(function (response) {
	    			$scope.newPasswd=response;
	    			console.log($scope.newPasswd);
	    			localStorage.setItem(vm.type,passNew);
	    			vm.hint();
			});
		}
	}
});

/*****************支付密码设置*****************/

module.controller('setPayPassCtrl',function($scope,$state){
	var vm = $scope;

	//本地获取支付密码：pay_passwd；
	vm.pay_passwd = localStorage.getItem('pay_passwd');
	console.log(vm.pay_passwd);

	//定义设置/修改密码；
	vm.data={
		iteName:''
	}

	//判断是否有支付密码
	if(vm.pay_passwd=="未设置"){
		vm.data.iteName='设置';
	}else{
		vm.data.iteName='修改';
	}

	//点击判断，跳转设置/修改支付密码页面
	vm.goPage = function(page){
		if(page=='设置'){
			$state.go('setPay',{})
		}else if(page=='修改'){
			$state.go('orgPass',{})
		}
	}

})

/*****************原支付密码******************/

module.controller('orgPassCtrl',function($scope,$state,$ionicPopup,$ionicLoading,$timeout){
	var vm = $scope;
	//本地获取原有支付密码
	vm.orgPayPass = localStorage.getItem('pay_passwd');
	console.log(vm.orgPayPass);

	//原支付密码输入有误弹窗提示
	vm.passRow = function() {
     var alertPopup = $ionicPopup.alert({
       template: '<p class="tce">原支付密码错误</p>'
     });
     alertPopup.then(function(res) {
     	   //加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});

			$timeout(function(){
				//隐藏加载动画;
				 $ionicLoading.hide();
			}, 1000)
     });
   };

  //输入支付密码
	 (function(){
	 	var container = document.getElementById("inputBoxContainer");
	 		boxInput = {
	 		maxLength:"",
	 		realInput:"",
	 		bogusInput:"",
	 		bogusInputArr:"",
	 		callback:"",
	 		init:function(fun){
	 			var that = this;
	 			this.callback = fun;
	 			that.realInput = container.children[0];
	 			that.bogusInput = container.children[1];
	 			that.bogusInputArr = that.bogusInput.children;
	 			that.maxLength = that.bogusInputArr[0].getAttribute("maxlength");
	 			that.realInput.oninput = function(){
	 				that.setValue();
	 			}
	 			that.realInput.onpropertychange = function(){
	 				that.setValue();
	 			}
	 		},
	 		setValue:function(){
	 			this.realInput.value = this.realInput.value.replace(/\D/g,"");
	 			console.log(this.realInput.value.replace(/\D/g,""))
	 			var real_str = this.realInput.value;
	 			for(var i = 0 ; i < this.maxLength ; i++){
	 				this.bogusInputArr[i].value = real_str[i]?real_str[i]:"";
	 			}
	 			if(real_str.length >= this.maxLength){
	 				this.realInput.value = real_str.substring(0,6);
	 				this.callback();
	 			}
	 		},
	 		getBoxInputValue:function(){
	 			var realValue = "";
	 			for(var i in this.bogusInputArr){
	 				if(!this.bogusInputArr[i].value){
	 					break;
	 				}
	 				realValue += this.bogusInputArr[i].value;
	 			}
	 			return realValue;
	 		}
	 	}
	 })()

	 boxInput.init(function(){
	   getValue();
	 });

	 function getValue(){
	   var inputValue = boxInput.getBoxInputValue();
		 if(inputValue != vm.orgPayPass){
			 	vm.passRow()
		 }else{
			 $state.go('setPay',{})
		 }
	 }

})

/***************设置新支付密码****************/

module.controller('setPayCtrl',function($scope,$state){
	var vm = $scope;

//输入确认支付密码
	(function(){
	 var container = document.getElementById("setPayInput");
		 boxInput = {
		 maxLength:"",
		 realInput:"",
		 bogusInput:"",
		 bogusInputArr:"",
		 callback:"",
		 init:function(fun){
			 var that = this;
			 this.callback = fun;
			 that.realInput = container.children[0];
			 that.bogusInput = container.children[1];
			 that.bogusInputArr = that.bogusInput.children;
			 that.maxLength = that.bogusInputArr[0].getAttribute("maxlength");
			 that.realInput.oninput = function(){
				 that.setValue();
			 }
			 that.realInput.onpropertychange = function(){
				 that.setValue();
			 }
		 },
		 setValue:function(){
			 this.realInput.value = this.realInput.value.replace(/\D/g,"");
			 console.log(this.realInput.value.replace(/\D/g,""))
			 var real_str = this.realInput.value;
			 for(var i = 0 ; i < this.maxLength ; i++){
				 this.bogusInputArr[i].value = real_str[i]?real_str[i]:"";
			 }
			 if(real_str.length >= this.maxLength){
				 this.realInput.value = real_str.substring(0,6);
				 this.callback();
			 }
		 },
		 getBoxInputValue:function(){
			 var realValue = "";
			 for(var i in this.bogusInputArr){
				 if(!this.bogusInputArr[i].value){
					 break;
				 }
				 realValue += this.bogusInputArr[i].value;
			 }
			 return realValue;
		 }
	 }
	})()

	boxInput.init(function(){
		getValue();
	});

	function getValue(){
		var inputValue = boxInput.getBoxInputValue();
		//跳转确认支付密码页面
		$state.go('setWord',{id:inputValue})
	}

})

/**********************确认支付密码*********************/

module.controller('setWordCtrl',function($scope,$stateParams,$ionicPopup,$state,$http,$ionicLoading,$timeout){
	var vm = $scope;

	//定义完成按钮是否显示
	vm.flag=0;
	//本地获取用户uuid
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);
	//获取页面传值，支付密码；
	vm.pass = $stateParams.id;
	console.log(vm.pass);


   //一致：支付密码已设置成功
   vm.showSuccess = function() {
     var alertPopup = $ionicPopup.alert({
       template: '<p class="tce">支付密码已设置成功</p>'
     });
     alertPopup.then(function(res) {
       $state.go('user',{})
     });
   };

   //输入确认支付密码
			(function(){
			 var container = document.getElementById("setWordInput");
				 boxInput = {
				 maxLength:"",
				 realInput:"",
				 bogusInput:"",
				 bogusInputArr:"",
				 callback:"",
				 init:function(fun){
					 var that = this;
					 this.callback = fun;
					 that.realInput = container.children[0];
					 that.bogusInput = container.children[1];
					 that.bogusInputArr = that.bogusInput.children;
					 that.maxLength = that.bogusInputArr[0].getAttribute("maxlength");
					 that.realInput.oninput = function(){
						 that.setValue();
					 }
					 that.realInput.onpropertychange = function(){
						 that.setValue();
					 }
				 },
				 setValue:function(){
					 this.realInput.value = this.realInput.value.replace(/\D/g,"");
					 console.log(this.realInput.value.replace(/\D/g,""))
					 var real_str = this.realInput.value;
					 for(var i = 0 ; i < this.maxLength ; i++){
						 this.bogusInputArr[i].value = real_str[i]?real_str[i]:"";
					 }
					 if(real_str.length >= this.maxLength){
						 this.realInput.value = real_str.substring(0,6);
						 this.callback();
					 }
				 },
				 getBoxInputValue:function(){
					 var realValue = "";
					 for(var i in this.bogusInputArr){
						 if(!this.bogusInputArr[i].value){
							 break;
						 }
						 realValue += this.bogusInputArr[i].value;
					 }
					 return realValue;
				 }
			 }
			})()

			boxInput.init(function(){
				getValue();
			});

			function getValue(){
				vm.newStr = boxInput.getBoxInputValue();
			}

	//两次密码输入一致调用接口
   vm.setSuccess = function(){
   			if(vm.newStr == vm.pass){

				var data = {
						uuid : vm.uuid,
						pay_passwd : vm.pass
				},

				url='../../App/Extra/passwd/setPayPasswd',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};


		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.setGood = response;
		    			console.log(vm.setGood);
		    			localStorage.setItem('pay_passwd',vm.pass)
						 vm.showSuccess();
		   		});

			}else{

				 var alertPopup = $ionicPopup.alert({
			       		template: '<p class="tce">两次密码输入不符，请重新输入</p>'
			     });
			     alertPopup.then(function(res) {

			      		//加载动画效果；
				    	$ionicLoading.show({
						    content: 'Loading',
						    animation: 'fade-in',
						    showBackdrop: true,
						    maxWidth: 200,
						    showDelay: 0
						});

						$timeout(function(){
							//隐藏加载动画;
							 $ionicLoading.hide();
							}, 1000)
			     });

			}
   }
})

/********************支付密码-忘记密码******************/

module.controller('forgetCtrl',function($scope,$interval,$ionicPopup,$timeout,$http,$state){
	    var vm = $scope;

		//本地获取手机号码：phone；
		 vm.phone = localStorage.getItem('phone');

		 console.log(vm.phone);
		 //定义验证码
		 vm.data={
		 	code:''
		 }

		//发送短信验证码
		vm.sendMessageCode = function(phone){
			    var data = {
						phone : phone
				},

				url='../../../smsVertify/Demo/SendTemplateSMS.php',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};


		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.recode = response;
		    			console.log(vm.recode);
		    			 vm.code = vm.recode[0];
		    			console.log(vm.code);

		   		});
		}

		//验证码不匹配弹窗提示效果；
		vm.hint = function(str){
			var myPopup = $ionicPopup.show({
	             subTitle:str,
	             scope: $scope
	           });

	           myPopup.then(function(res) {
	           		console.log(str);
				});

				$timeout(function() {
					myPopup.close(); // 1秒后关闭弹窗
				}, 1000);
		}

		//获取验证码倒计时
		 vm.getCode = '获取验证码';
		 vm.button_clicked = false;
		 var timerHandler;
		 var second = 60;

		 //点击发送验证码，倒计时
		 vm.sendCode = function(phone){
		 	console.log(phone)
		 	//弹窗提示发送验证码
		 	var alertPopup = $ionicPopup.alert({
		       title: '<h3>确认手机号码</h3>',
		       template: '<p class="tce">我们将会发送验证码到'+phone+'</p>'
		 	});

		 	 alertPopup.then(function(res) {
		 	 	//弹出框点击确认后发送短信验证码
			 		 vm.button_clicked = true;
				     vm.getCode = second+'秒后重新获取';
				     vm.sendMessageCode(vm.phone)
					 timerHandler = $interval(function(){
						doLoop()
						return false;
					},1000,100)
		     });

		 }

		 function doLoop(){
				 second--;
				 if(second > 0){
			  			  vm.getCode = second+'秒后重新获取';
				 }else{
						  $interval.cancel(timerHandler); //清除定时器
						  vm.button_clicked = false;
						  vm.getCode = '重发验证码';
						  second = 60; //重置时间
				 }
		 }

	//点击“下一步”
	vm.getPass=function(code){
		console.log(code);
		if(code==''){
			vm.hint('请输入验证码')
		}else if(code != vm.code){
			console.log(vm.code)
			vm.hint('验证码输入错误')
		}else{
			$state.go('setPay',{})
		}
	}


})

/********************************我的会员卡页面****************************/

module.controller('memBerCtrl',function($scope,$ionicLoading,$http,$state){
	var vm = $scope;

	//获取本地存储的uuid；
	vm.uuid = localStorage.getItem('uuid');
	//调用函数，获取会员卡列表
	init();

	function init(){

		//加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});

		var data={
					uuid:vm.uuid
    		},

		url='../../App/UserType/card/multiGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.cardShow = response;
    			console.log($scope.cardShow);
    			$ionicLoading.hide();
    			
    			//所有卡片的length
    			$scope.cardLength = $scope.cardShow.count.length+$scope.cardShow.experience.length+$scope.cardShow.meal.length+$scope.cardShow.value.length+$scope.cardShow.share.length
    			
   		});
	}

	//跳转会员卡信息页
	vm.goCard=function(obj){
		console.log(obj)
		$state.go('card',{id:JSON.stringify(obj)})
	}

	//套餐卡与体验卡页面
	vm.goNewClass = function(obj){
		$state.go('newClass',{id:JSON.stringify(obj)})
	}

});

/*******************************储值卡和计次卡页面*************************/

module.controller('cardCtrl',function($scope,$stateParams,$http,$state,$ionicPopup,$timeout){
	var vm = $scope;

	//获取该张卡的信息
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	
	//会员卡理赔中，不能进行任何操作！
    vm.showAlert = function() {
     var alertPopup = $ionicPopup.alert({
       template: '<p class="tce">会员卡理赔中，<br/>不能进行任何操作！</p>'
     });
     alertPopup.then(function(res) {
       console.log('会员卡理赔中，不能进行任何操作！');
     });
   };
	
	//调用会员卡详情接口
	init(vm.id.user,vm.id.merchant,vm.id.card_level,vm.id.card_code)
	
	//获取会员卡详情接口
	function init(uuid,muid,cardLevel,cardCode){
		
		var data={
					uuid : uuid,
	    			muid : muid,
	    			cardLevel : cardLevel,
	    			cardCode : cardCode
    		},

		url='../../App/UserType/card/detailGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.cardData = response;
    			console.log(vm.cardData);
    			
    			//会员卡有效日期数据处理
    				vm.cardDateStart = vm.cardData.date_start.substr(0,10);
    				vm.cardDateEnd = vm.cardData.date_end.substr(0,10);
    				
    				console.log(vm.cardDateStart);
    				console.log(vm.cardDateEnd);
    				
    			//折扣率数据处理
    			if(vm.cardData.card_type == "储值卡"){
    				vm.cardRate = vm.cardData.rule/10+'折';
    				vm.cardFont = "余额:"
    				vm.cardNumber = vm.cardData.card_remain;
    				vm.cardContainItem = "店内项目可使用会员卡任意消费。"
    			}else if(vm.cardData.card_type == "计次卡"){
    				vm.cardRate = "";
    				vm.cardFont = "剩余:";
    				vm.cardNumber = Math.floor(vm.cardData.card_remain/(vm.cardData.price/vm.cardData.rule))+"次";
    				vm.cardContainItem = "计次卡用完为止。"
    			}
    			
		});
		
	}
	
	//卡片升级,点击操作
	vm.goUpter = function(id){
		
		console.log(id);
		
		if(id.claim_state == "null"){
			
			if(id.display_state == "on"){
				$state.go("upter",{id:JSON.stringify(id)})
			}else{
				vm.hint("不能进行该操作！")
			}
			
		}else{
			vm.showAlert()
		}
		
	}
	

	//携带卡信息id，跳转不同页面item：我要续卡
	vm.goPage=function(item,id){
		if(vm.cardData.claim_state == "null"){
			$state.go(item,{id:JSON.stringify(id)})
		}else{
			vm.showAlert()
		}
		
	}
	
	//点击后，会员卡操作项目向下移动
	var btn = false;
	vm.showInfo = function(){
		if(btn == false){
			$(".cardFont").animate({top:"4.46rem"});
			$(".redBtn").attr('src',"img/upter.png")
			btn = true;
		}else if(btn == true){
			$(".cardFont").animate({top:"1.9rem"});
			$(".redBtn").attr('src',"img/under.png")
			btn = false;
		}
		
	}
	
	//判断卡类型，跳转不同付款页面
	vm.cardPay=function(obj){
		if(obj.claim_state == "null"){
			
			if(obj.card_type=="储值卡"){
				$state.go('setment',{id:JSON.stringify(obj)})
			}else if(obj.card_type=="计次卡"){
				$state.go('setcount',{id:JSON.stringify(obj)})
			}
			
		}else{
				vm.showAlert()
		}
		
	}


	//弹窗效果
	vm.hint=function(str){
		       // 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle: str,
             scope: $scope
           })
           myPopup.then(function(res) {
           	 console.log(str)
           });
           $timeout(function() {
              myPopup.close(); // 3秒后关闭弹窗
           }, 1000);
    };
    
   
	//条件判断，跳转卡片转让页面
	vm.goAttornPage = function(id){
		if(id.claim_state == "null"){
			
			if(id.state=="share"){
				vm.hint('该卡已分享，转让需取消分享')
			}else if(id.state=="transfer"){
				$state.go('shareInfo',{id:JSON.stringify(id),item:'转让'})
			}else if(id.state=='null'){
				$state.go('attorn',{id:JSON.stringify(id)})
			}
			
		}else{
			
			vm.showAlert()
			
		}
	}

	//条件判断，跳转我要分享页面
	vm.goSharePage = function(id){
		if(vm.cardData.claim_state == "null"){
			
			if(id.card_type=='计次卡'){
				vm.hint('计次卡不能分享！')
			}else if(id.state=="transfer"){
				vm.hint('该卡已转让，分享需取消转让')
			}else if(id.state=="share"){
				$state.go('shareInfo',{id:JSON.stringify(id),item:'分享'})
			}else if(id.state=="null"){
				$state.go('share',{id:JSON.stringify(id)})
			}
			
		}else{
			
			vm.showAlert()
			
		}
	}
	
	//投诉理赔选项
	vm.goClaim = function(id){
		
		if(id.claim_state == "null"){
			
			$state.go('claim',{id:JSON.stringify(id)})
			
		}else if(id.claim_state == "CHECK_FAILED"){
			
			$state.go('failed',{id:JSON.stringify(id)})
			
		}else{	
			var page = -1;
			$state.go('process',{id:JSON.stringify(id),type:page})
		}
		
	}
	

});

/*********************************储值卡支付******************************/

module.controller('setMentCtrl',function($scope,$stateParams,$ionicPopup,$http,$timeout,$ionicModal,$state){
	var vm = $scope;

	//本地获取支付密码信息
	vm.payPasswd = localStorage.getItem('pay_passwd');
	console.log(vm.payPasswd);
	//获取卡信息
	var myCard = JSON.parse($stateParams.id);
	vm.sum = myCard.card_remain;
	
	console.log(myCard);
	console.log(vm.sum);
	
	vm.data={
		sum:""
	}

	//点击后弹窗输入密码
	vm.payPass=function(sum){
        vm.data={
		  		wifi:""
		}
		console.log(typeof sum)
		console.log(typeof vm.sum)
		if(sum==''){
			vm.hint("没有输入金额,请输入金额")
		}else if(Number(sum) > Number(vm.sum)){
			vm.hint("输入金额大于当前卡余额!")
		}else{
			
			$state.go('cardPayPass',{id:JSON.stringify(myCard),type:sum})

		}
	};


     //输入金额大于当前卡余额弹窗
   	vm.hint=function(str){
   		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log(str);
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
   }

});

/******************************储值卡输入密码弹窗*************************/

module.controller('cardPayPassCtrl',function($scope,$stateParams,$state,$ionicPopup,$http,$timeout){
	var vm = $scope;
	//本地获取原有支付密码
	vm.payPass = localStorage.getItem('pay_passwd');
	console.log(vm.payPass);

	//获取卡信息
	 vm.myCard = JSON.parse($stateParams.id);
	 vm.sum = $stateParams.type;
	 vm.zhe = vm.myCard.rule;
	 
	 //实际支付价格
	 vm.resultSum = Number(vm.sum)*Number(vm.zhe)/100;	
	 console.log(vm.resultSum);
	
	 console.log(vm.myCard);
	 console.log(vm.sum);
	 console.log(vm.zhe);
	 
	//支付成功后弹窗
   	vm.prop=function(){
   		var alertPopup = $ionicPopup.alert({
               title: '提示',
               template: "<p class='tce'>支付成功</p>"
             });
         alertPopup.then(function(res) {
           	$state.go("paySuccess",{id:JSON.stringify(vm.myCard),type:vm.sum})
         });
   	}


	//密码输入有误弹窗

   	vm.hint=function(str){
   		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log(str);
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
   	}



   	//会员卡支付接口

   vm.cardPay=function(uuid,muid,cardCode,cardLevel,cardType,sum){

     	var data = {
					uuid : uuid,
					muid : muid,
					cardCode : cardCode,
					cardLevel : cardLevel,
					cardType : cardType,
					sum : sum
		},

		url='../../App/UserType/card/pay',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.detShop = response;
    			 vm.prop();

   		});
     }

		 //调用函数，获取输入密码；
	 	 getPass()

	 	//输入支付密码
	 	function getPass(){
	 		var container = document.getElementById("cardPayInput");
	 			boxInput = {
	 			maxLength:"",
	 			realInput:"",
	 			bogusInput:"",
	 			bogusInputArr:"",
	 			callback:"",
	 			init:function(fun){
	 				var that = this;
	 				this.callback = fun;
	 				that.realInput = container.children[0];
	 				that.bogusInput = container.children[1];
	 				that.bogusInputArr = that.bogusInput.children;
	 				that.maxLength = that.bogusInputArr[0].getAttribute("maxlength");
	 				that.realInput.oninput = function(){
	 					that.setValue();
	 				}
	 				that.realInput.onpropertychange = function(){
	 					that.setValue();
	 				}
	 			},
	 			setValue:function(){
	 				this.realInput.value = this.realInput.value.replace(/\D/g,"");
	 				console.log(this.realInput.value.replace(/\D/g,""))
	 				var real_str = this.realInput.value;
	 				for(var i = 0 ; i < this.maxLength ; i++){
	 					this.bogusInputArr[i].value = real_str[i]?real_str[i]:"";
	 				}
	 				if(real_str.length >= this.maxLength){
	 					this.realInput.value = real_str.substring(0,6);
	 					this.callback();
	 				}
	 			},
	 			getBoxInputValue:function(){
	 				var realValue = "";
	 				for(var i in this.bogusInputArr){
	 					if(!this.bogusInputArr[i].value){
	 						break;
	 					}
	 					realValue += this.bogusInputArr[i].value;
	 				}
	 				return realValue;
	 			}
	 		}
	 	}

	 	 boxInput.init(function(){
	 		 getValue();
	 	 });

	 	 function getValue(){
	 		 var inputValue = boxInput.getBoxInputValue();
	 		 if(inputValue != vm.payPass){
	 				vm.hint('支付密码错误,请重新输入!')
	 		 }else{
	 			 vm.cardPay(vm.myCard.user,vm.myCard.merchant,vm.myCard.card_code,vm.myCard.card_level,vm.myCard.card_type,vm.resultSum)
	 		 }
	 	 }

})

/******************************计次卡支付*********************************/

module.controller('setCountCtrl',function($scope,$stateParams,$ionicPopup,$timeout,$http,$state){
	var vm = $scope;
	 vm.card = JSON.parse($stateParams.id);
	 //计算总共可以消费的次数
	var count = Math.floor(vm.card.card_remain/(vm.card.price/vm.card.rule));
	
	vm.data={
		count:0
	}

	//次数减少
	vm.reduce=function(){
		if(vm.data.count>0){
			vm.data.count--;
		}
	}


	//次数增加
	vm.add=function(){
		if(vm.data.count<count){
			vm.data.count++;
		}
	}

	//点击后弹窗输入密码

 	vm.payPass=function(sum){
		vm.data={
			wifi:""
		}
		if(sum==0){
			vm.hint("请添加消费次数")
		}else{
			$state.go('cardCountPass',{id:JSON.stringify(vm.card),type:sum})

       }
	};

		//可消费次数不足

	  vm.hint=function(str){
   		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		vm.data.count=0;
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
   	}


})

/****************************计次卡输入密码弹窗***************************/

module.controller('cardCountPassCtrl',function($scope,$stateParams,$state,$ionicPopup,$http,$timeout){
	var vm = $scope;
	//本地获取原有支付密码
	vm.payPass = localStorage.getItem('pay_passwd');
	console.log(vm.payPass);
	
	//获取卡信息
	var myCard = JSON.parse($stateParams.id);
	
	//获取卡消费次数
	 	vm.sum = $stateParams.type;
	 //计算单价
	 	vm.unit=myCard.price/myCard.rule;
	 	
	 //本次消费金额;
        vm.shopSum = vm.unit*vm.sum;	
		 console.log(myCard);
		 console.log(vm.sum);
		 console.log(vm.unit);
		 console.log(vm.shopSum);

	//支付成功后弹窗
   	vm.prop=function(){
   		var alertPopup = $ionicPopup.alert({
               title: '提示',
               template: "<p class='tce'>支付成功</p>"
             });
         alertPopup.then(function(res) {
           	$state.go('paySuccess',{id:JSON.stringify(myCard),type:vm.sum})
         });
   	}

	//密码输入有误弹窗
   	vm.hint=function(str){
   		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log(str);
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
   	}

	//会员卡支付接口
   vm.cardPay=function(uuid,muid,cardCode,cardLevel,cardType,sum){
     	var data = {
					uuid : uuid,
					muid : muid,
					cardCode : cardCode,
					cardLevel : cardLevel,
					cardType : cardType,
					sum : sum
		  },

			url='../../App/UserType/card/pay',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};

    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.detShop = response;
    			 vm.prop();
   		});
   }


//调用函数，获取输入密码；
  getPass()

//输入支付密码
function getPass(){
	var container = document.getElementById("cardCountInput");
		boxInput = {
		maxLength:"",
		realInput:"",
		bogusInput:"",
		bogusInputArr:"",
		callback:"",
		init:function(fun){
			var that = this;
			this.callback = fun;
			that.realInput = container.children[0];
			that.bogusInput = container.children[1];
			that.bogusInputArr = that.bogusInput.children;
			that.maxLength = that.bogusInputArr[0].getAttribute("maxlength");
			that.realInput.oninput = function(){
				that.setValue();
			}
			that.realInput.onpropertychange = function(){
				that.setValue();
			}
		},
		setValue:function(){
			this.realInput.value = this.realInput.value.replace(/\D/g,"");
			console.log(this.realInput.value.replace(/\D/g,""))
			var real_str = this.realInput.value;
			for(var i = 0 ; i < this.maxLength ; i++){
				this.bogusInputArr[i].value = real_str[i]?real_str[i]:"";
			}
			if(real_str.length >= this.maxLength){
				this.realInput.value = real_str.substring(0,6);
				this.callback();
			}
		},
		getBoxInputValue:function(){
			var realValue = "";
			for(var i in this.bogusInputArr){
				if(!this.bogusInputArr[i].value){
					break;
				}
				realValue += this.bogusInputArr[i].value;
			}
			return realValue;
		}
	}
}

 boxInput.init(function(){
	 getValue();
 });

 function getValue(){
	 var inputValue = boxInput.getBoxInputValue();
	 if(inputValue != vm.payPass){
			vm.hint('支付密码错误,请重新输入!')
	 }else{
		 vm.cardPay(myCard.user,myCard.merchant,myCard.card_code,myCard.card_level,myCard.card_type,vm.shopSum)
	 }
 }

})

/*******************************套餐卡和体验卡页面**************************/

module.controller('newClassCtrl',function($scope,$stateParams,$http,$state,$ionicPopup,$timeout){
	var vm = $scope;

	//获取该张卡的信息
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	
	//会员卡理赔中，不能进行任何操作！
    vm.showAlert = function() {
     var alertPopup = $ionicPopup.alert({
       template: '<p class="tce">会员卡理赔中，<br/>不能进行任何操作！</p>'
     });
     alertPopup.then(function(res) {
       console.log('会员卡理赔中，不能进行任何操作！');
     });
   };
	
	//请求套餐卡项目所要接口数据
	vm.muid = vm.id.merchant;
	vm.uuid = vm.id.user;
	vm.level = vm.id.card_level;
	vm.code = vm.id.card_code;
	
	//判断该张会员卡是:套餐卡/体验卡
	
	if(vm.id.card_type=="套餐卡"){
		vm.flag = 1;
		mealCard(vm.uuid,vm.muid,vm.code)
		packageItem(vm.muid,vm.uuid,vm.code)
	}else if(vm.id.card_type=="体验卡"){
		vm.flag = 0;
		experCard(vm.uuid,vm.muid,vm.code)
	}
	
	

	
	//携带卡信息id，跳转不同页面
	vm.goOrder = function(id){
		if(vm.cardData.claim_state == "null"){
			$state.go("order",{id:JSON.stringify(id)})
		}else{
			vm.showAlert()
		}
	}
	
	//理赔处理
	vm.goClaim = function(id){
		$state.go("claim",{id:JSON.stringify(id)})
	}
	
	
	//点击后，会员卡操作项目向下移动
	var btn = false;
	vm.showInfo = function(){
		if(btn == false){
			$(".cardFont").animate({top:"4.46rem"});
			$(".redBtn").attr('src',"img/upter.png")
			btn = true;
		}else if(btn == true){
			$(".cardFont").animate({top:"1.9rem"});
			$(".redBtn").attr('src',"img/under.png")
			btn = false;
		}
	}
	
	
	//判断卡类型，跳转不同付款页面
	vm.cardPay=function(obj){
		if(vm.cardData.claim_state == "null"){
			
			if(obj.card_type=="套餐卡"){
				$state.go('setPackage',{id:JSON.stringify(obj)})
			}else if(obj.card_type=="体验卡"){
				$state.go('setExperience',{id:JSON.stringify(obj)})
			}
			
		}else{
			
			vm.showAlert()
			
		}
		
	}
	
	
	//套餐卡详情接口
	function mealCard(uuid,muid,code){
		
		var data={
					uuid : uuid,
	    			muid : muid,
	    			code : code
    	},

		url='../../App/UserType/MealCard/detailGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.cardData = response;
    			console.log(vm.cardData);
    			vm.cardTerm = "长期有效,套餐用完为止。"
		});
	}
	
	
	//体验卡详情接口
	function experCard(uuid,muid,code){
		
		var data={
					uuid : uuid,
	    			muid : muid,
	    			code : code
    	},

		url='../../App/UserType/ExperienceCard/detailGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.cardData = response;
    			console.log(vm.cardData);
    			vm.cardTerm = "仅使用一次,长期有效。"
		});
	}
	
	
	
	//套餐卡，包含项目接口
	function packageItem(muid,uuid,code){

		var data={
    			muid : muid,
    			uuid : uuid,
    			code : code
    		},

		url='../../App/UserType/MealCard/getOption',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.packageData = response;
    			console.log(vm.packageData);
		});
	}


	//弹窗效果
	vm.hint=function(str){
					 // 自定义弹窗
					 var myPopup = $ionicPopup.show({
						 subTitle: str,
						 scope: $scope
					 })
					 myPopup.then(function(res) {
						 console.log(str)
					 });
					 $timeout(function() {
							myPopup.close(); // 3秒后关闭弹窗
					 }, 1000);
		};
})

/**********************************套餐卡支付******************************/

module.controller('setPackageCtrl',function($scope,$stateParams,$http,$state){
	var vm = $scope;

	//获取页面间传值,获取该张会员卡信息
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	//商户muid
	vm.muid = vm.id.merchant;
	//会员卡号码
	vm.code = vm.id.card_code;
	//用户uuid；
	vm.uuid = vm.id.user;

	//调用该卡所包含的项目接口
	packageItem(vm.muid,vm.uuid,vm.code);


	//套餐卡，包含项目接口
	function packageItem(muid,uuid,code){

		var data={
    			muid : muid,
    			uuid : uuid,
    			code : code
    		},

		url='../../App/UserType/MealCard/getOption',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			vm.packageData = response;
    			console.log(vm.packageData)
    			vm.selectItem = vm.packageData[0];
		});
	}

	//点击选中某一项
	vm.getItem = function(newItem){
		vm.selectItem = newItem
	}

	//点击底部支付

	vm.goPackage = function(newItem){
		console.log(newItem)
		$state.go('cardPackagePass',{id:JSON.stringify(vm.id),type:JSON.stringify(newItem)})
	}

})

/********************************套餐卡输入密码*****************************/

module.controller('cardPackagePassCtrl',function($scope,$stateParams,$ionicPopup,$state,$http,$timeout){
	var vm = $scope;
	//本地获取原有支付密码
	vm.payPass = localStorage.getItem('pay_passwd');
	console.log(vm.payPass);
	
	//获取套餐卡信息
	var myCard = JSON.parse($stateParams.id);
	 console.log(myCard);
	//获取套餐卡消费信息
	vm.sum = JSON.parse($stateParams.type);
	 console.log(vm.sum);
	//支付成功后弹窗
   	vm.prop=function(){
   		var alertPopup = $ionicPopup.alert({
               title: '提示',
               template: "<p class='tce'>支付成功</p>"
             });
         alertPopup.then(function(res) {
               $state.go('paySuccess',{id:JSON.stringify(myCard),type:JSON.stringify(vm.sum)})
         });
   	}


	//密码输入有误弹窗

   	vm.hint=function(str){
   		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log(str);
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
   	}



   	//会员卡支付接口

   vm.packagePay=function(uuid,muid,code,option_id){

     	var data = {
					uuid : uuid,
					muid : muid,
					code : code,
					option_id : option_id
		},

		url='../../App/UserType/MealCard/pay',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.payResult = response;
    			 console.log(vm.payResult);
    			 vm.prop();

   		});
     }


		 //调用函数，获取输入密码；
	 	 getPass()

	 	 //输入支付密码
	 	 function getPass(){
	 		 var container = document.getElementById("cardPackageInput");
	 			 boxInput = {
	 			 maxLength:"",
	 			 realInput:"",
	 			 bogusInput:"",
	 			 bogusInputArr:"",
	 			 callback:"",
	 			 init:function(fun){
	 				 var that = this;
	 				 this.callback = fun;
	 				 that.realInput = container.children[0];
	 				 that.bogusInput = container.children[1];
	 				 that.bogusInputArr = that.bogusInput.children;
	 				 that.maxLength = that.bogusInputArr[0].getAttribute("maxlength");
	 				 that.realInput.oninput = function(){
	 					 that.setValue();
	 				 }
	 				 that.realInput.onpropertychange = function(){
	 					 that.setValue();
	 				 }
	 			 },
	 			 setValue:function(){
	 				 this.realInput.value = this.realInput.value.replace(/\D/g,"");
	 				 console.log(this.realInput.value.replace(/\D/g,""))
	 				 var real_str = this.realInput.value;
	 				 for(var i = 0 ; i < this.maxLength ; i++){
	 					 this.bogusInputArr[i].value = real_str[i]?real_str[i]:"";
	 				 }
	 				 if(real_str.length >= this.maxLength){
	 					 this.realInput.value = real_str.substring(0,6);
	 					 this.callback();
	 				 }
	 			 },
	 			 getBoxInputValue:function(){
	 				 var realValue = "";
	 				 for(var i in this.bogusInputArr){
	 					 if(!this.bogusInputArr[i].value){
	 						 break;
	 					 }
	 					 realValue += this.bogusInputArr[i].value;
	 				 }
	 				 return realValue;
	 			 }
	 		 }
	 	 }

	 		boxInput.init(function(){
	 			getValue();
	 		});

	 		function getValue(){
	 			var inputValue = boxInput.getBoxInputValue();
	 			if(inputValue != vm.payPass){
	 				 vm.hint('支付密码错误,请重新输入!')
	 			}else{
	 				vm.packagePay(vm.sum.uuid,vm.sum.muid,vm.sum.code,vm.sum.option_id)
	 			}
	 		}

})

/**********************************体验卡支付*******************************/

module.controller('setExperienceCtrl',function($scope,$stateParams,$state){
	var vm = $scope;

	//获取页面间传值
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);

	//跳转支付页面
	vm.goExper = function(item){
		$state.go('cardExperPass',{id:JSON.stringify(item)})
	}

})

/********************************体验卡输入密码*****************************/

module.controller('cardExperPassCtrl',function($scope,$stateParams,$state,$ionicPopup,$http,$timeout){
	var vm = $scope;
	//本地获取原有支付密码
	vm.payPass = localStorage.getItem('pay_passwd');
	console.log(vm.payPass);

	//获取体验卡支付项目信息
	var myCard = JSON.parse($stateParams.id);
	 console.log(myCard);

	//支付成功后弹窗
   	vm.prop=function(){
   		var alertPopup = $ionicPopup.alert({
               title: '提示',
               template: "<p class='tce'>支付成功</p>"
             });
         alertPopup.then(function(res) {
         	$state.go("paySuccess",{id:JSON.stringify(myCard),type:myCard.price})
         });
   	}


	//密码输入有误弹窗

   	vm.hint=function(str){
   		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log(str);
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
   	}



   	//会员卡支付接口

   vm.experPay=function(uuid,muid,code){

     	var data = {
					uuid : uuid,
					muid : muid,
					code : code
		},

		url='../../App/UserType/ExperienceCard/pay',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.payResult = response;
    			 console.log(vm.payResult);
    			 vm.prop();
   		});
  }


	 //调用函数，获取输入密码；
 	  getPass()

	 	//输入支付密码
	 	function getPass(){
	 		var container = document.getElementById("cardExperInput");
	 			boxInput = {
	 			maxLength:"",
	 			realInput:"",
	 			bogusInput:"",
	 			bogusInputArr:"",
	 			callback:"",
	 			init:function(fun){
	 				var that = this;
	 				this.callback = fun;
	 				that.realInput = container.children[0];
	 				that.bogusInput = container.children[1];
	 				that.bogusInputArr = that.bogusInput.children;
	 				that.maxLength = that.bogusInputArr[0].getAttribute("maxlength");
	 				that.realInput.oninput = function(){
	 					that.setValue();
	 				}
	 				that.realInput.onpropertychange = function(){
	 					that.setValue();
	 				}
	 			},
	 			setValue:function(){
	 				this.realInput.value = this.realInput.value.replace(/\D/g,"");
	 				console.log(this.realInput.value.replace(/\D/g,""))
	 				var real_str = this.realInput.value;
	 				for(var i = 0 ; i < this.maxLength ; i++){
	 					this.bogusInputArr[i].value = real_str[i]?real_str[i]:"";
	 				}
	 				if(real_str.length >= this.maxLength){
	 					this.realInput.value = real_str.substring(0,6);
	 					this.callback();
	 				}
	 			},
	 			getBoxInputValue:function(){
	 				var realValue = "";
	 				for(var i in this.bogusInputArr){
	 					if(!this.bogusInputArr[i].value){
	 						break;
	 					}
	 					realValue += this.bogusInputArr[i].value;
	 				}
	 				return realValue;
	 			}
	 		}
	 	}

	 	 boxInput.init(function(){
	 		 getValue();
	 	 });

	 	 function getValue(){
	 		 var inputValue = boxInput.getBoxInputValue();
	 		 if(inputValue != vm.payPass){
	 				vm.hint('支付密码错误,请重新输入!')
	 		 }else{
	 			 vm.experPay(myCard.user,myCard.merchant,myCard.card_code)
	 		 }
	 	 }
})

/*********************************支付成功页面******************************/

module.controller("paySuccessCtrl",function($scope,$stateParams){
	
	var vm = $scope;
	
	//获取会员卡详细信息
	vm.myCard = JSON.parse($stateParams.id);
	vm.sum = JSON.parse($stateParams.type);
	vm.zhe = vm.myCard.rule;
	
	//实际支付价格
	 vm.resultSum = Number(vm.sum)*Number(vm.zhe)/100;	
	console.log(vm.myCard);
	console.log(vm.sum);
	console.log(vm.zhe);
	console.log(vm.resultSum);
	
	//判断卡类别，分情况显示页面数据
	
	if(vm.myCard.card_type == "储值卡"){
		
		vm.beforePrice = "原价:" + Number(vm.sum).toFixed(2);
		
	}else if(vm.myCard.card_type == "计次卡"){
		
		vm.beforePrice = "消费:" + vm.sum+"次";
		
	}else if(vm.myCard.card_type == "套餐卡"){
		
		vm.beforePrice = "消费项目:" + vm.sum.name;
		
	}else if(vm.myCard.card_type == "体验卡"){
		
		vm.beforePrice = "原价:" + vm.sum;
		
	}
	
	//点击返回首页
	vm.goBack = function(){
		window.history.go(-4);
	}
})

/**********************************我要续卡*********************************/

module.controller('recardCtrl',function($scope,$stateParams,$state){
	var vm = $scope;

	//获取该张会员卡信息
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	//跳转进行支付
	vm.payShop = function(){
		$state.go("payShop",{id:JSON.stringify(vm.id)});
	}

});

/******************************我要续卡-续卡支付*****************************/

module.controller('payShopCtrl',function($scope,$stateParams,$state,$ionicPopup,$timeout){
	var vm = $scope;

	//获取该张会员卡信息
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id)
	
	//选择其他浏览器对话框
   vm.showAlert = function() {
     var alertPopup = $ionicPopup.alert({
       title: '提示',
       template: '请选择其他浏览器进行支付,点击右上角"..."进行操作!'
     });
     alertPopup.then(function(res) {
       console.log('请选择其他浏览器进行支付,点击右上角"..."进行操作!');
     });
   };

	//确定支付，跳转支付界面
	vm.rePay = function(){
		if(isWeiXin()){
						console.log(" 是来自微信内置浏览器");
						vm.showAlert()
		}else{
						console.log("不是来自微信内置浏览器")
						$state.go("reCardPay",{id:JSON.stringify(vm.id)});
		}

	}

    //判断当前是否在微信内置浏览器
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
			console.log(ua);//mozilla/5.0 (iphone; cpu iphone os 9_1 like mac os x) applewebkit/601.1.46 (khtml, like gecko)version/9.0 mobile/13b143 safari/601.1
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
				return true;
			} else {
				return false;
		}
	}

});

/*********************************续卡支付详情页*****************************/

module.controller('reCardPayCtrl',function($scope,$stateParams){
	var vm = $scope;

	//获取本地存储的uuid；
	vm.uuid = localStorage.getItem('uuid');

	//获取该张会员卡信息
	vm.myCard = JSON.parse($stateParams.id);
	console.log(vm.myCard)
	//获取时间戳，得到订单名称
	var vNow = new Date();
	var sNow = "";
	sNow += String(vNow.getFullYear());
	sNow += String(vNow.getMonth() + 1);
	sNow += String(vNow.getDate());
	sNow += String(vNow.getHours());
	sNow += String(vNow.getMinutes());
	sNow += String(vNow.getSeconds());
	sNow += String(vNow.getMilliseconds());
	vm.payNum = sNow;

	$('form').submit(function(e){
		 var info=$("#a").val();
		 console.log(info);
	})

})

/***********************************会员卡升级*******************************/

module.controller("upterCtrl",function($scope,$stateParams,$http,$ionicActionSheet,$ionicPopup,$timeout,$state){

	//页面间传值，获取会员卡信息；
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	
	//获取会员卡升级调用接口时所需参数
	
	//商户muid;
	vm.muid = vm.id.merchant;
	//用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	//会员卡号码
	vm.code = vm.id.card_code;
	//会员卡级别
	vm.level = vm.id.card_level;
	//会员卡价格
	vm.price = vm.id.price;
	//会员卡金额
	vm.money = vm.id.card_remain;
	//会员卡类别
	vm.cardType = vm.id.card_type;
	
	console.log('卡中余额:'+vm.money);

	//页面初始化，调用卡片所用级别接口
	init(vm.muid,vm.code)
	
	//获取卡片级别接口；
	function init(muid,code){
		var data={
					muid:muid,
					code:code
    		},

		url='../../App/MerchantType/card/levelGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.upter = response;
    			console.log(vm.upter);
    			
    			//定义空数组存放卡片可升级别
    			var newArr = [];
    			
    			//遍历会员卡所有级别，将可升级别放入空数组
    			for(var i=0 ; i<vm.upter.length ; i++){
    				if(Number(vm.upter[i].price)>Number(vm.price)){
    					newArr.push(vm.upter[i]);
    				}
    			}
    			
    			console.log(newArr);
    			
    			vm.upterData = newArr;
    			vm.mySelect = vm.level;
    			//如果可升级别为空，弹窗提示；
				if(vm.upterData.length=='0'){
					showAlert("您的卡已是最高级别!")
				}
    			
   		});
	}
	
	
   //充值金额初始值
   
	vm.sum = 0;
	
	//点击下拉框选项
	vm.getData = function(data){
		
		if(data == null){
			vm.sum = 0;
		}else{
			
			var newStr = Number(data.price)-Number(vm.money);
		
			if(newStr>0){
				vm.sum = newStr
			}else{
				vm.sum = Number(data.price);
			}
			
		}
		
	}
	
	
	//点击升级按钮,进行卡片升级的条件判定和升级操作
	
	vm.upCard = function(data,num){
		console.log(data);
		console.log(num);
		if(data == vm.level && num == '0'){
			hint("您要升级的卡已存在,不能升级")
		}else{
			
				//判断要升的卡级别是否存在
				var data={
						uuid : vm.uuid,
		    			muid : vm.muid,
		    			cardCode : vm.code,
		    			cardLevel : data.level,
		    			cardType : vm.cardType
		    		},
		
				url='../../App/UserType/card/stateGet',
		
				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};
		
		    	$http.post(url, data, postCfg).success(function (response) {
		    			vm.cardResult = response;
		    			console.log(vm.cardResult)
		    			if(vm.cardResult.result_code == "true"){
		    				hint("您要升级的卡已存在,不能升级")
		    			}else if(vm.cardResult.result_code == "false"){
		    				
		    				//判断会员卡余额是否大于卡价格
		    				if(Number(vm.money) >= Number(data.price)){
		    					goUpter(vm.uuid,data.level,vm.muid,vm.code,vm.level,sum)
		    				}else{
		    					
		    					//跳转支付页面
		    					$state.go("upShop",{id:JSON.stringify(vm.id),type:JSON.stringify(data),sum:num});
		    				}
		    				
		    			}
				});
		}
		
	 }


	//余额足够直接升级

	function goUpter(uuid,new_level,muid,cardCode,cardLevel,sum){
				var confirmPopup = $ionicPopup.confirm({
			               title: '提示',
			               template: '您的余额足够，可直接升级'
			        });
            	 	confirmPopup.then(function(res) {

		               if(res) {

		               	var data={
									uuid:uuid,
									new_level:new_level,
									muid:muid,
									cardCode:cardCode,
									cardLevel:cardLevel,
									sum:sum
				    		},

						url='../../App/UserType/card/setLevel',

						postCfg = {
								    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
								    transformRequest: function (data) {
								        return $.param(data);
								    }
						};


				    	$http.post(url, data, postCfg).success(function (response) {

				    			vm.goUpter = response;
				    			console.log(vm.goUpter);

				   		});


		               }else {
		                 console.log('取消升级');
		               }
             		});
	}
	
	// 自定义弹窗
	
	function hint(str){
		
		 var myPopup = $ionicPopup.show({
		         subTitle:str,
		         scope: $scope
           });

           myPopup.then(function(res) {

			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	
	}
	
	//警告对话框
	function showAlert(str){
		var alertPopup = $ionicPopup.alert({
           title: str,
         });
         alertPopup.then(function(res) {
         	$scope.back();
         });
	}
	
})

/**********************************会员卡升级支付*****************************/

module.controller('upShopCtrl',function($scope,$stateParams,$ionicPopup,$state){
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	vm.type = JSON.parse($stateParams.type);
	vm.sum = $stateParams.sum;
	console.log(vm.id);
	console.log(vm.type);
	console.log(vm.sum);
	
	//选择其他浏览器对话框
   vm.showAlert = function() {
     var alertPopup = $ionicPopup.alert({
       title: '提示',
       template: '请选择其他浏览器进行支付,点击右上角"..."进行操作!'
     });
     alertPopup.then(function(res) {
       console.log('请选择其他浏览器进行支付,点击右上角"..."进行操作!');
     });
   };

	//确定支付，跳转支付界面
	vm.rePay = function(){
		if(isWeiXin()){
						console.log(" 是来自微信内置浏览器");
						vm.showAlert()
		}else{
						console.log("不是来自微信内置浏览器")
						$state.go("upCardPay",{id:JSON.stringify(vm.id),type:JSON.stringify(vm.type),sum:vm.sum});
		}

	}

    //判断当前是否在微信内置浏览器
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
			console.log(ua);//mozilla/5.0 (iphone; cpu iphone os 9_1 like mac os x) applewebkit/601.1.46 (khtml, like gecko)version/9.0 mobile/13b143 safari/601.1
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
				return true;
			} else {
				return false;
		}
	}
	
});

/**********************************升级支付详情页*****************************/

module.controller('upCardPayCtrl',function($scope,$stateParams){
	var vm = $scope;
	
	vm.myCard = JSON.parse($stateParams.id);
	vm.type = JSON.parse($stateParams.type);
	vm.sum = $stateParams.sum;
	
	console.log(vm.myCard);
	console.log(vm.type);
	console.log(vm.sum);
	
	
	//时间戳生成随机字符串，作为订单号
	var vNow = new Date();
	var sNow = "";
	sNow += String(vNow.getFullYear());
	sNow += String(vNow.getMonth() + 1);
	sNow += String(vNow.getDate());
	sNow += String(vNow.getHours());
	sNow += String(vNow.getMinutes());
	sNow += String(vNow.getSeconds());
	sNow += String(vNow.getMilliseconds());
	vm.payNum = sNow;

	$('form').submit(function(e){
		 var info=$("#a").val();
		 console.log(info);
	})

})

/*************************************我要预约********************************/

module.controller('orderCtrl',function($scope,$stateParams,$http,$timeout,$ionicPopup,$location){

	var vm = $scope;
	//获取该张卡信息
	var id = JSON.parse($stateParams.id);
	//获取卡片中的muid；
	vm.muid =  id.merchant;
	//获取卡片中的uuid；
	vm.uuid = localStorage.getItem('uuid');
	//获取本地存储的nickname；
	vm.nickname = localStorage.getItem('nickname');
	//获取本地存储的phone；
	vm.phone = localStorage.getItem('phone');

	console.log(id);
	console.log(vm.muid);
	console.log(vm.uuid);
	console.log(vm.name);
	console.log(vm.phone);
	getItem();

	function getItem(){
		var data={
					muid:vm.muid
    		},

		url='../../App/MerchantType/commodity/get',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 $scope.getItem = response;
    			console.log($scope.getItem);

   		});
	}


	//定义接收选择结果变量
	vm.data = {
		secet: "选择预约项目",
    	result: "选择预约日期",
    	sectime:"选择预约时间"
  	};


  	//定义回调函数
    vm.callback=function(value){
        alert( "回调函数获得结果："+ value);
        return false;
    }
    vm.serverData={loadLazyTime:""};

     //模拟默认时间从服务端加载 获取其他获取方式
    $timeout(function () {
        vm.serverData.loadLazyTime="2017-08-16 10:00";
    },1000)

    vm.setSubmit=function(item,dat,tim){
    	var data={
    				uuid:vm.uuid,
    				muid:vm.muid,
    				phone:vm.phone,
    				name:vm.name,
    				content:item,
    				date:dat,
    				time:tim
    		},

		url='../../App/UserType/appoint/app',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
    			 $scope.order = response;
    			console.log($scope.order);
					if($scope.order.result_code =='1'){
						hint('预约成功')
					}else if($scope.order.result_code =='1062'){
						hint('已经预约')
					}else{
						hint('预约失败')
					}
   		});
    }

		function hint(str){
					// 自定义弹窗
					var myPopup = $ionicPopup.show({
						subTitle: str,
						scope: $scope,

					});
					myPopup.then(function(res) {
						console.log(str);
					});
					$timeout(function() {
						 myPopup.close(); // 1秒后关闭弹窗
					}, 1000);
		}

});

/*************************************查看预约********************************/

module.controller('bespeakCtrl',function($scope,$stateParams,$http){
	var vm =　$scope;
	vm.muid = $stateParams.mid;
	vm.uuid = $stateParams.uid;
	var data={
		uuid : vm.uuid,
		muid : vm.muid
	},

	url='../../App/UserType/appoint/get',

	postCfg = {
			    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			    transformRequest: function (data) {
			        return $.param(data);
			}
	};

	$http.post(url, data, postCfg).success(function (response) {
		 vm.staue = response;
		 for(var i=0; i<vm.staue.length; i++){
			 if(vm.staue[i].state=="null"){
			 	vm.staue[i].state="正在处理..."
			 }else if(vm.staue[i].state=="access"){
			 	vm.staue[i].state="已通过"
			 }else if(vm.staue[i].state=="fail"){
			 	vm.staue[i].state="未通过"
			 }
		 }
		console.log(vm.staue);
	});
});

/************************************会员卡转让*******************************/

module.controller('attornCtrl',function($scope,$stateParams,$state,$http,$ionicPopup,$timeout){
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	vm.data={
		count:"0.00",
		num:""
	}
	//显示转让金额
	vm.shank=function(num){
		var shu = num/100 * vm.id.card_remain;
		vm.data.count = shu;
	}

	//不满足转让条件,弹窗提示
	vm.hint = function(str){
			 // 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle: str,
             scope: $scope,

           });
           myPopup.then(function(res) {
             console.log(str);
           });
           $timeout(function() {
              myPopup.close(); // 1秒后关闭弹窗
           }, 1000);
	}


	//确定转让
	vm.goPage=function(id,num,item){
		if(num === ''){
			vm.hint('请输入转让折扣率')
		}else if(num<=0){
			vm.hint('转让折扣率不能为0或负值')
		}else if(num>100){
			vm.hint('转让折扣率不能大于100')
		}else{
			    vm.sum = num/100 * id.card_remain;
			    vm.data.count = vm.sum;
			    //调用转让接口
			    var data={
	    				muid : id.merchant,
	    				uuid : id.user,
	    				cardCode : id.card_code,
	    				cardType : id.card_type,
	    				img_url : id.card_temp_color,
	    				cardLevel : id.card_level,
	    				sum : vm.sum,
	    				rate : num
		    		},

				url='../../App/UserType/card/upToTransfer',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};

		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.att = response;
		    			console.log(vm.att);

		    			if(vm.att.result_code==1){
		    				$state.go("shareInfo",{id:JSON.stringify(id),item:item})
		    			}else if(vm.att.result_code=='1062'){
		    				vm.hint('该卡已转让')
		    			}
		   		});
		}
	}
})

/************************************会员卡分享*******************************/

module.controller('shareCtrl',function($scope,$stateParams,$state,$ionicPopup,$timeout,$http){
	var vm = $scope;
	//获取会员卡信息;
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	//定义输入框内容
	vm.data={
		 num:""
	}
	//手续费率取值范围;
	vm.feeCount = 100-vm.id.rule;
	//不满足分享条件弹窗提示
	vm.hint = function(str){
			 // 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle: str,
             scope: $scope,

           });
           myPopup.then(function(res) {
             console.log(str);
           });
           $timeout(function() {
              myPopup.close(); // 1秒后关闭弹窗
           }, 1000);
	}



	//确定分享
	vm.goPage=function(id,num,item){
		console.log(num)
		if(num===""){
			vm.hint('请输入手续费率')
		}else if(num <= 0){
			vm.hint('手续费率不能为0或负')
		}else if(num>vm.feeCount){
			vm.hint('手续费率不能大于'+vm.feeCount)
		}else{
			    //调用转让接口
			    var data={
	    				muid : id.merchant,
	    				uuid : id.user,
	    				cardCode : id.card_code,
	    				cardType : id.card_type,
	    				img_url : id.card_temp_color,
	    				cardLevel : id.card_level,
	    				sum : id.card_remain,
	    				rate : num
		    		},

				url='../../App/UserType/card/upToShare',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};

		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.share = response;
		    			console.log(vm.share);
		    			if(vm.share.result_code==1){
		    				$state.go("shareInfo",{id:JSON.stringify(id),item:item})
		    			}else if(vm.share.result_code=='1062'){
		    				vm.hint('该卡已分享')
		    			}
		   		});
		}
	}

});

/*********************************会员卡分享详情页****************************/

module.controller('shareInfoCtrl',function($scope,$stateParams,$http){
	var vm = $scope;
	//获取会员卡信息;
	vm.id = JSON.parse($stateParams.id);
	//选择要展示的页面 share/attorn
	vm.item = $stateParams.item;
	console.log(vm.id)

	//获取折扣率接口;
	vm.getRebate = function(muid,uuid,cardCode,cardLevel,method){
		//调用转让接口
			    var data={
	    				muid : muid,
	    				uuid : uuid,
	    				cardCode : cardCode,
	    				cardLevel : cardLevel,
	    				method : method
		    		},

				url='../../App/UserType/card/rateGet',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};

		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.getInfo = response;
		    			console.log(vm.getInfo);
		   		});
	}

	//取消分享或转让接口

	vm.quit = function(method){
		    console.log(method)
			    var data={
	    				muid : vm.id.merchant,
	    				uuid : vm.id.user,
	    				cardCode : vm.id.card_code,
	    				cardLevel : vm.id.card_level,
	    				method : method
		    		},

				url='../../App/UserType/card/moveFromMarket',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};

		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.getQuit = response;
		    			console.log(vm.getQuit);
		    			if(vm.getQuit.result_code==1){
		    				window.history.go(-2);
		    			}else{
		    				console.log('取消失败')
		    			}
		   		});
	}


	if(vm.item=="分享"){
		vm.flag=1;
		vm.method="share";
		vm.getRebate(vm.id.merchant,vm.id.user,vm.id.card_code,vm.id.card_level,vm.method)
	}else{
		vm.flag=0;
		vm.method="transfer";
		vm.getRebate(vm.id.merchant,vm.id.user,vm.id.card_code,vm.id.card_level,vm.method)
	}


});

/*********************************我的会员卡-家庭共享*************************/

module.controller('fshareCtrl',function($scope,$stateParams,$ionicModal,$http,$ionicPopup,$timeout){

	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);

	vm.uuid = localStorage.getItem('uuid');
	vm.muid = vm.id.merchant;
	vm.code = vm.id.card_code;
	vm.level = vm.id.card_level;
	console.log(vm.id);
	console.log(vm.uuid);
	console.log(vm.muid);
	console.log(vm.code);
	console.log(vm.level);
	getShareList(vm.uuid,vm.muid,vm.code,vm.level)



	 function getShareList (uuid,muid,code,level){
	  	var data = {
					uuid : uuid,
					muid : muid,
					card_code : code,
					card_level: level
		},

		url='../../App/UserType/card/share_list',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getShare = response;
    			console.log(vm.getShare);
   		});
	}
	  	//点击删除按钮,解除共享人
	  	vm.detItem = function(item){
			  	console.log(item);
			  	var confirmPopup = $ionicPopup.confirm({
		               title: '提示',
		               template: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;确定要删除该共享人?'
		             });
		             confirmPopup.then(function(res) {
		               if(res) {
		               	var data = {
								share_id : item.uuid,
								uuid : vm.uuid,
								muid : vm.muid,
								card_code : vm.code,
								card_level: vm.level
							},

							url='../../App/UserType/card/share_del',

							postCfg = {
									    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
									    transformRequest: function (data) {
									        return $.param(data);
									    }
							};

							$http.post(url, data, postCfg).success(function (response) {
				    			 vm.getDetShare = response;
				    			 vm.getShare.splice(vm.getShare.indexOf(item), 1);
				    			console.log(vm.getDetShare);
				            });

		               } else {
		                 console.log('You are not sure');
		               }
		             });

	  			}


	//会员卡分享
	function otherShare(phone,name,uuid,muid,code,level){

		  	var data = {
		  				phone : phone,
		  				name : name,
						uuid : uuid,
						muid : muid,
						card_code : code,
						card_level: level
			},

			url='../../App/UserType/card/share',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};


	    	$http.post(url, data, postCfg).success(function (response) {
	    			 vm.otherShare = response;
	    			console.log(vm.otherShare);
	   		});
	}



	$ionicModal.fromTemplateUrl('templates/modal.html', {
	    scope: $scope
	  }).then(function(modal) {
	    vm.modal = modal;
	  });

	  vm.createContact = function(u) {
	  	otherShare(u.phone,u.name,vm.uuid,vm.muid,vm.code,vm.level);
	   //vm.getShare.push({ name: u.name + ' ' + u.phone });
	    vm.modal.hide();
	  };
});

/**********************************投诉理赔**********************************/

module.controller('claimCtrl',function($scope,$stateParams,$http,$ionicPopup,$timeout,$state){
	var vm = $scope;

	//获取该张卡片信息
	vm.myCard = JSON.parse($stateParams.id);
	console.log(vm.myCard);
	
	//获取该张卡片中muid
	vm.muid =  vm.myCard.merchant;
	//获取该张卡片中uuid
	vm.uuid =  localStorage.getItem('uuid');
	//获取该张卡号
	vm.cardCode = vm.myCard.card_code;
	//获取会员卡级别
	vm.cardLevel = vm.myCard.card_level;
	//获取该张卡类别
	vm.cardType = vm.myCard.card_type;
	//获取购卡金额
	vm.price = vm.myCard.price;
	//获取卡内余额
	vm.cardRem = vm.myCard.card_remain;
	
	
	console.log(vm.muid);
	console.log(vm.uuid);
	console.log(vm.cardType);
	
	//投诉信息列表
  	vm.lodgeList=[{"cause": "商家倒闭"},{"cause": "商家跑路"}]
	
	//定义提交数据信息
	
  	vm.data = {
  		cause:""
  	}
  	

  	//提交理赔申请
  	
	vm.setDge=function(item){
		
		console.log(item);
			if(item==""){
				hint("请选择原因")
			}else{
				
						//  confirm 对话框
			             var confirmPopup = $ionicPopup.confirm({
			               template: "理赔处理期间,您的卡片将停止一切操作和消费,您确定要投诉理赔吗?"
			             });
			             
			             confirmPopup.then(function(res) {
				             	
				               if(res) {
				                 
						                 	var data = {
												uuid : vm.uuid,
												muid : vm.muid,
												card_code : vm.cardCode,
												card_level : vm.cardLevel,
												card_type : vm.cardType,
												reason : item.cause
											},
									
											url='../../App/UserType/claim/commit',
									
											postCfg = {
													    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
													    transformRequest: function (data) {
													        return $.param(data);
													    }
											};
									
									
									    	$http.post(url, data, postCfg).success(function (response) {
									    			 vm.apply = response;
									    			console.log(vm.apply);
									    			if(vm.apply.result_code == 1){
									    				showConfirm()
									    			}else{
									    				hint('提交申请失败!')
									    			}
									
									   		});
				                 
				               	} else {
				               	
				                 			console.log('放弃理赔申请操作!');
				                 			vm.data.cause = "";
				               	}
		        		});
					
	   		}
		
	}
	

	//弹窗提示
	function hint(str){
		var myPopup = $ionicPopup.show({
         subTitle: str,
         scope: $scope,
        });
        
       myPopup.then(function(res) {
         console.log(str)
       });
       
       $timeout(function() {
          myPopup.close(); // 1秒后关闭弹窗
       }, 1000);
	}
	
	
	//理赔申请成功,是否查看状态
	function showConfirm () {
     var confirmPopup = $ionicPopup.confirm({
       title: '温馨提示',
       template: '<p class="tce">理赔申请成功,是否查看处理状态</p>'
     });
     confirmPopup.then(function(res) {
       if(res) {
       	 var page = -2;
         $state.go('process',{id:JSON.stringify(vm.myCard),type:page})
       } else {
         $scope.back()
       }
     });
   };
});

/**********************************投诉理赔中********************************/

module.controller("processCtrl",function($scope,$stateParams,$http,$ionicPopup,$timeout,$state){
	
	var vm = $scope;

	//获取该张卡片信息
	vm.myCard = JSON.parse($stateParams.id);
	console.log(vm.myCard);
	
	//要跳转页面的层级;
	
	vm.page = $stateParams.type;
	console.log(vm.page);
	
	
	//获取该张卡片中muid
	vm.muid =  vm.myCard.merchant;
	//获取该张卡片中uuid
	vm.uuid =  localStorage.getItem('uuid');
	//获取该张卡号
	vm.cardCode = vm.myCard.card_code;
	//获取会员卡级别
	vm.cardLevel = vm.myCard.card_level;
	//获取该张卡类别
	vm.cardType = vm.myCard.card_type;
	//获取购卡金额
	vm.price = vm.myCard.price;
	//获取卡内余额
	vm.cardRem = vm.myCard.card_remain;
	
	//点击返回会员卡页面
    vm.backCard = function (){
    	window.history.go(vm.page);
    }
    
	
	//投诉信息列表
  	vm.lodgeList=[{"cause": "商家倒闭"},{"cause": "商家跑路"}]
  	
  	console.log(vm.lodgeList);
	
	//定义提交数据信息
	
  	vm.data = {
  		cause:""
  	}
	
	//调用理赔进度接口
	getClaim(vm.uuid,vm.muid,vm.cardCode,vm.cardLevel,vm.cardType)
	
	//获取理赔进度接口
	function getClaim(uuid,muid,card_code,card_level,card_type){
		
				var data = {
							uuid : uuid,
							muid : muid,
							card_code : card_code,
							card_level : card_level,
							card_type : card_type
				},
		
				url='../../App/UserType/claim/get',
		
				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};
		
		
		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.getSpeed = response;
		    			console.log(vm.getSpeed);
		    			
		    			for(var i=0 ; i< vm.getSpeed.length; i++){
		    				
		    				if(vm.getSpeed[i].reason == "商家倒闭"){
			    				console.log("商家倒闭")
			    				vm.data.cause = vm.lodgeList[0];
			    				console.log(vm.data.cause);
		    				
			    			}else if(vm.getSpeed[i].reason == "商家跑路"){
			    				console.log("商家跑路")
			    				vm.data.cause = vm.lodgeList[1];
			    				console.log(vm.data.cause);
			    			}
		    				
		    			}
		    			
		   		});
	}
  	
  	
  	//弹窗提示
	function hint(str){
		var myPopup = $ionicPopup.show({
         subTitle: str,
         scope: $scope,
        });
        
       myPopup.then(function(res) {
	       	if(str == "撤销成功"){
	       		vm.backCard()
	       	}else{
	       		return
	       	}
         
       });
       
       $timeout(function() {
          myPopup.close(); // 1秒后关闭弹窗
       }, 1000);
	}
	
	
	
	//撤销理赔接口
	
    vm.revoke = function (item){
    	
    		console.log(item)
    		
    	    if(item[0].state == "COMMITTED"){
    			
    			var data = {
							uuid : vm.uuid,
							muid : vm.muid,
							card_code : vm.cardCode,
							card_level : vm.cardLevel,
							card_type : vm.cardType
				},
		
				url='../../App/UserType/claim/revoke',
		
				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};
		
		
		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.revokeData = response;
		    			console.log(vm.revokeData);
		    			
		    			if(vm.revokeData.result_code == '1'){
		    				hint("撤销成功")
		    			}else{
		    				hint("撤销失败")
		    			}
		    			
		   		});
    			
    		}else{
    			
    			hint("平台处理中,不能进行撤销")
    		}
    			
	}
    
   
})

/**********************************理赔核查失败******************************/

module.controller('failedCtrl',function($scope,$stateParams,$http,$state){
	var vm = $scope;

	//获取该张卡片信息
	vm.myCard = JSON.parse($stateParams.id);
	console.log(vm.myCard);
	
	//获取该张卡片中muid
	vm.muid =  vm.myCard.merchant;
	//获取该张卡片中uuid
	vm.uuid =  localStorage.getItem('uuid');
	//获取该张卡号
	vm.cardCode = vm.myCard.card_code;
	//获取会员卡级别
	vm.cardLevel = vm.myCard.card_level;
	//获取该张卡类别
	vm.cardType = vm.myCard.card_type;
	//获取购卡金额
	vm.price = vm.myCard.price;
	//获取卡内余额
	vm.cardRem = vm.myCard.card_remain;
	
	
	//投诉信息列表
  	vm.lodgeList=[{"cause": "商家倒闭"},{"cause": "商家跑路"}]
  	
  	console.log(vm.lodgeList);
	
	//定义提交数据信息
	
  	vm.data = {
  		cause:""
  	}
	
	//调用理赔进度接口
	getClaim(vm.uuid,vm.muid,vm.cardCode,vm.cardLevel,vm.cardType)
	
	//获取理赔进度接口
	function getClaim(uuid,muid,card_code,card_level,card_type){
		
				var data = {
							uuid : uuid,
							muid : muid,
							card_code : card_code,
							card_level : card_level,
							card_type : card_type
				},
		
				url='../../App/UserType/claim/get',
		
				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};
		
		
		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.getSpeed = response;
		    			console.log(vm.getSpeed);
		    			
		    			for(var i=0 ; i< vm.getSpeed.length; i++){
		    				
		    				if(vm.getSpeed[i].reason == "商家倒闭"){
			    				console.log("商家倒闭")
			    				vm.data.cause = vm.lodgeList[0];
			    				console.log(vm.data.cause);
		    				
			    			}else if(vm.getSpeed[i].reason == "商家跑路"){
			    				console.log("商家跑路")
			    				vm.data.cause = vm.lodgeList[1];
			    				console.log(vm.data.cause);
			    			}
		    				
		    			}
		    			
		   		});
	}
	
	//继续申请
	vm.goClaim = function(){
		$state.go('claim',{id:JSON.stringify(vm.myCard)})
	}
  	
	
})

/*********************************我的钱包主页面******************************/

module.controller("myBaoCtrl",function($scope,$http,$state){
	var vm = $scope;

	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');

	//调用接口,获取余额信息
	getInfo(vm.uuid)

	//调用接口,获取银行卡列表
	getBank(vm.uuid)

	//获取余额信息
	function getInfo(uuid){
		var data = {
					uuid : uuid,
					type : 'remain'

		},

		url='../../App/UserType/user/accountGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.balance = response;
    			console.log(vm.balance);
    			if(vm.balance.remain==""){
    				vm.balance.remain="0.00元"
    			}
   		});
   	}

   	//获取银行卡列表

   	function getBank(uuid){
   		var data = {
					uuid : uuid,

		},

		url='../../App/UserType/bank/get',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.bank = response;
    			console.log(vm.bank);
    			if(vm.bank.length>0){
    				vm.page ='deposit'
    			}else{
    				vm.page ='addBank'
    			}

   		});
   	}

   	//判断跳转添加会员卡/提现页面
   	vm.goPage = function(newPage){
   	   console.log(newPage);
   	   console.log(vm.bank);
   		if(newPage=='addBank'){
   			$state.go('addBank',{})
   		}else if(newPage == "deposit"){
   			//筛选出被选中的银行卡
   			for(var i=0; i<vm.bank.length ; i++){
   				if(vm.bank[i].state =="true"){
   					vm.bankCard = vm.bank[i];
   				}
   			}

   			console.log(vm.bankCard);
   			$state.go('deposit',{id:JSON.stringify(vm.bankCard),type:vm.balance.remain})
   		}
   	}

   	//返回我的页面
   	vm.goBack = function(){
   		$state.go('tabs.myshow',{})
   	}

})

/*******************************我的钱包-明细********************************/

module.controller('detailCtrl',function($scope,$http){
	var vm = $scope;

	//获取本地uuid;
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);

	//调用函数,获取明细
	getDeta(vm.uuid);

	//请求我的钱包明细

	function getDeta(uuid){
		var data = {
					uuid : uuid
		},

		url='../../App/UserType/user/getBill',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		
    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.detail = response;
    			console.log(vm.detail);

   		});
	}

})

/*******************************我的钱包-充值支付****************************/

module.controller("reChanCtrl",function($scope,$ionicPopup,$timeout,$state){
	var vm = $scope;

	//定义充值金额;
	vm.data={
		reChan:""
	}

	//选择其他浏览器对话框
	   vm.showAlert = function() {
	     var alertPopup = $ionicPopup.alert({
	       title: '提示',
	       template: '请选择其他浏览器进行支付,点击右上角"..."进行操作!'
	     });
	     alertPopup.then(function(res) {
	       console.log('请选择其他浏览器进行支付,点击右上角"..."进行操作!');
	     });
	   };

	//点击跳转支付详情页
	vm.reChanPay=function(prc){
		if(isWeiXin()){
						console.log(" 是来自微信内置浏览器");
						vm.showAlert();
		}else{
						console.log("不是来自微信内置浏览器")
						if(prc==""){
							tan("请输入金额!")
						}else{
							$state.go("reChanPay",{id:prc})
						}
		}
	}


	//弹窗提示效果
	function tan(str){
		 // 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           	console.log("提示输入金额!")
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);

	}



	//判断当前是否在微信内置浏览器
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
			console.log(ua);//mozilla/5.0 (iphone; cpu iphone os 9_1 like mac os x) applewebkit/601.1.46 (khtml, like gecko)version/9.0 mobile/13b143 safari/601.1
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
				return true;
			} else {
				return false;
		}
	}
});

/****************************我的钱包-充值支付详情页*************************/

module.controller("reChanPayCtrl",function($scope,$stateParams){
	var vm = $scope;

	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	//本地获取用户nickname;
	vm.nickname = localStorage.getItem('nickname');

	//获取支付价格
	vm.price = $stateParams.id;
	console.log(vm.price);
	//获取支付时间戳
	var vNow = new Date();
	var sNow = "";
	sNow += String(vNow.getFullYear());
	sNow += String(vNow.getMonth() + 1);
	sNow += String(vNow.getDate());
	sNow += String(vNow.getHours());
	sNow += String(vNow.getMinutes());
	sNow += String(vNow.getSeconds());
	sNow += String(vNow.getMilliseconds());

	//时间戳作为订单名;
	vm.payNum = sNow;
})

/****************************我的钱包-提现-添加银行卡***********************/

module.controller('addBankCtrl',function($scope,$stateParams,$state){
	var vm = $scope;

	//获取我的钱包金额
	vm.sum = $stateParams.id;
	console.log(vm.sum)

	//跳转银行卡输入信息页面
	vm.goPage = function(){
		$state.go('addcard',{id:-2})
	}
})

/********************************我的钱包-提现*****************************/

module.controller('depositCtrl',function($scope,$stateParams,$state,$ionicPopup,$timeout,$http){
	var vm = $scope;

	//本地获取用户信息
	vm.uuid = localStorage.getItem('uuid')
	vm.nickname = localStorage.getItem('nickname')
	console.log(vm.uuid)
	console.log(vm.nickname)

	//定义提现金额

	vm.data={
		num:""
	}

	//获取被选中的银行卡
	vm.bk = $stateParams.id;
	console.log(vm.bk);
	vm.bankCard = JSON.parse($stateParams.id);
	console.log(vm.bankCard);

	//获取可提现金额
	vm.type = $stateParams.type;
	vm.name = vm.bankCard.name;
	vm.bank = vm.bankCard.bank;
	vm.ccount = vm.bankCard.number;

	//转换时间格式 yyyy-MM-dd HH:mm:ss

	function formatDate(date, format) {
	    if (!date) return;
	    if (!format) format = "yyyy-MM-dd";
	    switch(typeof date) {
	        case "string":
	            date = new Date(date.replace(/-/, "/"));
	            break;
	        case "number":
	            date = new Date(date);
	            break;
	    }
	    if (!date instanceof Date) return;
	    var dict = {
	        "yyyy": date.getFullYear(),
	        "M": date.getMonth() + 1,
	        "d": date.getDate(),
	        "H": date.getHours(),
	        "m": date.getMinutes(),
	        "s": date.getSeconds(),
	        "MM": ("" + (date.getMonth() + 101)).substr(1),
	        "dd": ("" + (date.getDate() + 100)).substr(1),
	        "HH": ("" + (date.getHours() + 100)).substr(1),
	        "mm": ("" + (date.getMinutes() + 100)).substr(1),
	        "ss": ("" + (date.getSeconds() + 100)).substr(1)
	    };
		    return format.replace(/(yyyy|MM?|dd?|HH?|ss?|mm?)/g, function() {
		        return dict[arguments[0]];
		    });
	}

	//获取时间
	var vNow = new Date();
	vm.date = formatDate(vNow, "yyyy-MM-dd HH:mm:ss");

	//获取我的钱包金额
	vm.sum = $stateParams.type;
	console.log(vm.sum);
	vm.newSum = vm.sum.substring(0,vm.sum.length-1)
	console.log(vm.newSum);

	//点击跳转,选择银行卡
	vm.goBankCard = function(){
		$state.go('chooseBank',{id:vm.sum})
	}

	//弹窗提示效果
	vm.tan = function(str){
		 // 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           	console.log("提示输入金额!")
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);

	}

	 //提现接口
    vm.cash = function(uuid,nickname,name,bank,account,date,sum){

    		var data = {
					uuid : uuid,
					nickname : nickname,
					name : name,
					bank : bank,
					account : account,
					date : date,
					sum : sum
			},

			url='../../App/UserType/user/withdraw',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};


	    	$http.post(url, data, postCfg).success(function (response) {
	    			 vm.result = response;
	    			console.log(vm.result);
	    			$state.go('tradeInfo',{id:JSON.stringify(vm.bankCard),type:vm.type,sum:sum,date:date})
	   		});
    }



	//确认或者取消提现操作
	vm.show = function(num) {
         var confirmPopup = $ionicPopup.confirm({
           template: '<p class="tce">本次提现金额'+num+'元</p>'
         });

         confirmPopup.then(function(res) {
           if(res) {
           	//确认提现,调用接口
             vm.cash(vm.uuid,vm.nickname,vm.name,vm.bank,vm.account,vm.date,num)
           } else {
             console.log('取消提现操作');
           }
         });
    };



	//点击立即提现
	vm.getMon = function(sum){
		console.log(sum)
		if(vm.newSum == 0){
			vm.tan('余额不足!')
		}else if(sum == ""){
			vm.tan('请输入金额!')
		}else if(sum>vm.newSum){
			vm.tan('余额不足!')
		}else{
			vm.show(sum)
		}

	}

	//点击返回我的钱包页面
	vm.goPage = function(){
		$state.go('myBao',{})
	}

})

/****************************我的钱包-提现-提现详情页**********************/

module.controller('tradeInfoCtrl',function($scope,$stateParams,$state){
	var vm = $scope;

	//获取数据
	//银行卡
	vm.bankCard = JSON.parse($stateParams.id);
	vm.bank = vm.bankCard.bank;
	//可提现金额
	vm.type = $stateParams.type;
	//已提现金额
	vm.sum = $stateParams.sum;
	//提现时间
	vm.date = $stateParams.date;

	console.log(vm.name)
	console.log(vm.type)
	console.log(vm.sum)
	console.log(vm.date)

	//返回提现界面
	vm.goPage = function(){
		$state.go('deposit',{id:JSON.stringify(vm.bankCard),type:vm.type-vm.sum})
	}
})

/**************************我的钱包-提现-选择银行卡************************/

module.controller('chooseBankCtrl',function($scope,$stateParams,$http,$state,$ionicPopup,$timeout){
	var vm = $scope;

	//本地获取用户:uuid;
	vm.uuid = localStorage.getItem('uuid');

	//获取我的钱包金额
	vm.sum = $stateParams.id;
	console.log(vm.sum);

	//调用银行卡列表接口
	getBank(vm.uuid);


	//定义所选银行卡列表
	vm.data={
		bank:'',
		showDelete: false
	}


	//使用新卡提现

	vm.item='使用新卡提现';

	//获取银行卡列表接口
   	function getBank(uuid){
   		var data = {
					uuid : uuid
			},

	    url='../../App/UserType/bank/get',

	    postCfg = {
			    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			    transformRequest: function (data) {
			        return $.param(data);
			    }
	    };


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.bankCard = response;
    			console.log(vm.bankCard);

					for(var i=0; i<vm.bankCard.length; i++){
						if( vm.bankCard[i].state == 'true')
								vm.data.bank = vm.bankCard[i];
						}
   		});
   	}


		//弹窗提示
		vm.hint = function(str){
	           var myPopup = $ionicPopup.show({
	             subTitle: str,
	             scope: $scope,
	           });
	           myPopup.then(function(res) {
	             console.log(str);
	           });
	           $timeout(function() {
	              myPopup.close(); // 1秒后关闭弹窗
	           }, 1000);
	    };


   	//选择银行卡后,跳转提现页面

   	vm.setBank=function(item){
   		console.log(item);
   		if(item=='使用新卡提现'){
   			$state.go('addcard',{id:-1});
   		}else if(item==''){
				vm.hint('请选择要绑定的银行卡')
			}else{

   			//设置默认银行卡
	   			var data = {
						uuid : vm.uuid,
						number : item.number
				},

				url='../../App/UserType/bank/bind',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};


		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.result = response;
		    			console.log(vm.result);
		    			$state.go('deposit',{id:JSON.stringify(item),type:vm.sum})
		   		});
   		}
   	}


	//删除银行卡操作
    vm.onItemDelete = function(item) {
  	   	var confirmPopup = $ionicPopup.confirm({
	       title: '提示',
	       template: '<p class="tce">确定要删除该银行卡?</p>'
	     });

	     confirmPopup.then(function(res) {
	       if(res) {

	          	var data = {
													uuid : vm.uuid,
													number : item.number
								},

								url='../../App/UserType/bank/delete',

								postCfg = {
										    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
										    transformRequest: function (data) {
										        return $.param(data);
										    }
								};


						    	$http.post(url, data, postCfg).success(function (response) {
						    			 vm.detBank= response;
						    			console.log(vm.detBank);
						    			if(vm.detBank.result_code==0){
						    				console.log('删除银行卡失败')
						    			}else{
						    				vm.bankCard.splice(vm.bankCard.indexOf(item),1);
												vm.data.bank = vm.bankCard[0]
						    			}

						   		});

			       } else {
			          console.log('放弃删除操作')
			       }
	     });
    };
})

/*************************我的钱包-提现-添加银行卡*************************/

module.controller('addCardCtrl',function($scope,$stateParams,$http,$ionicPopup,$timeout){
	var vm = $scope;

	//获取本地uuid
	vm.uuid = localStorage.getItem('uuid');

	//获取页面传值,判断要返回的页面
	vm.page = $stateParams.id;
	console.log(vm.page);

	//定义参数
	vm.data={
		bank : '',
		cardCode : '',
		name : '',
		idCard : '',
		phone : ''
	}

	//条件不满足,弹窗提示
	vm.hint = function(str){
           var myPopup = $ionicPopup.show({
             subTitle: str,
             scope: $scope,
           });
           myPopup.then(function(res) {
             console.log(str);
           });
           $timeout(function() {
              myPopup.close(); // 3秒后关闭弹窗
           }, 1000);
    };



	//绑定银行卡
	vm.bind = function(bank,cardCode,name,idCard,phone){
		if(bank==''){
			vm.hint('请输入开户行')
		}else if(cardCode==''){
			vm.hint('请输入银行卡号')
		}else if(!luhmCheck(cardCode)){
			vm.hint('银行卡格式不正确')
		}else if(name==''){
			vm.hint('请输入您的真实姓名')
		}else if(idCard==''){
			vm.hint('请输入身份证号')
		}else if(!(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(idCard))){
			vm.hint('身份证格式不正确')
		}else if(phone==''){
			vm.hint('请输入手机号')
		}else if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone))){
			vm.hint('手机号码格式不正确')
		}else{

				var data = {
						uuid : vm.uuid,
						name : name,
						bank : bank,
						number : cardCode
				},

				url='../../App/UserType/bank/add',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};

		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.bankCard = response;
		    			console.log(vm.bankCard);
		    			if(vm.bankCard.result_code == 1){
		    			 	vm.hint('添加成功')

								//将添加成功的银行卡置为默认；
								setBank(cardCode)
		    			}else if(vm.bankCard.result_code == 1062){
		    				vm.hint('添加重复')
		    			}
		   		});
		}
	}

	//将新添加的银行卡置为默认
	function setBank(num){
		//设置默认银行卡
			var data = {
				uuid : vm.uuid,
				number : num
		},

		url='../../App/UserType/bank/bind',

		postCfg = {
						headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						transformRequest: function (data) {
								return $.param(data);
						}
		};


			$http.post(url, data, postCfg).success(function (response) {
					 vm.result = response;
					console.log(vm.result);
					console.log('已置为默认银行卡')
			});
	}


	//判断银行卡格式方法
	function luhmCheck(bankno) {

			if(bankno.length < 16 || bankno.length > 19) {
				return false;
			}

			var num = /^\d*$/; //全数字

			if(!num.exec(bankno)) {
				return false;
			}

			//开头6位
			var strBin = "10,18,30,35,37,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,58,60,62,65,68,69,84,87,88,94,95,98,99";

			if(strBin.indexOf(bankno.substring(0, 2)) == -1) {
				return false;
			}

			var lastNum = bankno.substr(bankno.length - 1, 1); //取出最后一位（与luhm进行比较）
			var first15Num = bankno.substr(0, bankno.length - 1); //前15或18位
			var newArr = new Array();

			for(var i = first15Num.length - 1; i > -1; i--) { //前15或18位倒序存进数组
				newArr.push(first15Num.substr(i, 1));
			}

			var arrJiShu = new Array(); //奇数位*2的积 <9
			var arrJiShu2 = new Array(); //奇数位*2的积 >9
			var arrOuShu = new Array(); //偶数位数组

			for(var j = 0; j < newArr.length; j++) {
				if((j + 1) % 2 == 1) { //奇数位
					if(parseInt(newArr[j]) * 2 < 9)
						arrJiShu.push(parseInt(newArr[j]) * 2);
					else
						arrJiShu2.push(parseInt(newArr[j]) * 2);
				} else //偶数位
					arrOuShu.push(newArr[j]);
			}

			var jishu_child1 = new Array(); //奇数位*2 >9 的分割之后的数组个位数
			var jishu_child2 = new Array(); //奇数位*2 >9 的分割之后的数组十位数

			for(var h = 0; h < arrJiShu2.length; h++) {
				jishu_child1.push(parseInt(arrJiShu2[h]) % 10);
				jishu_child2.push(parseInt(arrJiShu2[h]) / 10);
			}

			var sumJiShu = 0; //奇数位*2 < 9 的数组之和
			var sumOuShu = 0; //偶数位数组之和
			var sumJiShuChild1 = 0; //奇数位*2 >9 的分割之后的数组个位数之和
			var sumJiShuChild2 = 0; //奇数位*2 >9 的分割之后的数组十位数之和
			var sumTotal = 0;

			for(var m = 0; m < arrJiShu.length; m++) {
				sumJiShu = sumJiShu + parseInt(arrJiShu[m]);
			}

			for(var n = 0; n < arrOuShu.length; n++) {
				sumOuShu = sumOuShu + parseInt(arrOuShu[n]);
			}

			for(var p = 0; p < jishu_child1.length; p++) {
				sumJiShuChild1 = sumJiShuChild1 + parseInt(jishu_child1[p]);
				sumJiShuChild2 = sumJiShuChild2 + parseInt(jishu_child2[p]);
			}

			//计算总和
			sumTotal = parseInt(sumJiShu) + parseInt(sumOuShu) + parseInt(sumJiShuChild1) + parseInt(sumJiShuChild2);
			//计算Luhm值
			var k = parseInt(sumTotal) % 10 == 0 ? 10 : parseInt(sumTotal) % 10;
			var luhm = 10 - k;

			if(lastNum == luhm) {
				return true;
			} else {
				return false;
			}
	}

	//返回要去页面
	vm.goBack = function(num){
		console.log(num)
		window.history.go(num);
	}

})

/****************************我的钱包-我的红包****************************/

module.controller("redPageCtrl",function($scope,$http,$ionicPopup,$timeout,$state){
	var vm = $scope;
	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	//本地获取用户headimage;
	vm.headimage = localStorage.getItem('headimage');
	//获取红包信息;
	 getRed(vm.uuid);

	function getRed(uuid){
		var data = {
					uuid : uuid,
		},

		url='../../App/UserType/user/getRedPacket',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getRed = response;
    			console.log(vm.getRed);

   		});
	}

	//红包提现弹窗提示
	vm.hint=function(str){
		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           	console.log("红包提现!")
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}



	//红包提现
	vm.deposit =function(sum){
		console.log(sum);
		console.log(typeof sum);
		if(sum == 0){
			vm.hint("没有可提现金额")
		}else if(sum < 100){
			vm.hint("红包金额大于100方可提现")
		}else if(sum >= 100){
			$state.go('redCash',{id:sum})
   		}
	}

});

/****************************我的钱包-红包提现****************************/

module.controller('redCashCtrl',function($scope,$stateParams,$http,$ionicPopup,$timeout,$location){
	var vm = $scope;
	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	//页面间传值,获取可提现金额
	vm.sum = $stateParams.id;
	console.log(vm.uuid);
	console.log(vm.sum);

	//定义提现金额
	vm.data={
		num:""
	}


    //提现对话框
   vm.showConfirm = function(num) {
     var confirmPopup = $ionicPopup.confirm({
		       title:'提示',
		       template:'<p class="tce">本次提现金额'+num+'元</p>'
     });
     confirmPopup.then(function(res) {
     		if(res){
       		    var data = {
							uuid : vm.uuid,
							sum  : num
				},

				url='../../App/UserType/user/withdrawRedPacket',

				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};


		    	$http.post(url, data, postCfg).success(function (response) {
		    			 vm.getSum = response;
		    			console.log(vm.getSum);
		    			$location.path("/redpage")
		   		});
		   	}else{
		   		console.log('放弃本次操作!')
		   	}

     });
   };

	//红包提现弹窗提示
	vm.hint=function(str){
		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           	console.log("红包提现!")
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}


	//提现
	vm.getMon=function(sum){
		if(sum==0){
				    vm.hint('提现金额须为100整数倍')
		}else if(sum<100){
							vm.data.num=0;
							vm.hint('提现金额须为100整数倍')
		}else if(sum>=100){
							var newNum = Math.floor(sum/100)*100;
							console.log(newNum);
							vm.showConfirm(newNum);
		}
	}

})

/****************************我的钱包-商消乐优惠券************************/

module.controller("couponCtrl",function($scope,$stateParams,$http){
	var vm = $scope;

	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);

	getCoupon(vm.uuid);

	//获取平台优惠券
	function getCoupon(uuid){
		var data = {
					uuid : uuid,
		},

		url='../../App/UserType/user/getSxlCoupon',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getCoupon = response;
    			console.log(vm.getCoupon);

   		});
	}
})

/*********************************我的优惠券*****************************/

module.controller("myQuanCtrl",function($scope,$ionicLoading,$http){
	var vm = $scope;

	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);
	
	
	/*********商户优惠券*********/
	
	//页码
	var index = 1;
	var isLock=false;
	
	//初始化我的优惠券数据
    vm.getMyQuan = [];
    
    
    //上拉加载
    vm.loadMore = function () {
        if(isLock)return;
        isLock=true;
        
        $ionicLoading.show({
		    content: 'Loading',
		    animation: 'fade-in',
		    showBackdrop: true,
		    maxWidth: 200,
		    showDelay: 0
	  	});
        
        var data = {
					uuid : vm.uuid,
					index: index
		},
		
        url='../../App/MerchantType/coupon/userGet',
        postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		
        $http.post(url, data, postCfg).success(function (response) {
        	
        	if (response.length == 0) {
                $scope.hasmore = true;
                $ionicLoading.hide();
                return;
            }
        	
        	index++;
            vm.getMyQuan = vm.getMyQuan.concat(response);
    		console.log(vm.getMyQuan);
			$ionicLoading.hide();
			
   		}).finally(function (error) {
            isLock = false;
            $scope.$broadcast('scroll.infiniteScrollComplete');
            $scope.$broadcast('scroll.refreshComplete');
        });
        
    }
    
    //下拉刷新
    vm.doRefresh = function () {
        index = 1;
        vm.getMyQuan = [];
        vm.loadMore();
    }
    
    //页面初始化
	vm.loadMore();
	
	
	//点击查看详情
	
	//初始化开关按钮
	vm.showData = false;
	vm.openInfo = function(index){
			if(vm.showData == false){
				vm.getMyQuan[index].showData=true;
				vm.showData = !vm.showData;
			}else{
				vm.getMyQuan[index].showData=false;
				vm.showData = !vm.showData;
			}
	}
	
	
	
	/*********商消乐优惠券*********/
	
	
	getCoupon(vm.uuid);

	//获取平台优惠券
	function getCoupon(uuid){
		var data = {
					uuid : uuid,
		},

		url='../../App/UserType/user/getSxlCoupon',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getCoupon = response;
    			console.log(vm.getCoupon);

   		});
	}
	
});

/********************************不可用优惠券****************************/

module.controller('disQuanCtrl',function($scope,$ionicLoading,$http){
	
	var vm = $scope;
	
	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	
	//页码
	var index = 1;
	var isLock=false;
	
	//初始化我的优惠券数据
    vm.disQuan = [];
    
    
    //上拉加载
    vm.loadMore = function () {
        if(isLock)return;
        isLock=true;
        
        $ionicLoading.show({
		    content: 'Loading',
		    animation: 'fade-in',
		    showBackdrop: true,
		    maxWidth: 200,
		    showDelay: 0
	  	});
        
        var data = {
					uuid : vm.uuid,
					index: index
		},
		
        url='../../App/UserType/coupon/invalidateGet',
        
        postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		
        $http.post(url, data, postCfg).success(function (response) {
        	
        	if (response.length == 0) {
                $scope.hasmore = true;
                $ionicLoading.hide();
                return;
            }
        	
        	index++;
            vm.disQuan = vm.disQuan.concat(response);
    		console.log(vm.disQuan);
			$ionicLoading.hide();
			
   		}).finally(function (error) {
            isLock = false;
            $scope.$broadcast('scroll.infiniteScrollComplete');
            $scope.$broadcast('scroll.refreshComplete');
        });
        
    }
    
    //下拉刷新
    vm.doRefresh = function () {
        index = 1;
        vm.disQuan = [];
        vm.loadMore();
    }
    
    //页面初始化
	vm.loadMore();
	
	//初始化开关按钮
	vm.showData = false;
	vm.openInfo = function(index){
			if(vm.showData == false){
				vm.disQuan[index].showData=true;
				vm.showData = !vm.showData;
			}else{
				vm.disQuan[index].showData=false;
				vm.showData = !vm.showData;
			}
	}
	
	
	
})

/*****************************我的优惠券-代金券**************************/

module.controller("cashCtrl",function($scope,$stateParams){
	var vm = $scope;
	myCash = JSON.parse($stateParams.id);
	vm.myCash = myCash;
	console.log(vm.myCash);
	vm.uuid = vm.myCash.uuid;
	vm.coupon_id = vm.myCash.coupon_id;
	
	var qrcode = new QRCode("qrcode", {
		    text: '{"coupon_id":"'+vm.coupon_id+'",'+'\n'+'"uuid":"'+vm.uuid+'"}',
		    width : 230,
		    height : 230,
		    colorDark : "#000000",
		    colorLight : "#ffffff",
		    correctLevel : QRCode.CorrectLevel.H
		});
		
    //初始化开关按钮
	vm.showData = false;
	vm.openInfo = function(){
			if(vm.showData == false){
				vm.showData = !vm.showData;
			}else{
				vm.showData = !vm.showData;
			}
	}
	
	
});

/*********************************我的消费******************************/

module.controller("myShopCtrl",function($scope,$http,$ionicPopup,$timeout){
	var vm = $scope;

	//获取本地存储的uuid;
	vm.uuid=localStorage.getItem('uuid');
	//调用刷卡消费接口;
	getMyShop(vm.uuid)
	//调用办卡记录接口;
	getHandle(vm.uuid)
	
	

	//删除成功或失败弹窗提示
    vm.hint = function(str){

       var myPopup = $ionicPopup.show({
         title: str,
         scope: $scope,
       });
       myPopup.then(function(res) {
       		console.log(str)
       });
       $timeout(function() {
          myPopup.close(); // 1秒后关闭弹窗
       }, 1000)

    }
    
     

	//刷卡消费接口
	function getMyShop(uuid){
		var data = {
					uuid : uuid,
		},

		url='../../App/UserType/Record/pay',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getMyShop = response;
    			console.log(vm.getMyShop);
   		});
	}
	
	
	
	
	//办卡记录接口
	function getHandle(uuid){
		var data = {
					uuid : uuid,
		},

		url='../../App/UserType/Record/card',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getCard = response;
    			console.log(vm.getCard);
   		});
	}
	


	//删除消费记录

	vm.data = {
	    showDelete: false
	};

    vm.onItemDelete = function(item) {

    	var data = {
					uuid : item.user,
					datetime : item.datetime
		},

		url='../../App/UserType/user/cnDel',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.detShop = response;
    			console.log(vm.detShop);
    			if(vm.detShop.result_code==1){
    				vm.getMyShop.splice(vm.getMyShop.indexOf(item), 1);
    				vm.hint("删除成功")
    			}else{
    				vm.hint("删除失败")
    			}

   		});

    };
    
    
    //删除消费记录
     
     vm.deteItem = function(item,index){
     	var confirmPopup = $ionicPopup.confirm({
	       title: '是否删除该条消费记录?'
	     });
	     confirmPopup.then(function(res) {
	       if(res) {
	       	
	       	//调用删除消费记录接口
	         onDete(item,index)
	         
	       } else {
	         console.log('取消删除操作');
	       }
	     });
     }
     
     
     
    //删除消费记录接口 
    function onDete(item,index){
    	var data = {
					uuid : item.user,
					datetime : item.datetime
		},

		url='../../App/UserType/user/cnDel',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.detShop = response;
    			console.log(vm.detShop);
    			if(vm.detShop.result_code==1){
    				vm.getMyShop.splice(index, 1);
    				vm.hint("删除成功")
    			}else{
    				vm.hint("删除失败")
    			}

   		});

    }
    
});

/*****************************我的消费-交易详情*************************/

module.controller('tradeCtrl',function($scope,$stateParams){
	var vm = $scope;
	vm.trade = JSON.parse($stateParams.id);
	console.log(vm.trade);
})

/*********************************积分商城******************************/

module.controller('integralCtrl',function($scope,$stateParams,$state,$http,$ionicSlideBoxDelegate,$ionicPopup,$ionicLoading,$timeout,$location){
	
	var vm = $scope;
	
	//本地获取用户uuid
	 vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);
	//本地获取头像信息
	 vm.headimage = localStorage.getItem('headimage');
	//本地获取登录状态
     vm.state = localStorage.getItem('entryState')
	//顶部轮播初始页
	 vm.myActiveSlide = 0;
	
	//积分知识按钮
	 vm.goKnow = function(){
		$state.go("knowLedge")
	 }
	
	
	
	//获取顶部轮播图图片
	
	getHeadImg()
	
	function getHeadImg(){
		
		var data = {
					
		},

		url='../../App/Extra/mall/getAdverts',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};


    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.getImg = response;
    			console.log(vm.getImg);
    			vm.imgOne = vm.getImg[0];
    			vm.imgTwo = vm.getImg[1];
    			vm.imgThree = vm.getImg[2];
   		});
   		
	}
	
	
	//页面打开时，获取签到状态接口
	
	init(vm.uuid);
	
	 function init(uuid){
	 	
	 	var data={
				  uuid:uuid
		},
		
		url='../../App/Extra/mall/getIntegral',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url, data, postCfg).success(function (response) {
				vm.signState = response;
				console.log(vm.signState)
				
				if(vm.signState.signed == 'yes'){
					vm.signStateFont = "已签到"
				}else if(vm.signState.signed == 'no'){
					vm.signStateFont = "签到"
				}
		});
	 	
	 }
	 
	 
	 //点击签到时，获取接口
	 vm.doSign = function(){
	 	
	 	if(vm.state == "login_access"){
		 	var data={
					  uuid:vm.uuid
			},
			url='../../App/Extra/mall/sign',
			
			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};
			$http.post(url, data, postCfg).success(function (response) {
					vm.sign = response;
					console.log(vm.sign)
					if(vm.sign.result_code == '1'){
						vm.signStateFont = "已签到"
						hint('签到成功，积分+20！')
					}
			});
	 	}else{
	 		$location.path('/denglu')
	 	}
	 }
	 
	 //签到成功提示
	 function hint(str){
	 	
	 	 // 自定义弹窗
           var myPopup = $ionicPopup.show({
             title: str,
             scope: $scope,
           });
           myPopup.then(function(res) {
             console.log(str);
           });
           $timeout(function() {
              myPopup.close(); // 1秒后关闭弹窗
           }, 1000);
	 	
	 }
	 
/**************积分兑换区*****************/	 

     intChange()
	 //积分兑换区接口
	 
	 function intChange (){
	 	
	 	var url='../../App/Extra/mall/getGoods',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url,postCfg).success(function (response) {
				vm.intChangeData = response;
				console.log(vm.intChangeData)
				
		});
	 }
	 
	 
	 //积分兑换项目跳转
	 
	 vm.goBar = function(obj){
	 	console.log(obj)
	 	$state.go("barter",{id:JSON.stringify(obj)})
	 }
	 
/**************优惠券**************/	

	//页码
	var index = 1;
	var isLock=false;
	
	//初始化我的优惠券数据
    vm.getMarket = [];
    
    
    //上拉加载
    vm.loadMore = function () {
        if(isLock)return;
        isLock=true;
        
        $ionicLoading.show({
		    content: 'Loading',
		    animation: 'fade-in',
		    showBackdrop: true,
		    maxWidth: 200,
		    showDelay: 0
	  	});
        
        var data = {
        			uuid : vm.uuid,
					index: index
		},
		
        url='../../App/MerchantType/coupon/marketGet',
        postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		
        $http.post(url, data, postCfg).success(function (response) {
        	
        	if (response.length == 0) {
                $scope.hasmore = true;
                $ionicLoading.hide();
                return;
            }
        	
        	
        	
        	index++;
            vm.getMarket = vm.getMarket.concat(response);
    		console.log(vm.getMarket);
			$ionicLoading.hide();
			
   		}).finally(function (error) {
            isLock = false;
            $scope.$broadcast('scroll.infiniteScrollComplete');
            $scope.$broadcast('scroll.refreshComplete');
        });
        
    }
    
    //下拉刷新
    vm.doRefresh = function () {
        index = 1;
        vm.getMarket = [];
        vm.loadMore();
    }
    
    //页面初始化
	vm.loadMore();
	
	
	//点击领取优惠券
	
	vm.draw = function(mark){
		if(vm.state == "login_access"){
			if(mark.received == 'true'){
				$state.go('cash',{id:JSON.stringify(mark)})
			}else{
				 recevied(mark)
			}
			
		}else{
			$location.path('/denglu')
		}
	}
	
	//领取优惠券接口
	
	function recevied(mark){
			var data={
					  uuid:vm.uuid,
					  muid:mark.muid,
					  coupon_id:mark.coupon_id
			},
			url='../../App/MerchantType/coupon/receive',
			
			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};
			$http.post(url, data, postCfg).success(function (response) {
					vm.getCoupon = response;
					console.log(vm.getCoupon)
					
					if(vm.getCoupon.result_code == '1'){
						mark.received = 'true'
						hint('领取成功')
					}
					
					
			});
	}
	
	

/**************积分明细**************/	


	 detaSum(vm.uuid)

	 //积分明细接口
	 function detaSum(uuid){
	 	
	 	var data={
	 		       uuid:uuid
	 	},
	 	
	    url='../../App/Extra/mall/getConsume',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url,data,postCfg).success(function (response) {
			
				vm.getConsume = response;
				console.log(vm.getConsume)
				
		});
	 }

/************我的兑换*************/

//调用我的兑换接口
	myInte(vm.uuid)

//我的兑换接口
	function myInte(uuid){
	 	
	 	var data={
	 		       uuid:uuid
	 	},
	 	
	    url='../../App/Extra/mall/getExchange',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url,data,postCfg).success(function (response) {
			
				vm.inteData = response;
				console.log(vm.inteData)
				
		});
	 }

})

/****************************积分兑换区-积分兑换************************/

module.controller('barterCtrl',function($scope,$stateParams,$http,$sce,$state){
	
	var vm = $scope;
	
	//获取本地存储的用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid)
	
	//积分要兑换的商品信息
	vm.side = JSON.parse($stateParams.id);
	console.log(vm.side);
	
	//商品详情信息链接
	vm.addHref = $sce.trustAsResourceUrl(vm.side.href);
	console.log(vm.addHref)
	
	
	//页面打开时，调用签到接口,获取用户积分
	
	init(vm.uuid);
	
	 function init(uuid){
	 	
	 	var data={
				  uuid:uuid
		},
		
		url='../../App/Extra/mall/getIntegral',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url, data, postCfg).success(function (response) {
				vm.signState = response;
				console.log(vm.signState)
				vm.inteNum = vm.signState.integral;
				
				//个人积分与要购买商品积分对比
					
				if(Number(vm.inteNum) >= Number(vm.side.price)){
					vm.fontSide = "恭喜! 积分可兑换该商品";
					vm.btnFoot = "立即兑换"
					vm.newStyle ={
						"background-color":"#E64E0D"
					}
				}else{
					vm.fontSide = "亲! 您的积分还不够哦~";
					vm.btnFoot = "积分不够"
					vm.newStyle ={
						"background-color":"#666"
					}
				}
				
		});
	 	
	}
	 
	
	//积分兑换按钮
	vm.orderInfo = function(obj,num){
		if(Number(num) >= Number(obj.price)){
			$state.go('orderInfo',{id:JSON.stringify(obj)});
		}else{
			return;
		}
	}
	
	
})


/****************************积分兑换区-订单详情页************************/

module.controller('orderInfoCtrl',function($scope,$stateParams,$ionicPopup,$http){
	
	var vm = $scope;
	
	//本地获取用户uuid;
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);
	
	//积分要兑换的商品信息
	vm.side = JSON.parse($stateParams.id);
	
	console.log(vm.side);
	
	defaultAdd(vm.uuid);
	
	//确认与取消对话框
	
   $scope.showAlert = function() {
		var alertPopup = $ionicPopup.alert({
	       title: '提示',
	       template: '<p class="tce">您已兑换成功,商品准备发货!</p>'
	     });
	     alertPopup.then(function(res) {
	        vm.back();
	     });
   };
	
	
	
	//获取默认收货信息
	function defaultAdd (uuid){
		var data={
	 		       uuid:uuid
	 	},
	 	
	    url='../../App/Extra/mall/getDefaultAdd',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url,data,postCfg).success(function (response) {
			
				vm.getAddData = response;
				console.log(vm.getAddData)
				
		});
	}
	
	
	//立即支付
	vm.imPay = function(obj,item){
		
		var confirmPopup = $ionicPopup.confirm({
		       title: '提示',
		       template: '<p class="tce">确认兑换该商品?</p>'
		     });
		     
		    confirmPopup.then(function(res) {
		    	
		       if(res) {
		       	
				         var data={
						 		       uuid:item.uuid,
						 		       goods_id:obj.id,
						 		       sum:obj.price,
						 		       address:item.address,
						 		       phone:item.phone,
						 		       name:item.name
					 	},
					 	
					    url='../../App/Extra/mall/exchange',
						
						postCfg = {
								    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
								    transformRequest: function (data) {
								        return $.param(data);
								    }
						};
						$http.post(url,data,postCfg).success(function (response) {
							
								vm.backData = response;
								console.log(vm.backData);
								if(vm.backData.result_code == '1'){
									$scope.showAlert()
								}else{
									alert('兑换失败')
								}
						});
		         
		       } else {
		       	
		         		console.log('取消兑换操作');
		         		
		       }
		       
			})
	}
	
})


/****************************积分兑换区-选择收货地址************************/

module.controller('chooseAddCtrl',function($scope,$http){
	
	var vm = $scope;
	
	//本地获取用户uuid
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);
	
	getAdd(vm.uuid)
	
	//获取收货地址列表
	
	function getAdd (uuid){
		var data={
	 		       uuid:uuid
	 	},
	 	
	    url='../../App/Extra/mall/getAddList',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url,data,postCfg).success(function (response) {
			
				vm.addList = response;
				console.log(vm.addList)
				
		});
	}
	
	//设置默认收货信息
	
	vm.setDef = function(obj){
		
		var data={
	 		       uuid:obj.uuid,
	 		       add_id:obj.add_id
	 	},
	 	
	    url='../../App/Extra/mall/setDefaultAdd',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		$http.post(url,data,postCfg).success(function (response) {
			
				vm.setData = response;
				console.log(vm.setData);
				
				if(vm.setData.result_code == '1'){
					getAdd(obj.uuid)
				}else{
					console.log('重复点击或者设置失败!')
				}
				
		});
		
	}
	
	
})


/****************************积分兑换区-添加收货地址************************/

module.controller('addAddressCtrl',function($scope,$http,$ionicPopup,$timeout){
	
	var vm = $scope ;
	
	//本地获取用户uuid
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);
	
	//初始化信息
	vm.data={
		city:"",
		add:"",
		name:"",
		phone:""
	}
	
	
	//设置弹窗提示效果；
	
	vm.hint = function(str){
		var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });

           myPopup.then(function(res) {
           		console.log(str)
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}


	
	/*****************************省市联动菜单***************************/

	
		var first = []; /* 省，直辖市 */
		var second = []; /* 市 */
		var third = []; /* 镇 */
		
		var selectedIndex = [0, 0, 0]; /* 默认选中的地区 */
		
		var checked = [0, 0, 0]; /* 已选选项 */
		
		function creatList(obj, list){
		  obj.forEach(function(item, index, arr){
		  var temp = new Object();
		  temp.text = item.name;
		  temp.value = index;
		  list.push(temp);
		  })
		}
		
		creatList(city, first);
		
		if (city[selectedIndex[0]].hasOwnProperty('sub')) {
		  creatList(city[selectedIndex[0]].sub, second);
		} else {
		  second = [{text: '', value: 0}];
		}
		
		if (city[selectedIndex[0]].sub[selectedIndex[1]].hasOwnProperty('sub')) {
		  creatList(city[selectedIndex[0]].sub[selectedIndex[1]].sub, third);
		} else {
		  third = [{text: '', value: 0}];
		}
		
		vm.getAdd =function(){
			picker.show();
		};
		
		var picker = new Picker({
			data: [first, second, third],
		  selectedIndex: selectedIndex,
			title: '地址选择'
		});
		
		picker.on('picker.select', function (selectedVal, selectedIndex) {
		  var text1 = first[selectedIndex[0]].text;
		  var text2 = second[selectedIndex[1]].text;
		  var text3 = third[selectedIndex[2]] ? third[selectedIndex[2]].text : '';
		  
			vm.data.city = text1 + text2 + text3;
			$("#cityData").val(text1 + text2 + text3);
			console.log(vm.data.city);
		});
		
		picker.on('picker.change', function (index, selectedIndex) {
		  if (index === 0){
		    firstChange();
		  } else if (index === 1) {
		    secondChange();
		  }
		
		  function firstChange() {
		    second = [];
		    third = [];
		    checked[0] = selectedIndex;
		    var firstCity = city[selectedIndex];
		    if (firstCity.hasOwnProperty('sub')) {
		      creatList(firstCity.sub, second);
		
		      var secondCity = city[selectedIndex].sub[0]
		      if (secondCity.hasOwnProperty('sub')) {
		        creatList(secondCity.sub, third);
		      } else {
		        third = [{text: '', value: 0}];
		        checked[2] = 0;
		      }
		    } else {
		      second = [{text: '', value: 0}];
		      third = [{text: '', value: 0}];
		      checked[1] = 0;
		      checked[2] = 0;
		    }
		
		    picker.refillColumn(1, second);
		    picker.refillColumn(2, third);
		    picker.scrollColumn(1, 0)
		    picker.scrollColumn(2, 0)
		  }
		
		  function secondChange() {
		    third = [];
		    checked[1] = selectedIndex;
		    var first_index = checked[0];
		    if (city[first_index].sub[selectedIndex].hasOwnProperty('sub')) {
		      var secondCity = city[first_index].sub[selectedIndex];
		      creatList(secondCity.sub, third);
		      picker.refillColumn(2, third);
		      picker.scrollColumn(2, 0)
		    } else {
		      third = [{text: '', value: 0}];
		      checked[2] = 0;
		      picker.refillColumn(2, third);
		      picker.scrollColumn(2, 0)
		    }
		  }
		
		});
		
		picker.on('picker.valuechange', function (selectedVal, selectedIndex) {
		  console.log(selectedVal);
		  console.log(selectedIndex);
		});
		
			
	
	//点击完成按钮,添加地址信息
	
	vm.setAdd = function (city,add,name,phone){
		console.log(city)
		console.log(add)
		console.log(name)
		console.log(phone)
		
		if(city==""){
			vm.hint('请完善信息')
		}else if(add==""){
			vm.hint('请完善信息')
		}else if(name==""){
			vm.hint('请完善信息')
		}else if(phone==""){
			vm.hint('请完善信息')
		}else if(!(/^1[34578]\d{9}$/.test(phone))){
	        vm.hint('请输入正确手机号') 
	    }else{
	    	
		    	var data={
		 		       uuid:vm.uuid,
		 		       address:city+add,
		 		       name:name,
		 		       phone:phone
			 	},
			 	
			    url='../../App/Extra/mall/addAdd',
				
				postCfg = {
						    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
						    transformRequest: function (data) {
						        return $.param(data);
						    }
				};
				$http.post(url,data,postCfg).success(function (response) {
					
						vm.backData = response;
						console.log(vm.backData);
						
						if(vm.backData.result_code == '1'){
							vm.back()
						}else{
							console.log('添加地址失败')
						}
						
				});
		    	
	    }
		
	}
	
	
})



/*********************************我的收藏******************************/

module.controller('coeCtrl',function($scope,$http){
	var vm = $scope;

	//获取本地存储的uuid;
	vm.uuid=localStorage.getItem('uuid');
	
		var data={
			user:vm.uuid
		}

		url='../../App/UserType/collect/storeGet',

		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};

    	$http.post(url, data, postCfg).success(function (response) {
					vm.coeList=response;
					console.log(vm.coeList);

		});

});

/********************************登录页面******************************/

module.controller('entryCtrl',function($scope,$http,$location,$ionicLoading,$ionicPopup,$timeout){

	//点击登录按钮，请求后台，获取个人信息，本地存储
	 $scope.entry=function(phone,passwd){
		  var data={
		    			phone:phone,
		    			passwd:passwd
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
		    			var useState = $scope.userInfo.result_code;
		    			console.log(useState);
		    		if(useState == "login_access"){

		    			//加载动画;
						 $ionicLoading.show({
						    content: 'Loading',
						    animation: 'fade-in',
						    showBackdrop: true,
						    maxWidth: 200,
						    showDelay: 0
						  });

		    			var result = $scope.userInfo.info[0];
		    		$timeout(function () {
		    			localStorage.setItem('entryState',useState);
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

		    			//隐藏加载动画;
		    			 $ionicLoading.hide();
		    			//返回页面;
						 window.history.back();
						}, 3000);

		    		 }else{
			    				// 自定义弹窗
					           var myPopup = $ionicPopup.show({
					             subTitle:'用户名或密码不对',
					             scope: $scope
					           });

					           myPopup.then(function(res) {
					           		console.log('登录信息有误！')
								});

								$timeout(function() {
									myPopup.close(); // 1秒后关闭弹窗
								}, 1000);
						    }
	   			});
	}

});

/********************************注册页面******************************/
/****************填写手机号*******************/

module.controller('finPhoneCtrl',function($scope,$http,$location,$ionicPopup,$timeout,$state){
	var  vm = $scope;

	//定义手机号码初始值

	vm.data={
		phone:""
	}

	//填写手机号长度不够
	   vm.showAlert = function(str) {
	     var alertPopup = $ionicPopup.alert({
	       title: '提示',
	       template: '<p class="tce">'+str+'</p>'
	     });
	     alertPopup.then(function(res) {
	       console.log(str);
	     });
	   };


	//手机号码已注册弹窗提示
	vm.hint=function(str){
		// 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:'手机号码已注册,请直接登录',
             scope: $scope
           });

           myPopup.then(function(res) {
           	console.log('手机号码已注册,请直接登录')
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}

	//发送短信验证码
	vm.sendMessageCode = function(phone){
		var data = {
					phone : phone
			},

			url='../../../smsVertify/Demo/SendTemplateSMS.php',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};


	    	$http.post(url, data, postCfg).success(function (response) {
	    			 vm.recode = response;
	    		    // console.log(vm.recode);
	    		  $state.go('getCheckCode',{id:JSON.stringify(vm.recode)})
	   		});
	}



	//点击发送验证码
	vm.finPhone=function(phone){
		if(phone==''){
			vm.showAlert('手机号码长度不对')
		}else if(phone.length<11){
			vm.showAlert('手机号码长度不对')
		}else if(!(/^1(3|4|5|7|8)\d{9}$/.test(phone))){
			vm.showAlert('手机号码格式不对')
		}else{

			var data = {
					phone : phone,
					referrer: "无人推荐"
			},

			url='../../App/UserType/register/register_check',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};


	    	$http.post(url, data, postCfg).success(function (response) {
	    			 vm.subPhone = response;
	    			//console.log(vm.subPhone);
	    			if(vm.subPhone.result_code=='phone_duplicate'){
	    				vm.hint();
	    			}else if(vm.subPhone.result_code=='access'){
	    				vm.sendMessageCode(phone)
	    			}
	   		});
		}
	}




});

/****************获取验证码*******************/

module.controller('getCheckCodeCtrl',function($scope,$stateParams,$interval,$ionicPopup,$state){
	var vm = $scope;

	//获取页面间传参
	vm.phoneCode = JSON.parse($stateParams.id);
	//console.log(vm.phoneCode);
	vm.code = vm.phoneCode[0];
	//console.log(vm.code);
	//验证码不匹配弹窗效果；
	vm.fash = function(){
		var alertPopup = $ionicPopup.alert({
	       title: '提示',
	       template: '<p class="tce">验证码输入错误</p>'
	     });
	     alertPopup.then(function(res) {
	       console.log('验证码输入错误');
	     });
	}

	//定义还有多少秒
	vm.second = 59;
	var newSecond = 59;
	var timerHandler;
	//获取倒计时
	vm.sendCode =function(){
		if(timerHandler){
			return;
		}

		timerHandler = $interval(function(){
			if(newSecond <= 0){
				$interval.cancel(timerHandler);
			}else{
				newSecond--;
				vm.second = newSecond;
			}
		},1000,100)
	}

	//打开页面倒计时

	vm.sendCode();

	//点击下一步,设置密码
	vm.goSet=function(code){
		if(code == vm.code){
			$state.go('setPassWord',{id:JSON.stringify(vm.phoneCode)})
		}else{
			vm.fash()
		}


	}
})

/****************设置密码*******************/

module.controller('setPassWordCtrl',function($scope,$stateParams,$http,$location,$ionicPopup,$timeout){
	var vm = $scope;

	//获取页面间传参
	vm.phoneCode = JSON.parse($stateParams.id);
	vm.phone = vm.phoneCode[1];
	console.log(vm.phone);

	//定义接收选择结果变量
	vm.data = {
    	pass:"",
    	checkPass:''
  	};

  	//修改成功后弹窗提示效果；
	vm.hint = function(){
		var myPopup = $ionicPopup.show({
             subTitle:"修改成功！",
             scope: $scope
           });

           myPopup.then(function(res) {
           		$state.go('user',{})
			});

			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
	}


	//完成注册,调用登录接口
	 vm.entry=function(phone,passwd){
		  var data={
		    			phone:phone,
		    			passwd:passwd
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
		    			var useState = $scope.userInfo.result_code;
		    			console.log(useState);
		    		if(useState == "login_access"){

		    			var result = $scope.userInfo.info[0];

		    			localStorage.setItem('entryState',useState);
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
		    			$location.path('/tab/myshow')
		    		 }else{
			    				// 自定义弹窗
					           var myPopup = $ionicPopup.show({
					             subTitle:'用户名或密码不对',
					             scope: $scope
					           });

					           myPopup.then(function(res) {
					           		console.log('登录信息有误！')
								});

								$timeout(function() {
									myPopup.close(); // 1秒后关闭弹窗
								}, 1000);
						    }
	   			});
	}




	//修改失败弹窗效果；
	vm.fash = function(str){
		var alertPopup = $ionicPopup.alert({
	       title: '提示',
	       template: '<p class="tce">'+str+'</p>'
	     });
	     alertPopup.then(function(res) {
	       console.log(str);
	     });
	}



	//设置要修改的密码
	vm.complete=function(pass,rePass){
		if(pass == ''){
			vm.fash("密码长度不能小于6位")
		}else if(pass.length < 6){
			vm.fash("密码长度不能小于6位")
		}else if(pass != rePass){
			vm.fash("两次密码不一致,请检查")
		}else{
			console.log('修改成功!')
		 //调用完成注册借口
			var data = {
					phone : vm.phone,
					passwd : rePass,
					referrer: "无人推荐"
			},

			url='../../App/UserType/user/register',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};


	    	$http.post(url, data, postCfg).success(function (response) {
	    			 vm.getRegister = response;
	    			console.log(vm.getRegister);
	    		//登录跳转我的页面;
	    			 vm.entry(vm.phone,rePass);
	   		});
		}
	}
})

/*********************************我的推荐*****************************/

module.controller('recommendCtrl',function($scope,$http){
	var vm = $scope;

	//获取本地用户uuid
	vm.uuid = localStorage.getItem('uuid');
	console.log(vm.uuid);

	//推荐接口
	vm.getRefer = function(uuid){
			var data = {
					uuid : uuid
			},

			url='../../App/UserType/referrer/get',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};

	    	$http.post(url, data, postCfg).success(function (response) {
	    			 vm.getResult = response;
	    			console.log(vm.getResult);
	    			var merArr=[];
	    			var parArr=[];
	    			for(var i=0; i<vm.getResult.length ; i++){
	    				if(vm.getResult[i].type=='m'){
	    					merArr.push(vm.getResult[i]);

	    				}else if(vm.getResult[i].type=='u'){
	    					parArr.push(vm.getResult[i]);

	    				}
	    			}
	    			vm.merNum = merArr.length;
	    			vm.parNum = parArr.length;
	   		});
	}

	//获取推荐数据
	vm.getRefer(vm.uuid)
})
