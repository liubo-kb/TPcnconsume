var app=angular.module('ionicApp', ['ionic','app.controllers','app.services','app.directives','app.filters','ngIOS9UIWebViewPatch','ls.bmap','CoderYuan'])
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

    app.config(function($ionicConfigProvider,$stateProvider, $urlRouterProvider) {

	  $ionicConfigProvider.tabs.position("bottom");

      $stateProvider
        .state('tabs', {
          url: "/tab",
          abstract: true,
          templateUrl: "templates/tabs/index.html"
        })
        
        //主页
        .state('tabs.home', {
          url: "/home",
          views: {
            'home-tab': {
              templateUrl: "templates/home/index.html",
              controller: 'HomeTabCtrl'
            }
          }
        })
		
		//卡市
        .state('tabs.kashi', {
          url: "/kashi",
          cache:false,
          views: {
            'kashi-tab': {
              templateUrl: "templates/kashi/index.html",
              controller:'kashiCtrl'
            }
          }
        })
        
        //我的
        .state('tabs.myshow', {
          url: "/myshow",
          cache:false,
          views: {
            'myshow-tab': {
              templateUrl: "templates/myshow/index.html",
              controller:'myshowCtrl'
            }
          }
        })

		//地址定位(搜索、修改)
        .state('address', {
          url: "/address",
          cache:false,
          templateUrl: "templates/home/address.html"
        })

		//商铺搜索
        .state('search', {
          url: "/search",
          cache:false,
          templateUrl: "templates/home/search.html",
          controller:'searchCtrl'
        })

 		//商铺详情
        .state('facts', {
          url: "/facts/:id",
          cache:false,
          templateUrl: "templates/home/facts.html",
          controller:'factsCtrl'
        })
         
        //查看位置
        .state('map', {
          url:'/map/:id/:type',
          cache:false,
          templateUrl: "templates/home/map.html",
          controller:'mapCtrl'
        })
		
		//用户评价
        .state('assess', {
          url: "/assess/:id",
          cache:false,
          templateUrl: "templates/home/assess.html",
          controller:'assessCtrl'
        })

		//更多商品
        .state('moreShop',{
        	url:"/moreShop/:id",
        	cache:false,
        	templateUrl:"templates/home/moreShop.html",
        	controller:"moreShopCtrl"
        })
		
		//图文详情
        .state('imgFontMore',{
        	url:"/imgFontMore/:id",
        	cache:false,
        	templateUrl:"templates/home/imgFontMore.html",
        	controller:"imgFontMoreCtrl"
        })
		
		//更多保障
        .state('safeMore',{
        	url:"/safeMore/:id",
        	cache:false,
        	templateUrl:"templates/home/safeMore.html",
        	controller:"safeMoreCtrl"
        })
        
        
		//购物结算
        .state('goods',{
        	url:'/goods/?:list/?:name/?:type/?:num',
        	cache:false,
        	params:{list:"",name:"",type:"",num:""},
        	templateUrl:'templates/home/goods.html',
        	controller:"goodsCtrl"
        })
         
         //办卡支付
        .state('payCard', {
          url:'/payCard/?:id/?:type',
          cache:false,
          params:{id:"",type:""},
          templateUrl: "templates/pay/payCard.html",
          controller:'payCardCtrl'
        })
        
        //使用红包
        .state('redPacket',{
       		url:"/redPacket/?:list/?:name/?:type/?:num",
       		cache:false,
       		params:{list:"",name:"",type:"",num:""},
       		templateUrl:"templates/myshow/myBao/redPacket.html",
       		controller:"redPacketCtrl"
       	})
        
        
        //使用优惠券 - 我的优惠券
       .state('merQuan',{
       		url:"/merQuan/?:list/?:name/?:type/?:num",
       		cache:false,
       		params:{list:"",name:"",type:"",num:""},
       		templateUrl:"templates/myshow/myQuan/merQuan.html",
       		controller:"merQuanCtrl"
       	})
       
        //使用优惠券 - 商消乐优惠券
		 .state('platQuan',{
       		url:"/platQuan/?:list/?:name/?:type/?:num",
       		cache:false,
       		params:{list:"",name:"",type:"",num:""},
       		templateUrl:"templates/myshow/myQuan/platQuan.html",
       		controller:"platQuanCtrl"
       	})
		
		//优惠大全
        .state('allCou',{
        	url:'/allCou/?:id/?:type',
        	cache:false,
        	params:{id:"",type:""},
        	templateUrl:'templates/home/allCou.html',
        	controller:"allCouCtrl"
        })
        
        //卡市搜索页面
        .state('searchCard', {
          url: "/searchCard",
          cache:false,
          templateUrl: "templates/kashi/searchCard.html",
          controller:'searchCardCtrl'
        })
		
		//二手卡详情页
        .state('secondInfo', {
          url: "/secondInfo/:id/:type",
          cache:false,
          templateUrl: "templates/kashi/secondInfo.html",
          controller:'secondCtrl'
        })
        
        
		//蹭卡详情页
        .state('cengInfo', {
          url: "/cengInfo/:id/:type",
          cache:false,
          templateUrl: "templates/kashi/cengInfo.html",
          controller:'cengCtrl'
        })
        
        //二手卡办卡
        .state('cardShop', {
          url:'/cardShop/?:id',
          cache:false,
          params:{id:""},
          templateUrl: "templates/pay/cardShop.html",
          controller:'cardShopCtrl'
        })
        
		//蹭卡支付
      	.state('sharePay', {
          url:'/sharePay/?:id',
          params:{id:""},
          cache:false,
          templateUrl: "templates/pay/sharePay.html",
          controller:'sharePayCtrl'
       })

      	//资料页面
      	.state('user',{
      		url:"/user",
      		cache:false,
      		templateUrl:"templates/myshow/user/index.html",
      		controller:'userCtrl'
      	})
		
		//设置个人项目
      	.state('setuser',{
      		url:"/setuser/:id/:type",
      		cache:false,
      		templateUrl:"templates/myshow/user/setuser.html",
      		controller:'setUserCtrl'
      	})
		
		//修改生日
      	.state('setselect',{
      		url:"/setselect/:id/:type",
      		cache:false,
      		templateUrl:"templates/myshow/user/setselect.html",
      		controller:'setSelectCtrl'
      	})
		
		//修改性别、婚姻、教育
      	.state('setother',{
      		url:"/setother/:page/:id/:type",
      		cache:false,
      		templateUrl:"templates/myshow/user/setother.html",
      		controller:'setOtherCtrl'
      	})
      	
      	//选择职业
      	.state('work',{
      		url:"/work",
      		cache:false,
      		templateUrl:"templates/myshow/user/work.html",
      		controller:'workCtrl'
      	})
      	
      	//用户 - 密码管理
      	.state('lastPass',{
      		url:"/lastPass",
      		cache:false,
      		templateUrl:"templates/myshow/user/lastPass.html"
      	})
      	
      	//密码管理 - 登录密码
      	.state('setpass',{
      		url:"/setpass/:type",
      		cache:false,
      		templateUrl:"templates/myshow/user/setpass.html",
      		controller:'setPassCtrl'
      	})

      	//密码管理 - 支付密码
      	.state('setPayPass',{
      		url:"/setPayPass",
      		cache:false,
      		templateUrl:"templates/myshow/user/setPayPass.html",
      		controller:'setPayPassCtrl'
      	})

      	//密码管理 - 修改支付密码
      	.state('orgPass',{
      		url:"/orgPass",
      		cache:false,
      		templateUrl:"templates/myshow/user/orgPass.html",
      		controller:'orgPassCtrl'
      	})

      	//密码管理 - 设置支付密码
      	.state('setPay',{
      		url:"/setPay",
      		cache:false,
      		templateUrl:"templates/myshow/user/setPay.html",
      		controller:'setPayCtrl'
      	})

      	//密码管理 - 确认支付密码

      	.state('setWord',{
      		url:"/setWord/?:id",
      		cache:false,
      		params:{id:""},
      		templateUrl:"templates/myshow/user/setWord.html",
      		controller:'setWordCtrl'
      	})

      	//密码管理 - 支付密码 - 忘记密码
      	.state('forget',{
      		url:"/forget",
      		cache:false,
      		templateUrl:"templates/myshow/user/forget.html",
      		controller:'forgetCtrl'
      	})


      	//登录页面
      	.state('denglu',{
      		url:"/denglu",
      		cache:false,
      		templateUrl:"templates/denglu/index.html",
      		controller:'entryCtrl'
      	})

      	//注册-填写手机号
        .state('zhuce',{
        	url:'/zhuce',
        	cache:false,
        	templateUrl:'templates/zhuce/finPhone.html',
        	controller:'finPhoneCtrl'
        })

        //注册-获取验证码
        .state('getCheckCode',{
        	url:'/getCheckCode/?:id',
        	cache:false,
        	params:{id:""},
        	templateUrl:'templates/zhuce/getCheckCode.html',
        	controller:'getCheckCodeCtrl'
        })

        //注册-设置密码
        .state('setPassWord',{
        	url:'/setPassWord/?:id',
        	cache:false,
        	params:{id:""},
        	templateUrl:'templates/zhuce/setPassWord.html',
        	controller:'setPassWordCtrl'
        })

       //我的会员卡
       	.state('huiyuanka',{
       		url:"/huiyuanka",
       		cache:false,
       		templateUrl:"templates/myshow/huiyuanka/index.html",
       		controller:"memBerCtrl"
       	})

       	//全部会员卡
       	.state('huiyuanka.allcard',{
       		url:"/allcard",
       		cache:false,
       		views:{
       			'all-tab':{
       				templateUrl:"templates/myshow/huiyuanka/cardList/allcard.html"
       			}
       		}
       	})

       	//储值卡
       	.state('huiyuanka.storagecard',{
       		url:"/storagecard",
       		cache:false,
       		views:{
       			'storage-tab':{
       				templateUrl:"templates/myshow/huiyuanka/cardList/storagecard.html"
       			}
       		}
       	})

       	//计次卡
       	.state('huiyuanka.countcard',{
       		url:"/countcard",
       		cache:false,
       		views:{
       			'count-tab':{
       				templateUrl:"templates/myshow/huiyuanka/cardList/countcard.html"
       			}
       		}
       	})

       	//套餐卡
       	.state('huiyuanka.package',{
       		url:"/package",
       		cache:false,
       		views:{
       			'package-tab':{
       				templateUrl:"templates/myshow/huiyuanka/cardList/package.html"
       			}
       		}
       	})

       	//体验卡
       	.state('huiyuanka.experience',{
       		url:"/experience",
       		cache:false,
       		views:{
       			'experience-tab':{
       				templateUrl:"templates/myshow/huiyuanka/cardList/experience.html"
       			}
       		}
       	})


       	//分享卡
       	.state('huiyuanka.sharecard',{
       		url:"/sharecard",
       		cache:false,
       		views:{
       			'share-tab':{
       				templateUrl:"templates/myshow/huiyuanka/cardList/sharecard.html"
       			}
       		}
       	})
       	
       	
       	//储值卡支付
       	.state('setment',{
       		url:"/setment/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/setment.html",
       		controller:"setMentCtrl"
       	})

       	//储值卡支付-输入密码
       	.state('cardPayPass',{
       		url:"/cardPayPass/?:id/?:type",
       		cache:false,
       		params:{id:"",type:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/cardPayPass.html",
       		controller:"cardPayPassCtrl"
       	})

       	//计次卡支付
       	.state('setcount',{
       		url:"/setcount/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/setcount.html",
       		controller:"setCountCtrl"
       	})

       	//计次卡支付-输入密码
       	.state('cardCountPass',{
       		url:"/cardCountPass/?:id/?:type",
       		cache:false,
       		params:{id:"",type:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/cardCountPass.html",
       		controller:"cardCountPassCtrl"
       	})



       	//套餐卡支付
       	.state('setPackage',{
       		url:"/setPackage/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/setPackage.html",
       		controller:"setPackageCtrl"
       	})

       	//套餐卡支付-输入密码
       	.state('cardPackagePass',{
       		url:"/cardPackagePass/?:id/?:type",
       		cache:false,
       		params:{id:"",type:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/cardPackagePass.html",
       		controller:"cardPackagePassCtrl"
       	})

       	//体验卡支付
       	.state('setExperience',{
       		url:"/setExperience/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/setExperience.html",
       		controller:"setExperienceCtrl"
       	})

       	//体验卡支付-输入密码
       	.state('cardExperPass',{
       		url:"/cardExperPass/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/cardExperPass.html",
       		controller:"cardExperPassCtrl"
       	})
       	
       	
       	//支付成功页面
       	.state('paySuccess',{
       		url:"/paySuccess/?:id/?:type",
       		cache:false,
       		params:{id:"",type:""},
       		templateUrl:"templates/myshow/huiyuanka/cardPay/paySuccess.html",
       		controller:"paySuccessCtrl"
       	})
       	


       	//卡信息
       	.state('card',{
       		url:"/card/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/cardInfo/card.html",
       		controller:"cardCtrl"
       	})

        //套餐卡与体验卡预约和投诉

        .state('newClass',{
          url:"/newClass/?:id",
          cache:false,
          params:{id:""},
          templateUrl: "templates/myshow/huiyuanka/cardInfo/newClass.html",
          controller:"newClassCtrl"
        })
        
       	//我要续卡
       .state('recard',{
       		url:"/recard/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/renewal/recard.html",
       		controller:"recardCtrl"
       })
       	
       //续卡支付详情页
       .state('reCardPay', {
          url:'/reCardPay/?:id',
          cache:false,
          params:{id:""},
          templateUrl: "templates/pay/reCardPay.html",
          controller:'reCardPayCtrl'
        })


       	//我要续卡-支付宝
       	.state('payShop',{
       		 url:'/payShop/?:id',
       		 cache:false,
          	 params:{id:""},
       		 templateUrl: "templates/myshow/huiyuanka/renewal/payShop.html",
       		 controller:'payShopCtrl'
       	})
		
		
		//我要升级
       	.state('upter',{
       		url:"/upter/?:id",
       		params:{id:""},
       		cache:false,
       		templateUrl: "templates/myshow/huiyuanka/upgrade/upter.html",
       		controller:"upterCtrl"
       	})

       	//我要升级-支付选择
       	.state('upShop',{
       		 url:'/upShop/?:id/?:type/?:sum',
       		 cache:false,
          	 params:{id:"",type:"",sum:""},
       		 templateUrl: "templates/myshow/huiyuanka/upgrade/upShop.html",
       		 controller:'upShopCtrl'
       	})

		//我要升级-升级支付
       	.state('upCardPay', {
          url:'/upCardPay/?:id/?:type/?:sum',
          params:{id:"",type:"",sum:""},
		  cache:false,
          templateUrl: "templates/pay/upCardPay.html",
          controller:'upCardPayCtrl'
        })


       //我要预约
       	.state('order',{
       		url:'/order/?:id',
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/order/index.html",
       		controller:"orderCtrl"
       	})

       //查看预约
       .state('bespeak',{
       		url:'/bespeak/:mid/:uid',
       		cache:false,
       		templateUrl: "templates/myshow/order/bespeak.html",
       		controller:"bespeakCtrl"
       	})

       //家庭分享
       	.state('fshare',{
       		url:'/fshare/?:id',
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/family/fshare.html",
       		controller:'fshareCtrl'
       	})
       //卡片转让
       .state('attorn',{
       		url:"/attorn/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/transfer/attorn.html",
       		controller:"attornCtrl"
       	})

       //分享
       .state('share',{
       		url:'/share/?:id',
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/share/share.html",
       		controller:"shareCtrl"
       })
       //分享结果
       .state('shareInfo',{
       		url:'/shareInfo/?:id/?:num/?:item',
       		cache:false,
       		params:{id:"",num:"",item:""},
       		templateUrl: "templates/myshow/huiyuanka/share/shareInfo.html",
       		controller:"shareInfoCtrl"
       	})

       //理赔
       .state('claim',{
       		url:"/claim/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/claim/index.html",
       		controller:"claimCtrl"
       })
       
       //理赔进度
       .state('process',{
       		url:"/process/?:id/?type",
       		cache:false,
       		params:{id:"",type:""},
       		templateUrl: "templates/myshow/huiyuanka/claim/process.html",
       		controller:"processCtrl"
       })
       
       //理赔核查失败
       .state('failed',{
       		url:"/failed/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl: "templates/myshow/huiyuanka/claim/failed.html",
       		controller:"failedCtrl"
       })
       

      //我的钱包
       .state('myBao',{
       		url:"/myBao",
       		cache:false,
       		templateUrl:"templates/myshow/myBao/index.html",
       		controller:"myBaoCtrl"
       })

       //我的钱包-明细
       .state('detail',{
       		url:"/detail",
       		cache:false,
       		templateUrl:"templates/myshow/myBao/detail.html",
       		controller:"detailCtrl"
       })

      //我的钱包-充值
       .state('recharge',{
       		url:"/recharge",
       		cache:false,
       		templateUrl:"templates/myshow/myBao/recharge.html",
       		controller:"reChanCtrl"
       })

       //我的钱包-充值支付详情
       .state('reChanPay',{
       		url:"/reChanPay/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/pay/reChanPay.html",
       		controller:"reChanPayCtrl"
       })

     //我的钱包-添加银行卡
       .state('addBank',{
       		url:"/addBank",
       		cache:false,
       		templateUrl:"templates/myshow/myBao/addBank.html",
       		controller:"addBankCtrl"
       })

    //我的钱包-提现
       .state('deposit',{
       		url:"/deposit/?:id/?:type",
       		cache:false,
       		params:{id:"",type:""},
       		templateUrl:"templates/myshow/myBao/deposit.html",
       		controller:"depositCtrl"
       })

    //我的钱包-提现
       .state('tradeInfo',{
       		url:"/tradeInfo/?:id/?:type/?:sum/?:date",
       		cache:false,
       		params:{id:"",type:"",sum:"",date:""},
       		templateUrl:"templates/myshow/myBao/tradeInfo.html",
       		controller:"tradeInfoCtrl"
       })

    //我的钱包-提现-选择银行卡
       .state('chooseBank',{
       		url:"/chooseBank/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/myBao/chooseBank.html",
       		controller:"chooseBankCtrl"
       })

     //我的钱包-提现-添加银行卡
      .state('addcard',{
       		url:"/addcard/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/myBao/addcard.html",
       		controller:'addCardCtrl'
       })

    //我的钱包-红包
       .state('redpage',{
       		url:"/redpage",
       		cache:false,
       		templateUrl:"templates/myshow/myBao/redpage.html",
       		controller:"redPageCtrl"
       })

    //我的钱包-红包提现
       .state('redCash',{
       		url:"/redCash/:id",
       		cache:false,
       		templateUrl:"templates/myshow/myBao/redCash.html",
       		controller:"redCashCtrl"
       })

    //我的钱包-平台优惠券
       .state('coupon',{
       		url:"/coupon",
       		cache:false,
       		templateUrl:"templates/myshow/myBao/coupon.html",
       		controller:"couponCtrl"
       })
       
     //我的优惠券
       .state('myQuan',{
       		url:"/myQuan",
       		cache:false,
       		templateUrl:"templates/myshow/myQuan/index.html",
       		controller:"myQuanCtrl"
       	})
       
    //我的优惠券 - 商户优惠券
    	.state('myQuan.merQuan',{
       		url:"/merQuan",
       		cache:false,
       		view:{
       			'merQuan':{
       				templateUrl:"templates/myshow/myQuan/merQuan.html",
       			}
       		}
       	})
    
    //我的优惠券 - 商消乐优惠券
    	.state('myQuan.platQuan',{
       		url:"/platQuan",
       		cache:false,
       		view:{
       			'platQuan':{
       				templateUrl:"templates/myshow/myQuan/platQuan.html",
       			}
       		}
       	})
       
     //我的优惠券-不可用优惠券
       .state('disQuan',{
       		url:"/disQuan",
       		cache:false,
       		templateUrl:"templates/myshow/myQuan/disQuan.html",
       		controller:"disQuanCtrl"
       	})
       
       
     //我的优惠券-优惠券二维码
       .state('cash',{
       		url:"/cash/:id",
       		cache:false,
       		templateUrl:"templates/myshow/myQuan/cash.html",
       		controller:"cashCtrl"
       	})
       
  
     //我的消费
       .state('myShop',{
       		url:"/myShop",
       		cache:false,
       		templateUrl:"templates/myshow/myShop/index.html",
       		controller:"myShopCtrl"
       	})

     //我的消费 -交易详情
       .state('trade',{
       		url:"/trade/:id",
       		cache:false,
       		templateUrl:"templates/myshow/myShop/trade.html",
       		controller:"tradeCtrl"
       	})
       
      //积分商城
       .state('integral',{
       		url:"/integral",
       		cache:false,
       		templateUrl:"templates/myshow/integral/index.html",
       		controller:"integralCtrl"
       	})
       
      //积分商城-积分知识
       .state('knowLedge',{
       		url:"/knowLedge",
       		cache:false,
       		templateUrl:"templates/myshow/integral/knowLedge.html"
       	})
       
       //积分商城-积分兑换
       .state('integral.intExchange',{
       		url:"/intExchange",
       		cache:false,
       		views:{
       			'intExchange':{
       				templateUrl:"templates/myshow/integral/intExchange.html"
       			}
       		}
       	})
       
       //积分兑换区-积分兑换
       .state('barter',{
       		url:"/barter/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/integral/barter.html",
       		controller:"barterCtrl"
       	})
       
       //积分兑换区-订单详情页
       .state('orderInfo',{
       		url:"/orderInfo/?:id",
       		cache:false,
       		params:{id:""},
       		templateUrl:"templates/myshow/integral/orderInfo.html",
       		controller:"orderInfoCtrl"
       	})
       
       
        //积分兑换区-选择收货地址
       .state('chooseAdd',{
       		url:"/chooseAdd",
       		cache:false,
       		templateUrl:"templates/myshow/integral/chooseAdd.html",
       		controller:"chooseAddCtrl"
       	})
       
       
	    //积分兑换区-添加收货地址
	   .state('addAddress',{
	   		url:"/addAddress",
	   		cache:false,
	   		templateUrl:"templates/myshow/integral/addAddress.html",
	   		controller:"addAddressCtrl"
	   	})
       
       
       //积分商城-优惠券
       .state('integral.intCoupon',{
       		url:"/intCoupon",
       		cache:false,
       		views:{
       			'intCoupon':{
       				templateUrl:"templates/myshow/integral/intCoupon.html"
       			}
       		}
       	})
       
       //积分商城-积分明细
       .state('integral.intDetail',{
       		url:"/intDetail",
       		cache:false,
       		views:{
       			'intDetail':{
       				templateUrl:"templates/myshow/integral/intDetail.html"
       			}
       		}
       	})
       
       //积分商城-我的兑换
       .state('integral.myExchange',{
       		url:"/myExchange",
       		cache:false,
       		views:{
       			'myExchange':{
       				templateUrl:"templates/myshow/integral/myExchange.html"
       			}
       		}
       	})
       

       //我的收藏
       .state('collect',{
       		url:"/collect",
       		cache:false,
       		templateUrl:"templates/myshow/collect/index.html",
       		controller:"coeCtrl"
       })

       //我的推荐
      	.state('recommend',{
       		url:"/recommend",
       		cache:false,
       		templateUrl:"templates/myshow/recommend/index.html",
       		controller:"recommendCtrl"
       });
       $urlRouterProvider.otherwise("/tab/home");

    })

app.controller('HomeTabCtrl', function($scope,$timeout,$state,$http,$ionicPopup,$ionicLoading,$ionicModal) {

		/*****五星评分参数*****/
		
	      $scope.keyword='';
	      $scope.max = 5;
		  $scope.ratingVal = 2;
		  $scope.readonly = false;
		  
		//当前位置信息初始化
		$scope.newAdd="正在定位..."

		//加载动画效果；
    	$ionicLoading.show({
		    content: 'Loading',
		    animation: 'fade-in',
		    showBackdrop: true,
		    maxWidth: 200,
		    showDelay: 0
		});

		// 百度地图API功能
		var map = new BMap.Map("allMap");
		var point = new BMap.Point(108.84685348431,34.24473247291);
		var geoc = new BMap.Geocoder();
		var geolocation = new BMap.Geolocation();

		geolocation.getCurrentPosition(function(r){
			if(this.getStatus() == BMAP_STATUS_SUCCESS){
				var pointLong = r.point.lng;
				var pointLat = r.point.lat;
				
				console.log(pointLong);
				console.log(pointLat);
				
				//本地存储位置信息；
				localStorage.setItem('pointLong',pointLong);
				localStorage.setItem('pointLat',pointLat);
				
				//定位当前点坐标
				var pointA = new BMap.Point(pointLong,pointLat);

				//解析当前坐标点
				geoc.getLocation(pointA, function(rs){

				//当前位置信息；
				var addComp = rs.addressComponents;
				console.log(addComp);
				//位置信息转化本地存储的字符串形式
				var newAddComp = JSON.stringify(addComp);
				console.log(newAddComp);
				//位置信息省+市+区+街道+号字符串拼接
				var addressLocation = addComp.province+addComp.city+addComp.district;
				console.log(addressLocation);
				$scope.newAdd = addressLocation;
				$ionicLoading.hide();
				
				
				//存储地理位置信息
				localStorage.setItem('newAddress',addressLocation);

				//定位地址输入框参数
			   $scope.data={
			   		add:""
			   }

				//初始化显示附近地址
				if($scope.data.add==""){
					$scope.flag=0;
					findAdd ($scope.newAdd)
				}


				//搜索
				$scope.serBtn = function(item){
					   if(item==""){
					   		$scope.flag=0;
							findAdd ($scope.newAdd)
						}else{
								$scope.flag=1;
								$scope.addList=""
								findAdd(item);
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
									//获取搜索附近地址
								}, 3000);
						}
					}


				//检索附近位置

				function findAdd (str){
					var options = {
					onSearchComplete: function(results){
						// 判断状态是否正确
						if (local.getStatus() == BMAP_STATUS_SUCCESS){
							var s = [];
			                $scope.addList = s;
							for (var i = 0; i < results.getCurrentNumPois(); i ++){
								s.push(results.getPoi(i).title + ", " + results.getPoi(i).address);
							}
						}
					  }
					};

					var local = new BMap.LocalSearch(map, options);
					local.search(str);
				}


				});
			}
			else {
				alert('failed'+this.getStatus());
			}
			
		
		
		/*****下拉刷新、上拉加载所需参数*****/
		
		   var index = 2 ;  //页码
		   var isLock=false;       //加载开关
		   
		   $scope.trade = '';
    	   $scope.storeList = [];  //获得的数据;
    	  
		   $scope.addHere = $scope.addShow;   //当前市区
		   $scope.hereLng = r.point.lng;      //当前经度
		   $scope.hereLat = r.point.lat;	  //当前纬度
  	 
    	/*****页面初始化,店铺列表接口*****/ 
    	 
  		$scope.init = function(){
    		var data={
    			
		    			location: $scope.addHere,
		    			lat :  $scope.hereLat,
		    			lng :  $scope.hereLng,
	    				trade : $scope.trade,
	    		},

			url='../../App/UserType/NB/getData',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};

	    	$http.post(url, data, postCfg).success(function (response) {
	    					
	    					$scope.storeData = response;
	    					console.log($scope.storeData);
	    					$scope.storeList = $scope.storeData.stores;
	    					console.log($scope.storeList);
	    					
	    	})
    	}
    	
    	$scope.init($scope.trade);
    
    	/*****上拉加载,店铺列表接口*****/  
    	 
	    $scope.loadMore = function () {
	    	
	       if(isLock)return;
	        isLock=true;
	        
	       var data={
	    			
	    				location : $scope.addHere,
		    			lat :  $scope.hereLat,
		    			lng :  $scope.hereLng,
	    				trade : $scope.trade,
	    				index : index
	    			
	    		},

			url='../../App/UserType/NB/dropLoad',
			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};

	    	$http.post(url, data, postCfg).success(function (response) {
	            console.log(response)
	            
	            if (response.stores.length == 0) {
	                $scope.hasmore = true;
	                return;
	            }
	            
	            index++;
	            $scope.storeList = $scope.storeList.concat(response.stores);
	            console.log($scope.storeList);
	            
	        }).then(function (error) {
	            isLock = false;
	            $scope.$broadcast('scroll.infiniteScrollComplete');
	            $scope.$broadcast('scroll.refreshComplete');
	        });
	    };
	    
	    //下拉刷新；
	    $scope.doRefresh = function () {
	         index = 1;
	         $scope.storeList = []; 
	         $scope.loadMore();
	    }
		  

    //获取分类显示接口
    $scope.showCategory = function(trade){

			//加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});
				
				index = 2 ; 
				$scope.hasmore = false;
				console.log(index)
				$ionicLoading.hide();
				if(trade=='热门'){
					console.log("热门")
				   $scope.trade = '';
	    		   $scope.init( $scope.trade);
		    }else{
		    		$scope.trade = trade;
					$scope.init($scope.trade)
			}

    }
    
    /*    跳转店铺详情页        */
    
    $scope.goFacts = function(obj){
   	  	console.log(obj);
   	    var time = (new Date()).getTime();
		var arrStr=JSON.stringify(obj);
		localStorage.setItem(time,arrStr)
		$state.go("facts",{id:obj.muid})
	}



   //地址输入模态窗口
    $ionicModal.fromTemplateUrl('templates/home/address.html', {
	    scope: $scope
	  }).then(function(modal) {
	    $scope.modal = modal;
	  });


	//点击附近地点更换位置信息
	 $scope.getAddress = function(item){
		 	localStorage.setItem('currentLocation',item);
		 	$scope.modal.hide();
		 	//加载动画效果；
	    	$ionicLoading.show({
			    content: 'Loading',
			    animation: 'fade-in',
			    showBackdrop: true,
			    maxWidth: 200,
			    showDelay: 0
			});

		//隐藏加载动画;
		 $ionicLoading.hide();
		 
		//返回页面;
	 	 $scope.newAdd = item;

	 }
			
			
			
			
			
			
			
			
			
			
			
			
			
		},{enableHighAccuracy: true})
		
		/*****获取当前位置信息*****/
		
//		  $scope.addHere = localStorage.getItem('newAddress');
//		  $scope.hereLng = localStorage.getItem('pointLong');
//		  $scope.hereLat = localStorage.getItem('pointLat');
//		  
//		  console.log($scope.addHere);
//		  console.log($scope.hereLng);
//		  console.log($scope.hereLat);
		  
//		  $scope.addHere = "西安市雁塔区"
//		  $scope.hereLng = 108.84685348431;
//		  $scope.hereLat = 34.24473247291;
		  
//		  $scope.lngStr = 108.84685348431;
//		  $scope.lngStr = 34.24473247291;
		  
		 
//		 alert($scope.addHere)
//		 alert("获取经度："+$scope.hereLng)
//		 alert("获取纬度："+$scope.hereLat)
		 
//	  	alert("本地经度："+$scope.lngStr)
//	  	alert("本地纬度："+$scope.lngStr)
		 
		
   });
