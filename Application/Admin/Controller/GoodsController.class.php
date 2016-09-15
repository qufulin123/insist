<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends AdminBaseController {
    public $m = null;
    public function __construct(){
        $this->m = D('goods_info');
        parent::__construct();
    }
    public function index(){
        $cate1 = I('cate1');
        $cate2 = I('cate2');
        if($cate1) $where['catid1'] = $cate1;
        if($cate2) $where['catid2'] = $cate2;

        $this->assign('cate1',$cate1);
        $this->assign('cate2',$cate2);

        $list = $this->dataPage($this->m,$where,'id desc');
        foreach($list['data'] as &$v){
            $v['operatorname'] = D('admin_user')->where(['id' => $v['operator']])->getField('real_name');
        };unset($v);
        $this->assign('list',$list['data']);

        //获取分类 目前只取两级 如有需要可改为递归获取
        $cate = D('category')->field('id,cate_name')->where(['pid' => 0])->select();
        foreach($cate as &$v){
            $v['child'] = D('category')->field('id,cate_name')->where(['pid' => $v['id']])->select();
        };unset($v);
        $this->assign('cateinfo',json_encode($cate));

        $this->display();
    }

    public function goodsadd(){
        $id = I('id',0,'int');
        if($id){
            $info = $this->m->where(['id' => $id])->find();
            $this->assign('info',$info);
            $this->assign('id',$id);
        }

        //获取分类 目前只取两级 如有需要可改为递归获取
        $cate = D('category')->field('id,cate_name')->where(['pid' => 0])->select();
        foreach($cate as &$v){
            $v['child'] = D('category')->field('id,cate_name')->where(['pid' => $v['id']])->select();
        };unset($v);
        $this->assign('cateinfo',json_encode($cate));

        $this->display();
    }

    public function dogoodsadd(){
        $id = I('id',0,'int');
        $cate1 = I('cate1',0,'int');
        $cate2 = I('cate2',0,'int');
        empty($cate1) && $this->error('请选择一级分类');
        empty($cate2) && $this->error('请选择二级分类');

        $title = tt(I('title'));
        empty($title) && $this->error('请输入商品名');


        $img = I('img');
        if($_FILES['uploadimg']['name']){
            $uploadimginfo = $this->uploadImg();
            if(!$uploadimginfo['status'])
                $this->error($uploadimginfo['msg']);
            $img = $uploadimginfo['imgurl'];
        }
        empty($img) && $this->error('请上传图片');

        $data = [
            'title' => $title,
            'img' => $img,
            'operator' => $this->admin_id,
            'catid1' => $cate1,
            'catid2' => $cate2,
        ];
        if($id){
            $data['mt'] = time();
            $r = $this->m->where(['id' => $id])->save($data);
        }else{
            $data['ct'] = time();
            $r = $this->m->add($data);
        }

        if($r)
            $this->success('保存成功',U('/idoadm/goods/index'));

        $this->error('保存失败');
    }

    public function goodsdel(){
        $id = I('id',0,'int');
        if($id){
            $this->m->where(['id' => $id])->delete();
        }
        $this->success('删除成功');
    }
}