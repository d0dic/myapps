<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

use app\models\Game;
use app\models\Puzzle;
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
        $game = new Game();
        $randomPuzzle = Puzzle::find()
            ->orderBy('rand()')->one();

        if (!$randomPuzzle) {
            return $this->redirect(['/puzzle']);
        }

        $game->score = 0;
        $game->data = '[]';
        $game->user = user()->id;
        $game->puzzle = $randomPuzzle->id;
        $game->token = md5(time());
        $game->finished = time();
        $game->created = $game->finished;

        if (!$game->save()) {
            throw new Exception('Game not saved!');
            # dump($game->errors); die;
        }

        return $this->render('game', [
            'game' => $game
        ]);
    }

    public function actionRules()
    {
        return $this->render('rules');
    }

    public function actionWinners()
    {
        $winners = Topscore::find()->with('play')->limit(3)->all();

        return $this->render('winners',[
            'winners' => $winners
        ]);
    }

    public function actionRewards()
    {
        return $this->render('rewards');
    }

    public function actionToplist()
    {
        $topscores = Topscore::find()->joinWith('play')->all();

        return $this->render('toplist',[
            'topscores' => $topscores
        ]);
    }

    public function actionFail()
    {
        return $this->render('fail');
    }

    public function actionCheck($game, $token)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {

            $currentGame = Game::find()->where(
                ['id' => $game, 'token' => $token]
            )->one();

            if (!$currentGame) {
                return ['error' => 'Game does not exist!'];
            }

            $data = json_decode($currentGame->data);

            if (count($data) == 12) {
                return ['error' => 'Game finished!'];
            }

            $data[] = Yii::$app->request->post('position');
            $currentGame->data = json_encode($data);

            $timeLapse = microtime(true) - $currentGame->created;
            $points = $timeLapse < 60? 60 - $timeLapse:0;
            $currentGame->score += $points;

            if (count($data) == 12) {
                $currentGame->finished = time();
                $currentGame->token = 'finished';

                $topscore = Topscore::find()->where(
                    ['user' => user()->id])->one();

                if (!$topscore) {
                    $topscore = new Topscore();
                    $topscore->user = user()->id;
                    $topscore->game = $currentGame->id;
                    $topscore->created = time();
                } else {
                    if ($currentGame->score > $topscore->play->score) {
                        $topscore->game = $currentGame->id;
                    }
                }

                if (!$topscore->save()) {
                    return ['error' => 'Topscore not saved!'];
                }

            } else {
                $currentGame->token = md5(time());
            }

            if (!$currentGame->save()) {
                return ['error' => 'Game not saved!'];
            }

            return ['score' => $currentGame->score,
                'token' => $currentGame->token];

        }

        return ['error' => 'Invalid request format!'];
    }

    public function actionResult()
    {
        if (!Contact::find()->where(
            ['user' => user()->id])->exists()
        ) {
            return $this->redirect(['site/contact']);
        }

        $lastGame = Game::find()->where([
            'user' => user()->id, 'token' => 'finished'
        ])->orderBy('id desc')->one();

        if (!$lastGame) {
            throw new Exception('Game does not exist!');
        }

        return $this->render('result', [
            'game' => $lastGame
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
                    throw new Exception('Contact not saved to database!');
                    # dump($model->errors); die;
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
