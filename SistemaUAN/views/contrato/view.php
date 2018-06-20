<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pull-right">       
    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
</div>
<hr>
<div class="contrato-view">

    <div class="panel panel-success">
        <div class="panel-heading">
        <h5 class="panel-title">DADOS DA CONTRATO</h5>
        </div>
        <div class="box box-success"></div>
        <div class="panel-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'numero',
            'produto_id',
            'unidade_id',
            'marca',
            'qtde',
            'valoruni',
            'fornecedor_id',
            'data',
        ],
    ]) ?>

</div>
