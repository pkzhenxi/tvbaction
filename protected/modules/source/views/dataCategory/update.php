<?php
$this->breadcrumbs=array(
    SourceModule::t('Create Category'),
);

$this->menu=array(
    array('label'=>SourceModule::t('Create Category'),'icon' => 'plus','url'=>array('create')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>