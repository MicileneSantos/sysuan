<?php

namespace app\controllers;

use Yii;
use app\models\Produto;
use app\models\ProdutoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
{
    /**
     * {@inheritdoc}
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

    /*
     * Exportar PDF
     */
    public function actionGerar()
    {  
        $searchModel = new ProdutoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $content = $this->renderPartial('geral', [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                ]);

        $pdf = new Pdf([              
                'format' => Pdf::FORMAT_A4,        
                'orientation' => Pdf::ORIENT_PORTRAIT,       
                'destination' => Pdf::DEST_BROWSER,        
                'content' => $content,       
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',        
                'cssInline' => '.kv-heading-1{font-size:18px}',          
                'options' => ['title' => 'Relatório'],         
                    'methods' => [ 
                        'SetHeader'=>['SysUAN'], 
                        'SetFooter'=>['{PAGENO}'],
                        'SetFooter' => ['<p style="text-align: center;font-size: 8px;">'
                            . 'Documento emitido pelo SysUAN. '
                            . 'Todos os Direitos Reservados &copy; IFNMG - Januária 2018</p>'],
                        ]
                    ]);  

                return $pdf->render();       
    }
    
    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndex()
    {   if ((Yii::$app->user->can('nutricionista'))){
            $searchModel = new ProdutoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Displays a single Produto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if ((Yii::$app->user->can('nutricionista'))){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ((Yii::$app->user->can('nutricionista'))){
            $model = new Produto();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('info', [
                        'type' => 'success',
                        'duration' => 1200,
                        'message' => 'Cadastro realizado com sucesso. ',
                        'title' => '',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['index']);
            } elseif (Yii::$app->request->isAjax) {
                return $this->renderAjax('_form', [
                        'model' => $model
                ]);
            } else {
                return $this->render('_form', [
                            'model' => $model
                ]);
            }

            /*return $this->renderAjax('create', [
                'model' => $model,
            ]);*/
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Updates an existing Produto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if ((Yii::$app->user->can('nutricionista'))){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('info', [
                        'type' => 'info',
                        'duration' => 1200,
                        'message' => 'Alteração realizada com sucesso. ',
                        'title' => '',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ((Yii::$app->user->can('nutricionista'))){
            $this->findModel($id)->delete();

            Yii::$app->getSession()->setFlash('info', [
                'type' => 'info',
                'duration' => 1200,
                'message' => 'Exclusão realizada com sucesso. ',
                'title' => '',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }        
    }

    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
