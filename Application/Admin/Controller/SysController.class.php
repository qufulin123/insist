<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class SysController extends AdminBaseController {
    public $m = null;
    public function __construct(){
        $this->m = D('banner');
        parent::__construct();
    }

    public function banner(){
        $where = ['is_del' => 0];
        $time = time();
        $status = I('status',0,'int');
        $this->assign('status',$status);

        if($status == 1){
            $where['_string'] = "start_time <= {$time} and (end_time = 0 or end_time >= {$time})";
        }else if($status == 2){
            $where['start_time'] = ['gt',$time];
        }else if($status == 3){
            $where['_string'] = "end_time != 0 and end_time < {$time}";
        }
        $list = $this->dataPage($this->m,$where,'id desc');
        foreach($list['data'] as &$v){
            if($v['start_time'] <= $time && ($v['end_time'] == 0 || $v['end_time'] >= $time))
                $v['status_name'] = '正在进行';
            else if($v['start_time'] > $time)
                $v['status_name'] = '即将开始';
            else if($v['end_time'] != 0 && $v['end_time'] < $time)
                $v['status_name'] = '已结束';
        };unset($v);
        $this->assign('list',$list['data']);

        $this->display();
    }

    public function banneradd(){
        $id = I('id',0,'int');
        if($id){
            $info = $this->m->where(['id' => $id])->find();
            $this->assign('info',$info);
            $this->assign('id',$id);
        }

        $this->display();
    }

    public function dobanneradd(){
        $id = I('id',0,'int');
        $start_time = strtotime(I('start_time',0));
        $end_time = strtotime(I('end_time',0));

        $img = I('img');
        if($_FILES['uploadimg']['name']){
            $uploadimginfo = $this->uploadImg();
            if(!$uploadimginfo['status'])
                $this->error($uploadimginfo['msg']);
            $img = $uploadimginfo['imgurl'];
        }
        empty($img) && $this->error('请上传图片');

        if(!empty($start_time) && !empty($end_time)){
            if($end_time <= $start_time)
                $this->error('日期设置错误');
        }

        $data = [
            'img' => $img,
            'start_time' => $start_time ? $start_time : 0,
            'end_time' => $end_time ? $end_time : 0,
            'operator' => $this->admin_id,
        ];
        if($id){
            $data['mt'] = time();
            $r = $this->m->where(['id' => $id])->save($data);
        }else{
            $data['ct'] = time();
            $r = $this->m->add($data);
        }

        if($r)
            $this->success('保存成功',U('/idoadm/sys/banner'));

        $this->error('保存失败');
    }

    public function bannerdel(){
        $id = I('id',0,'int');
        if($id){
            $r = $this->m->where(['id' => $id])->save(['is_del' => 1]);
            if($r)
                $this->error('删除成功');
        }
        $this->error('删除失败');
    }
}