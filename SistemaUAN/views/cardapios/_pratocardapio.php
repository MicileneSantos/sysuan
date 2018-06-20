<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PratoCardapioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Prato Cardapios';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-cardapio-index">

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label' => 'Pratos',
                'value' => 'prato.descricao',
            ],
            //'prato_id',
            //'cardapio_id',
            //'data',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
