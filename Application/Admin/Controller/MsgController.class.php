<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class MsgController extends AdminBaseController {
    public $m = null;
    public function __construct(){
        $this->m = D('msg');
        parent::__construct();
    }

    public function index(){
        $status = I('status',0,'int');
        $where = [
            'is_del' => 0
        ];

        if($status)
            $where['status'] = $status;

        $this->assign('status',$status);

        $this->dataPage($this->m,$where,'id desc');

        $this->display();
    }

    public function changestatus(){
        $status = I('status',0,'int');
        $id = I('id',0,'int');
        if($id && $status){
            $r = $this->m->where(['id' => $id])->save(['status' => $status == 2 ? 2 : 1]);
            if($r)
                $this->success('操作成功');
        }
        $this->error('操作失败');
    }

    public function msgdel(){
        $id = I('id',0,'int');
        if($id){
            $r = $this->m->where(['id' => $id])->save(['is_del' => 1]);
            if($r)
                $this->success('操作成功');
        }
        $this->error('操作失败');
    }
}