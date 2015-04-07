<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;
use yii\web\Session;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>

	<link href="/gevents/frontend/web/modules/css/site.css" rel="stylesheet">
	<link href="/gevents/frontend/web/modules/metisMenu/dist/metisMenu.css" rel="stylesheet">
	<link href="/gevents/frontend/web/modules/css/timeline.css" rel="stylesheet">
	<link href="/gevents/frontend/web/modules/css/sb-admin-2.css" rel="stylesheet">
	<link href="/gevents/frontend/web/modules/morrisjs/morris.css" rel="stylesheet">
	<link href="/gevents/frontend/web/modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="/gevents/frontend/web/modules/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
	<script src="/gevents/frontend/web/modules/metisMenu/dist/metisMenu.js"></script>
	<script src="/gevents/frontend/web/modules/raphael/raphael.js"></script>
	<script src="/gevents/frontend/web/modules/js/sb-admin-2.js"></script>

</head>
<body>
	<?php $this->beginBody() ?>
	<div class="wrap">
		<?php
		
		//if ( Yii::$app->session->getIsActive() ) {
			echo $this->render('menu');
		?>
			<div id="wrapper">
			<?= Breadcrumbs::widget([ 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>
			<?php
				echo $content;
			?>
			</div>
		<?
		// }
		?>
	</div>
	<div class="text-center" style="left:20%; position:absolute; top:45%; width:60%; z-index:9999;">
		<?php if (Yii::$app->session->hasFlash('success')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-success',
				],
				'body' => Yii::$app->session->getFlash('success'),
			]);
				//echo Yii::$app->session->getFlash('success');
		elseif (Yii::$app->session->hasFlash('error')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-danger',
				],
				'body' => Yii::$app->session->getFlash('error'),
			]);
		 ?>
		<?php endif; ?>
	</div>

	<div id="confirmBox" class="text-center alert alert-info hidden" style="left:20%; position:absolute; top:45%; width:60%; z-index:9999;">
		<div id="message-confirmBox" style="font-size:16px; font-weight:bold" >Teste de mensagem ?</div>
		<div id="button-confirmBox">
			<a id="button-yes" action="yes" href="javascript:;" class="confirmBox btn btn-sm btn-success">Sim</a>&nbsp;
			<a id="button-no" action="no" href="javascript:;" class="confirmBox btn btn-sm btn-danger">Não</a>
		</div>
	</div>

	<div id="messageBox" class="hidden" style="left:20%; position:absolute; top:45%; width:60%; z-index:10000;">
		
	</div>

	<footer class="footer">
		<div class="container">
		<p class="pull-left">&copy; Gigante dos Eventos <?= date('Y') ?></p>
		<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>
	

	<?php $this->endBody() ?>
	<script type="text/javascript">
		$('#wrapper').tooltip({
			selector: "[data-toggle=tooltip]",
			container: "body"
		});

		function message(message, alert_class, timeout){
			$("#messageBox")
				.removeClass()
				.addClass('messageBox')
				.addClass('alert')
				.addClass('text-center')
				.addClass(alert_class)
				.html(message)
				.show();

			setTimeout(
				function(){ 
					$('#messageBox').addClass('hidden').hide(); 
				},(!timeout)?3000:timeout
			);
		}
		/*
		$.extend( $.fn.dataTable.defaults, {
			responsive: true,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"language": {
				"sEmptyTable": "Nenhum registro encontrado",
				"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
				"sInfoFiltered": "(Filtrados de _MAX_ registros)",
				"sInfoPostFix": "",
				"sInfoThousands": ".",
				"sLengthMenu": "_MENU_ resultados por página",
				"sLoadingRecords": "Carregando...",
				"sProcessing": "Processando...",
				"sZeroRecords": "Nenhum registro encontrado",
				"sSearch": "Procurar: ",
				"oPaginate": {
					"sNext": "Próximo",
					"sPrevious": "Anterior",
					"sFirst": "Primeiro",
					"sLast": "Último"
				},
				"oAria": {
					"sSortAscending": ": Ordenar colunas de forma ascendente",
					"sSortDescending": ": Ordenar colunas de forma descendente"
				}
			}
		} );
*/
	</script>
</body>
</html>
<?php $this->endPage() ?>
