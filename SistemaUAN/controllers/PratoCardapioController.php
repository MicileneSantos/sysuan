<?php

namespace app\controllers;

use Yii;
use app\models\PratoCardapio;
use app\models\PratoCardapioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PratoCardapioController implements the CRUD actions for PratoCardapio model.
 */
class PratoCardapioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PratoCardapio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PratoCardapioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PratoCardapio model.
     * @param integer $prato_id
     * @param integer $cardapio_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($prato_id, $cardapio_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($prato_id, $cardapio_id),
        ]);
    }

    /**
     * Creates a new PratoCardapio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PratoCardapio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'prato_id' => $model->prato_id, 'cardapio_id' => $model->cardapio_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PratoCardapio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $prato_id
     * @param integer $cardapio_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($prato_id, $cardapio_id)
    {
        $model = $this->findModel($prato_id, $cardapio_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'prato_id' => $model->prato_id, 'cardapio_id' => $model->cardapio_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PratoCardapio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $prato_id
     * @param integer $cardapio_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($prato_id, $cardapio_id)
    {
        $this->findModel($prato_id, $cardapio_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PratoCardapio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $prato_id
     * @param integer $cardapio_id
     * @return PratoCardapio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($prato_id, $cardapio_id)
    {
        if (($model = PratoCardapio::findOne(['prato_id' => $prato_id, 'cardapio_id' => $cardapio_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
