<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Contact;

class SiteController extends FacebookController
{
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
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'home', 'game', 'result', 'toplist', 'contact', 'invite', 'notify'],
                'rules' => [
                    [
                        'actions' => ['logout', 'home', 'game', 'result', 'toplist', 'contact', 'invite', 'notify'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actionIndex()
    {
        return $this->render('index', [
            'loginUrl' => $this->getLoginUrl()
        ]);
    }

    public function actionHome()
    {
        return $this->render('home', [
            'user' => user()
        ]);
    }

    public function actionGame()
    {
        return $this->render('game');
    }

    public function actionRules()
    {
        return $this->render('rules');
    }

    public function actionWinners()
    {
        return $this->render('winners');
    }

    public function actionRewards()
    {
        return $this->render('rewards');
    }

    public function actionToplist()
    {
        return $this->render('toplist');
    }

    public function actionResult()
    {
        if (!Contact::find()->where(
            ['user' => user()->id])->exists()
        ) {
            return $this->redirect('contact');
        }

        return $this->render('result');
    }

    public function actionContact()
    {
        $model = new Contact();

        if (Contact::find()->where(
            ['user' => user()->id])->exists()
        ) {
            return $this->redirect('toplist');
        }

        if (request()->isPost) {

            $model->created = time();
            $model->user = user()->id;

            if ($model->load(request()->post())) {

                if (!$model->save()) {
                    echo '<pre>'; var_dump($model->errors); die();
                }

                return $this->redirect('toplist');
            }
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }

    /**
     * @param $subject
     * @param $message
     * @return bool
     */
    private function sendMail($subject, $message){
        $result = Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom(['apps@codeit.rs' => 'Apps CodeIT'])
            ->setSubject($subject)
            ->setTextBody($message)
            ->send();

        if (!$result) {
            return false;
        }

        return true;
    }
}
