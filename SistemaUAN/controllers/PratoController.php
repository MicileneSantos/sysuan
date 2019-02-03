<?php

namespace app\controllers;

use Yii;
use app\models\Prato;
use app\models\PratoSearch;
use app\models\ProdutoPrato;
use app\models\Produto;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\db\Query;

/**
 * PratoController implements the CRUD actions for Prato model.
 */
class PratoController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
        $searchModel = new PratoSearch();
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
     * @param $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction ($action)
    {
        if (in_array ($action->id, ['index', 'view'])) {
            Yii::$app->session->remove ('ingredientes');
        }
        return parent::beforeAction ($action);
    }

    /**
     * Lists all Prato models.
     * @return mixed
     */
    public function actionIndex() {
        
        if ((Yii::$app->user->can('nutricionista'))){
            $searchModel = new PratoSearch();
            //$relacao = ProdutoPrato::find();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        //'relacao' => $relacao,
            ]);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Displays a single Prato model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if ((Yii::$app->user->can('nutricionista'))){

            $model = $this->findModel($id);
            $modelProduto = new ProdutoPrato();
            $produtos = \app\models\ProdutoPrato::find(['prato_id' => $id])->all();
            $modelProduto->prato_id = $model->id;

            return $this->render('view', [
                'model' => $model,
                'modelProduto' => $modelProduto,
                'produtos' => $produtos,
            ]);
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }
        
    public function  actionSalvar($id){
       $model = $this->findModel($id);
       $model::ingredienteSession ();
       $query = \app\models\ProdutoPrato::find()->where(['prato_id' => $id ]);
       $data = new \yii\data\ActiveDataProvider ([
            'query' => $query
        ]);
       
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
                $model->save(false);
                Yii::$app->getSession()->setFlash('success', [
                        'type' => 'success',
                        'duration' => 1200,
                        'message' => 'Cadastro realizado com sucesso. ',
                        'title' => '',
                        'positonY' => 'top',
                        'positonX' => 'right'
                ]);
                $model->save(false);
                return $this->redirect(array('prato/index'));
            }
        return $this->render('create', [
            'model' => $model,
            'data' => $data,            
        ]);   
    }


    /**
     * Creates a new Prato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if ((Yii::$app->user->can('nutricionista'))){
            $model = new Prato();
            $model::ingredienteSession ();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //$modelProduto->unidade_id = $produto->unidade_id;

                /*Yii::$app->getSession()->setFlash('info', [
                        'type' => 'success',
                        'duration' => 1200,
                        'message' => 'Cadastro realizado com sucesso. ',
                        'title' => '',
                        'positonY' => 'top',
                        'positonX' => 'right'
                ]);*/
                //return $this->redirect(['view', 'id' => $model->id]);
                //$model->prato_id = $model->id;
                $model::ingredienteSession ();
                return $this->redirect(array('prato/salvar?id=' . $model->id));
            } else {
                return $this->render('create', [
                    'model' => $model,
                    //'modelProduto' => $modelProduto,
                    //'produto' => (empty($produto)) ? [new Produto] : $produto,
                ]);
            } 
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    public function actionUpdate($id) {
        if ((Yii::$app->user->can('nutricionista'))){
            $model = $this->findModel($id);
            $model->carregaIngredientes();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', [
                        'type' => 'success',
                        'duration' => 1200,
                        'message' => 'Alteração realizada com sucesso. ',
                        'title' => '',
                        'positonY' => 'top',
                        'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Deletes an existing Prato model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if ((Yii::$app->user->can('nutricionista'))){
            $this->findModel($id)->delete();
            
            Yii::$app->getSession()->setFlash('danger', [
                'type' => 'danger',
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
     * Finds the Prato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Prato::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionInserirProduto($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;
            $query->select('id, descricao AS text')
                ->from('produto')
                ->where(['like', 'descricao', $q])
                ->limit(25);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => \app\models\ProdutoPrato::find($id)->descricao];
        }
        return $out;
    }

    public function actionAdicionaproduto()
    {
        $modelProduto = new \app\models\ProdutoPrato();

        if ($modelProduto->load(Yii::$app->request->post()) && $modelProduto->save()) {
            return $this->redirect(['view', 'id' => $modelProduto->prato_id]);
        }

        return $this->redirect(['/prato']);
    }

    /**
     * @throws BadRequestHttpException
     */
    public function actionAddIngrediente()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {

            $session = Yii::$app->session;
            $ingredientes = $session->get ('ingredientes');

            $id = $request->post('id');

            $ingredientes[$id] = [
                'produto_id' => $id,
                'descricao' => $request->post('value'),
                'percapita' => $request->post('percapita'),
            ];

            $session['ingredientes'] = $ingredientes;

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['data' => $session['ingredientes']];
        }

        throw new BadRequestHttpException();
    }

    /**
     * @throws BadRequestHttpException
     */
    public function actionRemoveIngrediente()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {

            $session = Yii::$app->session;
            $ingredientes = $session->get ('ingredientes');

            $id = $request->post('id');

            unset($ingredientes[$id]);

            $session['ingredientes'] = $ingredientes;

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['data' => $session['ingredientes']];
        }

        throw new BadRequestHttpException();
    }
}
