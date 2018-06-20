<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use kartik\growl\Growl;

?>
<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>UAN</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sys</b>UAN</span>
          
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"</span>
            <span class="icon-bar"</span>
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
                                        '<span class="glyphicon glyphicon-log-out  "> </span> Sair (' . Yii::$app->user->identity->nome . ')',
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
    <div class="container">
                
        <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
            <?php
            echo Growl::widget([
                'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'SysUAN',
                'icon' => (!empty($message['icon '])) ? $message['icon '] : 'fa fa-info ',
                'body' => (!empty($message['message'])) ? Html::encode($message['message']) : '',
                'showSeparator' => true,
                'delay' => 1, 
                'pluginOptions' => [
                    'delay' => (!empty($message['duration'])) ? $message['duration'] : 1000, 
                    'placement' => [
                        'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                        'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'center',
                    ]
                ]
            ]);
            ?>
        <?php endforeach; ?>
 
    </div>
          