<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\ProdutoContratoSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading">
            <h5 class="panel-title"><i class="fa fa-list "></i> GERENCIAR CONTRATOS</h5>
        </div>
        <div class="box box-success"></div>
            <div class="panel-body">
                <div class="pull-right">       
                    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-primary','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
                    <?= Html::a('<b class="fa fa-plus"></b> Novo', ['create'], ['class' => 'btn btn-success', 'title' => 'Adicionar contrato', ])?>
                    <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
                </div><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'summary' => "Exibindo <strong> {begin}</strong> - <strong>{end}</strong> de <strong>{totalCount}</strong> itens.",
        'columns' => [
            [
                        'class' => 'kartik\grid\ExpandRowColumn',
                        //'width' => '50px','width' => '50px',
                        'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column) {
                            $searchModel = new ProdutoContratoSearch();
                            $searchModel->contrato_id = $model->id;
                            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                            
                            return Yii::$app->controller->renderPartial('_produtocontrato', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]);
                        },
                        //'headerOptions' => ['class' => 'kartik-sheet-style'] 
                        //'expandOneOnly' => true
                    ],

            //'id',
            [
                'attribute' => 'numero',
                'headerOptions' => [
                    'style' => 'width: 200px;'
                ]
            ],
            [
                'attribute' => 'fornecedor_id',
                'value' => 'fornecedor.nome',
                'headerOptions' => [
                    'style' => 'width: 200px;'
                ]
            ],
            

            [
                            'class' => 'kartik\grid\ActionColumn',
                            'header'=>'Ações',
                            'headerOptions'=>['class'=> 'CustomHeader',],
                            'contentOptions' => ['class' => 'text-center'],
                            'template' => '{view}{update}',
                            'buttons' => [
                                'view' => function($url, $model) {
                                    return Html::a('<span class="btn btn-primary"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                                },
                                'update' => function($url, $model) {
                                    return Html::a('<span class="btn btn-success"><b class="glyphicon glyphicon-edit"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Editar contrato', 'id' => 'modal-btn-view']);
                                },
                                'delete' => function($url, $model) {
                                    return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir este contrato?', 'method' => 'post', 'data-pjax' => false],]);
                                }
                            ]

                        ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
 </div>
    </div>
</div>
<style type="text/css">
    .CustomHeader{
        color: #3c8dbc;
        text-align: center;
        width: 15%;
    }
</style>