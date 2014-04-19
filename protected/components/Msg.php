<?php
class Msg {
    /**
    * 成功提示
    * @param type $msg 提示信息
    * @param type $jumpurl 跳转url
    * @param type $wait 等待时间
    */
    static function success($msg="",$jumpurl="",$wait=3){
       self::_jump($msg, $jumpurl, $wait, 1);
    }

    /**
    * 错误提示
    * @param type $msg 提示信息
    * @param type $jumpurl 跳转url
    * @param type $wait 等待时间
    */
    static function error($msg="",$jumpurl="",$wait=3){
            self::_jump($msg, $jumpurl, $wait, 0);
    }

    /**
     * 最终跳转处理
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     * @param int $type 消息类型 0或1
     */
    static private function _jump($msg="",$jumpurl="",$wait=3,$type=0){
        $info = array(
            'msg' => $msg,
            'jumpurl' => $jumpurl,
            'wait' => $wait,
            'type' => $type
        );
        Yii::app()->user->setFlash('showmessage',$info);
        Yii::app()->runController("Site/ShowMessage");
    }

}
?>