<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoPrato */

/*$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produto Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="produto-prato-view">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Dados dos Produtos do Prato </h5>
        </div>
        <div class="panel-body">
            <div class="pull-right">       
                <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
            </div><br><br>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'prato_id',
                    'produto_id',
                    'percapita',
                ],
            ]) ?>
        </div>
    </div>
</div>
