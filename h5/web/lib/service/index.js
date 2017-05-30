var ser=angular.module('app.services',['ionic'])

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

ser.service("commonService", function () {
    var _this=this;
    _this.prePageSelect="";
    return _this;
});
