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
					<th width="135px" class="text-center">Início</th>
					<th width="135px" class="text-center">Término</th>
					<th width="50px" class="text-center">Pago ?</th>
					<th width="90px" class="text-center">Publicado ?</th>
					<th width="130px" class="text-center">Ação</th>
				</tr>
			</thead>
			<tbody>
			<?php if (!empty($arrEventos)) {
			 	foreach ($arrEventos as $key => $arrEvento) { ?>
				<tr>
					<td><?= $arrEvento['INT_ID_EVENTO'];?></td>
					<td><?= $arrEvento['STR_NOME'];?></td>
					<td class="text-center"><?= date('d/m/Y H:i:s', strtotime($arrEvento['DAT_DATA_INICIO'].$arrEvento['TIM_HORA_INICIO']));?></td>
					<td class="text-center"><?= date('d/m/Y H:i:s', strtotime($arrEvento['DAT_DATA_FINAL'].$arrEvento['TIM_HORA_FINAL']));?></td>
					<td class="text-center"><?= $arrEvento['INT_PAGAMENTO_ATIVO'] ? "<strong class='text-success'>Sim</strong>" : "<strong class='text-danger'>Não</strong>" ;?></td>
					<td class="text-center"><strong><?= $arrEvento['STR_DESCRICAO_STATUS'];?></strong></td>
					<td>						
						<?= Html::a('Publicar', ['evento/publicar','id' => $arrEvento['INT_ID_EVENTO']], ['class'=>'btn btn-success']) ?>
						<?= Html::a('Editar', ['evento/editar','id' =>$arrEvento['INT_ID_EVENTO']], ['class'=>'btn btn-primary']) ?>
					</td>
				</tr>
			<?php } 
			} ?>
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
				{ "orderable": false, "targets": 6 }
			],
			"order": [[ 0, "desc" ]]
		});
		
	});
</script>