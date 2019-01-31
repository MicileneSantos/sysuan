<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoContratoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-contrato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'produto_id') ?>

    <?= $form->field($model, 'unidade_id') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'valoruni') ?>

    <?php // echo $form->field($model, 'quantidade') ?>

    <?php // echo $form->field($model, 'contrato_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
