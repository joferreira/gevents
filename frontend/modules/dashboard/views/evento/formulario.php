<!-- CONTATO -->

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\jui\DatePicker;

$hoje = date('d/m/Y');

$dataInicio = isset($objModelEvento->DAT_DATAHORA_INICIO) ? $objModelEvento->DAT_DATAHORA_INICIO : date('Y-m-d');
$dataFormatadaInicio = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataInicio))), 'php:d/m/Y');

$dataFinal = isset($objModelEvento->DAT_DATAHORA_FINAL) ? $objModelEvento->DAT_DATAHORA_FINAL : date('Y-m-d');
$dataFormatadaFinal = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataFinal))), 'php:d/m/Y');

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
			<div class="row">	
				<div class="col-md-6">
				<?= $objFormEvento->field($objModelEvento, 'TIPO_EVENTO_INT_ID_TIPO_EVENTO', [
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->dropDownList($arrTipoEvento, ['prompt'=>'Selecione...', 'id'=>'tipo_evento', 'size'=>1]);
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
				<div class="col-md-3">
				<?= $objFormEvento->field($objModelEvento, 'DAT_DATAHORA_INICIO', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaInicio]) ?>
				</div>
				<div class="col-md-3">
					<div class="form-group field-evento-tipo_evento_hora_inicio">
						<div class="input-group">
							<span class="input-group-addon"><label for="hora_inicio" class="control-label">Hora</label></span>
							<?= Html::dropDownList( 'hora_inicio', null, ['test'=>1], ['prompt'=>'Selecione...', 'id'=>'hora_inicio', 'class'=>'form-control', 'size'=>1]);
								//echo $objFormEvento->field( $objModelEvento , 'DAT_HORA_INICIO', [ 
								//	'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								//])->dropDownList( ['prompt'=>'Selecione...', 'id'=>'hora_inicio', 'size'=>1]) 
							?>
						</div>
					</div>
				
				</div>
				<div class="col-md-3">
				<?= $objFormEvento->field($objModelEvento, 'DAT_DATAHORA_FINAL', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaFinal]) ?>
				</div>
				<div class="col-md-3">
					<div class="form-group field-evento-tipo_evento_hora_final">
						<div class="input-group">
							<span class="input-group-addon"><label for="hora_final" class="control-label">Hora</label></span>
							<?= Html::dropDownList( 'hora_final', null, ['test1'=>1], ['prompt'=>'Selecione...', 'id'=>'hora_final', 'class'=>'form-control', 'size'=>1]);
								//$objFormEvento->field($objModelEvento, 'DAT_HORA_FINAL', [ 
								//	'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								//])->dropDownList( ['prompt'=>'Selecione...', 'id'=>'hora_final', 'size'=>1])
							?>
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
							<?php echo $objFormEvento->field($objModelEvento, 'STR_DESCRICAO')->label(FALSE)->textArea();?>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row hidden">
				<div class="col-md-6">
				<?php
					//echo $objFormEvento->field($objModelEvento, 'publico', [
					//	'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					//])->dropDownList(['Público '=>'Público ', 'Privado'=>'Privado'], ['size'=>1]);
				?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Local do Evento
						</div>

						<div class="panel-body">
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
									])->dropDownList($arrUnidadeFederal, ['prompt'=>'Selecione...', 'id'=>'unidade_federal', 'size'=>1]);
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
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group col-md-12 text-center">
				<?php echo Html::hiddenInput('Hoje', $hoje , ['id'=>'hoje'] );?>
				<?php echo $objFormEvento->field($objModelEvento, 'INT_ID_EVENTO')->label(FALSE)->hiddenInput();?>
				<?php echo $objFormEvento->field($objModelEnderecoEvento, 'INT_ID_ENDERECO_EVENTO')->label(FALSE)->hiddenInput();?>
				<?= Html::submitInput('Publicar', [
						'class' => 'alterar btn btn-primary submit-button ',
						'name' => 'alterar-button']) ?>
			</div>

			<?php ActiveForm::end(); ?>


		</div>
		<!-- /FORMULÁRIO -->
			
	</div>
</div>

<!-- /CONTATO -->