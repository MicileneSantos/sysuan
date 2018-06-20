<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\Prato;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $produtoModel app\models\ProdutoPrato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cardapios-prato-form">

    <?php
        //$form = ActiveForm::begin();
    $form = ActiveForm::begin(['action' => Url::to(['prato/adicionaproduto']) ]);
    ?>

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">ADICIONAR PRATOS</h3>
            </div>
                <div class="panel-body">
                    <div class="row"><div class="col-md-7"><?= $form->field($produtoModel, 'prato_id')->textInput() ?></div></div>

                    <div class="row"><div class="col-md-7"><?= $form->field($produtoModel, 'percapita')->textInput() ?></div></div>

                    <div class="row"><div class="col-md-7"><?php

                        //$url = Yii::$app->urlManager->createUrl(["/prato/inserir-produto"]);

                        $url = Url::to(['/cardapios/inserir-produto']);

                        echo $form->field($produtoModel, 'prato_id')->widget(Select2::classname(), [
                            'options' => ['placeholder' => 'Buque pelo nome do prato...'],
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
                            ]);?></div>
                        
                        
                    </div>
                    <div class="form-group">
                    </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
