/*! layer mobile-v1.2 弹层组件移动版 2014-10-09 License LGPL http://sentsin.com/layui/layer/ By 贤心 */
;!function(a){"use strict";var b="";b=b?b:document.scripts[document.scripts.length-1].src.match(/[\s\S]*\//)[0];var c=document,d="querySelectorAll",e="getElementsByClassName",f=function(a){return c[d](a)};document.head.appendChild(function(){var a=c.createElement("link");return a.href=b+"need/layer.css",a.type="text/css",a.rel="styleSheet",a.id="layermcss",a}());var g={type:0,shade:!0,shadeClose:!0,fixed:!0,anim:!0};a.ready={extend:function(a){var b=JSON.parse(JSON.stringify(g));for(var c in a)b[c]=a[c];return b},timer:{},end:{}};var h=0,i=["layermbox"],j=function(a){var b=this;b.config=ready.extend(a),b.view()};j.prototype.view=function(){var a=this,b=a.config,d=c.createElement("div");a.id=d.id=i[0]+h,d.setAttribute("class",i[0]+" "+i[0]+(b.type||0)),d.setAttribute("index",h);var g=function(){var a="object"==typeof b.title;return b.title?'<h3 style="'+(a?b.title[1]:"")+'">'+(a?b.title[0]:b.title)+'</h3><button class="layermend"></button>':""}(),j=function(){var a,c=(b.btn||[]).length;return 0!==c&&b.btn?(a='<span type="1">'+b.btn[0]+"</span>",2===c&&(a='<span type="0">'+b.btn[1]+"</span>"+a),'<div class="layermbtn">'+a+"</div>"):""}();if(b.fixed||(b.top=b.hasOwnProperty("top")?b.top:100,b.style=b.style||"",b.style+=" top:"+(c.body.scrollTop+b.top)+"px"),2===b.type&&(b.content='<i></i><i class="laymloadtwo"></i><i></i><div>'+(b.content||"")+"</div>"),d.innerHTML=(b.shade?'<div class="laymshade"></div>':"")+'<div class="layermmain" '+(b.fixed?"":'style="position:static;"')+'><div class="section"><div class="layermchild '+(b.type||b.shade?"":"layermborder ")+(b.anim?"layermanim":"")+'" '+(b.style?'style="'+b.style+'"':"")+">"+g+'<div class="layermcont">'+b.content+"</div>"+j+"</div></div></div>",!b.type||2===b.type){var l=c[e](i[0]+b.type),m=l.length;m>=1&&k.close(l[0].getAttribute("index"))}document.body.appendChild(d);var n=a.elem=f("#"+a.id)[0];setTimeout(function(){try{n.className=n.className+" layermshow"}catch(a){return}b.success&&b.success(n)},1),a.index=h++,a.action(b,n)},j.prototype.action=function(a,b){var c=this;if(a.time&&(ready.timer[c.index]=setTimeout(function(){k.close(c.index)},1e3*a.time)),a.title&&(b[e]("layermend")[0].onclick=function(){a.cancel&&a.cancel(),k.close(c.index)}),a.btn)for(var d=b[e]("layermbtn")[0].children,f=d.length,g=0;f>g;g++)d[g].onclick=function(){var b=this.getAttribute("type");0==b?(a.no&&a.no(),k.close(c.index)):a.yes?a.yes(c.index):k.close(c.index)};if(a.shade&&a.shadeClose){var h=b[e]("laymshade")[0];h.onclick=function(){k.close(c.index,a.end)},h.ontouchmove=function(){k.close(c.index,a.end)}}a.end&&(ready.end[c.index]=a.end)};var k={v:"1.2",index:h,open:function(a){var b=new j(a||{});return b.index},close:function(a){var b=f("#"+i[0]+a)[0];b&&(b.innerHTML="",c.body.removeChild(b),clearTimeout(ready.timer[a]),delete ready.timer[a],"function"==typeof ready.end[a]&&ready.end[a](),delete ready.end[a])},closeAll:function(){for(var a=c[e](i[0]),b=0,d=a.length;d>b;b++)k.close(a[b].getAttribute("index"))}};"function"==typeof define?define(function(){return k}):a.layer=k}(window);
function openWin(name,param){
	var data={
		name: name,
		url: name+'.html',
		opaque: true,
		bounces:false,
		vScrollBarEnabled: false,
		slidBackEnabled:false
	};
	if(param){
		data.pageParam=param;
	}
	api.openWin(data);
}
function openAd(link,link_type){
	switch (link_type){
		case 'goods':
		case 'seller':
			openWin(link_type,{id:link});
		break;
		case 'link':
		default:
			openWin('webview',{src:link});
		break;
	}
}
function openSearch(){
	var obj = api.require('searchBar');
    obj.open({
    	cancelColor:'#ffffff',
    	textColor:'#333333',
    	barBgColor:'#00a968'
    },function(ret,err){
        if(ret.isRecord){
            
        }else{
            api.openWin({
            	name: 'search-list',
				url: 'search-list.html',
				opaque: true,
				bounces:false,
				vScrollBarEnabled: false,
				slidBackEnabled:false,
				pageParam:{word:ret.text}
            });
        }
    });
}
function call(tel) {
	api.call({
		type : 'tel_prompt',
		number : tel
	});
}
function showProgress(title){
	var title=title==''?'加载中...':title;
	//show loading
    api.showProgress({
        title: title,
        modal: true,
    });
}
//user
function delWord(el){
	var input = $api.prev(el,'.txt');
	input.value = '';
}
function edit(el){
	var del = $api.next(el,'.del');
	if(el.value){
		$api.addCls(del,'show');
	}
	$api.addCls(el,'light');
}
function cancel(el){
	var del = $api.next(el,'.del');
	$api.removeCls(del,'show');
	$api.removeCls(el,'light');
}
function tips(title){
	api.toast({
	    msg: title,
	    duration:2000,
	    location: 'middle'
	});
}
/* 格式化金额 */
function price_format(price){
    if(typeof(PRICE_FORMAT) == 'undefined'){
        PRICE_FORMAT = '&yen;%s';
    }
    price = number_format(price, 2);

    return PRICE_FORMAT.replace('%s', price);
}
function number_format(num, ext){
    if(ext < 0){
        return num;
    }
    num = Number(num);
    if(isNaN(num)){
        num = 0;
    }
    var _str = num.toString();
    var _arr = _str.split('.');
    var _int = _arr[0];
    var _flt = _arr[1];
    if(_str.indexOf('.') == -1){
        /* 找不到小数点，则添加 */
        if(ext == 0){
            return _str;
        }
        var _tmp = '';
        for(var i = 0; i < ext; i++){
            _tmp += '0';
        }
        _str = _str + '.' + _tmp;
    }else{
        if(_flt.length == ext){
            return _str;
        }
        /* 找得到小数点，则截取 */
        if(_flt.length > ext){
            _str = _str.substr(0, _str.length - (_flt.length - ext));
            if(ext == 0){
                _str = _int;
            }
        }else{
            for(var i = 0; i < ext - _flt.length; i++){
                _str += '0';
            }
        }
    }

    return _str;
}
function formatDate(time,format) { 
	var d=new Date(time*1000);
	var year=d.getFullYear();
	var month=d.getMonth()+1;
	var date=d.getDate();
	var hour=d.getHours();
	var minute=d.getMinutes();
	var second=d.getSeconds();
	var format=format ? format : 'Y-m-d H:i:s';
	return format.replace('Y',year).replace('m',month).replace('d',date).replace('H',hour).replace('i',minute).replace('s',second)
} 
//打开商品详情页（经常用到）
function openGoods(id){
	api.openWin({
		name: 'goods',
		url: 'goods.html',
		pageParam: {id: id},
		opaque: true,
		bounces:false,
		vScrollBarEnabled: false,
		slidBackEnabled:false
	});
}
function scan() {
	var obj = api.require('scanner');
	obj.open(function(ret, err) {
		var resUrl = ret.msg;
		if (!resUrl) {
			return;
		}
		api.openWin({
	        name: 'webview',
	        url: 'webview.html',
	        bounces:false,
	        pageParam:{src:resUrl}
        });
	});
}

// 初始化

apiready=function(){
	//监听网络状态
	api.addEventListener({
	    name: 'offline'
	}, function(ret, err){
    	tips('当前没有网络连接，请检查网络设置');
	});
}