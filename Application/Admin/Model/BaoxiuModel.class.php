<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 15:59
 */
namespace Admin\Model;

use Think\Model;

class BaoxiuModel extends Model{
    protected $_validate = array(
        array('name', 'require', '名字不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('housenu', 'require', '详细地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('content', 'require', '身份证不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
      //  array('sex', 'require', '性别不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),

    );
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MOINSERTDEL_),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_BOTH),
    );

}