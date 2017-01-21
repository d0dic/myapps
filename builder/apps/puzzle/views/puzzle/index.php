<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PuzzleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puzzles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puzzle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Create Puzzle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'format' => 'html',
                'attribute' => 'preview',
                'value' => function($model){

                    $piecesHtml = ''; $i=0;
                    foreach ($model->pieces as $piece) {
                        $piecesHtml .= Html::img(Yii::$app->homeUrl.
                            "static/puzzles/puzzle_$model->id/".$piece->image,
                            ['width' => 40, 'style' => 'margin:1px']);

                        if (($i + 1) % 4 == 0) $piecesHtml .= '<div class="clearfix"></div>';
                        $i++;
                    }

                    return $piecesHtml;
                }
            ],
            [
                'attribute' => 'active',
                'filter' => [0 => 'No', 1 => 'Yes'],
                'value' => function ($model) {
                    return $model->active ? 'Yes' : 'No';
                }
            ],
            'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
