<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use app\assets\AdminLteAsset;

//AppAsset::register($this);
//$asset      = AdminLteAsset::register($this);
//$baseUrl    = $asset->baseUrl;

$this->title = ' Área do Discente';
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

        <?php

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [

                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);

        ?>

        <hr>
        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="aluno">
                <div  class="box box-danger">
                    <div  class="box-header"><h3 class="box-title"><i class=""></i> Acesso Rápido</h3></div>
                </div>     
            </div>    
        </div>


        <?php $this->endBody() ?>
    </html>
<?php $this->endPage() ?>