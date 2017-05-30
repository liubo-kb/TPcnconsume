var der = angular.module('app.directives',['ionic']);

	der.directive('ionCollect',function(){
		return{
			restrict: 'EA',
			template:"<span>立即收藏</span>",
        	replace:true,
        	link:function(scope,element,attrs){
        		element.bind('click',function(){
        			if(element.html()=='立即收藏'){
        				scope.collect("收藏成功","true");
        				element.html('取消收藏');
        			}else{
        				scope.collect("取消收藏","false");
        				element.html('立即收藏');
        			}
        		})
        	}
		}
	});
	
	/*der.directive('ionShop',function(){
		return{
				restrict: 'EA',
				template:"<span>立即购买</span>",
	        	replace:true,
        		link:function(scope,element,attrs){
	        		element.bind('click',function(){
	        			 scope.shop();
	        		}
	        	)}
	        }
       	}
	)*/
