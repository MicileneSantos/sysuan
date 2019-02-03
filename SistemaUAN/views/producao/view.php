<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producao */

/*$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Producaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="producao-view">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Dados do Registro de Produção</h5>
        </div>
        <div class="panel-body">
            <div class="pull-right">       
                <?= Html::a('<b class="fa fa-arrow-left"></b> Voltar', ['index'], ['class' => 'btn btn-default','title' => 'Voltar', 'id' => 'modal-btn-voltar'])?>
            </div><br><br>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'prato_id',
                    'quantidade',
                ],
            ]) ?>
        </div>
    </div>
</div>
