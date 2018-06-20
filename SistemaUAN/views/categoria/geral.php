<?php
use yii\grid\GridView;
use app\models\Categoria;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade de usuários cadastrados**//
$total = Categoria::find()->count();

?>

<div class="col-lg-12">
    <h4 align="center"><b>RELATÓRIO - CATEGORIA</b></h4>
    <br><b>Quantidade de categorias cadastradas: </b> <?= $total ?>
           
</div> <hr>
<h4 class="text-center"><b>LISTA DE CATEGORIAS CADASTRADAS</b></h4><br>
<div class="categoria-geral">
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