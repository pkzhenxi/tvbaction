<?php
/**
 * 支持onBeforUpload和onAfterUpload事件
 * 同SWFUpload Widget一起使用
 * 
 * @author luochong <luochong1987@gmail.com>
 * @version 1.0.2  2010.10.19 14:08 
 */

class SWFUploadAction extends CAction
{
    public $filename='';//文件路径 c:/wamp/www/a.EXT
    public $uploaddir = ''; //文件存放的文件夹
    protected  $callbackJS = '';
    
    public function run()
    {
         $this->init();
	     $filepath = $this->upload();
	     exit();
    }

    public function onAfterUpload($event)
    {
        $this->raiseEvent('onAfterUpload',$event);
    }
    
    public function onBeforeUpload($event)
    {
        $this->raiseEvent('onBeforeUpload',$event);
    }
    
   protected function init()
   {
        if(!isset($_POST['SWFUpload']))
        {
            Yii::app()->getRequest()->redirect(Yii::app ()->homeUrl);
            return ;
        }

        $this->uploaddir = empty($this->uploaddir) ? Yii::app()->basePath.'/../upload/' : trim($this->uploaddir);

        if(!is_dir($this->uploaddir)){
           throw new Exception('文件目录没有指定');
        }

        $this->callbackJS = isset($_POST['callbackJS'])?$_POST['callbackJS']:'';
	    if($this->filename ==='')
	    {
	         throw new Exception('文件路径没有指定');
	    }
	    //删除上一个临时文件
	    /*if(isset($_SESSION['temp_file'])&&is_file($_SESSION['temp_file'])&&(intval($_POST['fileQuenueLimit']) == 1))
        {
            unlink($_SESSION['temp_file']);                     //删除swfupload 的临时文件
        }  */
   }
   
   protected function upload()
   {
         $file = CUploadedFile::getInstanceByName('Filedata'); 
	     
         $this->onBeforeUpload(new CEvent(array('uploadedFile'=>&$file)));

	     $this->filename = str_replace('.EXT','.'.$file->extensionName,$this->filename);

         $filepath =$this->uploaddir.$this->filename;

	     $filepath = str_replace('\\','/',$filepath);

	     $file->saveAs($filepath);
	     $_SESSION['temp_file'] = $filepath;
         $dir = substr(strrchr(dirname($filepath), "/"), 1);
	     echo 'JS:('.$this->callbackJS.")('$this->filename','$dir');";
	     $this->onAfterUpload(new CEvent(array('uploadedFile'=>&$file,'name'=>$this->filename,'path'=>$this->uploaddir)));
	     return $filepath;
   }

}
