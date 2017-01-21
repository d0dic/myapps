<?php

/* @var $this yii\web\View */
/* @var $game app\models\Game */

use yii\helpers\Html;

$this->title = 'Result';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="jumbotron">
        <h1 class="text-center">Your score : <?= $game->score ?></h1>
        <p>Congratulations, you were great!</p>

        <p class="text-center">
            <a class="btn btn-danger" href="javascript:share()"> Share your result </a>
        </p>
    </div>

    <p class="text-left">
        This is the result page. You may modify the following file to customize its content:
        <code><?= __FILE__ ?></code>
    </p>

</div>
