<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
?>


<div class="box box-solid">
	<div class="box-body table-responsive no-padding">
	<?= DetailView::widget([
		'model' => $model,
		'options'=>['class'=>'table'],
		'attributes' => [
			'titulo',
			'conteudo',
			[
				'attribute' => 'Data',
				'value' => Yii::$app->formatter->asDate($model->data),
				'format' => 'raw',
			],
			[
				'attribute' => 'imageFile',
				'format' => 'raw',
				'value' =>  (!empty($model->imageFile) ? Html::a($model->imageFile, ['notice', 'nid' => $model->id], $htmlOptions=["target"=>"_blank", 'data' => ['method' => 'post',]]) : " - ")
			],
		],
	]) ?>
	</div>
</div>
