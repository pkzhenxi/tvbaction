<?php
$this->breadcrumbs=array(
	UserModule::t('Manage Users'),
);

$this->menu=array(
array('label'=>UserModule::t('Create User'),'icon' => 'plus','url'=>array('create')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'users-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
        array(
           'name'=>'id',
           'header'=>UserModule::t('id'),
        ),
        array(
           'name'=>'username',
           'header'=>UserModule::t('username'),
        ),
        array(
           'name'=>'email',
           'header'=>UserModule::t('email'),
        ),
        array(
           'name'=>'activkey',
           'header'=>UserModule::t('activkey'),
        ),
        array(
            'name'=>'superuser',
            'filter'=>Users::isSuperUser(),
            'header'=>UserModule::t('superuser'),
            'value'=>'$data->getSuperUserlabel()',
            'htmlOptions'=>array('class'=>'span2'),
        ),
        array(
            'name'=>'status',
            'filter'=>Users::userStatus(),
            'header'=>UserModule::t('status'),
            'value'=>'$data->getUserStatus()',
            'htmlOptions'=>array('class'=>'span2'),
        ),
        array(
            'name'=>'create_at',
            'filter'=>false,
            'header'=>UserModule::t('create_at'),
            'value'=>'F::timetostr($data->create_at)',
        ),
        array(
            'name'=>'lastvisit_at',
            'filter'=>false,
            'header'=>UserModule::t('lastvisit_at'),
            'value'=>'F::timetostr($data->lastvisit_at)',
        ),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
