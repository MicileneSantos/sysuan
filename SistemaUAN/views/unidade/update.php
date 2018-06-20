<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unidade */

$this->title = 'Alterar Unidade: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="unidade-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
