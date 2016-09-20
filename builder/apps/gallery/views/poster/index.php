<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PosterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poster-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?php # echo Html::a('Create Poster', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'approved',
                'filter' => [0 => 'No', 1 => 'Yes'],
                'value' => function($model){
                    return $model->approved? 'Yes':'No';
                }
            ],
            [
                'attribute' => 'user',
                'value' => function($model){
                    return $model->owner->name;
                }
            ],
            'name',
            [
                'format' => 'html',
                'attribute' => 'image',
                'value' => function($model){
                    return Html::img(Yii::$app->request->baseUrl .
                        '/static/posters/' . $model->image, ['width'=>200]);
                }
            ],
            'likes',
            'shares',
            'created',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
