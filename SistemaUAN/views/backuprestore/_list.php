<?php

use yii\helpers\Html;

//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Backup - Administrador';

?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="panel panel-success">
        <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-database "></i> ARQUIVOS DE BACKUP DO BANCO DE DADOS</h5></div>
        <div class="box-body">
            <div class="pull-right"><?= Html::a('<i class="fa fa-database "> </i>  Backup ', ['create'], ['class' => 'btn btn-success create-backup margin-right5', 'title' => 'Criar Backup'])?></div><br><br>
        <?= GridView::widget([

            'id' => 'install-grid',
            'export' => false,
            'dataProvider' => $dataProvider,
            'resizableColumns' => false,
            'summary' => '',
            //'showPageSummary' => true,
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'responsive' => true,
            'hover' => true,
            /*'panel' => [
                'heading' => '<h3 class="panel-title"><i class="fa fa-database "></i> ARQUIVOS DE BACKUP DO BANCO DE DADOS</h3>',
                'type' => 'success',
                //'showFooter' => false
            ],*/
            // set your toolbar
            'toolbar' => [
                ['content' =>
                    Html::a('<i class="fa fa-database "> </i>  Backup ', ['create'], ['class' => 'btn btn-success create-backup margin-right5'])
                ],
            ],

            'columns' => [
                
                ['attribute'=>'Nome', 'value'=>'name',],
                'size:size',
                ['label'=>'Hora de criação', 'value'=>'create_time',],
                ['label'=>'Hora de modificação', 'value'=>'modified_time',],
                
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{restore_action}',
                    'header' => 'Restaurar',
                    'buttons' => [
                        'restore_action' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-import"></span>', $url, [
                                'title' => 'Restaurar Backup','class'=>'restore', 'data' => ['confirm' => 'Deseja restaurar esta cópia de segurança?', 'method' => 'post', 'data-pjax' => false],
                            ]);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'restore_action') {
							$url = Url::to(['backuprestore/restore', 'filename' => $model['name']]);
                            return $url;
                        }
                    }
                ],
                /*[
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '',
                    'header' => 'Baixar',
                    'buttons' => [
                        'download_action' => function ($url, $model) {
                            return Html::a('<span class="fa fa-download"></span>', $url, [
                                'title' => 'Baixar','class'=>'download', 'data' => ['confirm' => 'Deseja baixar esta cópia de segurança?', 'method' => 'post', 'data-pjax' => false],
                            ]);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'download_action') {
                            $url = Url::to(['backuprestore/download', 'filename' => $model['name']]);
                            return $url;
                        }
                    }
                ],*/
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{delete}',
                    'header' => 'Excluir',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Excluir'),'class'=>'delete', 'data' => ['confirm' => 'Deseja excluir esta cópia de segurança?', 'method' => 'post', 'data-pjax' => false],
                            ]);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'delete') {
                            $url = Url::to(['backuprestore/delete', 'filename' => $model['name']]);
                            return $url;
                        }
                    }
                ],
            ],
        ]);
        ?>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
