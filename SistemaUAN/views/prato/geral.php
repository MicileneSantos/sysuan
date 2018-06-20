<?php
use yii\grid\GridView;
use app\models\Prato;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade de usuários cadastrados**//
$total = Prato::find()->count();

?>

<h4 class="text-center"><b>RELATÓRIO - PRATO</b></h4>                    
                    <div class="row">
                        <div class="col-lg-12">
                            <br><b>Quantidade de pratos cadastrados: </b> <?= $total ?>
                        </div>
                        
                    </div> 
               
</div>
<hr>
<h4 class="text-center"><b>LISTA DE PRATOS CADASTRADOS</b></h4><br>
<div class="usuarios-geral">
    <div class="box box-default color-palette">
        <div class="box-body">
                           
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => '',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'], 

            //'id',
            'descricao'
            
                   
                ],
            ]); ?> 
            
            <div class="box-footer"></div>
        </div>
    </div>           
</div>