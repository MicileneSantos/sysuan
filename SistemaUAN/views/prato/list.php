<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
//use app\models\ProdutoPratoSearch;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredientes';
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'action' => Url::to(['prato/gerar']),
    'method' => 'get',
]);?>

<div class="pull-right">       
    <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['site/nutricionista'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
    <?= Html::a('<b class="fa fa-plus"></b> Novo', ['create'], ['class' => 'btn btn-success' ])?>
    <?= Html::a('<b class="fa fa-download"></b>', ['gerar'], ['target'=>'_blank','class' => 'btn btn-default','title' => 'Exportar', 'id' => 'modal-btn-pdf'])?>
</div>
<hr>
<div class="produto-prato-list">

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
                            