<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\models\Produto;
//use app\models\ProdutoPrato;
//use kartik\widgets\Select2;
//use yii\web\JsExpression;
//use wbraganca\dynamicform\DynamicFormWidget;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $model app\models\Prato */
/* @var $modelProduto app\models\ProdutoPrato */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $searchModel app\models\ProdutoPratoSearch */

$this->registerJs('
    $(document).on("click",".remove-ingrediente",function(){
        var context = $(this);
    
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data:{id:context.data("key")},
            url: "'.Url::to (['/prato/remove-ingrediente']).'",
            success: function(result){
                if(result.data) {
                    $.pjax.reload({container: ".modal-container", timeout: 100});
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr, ajaxOptions, thrownError)
            }
        });
    }); 
    
    $(document).on("click",".add-ingrediente",function(){
        var descricao = $("#descricao").val();
        var ingredienteId = $("#descricao").val();
        var ingredienteValue = $("#descricao option:selected").text();
        var percapita = $("#percapita").val();
    
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data:{descricao: descricao,id:ingredienteId, value:ingredienteValue, percapita: percapita},
            url: "'.Url::to (['/prato/add-ingrediente']).'",
            success: function(result){
                if(result.data) { console.log(result.data)  
                    $.pjax.reload({container: ".modal-container", timeout: 100});
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr, ajaxOptions, thrownError)
            }
        });
    });    
');

echo Dialog::widget(['overrideYiiConfirm' => true]);

?>

<div class="prato-form">
    <div class="panel panel-success">
    <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-coffee "></i>  CADASTRO DE PRATO</h5></div>
        
        
            <?php $form = ActiveForm::begin([]); ?>
        
            <div class="box-header with-border">
                <p class="note "><?php echo ( ' Campos com'); ?> <span class="required"> <b style=color:red;>*</b></span> <?php echo ('são obrigatórios.'); ?></p>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'descricao')->textInput(['maxlength' => true,]) ?>
                        </div>
                    </div>
                    
                    <?php if (($model->isNewRecord)==null) { ?>
                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h5 class="panel-title"><i class="fa fa-plus "></i>  ADICIONAR INGREDIENTES</h5>
                        </div>
                        <div class="box-header with-border">

                            <?= Html::beginForm (null, null, ['id' => 'ingrediente-list']); ?>
                            
                                <div class="input-append">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?= Html::label ('Ingredientes') ?>
                                            <?= Html::dropDownList (
                                                    'ingrediente',
                                                    null,
                                                    ArrayHelper::map(Produto::find()->orderBy('descricao')->all(),'id','descricao')
                                                    , [
                                                            'class' => 'form-control',
                                                            'prompt' => 'Selecione o ingrediente...',
                                                            'id' => 'descricao'
                                                        ]) 
                                            ?>
                                                
                                        </div>
                                        <!-- Botão produto -->
                                        <div class="col-md-1"><div style="padding-top:25px">
                                            <?= Html::button('<b class="fa fa-plus"></b>', ['value'=>Url::to('@web/produto/create'), 'class' => 'btn btn-success', 'title' => 'Novo ingrediente', 'id'=> 'modalButton',])?></div>
                                        </div>

                                        <?php
                                        Modal::begin([
                                            'header' => '<h4>NOVO PRODUTO</h4>',
                                            'id' => 'modal',
                                            'size' => 'modal-lg'
                                        ]);
                                        echo "<div id='modalContent'></div>";
                                        Modal::end();
                                        ?> 
                                                                                
                                        <div class="col-md-4">
                                            <?= Html::label ('Per capita') ?>
                                            <?= Html::textInput ('percapita', null, ['class' => 'form-control', 'id' => 'percapita']) ?>
                                        </div>
                                    </div>

                                    <br>
                                        <?= Html::button('<b class="fa fa-plus"></b> Adicionar', [
                                            'class' => 'btn btn-success add-ingrediente',
                                        ])?>
                                    
                                </div>
                            </div>
                        <?= Html::endForm () ?>

                            <br>

                            <div class="row">
                                <div class="col-md-12">

                                    <?php Pjax::begin(['enablePushState' => false, 'options' => ['class' => 'modal-container'], 'id' => 'ingrediente-list']); ?>


                                    <?= GridView::widget([
                                        'dataProvider' => new \yii\data\ArrayDataProvider([
                                            'allModels' => $model::ingredienteSession ()
                                        ]),
                                        'summary' => '',
                                        //'emptyCell'=>'-',
                                        'columns' => [
                                            [
                                                'label' => 'Ingredientes',
                                                'value' => 'descricao',
                                            ],
                                            [
                                                'label' => 'Per capita',
                                                'value' => 'percapita',
                                            ],


                                            [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'headerOptions' => ['width' => '34'],
                                                    'template' => '{delete}',
                                                    'buttons' => [
                                                            'delete' => function($url, $model) {
                                                                return Html::a (Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash']), null, [
                                                                    'class' => 'remove-ingrediente',
                                                                    'role' => 'button',
                                                                    'data' => [
                                                                            'key' => $model['produto_id']
                                                                    ],
                                                                    'title' => 'Remover',
                                                                ]);
                                                            }
                                                    ]
                                            ],
                                        ],
                                    ]); ?>

                                    <?php Pjax::end () ?>
                                </div>
                            </div>
                            
                        </div>
                    </div><?php } ?>
                        <div class="form-group">
                                <div class="pull-right"><button onClick="history.go(-1)" class="btn btn-default" ><font style="vertical-align: inherit;">Cancelar</font></button>
                                <!--?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?-->
                                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Próximo') : Yii::t('app', 'Salvar'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-success']) ?>
                                </div>
                        </div>
                    
                    </div>

                    
                </div>
            </div>
        <?php ActiveForm::end(); ?>
</div>
<?php   
    $script = <<< JS
            
            $('form#{$model->formname()}').on('beforeSubmit', function(e)
            {
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
$this->registerJs($script);
?>
