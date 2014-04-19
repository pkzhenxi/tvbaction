<?php echo CHtml::beginForm('sendmail','POST',array('class'=>'form-horizontal'));?>
<div class="control-group">
  <label class="control-label" for="inputSender">测试发件人：<span class="required">*</span></label>
  <div class="controls">
      <?php echo CHtml::textField('sender','pkzhenxi@126.com',array('class'=>"span3")); ?>
  </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputReceiver">测试收件人：<span class="required">*</span></label>
    <div class="controls">
            <?php echo CHtml::textField('receiver','zen.zheng@dyxnet.com',array('class'=>"span3")); ?>
    </div>
</div>
<div class="control-group">
  <div class="controls">
      <?php echo CHtml::ajaxButton('发送邮件','sendmail',
          array(
             'type' => 'POST',
             'beforeSend' => 'function(){
                 if($("#sender").val() == "" || $("#receiver").val() == ""){alert("发送人或收件人不能为空！");return false;}
             }',
             'error' => 'function(data){
                 alert("Error status:" + data.status);
             }',
             'success' => 'function(html){
                 alert(html);
             }',
         ),
         array('class'=>"btn btn-primary")
      )?>
  </div>
 </div>
<?php echo CHtml::endForm();?>