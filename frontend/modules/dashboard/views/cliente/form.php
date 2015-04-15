<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\i18n\Formatter;
use common\models\Status;
use common\models\TipoPessoa;
use common\models\TipoCliente;
use common\models\UnidadeFederal;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

$dataNascimento = isset($objModelCliente->DAT_DATA_NASCIMENTO) ? $objModelCliente->DAT_DATA_NASCIMENTO : date('Y-m-d');
$dataFormatada = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataNascimento))), 'php:d/m/Y');

$status=Status::find()->all();
$listStatus=ArrayHelper::map($status,'INT_ID_STATUS','STR_DESCRICAO_STATUS');

$tipoPessoa=TipoPessoa::find()->all();
$listPessoa=ArrayHelper::map($tipoPessoa,'INT_ID_TIPO_PESSOA','STR_DESCRICAO');

$tipoCliente=TipoCliente::find()->all();
$listCliente=ArrayHelper::map($tipoCliente,'INT_ID_TIPO_CLIENTE','STR_DESCRICAO');

$estados=UnidadeFederal::find()->all();
$listEstados=ArrayHelper::map($estados,'INT_ID_UNIDADE_FEDERAL','STR_SIGLA_UNIDADE_FEDERAL');

$this->title = 'Informações do Cliente';
?>
<div id="page-wrapper" class="usuario-update">
	<div class="row">
		<h3></h3>
	</div>

	<div class="row">

		<div class="usuario-form row">

			<?php $objFormCliente = ActiveForm::begin(['id' => 'cliente-form', 'method' => 'post','layout' => 'default']); ?>
			<div class="col-md-12">	
				<div class="col-md-4">
				<?php 
				echo $objFormCliente->field($objModelCliente, 'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', [
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->dropDownList($listCliente, ['prompt'=>'Selecione...', 'id'=>'tipo_cliente', 'size'=>1]);
				?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', [
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->dropDownList($listPessoa, ['prompt'=>'Selecione...', 'id'=>'tipo_pessoa', 'size'=>1]);
				?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-12">
				<?= $objFormCliente->field($objModelCliente, 'STR_NOME_COMPLETO', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 200]) ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-12">
				<?php echo $objFormCliente->field($objModelCliente, 'STR_EMAIL', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div> {error}',
				])->textInput(['maxlength' => 150]);?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'DAT_DATA_NASCIMENTO', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatada]) ?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'STR_SEXO', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->dropDownList( [ 'M'=>'Masculino','F'=>'Feminino'], ['prompt'=>'Selecione', 'id'=>'status', 'size'=>1]);
				?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'STR_RG', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 10]) ?>
				</div>
			</div>
			<div class="col-md-12">		
				<div class="col-md-6 fisica">
				<?= $objFormCliente->field($objModelCliente, 'STR_CPF', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 11]) ?>
				</div>
				<div class="col-md-6 juridica">
				<?= $objFormCliente->field($objModelCliente, 'STR_CNPJ', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 14]) ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_TELEFONE_DDI', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 2]) ?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_TELEFONE_DDD', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 2]) ?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_TELEFONE', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 8]) ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_CELULAR_DDI', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 2]) ?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_CELULAR_DDD', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 2]) ?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_CELULAR', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 9]) ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4">	
				<?= $objFormCliente->field($objModelCliente, 'INT_FAX_DDI', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 2]) ?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_FAX_DDD', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 2]) ?>
				</div>
				<div class="col-md-4">
				<?= $objFormCliente->field($objModelCliente, 'INT_FAX', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 8]) ?>
				</div>
			</div>
			<div class="col-md-12 juridica">		
				<div class="col-md-12">	
				<?= $objFormCliente->field($objModelCliente, 'STR_RAZAO_SOCIAL', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
			<div class="col-md-12 juridica">
				<div class="col-md-12">
				<?= $objFormCliente->field($objModelCliente, 'STR_NOME_FANTASIA', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
			<div class="col-md-12 juridica">
				<div class="col-md-6">
				<?= $objFormCliente->field($objModelCliente, 'STR_INSCRICAO_MUNICIPAL', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 255]) ?>
				</div>
				<div class="col-md-6">
				<?= $objFormCliente->field($objModelCliente, 'STR_CATEGORIA_EMPRESA', [ 
					'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
				])->textInput(['maxlength' => 6]) ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4">
					<?= $objFormCliente->field($objModelEndereco, 'INT_CEP', [ 
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->textInput(['maxlength' => 8]) ?>
				</div>
				<div class="col-md-4">
					<?= $objFormCliente->field($objModelEndereco, 'STR_CAIXA_POSTAL', [ 
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->textInput(['maxlength' => 10]) ?>
				</div>
			</div>
			<div class="col-md-12">	
				<div class="col-md-4">
					<?php 
					echo $objFormCliente->field($objModelEndereco, 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL', [
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->dropDownList($listEstados, ['prompt'=>'Selecione...', 'id'=>'unidade_federal', 'size'=>1]);
					?>
				</div>	
				<div class="col-md-4">
					<?= $objFormCliente->field($objModelEndereco, 'STR_MUNICIPIO', [ 
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->textInput(['maxlength' => 150]) ?>
				</div>
				<div class="col-md-4">	
					<?= $objFormCliente->field($objModelEndereco, 'STR_BAIRRO', [ 
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->textInput(['maxlength' => 150]) ?>
				</div>
			</div>
			<div class="col-md-12">	
				<div class="col-md-12">
					<?= $objFormCliente->field($objModelEndereco, 'STR_ENDERECO', [ 
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->textInput(['maxlength' => 255]) ?>
				</div>	
			</div>
			<div class="col-md-12">	
				<div class="col-md-4">	
					<?= $objFormCliente->field($objModelEndereco, 'STR_NUMERO', [ 
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->textInput(['maxlength' => 10]) ?>
				</div>
				<div class="col-md-8">
					<?= $objFormCliente->field($objModelEndereco, 'STR_COMPLEMENTO', [ 
						'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
					])->textInput(['maxlength' => 150]) ?>
				</div>
			</div>
			
			<div class="form-group col-md-11 text-center">
				<?php echo $objFormCliente->field($objModelEndereco, 'INT_ID_ENDERECO')->label(FALSE)->hiddenInput()?>
				<?= Html::button('Gravar', [
						'class' => 'alterar btn btn-primary submit-button ',
						'name' => 'alterar-button']) ?>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>
<script type="text/javascript">

	var juridica = $("#cliente-form .juridica");
	var fisica = $("#cliente-form .fisica");

	$(function () {
		var tipo = $("#tipo_pessoa");

		if(tipo.val() == 2){
			fisica.hide();
			juridica.show();
		} else if(tipo.val() == 1) {
			juridica.hide();
			fisica.show();
		} else {
			juridica.hide();
			fisica.hide();
		}

		$("#cliente-form").on('change', '#tipo_pessoa', tipoPessoa);
		
	});

	function tipoPessoa(evt){
		evt.preventDefault();
		var tipo = $(evt.currentTarget);

		if(tipo.val() == 2){
			fisica.hide();
			juridica.show();
		} else if(tipo.val() == 1) {
			juridica.hide();
			fisica.show();
		} else {
			juridica.hide();
			fisica.hide();
		}

		return false;
	}

	function validarCPF_CNPJ(){
		var cnpj = $("#cliente-str_cnpj");
		var cpf = $("#cliente-str_cpf");
		var razao = $("#cliente-str_razao_social");

		console.log( cpf.val().length );

		var tipo = $("#tipo_pessoa");

		if(tipo.val() == 2){
			if( cnpj.val() == '' || cnpj.val() == 0 || cnpj.val().length < 14  ){			
				message('Favor preencher o campo CNPJ corretamente', 'alert-danger');
				$('.field-cliente-str_cnpj').addClass('has-error');
				return false;
			}
			if( razao.val() == '' || razao.val() == 0 ){			
				message('Favor preencher o campo Razão Social corretamente', 'alert-danger');
				$('.field-cliente-str_razao_social').addClass('has-error');
				return false;
			}

		} else if(tipo.val() == 1) {
			if( cpf.val() == '' || cpf.val() == 0 || cpf.val().length < 11 ){
				message('Favor preencher o campo CPF corretamente', 'alert-danger');
				$('.field-cliente-str_cpf').addClass('has-error');
				return false;
			}
		}

		return true;

	}


	</script>
