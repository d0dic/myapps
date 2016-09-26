<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Form;
use app\models\Question;
use app\models\Reply;
use app\models\Topscore;
use app\models\Contact;

class SiteController extends FacebookController
{
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

    public function actionIndex()
    {
        return $this->render('index', [
            'loginUrl' => Yii::$app->facebook->getLoginUrl()
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
        $reply = new Reply();
        $questions = Question::find()
            ->orderBy('rand()')->limit(5)->all();

        if (count($questions) < 5) {
            return $this->redirect(['/question']);
        }

        $qnums = [];

        foreach ($questions as $question) {
            $qnums[] = $question->id;
        }

        $form = new Form();
        $form->score = 0;
        $form->user = user()->id;
        $form->questions =
            json_encode($qnums);
        $form->created = time();

        if (!$form->save()) {
            throw new Exception('Game not saved to database!');
            # dump($form->errors); die;
        }

        return $this->render('game', [
            'questions' => $questions,
            'reply' => $reply,
            'form' => $form
        ]);
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
        $topscores = Topscore::find()->joinWith('query')->all();

        return $this->render('toplist',[
            'topscores' => $topscores
        ]);
    }

    public function actionResult()
    {
        $currentForm = Form::find()->where(['user' => user()->id])
            ->orderBy(['id' => SORT_DESC])->one();

        if (request()->isPost) {

            $currentForm = Form::find()->where([
                'id' => request()->post('form'),
                'user' => user()->id, 'score' => 0
            ])->one();

            if (!$currentForm) {
                throw new Exception('Game does not exist!');
            }

            foreach ($currentForm->queries as $query) {
                $answer = request()->post("question")[$query->id];

                if ($query->answer->id == $answer) {
                    $currentForm->score += 10;
                    # dump($answer);
                };
            }

            if (!$currentForm->save()) {
                throw new Exception('Game not saved!');
            }

            $topscore = Topscore::find()->where(
                ['user' => user()->id])->one();

            if (!$topscore) {
                $topscore = new Topscore();
                $topscore->user = user()->id;
                $topscore->form = $currentForm->id;
                $topscore->created = time();
            } else {
                if ($topscore->query->score < $currentForm->score) {
                    $topscore->query = $currentForm->id;
                }
            }

            if (!$topscore->save()) {
                throw new \Exception('Topscore not saved!');
            }

            if (!Contact::find()->where(
                ['user' => user()->id])->exists()
            ) {
                return $this->redirect('contact');
            }

            # dump(request()->post('question')); die;
        }

        return $this->render('result', [
            'form' => $currentForm
        ]);
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

                return $this->redirect('result');
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
