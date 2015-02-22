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
?>

<div class="usuario-form row">

	<?php $form = ActiveForm::begin(['id' => 'cliente-form', 'method' => 'post','layout' => 'default', 'action' => ['cliente/create']]); ?>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', [
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList($listCliente, ['prompt'=>'Selecione...', 'id'=>'tipo_cliente', 'size'=>1]);
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
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12">
		<?php echo $form->field($model, 'STR_EMAIL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		]);?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'STR_SENHA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		]);
		?>
		</div>
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
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'STR_RG', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'STR_CPF', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'STR_CNPJ', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'INT_TELEFONE_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_TELEFONE_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_TELEFONE', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($model, 'INT_CELULAR_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_CELULAR_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_CELULAR', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">	
		<?= $form->field($model, 'INT_FAX_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_FAX_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'INT_FAX', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">		
		<div class="col-md-12">	
		<?= $form->field($model, 'STR_RAZAO_SOCIAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12">
		<?= $form->field($model, 'STR_NOME_FANTASIA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-6">
		<?= $form->field($model, 'STR_INSCRICAO_MUNICIPAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-6">
		<?= $form->field($model, 'STR_CATEGORIA_EMPRESA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4">
		<?= $form->field($endereco, 'INT_CEP', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($endereco, 'STR_CAIXA_POSTAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">	
		<div class="col-md-12">
		<?= $form->field($endereco, 'STR_ENDERECO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>	
	</div>
	<div class="col-md-12">	
		<div class="col-md-4">	
		<?= $form->field($endereco, 'STR_NUMERO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-8">
		<?= $form->field($endereco, 'STR_COMPLEMENTO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-12">	
		<div class="col-md-4">
		<?= $form->field($endereco, 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>	
		<div class="col-md-4">
		<?= $form->field($endereco, 'STR_MUNICIPIO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-4">	
		<?= $form->field($endereco, 'STR_BAIRRO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>		
	</div>

	<div class="form-group col-md-11 text-center">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
