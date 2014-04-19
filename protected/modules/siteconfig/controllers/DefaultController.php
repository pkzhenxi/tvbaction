<?php

class DefaultController extends Controller
{
    public $layout='//layouts/siteconfig';

    public function filters()
    {
        return array(
            array('auth.filters.AuthFilter'),
        );
    }

    public function actionIndex()
	{
        $siteConfigModel = new SiteConfigForm();
        $siteConfigModel->attributes = $this->module->getFromFile('SiteConfigForm');
        if(isset($_POST['SiteConfigForm'])){
            $siteConfigModel->attributes = $_POST['SiteConfigForm'];
            if($siteConfigModel->validate()){
                $this->module->configSumbit($_POST);
            }
        }
        $this->render('_siteConfigForm',array('model'=>$siteConfigModel));
	}

    public function actionSiteRegister(){
        $siteRegisterModel = new SiteRegisterForm();
        $siteRegisterModel->attributes = $this->module->getFromFile('SiteRegisterForm');
        if(isset($_POST['SiteRegisterForm'])){
            $siteRegisterModel->attributes = $_POST['SiteRegisterForm'];
            if($siteRegisterModel->validate()){
                $this->module->configSumbit($_POST);
            }
        }
        $this->render('_siteregisterform',array('model'=>$siteRegisterModel));
    }

    public function actionSiteMail(){
        $siteMailModel = new SiteMailForm();
        $siteMailModel->attributes = $this->module->getFromFile('SiteMailForm');
        if(isset($_POST['SiteMailForm'])){
           $siteMailModel->attributes = $_POST['SiteMailForm'];
           if($siteMailModel->validate()){
              $this->module->configSumbit($_POST);
           }
        }
        $this->render('_sitemailform',array('model'=>$siteMailModel));
    }

    public function actionIpFilter(){
        $siteIpFilterModel = new SiteIpFilterForm();
        $siteIpFilterModel->attributes = $this->module->getFromFile('SiteIpFilterForm');
        if(isset($_POST['SiteIpFilterForm'])){
            $siteIpFilterModel->attributes = $_POST['SiteIpFilterForm'];
            if($siteIpFilterModel->validate()){
                $this->module->configSumbit($_POST);
            }
        }
        $this->render('_siteipfilterform',array('model'=>$siteIpFilterModel));
    }

    /*
     * 测试发邮件
     */
    public function actionSendmail(){
        if(Yii::app()->request->isAjaxRequest){
           $mailconfig = $this->module->getFromFile('SiteMailForm');
           $mail = new YiiMailer();
           $mail->setView('contact');
           $mail->setLayout('mail');
           $mail->setData(array('messages' => '邮件正文内容', 'name' => 'John Doe', 'description' => 'Contact form'));
           $mail->IsSMTP();
           $mail->Host = $mailconfig['smtpServer'];
           $mail->Port = $mailconfig['smtpPort'];
           if($mailconfig['smtpAuth']) $mail->SMTPAuth = true;// Enable SMTP authentication
           $mail->Username = $mailconfig['smtpUsername'];// SMTP username
           $mail->Password = $mailconfig['smtpPassword'];// SMTP password
           $mail->setFrom($_POST['sender'],$mailconfig['smtpFromName']);
           $mail->setSubject("我测试一下下！");
           $mail->setTo($_POST['receiver']);
           if ($mail->send()) {
               echo "发送成功";
           } else {
               echo "发送失败";
           }
           Yii::app()->end();
        }
    }

}