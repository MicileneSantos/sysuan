<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sugestoes */

$this->title = Yii::t('app', 'Envio de Sugestões');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sugestoes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sugestoes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
