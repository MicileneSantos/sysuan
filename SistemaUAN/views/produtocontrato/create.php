<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProdutoContrato */

$this->title = 'Create Produto Contrato';
$this->params['breadcrumbs'][] = ['label' => 'Produto Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-contrato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
