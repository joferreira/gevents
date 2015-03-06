<?php
/* @var $this yii\web\View */
$this->title = 'Gigante dos Eventos';
?>
<!-- Content area -->
<?= $this->render('/layouts/slider', ['model'=>$cadastro,]); ?>
<?= $this->render('/layouts/about'); ?>
<?= $this->render('/layouts/login'); ?>
<?= $this->render('/layouts/register', ['model'=>$cadastro,]); ?>
<?= $this->render('/layouts/price'); ?>
<?= $this->render('/layouts/faq'); ?>
<?= $this->render('/layouts/contact', ['model'=>$contato,]); ?>
<!-- /Content area -->
