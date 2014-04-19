<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-form',
	'enableAjaxValidation'=>false,
    'type'=>'horizontal',
)); ?>
<p class="help-block">添加视频数据(<span class="required">*</span>为必填,其它选填)</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'tid',array('class'=>'span5','maxlength'=>8)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>60)); ?>

	<?php echo $form->textFieldRow($model,'state',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'pic',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'hit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'money',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'rank',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'digg',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'tread',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'commend',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'wrong',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ismake',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'actor',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'color',array('class'=>'span5','maxlength'=>7)); ?>

	<?php echo $form->textFieldRow($model,'publishyear',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'publisharea',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'addtime',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'topic',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'note',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'tags',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'letter',array('class'=>'span5','maxlength'=>3)); ?>

	<?php echo $form->textFieldRow($model,'isunion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'recycled',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'director',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'enname',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'lang',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'score',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textAreaRow($model,'extratype',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
