<?php
use yii\grid\GridView;
use app\models\Produto;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade total cadastrada**//
$total = Produto::find()->count();

?>

<div class="col-lg-12">
    <h4 align="center"><b>RELATÓRIO - PRODUTO</b></h4>
    <br><b>Quantidade de produtos cadastrados: </b> <?= $total ?>
        
</div> <hr>
<h4 class="text-center"><b>LISTA DE PRODUTOS CADASTRADOS</b></h4><br>
<div class="produto-geral">
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
                    'categoria_id',
                    'unidade_id',

                   
                ],
            ]); ?> 
            
            <div class="box-footer"></div>
        </div>
    </div>           
</div>