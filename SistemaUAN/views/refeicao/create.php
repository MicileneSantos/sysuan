<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Refeicao */

//$this->title = 'Cadastro de Refeição';
//$this->params['breadcrumbs'][] = ['label' => 'Refeicaos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refeicao-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
