<!-- GRID CONTATO -->

<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Eventos';
?>

<div id="page-wrapper">
	<div class="row">
		<h1 class="page-header"><i class="fa fa-calendar fa-fw"></i> Eventos </h1>
	</div>
	<div class="row">
		<div class="buttons">
			<?= Html::a('Crie seu evento', ['evento/formulario'], ['class'=>'btn btn-success btn-primary']) ?>
		</div>
	</div>
	<div class="row">
		<table id="grid_evento" class="table table-striped table-hover">
			<thead>  
				<tr>
					<th width="100px" class="text-center">Cód.</th>
					<th>Evento</th>
					<th width="150px">Início</th>
					<th width="150px" class="text-center">Término</th>
					<th width="75px" class="text-center">Pago ?</th>
					<th width="90px" class="text-center">Publicado ?</th>
					<th width="75px" class="text-center">Tipo</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>
<!-- /GRID CONTATO -->

<script>
$(document).ready(function() {
		
		$('#grid_evento').DataTable({
			"searching": true,
			"ordering": true,
			"columnDefs": [
				{ "orderable": false, "targets": 4 }
			],
			"order": [[ 0, "desc" ]]
		});
		
	});
</script>