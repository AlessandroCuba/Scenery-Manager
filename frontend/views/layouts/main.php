<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\ThemeAsset;
use yeesoft\models\Menu;
use yeesoft\widgets\LanguageSelector;
use yeesoft\widgets\Nav as Navigation;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yeesoft\comment\widgets\RecentComments;
use webcreator\revslider\Widget as Slider;
use wadeshuler\sliderrevolution\SliderRevolution;

Yii::$app->assetManager->forceCopy = true;
AppAsset::register($this);
ThemeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php //= Yii::$app->language? Yii::$app->language : 'es' ?> es">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <?= $this->renderMetaTags() ?>
        <?php $this->head() ?>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
    <?php $this->beginBody() ?>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->settings->get('general.title', 'Yee Site', Yii::$app->language),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'role' => "navigation"
        ],
    ]);
    $menuItems = Menu::getMenuItems('main-menu');
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('yee/auth', 'Signup'), 'url' => \yii\helpers\Url::to(['/auth/default/signup'])];
        $menuItems[] = ['label' => Yii::t('yee/auth', 'Login'), 'url' => ['/auth/default/login']];
    } else {
        $menuItems[] = [
            'label' => Yii::$app->user->identity->username,
            'url' => ['/auth/default/profile'],
        ];

        $menuItems[] = [
            'label' => Yii::t('yee/auth', 'Logout'),
            'url' => ['/auth/default/logout', 'language' => false],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    
    echo LanguageSelector::widget(['display' => 'label', 'view' => 'pills']);

    NavBar::end();
    ?>
    
    <!--====== Slider Revolution ======= -->
    <header id="carousel" class="carousel">
        <?=$this->render('@frontend/views/layouts/_sliderRevolution'); ?>
    </header>
    
    <!--====== Content ======= -->
    <div class="container">
        <?= $content ?>
    </div>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
    <div class="container">
            <div class="col-lg-12">
                <p class="pull-left">&copy; <?= Html::encode(Yii::$app->settings->get('general.title', 'Yee Site', Yii::$app->language)) ?> <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?>, <?= yeesoft\Yee::powered() ?></p>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
