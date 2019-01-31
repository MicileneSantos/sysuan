<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */

$this->title = 'Cadastro de Subcategoria';
$this->params['breadcrumbs'][] = ['label' => 'Subcategorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoria-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
