<?php
$this->breadcrumbs=array(
    SourceModule::t('Update Comment'),
);
?>

<h1>查看评论</h1>

<?php
echo $model->msg;
/*$this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'uid',
		'v_id',
		'typeid',
		'username',
		'ip',
		'ischeck',
		'dtime',
		'msg',
		'm_type',
		'reply',
		'agree',
		'anti',
		'pic',
		'vote',
),
)); */?>
