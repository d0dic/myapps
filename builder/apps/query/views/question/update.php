<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $answers[] app\models\Answer[] */
/* @var $question app\models\Question */

$this->title = 'Question: ' . $question->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $question->id, 'url' => ['view', 'id' => $question->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-update">

    <?= $this->render('_form', [
        'question' => $question,
        'answers' => $answers,
    ]) ?>

</div>
