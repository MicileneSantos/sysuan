<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PratoCardapio;

/* @var $this yii\web\View */
/* @var $model app\models\Producao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producao-form">

    <?php $form = ActiveForm::begin(); ?>

    <p class="note "><?php echo ( ' Campos com'); ?> <span class="required"> <b style=color:red;>*</b></span> <?php echo ('são obrigatórios.'); ?></p><br>

    <div class="row">
    	
        <div class="col-md-6"><?= $form->field($model, 'prato_id')->dropdownList(ArrayHelper::map(PratoCardapio::find()->orderBy('prato_id')->all(),'id','prato_id'), ['prompt' => 'Selecione']);?>
        </div>
        <div class="col-md-6"><?= $form->field($model, 'quantidade')->textInput() ?></div>

	</div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
