<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\models\ProdutoPrato;

/* @var $this yii\web\View */
/* @var $model app\models\Prato */
/* @var $modelProduto app\models\ProdutoPrato */

//$this->title = 'Visualização de dados cadastrados';
//$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="prato-view">

    <div class="panel panel-success">
        <div class="panel-heading">
        <h5 class="panel-title">Dados do Prato</h5>
        </div>
        <div class="panel-body">
            <div class="pull-right">       
                <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
            </div><br><br>
            <?php //$this->render('form',['modelProduto'=>$modelProduto])?>
            
            <?= DetailView::widget([

                'model' => $model,
                'attributes' => [
                    
                    'descricao',
                        
                ],
            ])?>
            
        </div>
    </div>
</div>
