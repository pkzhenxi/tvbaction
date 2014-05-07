<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'uid',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'v_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'typeid',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'ip',array('class'=>'span5','maxlength'=>15)); ?>

		<?php echo $form->textFieldRow($model,'ischeck',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'dtime',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textAreaRow($model,'msg',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'m_type',array('class'=>'span5','maxlength'=>6)); ?>

		<?php echo $form->textFieldRow($model,'reply',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'agree',array('class'=>'span5','maxlength'=>6)); ?>

		<?php echo $form->textFieldRow($model,'anti',array('class'=>'span5','maxlength'=>6)); ?>

		<?php echo $form->textFieldRow($model,'pic',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'vote',array('class'=>'span5','maxlength'=>6)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
