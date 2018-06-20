<?php
use yii\grid\GridView;
use app\models\Cardapio;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CardapiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade total cadastrada**//
$total = Cardapio::find()->count();

?>
<div class="col-lg-12">
    <h4 align="center"><b>RELATÓRIO - CARDÁPIOS</b></h4>
    <br><b>Quantidade total de cardápios: </b> <?= $total ?>
</div>
<hr>

<h4 class="text-center"><b>LISTA DE CARDÁPIOS CADASTRADOS</b></h4><br>
<div class="col-lg-12">
<div class="cardapios-geral">
    <div class="box box-default color-palette">
        <div class="box-body">
                           
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'summary' => '',
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    
                    'categoria',
                    //'prato',
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