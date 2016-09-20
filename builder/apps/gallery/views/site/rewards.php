<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Rewards';
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="<?= Yii::$app->homeUrl ?>/static/js/holder.js"></script>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <a href="#" class="thumbnail">
                <img alt="400x200" data-src="holder.js/400x200" data-holder-rendered="true">
            </a>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <a href="#" class="thumbnail">
                <img alt="400x200" data-src="holder.js/400x200" data-holder-rendered="true">
            </a>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <a href="#" class="thumbnail">
                <img alt="400x200" data-src="holder.js/400x200" data-holder-rendered="true">
            </a>
        </div>
    </div>

    <p>
        This is the Rewards page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
