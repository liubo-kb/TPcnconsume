A11 

## 用途: 
1. 模块组开发自测.
2. 测试用例备份.

## 几点说明

1. 如何验证测试用例本身的可用性?

把下面代码复制到测试用例文件夹,讲 methods 数组后修改为目标页面用到的模块方法. 

```
<script>
api = {};

var methods = ["open", "close", "reloadData", "deleteItem", "insertItem", 
"refreshItem", "appendData", "setRefreshHeader", "setRefreshFooter", "show", "hide"];

api.require = function(name){
    var module = {};

    var demoFunc = function(params, callback){

        if(params === undefined){
            alert("这个函数没有任何方法");

            return;
        }

        if(undefined == callback){
            callback = params;
        }else{
            alert("传入的参数: " + JSON.stringify(params));
        }

        callback({
            status: true,
            uid: "uid123456",
            state: "uploaded",
            datas: ["data1", "data2", "data3"],
            uuid: "uuid123490",
            eventType: "leftBtn",
            index: 0,
            btnIndex: 0
        }, {
            msg: "未知错误",
            code: "404"
        });
    }

    for(var idx in  methods){
        var methodName = methods[idx];

        module[methodName] = demoFunc;
    }

    return module;
};
</script>
```
