<?php
$this->breadcrumbs=array(
	'Datas',
);

$this->menu=array(
array('label'=>'Create Data','url'=>array('create')),
array('label'=>'Manage Data','url'=>array('admin')),
);
?>

<h1>Datas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
