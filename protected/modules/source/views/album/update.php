<?php
$this->breadcrumbs=array(
    SourceModule::t('Album Update'),
);

$this->menu=array(
    array('label'=>SourceModule::t('Create Album'),'icon' => 'plus','url'=>array('create')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>