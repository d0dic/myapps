<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <!-- <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'role',
                'filter' => [
                    'admin' =>  'Administrator', 
                    'user' => 'Facebook User'
                ],
                'value' => function ($model)
                {
                    return $model->role == 'admin'? 
                        'Adminstrator':'Facebook User';
                }
            ],
            'link:url',
            'name',
            'email:email',
            [
                'attribute' => 'gender',
                'filter' => [
                    'male' =>  'Male', 
                    'female' => 'Female'
                ],
                'value' => function ($model)
                {
                    return $model->gender == 'male'? 
                        'Male':'Female';
                }
            ],
            // 'username',
            // 'password',
            // 'user_agent:ntext',
            // 'ip_addr',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
