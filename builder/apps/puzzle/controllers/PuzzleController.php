<?php

namespace app\controllers;

use app\models\Piece;
use Yii;
use app\models\Puzzle;
use app\models\PuzzleSearch;

use yii\db\Exception;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PuzzleController implements the CRUD actions for Puzzle model.
 */
class PuzzleController extends Controller
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
     * Lists all Puzzle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PuzzleSearch();
        $dataProvider = $searchModel->search(
            Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Puzzle model.
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
     * Creates a new Puzzle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $pieces = [];
        $puzzle = new Puzzle();
        $puzzle->created = time();

        for ($i = 0; $i < 12; $i++) {
            $pieces[] = new Piece();
        }

        if (Yii::$app->request->isPost) {

            if ($puzzle->load(
                    Yii::$app->request->post()) && $puzzle->save()
            ) {

                FileHelper::createDirectory(
                    "static/puzzles/puzzle_$puzzle->id");

                if (Piece::loadMultiple($pieces,
                    Yii::$app->request->post())
                ) {

                    $i = 0;
                    foreach ($pieces as $piece) {

                        $image = UploadedFile::getInstance($piece, "[$i]image");

                        $piece->number = $i+1;
                        $piece->image = 'puzzle_' . $puzzle->id . '_' .
                            $piece->number . '.' . $image->extension;
                        $piece->puzzle = $puzzle->id;
                        $piece->created = time();

                        if (!$piece->save()) {
                            throw new Exception(
                                'Puzzle not saved to database!');
                            # dump($piece->erors);
                        }

                        $image->saveAs(
                            "static/puzzles/puzzle_$puzzle->id/$piece->image");
                        $i++;

                        # dump($piece->attributes);
                    }   # die;

                    return $this->redirect(
                        ['view', 'id' => $puzzle->id]);
                }
            }
        }

        return $this->render('create', [
            'puzzle' => $puzzle,
            'pieces' => $pieces,
        ]);
    }

    /**
     * Updates an existing Puzzle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|\yii\web\Response
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $puzzle = $this->findModel($id);
        $pieces = $puzzle->pieces;

        if (Yii::$app->request->isPost) {

            if ($puzzle->load(
                    Yii::$app->request->post()) && $puzzle->save()
            ) {

                if (Piece::loadMultiple($pieces,
                    Yii::$app->request->post())
                ) {

                    $i = 0;

                    foreach ($pieces as $piece) {

                        $image = UploadedFile::getInstance($piece, "[$i]image");
                        $piece->image = $pieces[$i]->oldAttributes['image'];

                        if ($image != null) {
                            unlink("static/puzzles/puzzle_$id/$piece->image");
                            $image->saveAs(
                                "static/puzzles/puzzle_$id/$piece->image");
                        }

                        $piece->puzzle = $puzzle->id;
                        $piece->created = time();

                        if (!$piece->save()) {
                            throw new Exception(
                                'Puzzle not saved to database!');
                            # dump($piece->erors);
                        }

                        $i++;

                        # dump($piece->attributes);
                    }   # die;

                    return $this->redirect(
                        ['view', 'id' => $puzzle->id]);
                }
            }
        }

        return $this->render('update', [
            'puzzle' => $puzzle,
            'pieces' => $pieces,
        ]);
    }

    /**
     * Deletes an existing Puzzle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     * @throws Exception
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $puzzle = $this->findModel($id);

        foreach ($puzzle->pieces as $piece) {
            $image = $piece->image;
            if (!$piece->delete())
                throw new Exception('Piece not deleted!');
            unlink("static/puzzles/puzzle_$id/$image");
        }

        if (!$puzzle->delete()) {
            throw new Exception('Puzzle not deleted!');
        }

        FileHelper::removeDirectory(
            "static/puzzles/puzzle_$id");
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Puzzle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Puzzle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Puzzle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
