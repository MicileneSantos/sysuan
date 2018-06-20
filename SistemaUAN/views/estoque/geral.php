<?php
use yii\grid\GridView;
use app\models\Estoque;
use yii\helpers\Html;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstoqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade total cadastrada**//
$total = Estoque::find()->count();

$totalsaida = Estoque::find()->where(['AND', ['tipolanc' => 'Saída']])->count();

$totalentrada = Estoque::find()->where(['AND', ['tipolanc' => 'Entrada']])->count();

//**************Recupera do BD e soma*****************//
//$query = (new Query())->from('m_estoques')->where(['AND', ['tipolanc' => 'Entrada']]);
//$estoque = $query->sum('qtdeestoque');

?>
<div class="col-lg-12">
    <h4 align="center"><b>Movimentações de Estoque</b></h4>

    <!--br><b>Quantidade total em estoque: </b> <?php //$estoque ?>-->
    
    <br><b>Total de lançamentos: </b> <?= $total ?>
    <br><b>Total de lançamentos de entrada: </b> <?= $totalentrada ?>
    <br><b>Total de lançamentos de saída: </b> <?= $totalsaida ?>          
</div> <hr> 

<div class="estoque-geral">
    <div class="box box-default color-palette">
        <div class="box-body">
                           
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'summary' => '',
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'tipolanc',
                    'fornecedor',
                    'produto',
                    'qtde',
                    'qtdeestoque',
                    [
                        'label'=>'Data',
                        'format' => 'raw',             
                        'value' => function ($model){
                            if ($model->data != null){
                                return Yii::$app->formatter->asDate($model->data);
                            } else {
                                return 'Não informado';
                            }
                        },                              
                    ],
                        
                    //['class' => 'yii\grid\ActionColumn',],
                   
                ],
            ]); ?> 

            <div class="box-footer"></div>
        </div>
    </div>           
</div>