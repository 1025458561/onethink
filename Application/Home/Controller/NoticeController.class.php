<?php
namespace Home\Controller;


class NoticeController extends HomeController{
    public function index(){
        $model = M('document');
        $page=I('get.p',0);
        $PageSize=2;//自定义显示条数
        $list= $model->table('onethink_document,onethink_picture')
            ->where('onethink_document.cover_id=onethink_picture.id')
            ->field('onethink_document.id,onethink_document.title,onethink_document.description,onethink_document.view,onethink_picture.path')
            ->limit($page*$PageSize,$PageSize)->select();
        //var_dump($list);exit;
        if($page>0){
            $result=[];
//            var_dump($list);exit;
            if($list!=null){
                //var_dump($list);exit;
                foreach($list as &$v){
                    $v['create_time']=date('Y-m-d H:i',$v['create_time']);
                }
                $result=[
                    'status'=>1,
                    'msg'=>'获取数据成功',
                    'page'=>$list
                ];
            }else{
                $result=[
                    'status'=>0,
                    'msg'=>'没有更多数据',
                    'page'=>[]
                ];
            }
            //var_dump($result);exit;
            echo json_encode($result);
        }else{
            //var_dump($list);exit;
            $this->assign('list', $list);
            $this->display('index');
        }
    }

    public function content(){
        $model = M('document');
        $id = I('get.id',0);
        $list = $model->where(['id'=>$id])->field('title,create_time')->find();
        $article=D('Document_article')->where(['id'=>$id])->field('content')->find();
       // var_dump($list);exit;
        //var_dump($article);exit;
        $this->assign('list',$list);
        $this->assign('article',$article);
        $this->display('notice-detail');
    }
}