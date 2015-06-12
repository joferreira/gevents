<!-- CONTATO -->

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

$hoje = date('d/m/Y');

$dataInicio = isset($objModelIngresso->DAT_DATA_INICIO_VENDA) ? $objModelIngresso->DAT_DATA_INICIO_VENDA : date('Y-m-d');
$dataFormatadaInicio = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataInicio))), 'php:d/m/Y');

$arrHoraInicio = isset($objModelIngresso->TIM_HORA_INICIO_VENDA) ? explode(":", $objModelIngresso->TIM_HORA_INICIO_VENDA, -1 ) : [0=>'08',1=>'00'];

$dataFinal = isset($objModelIngresso->DAT_DATA_FINAL_VENDA) ? $objModelIngresso->DAT_DATA_FINAL_VENDA : date('Y-m-d');
$dataFormatadaFinal = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataFinal))), 'php:d/m/Y');

$arrHoraFinal = isset($objModelIngresso->TIM_HORA_FINAL_VENDA) ? explode(":", $objModelIngresso->TIM_HORA_FINAL_VENDA, -1 ) : [0=>'09',1=>'00'];

$valorFormatado = number_format($objModelIngresso->DEC_VALOR, 2, ',', '.');

$this->title = 'Ingresso';
?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><i class="fa fa-ticket fa-fw"></i> Ingresso</h1>
		</div>
	</div>
	<div class="row">
		<!-- FORMULÁRIO -->
		<div class="form">
				
			<?php $objFormIngresso = ActiveForm::begin(['id' => 'ingresso-form', 'method' => 'post','layout' => 'default', 'action' => ['ingresso/formulario']]); ?>
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
					<div class="panel panel-default">
						<div class="panel-heading">
							Informação do Ingresso
						</div>

						<div class="panel-body">
							<div class="row">	
								<div class="col-md-6">
								<?= $objFormIngresso->field($objModelIngresso, 'EVENTO_INT_ID_EVENTO', [
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->dropDownList($arrEvento, ['prompt'=>'Selecione...', 'size'=>1]);
								/* ?>
								</div>
								<div class="col-md-3">
								<?= $objFormIngresso->field($objModelIngresso, 'STR_PUBLICACAO', [
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->dropDownList(['PU'=>'Público', 'PR'=>'Privado'], ['prompt'=>'Selecione...', 'size'=>1]);
								?>
								</div>
								<div class="col-md-3">
								<?= $objFormIngresso->field($objModelIngresso, 'INT_PAGAMENTO_ATIVO', [0
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->dropDownList(['1'=>'Sim', '0'=>'Não'], ['prompt'=>'Selecione...', 'size'=>1]);
								*/?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								<?= $objFormIngresso->field($objModelIngresso, 'DAT_DATA_INICIO_VENDA', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaInicio]) ?>
								</div>
								<div class="col-md-3">
									<div class="form-group field-ingresso_hora_inicio">
										<div class="input-group">
											<span class="input-group-addon"><label for="hora_inicio" class="control-label">Hora</label></span>
											<?= Html::dropDownList( 'Ingresso[hora_inicio]', $arrHoraInicio[0], $arrHora, ['prompt'=>'Selecione...', 'id'=>'hora_inicio', 'class'=>'form-control','size'=>1]); ?>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group field-ingresso_min_inicio">
										<div class="input-group">
											<span class="input-group-addon"><label for="min_inicio" class="control-label">Min</label></span>
											<?= Html::dropDownList( 'Ingresso[minuto_inicio]', $arrHoraInicio[1], $arrMinuto, ['prompt'=>'Selecione...', 'id'=>'min_inicio', 'class'=>'form-control', 'size'=>1]); ?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								<?= $objFormIngresso->field($objModelIngresso, 'DAT_DATA_FINAL_VENDA', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatadaFinal]) ?>
								</div>
								<div class="col-md-3">
									<div class="form-group field-ingresso_hora_final">
										<div class="input-group">
											<span class="input-group-addon"><label for="hora_final" class="control-label">Hora</label></span>
											<?= Html::dropDownList( 'Ingresso[hora_final]', $arrHoraFinal[0], $arrHora, ['prompt'=>'Selecione...', 'id'=>'hora_final', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group field-ingresso_min_final">
										<div class="input-group">
											<span class="input-group-addon"><label for="min_final" class="control-label">Min</label></span>
											<?= Html::dropDownList( 'Ingresso[minuto_final]', $arrHoraFinal[1], $arrMinuto, ['prompt'=>'Selecione...', 'id'=>'"min_final', 'class'=>'form-control', 'size'=>1]);
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								<?= $objFormIngresso->field($objModelIngresso, 'INT_QUANTIDADE', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 11]) ?>
								</div>
								<div class="col-md-6">
								<?= $objFormIngresso->field($objModelIngresso, 'INT_QUANTIDADE_MAXIMA_VENDA_PARTICIPANTE', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['maxlength' => 11]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<?= $objFormIngresso->field($objModelIngresso, 'DEC_VALOR', [ 
									'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
								])->textInput(['value'=>$valorFormatado, 'maxlength' => 11, 'class'=>'money form-control']); /*, ['itemOptions' => ['class' =>'radio-inline']] */?> 
								</div>
								<div class="col-md-4">
									<? $checked = (isset($objModelIngresso->STR_INGRESSO_RESTRITO)) ? $objModelIngresso->STR_INGRESSO_RESTRITO :'N';?>
									<div class="form-group field-ingresso-str_ingresso_restrito">
										<label for="ingresso-str_ingresso_restrito" class="control-label"><?= Html::activeLabel($objModelIngresso, "STR_INGRESSO_RESTRITO"); ?></label>
										<div>
											<input type="hidden" value="" name="Ingresso[STR_INGRESSO_RESTRITO]">
											<div id="ingresso-str_ingresso_restrito">
												<label class="radio-inline"><input type="radio" <?= ($checked == 'S') ? 'checked=""' : '';?> value="S" name="Ingresso[STR_INGRESSO_RESTRITO]">Sim</label>
												<label class="radio-inline"><input type="radio" <?= ($checked == 'N') ? 'checked=""' : '';?> value="N" name="Ingresso[STR_INGRESSO_RESTRITO]">Não</label>
											</div>
											<p class="help-block help-block-error"></p>
										</div>										
									</div>
									<?/*= $objFormIngresso->field($objModelIngresso, "STR_INGRESSO_RESTRITO")->inline()->radioList( ['S'=>'Sim', 'N'=>'Não'], ['unselect'=>'N'] );
									echo $objFormIngresso->field($objModelIngresso, "STR_INGRESSO_RESTRITO")->inline()->radioList( ['S'=>'Sim', 'N'=>'Não'], [
											'item' => function ($index, $label, $name, $checked, $value) {
												return '<label class="radio-inline">' . Html::radio($name, $checked , ['value'  => $value ]) . $label . $checked . $index .'</label>';
											}
									]) */ ?>
								</div>
								<div class="col-md-4">
									<? $checkedTaxa = (isset($objModelIngresso->STR_TAXA_SERVICO)) ? $objModelIngresso->STR_TAXA_SERVICO :'S';?>
									<div class="form-group field-ingresso-str_taxa_servico">
										<label for="ingresso-str_taxa_servico" class="control-label"><?= Html::activeLabel($objModelIngresso, "STR_TAXA_SERVICO");?></label>
										<div>
											<input type="hidden" value="N" name="Ingresso[STR_TAXA_SERVICO]">
											<div id="ingresso-str_taxa_servico">
												<label class="radio-inline"><input type="radio" <?= ($checkedTaxa == 'S') ? 'checked=""' : '';?> value="S" name="Ingresso[STR_TAXA_SERVICO]"> Participante</label>
												<label class="radio-inline"><input type="radio" <?= ($checkedTaxa == 'N') ? 'checked=""' : '';?> value="N" name="Ingresso[STR_TAXA_SERVICO]"> Organizador</label>
											</div>
												<p class="help-block help-block-error"></p>
										</div>
									</div>
									<?//= $objFormIngresso->field($objModelIngresso, "STR_TAXA_SERVICO")->inline()->radioList( ['S'=>'Participante', 'N'=>'Organizador'], ['unselect'=>'N'] )
									/*echo $objFormIngresso->field($objModelIngresso, "STR_INGRESSO_RESTRITO")->inline()->radioList( ['S'=>'Sim', 'N'=>'Não'], [
											'item' => function ($index, $label, $name, $checked, $value) {
												$checked = empty($checked) ? true : '';
												return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) . $label . '</label>';
											}
									])*/
									?>
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
							Descrição do Ingresso
						</div>

						<div class="panel-body">
							<div>
							<?php echo $objFormIngresso->field($objModelIngresso, 'STR_DESCRICAO')->label(FALSE)->textArea();?>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<!--div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Voucher
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<?= $objFormIngresso->field($objModelVoucherPromocional, "INT_GERADO_AUTOMATICAMENTE")->inline()->radioList( ['1'=>'Sim', '0'=>'Não'] )  ?>
								</div>
								<div class="col-md-4">
									<?= $objFormIngresso->field($objModelVoucherPromocional, 'INT_QUANTIDADE_LIMITE', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput() ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $objFormIngresso->field($objModelVoucherPromocional, 'STR_CODIGO', [ 
										'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
									])->textInput(['maxlength' => 50]) ?>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div-->
			
			<div class="form-group col-md-12 text-center">
				<?php echo Html::hiddenInput('Hoje', $hoje , ['id'=>'hoje'] );?>
				<?php echo $objFormIngresso->field($objModelIngresso, 'INT_ID_INGRESSO')->label(FALSE)->hiddenInput();?>
				<?php // echo $objFormIngresso->field($objModelEnderecoEvento, 'INT_ID_ENDERECO_EVENTO')->label(FALSE)->hiddenInput();?>
				<?php // echo $objFormIngresso->field($objModelMapsGoogle, 'INT_ID_MAPS_GOOGLE')->label(FALSE)->hiddenInput();?>
				<?= Html::submitInput('Salve seu ingresso', [
						'class' => 'alterar btn btn-primary submit-button ',
						'name' => 'alterar-button']) ?>
			</div>

			<?php ActiveForm::end(); ?>


		</div>
		<!-- /FORMULÁRIO -->
			
	</div>
</div>

<!-- /CONTATO -->