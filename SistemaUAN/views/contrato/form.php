<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoContrato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-contrato-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'produto_id')->textInput() ?>

    <?= $form->field($model, 'unidade_id')->textInput() ?>

    <?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valoruni')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'contrato_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
