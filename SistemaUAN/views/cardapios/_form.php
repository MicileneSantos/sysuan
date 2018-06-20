<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Prato;
use app\models\Refeicao;
use app\models\PratoCardapio;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Cardapio */
/* @var $form kartik\widgets\ActiveForm */
?>

<hr>
<div class="cardapios-form">
    <div class="panel panel-success">
    <div class="panel-heading"><h5 class="panel-title">CADASTRO DE CARDÁPIO</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
            <div class="box-header with-border"></div>        
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-4"><?php //$form->field($model, 'refeicao_id')->dropdownList(ArrayHelper::map(Refeicao::find()->orderBy('descricao')->all(),'id','descricao'), ['prompt' => 'Selecione']);?>
                        </div> 
                        <!--div class="col-sm-4">
                            <?php // $form->field($model, 'data')->input('date');?>
                        </div--> 
                    </div><hr>               
                    
                    <div class="panel panel-success">

                    <div class="panel-heading"><h4>Inserir Pratos</h4></div>
                    <div class="panel-body">
                             <?php DynamicFormWidget::begin([
                                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                'widgetBody' => '.container-items', // required: css class selector
                                'widgetItem' => '.item', // required: css class
                                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                                'min' => 1, // 0 or 1 (default 1)
                                'insertButton' => '.add-item', // css class
                                'deleteButton' => '.remove-item', // css class
                                'model' => $modelPrato[0],
                                'formId' => 'dynamic-form',
                                'formFields' => [
                                    'prato_id',
                                    //'data',
                                ],
                            ]); ?>

                            <div class="container-items"><!-- widgetContainer -->
                            <?php foreach ($modelPrato as $i => $modelPrato): ?>
                                <div class="item panel panel-success"><!-- widgetBody -->
                                    <div class="panel-heading">
                                        <h3 class="panel-title pull-left">Pratos</h3>
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            // necessary for update action.
                                            if (! $modelPrato->isNewRecord) {
                                                echo Html::activeHiddenInput($modelPrato, "[{$i}]id");
                                            }
                                        ?>
                                        
                                        <div class="row">
                                            <div class="col-md-4"><?= $form->field($modelPrato, "[{$i}]prato_id")->dropdownList(ArrayHelper::map(Prato::find()->orderBy('descricao')->all(),'id','descricao'), ['prompt' => 'Selecione']);?></div>
                                        </div>
 
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </div>               
                    <div class="form-group">
                        <div class="pull-right"><?= Html::a('Cancelar', ['cardapios/index'], ['class' => 'btn btn-default']) ?>
                        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>