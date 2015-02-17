<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Update Usuario: ' . ' ' . $model->STR_NOME_COMPLETO;
?>
	<div id="page-wrapper" class="usuario-update">
		<br/>
		<div class="row">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>
	</div>
