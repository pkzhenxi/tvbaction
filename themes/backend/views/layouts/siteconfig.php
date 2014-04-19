<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="row-fluid">
         <div class="span2" id="sidebar-nav">
             <?php
             $this->widget('bootstrap.widgets.TbMenu', array(
                 'type' => 'list',
                 'items' => array_merge(array(
                     array('label' => 'MAIN MENU'),
                     array('label' => '控制面板', 'icon' => 'home', 'url' => array('/site/index')),
                     '---',
                     array('label' => '网站基本设置', 'icon' => 'bookmark', 'url' => array('/siteconfig/default/index')),
                     array('label' => '会员注册设置', 'icon' => 'book', 'url' => array('/siteconfig/default/siteregister')),
                     array('label' => '邮件设置', 'icon' => 'envelope', 'url' => array('/siteconfig/default/sitemail')),
                     array('label' => 'IP过滤', 'icon' => 'book', 'url' => array('/siteconfig/default/ipfilter')),
                 ), $this->menu),
             ));
             ?>
         </div>
         <div class="span10">
             <div class="row-fluid">
                 <div class="span12">
                     <?php if (isset($this->breadcrumbs)): ?>
                         <?php
		$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		    'links' => $this->breadcrumbs,
		));
		?><!-- breadcrumbs -->
                     <?php endif ?>
                     <?php echo $content; ?>
                 </div>
             </div>
         </div>
    </div>
<?php $this->endContent(); ?>