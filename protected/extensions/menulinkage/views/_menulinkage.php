<?php
$data = Data::model()->findAll(array(
    'distinct'=>true,
    'select'=>'letter',
    'order'=>'letter asc',
));
$data= CHtml::listData($data,'letter','letter');
echo CHtml::dropDownList('letter','', $data,
    array(
        'empty'=>'请选择字母',
        'ajax' => array(
            'type'=>'POST', //request type
            'url'=>Yii::app()->createUrl('/source/album/menulinkage'),
            'update'=>'#vid', //selector to update
            'data'=>array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken(),'letter'=>'js:jQuery("#letter").val()'),
            //leave out the data key to pass all form values through
        )
    )
);
//empty since it will be filled by the other dropdown
echo CHtml::dropDownList('vid','', array(),array('style'=>'margin:0px 10px 10px 10px;',
    'onchange'=>"if(this.value != 0){
            jQuery('#v_label_id').val(jQuery('#vid option:selected').text());
            jQuery('#Album_vid').val(jQuery('#vid').val());
         }else{
            jQuery('#v_label_id').val('');
            jQuery('#Album_vid').val('');
         };",
    )
);
echo CHtml::hiddenField('Album[vid]','',array('id'=>'Album_vid'));
echo CHtml::textField('v_label','',array('id'=>'v_label_id'));
?>