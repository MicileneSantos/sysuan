<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Redefinição de Senha';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-group">

    <?php $form = ActiveForm::begin([
        //'method' => 'post',
        //'enableClientValidation' => true,
    ]);
    ?>
     
    <h4><?= $msg ?></h4>
    
    <div class="panel panel-success">
        <div class="panel panel-success">
            
                <div class="panel-heading"><h3 class="panel-title">REDEFINIÇÃO DE SENHA</h3></div>
                <div class="box box-success"></div>
                <div class="panel-body">                               
                   
                    <?= $form->field($model, 'email')->input("email", ['disabled' => 'disabled']) ?>  

                    <?= $form->field($model, "password_hash")->input("password") ?>  

                    <?= $form->field($model, "password_repeat")->input("password") ?>  

                    <?= $form->field($model, 'codVerificacao')->input("text", ['disabled' => 'disabled']) ?>  

                    <?= $form->field($model, "recover")->input("hidden")->label(false) ?>            
                       
                    <div class="form-group">       
                        <?= Html::submitButton("Redefinir", ["class" => "btn btn-primary"]) ?>
                    </div>   
                </div>    
                            
        </div>
    </div>   

    <?php ActiveForm::end(); ?>

</div>

