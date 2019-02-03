<?php

use yii\helpers\Html;
use Kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoPratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="produto-prato-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="fa fa-list "></i> Ingredientes</h5>
        </div>

        <div class="box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'prato_id',
            [
                'label' => 'Ingredientes',
                'value' => 'produto.descricao',
            ],
            [
                'label' => 'Per capita',
                'value' => 'percapita',
            ]
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div>
