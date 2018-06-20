<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PratoCardapio */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prato Cardapios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-cardapio-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'prato_id',
            'cardapio_id',
            'data',
        ],
    ]) ?>

</div>
