<?php

/* @var $this yii\web\View */
/* @var $poster app\models\Poster */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create your poster';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'poster', 'action' => ['site/create'],
        'options' => ['enctype' => 'multipart/form-data']
    ]) ?>

    <div class="panel">

        <div class="poster">

            <?= $form->field($poster, 'name')->textInput()->label(false) ?>
            <canvas id="myPoster" resize="true"></canvas>

            <p class="text-justify">
                <button id="zoom-in" class="btn btn-danger">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                </button>
                <button id="zoom-out" class="btn btn-danger">
                    <span class="glyphicon glyphicon-zoom-out"></span>
                </button>
                <button id="move-left" class="btn btn-danger">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                </button>
                <button id="move-right" class="btn btn-danger">
                    <span class="glyphicon glyphicon-arrow-right"></span>
                </button>
                <button id="move-up" class="btn btn-danger">
                    <span class="glyphicon glyphicon-arrow-up"></span>
                </button>
                <button id="move-down" class="btn btn-danger">
                    <span class="glyphicon glyphicon-arrow-down"></span>
                </button>
                <button id="rotate" class="btn btn-danger">
                    <span class="glyphicon glyphicon-repeat"></span>
                </button>
            </p>
            <p class="text-center">
                <a id="save" class="btn btn-primary">
                    Save poster <span class="glyphicon glyphicon-save"></span>
                </a></p>
        </div>

        <div class="frames">
            <img src="<?= Yii::$app->homeUrl ?>/static/img/frame_1.png" class="switch img-responsive">
            <img src="<?= Yii::$app->homeUrl ?>/static/img/frame_2.png" class="switch img-responsive">
            <img src="<?= Yii::$app->homeUrl ?>/static/img/frame_3.png" class="switch img-responsive">
            <hr>
            <p><input type="file" name="image" id="image"></p>
        </div>
    </div>

    <?= $form->field($poster, 'image')->hiddenInput()->label(false) ?>

    <?php ActiveForm::end(); ?>

    <p style="margin-top: 15px">
        This is the Game page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>

<script type="text/javascript">
    var staticUrl = "<?= Yii::$app->homeUrl . '/static/' ?>";
</script>

<!-- Import PaperScript -->
<script type="text/javascript" src="<?= Yii::$app->homeUrl ?>/static/js/paper.js"></script>

<!-- Define inlined PaperScript associate it with myCanvas -->
<script type="text/paperscript"
        src="<?= Yii::$app->homeUrl ?>/static/js/poster.js" canvas="myPoster"></script>
