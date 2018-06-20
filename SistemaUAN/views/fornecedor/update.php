<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fornecedor */

$this->title = 'Alterar fornecedor: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="fornecedor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
