<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\widgets\datapicker;

/* @var $this yii\web\View */
/* @var $model app\models\Fornecedor */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="fornecedor-form">
    <div class="panel panel-success">
    <div class="panel-heading"><h5 class="panel-title">CADASTRO DE FORNECEDORES</h5></div>
        <div class="box box-success">
            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => true]
            ]); ?>
                <div class="box-header with-border">
                    <div class="row">
                        
                        <div class="col-md-6"><?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-6"><?= $form->field($model, 'cnpj')-> widget(MaskedInput::className(), [
                                                  'mask' => '99.999.999/9999-99',])?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-6"> <?= $form->field($model, 'telefone') -> widget(MaskedInput::className(), [
                                                  'mask' => '(99)99999-9999',])?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'rua')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'numero')->textInput() ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'complemento')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'bairro')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'estado')->dropDownList(array ('Acre'=>'Acre','Alagoas'=>'Alagoas','Amapá'=>'Amapá',
                                                                        'Amazonas'=>'Amazonas','Bahia'=>'Bahia','Ceará'=>'Ceará','Distrito Federal'=>'Distrito Federal',
                                                                        'Espirito Santo'=>'Espirito Santo','Goiás'=>'Goiás','Maranhão'=>'Maranhão','Mato Grosso'=>
                                                                        'Mato Grosso','Mato Grosso do Sul'=>'Mato Grosso do Sul','Minas Gerais'=>'Minas Gerais','Pará'=>
                                                                        'Pará','Paraíba'=>'Paraíba','Paraná'=>'Paraná','Pernambuco'=>'Pernambuco','Piauí'=>'Piauí',
                                                                        'Rio de Janeiro'=>'Rio de Janeiro','Rio Grande do Norte'=>'Rio Grande do Norte','Rio Grande do Sul'=>
                                                                        'Rio Grande do Sul','Rondônia'=>'Rondônia','Roraima'=>'Roraima','Santa Catarina'=>'Santa Catarina', 
                                                                        'São Paulo'=>'São Paulo','Sergipe'=>'Sergipe','Tocantins'=>'Tocantins'),
                                ['prompt'=>'Selecione'], array('selected'=>true) ) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="pull-right"><?= Html::a('Cancelar', ['fornecedor/index'], ['class' => 'btn btn-default']) ?>
                        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
