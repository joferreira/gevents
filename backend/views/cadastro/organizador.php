<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$titiulo = 'Organizador';

$this->title = $titiulo;
?>
	<div id="page-wrapper" class="usuario-index">
		<br/>
		<div class="row">
			<?php //secho $this->render('_search', ['model' => $searchModel]); ?>

			<p>
				<?= Html::a('Cadastro de Organizador', ['create'], ['class' => 'btn btn-success']) ?>
			</p>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [ 

					'INT_ID_CLIENTE',
					'STR_NOME_COMPLETO',
					'STR_EMAIL:email',
					'DAT_DATA_CADASTRO:datetime',

					['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>

	</div>