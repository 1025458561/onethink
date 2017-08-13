<?php
namespace Home\Controller;


use Admin\Model\BaoxiuModel;

class OnlineController extends HomeController{


    public function add(){
        if(IS_POST){
            $model = D('baoxiu');
           // var_dump($model);exit;
            $data = $model->create();
          //  var_dump($data);exit;
            if($data){
              $id =   $model->add();
                if($id){
                    $this->success('添加成功',U('index'));
                }else{
                    $this->error($model->getError());
                }
            }else{
                $this->error($model->getError());
            }

        }
            $this->display('online');

    }

}