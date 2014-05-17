<?php
/*
 * 获得联动子菜单
 */
class MenulinkageAction extends CAction{

   public function run(){
       $data=Data::model()->findAll('letter=:letter_id',array(':letter_id'=> $_POST['letter']));
       echo CHtml::tag('option',array('value'=>0),'请选择视频名称',true);
       $data=CHtml::listData($data,'id','name');
       foreach($data as $value=>$name)
       {
           echo CHtml::tag('option',
               array('value'=>$value),CHtml::encode($name),true);
       }
   }

}