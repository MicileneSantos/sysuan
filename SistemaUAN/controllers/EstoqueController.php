<?php

namespace app\controllers;

use Yii;
use app\models\Estoque;
use app\models\EstoqueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use mPDF;
use kartik\mpdf\Pdf;

/**
 * EstoqueController implements the CRUD actions for Estoque model.
 */
class EstoqueController extends Controller
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
    
    /*
     * Exportar PDF
     */
    public function actionGerar()
    {  
        $searchModel = new EstoqueSearch();
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
    
    public function actionGerarpdf()
    {  
                $searchModel = new EstoqueSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                  $content = $this->renderPartial('', [
                              'dataProvider' => $dataProvider,
                              'searchModel' => $searchModel,
                  ]);

                $pdf = new Pdf([       
                      'mode' => Pdf::MODE_CORE,        
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
     * Lists all Estoque models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstoqueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estoque model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Estoque model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Estoque();
        //$estoque = 0;
        //$lancamento = 0;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->data=date('Y-m-d h:m:s');
            $model->save();
            //$estoque = Estoque::find()->where("produto=:produto", [":produto" => $model->produto]);
            $lancamento = (new Query())->from('m_estoques')->where(['AND', ['qtdeestoque' => $model->qtdeestoque]]);

            if ($model->tipolanc == 'Entrada'){   
               // $model->qtdeestoque = Estoque::find()->where(['qtdeestoque' => $model->qtdeestoque]);
                //$model->qtdeestoque = (Estoque::findOne('qtdeestoque'==$model->qtdeestoque));
                //$lancamento = $model->qtde;
                $model->qtdeestoque += $lancamento;
                $model->save();
            }else{
                $lancamento = $model->qtde - $estoque;
                $model->qtdeestoque -= $lancamento;
                $model->save();
            }
            //echo " lanc ".$lancamento;  echo " estoque ".$model->qtdeestoque; die;
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estoque model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estoque model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estoque model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estoque the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estoque::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
