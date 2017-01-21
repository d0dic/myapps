<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $puzzle app\models\Puzzle */
/* @var $pieces array */

$this->title = 'Update Puzzle: ' . $puzzle->name;
$this->params['breadcrumbs'][] = ['label' => 'Puzzles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $puzzle->name, 'url' => ['view', 'id' => $puzzle->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puzzle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'puzzle' => $puzzle,
        'pieces' => $pieces,
    ]) ?>

</div>
