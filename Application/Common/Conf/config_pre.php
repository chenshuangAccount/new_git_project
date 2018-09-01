<?php
return array(
	//'配置项'=>'配置值'
	'LOG_RECORD' => true, // 开启日志记录
	'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误
	'DB_FIELDS_CACHE' => true,

    'TMPL_L_DELIM'=>'<{',
    'TMPL_R_DELIM'=>'}>',

    'VAR_PAGE'=>'page',

    'COOKIE_EXPIRE' => 0,					// Cookie有效期
    'COOKIE_DOMAIN' => '.daojia.com.cn',      // Cookie有效域名
    'COOKIE_PATH' => '/',					 // Cookie路径

	'URL_MODEL'=>2,
	'URL_CASE_INSENSITIVE' =>true,												#url支持大小写
	
	'MODULE_ALLOW_LIST'    =>    array('Payment'),				#模块配置
	'DEFAULT_MODULE'       =>    'Payment',
	'VAR_MODULE'           =>    'vm',											#覆盖thinkphp默认模块变量
	'LOAD_EXT_CONFIG'	=>	array(),
	'PAYMENTSOA_URL'=>'http://paymentsoa.pre.daojia.com.cn'
	
);