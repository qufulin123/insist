<?php
return array(
    //手动配置内容
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'ido',
    'DB_USER' => 'root',
    'DB_PWD' => '123456',
    'DB_PORT' => 3306,

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //到此结束





















    //以下内容无需配置
    //----------------------------------------------------------------------------------------

    'DB_TYPE' => 'mysqli',
    'DB_PREFIX' => 'ido_',
    'DB_CHARSET' => 'utf8',
    'DB_DEBUG' =>  false,

    'SHOW_PAGE_TRACE' => false,
    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

    //不记录的链接
    'not_save_action' => [
        '/wap/user/',
    ],
    'not_check_action' => [
        '/idoadm/User/login',
        '/idoadm/User/checklogin',
    ],

    //模版变量
    'TMPL_PARSE_STRING'  =>array(
        '__ADMIN_PUBLIC__' => ADMIN_PUBLIC, // 更改默认的/Public 替换规则
        '__HOME_PUBLIC__' => HOME_PUBLIC, // 更改默认的/Public 替换规则
    ),

    //缓存
    'HTML_CACHE_ON' => false,

    //模块
    'MODULE_ALLOW_LIST'    =>    array('Home','Idoadm'),
//    'MODULE_DENY_LIST' => array('Admin'),
    'DEFAULT_MODULE'       =>    'Home',
    //模块映射
    'URL_MODULE_MAP' => array('idoadm' => 'admin'),
);