angular.module('app.config',[])
    .service('WechatConfig',function(){
        return {
            title : '',
            desc : '',
            imgUrl : '',
        }
    })
    .service('loadConfig',function(){
        return {
            content: 'Loading',
            animation: 'fade-in',
            showBackdrop: true,
            maxWidth: 200,
            showDelay: 0
        }
    })
    .service('ConfigModule', function(){
        return {

        };
    })



    .service('API',function($http,ConfigModule,$location,$ionicLoading,loadConfig,$localStorage,WechatConfig,$timeout){


        }
    );
