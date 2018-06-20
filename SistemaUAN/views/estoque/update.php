<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estoque */

$this->title = 'Alterar';
$this->params['breadcrumbs'][] = ['label' => 'Estoque', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estoque-update">

     <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
