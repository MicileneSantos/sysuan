<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Produtos;

/* @var $this yii\web\View */
/* @var $model app\models\Estoque */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="estoque-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-4"><?= $form->field($model, 'produto')->dropdownList(ArrayHelper::map(Produtos::find()->all(),'id_Produtos','descricao'))?></div>
    
    <div class="col-md-4"><?= $form->field($model, 'qtde')->textInput() ?></div>

    <div class="col-md-4"><?= $form->field($model, 'qtde_estoque')->textInput() ?></div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', ['site/nutricionista'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
