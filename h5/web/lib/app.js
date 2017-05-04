var app=angular.module('ionicApp', ['ionic','app.controllers'])

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
       
        .state('kashi.second',{
        	url: "/second",
          views: {
            'second': {
              templateUrl: "templates/kashi/second.html"
            }
          }
        })
        
        .state('kashi.ceng',{
        	url: "/ceng",
          views: {
            'ceng': {
              templateUrl: "templates/kashi/ceng.html"
            }
          }
        })
        
        .state('facts', {
          url: "/facts/:id",
          templateUrl: "templates/home/facts.html",
          controller:'factsCtrl'
        })
        
        .state('kashiInfo', {
          url: "/kashiInfo/:id",
          templateUrl: "templates/kashi/kashiInfo.html",
          controller:'kashiInfoCtrl'
        })
      	
      	.state('username',{
      		url:"/username",
      		templateUrl:"templates/myshow/username.html",
      		controller:'usernameCtrl'
      	})
       
       //我的会员卡
       	.state('huiyuanka',{
       		url:"/huiyuanka",
       		templateUrl:"templates/myshow/huiyuanka/index.html"
       	})
       	//全部会员卡
       	.state('huiyuanka.all',{
       		url:"/all",
       		views:{
       			'all-tab':{
       				templateUrl:"templates/myshow/huiyuanka/all.html"
       			}
       		}
       	})
       	//储值卡
       	.state('huiyuanka.storage',{
       		url:"/storage",
       		views:{
       			'storage-tab':{
       				templateUrl:"templates/myshow/huiyuanka/storage.html"
       			}
       		}
       	})
       	//计次卡
       	.state('huiyuanka.count',{
       		url:"/count",
       		views:{
       			'count-tab':{
       				templateUrl:"templates/myshow/huiyuanka/count.html"
       			}
       		}
       	})
       	//卡信息
       	.state('card',{
       		url:"/card/:id",
       		templateUrl: "templates/myshow/huiyuanka/card.html"
       	})
       	
       	//我要续卡
       .state('recard',{
       		url:"/recard",
       		templateUrl: "templates/myshow/huiyuanka/recard.html"
       	})
       
       	//我要续卡-支付选择
       	.state('pay',{
       		url:'/pay',
       		templateUrl: "templates/myshow/huiyuanka/pay.html"
       	})
       //我要升级
       	.state('upter',{
       		url:'/upter',
       		templateUrl: "templates/myshow/huiyuanka/upter.html"
       	})
       //我要预约
       	.state('yuyue',{
       		url:'/yuyue',
       		templateUrl: "templates/myshow/huiyuanka/yuyue.html"
       	})
       //家庭分享
       	.state('fshare',{
       		url:'/fshare',
       		templateUrl: "templates/myshow/huiyuanka/fshare.html",
       		controller:'fshareCtrl'
       	})
       //分享
       .state('share',{
       		url:'/share',
       		templateUrl: "templates/myshow/huiyuanka/share.html"
       	})
       
       //理赔
       .state('pei',{
       		url:"/pei",
       		templateUrl: "templates/myshow/huiyuanka/pei.html"
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
      	.state('myGood',{
       		url:"/myGood",
       		templateUrl:"templates/myshow/myGood.html"
       	})
       
        .state('tabs.myshow', {
          url: "/myshow",
          views: {
            'myshow-tab': {
              templateUrl: "templates/myshow/index.html"
            }
          }
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