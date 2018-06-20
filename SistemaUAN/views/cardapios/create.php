<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cardapio */

$this->title = 'Cadastro de Cardápio';
$this->params['breadcrumbs'][] = ['label' => 'Cardápios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cardapio-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelPrato' => $modelPrato,
        'modelRefeicao' => $modelRefeicao,
    ]) ?>

</div>
