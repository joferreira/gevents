<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UsarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'INT_ID_USUARIO') ?>

    <?= $form->field($model, 'PERFIL_INT_ID_PERFIL') ?>

    <?= $form->field($model, 'STR_NOME_COMPLETO') ?>

    <?= $form->field($model, 'STR_EMAIL') ?>

    <?= $form->field($model, 'STR_SENHA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
