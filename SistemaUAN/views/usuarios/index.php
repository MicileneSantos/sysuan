<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
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

<div class="pull-right">       
    <?= Html::a('<b class="fa fa-user-plus"></b> Novo', ['create'], ['class' => 'btn btn-success', 'title' => 'Novo usuário', ]) ?>
    <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
</div>
<hr>

<div class="usuarios-index">
    <?php Pjax::begin(); ?>

    <div class="panel panel-success">
        <div class="panel-heading"><h5 class="panel-title">USUÁRIOS CADASTRADOS</h5></div>
        <div class="box box-success"></div>
        <div class="col-lg-12">
            <b> Laranja: Usuários novos</b><br>
            <b> Verde: Usuários ativos</b><br>
            <b> Vermelho: Usuários inativos</b> 
        </div><br><br><br>
    <div class="panel-body">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
 
    <?= GridView::widget([
        //'id' => 'install-grid',
        //'export' => false,
        'dataProvider' => $dataProvider,
        'emptyText' => 'No momento não existem usuarios cadastrados.',
        'summary' => "Exibindo {begin} - {end} de {totalCount} itens",
        //'resizableColumns' => false,
        //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        //'responsive' => true,
        //'hover' => false,
        'filterModel' => $searchModel,
               
        'rowOptions'=> function($model){
            if ($model->isAtivo == '0'){
                return ['class'=>'warning'];
            } else if ($model->isAtivo == '1') {
                return ['class'=>'success'];
            } else{
                return ['class'=>'danger'];
            }        
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'], 

            //'id',
            [
                'attribute' => 'nome',
                'headerOptions' => [
                    'style' => 'width: 120px;'
                ] 
            ],
            [
                'attribute' => 'cpf',
                'headerOptions' => [
                    'style' => 'width: 120px;'
                ]  
            ],
            [
                'attribute'=> 'role',
                'headerOptions' => [
                    'style' => 'width: 120px;'
                ],
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
            
            [   
                'attribute' => 'email',
                'headerOptions' => [
                    'style' => 'width: 120px;'
                ]
            ],
            //'telefone',
            //'senha',
            
            [
                'attribute' => 'isAtivo',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['style' => 'width: 10%;'],
                'value' => function ($data) {
                    if ($data->isAtivo == 0) {
                        $icon = '<span class="btn btn-warning btn-xs" role="button"> Novo </span> '
                                        . ' <label class="badge bagde-danger"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/usuarios/ativar","id" => $data->id]);
                            return Html::a($label, $url);
                    } else if ($data->isAtivo == 1) {
                        $icon = '<span class="btn btn-success btn-xs" role="button"> Ativo </span> '
                                        . ' <label class="badge bagde-success"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/usuarios/desativar", "id" => $data->id]);
                            return Html::a($label, $url);
                    } if ($data->isAtivo == 2) {
                        $icon = '<span class="btn btn-danger btn-xs" role="button"> Inativo </span> '
                                        . ' <label class="badge bagde-danger"></label> ';
                        $label = $icon;
                        $url = Yii::$app->urlManager->createUrl(["/usuarios/reativar","id" => $data->id]);
                            return Html::a($label, $url);
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