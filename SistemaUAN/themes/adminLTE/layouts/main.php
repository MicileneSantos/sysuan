 <?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\themes\adminLTE\assets\AdminlteAsset;
use \yii\debug\models\search\User;
use adminlte\widgets\Menu;
//use app\themes\adminLTE\components\ThemeNav;
use \kartik\growl\Growl;

/* @var $this \yii\web\View */
/* @var $content string */
AdminlteAsset::register($this);
AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<title>SysUAN | Início</title>
<link rel="shortcut icon" href="<?= yii\helpers\Url::to('@web/img/uan.ico') ?>" type="image/x-icon">
<link rel="icon" href="<?= yii\helpers\Url::to('@web/img/uan.ico') ?>" type="image/x-icon">
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-green sidebar-mini">

        <?php $this->beginBody() ?>
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a img src="web\img\if.png" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>UAN</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Sys</b>UAN</span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <div class="navbar-custom-menu">
                                <?php 
                        echo Nav::widget([
                            'options' => ['class' => 'nav navbar-nav'], //'navbar-fixed-top' 'navbar-right'],'navbar-nav navbar-right'],
                            'items' => [
                                ['label' => 'PÁGINA INICIAL', 'url' => ['/site/index'],'visible' => Yii::$app->user->isGuest],
                                ['label' => 'INÍCIO', 'url' => ['/site/nutricionista'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2],
                                ['label' => 'INÍCIO', 'url' => ['/site/admin'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role==1],
                                ['label' => 'INÍCIO', 'url' => ['/site/discente'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role==3],
                                ['label' => 'SOBRE', 'url' => ['/site/about'],'visible' => Yii::$app->user->isGuest],
                                ['label' => 'CADASTRE-SE', 'url' => ['/usuarios/create'],'visible' => Yii::$app->user->isGuest],
                                Yii::$app->user->isGuest ? (
                                    ['label' => 'LOGIN', 'icon' => 'fa fa-user', 'url' => ['/site/login']]
                                ) : (
                                    '<li>'
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        '<span class="glyphicon glyphicon-log-out  "> </span> SAIR (' . Yii::$app->user->identity->nome . ')',
                                        ['class' => 'btn btn-success logout']
                                    )
                                    . Html::endForm()
                                    . '</li>'
                                )
                            ],
                        ]);
                    ?>
                            </div>

                        </ul>
                    </div>
                </nav>
            </header> 
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?= Html::img('@web/img/if.png', ['class' => 'img', 'alt' => 'User Image']) ?>
                        </div>
                        <div class="pull-left info">
                            <p>
                                <?php
                                $info[] = Yii::t('app', '');

                                if (isset(Yii::$app->user->identity->nome)) {
                                    $info[] = ucfirst(\Yii::$app->user->identity->nome);
                                }

                                echo implode(' ', $info);
                                ?>
                            </p>
                            <a href="https://www.ifnmg.edu.br/"><i class="fa text-success"></i> IFNMG - JANUÁRIA</a>
                        </div>

                    </div>
                    <!-- search form -->
                    <!--form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->


                    <?=
            Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'MENU', 'options' => ['class' => 'header'],],// 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role!=3],
                        //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'SUGESTÕES', 'icon' => 'fa fa-comments-o','url' => ['/sugestoes/create'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role==3],
                        ['label' => 'CARDÁPIO', 'icon' => 'fa fa-cutlery','url' => ['/site'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role==3],
                        ['label' => 'CARDÁPIO','icon' => 'fa fa-cutlery','url' => ['/site'], 'visible' => Yii::$app->user->isGuest],
                        //Menu Usuários 
                        [
                            'label' => 'USUÁRIOS',
                            'icon' => 'fa fa-user',
                            'url' => '?r=usuarios/index/', 
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==1,
                        ],
                        //Menu Backup
                        [
                            'label' => 'BACKUP',
                            'icon' => 'fa fa-database',
                            'url' => ['/backuprestore/index'], 
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==1,
                        ],
                        //Menu Fornecedores
                        [
                            'label' => 'FORNECEDORES',
                            'icon' => 'fa fa-users',
                            'url' => '?r=fornecedor/index/',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                        ],
                        //Produtos
                        [
                            'label' => 'PRODUTOS',
                            'icon' => 'fa fa-cubes',
                            'url' => '?r=produto/index/',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                        ],
                        //Contratos
                        [
                            'label' => 'CONTRATOS',
                            'icon' => 'fa fa-list-alt',
                            'url' => '?r=contrato/index/',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                        ],
                        //Menu Estoque
                        [
                            'label' => 'ESTOQUE',
                            'icon' => 'fa fa-cubes',
                            'url' => '?r=estoque/index/',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                        ],
                        //Menu Pratos 
                        [
                            'label' => 'PRATOS',
                            'icon' => 'fa fa-coffee',
                            'url' => '?r=prato/index/',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                        ],
                        //Menu Cardápio
                        [
                            'label' => 'CARDÁPIOS',
                            'icon' => 'fa fa-cutlery',
                            'url' => '?r=cardapios/index/',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                        ],
                         //Menu Notícias
                        [
                            'label' => 'NOTÍCIAS',
                            'icon' => 'fa fa-list-ul',
                            'url' => '?r=noticias/index/',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                        ],
                        //Menu Relatórios
                        /*[
                            'label' => 'RELATÓRIOS',
                            'icon' => 'fa fa-file-pdf-o',
                            'url' => '#',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                            'items' => [
                                ['label' => 'CONSUMO', 'icon' => 'fa fa-file-pdf-o', 'url' => '?r=', 'active' => $this->context->route == '',],
                                ['label' => 'ESTOQUE', 'icon' => 'fa fa-list', 'url' => '?r=/', 'active' => $this->context->route == '',],
                            ],
                        ],*/
                        //configurações
                        [
                            'label' => 'CONFIGURAÇÕES',
                            'icon' => 'fa fa-cog',
                            'url' => '#',
                            'visible'=> !Yii::$app->user->isGuest && Yii::$app->user->identity->role==2,
                            'items' => [
                                [
                                    'label' => 'CATEGORIAS',
                                    'icon' => 'fa fa-list-alt',
                                    'url' => '?r=categoria/index/',
                                    'active' => $this->context->route == 'categoria/index'
                                ],
                                [
                                    'label' => 'UNIDADES DE MEDIDA',
                                    'icon' => 'fa fa-cubes',
                                    'url' => '?r=unidade/index/',
                                    'active' => $this->context->route == 'unidade/index'
                                ],
                                [
                                    'label' => 'REFEIÇÕES',
                                    'icon' => 'fa fa-cutlery',
                                    'url' => '?r=refeicao/index/',
                                    'active' => $this->context->route == 'refeicao/index'
                                ],
                            ],    
                        ],
                    ],
                ]
            )
        ?>
                    
                </section>

                <!-- /.sidebar -->
            </aside>
            

            <div class="content-wrapper">
                <?= $content ?>
                <div class="container">


                    <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
                        <?php
                        echo Growl::widget([
                            'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : '',
                            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : '',
                            'showSeparator' => true,
                            'delay' => 1,
                            'pluginOptions' => [
                                'delay' => (!empty($message['duration'])) ? $message['duration'] : 20000,
                                'placement' => [
                                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                                ]
                            ]
                        ]);
                        ?>
                    <?php endforeach; ?>

                </div>
            </div>
        </section><!-- /.content -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Versão</b> 1.0
            </div>
            <strong>IFNMG - Januária &copy; <?php echo date('Y'); ?> <a href="#">by SysUAN</a>.</strong> Todos os direitos reservados.
        </footer>
    </div>
    <?php $this->endBody() ?>
</body>
</body>
</html>
<?php $this->endPage() ?>
