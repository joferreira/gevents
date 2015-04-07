<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 * 'css/site.css',
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'plugins/fontawesome/css/font-awesome.min.css',
		'plugins/bootstrap-select/bootstrap-select.min.css',
		'plugins/owlcarousel2/assets/owl.carousel.min.css',
		'plugins/owlcarousel2/assets/owl.theme.default.min.css',
		'plugins/prettyphoto/css/prettyPhoto.css',
		'plugins/animate/animate.min.css',
		'plugins/countdown/jquery.countdown.css',
		'css/theme.css',
		'css/theme-red-1.css',
		'css/custom.css',
		'js/theme-config.css',
	];
	public $js = [
		'plugins/modernizr.custom.js',
		'plugins/bootstrap/js/bootstrap.min.js',
		'plugins/bootstrap-select/bootstrap-select.min.js',
		'plugins/superfish/js/superfish.js',
		'plugins/prettyphoto/js/jquery.prettyPhoto.js',
		'plugins/placeholdem.min.js',
		'plugins/jquery.smoothscroll.min.js',
		'plugins/jquery.easing.min.js',
		'plugins/smooth-scrollbar.min.js',
		'plugins/owlcarousel2/owl.carousel.min.js',
		'plugins/waypoints/waypoints.min.js',
		'plugins/countdown/jquery.plugin.min.js',
		'plugins/countdown/jquery.countdown.min.js',
		'plugins/countdown/jquery.countdown-pt-BR.js',
		'js/theme-ajax-mail.js',
		'js/theme.js',
		'js/custom.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
	public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}

/*
		'plugins/jquery.cookie.js',
		'js/theme-config.js',
*/
