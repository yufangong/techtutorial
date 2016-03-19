<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Tutorials */

$this->title = 'Create Tutorials';
$this->params['breadcrumbs'][] = ['label' => 'Tutorials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
