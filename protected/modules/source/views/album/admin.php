<?php
$this->breadcrumbs=array(
    SourceModule::t('Album Manage'),
);

$this->menu=array(
    array('label'=>SourceModule::t('Create Album'),'icon' => 'plus','url'=>array('create')),
);
?>
<?php  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/common.js',CClientScript::POS_END);?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#delbutton").click(
            function(evt){
                var checkedlen = checkid();
                if(checkedlen == 0){
                    alert('请选择ID！');
                    return false;
                }else{
                    if(confirm('是否真的要删除？')){
                       $("form[name=albumsubmit]").submit();
                    }
                }
            }
        );
        zen.title2div('title2div');
    });

    function checkid(){
        var checked = [];
        $("input[name='album-grid_c0[]']:checked").each(function ()
        {
            checked.push(parseInt($(this).val()));
        });
        return checked.length;
    }
</script>
<?php
echo CHtml::form(array('album/albumsubmit'),'post',array('id'=>'form1','name'=>'albumsubmit'));
$this->widget('bootstrap.widgets.TbGridView',array(
'selectableRows' => 2,
'id'=>'album-grid',
'ajaxUpdate'=>false,
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
        array(
            'class' => 'CCheckBoxColumn',
            'name'=>'id',
        ),
        array(
           'name'=>'name',
           'header'=>SourceModule::t('Album Name'),
           'value'=>'$data->getNamewithimage()',
        ),
        array(
            'name'=>'vid',
            'header'=>SourceModule::t('Album Vid'),
            'filter'=>false,
            'value'=>'$data->vdata->name',
        ),
        array(
            'name'=>'recommend',
            'header'=>SourceModule::t('Album Recommend'),
            'filter'=>false,
            'type'=>'raw',
            'value'=>'$this->grid->controller->widget(\'ext.starcommend.Starcommend\',
            array(\'ajaxurl\'=>$this->grid->controller->createUrl("album/starajax"),
                  \'input_id\'=>\'\',
                  \'level\' => $data->recommend,
                  \'vid\' => $data->id,
                  \'type\' => \'1\',
            ),
            true)',
        ),
        array(
            'name'=>'time',
            'header'=>SourceModule::t('Album Time'),
            'filter'=>false,
            'value'=>'empty($data->time) ? \'\' : date(\'Y-m-d\',$data->time)',
        ),
        array(
            'name'=>'ischeck',
            'filter'=>Album::getCheckdownlist(),
            'header'=>SourceModule::t('Ischeck'),
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'album/toggle',
            'checkedIcon'=>'icon-ok',
            'uncheckedIcon'=>'icon-remove',
            'checkedButtonLabel'=>'通过',
            'uncheckedButtonLabel'=>'不通过',
            'htmlOptions'=>array('style'=>'width: 100px;text-align: center;'),
        ),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}&nbsp;&nbsp;{delete}',
),
),
));
?>
<table class="table">
  <tr>
    <td style="width: 110px;"><?php echo CHtml::hiddenField('act','0',array('id'=>'act')); ?>
        <a class="btn btn-primary" href="javascript:void();" style="margin-left: 10px;" id="delbutton">删除所选专辑</a>
    </td>
  </tr>
</table>
<?php
echo CHtml::endForm();
?>