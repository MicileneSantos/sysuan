<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Form1s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-form1-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contact Form1', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sugestao',
            'name',
            'email:email',
            'subject',
            'body:ntext',
            //'verifyCode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
