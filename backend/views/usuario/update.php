<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Dados do Usuário';
?>
	<div id="page-wrapper" class="usuario-update">
		<br/>
		<div class="row">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>
	</div>
