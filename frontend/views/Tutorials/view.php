<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tutorials */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tutorials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorials-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
   
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'_id',
            'title',
            'author',
            'created_at',
            'updated_at',
            'category',
            //'file',
            [   'attribute' => 'content',
                'format' => 'ntext',
            ],
        ],
    ]) ?>
    
    <?php
    $files = $model->file;
    if($files){
        foreach ($files as $file)
        {
        
        $fileaddress = Url::to(['tutorials/download', 'file' => $file ]);
        echo "<a href = $fileaddress  class='btn btn-success']>Download {$file}</a></p>";
                
        }
        
    }
    ?>
   <p>
    </p>
    
    <?php
        echo '<label class="control-label">Upload Document</label>';
        echo FileInput::widget([
            'model' => $model,
            'name' => 'file',
//            'attribute' => 'attachment_3',
            'options' => ['multiple' => true],

            'pluginOptions' => [
                'uploadUrl' => Url::to(['tutorials/upload', 'id' => (string)$model->_id]),
                'uploadExtraData' => [
//                    'id' => $model->_id,
                ],
            ]
            
        ]);
    ?>
   
    

</div>
