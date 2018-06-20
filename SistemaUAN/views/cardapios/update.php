<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cardapio */

$this->title = 'Alterar Cardápio ';
$this->params['breadcrumbs'][] = ['label' => 'Cardápios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="cardapios-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelPrato' => $modelPrato,
    ]) ?>

</div>
