<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

/* @var $answer app\models\Answer */
/* @var $question app\models\Question */
/* @var $answers array */

?>

<script src="<?= Yii::$app->homeUrl ?>/static/js/holder.js"></script>

<div class="question-form">

    <div class="row">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="well">
                <?= $form->field($question, 'points')->input('number') ?>

                <?= $form->field($question, 'content')->textarea(['rows' => 5]) ?>

                <?php if ($question->isNewRecord): ?>
                    <img class="img-responsive" id="question-image_preview" alt="400x100" data-src="holder.js/400x100"
                         data-holder-rendered="true"/>
                <?php else: ?>
                    <img src="<?= Yii::$app->homeUrl ?>/static/questions/<?= $question->image ?>"
                         class="img-responsive" alt="Image">
                <?php endif; ?>

                <?= $form->field($question, 'image')->fileInput() ?>
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">

            <h1 class="text-center">Add Answers</h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <?php $i = 0;
                        foreach ($answers as $answer): ?>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                                <?= $form->field($answer, "[$i]correct")->dropDownList([0 => 'False', 1 => 'True']) ?>

                                <?= $form->field($answer, "[$i]content")->textarea(['rows' => 8]) ?>
                            </div>
                            <?php $i++; endforeach; ?>
                    </div>
                </div>
            </div>


            <div class="form-group text-right">
                <?= Html::submitButton($question->isNewRecord ? 'Create' : 'Update',
                    ['class' => $question->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
