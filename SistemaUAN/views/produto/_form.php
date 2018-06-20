<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categoria;
use app\models\Unidade;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="produto-form">

    <div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title">CADASTRO DE PRODUTO</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true]
        ]); ?>
            <div class="box-header with-border">
        
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-4"><?= $form->field($model, 'categoria_id')->dropdownList(ArrayHelper::map(Categoria::find()->orderBy('descricao')->all(),'id','descricao'), ['prompt' => 'Selecione']);?></div>

                        <div class="col-md-4"><?= $form->field($model, 'unidade_id')->dropDownList(ArrayHelper::map(Unidade::find()->orderBy('descricao')->all(),'id','descricao'),['prompt' => 'Selecione']);?></div>
                    </div>

                    <div class="form-group">
                        <div class="pull-right">
                            <?= Html::a('Cancelar', ['produto/index'], ['class' => 'btn btn-default']) ?>
                            <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
