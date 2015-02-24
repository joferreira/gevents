<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Update Cliente ';
?>
	<div id="page-wrapper" class="usuario-update">
		<div class="row">
			<h3><?= Html::encode($model->STR_NOME_COMPLETO) ?></h3>
		</div>

		<div class="row">
			<?= $this->render('_form', [
				'model' => $model,
				'endereco' => $endereco,
			]) ?>
		</div>
	</div>
