<?php
error_reporting(E_ALL||~E_NOTICE);
header("Content-type:text/html;charset=utf-8");

require_once "jssdk.php";
$jssdk = new JSSDK("wxd22fb42d8ddea9ae", "0079c97950647fd83449858cff9e1b36");
$signPackage = $jssdk->GetSignPackage();
?>

<html ng-app="ionicApp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    
    <title>商消乐</title>
    <link href="https://cdn.bootcss.com/ionic/1.3.2/css/ionic.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/css/common.css" />
    <link rel="stylesheet" href="vendor/css/style.css" />
    <link rel="stylesheet" href="vendor/font/iconfont.css" />
    <script src="https://cdn.bootcss.com/ionic/1.3.2/js/ionic.bundle.min.js"></script>
    <script src='lib/app.js'></script>
   
    <script src='http://res.wx.qq.com/open/js/jweixin-1.2.0.js'></script>
  </head>
  <body ng-controller='ctrl'>
    	<ion-nav-view></ion-nav-view>
  </body>
   <script type='text/javascript'>
   	
   	wx.config({
								    debug: true,
								    appId: 'wxd22fb42d8ddea9ae',
								    timestamp: 1,
								    nonceStr: '1',
								    signature: '82d943ec40e4387b1a095095b4fef5acbcff4625',
								    jsApiList: [
								    'chooseImage'
								      // 所有要调用的 API 都要加到这个列表中
								    ]
							});
    wx.chooseImage({
							    count: 1, // 默认9
							    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
							    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
							    success: function (res) {
							        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
						    }
						});
   	
   	
   	
   	
   	var module = angular.module('app.controllers', []);
			module.controller('ctrl', ['$scope','$location',
    function ($scope, $location) {
    	
    	/*		返回上一页		*/
        $scope.back = function () {
            window.history.back();
        }
    	
        /*		调转到指定页面			*/
        $scope.turn = function (url) {
            $location.path('templates/kashi/' + url);
        }
    }]
);

module.controller( 'kashiInfoCtrl',['$scope','$ionicActionSheet','$timeout' ,function($scope,$ionicActionSheet){
              $scope.show = function() {
					//Show the action sheet
				
                  var hideSheet = $ionicActionSheet.show({
                  	cancelOnStateChange:true,
                  	cssClass:'action_s',
                  	titleText:'支付方式',
                      buttons: [
                        {text:'支付宝支付' },
                        {text:'银联支付' }
                      ],
                      cancelText: '',
                      cancel: function() {
                           // add cancel code..
                           return true;
                         },
                         
                      destructiveText: '撤销',
                      destructiveButtonClicked:function(){
                      	
									var x;
									var r=confirm("去意已决吗？");
									if (r==true){
										x="你按下了\"确定\"按钮!";
										return true;
									}
									else{
										x="你按下了\"取消\"按钮!";
									}
									document.getElementById("demo").innerHTML=x;

                			
                            },
                      
                      buttonClicked: function() {
                      	wx.chooseImage();
                        return true;
                      }
                  });

                 
              };  
          }]);
          
  module.controller( 'usernameCtrl',['$scope','$ionicActionSheet' ,function($scope,$ionicActionSheet){
              $scope.show = function() {
					//Show the action sheet
				
                  var hideSheet = $ionicActionSheet.show({
                  	cancelOnStateChange:true,
                  	cssClass:'action_s',
                  	titleText:'选择照片',
                      buttons: [
                        {text:'拍照/从相册选择' }
                      ],
                      cancelText: '',
                      cancel: function() {
                           // add cancel code..
                           return true;
                         },
                         
                      destructiveText: '取消',
                      destructiveButtonClicked:function(){
                      	
									var x;
									var r=confirm("去意已决吗？");
									if (r==true){
										x="你按下了\"确定\"按钮!";
										return true;
									}
									else{
										x="你按下了\"取消\"按钮!";
									}
									document.getElementById("demo").innerHTML=x;

                			
                            },
                      
                      buttonClicked: function() {
                        return true;
                      }
                  });

                 
              };  
          }]);
   </script>
</html>