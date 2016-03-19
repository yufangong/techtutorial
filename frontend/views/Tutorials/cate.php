<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TutorialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tutorials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Tutorials', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'_id',
            'title',
            'author',
            //'created_at',
            //'updated_at',
            'category',
            // 'file',
            // 'content',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
