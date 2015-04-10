<?php

namespace frontend\modules\dashboard;

use Yii;
use yii\base\Module;

class Dashboard extends Module
{
    public $controllerNamespace = 'frontend\modules\dashboard\controllers';

    public function init()
    {
    	$this->layout = 'main';

        parent::init();

        // custom initialization code goes here
    }
}
