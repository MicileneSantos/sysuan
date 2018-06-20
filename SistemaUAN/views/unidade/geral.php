<?php
use yii\grid\GridView;
use app\models\Unidade;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade de unidade de medida cadastradas**//
$total = Unidade::find()->count();

?>
<div class="col-lg-12">
    <h4 align="center"><b>RELATÓRIO - UNIDADE DE MEDIDA</b></h4>
    <br><b>Quantidade total de unidade de medida: </b> <?= $total ?>
</div>
<hr>
<h4 class="text-center"><b>LISTA DE UNIDADE DE MEDIDA CADASTRADAS</b></h4><br>
<div class="unidade-geral">
    <div class="box box-default color-palette">
        <div class="box-body">
                           
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => '',
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'], 

                //'id',
                'descricao',
            
                   
            ],
        ]); ?> 
            
            <div class="box-footer"></div>
        </div>
    </div>           
</div>