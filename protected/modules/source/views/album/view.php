<?php
$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Album','url'=>array('index')),
array('label'=>'Create Album','url'=>array('create')),
array('label'=>'Update Album','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Album','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Album','url'=>array('admin')),
);
?>

<h1>View Album #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'sort',
		'name',
		'vid',
		'artist',
		'company',
		'language',
		'introduction',
		'picture',
		'pubtime',
		'recommend',
		'hit',
		'good',
		'time',
		'check',
),
)); ?>
