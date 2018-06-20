<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cardapio */

$this->title = 'Visualização de dados cadastrados';
$this->params['breadcrumbs'][] = ['label' => 'Cardápios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pull-right">       
    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
</div>
<hr>
<div class="cardapios-view">
  
    <div class="panel panel-success">
        <div class="panel-heading">
        <h5 class="panel-title">DADOS DO CARDÁPIO</h5>
        </div>
        <div class="box box-success"></div>
        <div class="panel-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    //'prato',
                    'categoria',
                    [ 
                        'label'=>'Data:',
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
