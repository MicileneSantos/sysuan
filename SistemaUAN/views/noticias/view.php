<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

/*$this->title = 'Visualização de dados cadastrados';
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>

<div class="noticias-view">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Dados do Aviso</h5>
        </div>
        <div class="panel-body">
            <div class="pull-right">       
                <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
            </div><br><br>

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
                            if ($model->data != null){
                               return Yii::$app->formatter->asDate($model->data);
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
