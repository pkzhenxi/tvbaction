<?php
$this->breadcrumbs=array(
    SourceModule::t('Create Data'),
);

$this->menu=array(
    array('label'=>SourceModule::t('Create Data'),'icon' => 'plus','url'=>array('create')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>