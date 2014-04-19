<?php
$this->pageTitle=Yii::app()->name . ' - 邮件发送设置';
$this->breadcrumbs=array(
    '邮件设置',
);
?>
<?php
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array(
                'label' => '设置',
                'content' => $this->renderPartial('_mailsetform',array('model'=>$model),true),
                'active' => true
            ),
            array('label' => '测试', 'content' => $this->renderPartial('_mailtestform',array(),true)),
        ),
    )
);
?>