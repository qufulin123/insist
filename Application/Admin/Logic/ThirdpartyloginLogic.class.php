<?php
namespace Wap\Logic;
use Think\Model;
class ThirdpartyloginLogic extends Model{

    public function __construct(){
    }

    /**
     * 返回wap端微信登陆url
     */
    public function wap_weixinGetLoginUrl(){
        $data = [
            'appid' => 'wx773d1fd2e6c392e9',
            'redirect_uri' => 'http://www.peikua.com/ceshi/wap/user/wx_login_ok',
            'response_type' => 'code',
            'scope' => 'snsapi_login',
            'state' => session_id(),
        ];
        return 'https://open.weixin.qq.com/connect/qrconnect?'.http_build_query($data).'#wechat_redirect';
    }

}
