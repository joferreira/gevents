<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\Response;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//'create&intTipoCliente='.$intTipoCliente

$this->title = $tituloPagina;
?>
	<div id="page-wrapper" >
		<br/>
		<div class="row">
			<?php //secho $this->render('_search', ['model' => $searchModel]); ?>

			<p>
				<?= Html::a('Cadastro de '.$tituloPagina, ['create'], ['class' => 'btn btn-success']) ?>
			</p>
			<div>
				<table id="grid_cliente" class="table">
					<thead>
						<tr>
							<th width="120">Cód. do Cliente</th>
							<th>Nome Completo</th>
							<th>E-mail</th>
							<th width="120">Data de Cadastro</th>
							<th width="90">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($dataProvider)) {
							foreach ($dataProvider as $arrDados) {
								echo 
								"<tr>
									<td>".$arrDados['INT_ID_CLIENTE']."</td>
									<td>".$arrDados['STR_NOME_COMPLETO']."</td>
									<td>".$arrDados['STR_EMAIL']."</td>
									<td>".date('d/m/Y H:i:s', strtotime($arrDados['DAT_DATA_CADASTRO']))."</td>
									<td>
										<a href='index.php?r=cliente/view&id=".$arrDados['INT_ID_CLIENTE']."' class='fa fa-eye btn btn-xs btn-default btn-circle' data-toggle='tooltip' data-original-title='Visualizar'></a>
										<a href='index.php?r=cliente/update&id=".$arrDados['INT_ID_CLIENTE']."' class='fa fa-pencil btn btn-xs btn-default btn-circle' data-toggle='tooltip' data-original-title='Alterar'></a> ";
								if( $arrDados['STATUS_INT_ID_STATUS'] == 3)
									echo "<a id='".$arrDados['INT_ID_CLIENTE']."' href='javascript:;' class='fa fa-remove btn btn-xs btn-danger btn-circle' data-toggle='tooltip' data-original-title='Inativo'></a>";
								else if( $arrDados['STATUS_INT_ID_STATUS'] == 4)
									echo "<a id='".$arrDados['INT_ID_CLIENTE']."' href='javascript:;' class='fa fa-remove btn btn-xs btn-danger btn-circle' data-toggle='tooltip' data-original-title='Cancelado'></a>";
								else
									echo "<a id='".$arrDados['INT_ID_CLIENTE']."' href='javascript:;' class='inativar fa fa-trash-o btn btn-xs btn-default btn-circle' data-toggle='tooltip' data-original-title='Inativar'></a>";
								echo "
									</td>
								</tr>";
							}
						}
						?>

					</tbody>
				</table>
			</div>

		</div>
	</div>

<a id="url_inativar_cliente" class="hidden" href="index.php?r=cliente/delete"></a>
<a id="url_grid_cliente" class="hidden" href="index.php?r=cliente/gridCliente"></a>
<script type="text/javascript">
	function confirmacao(evt){
		evt.preventDefault;
		var confirmBox = $("#confirmBox");
		var intTipoCliente = $(evt.currentTarget).attr('id');

		confirmBox.find( "#message-confirmBox" ).text('Confirma a inativação do cliente ?');
		confirmBox.find( "#button-yes" ).attr({ INT_ID_CLIENTE: intTipoCliente });


		confirmBox.removeClass()
			.addClass('text-center')
			.addClass('alert')
			.addClass('alert-info')
			.show();

	}

	function removerConfirmBox (){
		var confirmBox = $("#confirmBox");

		confirmBox.find( "#message-confirmBox" ).text('');
		confirmBox.find( "#button-yes" ).removeAttr( 'INT_ID_CLIENTE');

		confirmBox.addClass('hidden').hide();
	}

	function inativarCliente (evt) {
		evt.preventDefault;
		var url = $('#url_inativar_cliente').attr('href');
		var action = $(evt.currentTarget).attr('action');

		if ( action == 'yes') {			
			var intTipoCliente = $(evt.currentTarget).attr('INT_ID_CLIENTE');
			removerConfirmBox();
			var arrDados = {INT_ID_CLIENTE:intTipoCliente};

			$.post( url , arrDados,  function( data ) {
				if (data.response) {
					message(data.message, 'alert-success');
					location.reload(true);
				} else {
					message(data.message, 'alert-danger');
				}
				
			});
		} else {
			removerConfirmBox();
		}

		return false;
	}

	$(document).ready(function() {
		
		$('#grid_cliente').DataTable({
			responsive: true,
			"lengthChange": false,
			"columnDefs": [
				{ "orderable": false, "targets": 4 }
			],
			"order": [[ 0, "desc" ]]
		});

		$('#grid_cliente').on('click', '.inativar', confirmacao);
		$('#confirmBox').on('click', '.confirmBox', inativarCliente);
		
	});
</script>