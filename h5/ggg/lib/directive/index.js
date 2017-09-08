var der = angular.module('app.directives',[]);


	der.directive('fileModel', ['$parse', function ($parse) {
			  return {
			    restrict: 'A',
			    link: function(scope, element, attrs, ngModel) {
			      var model = $parse(attrs.fileModel);
			      var modelSetter = model.assign;
			      element.bind('change', function(event){
			        scope.$apply(function(){
			          modelSetter(scope, element[0].files[0]);
			        });
			        //附件预览
			           scope.file = (event.srcElement || event.target).files[0];
			        scope.getFile();
			      });
			    }
			  };
	}]);

//店铺星级评论
	der.directive('star', function () {
	  return {
	  	restrict: 'EA',
	    template: '<ul class="rating">' +
	        '<li ng-repeat="star in stars" ng-class="star">' +
	        '\u2605' +
	        '</li>' +
	        '</ul>',
	    scope: {
	      ratingValue: '=',
	      max: '=',
	      readonly: '@',
	    },
	    controller: function($scope){
	      $scope.ratingValue = Math.floor($scope.ratingValue) || 0;
	      $scope.max = $scope.max || 5;
	    },
	    link: function (scope,elem,attrs) {
	      elem.css("text-align","center");
	      var updateStars = function () {
	        scope.stars = [];
	        for (var i = 0; i < scope.max; i++) {
	          scope.stars.push({
	            filled: i < scope.ratingValue
	          });
	        }
	      };
	      updateStars();
	    }
	  };
	});
			
//首页热门分类切换	
	der.directive('ionHot',function () {
			  return {
			    restrict: 'EA',
			    link: function(scope, element, attrs) {
			      element.on('click', function(event){
			      	 var name = $(this).html();
			          console.log(name)
			      	$(this).addClass('active').siblings().removeClass('active');
			      	scope.showCategory(name,1)
			      });
			    }
			  };
	});
	
//店铺详情页-底部按钮切换
	der.directive('ionShow',function () {
			  return {
			    restrict: 'EA',
			    link:function(scope,element,attrs){
			    	element.on('click', function(event){
			      	$(this).addClass('shopActive').siblings().removeClass('shopActive');
	
			      });
			    }
		};
	});
	
//商户详情,领取
	der.directive('ionCoupon',function () {
			  return {
			    restrict: 'EA',
			    link:function(scope,element,attrs){
			    	element.on('click', function(event){
			      	$(this).addClass('gray');
			      	$(this).html("已领取")
			      });
			    }
		};
	});
