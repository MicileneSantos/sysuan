<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estoque */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estoque', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pull-right">       
    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
</div>
<hr>
<div class="estoque-view">

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fornecedor',
            'produto',
            'qtde',
            'qtdeestoque',
            'tipolanc',
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
