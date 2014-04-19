<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'sitemail-form',
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
)); ?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'smtpServer',$htmlOptions=array('class'=>'span3')); ?>
<?php echo $form->toggleButtonRow($model, 'smtpAuth'); ?>
<?php echo $form->textFieldRow($model,'smtpUsername',$htmlOptions=array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'smtpPassword',$htmlOptions=array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'smtpFrom',$htmlOptions=array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'smtpFromName',$htmlOptions=array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model,'smtpPort',$htmlOptions=array('class'=>'span1')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'提交')); ?>
</div>
<?php $this->endWidget(); ?>
