<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $puzzle app\models\Puzzle */
/* @var $pieces array */

$this->title = 'Create Puzzle';
$this->params['breadcrumbs'][] = ['label' => 'Puzzles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puzzle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'puzzle' => $puzzle,
        'pieces' => $pieces,
    ]) ?>

</div>
