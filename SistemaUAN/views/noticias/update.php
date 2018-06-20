<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'Alterar Notícia: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="noticias-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
