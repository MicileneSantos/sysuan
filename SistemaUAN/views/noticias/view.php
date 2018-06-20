<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'Visualização de dados cadastrados';
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pull-right">       
    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
</div>
<hr>
<div class="noticias-view">

    <div class="panel panel-success">
        <div class="panel-heading">
        <h5 class="panel-title">DADOS DA NOTÍCIA</h5>
        </div>
        <div class="box box-success"></div>
        <div class="panel-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'imageFile',
                    'titulo',
                    'conteudo:ntext',

                    [ 

                        'label'=>'Data',
                        'format' => 'raw',             
                        'value' => function ($model){
                            if ($model->dta != null){
                               return Yii::$app->formatter->asDate($model->dta);
                            } else {
                               return 'Não informado';
                            }
                        },                              
                    ],
                ],
            ]) ?>
    
        </div>
    </div>
</div>
