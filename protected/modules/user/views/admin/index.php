<?php
$this->breadcrumbs=array(
	'Admins',
);

$this->menu=array(
array('label'=>'创建管理员','url'=>array('create')),
array('label'=>'Manage Admin','url'=>array('admin')),
);
?>

<h1>Admins</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
