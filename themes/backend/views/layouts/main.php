<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php  Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/styles.css');?>
</head>

<body screen_capture_injected="true">

<?php
$this->widget('bootstrap.widgets.TbNavbar', array(
    'type' => 'inverse', // null or 'inverse'
    'brand' => '后台管理',
    'brandUrl' => Yii::app()->createUrl('/'),
    'collapse' => true, // requires bootstrap-responsive.css
    'fluid' => true,
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => array(
                array('label' => '控制面板', 'url' => array('/'), 'icon' => 'th' ,'visible'=>!Yii::app()->user->isGuest),
                array('label' => '资源管理', 'url' => '#','icon' => 'play-circle' , 'items' => array(
                    //array('label' => 'ITEM'),
                    array('label' => '视频分类', 'url' => array('/source/dataCategory/admin')),
                    array('label' => '视频管理', 'url' => array('/source/data/admin')),
                    array('label' => '推荐视频', 'url' => array('/source/data/commend')),
                    array('label' => '视频评论', 'url' => array('/source/vcomment/admin')),
                    '---',
                    array('label' => '专辑管理', 'url' => array('/source/album/admin')),
                    array('label' => '曲目管理', 'url' => array('/source/music/admin')),
                    '---',
                    array('label' => '专题管理', 'url' => array('/source/topic/admin')),
                ), 'visible' => !Yii::app()->user->isGuest),
                array('label'=>'内容管理','url'=>'#','icon' => 'file', 'items'=>array(
                    array('label' => '新闻分类','url' => array('/cms/newsCategory/admin')),
                    array('label' => '新闻管理','url' => array('/cms/news/admin')),
                    '---',
                    array('label' => '广告管理','url' => array('/cms/ad/admin')),
                    array('label' => '友情链接','url' => array('/cms/flink/admin')),
                    array('label' => '留言管理','url' => array('/cms/feedback/admin')),
                ),'visible'=>!Yii::app()->user->isGuest),
                array('label' => '艺人管理','url' => '#','icon' => 'star','items' => array(
                    array('label' => '艺人管理','url' => array('/artist/artist/admin')),
                    array('label' => '相册管理','url' => array('/artist/image/admin')),
                    array('label' => '评论管理','url' => array('/artist/comment/admin')),
                ),'visible'=>!Yii::app()->user->isGuest),
                array('label' => '用户控制', 'url' => '#', 'icon' => 'user' ,'items' => array(
                    array('label' => '会员列表', 'url' => array('/user/users/admin')),
                    array('label' => '管理员列表', 'url' => array('/user/admin/admin')),
                    array('label' => '权限管理', 'url' => array('/auth/assignment/index')),
                ), 'visible' => !Yii::app()->user->isGuest),
                array('label' => '数据库管理','url'=>'#', 'icon' => 'globe' ,'items' =>array(
                    array('label' => '数据库备份','url' => array('/database/backup/admin')),
                ),'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'htmlOptions' => array('class' => 'pull-right'),
            'items' => array(
                array('label' => '网站前台', 'icon' => 'home', 'url' => Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/../../frontend/www'),
                array('label' => '站点配置', 'icon' => 'wrench', 'url' => array('/siteconfig/')),
                array('label' => '登录', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => Yii::app()->user->name, 'icon' => 'user', 'url' => '#', 'items' => array(
                    array('label' => '个人资料', 'icon' => 'user', 'url' => '#'),
                    array('label' => '退出', 'icon' => 'off', 'url' => array('/site/logout'))
                ), 'visible' => !Yii::app()->user->isGuest),
            ),
        ),
    ),
));
?>

<div class="container-fluid" id="page">
    <?php echo $content; ?>
</div><!-- page -->
<footer class="footer">
    <div class="row-fluid">
        <div class="span12">
            <div class="well large">
                <?php echo Yii::powered(); ?> / <?php echo CHtml::link('ZenWeb', '#'); ?>
                <span class="copy">Copyright &copy; <?php echo date('Y'); ?> by . All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer><!-- footer -->
</body>
</html>
