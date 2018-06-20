<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContactForm1 */

$this->title = 'Update Contact Form1: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Contact Form1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_sugestao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contact-form1-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
