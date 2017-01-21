<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $question app\models\Question */
/* @var $answers array */

$this->title = 'Create Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <?= $this->render('_form', [
        'question' => $question,
        'answers' => $answers,
    ]) ?>

</div>
