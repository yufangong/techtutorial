<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class ="btn-success">Welcome to TechTutorial!</h1>

        <p class="lead">Let's start to study programming.</p>

<!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
           
            <div class="col-lg-4">
                <?php
                    //use frontend\models\TutorialsSearch;
                    //$searchModel = new TutorialsSearch();
                    //$dataProvider = $searchModel->search('cplusplus');
                    use yii\helpers\Url;
                    $cpp = Url::to(['tutorials/cate', 'cate' => 'cpp']);
                    echo "<h2><a href = $cpp >C++ Tutorials</a></h2>"
                ?>
                <p>Some description.</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
            </div>
            <div class="col-lg-4">
                <?php
                    $net = Url::to(['tutorials/cate', 'cate' => '.net']);
                
                    echo "<h2><a href = $net >.Net Tutorials</a></h2>"
                ?>
                <p>description.</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
            </div>
             <div class="col-lg-4">
                <?php
                    $create = Url::to(['tutorials/create']);
                
                    echo "<h2><a href = $create >Create One</a></h2>"
                ?>
                <p>description.</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
            </div>
            
            
             <div class="col-lg-4">
                
                <?php
                    $all = Url::to(['tutorials/index']);
                
                    echo "<h2><a href = $all >All Tutorials</a></h2>"
                ?>
                <p>description.</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
            </div>
        </div>

    </div>
</div>
