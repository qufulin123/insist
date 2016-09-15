<?php
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends AdminBaseController {
    public function index(){
        $cateid = I('cateid',0);
        $m = D('category');
        $m->where(['pid' => $cateid]);
        $list = $m->select();
        foreach($list as &$v){
            $v['operator_name'] = D('admin_user')->where(['id' => $v['operator']])->getField('real_name');
        }
        $this->assign('list',$list);
        $this->assign('cateid',$cateid);
        $this->display();
    }

    public function cateadd(){
        //父分类
        $cateid = I('cateid',0);
        $this->assign('cateid',$cateid);
        //id
        $id = I('id',0);
        if($id){
            $info = D('category')->where(['id' => $id])->find();
            if($info)
                $this->assign('info',$info);
            else
                $id = 0;
        }
        $this->assign('id',$id);
        //链接
        $uri = I('uri');
        $this->assign('uri',$uri);
        $this->display();
    }

    public function docateadd(){
        $cateid = I('cateid',0,'int');
        $id = I('id',0,'int');
        $cate_name = tt(I('cate_name'));
        empty($cate_name) && $this->error('请输入分类名');
        $m = D('category');
        $data = [
            'cate_name' => $cate_name,
            'pid' => $cateid ? $cateid : 0,
            'operator' => $this->admin_id,
        ];

        if($id){
            $data['mt'] = time();
            $r = $m->where(['id' => $id])->save($data);
        }else{
            $data['ct'] = time();
            $r = $m->add($data);
        }
        $uri = I('uri');
        $redirect_url = $uri ? $uri : U('/idoadm/category/index');
        if($r)
            $this->success('保存成功',$redirect_url);
        $this->error('保存失败');


    }
}