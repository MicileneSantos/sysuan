<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = 'Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <body>
            <div class="login-box-body login-header text-left">
                <h1>
                    <img src="img/ifnmg.png" align="left" width="135" height="95"/> 
                    <img src="img/uan.jpeg" align="rigth" width="135" height="95"/>
                </h1>
            </div> 
        </body>
        
        <p class="login-box-msg"><b>SysUAN - Autenticação</b><br>
            Preencha os seguintes campos para entrar</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form
            ->field($model, 'password_hash', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password_hash')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            
            <div class="col-xs-4">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>
        
        <div style="color:#999;margin:1em 0">
                <?= Html::a('Alterar minha senha', ['site/recoverpass']) ?>
        </div>
        
        
        <?php ActiveForm::end(); ?>
        
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
