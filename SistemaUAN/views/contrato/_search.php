<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contrato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'produto_id') ?>

    <?= $form->field($model, 'unidade_id') ?>

    <?= $form->field($model, 'marca') ?>

    <?php // echo $form->field($model, 'qtde') ?>

    <?php // echo $form->field($model, 'valoruni') ?>

    <?php // echo $form->field($model, 'fornecedor_id') ?>

    <?php // echo $form->field($model, 'data') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
