<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
?>
	<div id="page-wrapper" class="usuario-index">
		<br/>
		<div class="row">
			<?php //secho $this->render('_search', ['model' => $searchModel]); ?>

			<p>
				<?= Html::a('Create Usuario', ['create'], ['class' => 'btn btn-success']) ?>
			</p>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					'INT_ID_USUARIO',
					'PERFIL_INT_ID_PERFIL',
					'STR_NOME_COMPLETO',
					'STR_EMAIL:email',
					'STR_SENHA',

					['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>

	</div>