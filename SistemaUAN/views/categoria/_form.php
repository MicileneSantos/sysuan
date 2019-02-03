<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">
    <div class="panel panel-success">
    <div class="panel-heading"><h5 class="panel-title">CADASTRO DE CATEGORIA</h5></div>
        <div class="box box-success">
			
            <?php
        if ($this->context->action->id == 'update')
            $action = ['update', 'id' => $_REQUEST['id']];
        else
            $action = ['create'];
        ?>
        <?php
        $form = ActiveForm::begin([

                    'id' => 'panel panel-info',
                    'enableAjaxValidation' => true,
                    'action' => $action,
                    'fieldConfig' => [
                        'template' => " <strong>Descrição</strong> {input}{error}",
                    ],
        ]);
        ?>
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="form-group">
                        <div class="pull-right">
                            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Alterar'), ['class' => $model->isNewRecord  ? 'btn btn-block btn-success' : 'btn btn-block btn-primary']) ?>                        </div>
                    </div>
                </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>