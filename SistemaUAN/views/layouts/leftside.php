<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php //Html::img('@web/img/if.png', ['class' => 'img', 'alt' => 'User Image']) ?>
                <!--img src="img/if.png" align="left" width="60" height="50"/-->
                
            </div>
            <div class="pull-left info">
                
                <p><br><a href="https://www.ifnmg.edu.br/">IFNMG - JANUÁRIA</a></p>
                
            </div>
        </div>
        
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
