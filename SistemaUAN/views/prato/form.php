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
                
    <div class="col-md-6"><?= $form->field($modelProduto, 'prato_id')->textInput(['disabled' => 'disabled']) ?></div>

        <div class="col-md-12"><div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Adicionar Ingredientes</h3>
            </div>
                
            <div class="panel-body"><div class="col-md-6"><?php

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
                ]);
                                
                    
                echo $form->field($modelProduto, 'percapita')->textInput(); ?></div>
   
                    
                <div class="form-group col-xs-12">
                    <div class="pull-right"><button type="submit" class="btn btn-social btn-success"><b class="fa fa-check-square-o"></b>Salvar</button></div>
                </div>
            </div>
        </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
