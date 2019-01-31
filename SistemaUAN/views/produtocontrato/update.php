<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoContrato */

$this->title = 'Update Produto Contrato: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produto Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produto-contrato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
