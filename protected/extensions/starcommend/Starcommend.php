<?php
/*
 * 星级推荐插件
 */
class Starcommend extends CWidget{

    private $assetsDir;
    private $id;
    public $num;
    public $ajaxurl;
    public $input_id;
    public $level = 0;
    public $vid = 0;
    public $type = 0;
    public function init(){
        $this->id = uniqid();
        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);
        $this->register();
        Yii::app()->clientScript->registerScript(
            'script'.$this->id,
            "starView($this->level,$this->vid,\"$this->assetsDir\",$this->type,\"$this->ajaxurl\",\"$this->input_id\");",
            CClientScript::POS_READY
        );

    }

    public function run(){
        echo "<span id='star".$this->vid."'>123</span>";
    }

    public function register($rtl=false){
        $this->registerScripts($rtl);
    }

    public function registerScripts($rtl){
        Yii::app()->clientScript->registerScriptFile($this->assetsDir.'/js/commend.js',CClientScript::POS_HEAD);
    }

}
?>