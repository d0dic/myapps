<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Poster */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Posters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poster-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">

        <?php if ($model->approved): ?>
            <?= Html::a('Hide', ['toggle', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?php else: ?>
            <?= Html::a('Publish', ['toggle', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php endif;; ?>

        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
    	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    		<img src="<?= Yii::$app->request->baseUrl . '/static/posters/' . $model->image ?>"
                 class="img-responsive" alt="Image">
    	</div>

        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//            'id',
                    'name',
                    [
                        'attribute' => 'user',
                        'value' => $model->owner->name
                    ],
                    [
                        'attribute' => 'approved',
                        'value' => $model->approved? 'Yes':'No'
                    ],
                    'image:ntext',
                    'likes',
                    'shares',
                    'created',
                ],
            ]) ?>
        </div>
    </div>

</div>
