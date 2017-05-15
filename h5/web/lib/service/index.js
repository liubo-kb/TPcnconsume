var ser=angular.module('app.services',[])

ser.service('myService', function() {
	var b = new person();
	return{
		user:b
	} 
})

ser.service('setWorkService',function(){
	var myWork=new work();
	 return {
	 	workList:myWork
	 }
})
