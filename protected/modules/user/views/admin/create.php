<?php
$this->breadcrumbs=array(
	UserModule::t('Admin List')=>array('admin'),
	UserModule::t('Create Admin'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create Admin'),'icon' => 'plus','url'=>array('create')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>