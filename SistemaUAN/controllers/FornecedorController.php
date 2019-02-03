<?php

namespace app\controllers;

use Yii;
use app\models\Fornecedor;
use app\models\FornecedorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\filters\AccessControl;
//use mPDF;
use kartik\mpdf\Pdf;

/**
 * FornecedorController implements the CRUD actions for Fornecedor model.
 */
class FornecedorController extends Controller
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
        $searchModel = new FornecedorSearch();
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
     * Lists all Fornecedor models.
     * @return mixed
     */
    public function actionIndex()
    {
        if ((Yii::$app->user->can('nutricionista'))){
            $searchModel = new FornecedorSearch();
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
     * Displays a single Fornecedor model.
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
     * Creates a new Fornecedor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ((Yii::$app->user->can('nutricionista'))){
    
            $model = new Fornecedor();
            $model->isAtivo = 1;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('info', [
                                                'type' => 'success',
                                                'duration' => 1000,
                                                'message' => 'Cadastro realizado com sucesso. ',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'right'
                                                ]);
                return $this->redirect(['index']);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Updates an existing Fornecedor model.
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
                                                    'duration' => 1000,
                                                    'message' => 'Atualização de dados realizada com sucesso. ',
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
     * Deletes an existing Fornecedor model.
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
                                                'duration' => 1000,
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
     * Finds the Fornecedor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fornecedor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fornecedor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página requisitada não existe.');
    }

    public function actionAtivar ($id){
        if ((Yii::$app->user->can('nutricionista'))){        
            $model = $this->findModel($id); 
            $ativo = $model->isAtivo;                  
            
                if ($ativo == '0'){     
                   
                    $model->isAtivo = '1';    
                    $model->save(false);

                    Yii::$app->getSession()->setFlash('success', [
                        'type' => 'success',
                        'duration' => 10000,
                        'message' => 'Fornecedor: ' . $model->nome . ' ativado com sucesso.',
                        'title' => '',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
            }
            $model->isAtivo = '1';
            $model->save(false);
            $this->redirect(array("fornecedor/index"));   
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }         
    }
    
    public function actionDesativar ($id){
        if ((Yii::$app->user->can('nutricionista'))){
            $model = $this->findModel($id);
            $model->isAtivo='0';  
            $model->save(false);  
            
            Yii::$app->getSession()->setFlash('danger', [
                'type' => 'danger',
                'duration' => 10000,
                'message' => 'Fornecedor: ' . $model->nome . ' desativado com sucesso.',
                'title' => '',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
                          
            $this->redirect(array("fornecedor/index"));                
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }
}
