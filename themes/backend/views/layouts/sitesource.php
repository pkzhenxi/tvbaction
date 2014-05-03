<?php $this->beginContent('//layouts/main'); ?>
    <div class="row-fluid">
        <div class="span2" id="sidebar-nav">
            <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type' => 'list',
                'items' => array_merge(array(
                    array('label' => 'MAIN MENU'),
                    '---',
                    array('label' => '视频分类', 'icon'=>'glass', 'url' => array('/source/dataCategory/admin')),
                    array('label' => '视频管理', 'icon'=>'film', 'url' => array('/source/data/admin')),
                    array('label' => '推荐视频', 'icon'=>'th', 'url' => array('/source/data/commend')),
                    array('label' => '视频评论', 'icon'=>'th-list', 'url' => array('/source/vcomment/admin')),
                    '---',
                    array('label' => '专辑管理', 'icon'=>'play-circle', 'url' => array('/source/album/admin')),
                    array('label' => '曲目管理', 'icon'=>'volume-up', 'url' => array('/source/music/admin')),
                    '---',
                    array('label' => '专题管理','icon'=>'edit', 'url' => array('/source/topic/admin')),
                    '---',
                    array('label' => 'CHILD MENU'),
                ),$this->menu),
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