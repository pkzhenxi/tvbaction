<?php
$this->pageTitle=Yii::app()->name . ' - IP过滤设置';
$this->breadcrumbs=array(
    'IP过滤设置',
);
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'siteipfilter-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
));
?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
));
?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textAreaRow($model,'ipFilters',array(
    'class'=>'span5',
    'rows'=>6,
    'data-toggle'=>'popover',
    'data-placement'=>'right',
    'data-html'=>'true',
    'data-trigger'=>'focus',
    'data-content'=>'<small><span class="label label-important">谨慎</span> 输入要过滤的IP地址,已分号分割。</small> <br>本机地址：'.Yii::app()->request->userHostAddress)
);  ?>
<div class="form-actions">
     <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'提交')); ?>
</div>

<?php $this->endWidget(); ?>