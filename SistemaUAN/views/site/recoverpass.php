<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Recuperação de Senha';
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="form-group">

    <?php $form = ActiveForm::begin(); ?>
     
    <h4><?= $msg ?></h4>
    
    <div class="panel panel-success">
       
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">RECUPERAÇÃO DE SENHA</h3>
                </div>
                    <div class="panel-body">                                
                    <?= $form->field($model, "email")->input("email") ?>                  
                       
                        <div class="form-group">       
                            <?= Html::submitButton("Recuperar", ["class" => "btn btn-primary"]) ?>
                        </div>    

                    </div>
            </div>                 
        
    </div>   

    <?php ActiveForm::end(); ?>

</div>

