<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\i18n\Formatter;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
$aniversario =  isset($model->DAT_DATA_NASCIMENTO) ? $model->DAT_DATA_NASCIMENTO : date('Y-m-d');
$dataNascimento = Yii::$app->formatter->asDate($aniversario);
?>

<div class="usuario-form row">

	<?php $form = ActiveForm::begin(['layout' => 'default']); ?>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-3">
		<?= $form->field($model, 'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', [
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList([ 1=>'Participante',2=>'Organizador',3=>'Participante / Organizador'], ['prompt'=>'Selecione', 'id'=>'tipo_cliente', 'size'=>1]);
		?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', [
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList([ 1=>'Pessoa Física',2=>'Pessoa Jurídica'], ['prompt'=>'Selecione', 'id'=>'tipo_pessoa', 'size'=>1]);
		?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'STATUS_INT_ID_STATUS', [
			'template' => '<div class="input-group "><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList([ 1=>'Ativo',2=>'Aguardando',3=>'Inativo',4=>'Cancelado'], ['prompt'=>'Selecione', 'id'=>'status', 'size'=>1]);
		?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-9">
		<?= $form->field($model, 'STR_NOME_COMPLETO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-9">
		<?php echo $form->field($model, 'STR_EMAIL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		]);?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-3">
		<?= $form->field($model, 'STR_SENHA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		]);
		?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'STR_SEXO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->dropDownList( [ 1=>'Masculino',2=>'Feminino'], ['prompt'=>'Selecione', 'id'=>'status', 'size'=>1]);
		?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'DAT_DATA_NASCIMENTO', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 11, 'value'=>Yii::$app->formatter->asDate($dataNascimento, 'php:d/m/Y')]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-3">
		<?= $form->field($model, 'STR_RG', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'STR_CPF', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'STR_CNPJ', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-3">	
		<?= $form->field($model, 'INT_TELEFONE_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'INT_TELEFONE_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'INT_TELEFONE', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-3">
		<?= $form->field($model, 'INT_CELULAR_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'INT_CELULAR_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'INT_CELULAR', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-3">	
		<?= $form->field($model, 'INT_FAX_DDI', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'INT_FAX_DDD', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'INT_FAX', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">		
		<div class="col-md-9">	
		<?= $form->field($model, 'STR_RAZAO_SOCIAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">
		<div class="col-md-9">
		<?= $form->field($model, 'STR_NOME_FANTASIA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>
	<div class="col-md-11 col-md-offset-1">		
		<div class="col-md-4">	
		<?= $form->field($model, 'STR_INSCRICAO_MUNICIPAL', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
		<div class="col-md-5">
		<?= $form->field($model, 'STR_CATEGORIA_EMPRESA', [ 
			'template' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
		])->textInput(['maxlength' => 150]) ?>
		</div>
	</div>

	<div class="form-group col-md-11 text-center">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
