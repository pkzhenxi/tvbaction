<?php
class SiteMailForm extends CFormModel{
   public $smtpServer;
   public $smtpAuth = true;
   public $smtpUsername;
   public $smtpPassword;
   public $smtpFrom;
   public $smtpFromName;
   public $smtpPort = 25;

   public function rules(){
       return array(
           array('smtpServer,smtpAuth,smtpUsername,smtpPassword,smtpFrom,smtpFromName,smtpPort','required'),
           array('smtpAuth','boolean'),
           array('smtpPort','numerical','integerOnly'=>true),
           array('smtpFrom','email'),
       );
   }

    public function attributeLabels()
    {
        return array(
            'smtpServer' => 'SMTP 服务器：',
            'smtpAuth' => '是否验证：',
            'smtpUsername' => 'SMTP 验证用户名：',
            'smtpPassword' => 'SMTP 验证密码：',
            'smtpFrom' => '发信人邮件地址：',
            'smtpFromName' => '发信人名称：',
            'smtpPort' => '端口',
        );
    }

}
?>