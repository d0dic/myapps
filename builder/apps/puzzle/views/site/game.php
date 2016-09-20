<?php

/* @var $this yii\web\View */
/* @var $game app\models\Game */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Game';
$this->params['breadcrumbs'][] = $this->title;
?>

<script type="text/javascript">
    var failUrl = "<?= Url::to(['site/fail']) ?>";
    var checkUrl = "<?= Url::to(['site/check']) ?>";
    var endUrl = "<?= Url::to(['site/result']) ?>";
    var puzzleUrl = "<?= Yii::$app->homeUrl.
        "/static/puzzles/puzzle_$game->puzzle" ?>";
    var homeUrl = "<?= Yii::$app->homeUrl ?>";

    var token = "<?= $game->token ?>";
    var puzzle = <?= $game->puzzle ?>;
    var game = <?= $game->id ?>;

    function checker(point) {

        console.log(point);

        $.post(checkUrl+'?game='+game+'&token='+token,
            { position: point })
            .done(function( response ) {

                if (response != 'undefined') {
                    token = response.token;
                    score = response.score;

                    if (token == 'finished') {
                        location.href = endUrl;
                    }
                }

                console.log(response);
            });
    }
</script>

<script type="text/javascript" src="<?= Yii::$app->homeUrl ?>/static/js/paper.js"></script>
<!-- Define inlined PaperScript associate it with myCanvas -->
<script type="text/paperscript" src="<?= Yii::$app->homeUrl ?>/static/js/puzzle.js" canvas="playground"></script>


<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="puzzle">
        <div class="puzzle-border">
            <div class="puzzle-content">
                <canvas id="playground" class="playground" resize="true"></canvas>
            </div>
        </div>

        <div class="puzzle-bar">
            <div class="progressbar">
                <div id="timer" class="progresser"></div>
            </div>
        </div>
    </div>

    <p>
        This is the Game page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
