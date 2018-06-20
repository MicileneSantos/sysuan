<?php

use yii\helpers\Html;
use Kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoPratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Produto Pratos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-prato-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Create Produto Prato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'prato_id',
            [
                'label' => 'Ingredientes',
                'value' => 'produto.descricao',
            ],
            [
                'label' => 'Per capita',
                'value' => 'percapita',
            ],
            

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
