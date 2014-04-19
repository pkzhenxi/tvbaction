<?php
/**
 * This is the configuration for generating messages translations
 * for the Yii framework. It is used by the 'yiic messages' command.
 */
return array(
	'sourcePath'=>__DIR__.'/../../..',
	'messagePath'=>__DIR__.'/../../../messages',
	'languages'=>array('template'),
	'fileTypes'=>array('php'),
	'overwrite'=>true,
	'exclude'=>array(
		'.git',
		'.gitignore',
		'.gitkeep',
		'/demo',
		'/messages',
	),
);
