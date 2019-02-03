<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Producao */

$this->title = 'Create Producao';
$this->params['breadcrumbs'][] = ['label' => 'Producaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
