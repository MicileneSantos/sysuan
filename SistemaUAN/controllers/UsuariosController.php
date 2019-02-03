<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use yii\filters\AccessControl;
use app\models\AuthAssignment;
use yii\web\ForbiddenHttpException;
use mPDF;
use kartik\mpdf\Pdf;

/**
 * UsuariosController implements the CRUD actions for User model.
 */
class UsuariosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /*'access'=>[
                'class'=> AccessControl::className(),
                'only'=> ['delete'],
                'rules'=> [
                    [
                        'allow'=> true,
                        'roles'=> ['@']
                    ]
                ]
            ],*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionGerar()
    {  
        $searchModel = new UsuariosSearch();
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if ((Yii::$app->user->can('admin'))){
            $searchModel = new UsuariosSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException('Você não tem permissão para acessar esta página.');
        }
    }
    
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if ((Yii::$app->user->can('admin'))){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
           throw new ForbiddenHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User;
        $model->isAtivo = '0';   
        $model->codVerificacao = '0'; 
        
        if ((Yii::$app->user->isGuest)||(Yii::$app->user->can('admin'))){

            if(isset($_POST['User'])){
                $model->attributes=$_POST['User'];

                if($model->validate()) {
                        $hash = Yii::$app->security->generatePasswordHash($model->password_hash);
                        $model->password_hash = $hash;

                        if ($model->role === '1'){
                            $model->role = 1;
                            $model->save(false);
                        } else if ($model->role === '2'){
                            $model->role = 2;
                            $model->save(false);
                        } else if ($model->role === '3'){
                            $model->role = 3;
                            $model->save(false);
                        } 

                        if (Yii::$app->user->can('admin')){
                            
                                $model->isAtivo = 1;
                                $model->save(false);

                                Yii::$app->getSession()->setFlash('info', [
                                                'type' => 'success',
                                                'icon' => 'fa fa-check ',
                                                'duration' => 1000,
                                                'message' => ' Cadastro realizado com sucesso. ',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'right'
                                                ]);

                                return $this->redirect(array('usuarios/index'));
                        }

                        if (Yii::$app->user->isGuest){
                            
                            Yii::$app->getSession()->setFlash('info', [
                                                'type' => 'success',
                                                'icon' => 'fa fa-check ',
                                                'duration' => 1000,
                                                'message' => ' Cadastro realizado com sucesso. '
                                                            . 'Aguarde análise do administrador.',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'right'
                                                ]); 

                            return $this->redirect(array('site/index'));
                        }                       
                }    
                
            }
        
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
           throw new ForbiddenHttpException('Você não tem permissão para acessar esta página.');
        } 
    }
    
    /**
     * Displays a single Usuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if ((Yii::$app->user->can('admin'))){
            $model = $this->findModel($id);
            //$model->password_hash= null;
            $model->password_hash= $model->password_hash;
            $model->password_hash_repeat = $model->password_hash;

                if(isset($_POST['User'])){
                $model->attributes=$_POST['User'];


                    if ($model->role === '1'){
                        $model->role = 1;
                    } else if ($model->role === '2'){
                        $model->role = 2;
                    } else if ($model->role === '3'){
                        $model->role = 3;
                    } 

                        if($model->validate()) {
                            $hash = Yii::$app->security->generatePasswordHash($model->password_hash);
                            $model->password_hash = $hash;

                            $model->save(false);

                            Yii::$app->getSession()->setFlash('info', [
                                                    'type' => 'info',
                                                    'icon' => 'fa fa-check ',
                                                    'duration' => 1000,
                                                    'message' => 'Atualização de dados realizada com sucesso. ',
                                                    'title' => '',
                                                    'positonY' => 'top',
                                                    'positonX' => 'right'
                                                    ]);

                            return $this->redirect(array('index'));
                        }
                }
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
           throw new ForbiddenHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ((Yii::$app->user->can('admin'))){
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('info', [
                                                    'type' => 'danger',
                                                    'icon' => 'fa fa-check ',
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
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página não existe.');
    }
    
    public function actionAtivar ($id){
        if ((Yii::$app->user->can('admin'))){        
            $model = $this->findModel($id); 
            $ativo = $model->isAtivo;                  
            
                if ($ativo == '0'){     
                    if ($model->role == 1){
                        $auth = Yii::$app->authManager;
                        $adminRole = $auth->getRole('admin');                        
                        $auth->assign($adminRole, $model->getId());   
                        $model->save(false); 
                    } else if ($model->role == 2) {
                        $auth = Yii::$app->authManager;
                        $nutricionistaRole = $auth->getRole('nutricionista');                        
                        $auth->assign($nutricionistaRole, $model->getId());   
                        $model->save(false); 
                    } else if ($model->role == 3) {
                        $auth = Yii::$app->authManager;
                        $discenteRole = $auth->getRole('discente');                        
                        $auth->assign($discenteRole, $model->getId());   
                        $model->save(false); 
                    } 
                    $model->isAtivo = '1';    
                    $model->save(false);
            }
            $model->isAtivo = '1';
            $model->save(false);
            
            Yii::$app->getSession()->setFlash('success', [
                                              'type' => 'success',
                                              'icon' => 'fa fa-check ',
                                              'duration' => 1000,
                                              'message' => 'Usuário: '. $model->nome. ' ativado com sucesso!',
                                              'title' => '',
                                              'positonY' => 'top',
                                              'positonX' => 'right'
                                            ]);
            $this->redirect(array("usuarios/index"));   
        } else {
            throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }         
    }
    
    public function actionDesativar ($id){
        if ((Yii::$app->user->can('admin'))){
            $model = $this->findModel($id);
            $model->isAtivo='2';  
            $model->save(false);  
           
            $assignment = AuthAssignment::find()->where(['user_id'=>$id])->all();
                foreach ($assignment as $assignments) {
                    $assignments->delete($id); 
                } 
            Yii::$app->getSession()->setFlash('danger', [
                                                'type' => 'danger',
                                                'icon' => 'fa fa-check ',
                                                'duration' => 1000,
                                                'message' => 'Usuário: '. $model->nome. ' desativado com sucesso.',
                                                'title' => '',
                                                'positonY' => 'top',
                                                'positonX' => 'right'
                                                ]);
            $this->redirect(array("usuarios/index"));                
        } else {
            throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }
    }

    public function actionReativar ($id){
        if ((Yii::$app->user->can('admin'))){        
            $model = $this->findModel($id); 
            $ativo = $model->isAtivo;                  
            
                if ($ativo == '2'){     
                    if ($model->role == 1){
                        $auth = Yii::$app->authManager;
                        $adminRole = $auth->getRole('admin');                        
                        $auth->assign($adminRole, $model->getId());   
                        $model->save(false); 
                    } else if ($model->role == 2) {
                        $auth = Yii::$app->authManager;
                        $nutricionistaRole = $auth->getRole('nutricionista');                        
                        $auth->assign($nutricionistaRole, $model->getId());   
                        $model->save(false); 
                    } else if ($model->role == 3) {
                        $auth = Yii::$app->authManager;
                        $discenteRole = $auth->getRole('discente');                        
                        $auth->assign($discenteRole, $model->getId());   
                        $model->save(false); 
                    } 
                    $model->isAtivo = '1';    
                    $model->save(false);
                    Yii::$app->getSession()->setFlash('success', [
                        'type' => 'success',
                        'duration' => 10000,
                        'message' => 'Usuário: ' . $model->nome . ' Reativado Com Sucesso.',
                        'title' => '',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
            }
            $model->isAtivo = '1';
            $model->save(false);
            $this->redirect(array("usuarios/index"));   
        } else {
            throw new NotFoundHttpException('Você não tem permissão para acessar esta página.');
        }         
    }
}
