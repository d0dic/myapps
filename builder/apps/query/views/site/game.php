<?php

/**
 * @var $this yii\web\View
 * @var $questions array
 * @var $form app\models\Form
 * @var $reply app\models\Reply
 * @var $question app\models\Question
 * @var $answer app\models\Answer
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Game';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Game page. You may modify the following file to customize its content:
    </p>

    <?php $form = ActiveForm::begin([
        'action' => ['site/result']
    ]) ?>

    <input type="hidden" name="form" value="<?= $form->id ?>">

    <?php foreach ($questions as $question): ?>

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <img src="<?= Yii::$app->homeUrl ?>/static/questions/<?= $question->image ?>"
                     class="img-responsive" alt="Image">
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <h4><?= $question->content ?></h4>
                <?php foreach ($question->answers as $answer): ?>
                    <p><input type="radio" value="<?= $answer->id ?>"
                              name="question[<?= $question->id ?>]" required> <?= $answer->content ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

    <code><?= __FILE__ ?></code>
</div>
