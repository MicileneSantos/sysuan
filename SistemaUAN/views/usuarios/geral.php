<?php
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Html;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade de usuários cadastrados**//
$total = User::find()->count();
//** Quantidade total usuarios ativos**//
$ativos = User::find()->where(['AND', ['isAtivo'=>1]])->count();
//**Quantidade total usuarios desativos**//
$inativos = User::find()->where(['isAtivo' => 0])->count();
//** Quantidade total usuarios administradores ativos**//
$admin = User::find()->where(['AND', ['isAtivo'=>1], ['role'=>1]])->count();
//** Quantidade total usuarios nutricionista ativos**//
$nutri = User::find()->where(['AND', ['isAtivo'=>1], ['role'=>2]])->count();
//** Quantidade total usuarios discentes ativos**//
$discente = User::find()->where(['AND', ['isAtivo'=>1], ['role'=>3]])->count();

?>
     
<h4 class="text-center"><b>RELATÓRIO - USUÁRIOS</b></h4>                    
                    <div class="row">
                        <div class="col-lg-12">
                            <b>Quantidade de usuários cadastrados: </b> <?= $total ?>
                        </div>
                        <div class="col-lg-12">
                            <b>Quantidade total usuarios ativos: </b> <?= $ativos ?>
                        </div>
                        <div class="col-lg-12">
                            <b>Quantidade total usuarios inativos: </b> <?= $inativos ?>
                        </div> 
                        <div class="col-lg-12">
                            <b>Quantidade total de administradores ativos: </b> <?= $admin ?>
                        </div> 
                        <div class="col-lg-12">
                            <b>Quantidade total de nutricionistas ativos: </b> <?= $nutri ?>
                        </div> 
                        <div class="col-lg-12">
                            <b>Quantidade total de discentes ativos: </b> <?= $discente ?>
                        </div> 
                        
                    </div> 
               
</div>
<hr>
<h4 class="text-center"><b>LISTA DE USUÁRIOS CADASTRADOS</b></h4><br>

<div class="usuarios-geral">
    <div class="box box-default color-palette">
        <div class="box-body">
                           
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => '',
            /*'rowOptions'=> function($model){
                if ($model->isAtivo == '0'){
                    return ['class'=>'danger'];
                } else {
                    return ['class'=>'success'];
                }         
            },*/
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'], 

            //'id',
            'nome',
            'cpf',
            [
                'attribute'=>'role',
                'format'=>'raw',
                'value'=>function($data){
                    if($data->role==1){
                        return 'Administrador';
                    } else if($data->role==2){
                        return 'Nutricionista';
                    } else if($data->role==3){
                        return 'Discente';
                    }
                },
            ],
            
            'email',
            'telefone',
            
                ],
            ]); ?> 
            
            <div class="box-footer"></div>
        </div>
    </div>           
</div>