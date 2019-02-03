<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\data\ActiveDataProvider;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['usuarios/gerar']),
    'method' => 'get',
]);?>

<div class="usuarios-index">
    <?php Pjax::begin(); ?>

    <div class="panel panel-success">
        <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-user "></i> GERENCIAR USUÁRIOS</h5></div>
        <div class="box-body">
        <div class="pull-left">
            <b> Laranja: Usuários novos</b><br>
            <b> Verde: Usuários ativos</b><br>
            <b> Vermelho: Usuários inativos</b> 
        </div>
        <div class="pull-right">       
            <?= Html::a('<b class="fa fa-user-plus"></b> Novo', ['create'], ['class' => 'btn btn-success', 'title' => 'Novo usuário', ]) ?>
            <?php Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
        </div><br><br><br><br>
        
    
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
 
    <?= GridView::widget([
        //'id' => 'install-grid',
        //'export' => false,
        'dataProvider' => $dataProvider,
        'emptyText' => 'No momento não existem usuários cadastrados.',
        'summary' => "Exibindo <strong> {begin}</strong> - <strong>{end}</strong> de <strong>{totalCount}</strong> itens.",
        //'resizableColumns' => false,
        //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'responsive' => true,
        //'hover' => false,
        'filterModel' => $searchModel,
               
        /*'rowOptions'=> function($model){
            if ($model->isAtivo == '0'){
                return ['class'=>'warning'];
            } else if ($model->isAtivo == '1') {
                return ['class'=>'success'];
            } else{
                return ['class'=>'danger'];
            }        
        },*/
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'], 

            //'id',
            'nome',
            'cpf',
            [
                'attribute'=> 'role',
                'format'=>'raw',
                'value'=>function($data){
                    if($data->role==1){
                        return 'Administrador';
                    } else if($data->role==2){
                        return 'Nutricionista';
                    } else if($data->role==3){
                        return 'Discente';
                    }
                },
            ],
            
            'email:email',
            //'telefone',
            //'senha',
            
            [
                'attribute' => 'isAtivo',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['style' => 'width: 10%;'],
                'value' => function ($data) {
                    if ($data->isAtivo == 0) {
                        $icon = '<span class="btn btn-warning btn-xs" title = "Ativar Usuário" role="button"> Novo </span> '
                                        . ' <label class="badge bagde-danger"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/usuarios/ativar","id" => $data->id]);
                            return Html::a($label, $url);
                    } else if ($data->isAtivo == 1) {
                        $icon = '<span class="btn btn-success btn-xs" title = "Desativar Usuário" role="button"> Ativo </span> '
                                        . ' <label class="badge bagde-success"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/usuarios/desativar", "id" => $data->id]);
                            return Html::a($label, $url);
                    } if ($data->isAtivo == 2) {
                        $icon = '<span class="btn btn-danger btn-xs" title = "Reativar Usuário" role="button"> Inativo </span> '
                                        . ' <label class="badge bagde-danger"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/usuarios/reativar","id" => $data->id]);
                            return Html::a($label, $url);
                    }
                },
             ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'headerOptions' => ['style' => 'width: 10%;', 'class'=> 'CustomHeader',],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function($url, $model) {
                        return Html::a('<span class="btn btn-primary"><b class="fa fa-eye"></b></span>', ['view', 'id' => $model['id']], ['title' => 'Visualizar', 'id' => 'modal-btn-view']);
                    },
                    'update' => function($url, $model) {
                        return Html::a('<span class="btn btn-success"><b class="glyphicon glyphicon-edit"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Editar usuário', 'id' => 'modal-btn-view']);
                    },
                    'delete_action' => function($url, $model) {
                        return Html::a('<span class="btn btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Excluir', 'class' => '', 'data' => ['confirm' => 'Deseja excluir este usuário?', 'method' => 'post', 'data-pjax' => false],]);
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
        width: 25%;
    }
</style>