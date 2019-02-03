<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Unidade */

//$this->title = 'Cadastro de Unidades de medida';
//$this->params['breadcrumbs'][] = ['label' => 'Unidades de Medida', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidade-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
