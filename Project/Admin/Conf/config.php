<?php
return array(
	//调试展示项
	'SHOW_PAGE_TRACE' => false,

	//数据库配置
	'DB_TYPE' => 'mysql',
	'DB_HOST' => '127.0.0.1',
	'DB_NAME' => 'cnconsum',
	'DB_USER' => 'root',
	'DB_PWD' => 'naruto68',
	'DB_PORT' => '3306',
	'DB_PREFIX' => 'cn_',

	//开启路由
	'URL_ROUTER_ON' => true,

	//路由规则
	'URL_ROUTE_RULES' => array(
	
		'table' => 'Admin/Index/index',
		
	),
);
