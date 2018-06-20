<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'Cadastro de Notícias';
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticias-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
