<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CardapiosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cardapio-search">

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::toRoute('cardapios/buscar'),
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'categoria') ?>

    <?= $form->field($model, 'data') ?>
    
    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
