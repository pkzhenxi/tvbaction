<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>UserModule::t('Create Admin'),'icon' => 'plus','url'=>array('create')),
array('label'=>UserModule::t('Update Admin'),'icon' => 'pencil','url'=>array('update','id'=>$model->id)),
array('label'=>UserModule::t('Delete Admin'),'icon' => 'trash','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>UserModule::t('Admin List'),'icon' => 'cog','url'=>array('admin')),
);
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'username',
		'email',
		'profile',
        array(
           'name'=>'add_time',
           'value'=>F::timetostr($model->add_time),
        ),
       array(
        'name'=>'update_time',
        'value'=>F::timetostr($model->update_time),
       ),
),
)); ?>
