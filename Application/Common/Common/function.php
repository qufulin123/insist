<?php
/**
 * 发送HTTP请求方法
 * @param  string $url    请求URL
 * @param  array  $params 请求参数
 * @param  string $method 请求方法GET/POST
 * @return array  $data   响应数据
 */
function http($url, $params, $method = 'GET', $header = array(), $multi = false){
    $opts = array(
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER     => $header
    );
    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            break;
        case 'POST':
            //判断是否传输文件
            $params = $multi ? $params : http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            return false;
    }
    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $json_decode = json_decode($data,true);
    curl_close($ch);
    return  $json_decode ? $json_decode : $data;
}

function setLastUrl(){
    if(I('last_url'))
        $pageName = I('list_url');
    else
        $pageName = $_SERVER['REQUEST_URI'];

    $not_save_action = C('not_save_action');
    $check = true;
    foreach($not_save_action as $v){
        if(strpos($pageName,$v) !== false){
            $check = false;
            break;
        }
    }
    if($check){
        $lasturl = rtrim(__DOMAIN__.$pageName,'.html');
        $_SESSION['_lasturl_'] = $lasturl;
    }
}


function getPicSubPath($pic_name) {
    $img = explode('.',$pic_name);
    $md5_dir = md5($img[0]);
    $dir = substr($md5_dir,0,1).'/'.substr($md5_dir,1,1).'/';
    return $dir;
}

function getImgUrl($pic_name) {
    $dir = getPicSubPath($pic_name);
    return UPLOAD_URL.$dir.$pic_name;
}

function getImgPath($pic_name){
    $dir = getPicSubPath($pic_name);
    return UPLOAD_PATH.$dir.$pic_name;
}

function createPicName(){
    list($usec, $sec) = explode(" ", microtime());
    $img_name = date('YmdHis').substr($usec,2,5).rand(1000,9999);
    return $img_name;
}

//自动截取字符串加...
function cutstr($str,$len = 30,$suffix = '...')
{
    if (mb_strlen($str, 'utf8') > $len)
        $str = mb_substr($str, 0, $len, 'utf8') . $suffix;
    return $str;
}

//过滤脚本代码
function cleanJs($text,$do_filter=false){
    $text	=	trim($text);
    $text	=	stripslashes($text);
    //完全过滤动态代码
    $text	=	preg_replace('/<\?|\?>/is','',$text);
    //完全过滤js
    $text	=	preg_replace('/<script?.*\/script>/is','',$text);
    //过滤多余html
    $text	=	preg_replace('/<\/?(html|head|meta|link|base|body|title|style|script|form|iframe|frame|frameset)[^><]*>/is','',$text);
    //过滤on事件lang js
    while(preg_match('/(<[^><]+)(lang|onload|onfinish|onmouse|onexit|onerror|onclick|onkey|onload|onchange|onfocus|onblur)[^><]+/is',$text,$mat)){
        $text=str_replace($mat[0],$mat[1],$text);
    }
    while(preg_match('/(onfinish|onload|onmouse[a-z]+|onexit|onerror|onclick|onkey|onload|onchange|onfocus|onblur|expression)([=\(])/is',$text,$mat)){
        $text=str_replace($mat[0],$mat[1].'#'.$mat[2],$text);
    }
    while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/is',$text,$mat)){
        $text=str_replace($mat[0],$mat[1].$mat[3],$text);
    }
    $text	=	str_ireplace('script','sc#ipt',$text);
    if($do_filter)
        return GFW($text);
    else
        return $text;

}
//纯文本输出
function tt($text,$do_filter=false){
    $text	=	cleanJs($text,$do_filter);
    $text	=	strip_tags($text);
    return $text;
}



