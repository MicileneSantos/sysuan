<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstoqueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estoque-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fornecedor') ?>

    <?= $form->field($model, 'produto') ?>

    <?= $form->field($model, 'qtde') ?>

    <?= $form->field($model, 'qtdeestoque') ?>

    <?= $form->field($model, 'tipolanc') ?>

    <?php // echo $form->field($model, 'data') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
