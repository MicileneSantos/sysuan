<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Produto;
use app\models\Unidade;
use app\models\Fornecedor;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contrato-form">

    <div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title">CADASTRO DE CONTRATO</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true]
        ]); ?>
            <div class="box-header with-border">
        
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'numero')->textInput() ?></div>

                        <div class="col-md-6"><?= $form->field($model, 'fornecedor_id')->dropDownList(ArrayHelper::map(Fornecedor::find()->orderBy('nome')->all(),'id','nome'),['prompt' => 'Selecione']);?>
                        </div>
                    </div>

                    <!--Aqui-->
                    
                    <!--Aqui-->
                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'produto_id')->dropdownList(ArrayHelper::map(Produto::find()->orderBy('descricao')->all(),'id','descricao'), ['prompt' => 'Selecione']);?>
                        </div>

                        <div class="col-md-6"><?= $form->field($model, 'unidade_id')->dropDownList(ArrayHelper::map(Unidade::find()->orderBy('descricao')->all(),'id','descricao'),['prompt' => 'Selecione']);?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-6"><?= $form->field($model, 'qtde')->textInput() ?></div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-6"><?= $form->field($model, 'valoruni')->textInput() ?></div>
                  
                        <div class="col-md-6"><?= $form->field($model, 'data')->input('date');?></div>
                    </div>

                    <div class="form-group">
                        <div class="pull-right">
                            <?= Html::a('Cancelar', ['contrato/index'], ['class' => 'btn btn-default']) ?>
                            <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
