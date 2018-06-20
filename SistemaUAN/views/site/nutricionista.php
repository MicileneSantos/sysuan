<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use app\assets\AdminLteAsset;
use yii\bootstrap\Modal;

//AppAsset::register($this);
//$asset      = AdminLteAsset::register($this);
//$baseUrl    = $asset->baseUrl;

$this->title = 'Área da Nutricionista';
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
                            . 
                            '</li>'
                        )
                    ],
                ]);

            ?>

            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                <div class="nutri">
                    <div  class="box box-primary">
                        <div  class="box-header"><h3 class="box-title"><i class=""></i> Acesso Rápido</h3></div>
                    </div>     
                </div>    
            </div>

            <div class="col-xs-6 col-sm-6 col-lg-2 no-padding">
                <!--div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">Sugestões recebidas</h3></div></div-->
            </div>
            
        
        <?php $this->endBody() ?>
    </html>
<?php $this->endPage()?>


