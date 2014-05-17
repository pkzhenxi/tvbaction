<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    protected function beforeAction($action){
        if(parent::beforeAction($action)){
           $ipstr = Yii::app()->getModule('siteconfig')->getFromFile('SiteIpFilterForm');
           $iparr = explode(';',$ipstr['ipFilters']);
           $clientip = Yii::app()->request->userHostAddress;
           foreach($iparr as $ip){
               if($clientip === $ip || $ip === "*" || (($pos=strpos($ip,'*'))!==false && !strncmp($ip,$clientip,$pos))){
                  echo "你已经被限制访问！";
                  return false;
               }
           }
           return true;
        }
    }

    /** 进行裁剪、打水印等其它处理 */
    public function saveFile($event)
    {
        //$event->sender['uploadedFile'] is CUploadedFile
        //$event->sender['uploadedFile']->name; the original name of the file being uploaded
        // $event->sender['name']  yourfilename.EXT
        // do something   ......
        $url = $event->sender['path'].$event->sender['name'];
        if(is_file($url)){
            $pic = new Picture();
            $pic->cut['file'] = $url;
            $pic->cut['width'] = 300;
            $pic->cut['save_name'] = false;
            $pic->cut['height'] = 300;
            $pic->cut() === true or $pic_info = $pics->info;
        }
        /*
         $im = imagecreatefromjpeg($src);
         $textcolor = imagecolorallocate($im, 0, 0, 255);
         imagestring($im, 2, 0, 0, 'lcswfupload onAfterUpload saveFile run', $textcolor);
         imagejpeg($im,$src);
         imagedestroy($im);
        */
        return true;
    }
}