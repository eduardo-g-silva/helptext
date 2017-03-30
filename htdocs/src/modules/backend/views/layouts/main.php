<?php

use dmstr\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = $this->title . ' [HelpText Backend]';
\app\modules\backend\assets\AdminAsset::register($this);


$bundle = AppAsset::register($this);
$imgPath = $bundle->baseUrl;
$imgClientPath = \Yii::$app->settings->get('design.icons_folder');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $imgPath; ?>/img/icons/<?php echo $imgClientPath; ?>/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?php echo $imgPath; ?>/img/icons/<?php echo $imgClientPath; ?>/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo $imgPath; ?>/img/icons/<?php echo $imgClientPath; ?>/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo $imgPath; ?>/img/icons/<?php echo $imgClientPath; ?>/manifest.json">
        <meta name="theme-color" content="#ffffff">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <?php $this->head() ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="hold-transition skin-black sidebar-mini">
        <?php $this->beginBody() ?>

        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= \Yii::$app->homeUrl ?>" class="logo"><?= getenv('APP_TITLE') ?></a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?php if (!\Yii::$app->user->isGuest): ?>
                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="glyphicon glyphicon-user"></i>
                                        <span><?= \Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header bg-light-blue">
                                            <?php
                                            echo \cebe\gravatar\Gravatar::widget(
                                                    [
                                                        'email' => (\Yii::$app->user->identity->profile->gravatar_email === null) ? \Yii::$app->user->identity->email : \Yii::$app->user->identity->profile->gravatar_email,
                                                        'options' => [
                                                            'alt' => \Yii::$app->user->identity->username,
                                                        ],
                                                        'size' => 128,
                                                    ]
                                            );
                                            ?>
                                            <p>
                                                <?= \Yii::$app->user->identity->username ?>
                                                <small><?= \Yii::$app->user->identity->email ?></small>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?= \yii\helpers\Url::to(['/user/settings/profile']) ?>"
                                                   class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?= \yii\helpers\Url::to(['/user/security/logout']) ?>"
                                                   class="btn btn-default btn-flat" data-method="post">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <?= $this->render('_sidebar') ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div id ='breadcrubs-admin'>
                    <?=
                    \yii\widgets\Breadcrumbs::widget(
                            [
                                'homeLink' => ['label' => 'Admin Home', 'url' => ['/backend']],
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]
                    )
                    ?>
                    </div>
                </section>

                <!-- Main content -->

                <section class="content">
                    <?= Alert::widget() ?>
<?= $content ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>
<?= getenv('APP_NAME') ?>-<?= APP_VERSION ?></strong> 
                developed by 
                <a href="https://helptext.uk/" target="_blank">helptext an open-ecommerce.org product</a>
            </footer>
        </div>
        <!-- ./wrapper -->

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
