<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categoria;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoria-form">

    <div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title">CADASTRO DE SUBCATEGORIA</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true]
        ]); ?>
            <div class="box-header with-border">
                <p class="note "><?php echo ( ' Campos com'); ?> <span class="required"> <b style=color:red;>*</b></span> <?php echo ('são obrigatórios.'); ?></p><br>
        
                <div class="box-body">
                	<div class="row">
				    <div class="col-md-6"><?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?></div>

				    <div class="col-md-6"><?= $form->field($model, 'categoria_id')->dropdownList(ArrayHelper::map(Categoria::find()->orderBy('descricao')->all(),'id','descricao'), ['prompt' => 'Selecione']);?>
				    </div>	
				</div>	    

				<div class="form-group">
                    <div class="pull-right">
                            <?= Html::a('Cancelar', ['subcategoria/index'], ['class' => 'btn btn-default']) ?>
                            <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
