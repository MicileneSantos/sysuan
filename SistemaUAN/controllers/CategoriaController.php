<?php

namespace app\controllers;

use Yii;
use app\models\Categoria;
use app\models\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use \yii\filters\AccessControl;
use mPDF;
use kartik\mpdf\Pdf;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=> AccessControl::className(),
                'only'=> ['create','delete','update'],
                'rules'=> [
                    [
                        'allow'=> true,
                        'roles'=> ['@']
                    ]
                ]
            ],
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
        $searchModel = new CategoriaSearch();
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
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        if ((Yii::$app->user->can('nutricionista'))){

            $model = new Categoria();
            $searchModel = new CategoriaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if  (Yii::$app->user->can('nutricionista')){
            $model = new Categoria();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                
                Yii::$app->getSession()->setFlash('info', [
                                                'type' => 'success',
                                                'duration' => 10000,
                                                'message' => ' Categoria cadastrada com sucesso.',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'left'
                                                ]);
                
                return $this->redirect(['index']);
            }else{
                return $this->render('create', [
                   'model' => $model,
                ]);
            } 
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        } 
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if  (Yii::$app->user->can('nutricionista')){

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                
                Yii::$app->getSession()->setFlash('info', [
                                                'type' => 'info',
                                                'duration' => 10000,
                                                'message' => 'Atualização realizada com sucesso. ',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'left'
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
     * Deletes an existing Categoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if  (Yii::$app->user->can('nutricionista')){
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('info', [
                                                    'type' => 'info',
                                                    'duration' => 10000,
                                                    'message' => 'Exclusão realizada com sucesso. ',
                                                    'title' => '',
                                                    'positonY' => 'top',
                                                    'positonX' => 'left'
                                                    ]);
            return $this->redirect(['index']);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
