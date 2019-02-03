<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prato */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
