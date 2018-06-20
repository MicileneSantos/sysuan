<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\EstoqueSearch;
use yii\db\Query;
use app\models\Estoque;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstoqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Viagens Solicitadas';
$this->params['breadcrumbs'][] = $this->title;

$qtdeestoque = Estoque::getQtde($dataProvider->models, 'qtde');

?>
<div class="estoque-view-quantidade">
    
    <div class="panel panel-heading">
        <div class="panel-heading">
        <h5 class="panel-title">RELATÓRIO</h5>
        </div>
    <div class="panel-body"> 
            <div class="row">
                <div class="col-lg-12">      
                    <b>Durante o período, </b>  <?= $qtdeestoque ?>
                    <b> alunos foram contemplados com viagens técnicas.</b>  
                </div>
            </div>
    </div>
    </div>
</div>