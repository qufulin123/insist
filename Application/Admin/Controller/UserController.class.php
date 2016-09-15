<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends AdminBaseController {
    public function index(){
        $list = D('admin_user')->order('id desc')->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function login(){
        layout(false);
        if($this->admin_id && $this->admin_level && $this->admin_name)
            $this->goHome();
        $this->display();
    }

    public function checklogin(){
        $user_name = tt(I("post.user_name"));
        $user_pass = tt(I('post.user_pass'));
        empty($user_name) && $this->error('请输入帐号');
        empty($user_pass) && $this->error('请输入密码');
        $m = D('admin_user');
        $info = $m->where([
            'user_name' => $user_name,
        ])->find();
        empty($info) && $this->error('帐号或密码有误');
        !$info['status'] && $this->error('您的账户已被锁定');
        ($info['user_pass'] !== md5($user_pass)) && $this->error('帐号或密码错误');
        //成功
        session('admin_uid',$info['id']);
        session('admin_uname',$info['user_name']);
        session('admin_level',$info['level']);
        $m->data(['last_login' => time()])->where(['id' => $info['id']])->save();
        $this->goHome();
    }

    public function logout(){
        session('admin_uid',null);
        session('admin_uname',null);
        session('admin_level',null);
        $this->goLogin();
    }

    public function useradd(){
        $id = I('id',0,'int');
        if($id){
            $info = D('admin_user')->find($id);
            $this->assign('info',$info);
            $this->assign('id',$id);
        }
        $this->display();
    }

    public function douseradd(){
        $id = I('id',0,'int');
        $m = D('admin_user');
        $user_name = tt(I('user_name'));
        $real_name = tt(I('real_name'));
        $user_pass = tt(I('user_pass'));
        $user_pass2 = tt(I('user_pass2'));
        $old_pass = tt(I('old_pass'));
        $level = I('level',2,'int');

        $data = [];
        empty($real_name) && $this->error('请填写昵称');
        if($id){
            if($user_pass){
                $user_pass != $user_pass2 && $this->error('两次密码不一致');
                $info = $m->where(['user_name' => $user_name,'user_pass' => md5($old_pass),'id' => $id])->count();
                if(empty($info))
                    $this->error('原密码不正确');
                $data['user_pass'] = md5($user_pass);
            }
            $data['level'] = $level == 1 ? 1 : 2;
            $data['real_name'] = $real_name;
            $r = $m->where(['id' => $id])->save($data);
        }else{
            empty($user_name) && $this->error('请填写账号');
            empty($user_pass) && $this->error('请填写密码');
            empty($user_pass2) && $this->error('请再次输入密码');
            $user_pass != $user_pass2 && $this->error('两次密码不一致');
            $data = [
                'user_name' => $user_name,
                'user_pass' => md5($user_pass),
                'real_name' => $real_name,
                'level' => $level == 1 ? 1 : 2,
                'status' => 1,
                'ct' => time(),
            ];
            $r = $m->add($data);
        }

        if($r)
            $this->success('操作成功');

        $this->error('操作失败');

    }

    public function userdel(){
        $id = I('id',0,'int');
        $type = I('type');
        if($type == 'del'){
            $r = D('admin_user')->where(['id' => $id])->delete();
        }else if($type == 'change'){
            $status = I('status',0,'int');
            $r = D('admin_user')->where(['id' => $id])->save(['status' => $status == 1 ? 0 : 1]);
        }
        if($r)
            $this->success('操作成功');

        $this->error('操作失败');
    }

}