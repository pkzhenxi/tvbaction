<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'data-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('name'=>'dataform'),
)); ?>
<?php  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/common.js',CClientScript::POS_END);?>
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
<?php
if($model->isNewRecord) Yii::app()->clientScript->registerScript('script'.$this->id,"tvdata(1,true);",CClientScript::POS_READY);
?>
<table id="datatable">
    <tr>
        <td class="wid"><?php echo $form->labelEx($model,'name'); ?></td>
        <td>
            <table id="datanobottom" >
                <tr>
                    <td><?php echo $form->textField($model,'name',array('class'=>'pic')); ?></td>
                    <td style="padding-left: 5px;">连载？</td>
                    <td>
                        <input type="checkbox" onclick="isViewState()" id="v_statebox" <?php if($model->state>0 && !$model->isNewRecord){ echo "checked"; } ?> />
                        <span id="v_statespan" <?php if($model->state == 0 && !$model->isNewRecord ) echo "style=\"display:none\"" ?> >到第
                        <?php echo $form->textField($model,'state',array("style"=>"width:30px;")); ?>
                        集</span>
                    </td>
                    <td style="padding-left: 5px;">
                        <?php echo $form->dropDownList($model,'color',Data::tColors(),array("empty"=>"标题颜色",'options'=>Data::tColorsOptionBg()));?>
                    </td>
                    <td style="padding-left: 5px;"><?php echo $form->labelEx($model,'tid'); ?></td>
                    <td><?php echo  $form->dropDownList($model,'tid',Category::allVideoCategoriesDownList(),array('empty'=>"请选择分类",'class'=>'span4','encode'=>false)) ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'extratype'); ?></td>
        <td>
            <?php
                $htmloptions = array('class'=>'extratype','encode'=>false,'multiple'=>"multiple");
                if(!$model->isNewRecord && !empty($model->extratype)){
                   $arrExtra = explode(',',$model->extratype);
                   foreach($arrExtra as $value){
                       $selected[$value]=array('selected' => true);
                   }
                   $htmloptions['options']=$selected;
                }
                echo  $form->dropDownList($model,'extratype',Category::allVideoCategoriesDownList(),$htmloptions);
            ?>
            <span class="label label-important">注意</span>扩展分类：请按CTRL多选。
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'pic'); ?></td>
        <td>
            <table class="pictable">
                <tr>
                    <td>
                    <?php echo $form->textField($model,'pic',array('class'=>'pic')); ?> ← <?php
                        $this->widget('zii.widgets.jui.CJuiButton',array(
                            'buttonType'=>'button',
                            'name'=>'clear',
                            'caption'=>'清除',
                            'htmlOptions'=>array('style'=>'margin-bottom:10px;'),
                            'onclick'=>new CJavaScriptExpression('function(){$("#Data_pic").val("");}'),
                        ));
                        ?>
                    </td>
                    <td style="padding: 0px 0px 5px 5px;">
                        <?php
                            $this->widget('ext.swfupload.SWFUpload',array(
                                'callbackJS'=>'swfupload_callback',
                                'fileTypes'=> '*.jpg;*.jpeg',
                                'buttonText'=> '请选择jpg图片上传',
                                'imgUrlList'=> (!$model->isNewRecord && !empty($model->pic)) ? array(Yii::app()->baseUrl."/upload/".$model->pic) : array(),
                            ));
                        ?>
                      <script type="text/javascript">
                            function swfupload_callback(name,dir)
                            {
                                var v = dir+'/'+name;
                                $("#Data_pic").val(v);
                                $("#thumbnails_1").html("<img src='"+"<?php echo Yii::app()->baseUrl; ?>/upload/"+v+"?"+(new Date()).getTime()+"' />");
                            }
                        </script>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'actor'); ?></td>
        <td>
            <table class="pictable">
                <tr>
                    <td><?php echo $form->textField($model,'actor',array('class'=>'pic')); ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'director'); ?></td>
                    <td><?php echo $form->textField($model,'director',array('class'=>'pic')); ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'commend'); ?></td>
                    <td>
                        <?php
                        $this->widget('ext.starcommend.Starcommend',array(
                            'ajaxurl'=>$this->createUrl('data/ajax'),
                            'input_id'=>'Data_commend',
                            'level' => !$model->isNewRecord ? $model->commend : '0',
                            'vid' => !$model->isNewRecord ? $model->id : '0',
                            'type' => '0',
                        ));
                        ?>
                        <?php echo $form->hiddenField($model,'commend'); ?>
                    </td>
                    <td class="leftpadding10"><span class="label label-important">注意</span>主演、导演用逗号或空格隔开</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'note'); ?></td>
        <td>
            <table class="pictable">
                <tr>
                    <td><?php echo $form->textField($model,'note',array('class'=>'pic')); ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'tags'); ?></td>
                    <td><?php echo $form->textField($model,'tags',array('class'=>'pic')); ?></td>
                    <td class="leftpadding10"><span class="label label-important">注意</span>如：高清,无水印 (配合标题一起显示)</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'publishyear'); ?></td>
        <td>
            <table class="pictable">
                <tr>
                    <td><?php echo  $form->dropDownList($model,'publishyear',Data::Publishyear(),array('empty'=>"请选择年份",'class'=>'span4')) ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'lang'); ?></td>
                    <td><?php echo  $form->dropDownList($model,'lang',Data::Lanuage(),array('empty'=>"请选择语言",'class'=>'span4')) ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'publisharea'); ?></td>
                    <td><?php echo  $form->dropDownList($model,'publisharea',Data::Publisharea(),array('empty'=>"请选择区域",'class'=>'span4')) ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'topic'); ?></td>
                    <td><?php echo  $form->dropDownList($model,'topic',Topic::FindallToArray(),array('empty'=>"请选择专题",'class'=>'span4')) ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'hit'); ?></td>
                    <td><?php echo $form->textField($model,'hit',array('class'=>'width50px')); ?></td>
                    <td class="leftpadding10"><?php echo $form->labelEx($model,'letter'); ?></td>
                    <td><?php echo $form->textField($model,'letter',array(
                            'class'=>'width50px',
                            'data-toggle'=>'popover',
                            'data-placement'=>'right',
                            'data-html'=>'true',
                            'data-trigger'=>'focus',
                            'data-content'=>'<span class="label label-important">注意</span>影片名称首个拼音字母.')); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <script type="text/javascript">
        function tvdata(items,isinit)
        {
           var tdata = "";
           for(i=0; i<items; i++){
                tdata += '<table class="pictable" width="100%"><tr><td class="wid">播放来源：</td><td>';
                var str = isinit ? getOptions() : getOptions($("#v_playfrom"+(i+1)).val());
                tdata += "<select id='v_playfrom"+(i+1)+"' name='playfrom[]'><option value=''>暂无数据</option>"+str+"</select>";
                tdata += '<input type="button"  value="WEB采集" class="btn1">';
                if(i == 0){
                  tdata += '数据地址单集格式：<span class="label label-success">标题$ID$来源</span>(如果多集就用行隔开)';
                  tdata += "<img src=\"<?php echo Yii::app()->theme->baseUrl."/images/btn_add.gif" ?>\" onclick=\"tvdata("+(items+1)+",false)\"; class=\"btn2\" title=\"添加播放来源\">";
                  tdata += "<img src=\"<?php echo Yii::app()->theme->baseUrl."/images/btn_dec.gif" ?>\" onclick=\"tvdata("+(items>1?items-1:1)+",false);\" class=\"btn2\" title=\"删除播放来源\">";
                }
                tdata += '</td></tr>';
                tdata += '<tr>';
                tdata += "<td>数据地址：<br><input type='button'  value='校正' onclick='repairUrl("+(i+1)+")'></td>";
                var svalue = ($("#playurl"+(i+1)).val() == undefined) ? '':$("#playurl"+(i+1)).val();
                tdata += "<td><textarea id='playurl"+(i+1)+"' name='playurl[]' rows='8' style='width:695px'>"+svalue+"</textarea></td>";
                tdata += '</tr>';
                tdata += '</table>';
           }
           $('#dataitems').html(tdata);
        }

        function repairUrl(id)
        {
            var urlStr,urlArray,newStr,j,flagCount,selectid;
            selectid = $("#v_playfrom"+id).val();
            if(selectid.length == 0){
               alert('请选择播放来源');
               return false;
            }
            urlStr=$('#playurl'+id).val();
            if (urlStr.length==0){alert('请填写地址');return false;}
            if(navigator.userAgent.indexOf("Firefox")>0){urlArray=urlStr.split("\n");}else{urlArray=urlStr.split("\r\n");}
            newStr="";
            for(j=0;j<urlArray.length;j++){
                if(urlArray[j].length>0){
                    flagCount=urlArray[j].split('$').length-1;
                    switch(flagCount){
                        case 0:
                            urlArray[j]='第'+(j+1)+'集$'+urlArray[j]+'$'+getReferedId(selectid);
                            break;
                        case 1:
                            urlArray[j]=urlArray[j]+'$'+getReferedId(selectid);
                            break;
                        case 2:
                            break;
                    }
                    newStr+=urlArray[j]+"\r\n";
                }
            }
            $('#playurl'+id).val(newStr);
        }

        function getReferedId(str){
            var file = "<?php echo Yii::app()->baseUrl."/data/playerKinds.xml" ?>";
            var  xml  =  loadXML(file);
            var dogNodes = xml.getElementsByTagName("player");
            for (var i = 0; i < dogNodes.length; i++)
            {
                var _postfix = dogNodes[i].attributes[2].value;
                var _flag = dogNodes[i].attributes[3].value;
                if(str.indexOf(_flag)>-1) return _postfix;
            }
            return "";
        }

        function getOptions(flag){
            var file = "<?php echo Yii::app()->baseUrl."/data/playerKinds.xml" ?>";
            var  xml  =  loadXML(file);
            var dogNodes = xml.getElementsByTagName("player");
            var allstr = '';
            for(var i=0;i<dogNodes.length;i++){
                var selected = '';
                var vflag = dogNodes[i].attributes[3].value;
                if(flag == vflag){
                    selected = " selected ";
                }else{
                    selected = "";
                }
                var str = "<option value='"+vflag+"'"+selected+">"+vflag+"</option>";
                allstr = allstr + str;
            }
            return allstr;
        }
    </script>
    <tr>
        <td colspan="2" id="dataitems">
          <?php
            $playdata = $model->playdata->body;
            $playArray = explode("$$$",$playdata);
            $k = count($playArray);
            if($playdata != "" ){
                for($j=0;$j<$k;$j++){
                    $playArray2=explode("$$",$playArray[$j]);
                    $pstr=$playArray2[0];
                    //$purlstr=str_replace(chr(10),"",$playArray2[1]);
                    $purlstr=$playArray2[1];
                    if(strpos($playArray[$j],'$$')===false)
                    {
                        $pstr='';
                        $purlstr=$playArray[$j];
                    }
                    $purlstr=str_replace("#",chr(13),$purlstr);
          ?>
          <table class="pictable" width="100%">
                <tr>
                    <td class="wid">播放来源：</td>
                    <td>
                        <select id="v_playfrom<?php echo $j+1; ?>" name="playfrom[]"><option value="">暂无数据</option><?php echo F::makePlayerSelect($pstr);?></select>
                        <input type="button" value="WEB采集" class="btn1">
                     <?php if ($j == 0){ ?>
                        数据地址单集格式：<span class="label label-success">标题$ID$来源</span>(如果多集就用行隔开)
                        <img src="<?php echo Yii::app()->theme->baseUrl."/images/btn_add.gif" ?>" onclick="tvdata(<?php echo $k+1; ?>,false)" class="btn2" title="添加播放来源">
                        <img src="<?php echo Yii::app()->theme->baseUrl."/images/btn_dec.gif" ?>" onclick=" tvdata(<?php echo $k-1; ?>,false);" class="btn2" title="删除播放来源">
                      <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>数据地址：<br><input type="button" value="校正" onclick="repairUrl(<?php echo $j+1; ?>)"></td>
                    <td><textarea id="playurl<?php echo $j+1; ?>" name="playurl[]" rows="8" style="width:695px"><?php echo $purlstr; ?></textarea></td>
                </tr>
          </table>
          <?php
                }
            }
          ?>
        </td>
    </tr>
    <?php $this->widget('ext.kindeditor.KindEditorWidget',array(
        'id'=>'tv_content',	//Textarea id
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
    <tr>
        <td>影片介绍：</td>
        <td class="bottomadding10"><?php echo CHtml::textArea('content',$model->datacontent->body,array('visibility'=>'hidden','id'=>'tv_content'))?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td class="bottomadding10">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? '添加' : '保存',
              )); ?>
        </td>
    </tr>

</table>
<?php $this->endWidget(); ?>