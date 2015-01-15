<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\base\View;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    
    <?php $this->head() ?>
</head>
<body id="home" class="wide body-light">
    <?php $this->beginBody() ?>

    <!-- Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="wrapper">
        <?php /*
            NavBar::begin([
                'brandLabel' => 'Test Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navigation closed clearfix',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => '#home' ],
                ['label' => 'About', 'url' => '#about' ],
                ['label' => 'Schedule', 'url' => '#schedule' ],
                ['label' => 'Sponsors', 'url' => '#sponsors' ],
                ['label' => 'Speakers', 'url' => '#speakers' ],
                ['label' => 'Price', 'url' => '#price' ],
                ['label' => 'Location', 'url' => '#location' ],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
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
            NavBar::end(); */            
        ?>
        <?php echo $this->render('header'); ?>

        <!--div class="container"-->
        <div class="content-area">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>
    <!--footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer-->
    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-meta">
            <div class="container text-center">
                <div class="clearfix">
                    <ul class="social-line list-inline">
                        <li data-animation="flipInY" data-animation-delay="100"><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li data-animation="flipInY" data-animation-delay="200"><a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a></li>
                        <li data-animation="flipInY" data-animation-delay="300"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li data-animation="flipInY" data-animation-delay="400"><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
                        <li data-animation="flipInY" data-animation-delay="500"><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                        <li data-animation="flipInY" data-animation-delay="600"><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                        <li data-animation="flipInY" data-animation-delay="700"><a href="#" class="skype"><i class="fa fa-skype"></i></a></li>
                    </ul>
                </div>
                <span class="copyright" data-animation="fadeInUp" data-animation-delay="100">&copy; 2014 im Event &#8212; An One Page Event Manager Theme made with passion by jThemes Studio</span>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <div class="to-top"><i class="fa fa-angle-up"></i></div>    
    <?php $this->endBody() ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            theme.init();
            theme.initMainSlider();
            theme.initCountDown();
            theme.initPartnerSlider();
            theme.initTestimonials();
            theme.initGoogleMap();
        });
        jQuery(window).load(function () {
            theme.initAnimation();
        });

        jQuery(window).load(function () { jQuery('body').scrollspy({offset: 100, target: '.navigation'}); });
        jQuery(window).load(function () { jQuery('body').scrollspy('refresh'); });
        jQuery(window).resize(function () { jQuery('body').scrollspy('refresh'); });

        jQuery(document).ready(function () { theme.onResize(); });
        jQuery(window).load(function(){ theme.onResize(); });
        jQuery(window).resize(function(){ theme.onResize(); });

        jQuery(window).load(function() {
            if (location.hash != '') {
                var hash = '#' + window.location.hash.substr(1);
                if (hash.length) {
                    jQuery('html,body').delay(0).animate({
                        scrollTop: jQuery(hash).offset().top - 44 + 'px'
                    }, {
                        duration: 1200,
                        easing: "easeInOutExpo"
                    });
                }
            }
        });

    </script>
</body>
</html>
<?php $this->endPage() ?>
