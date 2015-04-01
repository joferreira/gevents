<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\i18n\Formatter;
use common\models\Status;
use common\models\TipoPessoa;
use common\models\TipoCliente;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

$dataNascimento = isset($model->DAT_DATA_NASCIMENTO) ? $model->DAT_DATA_NASCIMENTO : date('Y-m-d');
$dataFormatada = Yii::$app->formatter->asDate( implode("-",array_reverse(explode("/",$dataNascimento))), 'php:d/m/Y');

$status=Status::find()->all();
$listStatus=ArrayHelper::map($status,'INT_ID_STATUS','STR_DESCRICAO_STATUS');

$tipoPessoa=TipoPessoa::find()->all();
$listPessoa=ArrayHelper::map($tipoPessoa,'INT_ID_TIPO_PESSOA','STR_DESCRICAO');

$tipoCliente=TipoCliente::find()->all();
$listCliente=ArrayHelper::map($tipoCliente,'INT_ID_TIPO_CLIENTE','STR_DESCRICAO');

$tpCliente = isset($_GET['intTipoCliente']) ? $_GET['intTipoCliente'] : ''; 
?>

<div class="usuario-form row">

	<?php $form = ActiveForm::begin(['id' => 'cliente-form', 'method' => 'post','layout' => 'default']); ?>
	<div class="col-md-12">	
		<div class="col-md-4">
		<?php 
		$model->TIPO_CLIENTE_INT_ID_TIPO_CLIENTE = $tpCliente;
		echo $form->field($model, 'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', [
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList($listCliente, ['prompt'=>'Selecione...', 'id'=>'tipo_cliente', 'size'=>1],['options' =>[$tpCliente => ['selected' => true] ]]);
		?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', [
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList($listPessoa, ['prompt'=>'Selecione...', 'id'=>'tipo_pessoa', 'size'=>1]);
		?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'STATUS_INT_ID_STATUS', [
			'template' => '<div class="input-group "><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList($listStatus, ['prompt'=>'Selecione...', 'id'=>'status', 'size'=>1]);
		?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12">
		<?= $form->field($model, 'STR_NOME_COMPLETO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 200]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12">
		<?php echo $form->field($model, 'STR_EMAIL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div> {error}',
		])->textInput(['maxlength' => 150]);?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'DAT_DATA_NASCIMENTO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->widget(DatePicker::className(),[ 'language' => 'pt-BR', 'dateFormat' => 'dd/MM/yyyy'])->textInput(['maxlength' => 10, 'value' => $dataFormatada]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'STR_SEXO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList( [ 'M'=>'Masculino','F'=>'Feminino'], ['prompt'=>'Selecione', 'id'=>'status', 'size'=>1]);
		?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'STR_RG', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 10]) ?>
		</div>
	</div>
	<div class="col-md-12">		
		<div class="col-md-6 fisica">
		<?= $form->field($model, 'STR_CPF', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 11]) ?>
		</div>
		<div class="col-md-6 juridica">
		<?= $form->field($model, 'STR_CNPJ', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 14]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'INT_TELEFONE_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 2]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_TELEFONE_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 2]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_TELEFONE', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 8]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'INT_CELULAR_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 2]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_CELULAR_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 2]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_CELULAR', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 9]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">	
		<?= $form->field($model, 'INT_FAX_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 2]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_FAX_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 2]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_FAX', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 8]) ?>
		</div>
	</div>
	<div class="col-md-12 juridica">		
		<div class="col-md-12">	
		<?= $form->field($model, 'STR_RAZAO_SOCIAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 255]) ?>
		</div>
	</div>
	<div class="col-md-12 juridica">
		<div class="col-md-12">
		<?= $form->field($model, 'STR_NOME_FANTASIA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 255]) ?>
		</div>
	</div>
	<div class="col-md-12 juridica">
		<div class="col-md-6">
		<?= $form->field($model, 'STR_INSCRICAO_MUNICIPAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 255]) ?>
		</div>
		<div class="col-md-6">
		<?= $form->field($model, 'STR_CATEGORIA_EMPRESA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 6]) ?>
		</div>
	</div>
	
	<div class="form-group col-md-11 text-center">
		<?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
		$(function () {

			$("#cliente-form").on('change', '#tipo_pessoa', tipoPessoa);
			$("#cliente-form .juridica").hide();
		});

		function tipoPessoa(evt){
			evt.preventDefault();
			var tipo = $(evt.currentTarget);
			var juridica = $("#cliente-form .juridica");
			var fisica = $("#cliente-form .fisica");

			console.log(tipo.val());
			if(tipo.val() == 2){
				fisica.hide();
				juridica.show();
			} else {
				juridica.hide();
				fisica.show();
			} 

			return false;
		}

		function message(message, alert_class, timeout){
			$("#messageBox")
				.removeClass()
				.addClass('messageBox')
				.addClass('alert')
				.addClass(alert_class)
				.html(message)
				.show();

			setTimeout(
				function(){ 
					$('#messageBox').addClass('hidden').hide(); 
				},(!timeout)?3000:timeout
			);
		}

	</script>
