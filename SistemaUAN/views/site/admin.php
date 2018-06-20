<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $model app\models\User */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use app\assets\AdminLteAsset;

//AppAsset::register($this);
//$asset      = AdminLteAsset::register($this);
//$baseUrl    = $asset->baseUrl;

$this->title = 'Área Administrativa';
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
    
    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
        <div class="admin">
            <div  class="box box-success">
                <div  class="box-header"><h3 class="box-title"><i class=""></i> Acesso Rápido</h3></div>
            </div>
        </div>
    </div>

    <?php //echo Yii::$app->view->render('@app/views/usuarios/index.php');?>
        
    <!--div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
        <div class="widget-estoque">
            <div  class="box box-danger">
        <div  class="box-header"><h3 class="box-title"><i class=""></i> Estoque</h3></div>
        <div class="box-body">        <div class="nav-tabs-custom"> 
                <ul id="w2" class="nav nav-tabs"><li class="active"><a href="#w2-tab0" data-toggle="tab">Estoque - Entrada</a></li>
        <li><a href="#w2-tab1" data-toggle="tab">Estoque - Saída</a></li></ul>
                <div class="tab-content"><div id="w2-tab0" class="tab-pane active"><div class="panel panel-warning"><div class="panel-heading"><h3 class="panel-title">Nenhum Aniversário hoje.</h3></div>
        </div></div></div></div></div></div></div></div-->


<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>


