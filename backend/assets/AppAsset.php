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
		'plugins/metisMenu/dist/metisMenu.css',
		'css/timeline.css',
		'css/sb-admin-2.css',
		'plugins/morrisjs/morris.css',
		'plugins/font-awesome/css/font-awesome.min.css',
		'plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'
	];
	public $js = [
		'plugins/bootstrap/dist/js/bootstrap.js',
		'plugins/metisMenu/dist/metisMenu.js',
		'plugins/raphael/raphael-min.js',
		'js/sb-admin-2.js',
		'plugins/datatables/media/js/jquery.dataTables.js',
		'plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
	public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}


	