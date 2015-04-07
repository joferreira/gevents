<?php

namespace frontend\modules\dashboard\controllers;

use yii\web\Controller;
use yii\web\Session;

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$session = new Session;

		if( !empty( $session->get('STR_NOME',false) ) )
			return $this->render('index');
		else 
			return $this->goHome();
			//return $this->render('login', ['model' => $objModelLogin,]);

	}


}
