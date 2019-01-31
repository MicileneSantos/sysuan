<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['fornecedor/gerar']),
    'method' => 'get',
]);?>

<div class="fornecedor-index">
    
    <?php Pjax::begin(); ?>    
    
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading">
            <h5 class="panel-title"><i class="fa fa-users "></i> GERENCIAR FORNECEDORES</h5>
        </div>
        
            <div class="box-body">
                <div class="pull-right">       
                    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-primary','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
                    <?= Html::a('<b class="fa fa-plus"></b> Novo', ['create'], ['class' => 'btn btn-success', 'title' => 'Adicionar fornecedor', ])?>
                    <?php //Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target' => '_blank', 'class' => 'btn btn-default', 'title' => 'Exportar', 'id' => 'modal-btn-pdf']) ?>                </div><br>
    
    <?= GridView::widget([
        //'id' => 'install-grid',
        //'export' => false,
        'dataProvider' => $dataProvider,
        'emptyText' => 'No momento não existem fornecedores cadastrados.',
        'summary' => "Exibindo <strong> {begin}</strong> - <strong>{end}</strong> de <strong>{totalCount}</strong> itens.",
        //'resizableColumns' => false,
        //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        //'responsive' => true,
        //'hover' => false,
        'filterModel' => $searchModel,

        /*'rowOptions'=> function($model){
            if ($model->isAtivo == '0'){
                return ['class'=>'danger'];
            } else {
                return ['class'=>'success'];
            }         
        },*/
        
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'cnpj',
            'email:email',
            'telefone',
            
            [
                'attribute' => 'isAtivo',
                'format' => 'raw',
                'headerOptions'=>['class'=> 'CustomHeader',],
                'contentOptions' => ['class' => 'text-center'],
                'value' => function ($data){
                    if ($data->isAtivo == 0){
                        $icon = '<span class="btn btn-danger btn-xs" title="Ativar Fornecedor" role="button"> Inativo </span> '
                                    . ' <label class="badge bagde-danger"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/fornecedor/ativar" , "id"=>$data->id]);
                                    return  Html::a($label, $url) ;
                    } else if ($data->isAtivo == 1) {
                        $icon = '<span class="btn btn-success btn-xs" title="Desativar Fornecedor" role="button"> Ativo </span> '
                                    . ' <label class="badge bagde-success"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/fornecedor/desativar" , "id"=>$data->id]);
                                    return  Html::a($label, $url) ;
                    } 
                            
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'headerOptions'=>['class'=> 'CustomHeader',],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function($url, $model) {
                        return Html::a('<span class="btn btn-primary"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                    },
                    'update' => function($url, $model) {
                        return Html::a('<span class="btn btn-success"><b class="glyphicon glyphicon-edit"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Editar Fornecedor', 'id' => 'modal-btn-view']);
                    },
                    'delete' => function($url, $model) {
                        return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir este fornecedor?', 'method' => 'post', 'data-pjax' => false],]);
                    }
                ],                    
          
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

