<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'comment-form',
    'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>20)); ?>

    <div class="control-group ">
        <label class="control-label" for="Comment_ip"><?php echo $form->labelEx($model,'ip'); ?></label>
        <div class="controls" style="padding: 5px;"><?php echo $model->ip;?></div>
    </div>

    <div class="control-group ">
        <label class="control-label" for="Comment_dtime"><?php echo $form->labelEx($model,'dtime'); ?></label>
        <div class="controls" style="padding: 5px;"><?php echo F::timetostr($model->dtime);?></div>
    </div>

	<?php echo $form->textAreaRow($model,'msg',array('rows'=>6, 'cols'=>50, 'class'=>'span8',
        'data-toggle'=>'popover',
        'data-placement'=>'right',
        'data-html'=>'true',
        'data-trigger'=>'focus',
        'data-content'=>'<span class="label label-important">注意</span>更改的评论内容HTML代码不会被屏蔽，可用HTML语法编辑。')); ?>

    <?php echo $form->textAreaRow($model,'adminReply',array('rows'=>6, 'cols'=>50, 'class'=>'span8',
        'data-toggle'=>'popover',
        'data-placement'=>'right',
        'data-html'=>'true',
        'data-trigger'=>'focus',
        'data-content'=>'<span class="label label-important">注意</span>回复内容的HTML代码会被屏蔽。'));
    ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
