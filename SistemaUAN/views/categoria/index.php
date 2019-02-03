<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefeicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['categoria/gerar']),
    'method' => 'get',
]);?>
<?php ActiveForm::end(); ?>

<div class="categoria-index">
    <?php if($model->isNewRecord) 
        echo $this->render('create', ['model' => $model]); 
       else
        echo $this->render('update', ['model' => $model]);  
    ?>
    <?php Pjax::begin(['enablePushState' => false]); ?>    
    
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-list "></i> GERENCIAR CATEGORIA</h5></div>
        <div class="box box-success"></div>
            <div class="panel-body">
                
        <div class="pull-right">       
            <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-primary','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
            <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
        </div><br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => 'No momento não existem categorias cadastradas.',
        'filterModel' => $searchModel,
        'summary' => "Exibindo <strong> {begin}</strong> - <strong>{end}</strong> de <strong>{totalCount}</strong> itens.",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'descricao',
                'headerOptions' => [
                    'style' => 'width: 80%;'
                ]
                
            ],
            

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'headerOptions'=>['class'=> 'CustomHeader',],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{view_action}{update_action}',
                'buttons' => [
                    'view_action' => function($url, $model) {
                        return Html::a('<span class="btn btn-primary"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                    },
                    'update_action' => function($url, $model) {
                        return Html::a('<span class="btn btn-success"><b class="glyphicon glyphicon-edit"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Editar categoria', 'id' => 'modal-btn-view']);
                    },
                    /*'delete_action' => function($url, $model) {
                        return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir esta categoria?', 'method' => 'post', 'data-pjax' => false],]);
                    }*/
                ],                    
          
            ],
        ],
    ]); ?>
    </div>
</div>
<?php Pjax::end(); ?>

</div>
<style type="text/css">
    .CustomHeader{
        color: #3c8dbc;
        text-align: center;
        width: 25%;
    }
</style>