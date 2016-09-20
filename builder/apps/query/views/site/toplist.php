<?php

/* @var $this yii\web\View */
/* @var $topscores app\models\Topscore */

use yii\helpers\Html;

$this->title = 'Toplist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Toplist page. You may modify the following file to customize its content:
    </p>

    <table class="table table-hover">
    	<tbody>

        <?php foreach ($topscores as $topscore): ?>

            <tr>
                <td style="width: 100px"><img class="img-circle" src="//graph.facebook.com/<?= $topscore->user ?>/picture" alt="<?= $topscore->player->name ?>"></td>
                <td><h4><?= $topscore->player->name ?></h4></td>
                <td class="text-right"><h4><?= $topscore->query->score ?></h4></td>
            </tr>

        <?php endforeach; ?>
    	</tbody>
    </table>

    <code><?= __FILE__ ?></code>
</div>
