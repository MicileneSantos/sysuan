<?php

namespace app\controllers;

use Yii;
use app\models\Contrato;
use app\models\ContratoSearch;
use app\models\ProdutoContrato;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratoController implements the CRUD actions for Contrato model.
 */
class ContratoController extends Controller
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

    /**
     * Lists all Contrato models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContratoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contrato model.
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
     * Creates a new Contrato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ((Yii::$app->user->can('nutricionista'))){
            $model = new Contrato();
            $model::ingredienteSession ();
        
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                //$model->data=date('Y-m-d h:m:s');
                
                Yii::$app->getSession()->setFlash('info', [
                            'type' => 'success',
                            'duration' => 1200,
                            'message' => 'Cadastro realizado com sucesso. ',
                            'title' => '',
                            'positonY' => 'top',
                            'positonX' => 'right'
                    ]);
                    return $this->redirect(['index']);
                } else {
                    return $this->render('create', [
                        'model' => $model
                    ]);
            }
        } else {
           throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Updates an existing Contrato model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       if ((Yii::$app->user->can('nutricionista'))){
            $model = $this->findModel($id);
            $model->carregaIngredientes();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('info', [
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
     * Deletes an existing Contrato model.
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
     * Finds the Contrato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contrato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contrato::findOne($id)) !== null) {
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
                'marca' => $request->post('marca'),
                'unidade_id' => $request->post('unidade_id'),
                'contrato_id' => $request->post('contrato_id'),
                'valoruni' => $request->post('valoruni'),
                'quantidade' => $request->post('quantidade'),
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
