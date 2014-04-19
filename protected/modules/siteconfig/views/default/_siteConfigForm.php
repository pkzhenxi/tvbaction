<?php
$this->pageTitle=Yii::app()->name . ' - SiteLogin';
$this->breadcrumbs=array(
    '网站基本配置',
);
?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'siteconfig-form',
    'type' => 'horizontal',
));
?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
)); ?>
<?php echo $form->textFieldRow($model, 'siteTitle',array('class' => 'span3')); ?>
<?php echo $form->radioButtonListInlineRow($model,'isCommentCaptcha',$model->radioCapthcaList());?>
<?php echo $form->radioButtonListInlineRow($model,'isAdminCapthca',$model->radioCapthcaList());?>
<?php echo $form->textFieldRow($model,'siteKeywords',array('class' => 'span6')); ?>
<?php echo $form->textAreaRow($model,'aboutUs',array('class'=>'span6', 'rows'=>5));?>
<?php echo $form->textFieldRow($model,'adminEmaill',array('class'=>'span3'));?>
<?php echo $form->textFieldRow($model,'adminQQ',array('class'=>'span3','hint'=>'以逗号隔开'));?>
<?php echo $form->textAreaRow($model,'copyRight',array('class'=>'span6', 'rows'=>5));?>
<?php echo $form->textAreaRow($model,'tongJi',array('class'=>'span6', 'rows'=>5));?>
<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'primary',
    'label'=>'提交'));
?>
</div>
<?php $this->endWidget(); ?>