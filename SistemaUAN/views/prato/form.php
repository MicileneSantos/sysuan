<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\Produto;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $modelProduto app\models\ProdutoPrato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-prato-form">

    <?php
        //$form = ActiveForm::begin();
    $form = ActiveForm::begin(['action' => Url::to(['prato/adicionaproduto']) ]);
    ?>

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">ADICIONAR INGREDIENTES</h3>
            </div>
                <div class="panel-body">
                    <div class="row"><div class="col-md-7"><?php $form->field($modelProduto, 'prato_id')->textInput() ?></div></div>

                    <div class="row"><div class="col-md-7"><?php

                        $url = Yii::$app->urlManager->createUrl(["/prato/inserir-produto"]);

                        $url = Url::to(['/prato/inserir-produto']);

                        echo $form->field($modelProduto, 'produto_id')->widget(Select2::classname(), [
                            'options' => ['placeholder' => 'Busque pelo nome do produto...'],
                            'pluginOptions' => [
                                'allowClear' => false,
                                'minimumInputLength' => 2, //Mínimo de caracteres para iniciar a busca
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Aguarde...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $url,
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(produto) { return produto.text; }'),
                                'templateSelection' => new JsExpression('function (produto) { return produto.text; }'),
                            ],
                            ]);?>
                                
                    </div>
   
                    </div>
                    <div class="form-group">
                        <br><?= Html::submitButton($modelProduto->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
                    </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
