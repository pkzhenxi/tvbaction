<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">注：带 <span class="required">*</span> 为必填。</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'username',array('class'=>'span3','maxlength'=>20)); ?>

<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3','maxlength'=>128)); ?>

<?php echo $form->passwordFieldRow($model,'cpassword',array('class'=>'span3','maxlength'=>128)); ?>

<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>128)); ?>

<?php echo $form->textFieldRow($model,'activkey',array('class'=>'span3','maxlength'=>128)); ?>

<?php echo $form->dropDownListRow($model,'status',Users::userStatus(),array('class'=>'span2','options'=>array(($model->isNewRecord ? '1' : $model->status)=>array('selected'=>true)))); ?>

<?php echo $form->dropDownListRow($model,'superuser',Users::isSuperUser(),array('class'=>'span2','options'=>array(($model->isNewRecord ? '0' : $model->superuser)=>array('selected'=>true))) ); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
