<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'INT_ID_USUARIO')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'PERFIL_INT_ID_PERFIL')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'STR_NOME_COMPLETO')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'STR_EMAIL')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'STR_SENHA')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
