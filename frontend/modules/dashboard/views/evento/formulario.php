<!-- CONTATO -->

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\jui\DatePicker;

$hoje = date('d/m/Y');

$dataInicio = isset($objModelEvento->DAT_DATA_INICIO) ? $objModelEvento->DAT_DATA_INICIO : date('Y-m-d');
$dataFormatadaInicio = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataInicio))), 'php:d/m/Y');

$arrHoraInicio = isset($objModelEvento->TIM_HORA_INICIO) ? explode(":", $objModelEvento->TIM_HORA_INICIO, -1 ) : [0=>'08',1=>'00'];

$dataFinal = isset($objModelEvento->DAT_DATA_FINAL) ? $objModelEvento->DAT_DATA_FINAL : date('Y-m-d');
$dataFormatadaFinal = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataFinal))), 'php:d/m/Y');

$arrHoraFinal = isset($objModelEvento->TIM_HORA_FINAL) ? explode(":", $objModelEvento->TIM_HORA_FINAL, -1 ) : [0=>'09',1=>'00'];

$dataInicioDestaque = isset($objModelEvento->DAT_DATA_DESTAQUE_INICIO) ? $objModelEvento->DAT_DATA_DESTAQUE_INICIO : '';
$dataFormatadaInicioDestaque = empty($dataInicioDestaque) ? '' : Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataInicioDestaque))), 'php:d/m/Y');

$arrHoraInicioDestaque = isset($objModelEvento->TIM_HORA_DESTAQUE_INICIO) ? explode(":", $objModelEvento->TIM_HORA_DESTAQUE_INICIO, -1 ) : [0=>'08',1=>'00'];

$dataFinalDestaque = isset($objModelEvento->DAT_DATA_DESTAQUE_FINAL) ? $objModelEvento->DAT_DATA_DESTAQUE_FINAL : '';
$dataFormatadaFinalDestaque = empty($dataFinalDestaque)? '' : Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataFinalDestaque))), 'php:d/m/Y');

$arrHoraFinalDestaque = isset($objModelEvento->TIM_HORA_DESTAQUE_FINAL) ? explode(":", $objModelEvento->TIM_HORA_DESTAQUE_FINAL, -1 ) : [0=>'09',1=>'00'];

$this->title = 'Evento';
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><i class="fa fa-calendar fa-fw"></i> Evento</h1>
		</div>
	</div>
	<div class="row">
		<!-- FORMULÁRIO -->
		<div class="form">
				
			<?php $objFormEvento = ActiveForm::begin(['id' => 'evento-form', 'method' => 'post','layout' => 'default', 'action' => ['evento/formulario']]); ?>
			<?php 
			$arrFlashMessages = Yii::$app->session->getAllFlashes();

			if ($arrFlashMessages) {
				echo '<div>';
				foreach($arrFlashMessages as $strKeyFlash => $strMessagem) {

					if( $strKeyFlash == 'info' )
						echo '<div class="button-normal alert skin-background-color16 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';

					if( $strKeyFlash == 'success' )
						echo '<div class="button-normal alert skin-background-color17 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';

					if( $strKeyFlash == 'warning' )
						echo '<div class="button-normal alert skin-background-color16 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';

					if( $strKeyFlash == 'error' )
						echo '<div class="button-normal alert skin-background-color24 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';

					if( $strKeyFlash == 'danger' )
						echo '<div class="button-normal alert skin-background-color24 skin-font-color3 skin-background-hover3">'.$strMessagem.'</div>';

				}
				echo '</div>';
			}
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default hidden">
						<div class="panel-heading">
							Insira o banner do evento
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="form-group col-md-6">
									<?= Html::fileInput( "Banner[ARQUIVO]", null, ['id'=>'banner', 'class'=>'btn'] ); ?>
								</div>
								<div class="col-md-6">
									<div class="alert alert-info">
										A imagem escolhida deve estar em formato JPG, GIF, ou PNG e ter no máximo 1MB. As dimensões são limitadas a 350 x 200 pixels. Imagens com altura ou largura maiores que estas serão redimensionadas.
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							Informação do Evento
						</div>

						<div class="panel-body">
							<div class="row">	
								<div class="col-md-6">
								<?= $objFormEvento->field($objModelEvento, 'TIPO_EVENTO_INT_ID_TIPO_EVENTO', [
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->dropDownList($arrTipoEvento, ['prompt'=>'Selecione...', 'size'=>1]);
								?>
								</div>
								<div class="col-md-3">
								<?= $objFormEvento->field($objModelEvento, 'STR_PUBLICACAO', [
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->dropDownList(['PU'=>'Público', 'PR'=>'Privado'], ['prompt'=>'Selecione...', 'size'=>1]);
								?>
								</div>
								<div class="col-md-3">
								<?= $objFormEvento->field($objModelEvento, 'INT_PAGAMENTO_ATIVO', [
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->dropDownList(['1'=>'Sim', '0'=>'Não'], ['prompt'=>'Selecione...', 'size'=>1]);
								?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<?= $objFormEvento->field($objModelEvento, 'STR_NOME', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 200]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'DAT_DATA_INICIO', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaInicio]) ?>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-hora_inicio">
										<div class="input-group">
											<span class="input-group-addon"><label for="hora_inicio" class="control-label">Hora</label></span>
											<?= Html::dropDownList( 'Evento[hora_inicio]', $arrHoraInicio[0], $arrHora, ['prompt'=>'Selecione...', 'id'=>'hora_inicio', 'class'=>'form-control','size'=>1]);
												//echo $objFormEvento->field( $objModelEvento , 'DAT_HORA_INICIO', [ 
												//	'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
												//])->dropDownList( ['prompt'=>'Selecione...', 'id'=>'hora_inicio', 'size'=>1]) 
											?>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-min_inicio">
										<div class="input-group">
											<span class="input-group-addon"><label for="min_inicio" class="control-label">Min</label></span>
											<?= Html::dropDownList( 'Evento[minuto_inicio]', $arrHoraInicio[1], $arrMinuto, ['prompt'=>'Selecione...', 'id'=>'min_inicio', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'DAT_DATA_FINAL', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaFinal]) ?>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-hora_final">
										<div class="input-group">
											<span class="input-group-addon"><label for="hora_final" class="control-label">Hora</label></span>
											<?= Html::dropDownList( 'Evento[hora_final]', $arrHoraFinal[0], $arrHora, ['prompt'=>'Selecione...', 'id'=>'hora_final', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-min_final">
										<div class="input-group">
											<span class="input-group-addon"><label for="min_final" class="control-label">Min</label></span>
											<?= Html::dropDownList( 'Evento[minuto_final]', $arrHoraFinal[1], $arrMinuto, ['prompt'=>'Selecione...', 'id'=>'"min_final', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Destaque
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'DAT_DATA_DESTAQUE_INICIO', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaInicioDestaque]) ?>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-hora_destaque_inicio">
										<div class="input-group">
											<span class="input-group-addon"><label for="hora_destaque_inicio" class="control-label">Hora</label></span>
											<?= Html::dropDownList( 'Evento[hora_destaque_inicio]', $arrHoraInicioDestaque[0], $arrHora, ['prompt'=>'Selecione...', 'id'=>'hora_inicio', 'class'=>'form-control','size'=>1]);
											?>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-min_destaque_inicio">
										<div class="input-group">
											<span class="input-group-addon"><label for="min_destaque_inicio" class="control-label">Min</label></span>
											<?= Html::dropDownList( 'Evento[minuto_destaque_inicio]', $arrHoraInicioDestaque[1], $arrMinuto, ['prompt'=>'Selecione...', 'id'=>'min_inicio', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'DAT_DATA_DESTAQUE_FINAL', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaFinalDestaque]) ?>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-hora_destaque_final">
										<div class="input-group">
											<span class="input-group-addon"><label for="hora_destaque_final" class="control-label">Hora</label></span>
											<?= Html::dropDownList( 'Evento[hora_destaque_final]', $arrHoraFinalDestaque[0], $arrHora, ['prompt'=>'Selecione...', 'id'=>'hora_final', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group field-evento-min_destaque_final">
										<div class="input-group">
											<span class="input-group-addon"><label for="min_destaque_final" class="control-label">Min</label></span>
											<?= Html::dropDownList( 'Evento[minuto_destaque_final]', $arrHoraFinalDestaque[1], $arrMinuto, ['prompt'=>'Selecione...', 'id'=>'"min_final', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
								<?= $objFormEvento->field($objModelEvento, 'INT_QUANTIDADE_DIAS_DESTAQUE', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 11]) ?>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Descrição do Evento
						</div>

						<div class="panel-body">
							<div>
							<?php echo $objFormEvento->field($objModelEvento, 'STR_DESCRICAO')->label(FALSE)->textArea(['id'=>'textForm']);?>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Local de Realização
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<?= $objFormEvento->field($objModelEvento, 'STR_LOCAL_REALIZACAO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 255]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<?= $objFormEvento->field($objModelEnderecoEvento, 'INT_CEP', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 8]) ?>
								</div>
							</div>
							<div class="row">	
								<div class="col-md-4">
									<?php 
									echo $objFormEvento->field($objModelEnderecoEvento, 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL', [
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->dropDownList($arrUnidadeFederal, ['prompt'=>'Selecione...',  'size'=>1]);
									?>
								</div>	
								<div class="col-md-4">
									<?= $objFormEvento->field($objModelEnderecoEvento, 'STR_MUNICIPIO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 150]) ?>
								</div>
								<div class="col-md-4">	
									<?= $objFormEvento->field($objModelEnderecoEvento, 'STR_BAIRRO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 150]) ?>
								</div>
							</div>
							<div class="row">	
								<div class="col-md-12">
									<?= $objFormEvento->field($objModelEnderecoEvento, 'STR_ENDERECO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 255]) ?>
								</div>	
							</div>
							<div class="row">	
								<div class="col-md-4">	
									<?= $objFormEvento->field($objModelEnderecoEvento, 'STR_NUMERO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 10]) ?>
								</div>
								<div class="col-md-8">
									<?= $objFormEvento->field($objModelEnderecoEvento, 'STR_COMPLEMENTO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 150]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">					
									<div class="checkbox">
										<?= $objFormEvento->field($objModelMapsGoogle, 'INT_ID_MAPS_GOOGLE')->checkbox( ['value'=> empty($objModelMapsGoogle->INT_ID_MAPS_GOOGLE) ? 'S' : $objModelMapsGoogle->INT_ID_MAPS_GOOGLE ])  ?>
										<!--label>
											<input name="MapsGoogle[google]" type="checkbox" value="1" >Gostaria de exibir endereço no Google Maps?
										</label-->
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Contato do evento
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<?= $objFormEvento->field($objModelEvento, 'STR_EMAIL_CONTATO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 150]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'INT_TELEFONE_DDI', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 2]) ?>
								</div>
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'INT_TELEFONE_DDD', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 2]) ?>
								</div>
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'INT_TELEFONE', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 8]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">	
								<?= $objFormEvento->field($objModelEvento, 'INT_FAX_DDI', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 2]) ?>
								</div>
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'INT_FAX_DDD', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 2]) ?>
								</div>
								<div class="col-md-4">
								<?= $objFormEvento->field($objModelEvento, 'INT_FAX', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 8]) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group col-md-12 text-center">
				<?php echo Html::hiddenInput('Hoje', $hoje , ['id'=>'hoje'] );?>
				<?php echo $objFormEvento->field($objModelEvento, 'INT_ID_EVENTO')->label(FALSE)->hiddenInput();?>
				<?php echo $objFormEvento->field($objModelEnderecoEvento, 'INT_ID_ENDERECO_EVENTO')->label(FALSE)->hiddenInput();?>
				<?php // echo $objFormEvento->field($objModelMapsGoogle, 'INT_ID_MAPS_GOOGLE')->label(FALSE)->hiddenInput();?>
				<?= Html::submitInput('Salve seu evento', [
						'class' => 'alterar btn btn-primary submit-button ',
						'name' => 'alterar-button']) ?>
			</div>

			<?php ActiveForm::end(); ?>


		</div>
		<!-- /FORMULÁRIO -->
			
	</div>
</div>

<!-- /CONTATO -->