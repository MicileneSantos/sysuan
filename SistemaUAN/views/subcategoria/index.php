<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubcategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoria-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subcategoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Exibindo <strong>{begin} - {end}</strong> de <strong>{totalCount}</strong> itens",
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn',
                'headerOptions' => [
                    'style' => 'width: 20px;'
                ]],*/

            //'id',
            [
                'attribute' => 'categoria_id',
                'value' => 'categoria.descricao',
                'headerOptions' => [
                    'style' => 'width: 300px;'
                ]
            ],
            [
                'attribute' => 'descricao',
                'headerOptions' => [
                    'style' => 'width: 300px;'
                ]

            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Ações',
                'headerOptions'=>['class'=> 'CustomHeader',],
                'template' => '{view_action}{update_action}',
                'buttons' => [
                    'view_action' => function($url, $model) {
                        return Html::a('<span class="btn btn-success"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                    },
                    'update_action' => function($url, $model) {
                        return Html::a('<span class="btn btn-warning"><b class="fa fa-pencil"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Alterar', 'id' => 'modal-btn-view']);
                    },
                                /*'delete_action' => function($url, $model) {
                                    return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir esta categoria?', 'method' => 'post', 'data-pjax' => false],]);
                                }*/
                ],                    

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<style type="text/css">
    .CustomHeader{
        color: #3c8dbc;
        text-align: center;
        width: 25%;
    }
</style>