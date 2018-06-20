<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PratoRefeicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prato Refeicaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-refeicao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prato Refeicao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'prato_id',
            'refeicao_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
