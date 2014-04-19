<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>20)); ?>

			<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'activkey',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'superuser',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'create_at',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lastvisit_at',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
