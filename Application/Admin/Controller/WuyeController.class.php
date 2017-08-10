<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 14:44
 */
namespace Admin\Controller;


use Admin\Model\BaoxiuModel;

class WuyeController extends AdminController{
    public function index(){
       // echo 1;exit;
        $pid = i('get.pid', 0);
      //  var_dump($pid);exit;
        /* 获取频道列表 */
     //   $map  = array('status' => array('gt', -1), 'pid'=>$pid);
        //M查询相应的表数据
        $list = M('baoxiu')->select();
        // var_dump($list);exit;
        //传输数据assign
        $this->assign('list', $list);
        $this->assign('pid', $pid);
    //var_dump( $this->assign('list', $list));exit;
        //展示当前视图
        $this->display('index');
    }

    public function add(){
        if(IS_POST){
            //D加载相对应的模型
          $baoxiu = D('baoxiu');
          //保存表单传过来 数据
          $data = $baoxiu->create();
          if($data){
              //验证
              $id = $baoxiu->add();
              if($id){
                  $this->success('添加成功',U('index'));
              }else{
                  $this->error($baoxiu->getError());
              }
          }else{
              $this->error($baoxiu->getError());
          }
        }
        $this->display('edit');
    }

    public function edit($id =0){
        if(IS_POST){
            $baoxiu = D('baoxiu');

            $data = $baoxiu->create();
            if($data){
                if($baoxiu->save()){
                    //记录行为
                    //action_log('update_channel', 'channel', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error($baoxiu->getError());
                }

            } else {
                $this->error($baoxiu->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('baoxiu')->find($id);
//var_dump($info);exit;
            if($info ===false) {
                $this->error('获取配置信息错误');
            }
                $pid = i('get.pid', 0);
                //获取父导航
                if (!empty($pid)) {
                    $parent = M('baoxiu')->where(array('id' => $pid))->field('title')->find();
                    $this->assign('parent', $parent);
                }
                $this->assign('pid', $pid);
                $this->assign('info', $info);
                $this->meta_title = '编辑导航';
             //   var_dump($info);exit;
                $this->display('edit');

            }
       // $this->display('edit');
    }
    //删除
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('baoxiu')->where($map)->delete()){
            //记录行为

            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}