<!-- GRID CONTATO -->

<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Ingressos';
?>

<div id="page-wrapper">
	<div class="row">
		<h1 class="page-header"><i class="fa fa-ticket fa-fw"></i> Ingressos </h1>
	</div>
	<div class="row">
		<div class="buttons">
			<?= Html::a('Crie seu ingresso', ['ingresso/formulario'], ['class'=>'btn btn-success btn-primary']) ?>
		</div>
	</div>
	<div class="row">
		<table id="grid_evento" class="table table-striped table-hover">
			<thead>  
				<tr>
					<th>Descrição</th>
					<th width="100px" class="text-center">Quantidade</th>
					<th width="135px" class="text-center">Data e Hora Início</th>
					<th width="135px" class="text-center">Data e Hora Final</th>
					<th width="130px" class="text-center">Qtd. Participantes</th>
					<th width="90px" class="text-center">Restrito ?</th>
					<th width="130px" class="text-center">Taxa de serviço</th>
					<th width="130px" class="text-center">Ação</th>
				</tr>
			</thead>
			<tbody>
			<?php if (!empty($arrIngressos)) {
			 	foreach ($arrIngressos as $key => $arrIngresso) { ?>
				<tr>
					<td><?= $arrIngresso['INT_ID_EVENTO'];?></td>
					<td><?= $arrIngresso['STR_NOME'];?></td>
					<td class="text-center"><?= date('d/m/Y H:i:s', strtotime($arrIngresso['DAT_DATA_INICIO'].$arrIngresso['TIM_HORA_INICIO']));?></td>
					<td class="text-center"><?= date('d/m/Y H:i:s', strtotime($arrIngresso['DAT_DATA_FINAL'].$arrIngresso['TIM_HORA_FINAL']));?></td>
					<td class="text-center"><?= $arrIngresso['INT_PAGAMENTO_ATIVO'] ? "<strong class='text-success'>Sim</strong>" : "<strong class='text-danger'>Não</strong>" ;?></td>
					<td class="text-center"><strong><?= $arrIngresso['STR_DESCRICAO_STATUS'];?></strong></td>
					<td>						
						<?= Html::a('Publicar', ['evento/publicar','id' => $arrIngresso['INT_ID_EVENTO']], ['class'=>'btn btn-success']) ?>
						<?= Html::a('Editar', ['evento/editar','id' =>$arrIngresso['INT_ID_EVENTO']], ['class'=>'btn btn-primary']) ?>
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
				{ "orderable": false, "targets": 7 }
			]
		});
		
	});
</script>