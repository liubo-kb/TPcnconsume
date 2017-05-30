var app = angular.module('myApp',['ionic','ngCordova']);
app.run(function ($rootScope, $ionicPlatform, $cordovaNetwork, $cordovaBatteryStatus, $cordovaLocalNotification, $cordovaPush) {

    $ionicPlatform.ready(function () {
      if (window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      }
      if (window.StatusBar) {
        StatusBar.styleDefault();
      }

      $cordovaLocalNotification.registerPermission().then(function () {
        //alert("registered");
      }, function () {
        //alert("denied registration");
      });

      var iosConfig = {
        "badge": true,
        "sound": true,
        "alert": true
      };
      $cordovaPush.register(iosConfig).then(function (result) {
        //alert("device token: " + result.deviceToken);
      }, function (error) {
        //alert("error " + error);
      });

      $rootScope.$on('$cordovaPush:notificationReceived', function (event, notification) {
        if (notification.alert) {
          navigator.notification.alert(notification.alert);
        }
        if (notification.sound) {
          var snd = new Media(event.sound);
          snd.play();
        }
        if (notification.badge) {
          $cordovaPush.setBadgeNumber(notification.badge).then(function (result) {
            // Success!
          }, function (err) {
            // An error occurred. Show a message to the user
          });
        }
      });


      $rootScope.$on("$cordovaNetwork:offline", function (event, result) {
        alert("Device is now Offline!");
      });


      $rootScope.$on("$cordovaNetwork:online", function (event, result) {
        alert("Device is Online!");
      });

      $rootScope.$on("$cordovaBatteryStatus:status", function (event, status) {
        //alert("status: " + status);
      })
    })
  })

app.controller('ctrl', function ($scope, $cordovaGeolocation) {
	
    $scope.getLocation = function () {
      $cordovaGeolocation
        .getCurrentPosition({timeout: 10000, enableHighAccuracy: false})
        .then(function (position) {
          console.log("position found");
          $scope.position = position;
          // long = position.coords.longitude
          // lat = position.coords.latitude
        }, function (err) {
          console.log("unable to find location");
          $scope.errorMsg = "Error : " + err.message;
        });
    };

});
