<?php
$this->breadcrumbs=array(
	$model->id,
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'),'icon' => 'plus','url'=>array('create')),
);
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'username',
		'email',
		'activkey',
        array(
            'name'=>'superuser',
            'value'=>$model->getSuperUserlabel(),
        ),
        array(
            'name'=>'status',
            'value'=>$model->getUserStatus(),
        ),
        array(
            'name'=>'create_at',
            'value'=>F::timetostr($model->create_at),
        ),
        array(
            'name'=>'lastvisit_at',
            'value'=>F::timetostr($model->lastvisit_at),
        ),
),
)); ?>
