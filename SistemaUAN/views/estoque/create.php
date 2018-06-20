<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estoque */

$this->title = 'Lançamento de Estoque';
$this->params['breadcrumbs'][] = ['label' => 'Estoque', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estoque-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
