<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\data\ActiveDataProvider;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Like;
use app\models\Poster;
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
                'only' => ['logout', 'home', 'create', 'contact', 'gallery', 'like', 'share', 'invite', 'notify'],
                'rules' => [
                    [
                        'actions' => ['logout', 'home', 'create', 'contact', 'gallery', 'like', 'share', 'invite', 'notify'],
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

    public function actionCreate()
    {
        $poster = new Poster();
        $poster->created = time();

        if ($poster->load(
            request()->post())) {

            $poster->likes = 0;
            $poster->shares = 0;
            $poster->user = user()->id;
            $poster->approved = false;
            // var_dump($poster); die();

            $image = str_replace(
                'data:image/png;base64,', '', $poster->image);
            $image = str_replace(' ', '+', $image);
            $data = base64_decode($image);

            $poster->image = 'poster_' . $poster->created . '.png';
            $path = Yii::$app->basePath."/static/posters/" . $poster->image;

            if (file_put_contents($path, $data)) {

                if (!$poster->save()) {
                    throw new Exception('Poster model not saved to database!');
                    # dump($poster->errors); die;
                }

                $contact = Contact::find()->where([
                    'user' => user()->id])->exists();

                if ($contact) {
                    return $this->redirect(['gallery']);
                } else {
                    return $this->redirect(['contact']);
                }
            } else {
                throw new Exception('Poster image not saved to folder!');
            }
        }

        return $this->render('create',[
            'poster' => $poster
        ]);
    }

    public function actionLike($id)
    {
        $poster = Poster::findOne($id);

        if (!$poster || Like::find()->where([
                'user' => user()->id, 'poster' => $id
            ])->exists()) {
            return $this->redirect(['gallery']);
        }

        $like = new Like();
        $like->poster = $id;
        $like->user = user()->id;
        $like->created = time();

        if (!$like->save()) {
            throw new Exception('Like not saved to database!');
            # dump($like->errors); die;
        }

        $poster->likes += 1;

        if (!$poster->save()) {
            throw new Exception('Like not saved to database!');
            # dump($like->errors); die;
        }

        return $this->redirect(['site/preview', 'id' => $id]);
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

    public function actionGallery($sort='last')
    {
        $query = Poster::find();

        if ($sort == 'top') {
            $query->where(['approved' => true])->orderBy('likes desc');
        }

        if ($sort == 'last') {
            $query->where(['approved' => true])->orderBy('id desc');
        }

        if ($sort == 'mine') {
            $query->where(['user' => user()->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        return $this->render('gallery', [
            'dataProvider' => $dataProvider,
            'sort' => $sort
        ]);
    }

    public function actionPreview($id)
    {
        $model = Poster::findOne($id);

        return $this->render('preview', [
            'model' => $model
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
