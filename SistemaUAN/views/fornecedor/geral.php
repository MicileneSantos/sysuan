<?php
use yii\grid\GridView;
use app\models\Fornecedor;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade total cadastrada**//
$total = Fornecedor::find()->count();
//** Quantidade total fornecedores ativos**//
$ativos = Fornecedor::find()->where(['AND', ['isAtivo'=>1]])->count();
//**Quantidade total fornecedores desativos**//
$inativos = Fornecedor::find()->where(['isAtivo' => 0])->count();

?>
<div class="col-lg-12">
    <h4 align="center"><b>RELATÓRIO - FORNECEDORES</b></h4>
    <br><b>Quantidade de fornecedores cadastrados: </b> <?= $total ?>

    <br><b>Quantidade total usuarios ativos: </b> <?= $ativos ?>
                       
    <br><b>Quantidade total usuarios inativos: </b> <?= $inativos ?>
                               
</div> <hr>
<h4 class="text-center"><b>LISTA DE FORNECEDORES CADASTRADOS</b></h4><br>
<div class="col-lg-12">
    <b>*Verde: Fornecedores ativos</b><br>
    <b>*Vermelho: Fornecedores inativos</b>
</div><br>
<div class="fornecedor-geral">
    <div class="box box-default color-palette">
        <div class="box-body">
                           
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => '',
            'rowOptions'=> function($model){
                if ($model->isAtivo == '0'){
                    return ['class'=>'danger'];
                } else {
                    return ['class'=>'success'];
                }         
            },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'], 

            //'id',
            'nome',
            'cnpj',          
            'email',
            'telefone',
            
                   
                ],
            ]); ?> 
            
            <div class="box-footer"></div>
        </div>
    </div>           
</div>