<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Refeicao */
/* @var $form yii\widgets\ActiveForm */
?>
<hr>
<div class="refeicao-form">
    <div class="panel panel-success">
    <div class="panel-heading"><h5 class="panel-title">CADASTRO DE REFEIÇÃO</h5></div>
        <div class="box box-success">
			
				<?php $form = ActiveForm::begin(); ?>
					<div class="box-header with-border">

					    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

					    <div class="form-group">
	                        <div class="pull-right">
	                        	<?= Html::a('Cancelar', ['refeicao/index'], ['class' => 'btn btn-default']) ?>
	                        	<?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
	                        </div>
	                    </div>
					</div>

				<?php ActiveForm::end(); ?>
			
		</div>
    </div>
</div>