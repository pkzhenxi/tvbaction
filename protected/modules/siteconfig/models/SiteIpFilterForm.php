<?php
class SiteIpFilterForm extends CFormModel{

    public $ipFilters;

    public function rules(){
        return array(
            array('ipFilters','safe'),
        );
    }

    public function attributeLabels(){
        return array(
            'ipFilters' => 'IP地址过滤列表：',
        );
    }

}

?>