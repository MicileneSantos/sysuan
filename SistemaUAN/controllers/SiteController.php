<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\rbac\UserGroupRule;
use yii\helpers\Url;
use app\models\RecoverPassForm;
use app\models\ResetPassForm;
use yii\web\Session;
use mPDF;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','admin','nutricionista','discente'],
                'rules' => [
                    [
                        'actions' => ['logout','admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                      [
                        'actions' => ['logout', 'nutricionista'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserNutricionista(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        'actions' => ['logout', 'discente'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserDiscente(Yii::$app->user->identity->id);
                        },
                    ],
                             
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
       /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    private function randKey ($str='',$long=0 ){       
        $key = null;       
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for ($x=0; $x<$long; $x++){
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }  
    
    public function actionRelatorio ()
    {
        return $this->render("relatorio");
    }

    public function actionAdmin ()
    {
        
        //return $this->render("admin");
        return $this->redirect(["/usuarios/index"]);
    }
    
    public function actionNutricionista ()
    {
        return $this->render("nutricionista");
    }
    
    public function actionDiscente ()
    {
        return $this->render("discente");
    }
    
    //mPDF
    public function actionCreateMPDF()
    {
        $mpdf = new mPDF();
        $mpdf->WriteHTML($this->renderPartial('mpdf'));
        $mpdf->Output();
        exit;
        //return $this->renderPartial('mpdf');
    }
    public function actionSamplePdf()
    {
        $mpdf = new mPDF;
        $mpdf->WriteHTML('Sample Text');
        $mpdf->Output();
        exit;
    }
    public function actionForceDownloadPdf()
    {
        $mpdf = new mPDF();
        $mpdf->WriteHTML($this->renderPartial('mpdf'));
        $mpdf->Output('MyPDF.pdf', 'D');
        exit;
    }
    
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            if (User::isUserAdmin(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/admin"]);
            }else if (User::isUserNutricionista(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/nutricionista"]);
            } else if (User::isUserDiscente(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/discente"]);
            } 
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (User::isUserAdmin(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/admin"]);
            }else if (User::isUserNutricionista(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/nutricionista"]);
            } else if (User::isUserDiscente(Yii::$app->user->identity->id))
            {
                return $this->redirect(["site/discente"]);
            }  

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        return $this->redirect(["site/login"]);
    }
  
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {  
        /*$auth = Yii::$app->authManager;
          
        $addPost = $auth->createPermission('addPost');
        $addPost->description = 'Add a post';
        $auth->add($addPost);

        $editPost = $auth->createPermission('editPost');
        $editPost->description = 'Edit a post';
        $auth->add($editPost);
        
        $viewPost = $auth->createPermission('viewPost');
        $viewPost->description = 'View a post';
        $auth->add($viewPost);
        
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Delete a post';
        $auth->add($deletePost);
        
        $indexPost = $auth->createPermission('indexPost');
        $indexPost->description = 'Index a post';
        $auth->add($indexPost);
               
        $rule = new UserGroupRule;
        $auth->add($rule);
        
        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $addPost);
        $auth->addChild($admin, $editPost);
        $auth->addChild($admin, $viewPost);
        $auth->addChild($admin, $indexPost);
        $auth->addChild($admin, $deletePost);

        $nutricionista = $auth->createRole('nutricionista');
        $nutricionista->ruleName = $rule->name;
        $auth->add($nutricionista);
        $auth->addChild($nutricionista, $viewPost);
        $auth->addChild($nutricionista, $addPost);
        $auth->addChild($nutricionista, $editPost);
        $auth->addChild($nutricionista, $deletePost);
                           
        $discente = $auth->createRole('discente');
        $discente->ruleName = $rule->name;
        $auth->add($discente);   
        $auth->addChild($discente, $viewPost);
        $auth->addChild($discente, $addPost);*/     
                
        return $this->render('index');
    }
    
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');
            }else{
                Yii::$app->session->setFlash('erro');
            }

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
        /*
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }         */
    }
  
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRecoverpass(){
        $model = new RecoverPassForm;
        $msg = null;        
  
        if ($model->load(Yii::$app->request->post())){
            if ($model->validate()){
                $table = User::find()->where("email=:email", [":email" => $model->email]);      
    
                if ($table->count() == 1){        
                    $session = new Session;
                    $session->open();     
    
                    $session["recover"] = $this->randKey("abcdef0123456789", 200);
                    $recover = $session["recover"];    
         
                    $table = User::find()->where("email=:email", [":email" => $model->email])->one();
                    $session["id_recover"] = $table->id;    
         
                    $codVerificacao = $this->randKey("abcdef0123456789", 8);
                    $table->codVerificacao = $codVerificacao;         
                    $table->save(false);   
                    
                    $session["codVerificacao"] = $table->codVerificacao;
                    $codVerificacao = $session["codVerificacao"];    
                    
                    $session["email"] = $table->email;
                    $email = $session["email"];    
     
                    $subject = "Recuperação de Senha";
                    $body = "<p>Código de verificação para redefinir sua senha ... ";
                    $body .= "<strong>".$codVerificacao."</strong>. Clique no link abaixo:</p>";
                    $body .= "<p><a href='http://localhost/sistemaUAN/web/index.php?r=site/resetpass'>Link redefinir senha</a></p>";
     
                    Yii::$app->mailer->compose()
                    ->setTo($model->email)
                    ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();    
    
                    $model->email = null;     
     
                    $msg = "Enviamos uma mensagem para sua conta de e-mail para que você possa redefinir sua senha. Verifique-a.";
                } else {
                    $msg = "E-mail não cadastrado.";
                }
            } else {
            $model->getErrors();
            }
        }
    return $this->render("recoverpass", ["model" => $model, "msg" => $msg]);
    }
 
    public function actionResetpass()
    {
        $model = new ResetPassForm();
        $msg = null;
  
        $session = new Session;
        $session->open();  
  
        if (empty($session["recover"]) || empty($session["id_recover"]))
        {
            return $this->redirect(["site/index"]);
        } else {
            $recover = $session["recover"];           
            $model->recover = $recover;
            $id_recover = $session["id_recover"];
            $codVerificacao = $session["codVerificacao"];           
            $model->codVerificacao = $codVerificacao;
            $email = $session["email"];           
            $model->email = $email;
        }
  
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                if ($recover == $model->recover && $codVerificacao == $model->codVerificacao){               
                    
                   $table = User::findOne(["email" => $model->email, "id" => $id_recover, 
                        "codVerificacao" => $model->codVerificacao]);                       
                 
                    $table->password_hash= Yii::$app->security->generatePasswordHash($model->password_hash);                                                       
    
                    if ($table->save(false))
                    {
                        $session->destroy();    
                        
                        $model->email = null;
                        $model->password_hash = null;
                        $model->password_repeat = null;
                        $model->recover = null;
                        $model->codVerificacao = null;
      
                        $msg = "Senha redefinida com sucesso, você será redirecionado(a) para a página de login. Aguarde ...";
                        $msg .= "<meta http-equiv='refresh' content='5; ". Url::toRoute("login")."'>";
                    } else {
                        $msg = "Erro. Tente novamente.";
                    }                    
                } else {
                    $model->getErrors();
                }
            }
        }
        return $this->render('resetpass', ['model' => $model, 'msg' => $msg]);  
    }
    
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
}
