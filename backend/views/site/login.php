<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
				</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin(['id' => 'login-form',
					'layout' => 'horizontal',
						'fieldConfig' => [
							'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
							'horizontalCssClasses' => [
								'offset' => 'col-sm-offset-0',
								'wrapper' => 'col-sm-12',
								'error' => '',
								'hint' => '',
							],
						],
					]); ?>
						<?= $form->field($model, 'username', [
							'inputOptions' => [ 
								'placeholder' => $model->getAttributeLabel('username')
							]
						])->label(false); ?>
						<?= $form->field($model, 'password', [ 
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('password') 
								]
							])->label(false)->passwordInput() ?>
						<?= $form->field($model, 'rememberMe')->checkbox() ?>
						<div class="form-group">
							<div class="col-sm-12 col-sm-offset-0">
								<?= Html::submitButton('Login', [
									'class' => 'btn btn-lg btn-success btn-block', 
									'name' => 'login-button'
									]
								) ?>
							</div>
						</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
