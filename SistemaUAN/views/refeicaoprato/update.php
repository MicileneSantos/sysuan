<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefeicaoPrato */

$this->title = 'Update Refeicao Prato: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Refeicao Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="refeicao-prato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
