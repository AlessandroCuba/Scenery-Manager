<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use frontend\assets\ThemeAsset;
use yeesoft\models\Menu;
use yeesoft\widgets\LanguageSelector;
//use yeesoft\widgets\Nav as Navigation;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

Yii::$app->assetManager->forceCopy = true;
AppAsset::register($this);
ThemeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
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
    <header class ="page-heading">
        <div class="container">
            <h1 class="heading"><?= Yii::$app->settings->get('general.title', 'Yee Site', Yii::$app->language) ?></h1>
            <h4>Free Sceneries for you Flight Simulator</h4>
        </div>
    </header>
    <!-- Page Content -->
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
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#1d8a8a"
    },
    "button": {
      "background": "#62ffaa"
    }
  },
  "theme": "edgeless",
  "position": "bottom-right"
})});
</script>