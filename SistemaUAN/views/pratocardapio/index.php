<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PratoCardapioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prato Cardapios';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-cardapio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prato Cardapio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'prato_id',
            'cardapio_id',
            'data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
