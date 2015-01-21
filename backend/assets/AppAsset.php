<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site.css',
		'plugins/bootstrap/dist/css/bootstrap.min.css',
		'plugins/metisMenu/dist/metisMenu.min.css',
		'css/timeline.css',
		'css/sb-admin-2.css',
		'plugins/morrisjs/morris.css',
		'plugins/font-awesome/css/font-awesome.min.css'
	];
	public $js = [
		'plugins/jquery/dist/jquery.min.js',
		'plugins/bootstrap/dist/js/bootstrap.min.js',
		'plugins/metisMenu/dist/metisMenu.min.js',
		'plugins/raphael/raphael-min.js',
		'plugins/morrisjs/morris.min.js',
		'js/morris-data.js',
		'js/sb-admin-2.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}


	