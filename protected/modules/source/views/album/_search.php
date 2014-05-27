<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'sort',array('class'=>'span5','maxlength'=>5)); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'vid',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'artist',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'company',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'language',array('class'=>'span5','maxlength'=>15)); ?>

		<?php echo $form->textAreaRow($model,'introduction',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textAreaRow($model,'picture',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'pubtime',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'recommend',array('class'=>'span5','maxlength'=>1)); ?>

		<?php echo $form->textFieldRow($model,'hit',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'good',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'time',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'check',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
