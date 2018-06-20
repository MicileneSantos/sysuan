<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sugestoes */

$this->title = Yii::t('app', 'Alterar Sugestão', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sugestoes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Alterar');
?>
<div class="sugestoes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
