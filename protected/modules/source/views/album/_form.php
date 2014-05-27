<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'album-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('name'=>'albumform'),
)); ?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
));
?>
<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-block alert-error')); ?>
<table id="datatable">
    <tr>
        <td class="wid100"><?php echo $form->labelEx($model,'name'); ?></td>
        <td><?php echo $form->textField($model,'name'); ?></td>
    </tr>
    <tr>
        <td class="wid100"><?php echo $form->labelEx($model,'vid'); ?></td>
        <td>
            <?php
                echo $form->hiddenField($model,'vid');
                echo CHtml::textField('v_label',($model->isNewRecord ? '' : $model->vdata->name),array('id'=>'v_label_id','style'=>'margin-right:10px;'));
                $this->widget("bootstrap.widgets.TbButton",array(
                     'buttonType'=>'ajaxButton',
                     'htmlOptions'=>array('style'=>'margin-bottom:10px;'),
                     'type'=>'GET',
                     'label'=>'选择视频',
                     'url'=>array('album/menulinkageinit'),
                     'ajaxOptions'=>array(
                         'update'=>'#menulink',
                     ),
                ));
            ?>
            <span id="menulink"></span>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'picture'); ?></td>
        <td>
            <table class="pictable">
                <tr>
                    <td><?php echo $form->textField($model,'picture'); ?></td>
                    <td style="padding: 0px 0px 5px 5px;" ><?php
                            $this->widget('ext.swfupload.SWFUpload',array(
                                'callbackJS'=>'swfupload_callback',
                                'fileTypes'=> '*.jpg;*.jpeg',
                                'buttonText'=> '请选择jpg图片上传',
                                'imgUrlList'=> (!$model->isNewRecord && !empty($model->picture)) ? array(Yii::app()->baseUrl."/upload/".$model->picture) : array(),
                            ));
                        ?>
                        <script type="text/javascript">
                            function swfupload_callback(name,dir)
                            {
                                var v = dir+'/'+name;
                                $("#Album_picture").val(v);
                                $("#thumbnails_1").html("<img src='"+"<?php echo Yii::app()->baseUrl; ?>/upload/"+v+"?"+(new Date()).getTime()+"' />");
                            }
                        </script>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'recommend'); ?></td>
        <td>
            <?php
            $this->widget('ext.starcommend.Starcommend',array(
                'ajaxurl'=>'',
                'input_id'=>'Album_recommend',
                'level' => !$model->isNewRecord ? $model->recommend : '0',
                'vid' => !$model->isNewRecord ? $model->id : '0',
                'type' => '0',
            ));
            ?>
            <?php echo $form->hiddenField($model,'recommend'); ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'company'); ?></td>
        <td><?php echo $form->textField($model,'company'); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'pubtime'); ?></td>
        <td><?php echo $form->textField($model,'pubtime'); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'language'); ?></td>
        <td><?php echo $form->textField($model,'language',array('style'=>'width:50px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'sort'); ?></td>
        <td><?php echo $form->textField($model,'sort',array('style'=>'width:50px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'hit'); ?></td>
        <td><?php echo $form->textField($model,'hit',array('style'=>'width:50px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'ischeck'); ?></td>
        <td><?php echo $form->dropDownList($model,'ischeck',Album::getCheckdownlist(),array('options'=>array('1'=>array('selected'=>true)))); ?></td>
    </tr>
    <tr>
        <?php $this->widget('ext.kindeditor.KindEditorWidget',array(
            'id'=>'Album_introduction',	//Textarea id
            // Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
            'items' => array(
                'width'=>'700px',
                'height'=>'300px',
                'themeType'=>'simple',
                'allowImageUpload'=>true,
                'allowFileManager'=>true,
                'items'=>array(
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
                    'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
                    'justifyright', 'insertorderedlist','insertunorderedlist', '|',
                    'emoticons', 'image', 'link',),
            ),
        )); ?>
        <td><?php echo $form->labelEx($model,'introduction'); ?></td>
        <td class="bottomadding10"><?php echo $form->textArea($model,'introduction',array('visibility'=>'hidden')); ?></td>
    </tr>
</table>
<div class="form-actions">
   <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? '添加' : '保存',
   )); ?>
</div>

<?php $this->endWidget(); ?>