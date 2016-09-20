<?php

/* @var $model app\models\Poster */

?>

<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	<div class="thumbnail">
        <a href="<?= \yii\helpers\Url::to(['site/preview', 'id' => $model->id]) ?>">
            <img src="<?= Yii::$app->request->baseUrl ?>/static/posters/<?= $model->image ?>"
                 alt="<?= $model->image ?>"></a>
		<div class="caption">
			<h3><?= $model->name ?></h3>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?= $model->likes ?> <span class="glyphicon glyphicon-thumbs-up"></span>
					<?= $model->shares ?> <span class="glyphicon glyphicon-share"></span>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<p class="text-right">
						@<i><?= $model->owner->name ?></i>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>