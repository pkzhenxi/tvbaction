<?php
$this->breadcrumbs=array(
    SourceModule::t('Data Mange'),
);
$this->menu=array(
    array('label'=>SourceModule::t('Create Data'),'icon' => 'plus','url'=>array('create')),
);
?>
<?php  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/common.js',CClientScript::POS_END);?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h5>数据修改</h5>
</div>

<div class="modal-body">
    <p>One fine body...</p>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'保存',
        'url'=>'#',
        'htmlOptions'=>array('id'=>'savestate'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'取消',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("a[data-target=#myModal]").click(function(ev) {
            ev.preventDefault();
            var target = $(this).attr("href");
            // load the url and show modal on success
            $("#myModal .modal-body").load(target, function() {
                $("#myModal").modal("show");
            });
        });
        $('.modal').on('hidden', function() { $(this).removeData(); });
        $('#savestate').click(
            function(ev){
              var act = $("#act").val();
              if(act == 'state'){
                  var state = $("#Data_state").val();
                  var id = $("#Data_id").val();
                  $.ajax({
                     url : "<?php echo $this->createUrl('savestate');?>",
                     type : 'GET',
                     data : 'id=' + id + '&state='+state,
                     dataType : 'text',
                     async : true,
                     success : function(data){
                        if(data == 'true'){
                           $("#myModal").modal("toggle");
                           $("#state_"+id).text("("+state+"集)");
                        }
                     }
                  });
              }else{
                  var topic = $("#Data_topic").val();
                  var id = $("#Data_id").val();
                  $.ajax({
                      url : "<?php echo $this->createUrl('savetopic');?>",
                      type : 'GET',
                      data : 'id=' + id + '&topic='+topic,
                      dataType : 'text',
                      async : true,
                      success : function(data){
                          $("#myModal").modal("toggle");
                          $("#topic_"+id).html(data);
                      }
                  });
              }
            }
        );
        $("#topicbutton").click(
            function(evt){
                var checkedlen = checkid();
                if(checkedlen == 0){
                   alert('请选择ID！');
                   return false;
                }else{
                   $("#act").val("topic");
                   $("form[name=datasubmit]").submit();
                }
            }
        );
        $("#tidbutton").click(
            function(evt){
                var checkedlen = checkid();
                if(checkedlen == 0){
                    alert('请选择ID！');
                    return false;
                }else{
                    $("#act").val("tid");
                    $("form[name=datasubmit]").submit();
                }
            }
        );
        $("#isunionbutton").click(
            function(evt){
                var checkedlen = checkid();
                if(checkedlen == 0){
                    alert('请选择ID！');
                    return false;
                }else{
                    $("#act").val("isunion");
                    $("form[name=datasubmit]").submit();
                }
            }
        );
        zen.title2div('title2div');
    });

    function checkid(){
        var checked = [];
        $("input[name='data-grid_c0[]']:checked").each(function ()
        {
            checked.push(parseInt($(this).val()));
        });
        return checked.length;
    }
</script>
<?php
echo CHtml::form(array('data/datasubmit'),'post',array('id'=>'form1','name'=>'datasubmit'));
$this->widget('bootstrap.widgets.TbGridView',array(
'selectableRows' => 2,
'id'=>'data-grid',
'ajaxUpdate'=>false,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
        array(
            'class' => 'CCheckBoxColumn',
            'name'=>'id',
        ),
        array(
            'filter'=>false,
            'name'=>'id',
            'header'=>SourceModule::t('id'),
            'htmlOptions'=>array('class'=>'span1'),
        ),
        array(
            'name'=>'name',
            'header'=>SourceModule::t('Name'),
            'value'=>'$data->getnamewithcolor()',
        ),
        array(
            'name'=>'tid',
            'header'=>SourceModule::t('Tid'),
            'htmlOptions'=>array('class'=>'span2'),
            'filter' => Category::allViedoCatergories(),
            'value' => '$data->category->name',
        ),
        array(
            'name'=>'topic',
            'header'=>SourceModule::t('Topic'),
            'filter'=>Topic::FindallToArray(),
            'value'=>'$data->Gettopic()',
            'class'=>'DataColumn',
            'evaluateHtmlOptions'=>true,
            'htmlOptions'=>array('id'=>'"topic_{$data->id}"'),
         ),
        array(
            'name'=>'isunion',
            'filter'=>Data::Setisunion(),
            'header'=>SourceModule::t('Isunion'),
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'data/toggle',
            'name' => 'isunion',
            'checkedIcon'=>'icon-remove',
            'uncheckedIcon'=>'icon-ok',
            'checkedButtonLabel'=>'解锁',
            'uncheckedButtonLabel'=>'锁定',
            'htmlOptions'=>array('style'=>'width: 100px;text-align: center;'),
        ),
        array(
            'name'=>'hit',
            'header'=>SourceModule::t('Hit'),
            'filter'=>false,
        ),
        array(
            'name'=>'commend',
            'header'=>SourceModule::t('Commend'),
            'filter'=>false,
            'type'=>'raw',
            'value'=>'$this->grid->controller->widget(\'ext.starcommend.Starcommend\',
            array(\'ajaxurl\'=>$this->grid->controller->createUrl("data/starajax"),
                  \'input_id\'=>\'\',
                  \'level\' => $data->commend,
                  \'vid\' => $data->id,
                  \'type\' => \'1\',
            ),
            true)',
        ),
        array(
            'name'=>'addtime',
            'header'=>SourceModule::t('Addtime'),
            'filter'=>false,
            'value'=>'F::timetostr($data->addtime)',
        ),
        array(
            'name'=>'updatetime',
            'header'=>SourceModule::t('Updatetime'),
            'filter'=>false,
            'value'=>'F::timetostr($data->updatetime)',
        ),
        array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
),
)); ?>
<table class="table">
   <tr>
     <td style="width: 110px;"><?php echo CHtml::hiddenField('act','0',array('id'=>'act')); ?>
         <a class="btn btn-primary" href="javascript:void();" style="margin-left: 10px;" id="delbutton">删除所选类</a>
     </td>
     <td style="width: 130px;"><?php echo CHtml::dropDownList('topic','',Topic::FindallToArray(),array('empty'=>"请选择专题",'style'=>'width:130px;')) ?></td>
     <td style="width: 110px;"><a class="btn btn-primary" href="javascript:void();" id="topicbutton">批量修改专题</a></td>
     <td style="width: 130px;"><?php echo  CHtml::dropDownList('tid','',Category::allVideoCategoriesDownList(),array('empty'=>"请选择分类",'style'=>'width:130px;','encode'=>false)) ?></td>
     <td style="width: 110px;"><a class="btn btn-primary" href="javascript:void();" id="tidbutton">批量修改分类</a></td>
     <td style="width: 120px;"><a class="btn btn-primary" href="javascript:void();" id="isunionbutton">批量锁定/解锁</a></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
</table>

<?php
echo CHtml::endForm();
?>