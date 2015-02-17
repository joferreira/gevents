<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Create Usuario';
?>
	<div id="page-wrapper" class="usuario-create">
		<br/>
		<div class="row">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>

	</div>
