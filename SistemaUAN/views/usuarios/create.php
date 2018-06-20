<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="usuarios-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
