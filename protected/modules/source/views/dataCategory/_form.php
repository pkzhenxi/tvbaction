<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">注：带 <span class="required">*</span> 为必填。</p>
<?php
$category=Category::model()->findByPk(1);
$descendants=$category->descendants()->findAll();
$arr = array();
if(isset($descendants) && !empty($category)){
    foreach($descendants as $vaule){
       $name = str_repeat("&nbsp;&nbsp;",$vaule->level).$vaule->name;
       $arr[$name] = $vaule->id;
   }
}
$arr = array_flip(array_merge(array($category->name => $category->id ),$arr));
?>
<?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model,'root',$arr,array('class'=>'span3','encode'=>false)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>10)); ?>

	<?php echo $form->dropDownListRow($model,'isshow',Category::arrIsShow(),array('class'=>'span1','options'=>array(($model->isNewRecord ? '1' : $model->isshow)=>array('selected'=>true)))); ?>

    <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>50)); ?>

    <?php echo $form->textFieldRow($model,'keyword',array('class'=>'span5','maxlength'=>50)); ?>

    <?php echo $form->textAreaRow($model, 'description', array('class'=>'span8', 'rows'=>5)); ?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '添加' : '保存',
		)); ?>
</div>

<?php $this->endWidget(); ?>
