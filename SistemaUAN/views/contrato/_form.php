<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Fornecedor;
use app\models\Produto;
use app\models\Unidade;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
    $(document).on("click",".remove-ingrediente",function(){
        var context = $(this);
    
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data:{id:context.data("key")},
            url: "'.Url::to (['/contrato/remove-ingrediente']).'",
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
        var ingredienteId = $("#descricao").val();
        var ingredienteValue = $("#descricao option:selected").text();
        var unidade_id = $("#unidade_id").val();
        var marca = $("#marca").val();
        var valoruni = $("#valoruni").val();
        var quantidade = $("#quantidade").val();
        var contrato_id = $("#contrato_id").val();
    
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data:{id:ingredienteId, value:ingredienteValue, unidade_id:unidade_id, marca:marca, valoruni:valoruni, quantidade:quantidade, contrato_id:contrato_id},
            url: "'.Url::to (['/contrato/add-ingrediente']).'",
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

?>

<div class="contrato-form">
    <div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title"><i class="fa fa-list-alt "></i> GERENCIAR CONTRATO</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin([]) ?>
            <div class="box-header with-border">
        
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'numero')->textInput() ?></div>

                        <div class="col-md-6"><?= $form->field($model, 'fornecedor_id')->dropDownList(ArrayHelper::map(Fornecedor::find()->orderBy('nome')->all(),'id','nome'),['prompt' => 'Selecione']);?></div>
                    </div>
                    <hr>
                    
                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h5 class="panel-title"><i class="fa fa-plus "></i> INGREDIENTES</h5>
                        </div>
                        <div class="box-header with-border">

                            

                                <?= Html::beginForm (null, null, ['id' => 'ingrediente']); ?>

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
                                                        'prompt' => 'Selecione um ingrediente...',
                                                        'id' => 'descricao'
                                                    ]) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= Html::label ('Unidade') ?>
                                        <?= Html::textInput ('unidade_id', null, ['class' => 'form-control', 'id' => 'unidade_id']) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= Html::label ('Marca') ?>
                                        <?= Html::textInput ('marca', null, ['class' => 'form-control', 'id' => 'marca']) ?>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <?= Html::label ('Valor Unitário') ?>
                                        <?= Html::textInput ('valoruni', null, ['class' => 'form-control', 'id' => 'valoruni']) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= Html::label ('Quantidade') ?>
                                        <?= Html::textInput ('quantidade', null, ['class' => 'form-control', 'id' => 'quantidade']) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= Html::label ('Data') ?>
                                        <?= Html::textInput ('data', null, ['class' => 'form-control', 'id' => 'data']) ?>
                                    </div>
                                    
                                    </div>
                                    <br>
                                    
                                    <?= Html::button('<b class="fa fa-plus"></b> Adicionar', [
                                        'class' => 'btn btn-success add-ingrediente',
                                    ])?>
                                </div>

                                <?= Html::endForm () ?>

                            

                            <br>
                            
                            <br>

                            <div class="row">
                                <div class="col-md-12">

                                    <?php Pjax::begin(['enablePushState' => false, 'options' => ['class' => 'modal-container'], 'id' => 'ingrediente-list']); ?>

                                    <?= GridView::widget([
                                        'dataProvider' => new \yii\data\ArrayDataProvider([
                                            'allModels' => $model::ingredienteSession ()
                                        ]),
                                        'summary' => '',
                                        'columns' => [
                                            [
                                                'label' => 'Ingredientes',
                                                'value' => 'descricao',
                                            ],
                                            [
                                                'label' => 'Unidade',
                                                'value' => 'unidade_id',
                                            ],
                                            [
                                                'label' => 'Marca',
                                                'value' => 'marca',
                                            ],
                                            [
                                                'label' => 'Quantidade',
                                                'value' => 'quantidade',
                                            ],
                                            [
                                                'label' => 'Valor Unitário',
                                                'value' => 'valoruni',
                                            ],
                                            [
                                                'attribute'=>'data',
                                                'contentOptions' => ['class' => 'text-center'],
                                                'headerOptions' => ['style' => 'width: 10%;'],
                                                'format' => 'raw',             
                                                'value' => function ($model){
                                                    if ($model->data != null){
                                                       return Yii::$app->formatter->asDate($model->data);
                                                    } else {
                                                       return 'Não informado';
                                                    }
                                                },                              
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
                                                                    ]
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
                    </div>
                        <div class="form-group">
                                <div class="pull-right">
                                    <button onClick="history.go(-1)" class="btn btn-default" ><font style="vertical-align: inherit;">Cancelar</font></button>
                                    <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                    
                    </div>

                    
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
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
                                $.pjax.reload({container:'#contrato'});
            
                            console.log(result);
                        }).fail(function(){
                                    console.log(result);
                                });            
                return false;
                });               
JS;
$this->registerJs($script);
?>