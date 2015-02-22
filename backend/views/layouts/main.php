<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="wrap">
		<?php
		/*
			NavBar::begin([
				'brandLabel' => 'My Company',
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			$menuItems = [
				['label' => 'Home', 'url' => ['/site/index']],
			];
			if (Yii::$app->user->isGuest) {
				$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
			} else {
				$menuItems[] = [
					'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
					'url' => ['/site/logout'],
					'linkOptions' => ['data-method' => 'post']
				];
			}
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => $menuItems,
			]);
			NavBar::end();
			*/
		?>
		<?php
		if (!\Yii::$app->user->isGuest) {
			echo $this->render('menu');
		}
		  ?>
		<div id="wrapper">
		<?= Breadcrumbs::widget([ 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>
		<?= $content ?>
		</div>
	</div>
	<div class="text-center" style="left:20%; position:absolute; top:45%; width:60%; z-index:10;">
		<?php if (Yii::$app->session->hasFlash('success')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-success',
				],
				'body' => Yii::$app->session->getFlash('success'),
			]);
				//echo Yii::$app->session->getFlash('success');
		elseif (Yii::$app->session->hasFlash('error')):
			echo Alert::widget([
				'options' => [
					'class' => 'alert-danger',
				],
				'body' => Yii::$app->session->getFlash('error'),
			]);
		 ?>
		<?php endif; ?>
	</div>

	<footer class="footer">
		<div class="container">
		<p class="pull-left">&copy; Gigante dos Eventos <?= date('Y') ?></p>
		<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
