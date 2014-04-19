<?php
$this->breadcrumbs=array(
	UserModule::t('Admin List'),
);
$this->menu=array(
array('label'=>UserModule::t('Create Admin'),'icon' => 'plus','url'=>array('create')),
);
?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'admin-grid',
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
          'name'=>'add_time',
          'filter'=>false,
          'header'=>UserModule::t('add_time'),
          'value'=>'F::timetostr($data->add_time)',
        ),
        array(
          'name'=>'update_time',
          'filter'=>false,
          'header'=>UserModule::t('update_time'),
          'value'=>'F::timetostr($data->update_time)',
        ),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
