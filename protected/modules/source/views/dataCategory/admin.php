<?php
$this->breadcrumbs=array(
	SourceModule::t('Category Mange'),
);
$this->menu=array(
array('label'=>SourceModule::t('Create Category'),'icon' => 'plus','url'=>array('create')),
);
?>
<script type="text/javascript">
    $(document).ready(
        function(){
            $('#chkAll').click(function()
            {
                $("#form1 :checkbox").attr('checked',$("#chkAll").is(':checked'));
            });
            $("#alterbutton").click(function(){
                if(confirm("真的要修改所选类吗？")){
                   $("#operation").val("edit");
                   $("form[name=categoryform]").submit();
                }
            });
            $("#delbutton").click(function(){
                if(confirm("真的要删除所选类吗？")){
                   $("#operation").val("delete");
                    $("form[name=categoryform]").submit();
                }
            });
        }
    );
</script>
<?php
 echo CHtml::form('categorySubmit','post',array('id'=>'form1','name'=>'categoryform'));
?>
<table class="table">
   <tr><th><?php echo CHtml::checkBox('categoryid',false,array('id'=>'chkAll','style'=>"margin:0px;")) ?>&nbsp;类别名称</th><th></th><th>标题</th><th>关键字</th><th>描述</th><th>操作</th></tr>
<?php
$category = Category::model()->findByPk(1);
$descendants=$category->descendants()->findAll(array('order'=>'lft'));
foreach($descendants as $value){
   echo '<tr>';
   $checkbox = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$value->level-1).CHtml::checkBox('id[]',false,array('style'=>"margin:0px;",'value'=>$value->id));
   echo "<td style='vertical-align: middle;'>$checkbox&nbsp;$value->name</td>";
   $ninput = CHtml::textField('name_'.$value->id,$value->name,array('style'=>'margin-bottom:0px;width:180px;'));
   echo "<td>{$ninput}</td>";
   $tinput = CHtml::textField('title_'.$value->id,$value->title,array("style"=>'margin-bottom:0px;width:180px;'));
   echo "<td>{$tinput}</td>";
   $kinput = CHtml::textField('keyword_'.$value->id,$value->keyword,array("style"=>'margin-bottom:0px;width:180px;'));
   echo "<td>{$kinput}</td>";
   $dinput = CHtml::textField('description_'.$value->id,$value->description,array("style"=>'margin-bottom:0px;width:180px;'));
   echo "<td>{$dinput}</td>";
   $muurl = CHtml::link('<i class="icon-arrow-up"></i>',array('move','id'=>$value->id,'action'=>'up'),array('title'=>'向上移动','style'=>'text-decoration: none;'));
   echo "<td>$muurl&nbsp;&nbsp;";
   $mdurl = CHtml::link('<i class="icon-arrow-down"></i>',array('move','id'=>$value->id,'action'=>'down'),array('title'=>'向下移动','style'=>'text-decoration: none;'));
   echo "$mdurl&nbsp;&nbsp;";
   $updateurl = CHtml::link('<i class="icon-pencil"></i>',array('update','id'=>$value->id),array('title'=>'修改','style'=>'text-decoration: none;'));
   echo "$updateurl&nbsp;&nbsp;";
   $delurl = CHtml::link('<i class="icon-trash"></i>','#',array('title'=>'删除','style'=>'text-decoration: none;','submit'=>array('delete','id'=>$value->id),'confirm'=>"确定删除吗？"));
   echo "$delurl&nbsp;&nbsp;</td>";
   echo '</tr>';
}
?>
</table>
<div class="btn-toolbar">
    <div class="btn-group">
        <?php echo CHtml::hiddenField('operation','0',array('id'=>'operation')); ?>
        <a class="btn btn-primary" href="javascript:void();" id="alterbutton">修改所选类</a>
        <a class="btn btn-primary" href="javascript:void();" style="margin-left: 10px;" id="delbutton">删除所选类</a>
    </div>
</div>
<?php
 echo CHtml::endForm();
?>
