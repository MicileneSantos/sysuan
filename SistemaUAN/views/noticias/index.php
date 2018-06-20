<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notícias cadastradas';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['noticias/gerar']),
    'method' => 'get',
]);?>

<div class="pull-right">       
    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
    <?= Html::a('<b class="fa fa-plus"></b> Novo', ['create'], ['class' => 'btn btn-success' ])?>
    <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
</div>
<hr>
<div class="noticias-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading">
            <h5 class="panel-title">LISTA DE NOTÍCIAS CADASTRADOS</h5>
        </div>
        <div class="box box-success"></div>
            <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => 'No momento não existem publicações cadastrados.',
        'summary' => "Exibindo {begin} - {end} de {totalCount} itens",
        'rowOptions'=> function($model){
            if ($model->isAtivo == '0'){
                return ['class'=>'danger'];
            } else {
                return ['class'=>'success'];
            }         
        },

        
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'titulo',
                'headerOptions' => [
                    'style' => 'width: 200px;'
                ]
                
            ],
            'conteudo:ntext',
            //'imageFile',
            [
                'label'=>'Data',
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
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
                'label'=> 'Destaque',
                'headerOptions' => [
                    'style' => 'width: 10px;'
                ],
                'format' => 'raw',
                'value' => function ($data){
                    if ($data->isAtivo == 0){
                        $icon = '<span class="btn btn-danger btn-xs" role="button"> Inativo </span> '
                                    . ' <label class="badge bagde-danger"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/noticias/ativar" , "id"=>$data->id]);
                                    return  Html::a($label, $url) ;
                                } else if ($data->isAtivo == 1) {
                                    $icon = '<span class="btn btn-success btn-xs" role="button"> Ativo </span> '
                                    . ' <label class="badge bagde-success"></label> ';
                                    $label = $icon;
                                    $url = Yii::$app->urlManager->createUrl(["/noticias/desativar" , "id"=>$data->id]);
                                    return  Html::a($label, $url) ;
                                } 
                            
                        },
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Ações',
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
</div>
</div>