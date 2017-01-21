<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'User data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the User data page. You may modify the following file to customize its content:
    </p>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'fname') ?>
        <?= $form->field($model, 'lname') ?>
        <?= $form->field($model, 'email')->input('email') ?>

        <div class="form-group text-right">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

        <div class="form-group">
            <code><?= __FILE__ ?></code>
        </div>
        <?php ActiveForm::end() ?>
    </div>

</div>
