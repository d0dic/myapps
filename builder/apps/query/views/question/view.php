<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Question: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
    	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <img src="<?= Yii::$app->homeUrl ?>/static/questions/<?= $model->image ?>"
                 class="img-responsive" alt="Image">
    	</div>

        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'points',
                    'image',
                    'content:ntext',
                    'created',
                ],
            ]) ?>
        </div>
    </div>

</div>
