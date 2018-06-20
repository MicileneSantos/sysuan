<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contrato */

$this->title = 'Cadastrar Contrato';
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
