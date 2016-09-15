<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public $redis_cache = null;
    public function __construct(){
        parent::__construct();
        session_start();
    }

    /**
     * 图像上传
     */
    public function uploadImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      UPLOAD_PATH; // 设置附件上传目录
        // 上传文件
        $info   =   $upload->upload();
        return [
            'status' => $info ? 1 : 0,
            'msg' => $upload->getError(),
            'info' => $info,
            'imgurl' => $info ? UPLOAD_URL .$info['uploadimg']['savepath'].$info['uploadimg']['savename'] : '',
        ];
    }

    /**
     * 数据分页
     * @param $model
     * @param array $where
     * @param string $order
     * @param int $limit
     * @param string $theme
     * @return array
     */
    public function dataPage($model,$where=[],$order = '',$limit=20,$theme = ''){
        if($where){
            $model->where($where);
        }
        $count      = $model->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$limit);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        if($where){
            $model->where($where);
        }
        if($order){
            $model->order($order);
        }

        $list = $model->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        return [
            'data' => $list,
            'page' => $Page,
        ];
    }
}