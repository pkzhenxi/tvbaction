<?php
$this->breadcrumbs=array(
	UserModule::t('Create User')
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'),'icon' => 'plus','url'=>array('create')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>