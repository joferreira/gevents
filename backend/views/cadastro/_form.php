<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\i18n\Formatter;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
$dataNascimento = Yii::$app->formatter->asDate($model->DAT_DATA_NASCIMENTO);
?>

<div class="usuario-form">

	<?php $form = ActiveForm::begin(); ?>
	<div class="row">
	<?= $form->field($model, 'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' )->dropDownList(
			[ 1=>'Participante',2=>'Organizador',3=>'Participante / Organizador'], ['prompt'=>'Selecione', 'id'=>'tipo_cliente', 'size'=>1]);
	?>
	<?= $form->field($model, 'TIPO_PESSOA_INT_ID_TIPO_PESSOA' )->dropDownList(
			[ 1=>'Pessoa Física',2=>'Pessoa Jurídica'], ['prompt'=>'Selecione', 'id'=>'tipo_pessoa', 'size'=>1]);
	?>
	<?= $form->field($model, 'STATUS_INT_ID_STATUS' )->dropDownList(
			[ 1=>'Ativo',2=>'Aguardando',3=>'Inativo',4=>'Cancelado'], ['prompt'=>'Selecione', 'id'=>'status', 'size'=>1]);
	?>
	</div>
	<div class="row">
	<?php echo $form->field($model, 'STR_EMAIL', [
	     'inputTemplate' => '<div class="input-group"><span class="input-group-addon">{label}</span>{input}</div>',
	 ]);
	?>
	</div>
	<?= $form->field($model, 'STR_NOME_COMPLETO')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'STR_SEXO' )->dropDownList(
			[ 1=>'Masculino',2=>'Feminino'], ['prompt'=>'Selecione', 'id'=>'status', 'size'=>1]);
	?>
	<?= $form->field($model, 'STR_EMAIL')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'DAT_DATA_NASCIMENTO')->textInput(['maxlength' => 11, 'value'=>Yii::$app->formatter->asDate($model->DAT_DATA_NASCIMENTO)]) ?>
	<?= $form->field($model, 'STR_CPF')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'STR_CNPJ')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'STR_RG')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_TELEFONE_DDI')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_TELEFONE_DDD')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_TELEFONE')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_CELULAR_DDI')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_CELULAR_DDD')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_CELULAR')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_FAX_DDI')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_FAX_DDD')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'INT_FAX')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'STR_RAZAO_SOCIAL')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'STR_NOME_FANTASIA')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'STR_INSCRICAO_MUNICIPAL')->textInput(['maxlength' => 150]) ?>
	<?= $form->field($model, 'STR_CATEGORIA_EMPRESA')->textInput(['maxlength' => 150]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
