<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Puzzle */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Puzzles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puzzle-view">

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
    	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    		<?php
            $piecesHtml = ''; $i=0;
            foreach ($model->pieces as $piece) {
                $piecesHtml .= Html::img(Yii::$app->homeUrl.
                    "static/puzzles/puzzle_$model->id/".$piece->image,
                    ['width' => '24%', 'style' => 'margin:1px']);

                if (($i + 1) % 4 == 0) $piecesHtml .= '<div class="clearfix"></div>';
                $i++;
            }

            echo $piecesHtml;
            ?>
    	</div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'attribute' => 'active',
                        'value' => $model->active? 'Yes':'No'
                    ],
                    'created',
                ],
            ]) ?>
        </div>
    </div>

</div>
