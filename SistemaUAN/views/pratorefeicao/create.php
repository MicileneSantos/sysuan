<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PratoRefeicao */

$this->title = 'Create Prato Refeicao';
$this->params['breadcrumbs'][] = ['label' => 'Prato Refeicaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-refeicao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
