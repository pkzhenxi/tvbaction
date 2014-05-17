<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-5-10
 * Time: 下午9:06
 * 二级联动菜单插件 这个已暂时无用，不删除，留作参考
 */
Class Menulinkage extends CWidget{

    public $ajaxaction; //ajax url

    public $child_id = 'child_id';

    public $parent_id = 'parent_id';

    public $ajaxtype = 'POST';

    public $modelname; //model name

    public $field; //downlist option value filed

    public $id;


    public function init(){

         if(!isset($this->modelname) || !isset($this->ajaxaction)){
             throw new CHttpException(400,'参数设置错误!');
         }

       /* Yii::app()->clientScript->registerScript(
            'script'.$this->id,
            "test()",
            CClientScript::POS_READY
        );*/

    }

    public function run(){

        //get data
        $finder = CActiveRecord::model($this->modelname);
        $criteria=$finder->getDbCriteria()->mergeWith(array(
             'distinct'=>true,
             'select'=>$this->field,
             'order'=>$this->field.' asc ',
        ));
        $vdata = $finder->findAll();
        $data = array();
        foreach($vdata as $v){
            $filed = $this->field;
            $data[$v->$filed] = $v->$filed;
        }
        echo CHtml::dropDownList($this->parent_id,'', $data,
            array(
                'ajax' => array(
                    'type'=>$this->ajaxtype, //request type
                    'url'=>'Yii::app()->controller->createUrl("' . $this->ajaxaction . '")',
                    'update'=>'#'.$this->child_id, //selector to update
                    'data'=>array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken(),$this->parent_id=>'js $("#'.$this->parent_id.'").val()')
                    //leave out the data key to pass all form values through
        )));

        //empty since it will be filled by the other dropdown
        echo CHtml::dropDownList($this->child_id,'', array());
    }


}

