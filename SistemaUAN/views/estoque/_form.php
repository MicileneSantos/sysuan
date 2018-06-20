<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Fornecedor;
use app\models\Produto;

/* @var $this yii\web\View */
/* @var $model app\models\Estoque */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="estoque-form">
    <div class="panel panel-success">
        <div class="panel-heading"><h5 class="panel-title">LANÇAMENTO DE ESTOQUE</h5></div>
        <div class="box box-success">
            <?php $form = ActiveForm::begin(); ?>
                <div class="box-header with-border">
            
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-4"><?= $form->field($model, 'tipolanc')->dropDownList(array ('Entrada'=>'Entrada', 
                            'Saída'=>'Saída'),  
                            ['prompt'=>'Selecione'], array('selected'=>true) ) ?></div>

                            <!--div class="col-md-4"><?php //$form->field($model, 'fornecedor_id')->dropdownList(ArrayHelper::map(Fornecedor::find()->all(),'nome','nome'))?></div-->
                            
                            <div class="col-md-4"><?= $form->field($model, 'produto_id')->dropdownList(ArrayHelper::map(Produto::find()->orderBy('descricao')->all(),'id','descricao'), ['prompt' => 'Selecione']);?></div>

                            <div class="col-md-4"><?= $form->field($model, 'qtde')->textInput() ?></div>

                            <!--div class="col-md-4"><?php //$form->field($model, 'qtdeestoque')->textInput() ?></div-->

                            <?php //$form->field($model, 'data')->textInput() ?>
                        </div>
                    </div>
                            <div class="form-group">
                                <div class="pull-right">
                                    <?= Html::a('Cancelar', ['estoque/index'], ['class' => 'btn btn-default']) ?>
                                    <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
