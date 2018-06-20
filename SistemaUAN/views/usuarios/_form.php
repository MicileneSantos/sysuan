<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="usuarios-form">
    <div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title">CADASTRO DE USUÁRIOS</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true]
        ]); ?>
            <div class="box-header with-border">
                
                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <?php //$form->field($model, 'rg')->textInput(['maxlength' => true]) ?>
                        <div class="col-md-6"><?= $form->field($model, 'cpf')-> widget(MaskedInput::className(), ['mask' => '999.999.999-99',])?>
                        </div>
                        <div class="col-md-6"> <?= $form->field($model, 'telefone') -> widget(MaskedInput::className(), ['mask' => '(99)99999-9999',])?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'rua')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-6"><?= $form->field($model, 'numero')->textInput() ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'complemento')->textInput(['maxlength' => true])?></div>
                        <div class="col-md-6"><?= $form->field($model, 'bairro')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">   
                        <div class="col-md-6"><?= $form->field($model, 'cidade')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-6"><?= $form->field($model, 'estado')->dropDownList(array ('Acre'=>'Acre','Alagoas'=>'Alagoas','Amapá'=>'Amapá',
                                                                        'Amazonas'=>'Amazonas','Bahia'=>'Bahia','Ceará'=>'Ceará','Distrito Federal'=>'Distrito Federal',
                                                                        'Espirito Santo'=>'Espirito Santo','Goiás'=>'Goiás','Maranhão'=>'Maranhão','Mato Grosso'=>
                                                                        'Mato Grosso','Mato Grosso do Sul'=>'Mato Grosso do Sul','Minas Gerais'=>'Minas Gerais','Pará'=>
                                                                        'Pará','Paraíba'=>'Paraíba','Paraná'=>'Paraná','Pernambuco'=>'Pernambuco','Piauí'=>'Piauí',
                                                                        'Rio de Janeiro'=>'Rio de Janeiro','Rio Grande do Norte'=>'Rio Grande do Norte','Rio Grande do Sul'=>
                                                                        'Rio Grande do Sul','Rondônia'=>'Rondônia','Roraima'=>'Roraima','Santa Catarina'=>'Santa Catarina', 
                                                                        'São Paulo'=>'São Paulo','Sergipe'=>'Sergipe','Tocantins'=>'Tocantins'),
                                ['prompt'=>'Selecione'], array('selected'=>true) ) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'role')->dropDownList(array (//'1'=>'Administrador',                                                              
                                '3'=>'Discente',
                                '2'=>'Nutricionista'),
                            ['prompt'=>'Selecione'], array('selected'=>true) ) ?></div>

                        <div class="col-md-6">    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?></div>
                        
                    </div>

                    <div class="form-group">
                        <div class="pull-right">
                            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success'])?>                       
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
     

