<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Winners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">

        <?php foreach ($winners as $winner): ?>

    	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <img class="img-circle" src="//graph.facebook.com/<?= $winner->user ?>/picture?type=large" alt="<?= $winner->player->name ?>">
    	</div>

        <?php endforeach; ?>
    </div>
    <hr>

    <p>
        This is the Winners page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
