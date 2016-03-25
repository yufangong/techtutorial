<?php
/* @var $this yii\web\View */
$this->title = 'Tech Tutorial';
use yii\helpers\Url;

?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class ="btn-success">WELCOME TO THE TECHTUTORIAL!</h1>

        <p class="lead">Ready to program?</p>
        <br>
        <?php
            $create = Url::to(['tutorials/create']);
                
            echo "<p class='btn btn-lg btn-success'><a href = $create >Create Tutorial</a></p>"
        ?>
<!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div  class="row">
           
            <div class="col-lg-4">
                <?php
                    //use frontend\models\TutorialsSearch;
                    //$searchModel = new TutorialsSearch();
                    //$dataProvider = $searchModel->search('cplusplus');
                    $cpp = Url::to(['tutorials/cate', 'cate' => 'cpp']);
                    echo "<h2><a href = $cpp >C++ Tutorials</a></h2>"
                ?>
                <p>We love C++, best language!!!!!!</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
            </div>
            <div class="col-lg-4">
                <?php
                    $net = Url::to(['tutorials/cate', 'cate' => '.net']);
                
                    echo "<h2><a href = $net >.Net Tutorials</a></h2>"
                ?>
                <p>Powerful framework developed by Microsoft.</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
            </div>
             <div class="col-lg-4">
                <?php
                    $net = Url::to(['tutorials/cate', 'cate' => 'php']);
                
                    echo "<h2><a href = $net >Php Tutorials</a></h2>"
                ?>
                <p>Emmmmmmmmm, interesting language.</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
            </div>
             <div class="col-lg-4">
                <?php
                    $net = Url::to(['tutorials/cate', 'cate' => 'java']);
                
                    echo "<h2><a href = $net >Java Tutorials</a></h2>"
                ?>
                <p>Well, if you really want to study this.........</p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
            </div>

            
            
             <div class="col-lg-4">
                
                <?php
                    $all = Url::to(['tutorials/index']);
                
                    echo "<h2><a href = $all >All Tutorials</a></h2>"
                ?>
                <p></p>

<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
            </div>
            
            


<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
            
            
            
        </div>

    </div>
</div>
