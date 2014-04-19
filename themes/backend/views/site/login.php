<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'htmlOptions'=>array('class'=>'well'),
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<p class="note">注意：带 <span class="required">*</span> 项目为必填.</p>
<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>
<?php
   if($iscaptha){
      echo $form->textFieldRow($model,'verifyCode',array('class'=>'span1'));
      $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'skin'=>false,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer')));
   }
?>

<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>'Login')); ?>
<?php $this->endWidget(); ?>