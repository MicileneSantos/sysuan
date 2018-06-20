<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Produto;
use app\models\ProdutoPrato;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Prato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prato-form">
    <div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title">CADASTRO DE PRATO</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
            <div class="box-header with-border">
        
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?></div>
                    </div><hr> 

                    <?php //Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>

                    <?php //Html::a('<b class="fa fa-plus"></b> Adicionar ingredientes', ['produto', 'id' => $model['id']], ['class' => 'btn btn-success' ])?>

                    <?php //Html::a('<span class="btn btn-success"><b class="fa fa-plus"></b></span>', ['produto', 'id' => $model['id']], ['title' => 'Adicionar ingredientes', 'id' => 'modal-btn-view']);?>

                    <div class="panel panel-success">

                    <div class="panel-heading"><h4><i class=""></i>ADICIONAR INGREDIENTES</h4></div>
                    <div class="panel-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrappe2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 10, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $modelProduto[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'produto_id',
                            ],
                        ]);
                        ?>

                        <div class="container-items" ><!-- widgetContainer -->
                            <?php foreach ($modelProduto as $i => $modelProduto): ?>
                                <div class="item panel "><!-- widgetBody -->
                                    <div class="panel-heading">
                                        <!--h3 class="panel-title pull-left">Adicionar Ingredientes</h3-->
                                         <?php
                                        // necessary for update action.
                                        if (!$modelProduto->isNewRecord) {
                                            //olhar carregamento do update//
                                            echo Html::activeHiddenInput($modelProduto, "[{$i}]id");
                                        }
                                        ?>

                                        <div class="row">
                                            <div class="col-md-4"><?= $form->field($modelProduto, "[{$i}]produto_id")->dropdownList(ArrayHelper::map(Produto::find()->orderBy('descricao')->all(),'id','descricao'), ['prompt' => 'Selecione um ingrediente...']);?>

                                                <?= $form->field($modelProduto, "[{$i}]percapita")->textInput(['maxlength' => true]);?>
                                        

                                        
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus "></i> Adicionar</button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus "></i> Remover</button></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--div class="panel-body"-->
                                       
                                    
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="pull-right"><?= Html::a('Cancelar', ['prato/index'], ['class' => 'btn btn-default']) ?>
                        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
