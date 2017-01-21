<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Poster */

$this->title = 'Create Poster';
$this->params['breadcrumbs'][] = ['label' => 'Posters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poster-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
