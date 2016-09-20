<?php

/* @var $sort string */
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Gallery';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <div class="row">
    	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <h1><?= Html::encode($this->title) ?></h1>
    	</div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <ul class="nav nav-pills navbar-right" style="padding-top: 25px">
                <li role="presentation" class="<?= $sort == 'last'? 'active':'' ?>">
                    <a href="<?= Url::to(['site/gallery', 'sort' => 'last']) ?>">Latest</a></li>
                <li role="presentation" class="<?= $sort == 'top'? 'active':'' ?>">
                    <a href="<?= Url::to(['site/gallery', 'sort' => 'top']) ?>">Top rated</a></li>
                <li role="presentation" class="<?= $sort == 'mine'? 'active':'' ?>">
                    <a href="<?= Url::to(['site/gallery', 'sort' => 'mine']) ?>">Mine</a></li>
            </ul>
        </div>
    </div>

    <hr>

    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'poster',
        ]); ?>
    </div>

    <p>
        This is the Toplist page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
