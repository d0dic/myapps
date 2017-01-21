<?php

namespace app\controllers;

use app\models\Answer;
use Yii;
use app\models\Question;
use app\models\QuestionSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true, 'roles' => ['@'],
                        'matchCallback' => function () {
                            return user()->role == 'admin';
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(
            Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $answers = [];
        $question = new Question();
        $question->created = time();

        for ($i = 0; $i < 3; $i++) {
            $answers[] = new Answer();
        }

        if ($question->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($question, 'image');

            $image->saveAs('static/questions/question_'
                . $question->id . '.' . $image->extension);
            $question->image = 'question_'
                . $question->id . '.' . $image->extension;

            if (!$question->save()) {
                throw new Exception('Question not saved to database!');
            }

            if (Answer::loadMultiple($answers,
                Yii::$app->request->post())
            ) {

                foreach ($answers as $answer) {

                    $answer->question = $question->id;
                    $answer->created = time();

                    if (!$answer->save()) {
                        throw new Exception(
                            'Answer not saved to database!');
                        # dump($answer->erors);
                    }
                    # dump($answer->attributes);
                }  # die;

                return $this->redirect(
                    ['view', 'id' => $question->id]);
            }
        }

        return $this->render('create', [
            'question' => $question,
            'answers' => $answers,
        ]);
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|\yii\web\Response
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $question = $this->findModel($id);
        $answers = $question->answers;
        $oldImage = $question->image;

        if ($question->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($question, 'image');
            if ($image != null) {
                # unlink('static/questions/' . $oldImage);
                $image->saveAs('static/questions/question_'
                    . $question->id . '.' . $image->extension);
                $question->image = 'question_'
                    . $question->id . '.' . $image->extension;
            }

            if (!$question->save()) {
                throw new Exception('Question not saved to database!');
            }

            if (Answer::loadMultiple($answers,
                Yii::$app->request->post())
            ) {

                foreach ($answers as $answer) {

                    $answer->question = $question->id;
                    $answer->created = time();

                    if (!$answer->save()) {
                        throw new Exception(
                            'Answer not saved to database!');
                        # dump($answer->erors);
                    }
                    # dump($answer->attributes);
                }  # die;

                return $this->redirect(
                    ['view', 'id' => $question->id]);
            }
        }

        return $this->render('update', [
            'question' => $question,
            'answers' => $answers,
        ]);
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     * @throws Exception
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $question = $this->findModel($id);

        foreach ($question->answers as $answer) {
            if (!$answer->delete()) {
                throw new Exception('Answer not deleted!');
            }
        }

        if (!$question->delete()) {
            throw new Exception('Question not deleted!');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(
                'The requested page does not exist.');
        }
    }
}
