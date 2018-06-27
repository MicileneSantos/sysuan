<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prato */


$this->title = 'Alterar Prato: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prato-update">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
