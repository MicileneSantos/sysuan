<?php

namespace app\controllers;

use Yii;
use app\models\Cardapio;
use app\models\CardapiosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PratoCardapio;
use app\models\RefeicaoPrato;
use kartik\mpdf\Pdf;
//use app\models\Model;

/**
 * CardapiosController implements the CRUD actions for Cardapio model.
 */

class CardapiosController extends Controller
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
        $searchModel = new CardapiosSearch();
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
     * Lists all Cardapios models.
     * @return mixed
     */
    public function actionIndex()
    {
        if ((Yii::$app->user->can('nutricionista'))){
            $searchModel = new CardapiosSearch();
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
     * Displays a single Cardapios model.
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
     * Creates a new Cardapios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ((Yii::$app->user->can('nutricionista'))){
            
            $model = new Cardapio();
            $modelPrato = [new PratoCardapio];
            $modelRefeicao = [new RefeicaoPrato];

            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                Yii::$app->getSession()->setFlash('info', [
                    'type' => 'success',
                    'duration' => 1200,
                    'message' => 'Cadastro realizado com sucesso. ',
                    'title' => '',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]);
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'modelPrato' => (empty($modelPrato)) ? [new PratoCardapio()] : $modelPrato,
                            'modelRefeicao' => (empty($modelRefeicao)) ? [new RefeicaoPrato()] : $modelRefeicao,
                ]);
            }
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Updates an existing Cardapios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if ((Yii::$app->user->can('nutricionista'))){
        
            $model = $this->findModel($id);
            $modelPrato = $model->pratoCardapios;          


            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                Yii::$app->getSession()->setFlash('info', [
                                                'type' => 'info',
                                                'duration' => 1200,
                                                'message' => 'Alteração realizada com sucesso. ',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'left'
                                                ]);
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'modelPrato' => (empty($modelPrato)) ? [new PratoCardapio] : $modelPrato,]);
            }
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }
     
    /**
     * Deletes an existing Cardapios model.
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
                                                'positonX' => 'left'
                                                ]);
            return $this->redirect(['index']);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Finds the Cardapios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cardapios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cardapio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionAdicionaprato()
    {
        $produtoModel = new \app\models\PratoCardapio();

        if ($produtoModel->load(Yii::$app->request->post()) && $produtoModel->save()) {
            return $this->redirect(['view', 'id' => $produtoModel->prato_id]);
        }

        return $this->redirect(['/prato']);
    }
    
    public function actionInserirPrato($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;
            $query->select('id, prato AS text')
                ->from('m_prato')
                ->where(['like', 'prato', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => \app\models\PratoCardapio::find($id)->prato];
        }
        return $out;
    }
}
