<?php
use yii\grid\GridView;
use app\models\Fornecedor;
use yii\helpers\Html;
use yii\helpers\Url;

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

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <header>
            <table> 
                <tr>
                    <th><img  width="100" height="90" src="<?= Url::to('@web/img/ifnmg.jpg') ?>"></img></th>
                    <th align="center"><h5 align="center"><strong>Ministério da Educação<br>
                                Secretaria de Educação Profissional e Tecnológica<br>
                                Instituto Federal do Norte de Minas Gerais – Campus Januária<br>
                                Setor de Nutrição</strong>
                        </h5></th>
                    <th><img class="pull-right" width="80" height="80" src="<?= Url::to('@web/img/me.png') ?>"></img>
                    </th>
                </tr>
                <tr><th colspan="3"></th></tr>
            </table>
        </header>
    </body></html>
<div class="col-lg-12">
    <br><h4 align="center"><b>RELATÓRIO - FORNECEDORES</b></h4>
    <br><b>Quantidade de fornecedores cadastrados: </b> <?= $total ?>

    <br><b>Quantidade total usuarios ativos: </b> <?= $ativos ?>
                       
    <br><b>Quantidade total usuarios inativos: </b> <?= $inativos ?>
                               
</div> <br>
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