<?php

/* @var $model app\models\Poster */

?>

<div class="thumbnail">
    <a href="<?= \yii\helpers\Url::to(['site/preview', 'id' => $model->id]) ?>">
        <img src="<?= Yii::$app->request->baseUrl ?>/static/posters/<?= $model->image ?>"
             alt="<?= $model->image ?>"></a>
    <div class="caption">
        <h3><?= $model->name ?> <small>@<i><?= $model->owner->name ?></i></small></h3>
        <p class="text-right">

            <a class="btn btn-danger" href="<?= \yii\helpers\Url::to(['site/like', 'id' => $model->id]) ?>">
                Like <span class="glyphicon glyphicon-thumbs-up"></span>
            </a>
            <a class="btn btn-primary" href="javascript:share(<?= $model->id ?>)">
                Share <span class="glyphicon glyphicon-share"></span>
            </a>
        </p>
    </div>
</div>
