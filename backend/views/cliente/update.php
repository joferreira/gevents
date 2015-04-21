<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Alterar';
?>
	<div id="page-wrapper" class="usuario-update">
		<div class="row">
			<h3> Informações do Cliente</h3>
		</div>

		<div class="row">
			<?= $this->render('_form', [
				'objModelCliente' => $objModelCliente,
				'objModelEndereco' => $objModelEndereco,
				'arrTipoCliente' => $arrTipoCliente,
				'arrTipoPessoa' => $arrTipoPessoa,
				'arrStatus' => $arrStatus,
			]) ?>
		</div>
	</div>
