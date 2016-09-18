<?php
namespace Admin\Controller;
use Think\Controller;
class AdminBaseController extends \Home\Controller\BaseController {
    public $admin_id = null;
    public $admin_level = null;
    public $admin_name = null;

    public function __construct(){
        parent::__construct();
        setLastUrl();

        if(!in_array(strtolower(__ACTION__),C('not_check_action'))){
            if(session('?admin_uid') && session('?admin_uname') && session('?admin_level')){
                $this->admin_id = session('admin_uid');
                $this->admin_level = intval(session('admin_level'));
                $this->admin_name = session('admin_uname');
                $this->assign('admin_name',$this->admin_name);
                $this->assign('admin_level',$this->admin_level);
                $level_name_list = C('level_to_name');
                $level_name = isset($level_name_list[$this->admin_level]) ? $level_name_list[$this->admin_level] : '';
                $this->assign('admin_levelname',$level_name);

            }else{
                $this->goLogin();
            }
        }
    }

    public function goLogin(){
        $this->redirect('/idoadm/user/login');
    }

    public function goHome(){
        $this->redirect('/idoadm/index/index');
    }

    public function goBack(){
        $this->redirect(I('SESSION._lasturl_'));
    }
}