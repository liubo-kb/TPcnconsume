controllers.controller("MainCtrl", function ($scope, $timeout, $state, $ionicModal, commonService) {

    //定义接收选择结果变量
    $scope.data = {result: ""};

    //定义回调函数
    $scope.callback=function(value){
        alert( "回调函数获得结果："+ value);
        return false;
    }
    $scope.serverData={loadLazyTime:""};
    //模拟默认时间从服务端加载 获取其他获取方式
    $timeout(function () {
        $scope.serverData.loadLazyTime="2017-08-16 10:00";
    },1000)

    $ionicModal.fromTemplateUrl('my-modal.html', {
        scope: $scope,
        animation: 'slide-in-up'
    }).then(function(modal) {
        $scope.modal = modal;
    });
    $scope.openModal = function() {
        $scope.modal.show();
    };
    $scope.closeModal = function() {
        $scope.modal.hide();
    };

})