<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class IndexController extends AdminBaseController {
    public function index(){
        layout(true);
        //获取未处理的留言数
        $num = D('msg')->where(['status' => 1,'is_del' => 0])->count();
        $this->assign('msg_num',$num);
        //消息信息
        $msg_list = D('msg')->where(['status' => 1,'is_del'=>0])->order('id desc')->limit(3)->select();
        $this->assign('msg_list',$msg_list);
        $this->display();
    }
}