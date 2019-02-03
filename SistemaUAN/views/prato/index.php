<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\ProdutoPratoSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ''//'Pratos cadastrados';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['web/prato/gerar']),
    'method' => 'get',
]);?>


<div class="prato-index">
    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-list "></i> GERENCIAR PRATOS</h5></div>
        <div class="box box-success">
            <div class="panel-body">
                <div class="pull-right">       
                    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-primary','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
                    <?= Html::a('<b class="fa fa-plus"></b> Novo', ['prato/create'], ['class' => 'btn btn-success', 'title' => 'Adicionar prato', ])?>
                    <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
                </div><br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'emptyCell'=> "-",
                'summary' => "Exibindo <strong> {begin}</strong> - <strong>{end}</strong> de <strong>{totalCount}</strong> itens.",
                //'export' => true,
                'columns' => [
                    [
                        'class' => 'kartik\grid\ExpandRowColumn',
                        //'width' => '50px','width' => '50px',
                        'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column) {
                            $searchModel = new ProdutoPratoSearch();
                            $searchModel->prato_id = $model->id;
                            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                            
                            return Yii::$app->controller->renderPartial('_produtoprato', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]);
                        },
                        //'headerOptions' => ['class' => 'kartik-sheet-style'] 
                        //'expandOneOnly' => false,
                    ],
                    //'id',
                    [
                        'attribute' => 'descricao',
                        'headerOptions' => [
                            'style' => 'width: 400px;'
                        ]
                    ],
                    
                    /*[
                        'attribute' => 'produto_id',
                        'value' => 'produtoPratos.produto_id',
                        'headerOptions' => [
                            'style' => 'width: 200px;'
                        ]
                    ],*/
                    
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header'=>'Ações',
                        'headerOptions'=>['class'=> 'CustomHeader',],
                        'template' => '{view}{update}{delete}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('<span class="btn btn-primary"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                            },
                            'update' => function($url, $model) {
                                return Html::a('<span class="btn btn-success"><b class="glyphicon glyphicon-edit"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Editar prato', 'id' => 'modal-btn-view']);
                            },       
                            'delete' => function($url, $model) {
                                return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir este prato?', 'method' => 'post', 'data-pjax' => false],]);
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
        width: 25%;
    }
</style>