<?php
$this->breadcrumbs=array(
	'Datas'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Data','url'=>array('index')),
	array('label'=>'Create Data','url'=>array('create')),
	array('label'=>'View Data','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Data','url'=>array('admin')),
	);
	?>

	<h1>Update Data <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>