<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['noticias/gerar']),
    'method' => 'get',
]);?>

<div class="noticias-index">

    <?php Pjax::begin(['enablePushState' => false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading">
            <h5 class="panel-title"><i class="fa fa-list "></i> GERENCIAR AVISOS</h5>
        </div>
        <div class="box box-success"></div>
            <div class="panel-body">

                <div class="pull-right">       
                    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-primary','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
                    <?= Html::a('<b class="fa fa-plus"></b> Novo', ['create'], ['class' => 'btn btn-success', 'title' => 'Adicionar aviso', ])?>
                    <?php //Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
                </div><br><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'emptyText' => 'No momento não existem avisos cadastrados.',
        'summary' => "Exibindo <strong> {begin}</strong> - <strong>{end}</strong> de <strong>{totalCount}</strong> itens.",
        /*'rowOptions'=> function($model){
            if ($model->isAtivo == '0'){
                return ['class'=>'danger'];
            } else {
                return ['class'=>'success'];
            }         
        },*/

        
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'titulo',
            'conteudo',
            [
                'attribute'=>'data',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['style' => 'width: 10%;'],
                'format' => 'raw',             
                'value' => function ($model){
                    if ($model->data != null){
                       return Yii::$app->formatter->asDate($model->data);
                    } else {
                       return 'Não informado';
                    }
                },                              
            ],

            [
                'attribute' => 'isAtivo',
                'contentOptions' => ['class' => 'text-center'],
                //'headerOptions' => ['style' => 'width: 10%;'],
                'format' => 'raw',
                'value' => function ($data){
                    if ($data->isAtivo == 0){
                        $icon = '<span class="btn btn-danger btn-xs" title="Ativar aviso" role="button"> Inativo </span> '
                                    . ' <label class="badge bagde-danger"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/noticias/ativar" , "id"=>$data->id]);
                                    return  Html::a($label, $url) ;
                                } else if ($data->isAtivo == 1) {
                                    $icon = '<span class="btn btn-success btn-xs" title="Desativar aviso" role="button"> Ativo </span> '
                                    . ' <label class="badge bagde-success"></label> ';
                                    $label = $icon;
                                    $url = Yii::$app->urlManager->createUrl(["/noticias/desativar" , "id"=>$data->id]);
                                    return  Html::a($label, $url) ;
                                } 
                            
                        },
            ],

            [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Ações',
                        'headerOptions' => ['style' => 'width: 10%;', 'class'=> 'CustomHeader',],
                        'contentOptions' => ['class' => 'text-center'],
                        'template' => '{view}{update}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a('<span class="btn btn-primary"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                            },
                            'update' => function($url, $model) {
                                return Html::a('<span class="btn btn-success"><b class="glyphicon glyphicon-edit"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Editar aviso', 'id' => 'modal-btn-view']);
                            },       
                            'delete' => function($url, $model) {
                                return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir este aviso?', 'method' => 'post', 'data-pjax' => false],]);
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