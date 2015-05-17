<?php

namespace frontend\modules\hotevent;

use Yii;
use yii\base\Module;

class Hotevent extends Module
{
	public $controllerNamespace = 'frontend\modules\hotevent\controllers';

	public function init()
	{
		$this->layout = 'main';

		parent::init();

		// custom initialization code goes here
	}
}
