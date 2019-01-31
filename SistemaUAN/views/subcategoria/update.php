<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */

$this->title = 'Alterar Subcategoria: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Subcategorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subcategoria-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
