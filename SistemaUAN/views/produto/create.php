<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Produto */

//$this->title = 'Cadastro de Produto';
//$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
