<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Produto;
use app\models\ProdutoPrato;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Prato */
/* @var $form yii\widgets\ActiveForm */

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
        var ingredienteId = $("#descricao").val();
        var ingredienteValue = $("#descricao option:selected").text();
        var percapita = $("#percapita").val();
    
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data:{id:ingredienteId, value:ingredienteValue, percapita: percapita},
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

?>

<div class="prato-form">
    <div class="panel panel-success">
    <div class="panel-heading">
        <h5 class="panel-title">CADASTRO DE PRATO</h5></div>
        <div class="box box-success">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
            <div class="box-header with-border">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <hr>

                    <?php //Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>

                    <?php //Html::a('<b class="fa fa-plus"></b> Adicionar ingredientes', ['produto', 'id' => $model['id']], ['class' => 'btn btn-success' ])?>

                    <?php //Html::a('<span class="btn btn-success"><b class="fa fa-plus"></b></span>', ['produto', 'id' => $model['id']], ['title' => 'Adicionar ingredientes', 'id' => 'modal-btn-view']);?>

                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h4><i class=""></i>INGREDIENTES</h4>
                        </div>
                        <div class="panel-body">

                            <div class="row">

                                <?= Html::beginForm (null, null, ['id' => 'ingrediente']); ?>

                                <div class="input-append">
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
                                    <div class="col-md-2">
                                        <?= Html::label ('Per capita') ?>
                                        <?= Html::textInput ('percapita', null, ['class' => 'form-control', 'id' => 'percapita']) ?>
                                    </div>
                                    <br>
                                    <?= Html::button('<b class="fa fa-plus"></b> Adicionar ingredientes', [
                                        'class' => 'btn btn-success add-ingrediente',
                                    ])?>
                                </div>

                                <?= Html::endForm () ?>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-12">

                                    <?php Pjax::begin(['enablePushState' => false, 'options' => ['class' => 'modal-container'], 'id' => 'ingrediente-list']); ?>

                                    <?= GridView::widget([
                                        'dataProvider' => new \yii\data\ArrayDataProvider([
                                            'allModels' => $model::ingredienteSession ()
                                        ]),
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
                    </div>

                    <div class="form-group">
                        <div class="pull-right"><?= Html::a('Cancelar', ['prato/index'], ['class' => 'btn btn-default']) ?>
                        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
Modal::begin(
    [
        'id' => 'modal',
        'header' => Html::tag('span', null),
        'options' => [
            'tabindex' => false,
            'data-pjax' => true
        ],
        'clientOptions' => ['backdrop' => false, 'keyboard' => false],
        'clientEvents' => [
            'hide.bs.modal' => 'function() { 
			$("#modal .modal-header span").empty();
			$("#modal-content").empty();
		}'
        ],
        'size' => Modal::SIZE_DEFAULT
    ]
);

echo Html::tag('div', '', ['id'=>'modal-content']);

Modal::end();
?>