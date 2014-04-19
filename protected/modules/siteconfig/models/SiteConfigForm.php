<?php
/*
 * 基本设置表单
 */
class SiteConfigForm extends CFormModel{
    public $siteTitle;//网站标题
    public $isCommentCaptcha;//评论水印
    public $isAdminCapthca;//管理员水印
    public $aboutUs;//关于我们
    public $adminEmaill;//管理员邮箱
    public $adminQQ;//联系方式
    public $copyRight;//版权
    public $tongJi;//统计代码
    public $siteKeywords;//网站关键字

    public function rules(){
        return array(
            array('siteTitle, isCommentCaptcha,isAdminCapthca,aboutUs,adminEmaill,adminQQ,copyRight,tongJi,siteKeywords', 'safe'),
        );
    }

    public function attributeLabels(){
        return array(
            'siteTitle' => '网站标题：',
            'isCommentCaptcha' => '评论水印：',
            'isAdminCapthca' => '管理员登录水印：',
            'aboutUs' => '网站介绍：',
            'adminEmaill' => '管理员邮箱：',
            'adminQQ' => '联系方式：',
            'copyRight' => '版权：',
            'tongJi' => '统计代码：',
            'siteKeywords' => '网站关键字',
        );
    }

    //是否开启验证码
    public function radioCapthcaList(){
        return array(
            '1'=> '开启',
            '0'=> '不开启',
        );
    }

}