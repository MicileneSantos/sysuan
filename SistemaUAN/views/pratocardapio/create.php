<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PratoCardapio */

$this->title = 'Create Prato Cardapio';
$this->params['breadcrumbs'][] = ['label' => 'Prato Cardapios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-cardapio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
