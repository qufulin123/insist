<?php
define('__DOMAIN__','http://'.$_SERVER['HTTP_HOST'].'/');
define('__IMAGESERVER__','http://'.$_SERVER['HTTP_HOST'].'/');

//公共目录和风格目录
define('ADMIN_PUBLIC', __IMAGESERVER__."Public/Admin/");
define('HOME_PUBLIC', __IMAGESERVER__."Public/Home/");

//附件上传目录
define('UPLOAD_URL'	, __IMAGESERVER__."Public/upload/pic/");
define('UPLOAD_PATH'	, __SITEPATH__."Public/upload/pic/");

