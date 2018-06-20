<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProdutoPrato */

$this->title = 'Create Produto Prato';
$this->params['breadcrumbs'][] = ['label' => 'Produto Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-prato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
