<?php
$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => 'app-backend',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'backend\controllers',
	'bootstrap' => ['log'],
	'modules' => [],
	'components' => [
		'user' => [
			'identityClass' => 'backend\models\usuario',
			'enableAutoLogin' => false,
			'loginUrl' => ['usuario/login'],
			//'enableSession' => true,
			//'authTimeout' => 600,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],

	],
	'sourceLanguage'=>'pt-BR',
	'language'=>'pt-BR',
	'params' => $params,
];
/*
'enableAutoLogin' => false,
'enableSession' => true,
'authTimeout' => 300,
'loginUrl' => ['usuario/login'],
*/