<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

/* @var $piece app\models\Piece */
/* @var $puzzle app\models\Puzzle */
/* @var $pieces array */
?>

<script src="<?= Yii::$app->homeUrl ?>/static/js/holder.js"></script>

<div class="puzzle-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <?= $form->field($puzzle, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <?= $form->field($puzzle, 'active')->dropDownList([0 => 'Inactive', 1 => 'Active']) ?>
                </div>
            </div>
        </div>
    </div>

    <h1>Add pieces</h1>

    <div class="row">

        <?php $i = 0;
        foreach ($pieces as $piece): ?>

            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

                <div class="thumbnail">

                    <h3>Piece <?= $i + 1 ?></h3>

                    <?php if ($piece->isNewRecord): ?>
                        <img id="piece-<?= $i ?>-image_preview" alt="150x133" data-src="holder.js/150x133"
                             data-holder-rendered="true"/>
                    <?php else: ?>
                        <img src="<?= Yii::$app->homeUrl ?>/static/puzzles/puzzle_<?= $piece->puzzle . '/' . $piece->image ?>"/>
                    <?php endif; ?>

                    <?php # echo $form->field($piece, "[$i]number")->input('number', ['min' => 1, 'max' => 12]) ?>

                    <?= $form->field($piece, "[$i]image")->fileInput([
                        'accept' => 'image/*', 'onchange' => 'preview(this.id, this.files)'
                    ]) ?>
                </div>
            </div>

            <?php if (($i + 1) % 4 == 0) echo '<div class="clearfix"></div>'; ?>

            <?php $i++; endforeach; ?>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton($puzzle->isNewRecord ? 'Create' : 'Update',
            ['class' => $puzzle->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    function preview(identifier, files) {

        if (files.length > 0) {

            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + identifier + '_preview').attr('src', e.target.result);
                // console.log(e.target.result);
            };

            reader.readAsDataURL(files[0]);
            console.log(files[0]);
        }

        console.log(identifier);
    }
</script>
