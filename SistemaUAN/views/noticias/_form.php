<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="noticias-form">
<div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title">CADASTRO DE NOTÍCIAS</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="box-header with-border">

                    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'conteudo')->textarea(['rows' => 6]) ?>
                                                                    
                    <?= $form->field($model, 'foto')->fileInput() ?>

                    <div class="form-group">
                        <div class="pull-right"><?= Html::a('Cancelar', ['noticias/index'], ['class' => 'btn btn-default']) ?>
                        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
            </div>
            

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
