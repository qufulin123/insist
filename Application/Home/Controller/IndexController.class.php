<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends HomeBaseController {
    public function index(){
        //读取banner
        $time = time();
        $where = "start_time <= {$time} and (end_time = 0 or end_time >= {$time}) and is_del = 0";
        $list = D('banner')->where($where)->order('mt desc,id desc')->select();
        $this->assign('list',$list);
        //读取2个分类
        $cate = D('category')->where('pid = 0')->order('mt desc,id desc')->limit(2)->select();
        $this->assign('cate',$cate);
        $this->display();
    }

    public function product(){
        $catid1 = I('catid1',0,'int');
        $catid2 = I('catid2',0,'int');

        //读取一级分类
        $cate1 = D('category')->where(['pid' => 0])->order('mt desc,id desc')->limit(6)->select();
        if(empty($catid1))
            $catid1 = isset($cate1[0]['id']) ? $cate1[0]['id'] : 0;
        //根据一级分类Id 读取二级
        $cate2 = D('category')->where(['pid' => $catid1])->order('mt desc,id desc')->limit(10)->select();
        if(empty($catid2))
            $catid2 = isset($cate2[0]['id']) ? $cate2[0]['id'] : 0;
        //根据分类 查询商品
        $goods = D('goods_info')->where(['catid1' => $catid1,'catid2' => $catid2])->order('mt desc,id desc')->limit(5)->select();
        $this->assign('cate1',$cate1);
        $this->assign('cate2',$cate2);
        $this->assign('catid1',$catid1);
        $this->assign('catid2',$catid2);
        $this->assign('goods',$goods);
        $this->display();
    }

    public function contact(){
        if(IS_POST){
            $name = tt(I('name'));
            $email = tt(I('email','','email'));
            $content = tt(I('content'));
            empty($name) && $this->error("Name can't be blank.");
            empty($email) && $this->error('Email is required,Please check your email.');

            $r = D('msg')->add([
                'name' => $name,
                'content' => $content,
                'email' => $email,
                'ip' => get_client_ip(),
                'ct' => time(),
                'status' => 1,
                'is_del' => 0,
            ]);
            if($r)
                $this->success('Thankyou for your feedback');
            else
                $this->error('Server error,Please try again');
        }
        $this->display();
    }

    public function about(){
        $this->display();
    }
}