<?php
return array(
	
	//调试展示项
	'SHOW_PAGE_TRACE' => false,
	
	//设置多级控制器
	'CONTROLLER_LEVEL' => 2,
	'APP_SUB_DOMAIN_DEPLOY' => true,
	
	 //开启路由
        'URL_ROUTER_ON' => false,

        //路由规则
        'URL_ROUTE_RULES' => array(

                'my' => 'Home/Extra/Index/index',

        ),
	

	//数据库配置
	'DB_TYPE' => 'mysql',
	'DB_HOST' => '127.0.0.1',
	'DB_NAME' => 'cnconsum',
	'DB_USER' => 'root',
	'DB_PWD' => 'naruto68',
	'DB_PORT' => '3306',
	'DB_PREFIX' => 'cn_',

	//加载扩展配置
	'LOAD_EXT_CONFIG' => 'app_config',
	
);
