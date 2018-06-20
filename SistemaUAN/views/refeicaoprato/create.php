<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefeicaoPrato */

$this->title = 'Create Refeicao Prato';
$this->params['breadcrumbs'][] = ['label' => 'Refeicao Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refeicao-prato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
