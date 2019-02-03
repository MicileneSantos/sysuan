<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TypeaheadBasic;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoPrato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-prato-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?php //$form->field($model, 'prato_id')->textInput() ?>
    
    <?= $form->field($model, 'descricao')->textInput()->widget(TypeaheadBasic::classname(), [
        'data' => yii\helpers\ArrayHelper::map(app\models\Produto::find()->all(), 'descricao', 'descricao'),
        'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Informe o ingrediente...'], ]); ?>

    <!--?= $form->field($model, 'produto_id')->textInput() ?-->

    <?= $form->field($model, 'percapita')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS
            
    $('form#{$model->formname()}').on('beforeSubmit', function(e){
        var \$form = $(this);
                    
        $.post(
            \$form.attr("action"),
            \$form.serialize()               
        )      
                        
        .done(function(result){                           
            $(\$form).trigger("reset");
            $.pjax.reload({container:'#produtos'});
                            
            console.log(result);
        }).fail(function(){
            console.log(result);
        });            
        return false;
    });        
                                       
JS;

$this->registerJs($script)
?>

