<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */

$this->title = 'Dados Cadastrais';
?>
	<div id="page-wrapper" class="usuario-view">
		<div class="row">
			<h3><?= Html::encode($model->STR_NOME_COMPLETO) ?></h3>
		</div>

		<div class="row">
			<p>
				<?= Html::a('Update', ['update', 'id' => $model->INT_ID_CLIENTE], ['class' => 'btn btn-primary']) ?>
				<?= Html::a('Delete', ['delete', 'id' => $model->INT_ID_CLIENTE], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
			</p>

			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
					'INT_ID_CLIENTE',
					'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE',
					'TIPO_PESSOA_INT_ID_TIPO_PESSOA',
					'STATUS_INT_ID_STATUS',
					'STR_NOME_COMPLETO',
					'DAT_DATA_NASCIMENTO',
					'STR_SEXO',
					'STR_CPF',
					'STR_CNPJ',
					'STR_RG',
					'STR_EMAIL',
					'STR_SENHA',
					'INT_TELEFONE_DDI',
					'INT_TELEFONE_DDD',
					'INT_TELEFONE',
					'INT_CELULAR_DDI',
					'INT_CELULAR_DDD',
					'INT_CELULAR',
					'INT_FAX_DDI',
					'INT_FAX_DDD',
					'INT_FAX',
					'STR_RAZAO_SOCIAL',
					'STR_NOME_FANTASIA',
					'STR_INSCRICAO_MUNICIPAL',
					'STR_CATEGORIA_EMPRESA'
				],
			]) ?>
		</div>
	</div>
