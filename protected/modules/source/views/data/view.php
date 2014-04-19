<?php
$this->breadcrumbs=array(
	'Datas'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Data','url'=>array('index')),
array('label'=>'Create Data','url'=>array('create')),
array('label'=>'Update Data','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Data','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Data','url'=>array('admin')),
);
?>

<h1>View Data #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'tid',
		'name',
		'state',
		'pic',
		'hit',
		'money',
		'rank',
		'digg',
		'tread',
		'commend',
		'wrong',
		'ismake',
		'actor',
		'color',
		'publishyear',
		'publisharea',
		'addtime',
		'topic',
		'note',
		'tags',
		'letter',
		'isunion',
		'recycled',
		'director',
		'enname',
		'lang',
		'score',
		'extratype',
),
)); ?>
