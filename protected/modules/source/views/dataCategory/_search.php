<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'root',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'lft',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'rgt',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'level',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'pic',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'position',array('class'=>'span5','maxlength'=>45)); ?>

		<?php echo $form->textFieldRow($model,'isshow',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'keyword',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
