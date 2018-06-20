<?php
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//**Quantidade de usuários cadastrados**//
$total = User::find()->count();

?>
<div class="col-lg-12">
    <h4 align="center"><b>RELATÓRIO - SUGESTÕES RECEBIDAS</b></h4>
    <br><b>Quantidade de sugestões recebidas: </b> <?= $total ?>
</div>
<hr>
<h4 class="text-center"><b>LISTA DE SUGESTÕES RECEBIDAS</b></h4><br>


<div class="usuarios-geral">
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
            'cpf',
            [
                'label'=>'Perfil',
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
            //'senha',
            /*[
                'label'=>'Status',
                'format' => 'raw',
                'value' => function ($data){
                    if ($data->isAtivo == 0){
                            $icon = '<span class="btn btn-danger btn-xs" role="button"> Desativado </span> '
                            . ' <label class="badge bagde-danger"></label> ';
                            $label = $icon;
                            $url = Yii::$app->urlManager->createUrl(["/usuarios/ativar" , "id"=>$data->id]);
                            return  Html::a($label, $url) ;
                        } else if ($data->isAtivo == 1) {
                            $icon = '<span class="btn btn-success btn-xs" role="button"> Ativo </span> '
                            . ' <label class="badge bagde-success"></label> ';
                            $label = $icon;
                            $url = Yii::$app->urlManager->createUrl(["/usuarios/desativar" , "id"=>$data->id]);
                            return  Html::a($label, $url) ;
                        } 
                    
                },
            ],*/
                   
                ],
            ]); ?> 
            
            <div class="box-footer"></div>
        </div>
    </div>           
</div>