<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

//$this->title = 'Visualização de dados cadastrados';
//$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="usuarios-view">
    
    <div class="panel panel-success">
        <div class="panel-heading"><h5 class="panel-title">Dados do Usuário</h5></div>
        <div class="panel-body">
            <div class="pull-right">       
                <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-primary','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
            </div><br><br>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'nome',
                    'cpf',
                    'email:email',
                    'rua',
                    'numero',
                    'complemento',
                    'bairro',
                    'cidade',
                    'estado',
                    'telefone',
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
                    'password_hash',
                ],


            ]) ?>
        
        </div>
    </div>
</div>
