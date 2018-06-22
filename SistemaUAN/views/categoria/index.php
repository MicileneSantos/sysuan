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

$this->title = 'Categorias cadastradas';
//$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin([
    'action' => Url::to(['categoria/gerar']),
    'method' => 'get',
]);?>


<div class="categoria-index">
    <?php if($model->isNewRecord) 
    echo $this->render('create', ['model' => $model]); 
   else
    echo $this->render('update', ['model' => $model]);  
?>
    <?php Pjax::begin(); ?>    
    
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-success">
        
        
        <div class="panel-heading">
            <h5 class="panel-title">LISTA DE CATEGORIAS CADASTRADAS</h5>
        </div>
        <div class="box box-success">
            

            <div class="panel-body">
                <div class="pull-right">       
            <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
            <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
        </div><br>

    
    <?= GridView::widget([
        //'id' => 'install-grid',
        //'export' => false,
        'dataProvider' => $dataProvider,
        'emptyText' => 'No momento não existem categorias cadastradas.',
        'summary' => "Exibindo {begin} - {end} de {totalCount} itens",
        //'resizableColumns' => false,
        //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        //'responsive' => true,
        //'hover' => false,
        'filterModel' => $searchModel,
        
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'descricao',
                'headerOptions' => [
                    'style' => 'width: 400px;'
                ]
                
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