<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContactForm1 */

$this->title = 'Sugestão';
$this->params['breadcrumbs'][] = ['label' => 'Sugestão', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-form1-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
