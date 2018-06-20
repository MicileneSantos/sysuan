<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="categoria-form">
    <div class="panel panel-success">
    <div class="panel-heading"><h5 class="panel-title">CADASTRO DE CATEGORIA</h5></div>
        <div class="box box-success">
            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => true]
            ]); ?>
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="form-group">
                        <div class="pull-right"><?= Html::a('Cancelar', ['categoria/index'], ['class' => 'btn btn-default']) ?>
                        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>