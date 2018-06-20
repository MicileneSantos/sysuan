<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Fornecedor */

$this->title = 'Cadastro de Fornecedores';
$this->params['breadcrumbs'][] = ['label' => 'Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fornecedor-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
