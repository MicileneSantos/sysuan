<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Unidade;
use app\models\Categoria;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['produto/gerar']),
    'method' => 'get',
]);?>

<div class="produto-index">

    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading">
            <h5 class="panel-title"><i class="fa fa-list "></i> GERENCIAR PRODUTOS</h5>
        </div>
        <div class="box box-success"></div>
        <div class="panel-body">
            <div class="pull-right">       
                <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-primary','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
                <?= Html::a('<b class="fa fa-plus"></b> Novo', ['create'], ['class' => 'btn btn-success', 'title' => 'Adicionar produto', ])?>
                <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
            </div><br>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'emptyCell'=> '-',
                'summary' => "Exibindo <strong> {begin}</strong> - <strong>{end}</strong> de <strong>{totalCount}</strong> itens.",
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    [
                        'attribute' => 'descricao',
                        'headerOptions' => [
                            'style' => 'width: 200px;'
                        ]
                    ],
                    [
                        'attribute' => 'categoria_id',
                        'value' => 'categoria.descricao',
                        'filter' =>ArrayHelper::map(app\models\Categoria::find()->all(),'id','descricao'),
                        'headerOptions' => [
                            'style' => 'width: 200px;'
                        ]
                    ],
                    [
                        'attribute' => 'unidade_id',
                        'value' => 'unidade.descricao',
                        'filter' =>ArrayHelper::map(app\models\Unidade::find()->all(),'id','descricao'),
                        'headerOptions' => [
                            'style' => 'width: 100px;'
                        ]
                    ],          
                    

                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header'=>'Ações',
                        'headerOptions'=>['class'=> 'CustomHeader',],
                        'template' => '{view}{update}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('<span class="btn btn-primary"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                            },
                            'update' => function($url, $model) {
                                return Html::a('<span class="btn btn-success"><b class="glyphicon glyphicon-edit"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Editar produto', 'id' => 'modal-btn-view']);
                            },
                            /*'delete' => function($url, $model) {
                                return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir este produto?', 'method' => 'post', 'data-pjax' => false],]);
                            }*/
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