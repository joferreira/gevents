<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Dados do Usuário';
?>
	<div id="page-wrapper" class="usuario-view">
		<br/>
		<div class="row">
			<p>
				<?= Html::a('Alterar', ['update', 'id' => $model->INT_ID_USUARIO], ['class' => 'btn btn-primary']) ?>
				<!--<?= Html::a('Delete', ['delete', 'id' => $model->INT_ID_USUARIO], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
			-->
			</p>

			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
					'INT_ID_USUARIO',
					'PERFIL_INT_ID_PERFIL',
					'STR_NOME_COMPLETO',
					'STR_EMAIL:email',
					'STR_SENHA',
				],
			]) ?>
		</div>
	</div>
