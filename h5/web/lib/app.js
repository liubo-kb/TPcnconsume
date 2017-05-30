var app=angular.module('ionicApp', ['ionic','app.controllers','app.services','app.directives','CoderYuan'])
    app.run(function($ionicPlatform) {
            $ionicPlatform.ready(function() {
              // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
              // for form inputs)
              if(window.cordova && window.cordova.plugins.Keyboard) {
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
              }
              if(window.StatusBar) {
                StatusBar.styleDefault();
              }
            });
     })

    app.config(function($stateProvider, $urlRouterProvider) {

      $stateProvider
        .state('tabs', {
          url: "/tab",
          abstract: true,
          templateUrl: "templates/tabs/index.html"
        })
        .state('tabs.home', {
          url: "/home",
          views: {
            'home-tab': {
              templateUrl: "templates/home/index.html",
              controller: 'HomeTabCtrl'
            }
          }
        })
        .state('tabs.kashi', {
          url: "/kashi",
          views: {
            'kashi-tab': {
              templateUrl: "templates/kashi/index.html",
              controller:'kashiCtrl'
            }
          }
        })
        .state('tabs.myshow', {
          url: "/myshow",
          views: {
            'myshow-tab': {
              templateUrl: "templates/myshow/index.html",
              controller:'myshowCtrl'
            }
          }
        })
        
        .state('facts', {
          url: "/facts/:id",
          templateUrl: "templates/home/facts.html",
          controller:'factsCtrl'
        })
        
        .state('storeInfo', {
          url: "/storeInfo",
          templateUrl: "templates/home/storeInfo.html"
        })
        
        .state('goods',{
        	url:'/goods/?:id',
        	params:{id:""},
        	templateUrl:'templates/home/goods.html',
        	controller:"goodsCtrl"
        })
       
        .state('kashiInfo', {
          url: "/kashiInfo/:id/:type",
          templateUrl: "templates/kashi/kashiInfo.html",
          controller:'kashiInfoCtrl'
        })
      	
      	.state('user',{
      		url:"/user",
      		cache:false,
      		templateUrl:"templates/myshow/user/index.html",
      		controller:'userCtrl'
      	})
      	
      	.state('setuser',{
      		url:"/setuser/:id/:type",
      		templateUrl:"templates/myshow/user/setuser.html",
      		controller:'setUserCtrl'
      	})
      	
      	.state('setselect',{
      		url:"/setselect/:id/:type",
      		templateUrl:"templates/myshow/user/setselect.html",
      		controller:'setSelectCtrl'
      	})
      	
      	.state('setother',{
      		url:"/setother/:page/:id/:type",
      		templateUrl:"templates/myshow/user/setother.html",
      		controller:'setOtherCtrl'
      	})
      	
      	.state('setphone',{
      		url:"/setphone/:type",
      		templateUrl:"templates/myshow/user/setphone.html",
      		controller:'setPhoneCtrl'
      	})
      	
      	.state('work',{
      		url:"/work",
      		templateUrl:"templates/myshow/user/work.html",
      		controller:'workCtrl'
      	})
      	
      	.state('setpass',{
      		url:"/setpass/:type",
      		templateUrl:"templates/myshow/user/setpass.html",
      		controller:'setPassCtrl'
      	})
      	.state('denglu',{
      		url:"/denglu",
      		templateUrl:"templates/denglu/index.html",
      		controller:'entryCtrl'
      	})
      	 
        .state('zhuce',{
        	url:'/zhuce',
        	templateUrl:'templates/zhuce/index.html'
        })
               
       
       //我的会员卡
       	.state('huiyuanka',{
       		url:"/huiyuanka",
       		templateUrl:"templates/myshow/huiyuanka/index.html",
       		controller:"memBerCtrl"
       	})
       	//全部会员卡
       	.state('huiyuanka.allcard',{
       		url:"/allcard",
       		views:{
       			'all-tab':{
       				templateUrl:"templates/myshow/huiyuanka/allcard.html"
       			}
       		}
       	})
       	
       	.state('setment',{
       		url:"/setment",
       		templateUrl:"templates/myshow/huiyuanka/setment.html"
       	})
       	
       	//储值卡
       	.state('huiyuanka.storagecard',{
       		url:"/storagecard",
       		views:{
       			'storage-tab':{
       				templateUrl:"templates/myshow/huiyuanka/storagecard.html"
       			}
       		}
       	})
       	//计次卡
       	.state('huiyuanka.countcard',{
       		url:"/countcard",
       		views:{
       			'count-tab':{
       				templateUrl:"templates/myshow/huiyuanka/countcard.html"
       			}
       		}
       	})
       	
       	//分享卡
       	.state('huiyuanka.sharecard',{
       		url:"/sharecard",
       		views:{
       			'share-tab':{
       				templateUrl:"templates/myshow/huiyuanka/sharecard.html"
       			}
       		}
       	})
       	
       	//卡信息
       	.state('card',{
       		url:"/card/?:id",
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/card.html",
       		controller:"cardCtrl"
       	})
       	
       	//我要续卡
       .state('recard',{
       		url:"/recard/?:id",
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/recard.html",
       		controller:"recardCtrl"
       	})
       
       	//我要续卡-支付选择
       	.state('pay',{
       		url:'/pay',
       		templateUrl: "templates/myshow/huiyuanka/pay.html",
       		controller:'payCtrl'
       	})
       //我要升级
       	.state('upter',{
       		url:'/upter',
       		templateUrl: "templates/myshow/huiyuanka/upter.html"
       	})
       //我要预约
       	.state('order',{
       		url:'/order/?:id',
       		params:{id:""},
       		templateUrl: "templates/myshow/order/index.html",
       		controller:"orderCtrl"
       	})
       //查看预约
       .state('bespeak',{
       		url:'/bespeak/:mid/:uid',
       		templateUrl: "templates/myshow/order/bespeak.html",
       		controller:"bespeakCtrl"
       	})
       	
       //家庭分享
       	.state('fshare',{
       		url:'/fshare',
       		templateUrl: "templates/myshow/huiyuanka/fshare.html",
       		controller:'fshareCtrl'
       	})
       //卡片转让
       .state('attorn',{
       		url:"/attorn/?:id",
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/attorn.html",
       		controller:"attornCtrl"
       	})
       
       //分享
       .state('share',{
       		url:'/share/?:id',
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/share.html",
       		controller:"shareCtrl"
       })
       //分享结果
       .state('shareInfo',{
       		url:'/shareInfo/?:id/?:num',
       		params:{id:"",num:"",item:""},
       		templateUrl: "templates/myshow/huiyuanka/shareInfo.html",
       		controller:"shareInfoCtrl"
       	})
       
       //理赔
       .state('pei',{
       		url:"/pei/?:id",
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/pei.html",
       		controller:"lodgeCtrl"
       })
       
      //我的钱包 
       .state('myBao',{
       		url:"/myBao",
       		templateUrl:"templates/myshow/myBao/index.html"
       })
       
      //我的钱包-充值
       .state('recharge',{
       		url:"/recharge",
       		templateUrl:"templates/myshow/myBao/recharge.html"
       })
       
     //我的钱包-提现
       .state('tixian',{
       		url:"/tixian",
       		templateUrl:"templates/myshow/myBao/tixian.html"
       })
       
     //我的钱包-提现-添加银行卡
      .state('addcard',{
       		url:"/addcard",
       		templateUrl:"templates/myshow/myBao/addcard.html"
       })
       
    //我的钱包-红包
       .state('redpage',{
       		url:"/redpage",
       		templateUrl:"templates/myshow/myBao/redpage.html"
       })
    //我的钱包-优惠券   
       .state('coupon',{
       		url:"/coupon",
       		templateUrl:"templates/myshow/myBao/coupon.html"
       })
     
       .state('myQuan',{
       		url:"/myQuan",
       		templateUrl:"templates/myshow/myQuan.html"
       	})
       .state('myShop',{
       		url:"/myShop",
       		templateUrl:"templates/myshow/myShop.html"
       	})
       
       //我的收藏  
       .state('collect',{
       		url:"/collect",
       		templateUrl:"templates/myshow/collect/index.html",
       		controller:"coeCtrl"
       })
       
      	.state('myGood',{
       		url:"/myGood",
       		templateUrl:"templates/myshow/myGood.html"
       });
       
       $urlRouterProvider.otherwise("/tab/home");

    })

    app.controller('HomeTabCtrl', function($scope,$http) {
    	$scope.keyword='';
    	var data={
    			store:$scope.keyword,
    			index:1,
    		},
    		
		url='../../App/MerchantType/merchant/search',
		
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
			
		   // $scope.keyword = ''; 每次搜索先清空数组内容   
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.stores=response;
    			console.log($scope.stores)
		});
   
   		
   
    	$scope.search = function(){ 
    		
    		console.log($scope.keyword);
    		
    		var data={
    			store:$scope.keyword,
    			index:1
    		},
    		url='../../App/MerchantType/merchant/search',
    		
    		postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};
			
		    	$http.post(url, data, postCfg).success(function (response) {
		    			$scope.stores=response;
		    			console.log($scope.stores)
    			});
    	}
    	
  });