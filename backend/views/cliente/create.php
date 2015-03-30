<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Cadastro Cliente';
?>
	<div id="page-wrapper" class="usuario-create">
		<br/>
		<div>
			<?= $this->render('_form', [
				'model' => $model,
				'endereco' => $endereco,
			]) ?>
		</div>

	</div>
