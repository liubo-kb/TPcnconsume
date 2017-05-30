var module = angular.module('app.controllers', ['app.services']);
module.controller('ctrl', ['$scope', '$location',
	function($scope, $location) {

		/*		返回上一页		*/
		$scope.back = function() {
			window.history.back();
		}

		/*   返回我的          */
		
		$scope.goShow =function(){
			$location.path('/tab/myshow');
			return false;
		}
		
	}

]);




/***************************************************商铺详情页*********************************************/

module.controller('factsCtrl',['$scope','$stateParams','$http','$ionicActionSheet','$ionicPopup','myService','$state','$timeout',function($scope,$stateParams,$http,$ionicActionSheet,$ionicPopup,myService,$state,$timeout){
	
	var vm = $scope;
	 vm.muid = $stateParams.id;
	 console.log(vm.muid);
	 var people = myService.user;
	 vm.uuid = people.uuid;
	 console.log(vm.uuid);
	 
		var data={
    			muid:vm.muid
    		},
    		
		url='../../App/MerchantType/merchant/infoGet',
	
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		
    	$http.post(url, data, postCfg).success(function (response) {
    			vm.storeInfo=response;
    			vm.str=vm.storeInfo.store_number;
    			console.log(vm.storeInfo)
		});
	
	
	vm.show=function(str){
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
	
		var data2={
    			muid:vm.muid
    		},
    		
		url2='../../App/MerchantType/Info/get',
	
		postCfg2 = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
		
    	$http.post(url2, data2, postCfg2).success(function (response) {
    			vm.godMust=response;
    			console.log(vm.godMust)
		});
		
/***************************立即收藏弹窗****************************/
     vm.collect = function(str,btn) {
         	
         	var data={
		    			user:vm.uuid,
						merchant:vm.muid,
						state:btn
		    		},
    		
			url='../../App/UserType/collect/stateSet',

			postCfg = {
					    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					    transformRequest: function (data) {
					        return $.param(data);
					    }
			};
         	
           // 自定义弹窗
           var myPopup = $ionicPopup.show({
             subTitle:str,
             scope: $scope
           });
           
           myPopup.then(function(res) {
           	
			    	$http.post(url, data, postCfg).success(function (response) {
			    			vm.coeStore=response;
			    			console.log(vm.coeStore);
					});
            	
			});
				
			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
			
		}

/***************************立即购买弹窗****************************/

     vm.shop = function() {
 			var cardCount = vm.storeInfo.card_list;
 			console.log(cardCount);
 			
         	if(cardLength>0){
         		$state.go('goods',{id:vm.cardCount});
         	}else{
         	var data={
		    			user:vm.uuid,
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
			    			vm.shop=response;
			    			console.log(vm.shop);
					});
            	
			});
				
			$timeout(function() {
				myPopup.close(); // 1秒后关闭弹窗
			}, 1000);
			
		}
	}
}]);


/*****************************************购买会员卡页面******************************************/

module.controller('goodsCtrl',function($scope,$stateParams){
	var vm = $scope;
	vm.cardList = $stateParams.id;
	console.log(vm.cardList);
})



/**************************************************卡市页面************************************************/

module.controller('kashiCtrl',function($scope,$http,$ionicSlideBoxDelegate){
		$scope.keyword='';
		var data={
	    			store:$scope.keyword,
					method:"transfer"
		},
		data2={
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
			
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.cardSeconds=response;
    			console.log($scope.cardSeconds);
    			for(var i=0; i<$scope.cardSeconds.length; i++){
    				var code = $scope.cardSeconds[i].nickname;
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
	    			console.log($scope.cardCengs);
	    			for(var i=0; i<$scope.cardCengs.length; i++){
    				var code=$scope.cardCengs[i].nickname;
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
    			method:"transfer"
    		},
    		
    		data2={
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
			
	    	$http.post(url, data, postCfg).success(function (response) {
    					$scope.cardSeconds=response;
    					console.log($scope.cardSeconds);
	    			for(var i=0; i<$scope.cardSeconds.length; i++){
	    				var code = $scope.cardSeconds[i].nickname;
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
    				var code=$scope.cardCengs[i].nickname;
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
		
});



/***********************************************卡市详情页**************************************************/

module.controller('kashiInfoCtrl', ['$scope', '$ionicActionSheet','$stateParams','$timeout', function($scope, $ionicActionSheet,$stateParams,$timeout) {
	
	var vm = $scope;
	vm.muid = $stateParams.id;
	vm.nickname = $stateParams.type;
	console.log(vm.nickname);
	var dee = localStorage.getItem(vm.nickname);
	var cardJson = JSON.parse(dee);
	console.log(cardJson);
	vm.myCard = cardJson;
	vm.show = function() {
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
		str = myService.user;
	vm.page=function(){
		if(str.nickname){
			$location.path('/user')
		}else{
			$location.path('/denglu')
		}
	}
	
	vm.userInfo = str;
}]);


/*************************************************我的收藏*************************************************/

module.controller('coeCtrl',['$scope','myService','$http',function($scope,myService,$http){
	var vm = $scope;
		vm.user = myService.user;
		vm.id = vm.user.uuid;
		
	console.log(vm.user);
	console.log(vm.id);
		
		var data={
			user:vm.id
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
	
}]);






/*************************************************登录页面*************************************************/

module.controller('entryCtrl',function($scope,$http,$ionicModal){
	
		$scope.phone='15129025534',
		$scope.password='654321'
		
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
		    			var newResult = JSON.stringify(result);
		    			console.log(newResult);
		    			localStorage.setItem('ren',newResult);
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

module.controller('userCtrl', ['$scope', 'myService','$location','$ionicActionSheet', function($scope,myService,$location,$ionicActionSheet) {
	
	var info=localStorage.getItem('ren');
		//console.log(info);
	var inf = JSON.parse(info);
		console.log(inf);
	$scope.user=myService.user;
		console.log(myService.user);
	
	$scope.show = function() {
		//Show the action sheet
		 var hideSheet = $ionicActionSheet.show({
				        buttons: [{
				                text: '相册'
				            }, {
				                text: '拍照'
				            }
				        ],
				        titleText: '选择图片',
				        cancelText: '取消',
				        cancel: function() {
				            // add cancel code..
				        },
				        buttonClicked: function(index) {
				            navigator.camera.getPicture(cameraSuccess, cameraError, {
				                sourceType: index
				            }); //调用系统相册、拍照
				        }
    		});
    		
    function cameraSuccess(img) {
        $scope.img = img;//这里返回的img是选择的图片的地址，可以直接赋给img标签的src，就能显示了
        window.resolveLocalFileSystemURL(img, function success(fileEntry) { 
            upload(fileEntry.toInternalURL());//将获取的文件地址转换成file transfer插件需要的绝对地址
        }, function() {
            alert("上传失败");
        });
    }

    function cameraError(img) {
       alert("上传失败");
    }

    function upload(fileURL) {//上传图片
        var win = function(r) {//成功回调方法
            var response = JSON.parse(r.response);//你的上传接口返回的数据
            if(response.datas.state){
                alert("修改成功");
            }else {
                alert(response.datas.error);
            }
        }
        var fail = function(error) {//失败回调方法
            alert("上传失败");
        }

        var options = new FileUploadOptions();
        options.fileKey = "pic";//这是你的上传接口的文件标识，服务器通过这个标识获取文件
        options.fileName = fileURL.substr(fileURL.lastIndexOf('/') + 1);
        options.mimeType = "image/gif";//图片

        var ft = new FileTransfer();
        ft.upload(fileURL, encodeURI('uploadurl'), win, fail, options);//开始上传，uoloadurl是你的上传接口地址
    }
	};
}]);



/*******************************************设置个人资料********************************************/

module.controller('setUserCtrl',['$scope','myService','$stateParams','$http','$state',function($scope,myService,$stateParams,$http,$state){
	var vm = $scope;
	vm.user = myService.user;
	vm.useItem = $stateParams.id;
	console.log($stateParams.id);
	vm.type = $stateParams.type;
	console.log($stateParams.type);
	
	//定义接收选择结果变量
	vm.data = {
    	name: ""
  	};
  	
	vm.setItem = function(name){
		var data={
					uuid:vm.user.uuid,
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
			
  
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.message=response;
    			console.log($scope.message);
    			alert('修改成功！')
    			localStorage.setItem(vm.type,name);
    			$state.go('user',{reload:true});
    			
		});
	}
}]);


/*******************************************带有选项设置********************************************/

module.controller('setSelectCtrl',['$scope','myService','$stateParams','$timeout','$http','$state','commonService',function($scope,myService,$stateParams,$timeout,$http,$state,commonService){
	var vm = $scope;
	vm.user = myService.user;
	console.log(vm.user);
	vm.useItem = $stateParams.id;
	console.log(vm.useItem);
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
    
	vm.setCheck = function(result){
		
		var data={
					uuid:vm.user.uuid,
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
    			alert('修改成功！')
    			localStorage.setItem(vm.type,result);
    			$state.go('user',{reload:true});
    			
		});
	}
}]);


/*******************************************其它选项设置********************************************/

module.controller('setOtherCtrl',['$scope','myService','$stateParams','$http','$state',function($scope,myService,$stateParams,$http,$state){
	var vm = $scope;
	vm.user = myService.user;
	console.log(vm.user);
	vm.page = $stateParams.page;
	console.log(vm.page);
	vm.useItem = $stateParams.id;
	console.log(vm.useItem);
	vm.type = $stateParams.type;
	console.log(vm.type);
	
	//定义接收选择结果变量
	vm.data = {
    	secet: "请选择"
  	};
  
	vm.setCheck = function(secet){
		var data={
					uuid:vm.user.uuid,
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
    			$scope.setck=response;
    			console.log($scope.setck);
    			alert('修改成功！')
    			localStorage.setItem(vm.type,secet);
    			$state.go('user',{reload:true});
    			
		});
	}
}]);




/****************************************更换手机号******************************************/

module.controller('setPhoneCtrl',['$scope','myService','$stateParams','$http','$state',function($scope,myService,$stateParams,$http,$state){
	var vm = $scope;
	vm.user = myService.user;
	vm.type = $stateParams.type;
	console.log(vm.type);
	vm.data = {
    	phone: ""
  	};
  	
  	vm.setPhone=function(phone){
  		var data={
					uuid:vm.user.uuid,
	    			type:vm.type,
	    			para:phone
    		},
    		
		url='../../App/UserType/user/accountSet',
	
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
			
  
    	$http.post(url, data, postCfg).success(function (response) {
    			$scope.newPhone=response;
    			console.log($scope.newPhone);
    			alert('修改成功！')
    			localStorage.setItem(vm.type,phone);
    			$state.go('user',{reload:true});
    			
		});
  	}
}]);

/****************************************职业选择设置******************************************/

module.controller('workCtrl',['$scope','setWorkService','myService','$http','$location',function($scope,setWorkService,myService,$http,$location){
	
	var vm = $scope;	
	vm.workList = setWorkService.workList;
	vm.user = myService.user;
	console.log(vm.user);
	vm.data = {
    	work: ""
  	};
  	
	vm.setWork=function(work){
		var data={		
						uuid:vm.user.uuid,
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
		    			vm.worked = resp
		    			console.log(vm.worked);
		    			localStorage.setItem('occupation',vm.worked.para);
		    			alert('修改成功');
		    			
				})
	};
	
}]);


/****************************************密码修改设置******************************************/

module.controller('setPassCtrl',['$scope','myService','$stateParams','$http','$state',function($scope,myService,$stateParams,$http,$state){
	
	var vm = $scope;
	vm.user = myService.user;
	vm.type = $stateParams.type;
	console.log(vm.type);
	vm.data = {
    	pwdOld: "",
    	pwdNew:''
  	};
	
	vm.setPass=function(passOld, passNew){
		var data={
					uuid:vm.user.uuid,
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
    			alert('修改成功！')
    			localStorage.setItem(vm.type,passNew);
    			$state.go('user',{reload:true});
    			
		});
	}
}]);

/******************************************我的会员卡页面*****************************************/

module.controller('memBerCtrl',['$scope','myService','$http','$state',function($scope,myService,$http,$state){
	var vm = $scope;
	vm.user = myService.user;
	init();
	function init(){
		
		var data={
					uuid:vm.user.uuid
    		},
    		
		url='../../App/UserType/card/get',
	
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
			
  
    	$http.post(url, data, postCfg).success(function (response) {
    			
    			 $scope.mebSelf = response.self;
    			console.log($scope.mebSelf);
    			 $scope.mebShare = response.share;
    			console.log($scope.mebShare);
   		});
	}
	
	vm.goPage=function(obj){
		console.log(obj)
		$state.go('card',{id:JSON.stringify(obj)})
	}

}]);


/******************************************会员卡页面*****************************************/

module.controller('cardCtrl',['$scope','$stateParams','$state',function($scope,$stateParams,$state){
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	
	vm.goPage=function(item,id){
		$state.go(item,{id:JSON.stringify(id)})
	}
	
	
}]);

/******************************************会员卡充值*****************************************/
module.controller('recardCtrl',['$scope','$stateParams',function($scope,$stateParams){
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
}]);


/******************************************会员卡充值支付*****************************************/
module.controller('payCtrl',['$scope',function($scope){
	var vm = $scope;
	console.log(vm);
}]);



/******************************************我要预约*****************************************/
module.controller('orderCtrl',['$scope','myService','$stateParams','$http','$timeout','$location',function($scope,myService,$stateParams,$http,$timeout,$location){
	
	var vm = $scope;
	var people = myService.user;
	var id = JSON.parse($stateParams.id);
	vm.muid =  id.merchant;
	vm.uuid = id.user;
	vm.name = people.nickname;
	vm.phone = people.phone;
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
   		});
    }
    
}]);


/******************************************查看预约*****************************************/

module.controller('bespeakCtrl',['$scope','$stateParams','$http',function($scope,$stateParams,$http){
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
}]);


/******************************************会员卡转让*****************************************/

module.controller('attornCtrl',['$scope','$stateParams','$state',function($scope,$stateParams,$state){
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	vm.data={
		count:"0.00",
		num:""
	}
	
	vm.shank=function(num){
		var shu = num/100 * vm.id.card_remain;
		vm.data.count = shu; 
	}
	
	vm.goPage=function(id,num,item){
		if(num>=1 && num<=100){
				$state.go("shareInfo",{id:JSON.stringify(id),num:num,item:item})
		}else{
			alert('转让折扣率范围：1~100')
		}
	}
}])

/******************************************会员卡分享*****************************************/

module.controller('shareCtrl',['$scope','$stateParams','$state',function($scope,$stateParams,$state){
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	console.log(vm.id);
	
	vm.goPage=function(id,num,item){
		if(num>0 && num<=5){
			$state.go("shareInfo",{id:JSON.stringify(id),num:num,item:item})
		}else{
			alert('手续费率范围：1~5')
		}
	}
	
}]);


/******************************************会员卡分享详情页*****************************************/

module.controller('shareInfoCtrl',['$scope','$stateParams',function($scope,$stateParams){
	var vm = $scope;
	vm.id = JSON.parse($stateParams.id);
	vm.num = $stateParams.num;
	vm.item = $stateParams.item;
	if(vm.item=="分享"){
		vm.flag=1;
	}else{
		vm.flag=0;
	}
	console.log(vm.id);
	console.log(vm.num);
	console.log(vm.item);
}]);


/*************************************我的会员卡-家庭共享****************************************/

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


/*****************************************投诉理赔********************************************/

module.controller('lodgeCtrl',['$scope','$stateParams','$http',function($scope,$stateParams,$http){
	var vm = $scope;
	var id = JSON.parse($stateParams.id);
	vm.muid =  id.merchant;
	vm.uuid = id.user;
	console.log(vm.muid);
	console.log(vm.uuid);
	
	vm.data = {
    	lodge:""
  	};
  	
  	vm.lodgeList={
  		style:[
		  		{text: "欺诈", value: "欺诈"},
		  		{text: "不实信息", value: "不实信息"},
		  		{text: "侵权(冒充他人)", value: "侵权(冒充他人)"},
		  		{text: "其他", value: "其他"}
		  	]
  	};
  	
	vm.setDge=function(item){
		console.log(item);
		
		var data = {
					muid : vm.muid,
					uuid : vm.uuid,
					reason : item
		},
		
		url='../../App/UserType/complaint/commit',
	
		postCfg = {
				    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				    transformRequest: function (data) {
				        return $.param(data);
				    }
		};
			
  
    	$http.post(url, data, postCfg).success(function (response) {
    			 vm.setDge = response;
    			console.log(vm.setDge);
    			
   		});	
	}
}])
