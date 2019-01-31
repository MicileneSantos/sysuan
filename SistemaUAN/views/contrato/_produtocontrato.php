<?php

use yii\helpers\Html;
use Kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoContratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Produto Pratos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-contrato-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Create Produto Prato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'prato_id',
            [
                'label' => 'Produto',
                'value' => 'produto.descricao',
            ],
            'unidade_id',
            'marca',
            'valoruni',
            'quantidade',
            //'contrato_id',
            

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
