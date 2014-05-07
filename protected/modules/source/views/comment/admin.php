<?php
$this->breadcrumbs=array(
    SourceModule::t('Comment Mange'),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'comment-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
        array(
            'name'=>'id',
            'filter'=>false,
        ),
        array(
            'name'=>'msg',
            'header'=>SourceModule::t('Msg'),
            'value'=>'$data->cutmsg()',
        ),
        array(
            'name'=>'v_id',
            'header'=>SourceModule::t('V_id'),
            'filter'=>false,
            'value'=>'$data->vdata->name',
        ),
        array(
           'name'=>'ip',
           'header'=>SourceModule::t('Ip'),
           'filter'=>false,
        ),
        array(
            'name'=>'dtime',
            'header'=>SourceModule::t('Dtime'),
            'filter'=>false,
            'value'=>'F::timetostr($data->dtime)',
        ),
        array(
            'name'=>'username',
            'filter'=>false,
            'header'=>SourceModule::t('Username'),
        ),
        array(
            'name'=>'ischeck',
            'filter'=>Comment::setIscheck(),
            'header'=>SourceModule::t('Ischeck'),
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'comment/toggle',
            'checkedIcon'=>'icon-ok',
            'uncheckedIcon'=>'icon-remove',
            'checkedButtonLabel'=>'审核',
            'uncheckedButtonLabel'=>'未审核',
            'htmlOptions'=>array('style'=>'width: 100px;text-align: center;'),
        ),
		/*
		'typeid',
		'uid',
		'ischeck',
		'm_type',
		'reply',
		'agree',
		'anti',
		'pic',
		'vote',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
