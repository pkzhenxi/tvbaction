<?php
/*
 * 初始化联动菜单
 */
class InitdroplistmenuAction extends CAction{

    public function run(){
        $this->init();
        //只能别名路径?
        $this->getController()->renderPartial('ext.menulinkage.views._menulinkage',array(), false, true);
        /*$this->getController()->createWidget('ext.menulinkage.Menulinkage',array(
            'ajaxaction'=>$this->ajaxaction,
            'parent_id'=>$this->parent_id,
            'child_id'=>$this->child_id,
            'modelname'=>$this->modelname,
            'field'=>$this->field,
        ))->run();*/
    }

    public function init(){
        /*if(empty($this->modelname)||!class_exists($this->modelname)||empty($this->field)){
            throw new Exception('模型类或者字段没有配置正确');
        }*/
    }

}