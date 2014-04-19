<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'admin-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">注：带 <span class="required">*</span> 为必填。</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span3','maxlength'=>128)); ?>

    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3','maxlength'=>128)); ?>

	<?php
       if(!$model->isNewRecord) echo $form->hiddenField($model,'upassword',array('class'=>'span3','maxlength'=>128));
    ?>
    <?php echo $form->passwordFieldRow($model,'cpassword',array('class'=>'span3','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'profile',array('rows'=>6, 'cols'=>50, 'class'=>'span6')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '创建' : '保存',
		)); ?>
</div>

<?php $this->endWidget(); ?>
