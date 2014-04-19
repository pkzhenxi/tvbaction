<?php
$this->breadcrumbs=array(
	UserModule::t('Admin List')=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
	array('label'=>UserModule::t('Create Admin'),'icon' => 'plus','url'=>array('create')),
);
?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>