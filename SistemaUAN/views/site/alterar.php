<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\AlterarForm*/
?>
 

<h1>Alterar Senha</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
    'enableClientValidation' => true,
]);
?>

<div class="box box-success">
    <?php $form = ActiveForm::begin(); ?>
            <div class="box-header with-border">
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                         <?= $form->field($model, "email")->textInput() ?>  
                        </div>

                        <div class="form-group">
                         <?= $form->field($model, "password_hash")->input("password") ?>  
                        </div>

                        <div class="form-group">
                         <?= $form->field($model, "password_repeat")->input("password") ?>  
                        </div>

                        <div class="form-group">
                         <?= $form->field($model, "codVerificacao")->input("text") ?>  
                        </div>

                        <div class="form-group">
                         <?= $form->field($model, "recover")->input("hidden")->label(false) ?>  
                        </div>
 
                        <?= Html::submitButton("Alterar", ["class" => "btn btn-primary"]) ?>
                    </div>
                </div>
            </div>
    <?php $form->end() ?>    
</div>
