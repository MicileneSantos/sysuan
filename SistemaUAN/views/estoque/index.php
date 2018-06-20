<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EstoqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movimentos de Estoque';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['estoques/gerar']),
    'method' => 'get',
]);?>

<div class="pull-right">       
    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
    <?= Html::a('<b class="fa fa-plus"></b> Novo', ['create'], ['class' => 'btn btn-success' ])?>
    <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
</div>
<hr>
<div class="estoque-index">

    <?php //Pjax::begin();?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading">
            <h5 class="panel-title">MOVIMENTAÇÕES DE ESTOQUE</h5>
        </div>
        <div class="box box-success"></div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => "Exibindo {begin} - {end} de {totalCount} itens",
                    'rowOptions'=> function($model){
                        if ($model->tipolanc == 'Entrada'){
                            return ['class'=>'success'];
                        } else {
                            return ['class'=>'danger'];
                        }         
                    },
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        
                        [
                            'attribute' => 'tipolanc',
                            'headerOptions' => [
                                'style' => 'width: 110px;'
                            ]

                        ],
                        [
                            'attribute' => 'produto_id',
                            'value' => 'produto.descricao',
                            'headerOptions' => [
                                'style' => 'width: 110px;'
                            ]

                        ],
                        [
                            'attribute' => 'qtde',
                            'headerOptions' => [
                                'style' => 'width: 110px;'
                            ]

                        ],
                        [
                            'label'=>'Data',
                            'format' => 'raw', 
                            'headerOptions' => [
                                'style' => 'width: 110px;'
                            ],
                            'value' => function ($model){
                                if ($model->data != null){
                                   return Yii::$app->formatter->asDate($model->data);
                                } else {
                                   return 'Não informado';
                                }
                            },                              
                        ],

                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'header'=>'Ações',
                            'template' => '{view}{update}',
                            'buttons' => [
                                'view' => function($url, $model) {
                                    return Html::a('<span class="btn btn-success"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                                },
                                'update' => function($url, $model) {
                                    return Html::a('<span class="btn btn-warning"><b class="fa fa-pencil"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Alterar', 'id' => 'modal-btn-view']);
                                },
                                'delete' => function($url, $model) {
                                    return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir este lançamento?', 'method' => 'post', 'data-pjax' => false],]);
                                }
                            ]

                        ],
                    ],
                ]); ?>
    <?php //Pjax::end(); ?>
</div>
</div>
</div>
