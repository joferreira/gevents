<!-- GRID CONTATO -->

<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Contatos';
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><i class="fa fa-envelope fa-fw"></i> Contatos efetuados</h1>
		</div>
	</div>
	<div class="row">
		<div class="row buttons text-center">
			<?= Html::a('Faça seu contato', ['contato/formulario'], ['class'=>'btn btn-success btn-primary']) ?>
		</div>
	</div>
	<div class="row">
		<table id="grid_contato" class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="10px" class="text-center">Código</th>
					<th width="300px">Cliente</th>
					<th>Mensagem</th>
					<th width="10px" class="text-center">Status</th>
					<th width="200px" class="text-center">Data</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (!empty($arrContato)) {
					foreach ($arrContato as $objContato):
				?>
				<tr>
					<td class="text-center"><?= $objContato['INT_ID_CONTATO']; ?></td>
					<td><?= $objContato['STR_NOME_COMPLETO']; ?></td>
					<td><?= $objContato['STR_MENSAGEM']; ?></td>
					<td class="text-center">
						<?php if ($objContato['STR_VISUALIZADO'] == 'N') { ?>
						<a href='javascript:;' class='fa fa-clock-o  btn btn-xs' data-toggle='tooltip' data-original-title='Aguardando'></a>
						<?php } else { ?>
						<a href='javascript:;' class='fa fa-check btn btn-xs' data-toggle='tooltip' data-original-title='Visualizado'></a>
						<?php } ?>
					</td>
					<td class="text-center"><?= date('d/m/Y H:i:s', strtotime($objContato['DAT_DATA_CONTATO'])); ?></td>
				</tr>
				<?php endforeach;
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<!-- /GRID CONTATO -->

<script>
$(document).ready(function() {
		
		$('#grid_contato').DataTable({
			"searching": true,
			"ordering": true,
			"columnDefs": [
				{ "orderable": false, "targets": 4 }
			],
			"order": [[ 0, "desc" ]]
		});
		
	});
</script>