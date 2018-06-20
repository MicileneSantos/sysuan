<?php

namespace app\controllers;

use Yii;
use app\models\Noticias;
use app\models\NoticiasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\filters\AccessControl;
use yii\web\UploadedFile;
use mPDF;
use kartik\mpdf\Pdf;

/**
 * NoticiasController implements the CRUD actions for Noticias model.
 */
class NoticiasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=> AccessControl::className(),
                'only'=> ['create','delete','update',],
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

    /**
    * Publicar noticias
    */
    public function actionPublicar()
    {
        if  (Yii::$app->user->can('nutricionista')){ 
            $model = new Noticias();
            if ($model->isAtivo = '1'){
                return $this->redirect(['publicar']);
            }

        }else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Lists all Noticias models.
     * @return mixed
     */
    public function actionIndex()
    {
        if  (Yii::$app->user->can('nutricionista')){ 
            $searchModel = new NoticiasSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }
    
     /**
     * Displays a single Noticias model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if  (Yii::$app->user->can('nutricionista')){ 
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Creates a new Noticias model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if  (Yii::$app->user->can('nutricionista')){
            $model = new Noticias();

            if ($model->load(Yii::$app->request->post())&&$model->save()){ 
                
                $model->foto = UploadedFile::getInstance($model, 'foto');
                $model->imageFile = $model->foto->name;
                $model->dta=date('Y-m-d h:m:s');
                $model->save();

                $uploadPath = Yii::getAlias('@webroot/uploads');
                $model->foto->saveAs($uploadPath .'/'. $model->foto->name);

                Yii::$app->getSession()->setFlash('info', [
                                                'type' => 'success',
                                                'duration' => 10000,
                                                'message' => ' Notícia cadastrada com sucesso.',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'left'
                                                ]);

                return $this->redirect(["noticias/index"]);
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
     * Updates an existing Noticias model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if  (Yii::$app->user->can('nutricionista')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                Yii::$app->getSession()->setFlash('success', [
                                                    'type' => 'success',
                                                    'duration' => 10000,
                                                    'message' => 'Notícia alterada com sucesso.',
                                                    'title' => '',
                                                    'positonY' => 'top',
                                                    'positonX' => 'left'
                                                    ]);

                return $this->redirect(["noticias/index"]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Deletes an existing Noticias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if  (Yii::$app->user->can('nutricionista')){
            $this->findModel($id)->delete();
            
            Yii::$app->getSession()->setFlash('success', [
                                                    'type' => 'success',
                                                    'duration' => 10000,
                                                    'message' => 'Notícia excluída com sucesso.',
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
     * Finds the Noticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noticias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAtivar ($id){
        if ((Yii::$app->user->can('nutricionista'))){        
            $model = $this->findModel($id); 
            $ativo = $model->isAtivo;                  
            
                if ($ativo == '0'){          
                    $model->isAtivo = '1';    
                    $model->save(false);
                }

            $model->isAtivo = '1';
            $model->save(false);
            $this->redirect(array("noticias/index"));   
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }         
    }
    
    public function actionDesativar ($id){
        if ((Yii::$app->user->can('nutricionista'))){
            $model = $this->findModel($id);
            $model->isAtivo='0';  
            $model->save(false);  
           
                          
            $this->redirect(array("noticias/index"));                
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }
}
