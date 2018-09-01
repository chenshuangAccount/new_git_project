<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

//define('APP_DEBUG',True);
$ENV = explode('.', $_SERVER['HTTP_HOST']);

if($ENV[0]=='dev' ||$ENV[0]=='lijianwei' || $_SERVER['SERVER_ADDR'] == '127.0.0.1')
{
	//开发环境
	//debug模式
	define('APP_DEBUG', TRUE);
	define('DAOJIA_TP_PATH', __DIR__);
	define('RUNTIME_PATH','./Runtime/');
	define('APP_STATUS','config_dev');
	define('APP_PATH', DAOJIA_TP_PATH . '/Application/');
	require  '/www/Framework/branches/ThinkPHP/ThinkPHP.php';
}
else if($ENV[1]=='test2') 
{
	define('APP_DEBUG', TRUE);
	define('DAOJIA_TP_PATH', __DIR__);
	define('RUNTIME_PATH','./Runtime/');
	define('APP_STATUS','config_test');
	define('APP_PATH', DAOJIA_TP_PATH . '/Application/');
	require   '/www/Framework/ThinkPHP/ThinkPHP.php';
}
else if($ENV[1]=='pre')//预发布
{
	define('DAOJIA_TP_PATH', __DIR__);
	define('RUNTIME_PATH','./Runtime/');
	define('APP_STATUS','config_pre');
	define('APP_PATH', DAOJIA_TP_PATH . '/Application/');
	require   '/www/Framework/ThinkPHP/ThinkPHP.php';
}
else 
{
	//默认线上配置
	define('DAOJIA_TP_PATH', __DIR__);
	define('RUNTIME_PATH','./Runtime/');
	define('APP_STATUS','config_online');
	define('APP_PATH', DAOJIA_TP_PATH . '/Application/');
	require   '/www/Framework/ThinkPHP/ThinkPHP.php';
}

echo 12312;

