<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\Sugestoes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sugestoes-form">
    <div class="panel panel-info">
    <div class="panel-heading">
        <h5 class="panel-title">Deixe sua sugestão aqui!</h5></div>
    <div class="box box-primary">
        
        <?php $form = ActiveForm::begin(['id' => 'sugestoes-form']); ?>
            <div class="box-header with-border">
                
                    <div class="row">
                        <div class="col-lg-5">

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>

                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('app', '<b class="fa fa-check"></b> Enviar'), ['class' => 'btn btn-primary'])?>
                            </div>
                        </div>
                    </div>
                
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
