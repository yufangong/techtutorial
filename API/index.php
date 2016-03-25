<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
//require 'Slim/Slim.php';
require 'vendor/autoload.php';
require 'data.php';


\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get(
    '/',
    function () {
        $template = <<<EOT
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8"/>
            <title>Tech Tutorial</title>
            <style>
                html,body,div,span,object,iframe,
                h1,h2,h3,h4,h5,h6,p,blockquote,pre,
                abbr,address,cite,code,
                del,dfn,em,img,ins,kbd,q,samp,
                small,strong,sub,sup,var,
                b,i,
                dl,dt,dd,ol,ul,li,
                fieldset,form,label,legend,
                table,caption,tbody,tfoot,thead,tr,th,td,
                article,aside,canvas,details,figcaption,figure,
                footer,header,hgroup,menu,nav,section,summary,
                time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent;}
                body{line-height:1;}
                article,aside,details,figcaption,figure,
                footer,header,hgroup,menu,nav,section{display:block;}
                nav ul{list-style:none;}
                blockquote,q{quotes:none;}
                blockquote:before,blockquote:after,
                q:before,q:after{content:'';content:none;}
                a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent;}
                ins{background-color:#ff9;color:#000;text-decoration:none;}
                mark{background-color:#ff9;color:#000;font-style:italic;font-weight:bold;}
                del{text-decoration:line-through;}
                abbr[title],dfn[title]{border-bottom:1px dotted;cursor:help;}
                table{border-collapse:collapse;border-spacing:0;}
                hr{display:block;height:1px;border:0;border-top:1px solid #cccccc;margin:1em 0;padding:0;}
                input,select{vertical-align:middle;}
                html{ background: #EDEDED; height: 100%; }
                body{background:#FFF;margin:0 auto;min-height:100%;padding:0 30px;width:800px;color:#666;font:14px/23px Arial,Verdana,sans-serif;}
                h1,h2,h3,p,ul,ol,form,section{margin:0 0 20px 0;}
                h1{color:#333;font-size:20px;}
                h2,h3{color:#333;font-size:14px;}
                h3{margin:0;font-size:12px;font-weight:bold;}
                ul,ol{list-style-position:inside;color:#999;}
                ul{list-style-type:square;}
                code,kbd{background:#EEE;border:1px solid #DDD;border:1px solid #DDD;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;padding:0 4px;color:#666;font-size:12px;}
                pre{background:#EEE;border:1px solid #DDD;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;padding:5px 10px;color:#666;font-size:12px;}
                pre code{background:transparent;border:none;padding:0;}
                a{color:#70a23e;}
                header{padding: 30px 0;text-align:center;}
            </style>
        </head>
        <body>
            <header>
                <h1>Tech Tutorial</h1>
            </header>
            <h2>Welcome to Tech tutorial!</h2>
            <p>
                
            </p>
            <section>
                <h2>Get Started</h2>
                <ol>
                    <li><a href="tutorials.php"> Tutorials </a></li>
                    <li><a href="upload.html"> Upload File </a></li>
                    <li><a href="Download.php"> download File </a></li>
                </ol>
            </section>
            <section>
                <h2>RestApi using Slim Framework</h2>

                <h3>Support Forum and Knowledge Base</h3>
                <p>
                    Visit the <a href="http://help.slimframework.com" target="_blank">Slim support forum and knowledge base</a>
                    to read announcements, chat with fellow Slim users, ask questions, help others, or show off your cool
                    Slim Framework apps.
                </p>

                
            </section>
            <section style="padding-bottom: 20px">
                <h2>Slim Framework Extras</h2>
                <p>
                    Custom View classes for Smarty, Twig, Mustache, and other template
                    frameworks are available online in a separate repository.
                </p>
                <p><a href="https://github.com/codeguy/Slim-Extras" target="_blank">Browse the Extras Repository</a></p>
            </section>
        </body>
    </html>
EOT;
        echo $template;
    }
);


//$app->get(
//    '/tutorials',
//    function() {
//        echo "<h1>This page should contains a list of tutorials!</h1>";
//        
//    }
//);
//
//$app->get(
//    '/tutorials/id/:tid',
//    function($tid) {
//         echo "This page should show tutorial id = " . $tid;
//    }
//);
//    
//    
//$app->get(
//    '/tutorials/category/:cate',
//    function($cate) {
//         echo "This page should show tutorial category = " . $cate;
//         getTutorialCate($cate);
//    }
//);

$app->get(
    '/download/:fname',
    function($fname) {
        browser_downloadFile($fname);
    }
);


// POST route
$app->post(
    '/post/upload',
    function () {
        browser_uploadFile();
    }
);

$app->post(
        '/post/login',
        function() {
            login_demo();
        }
        );

//// PUT route
//$app->put(
//    '/put',
//    function () {
//        echo 'This is a PUT route';
//    }
//);
//
//// PATCH route
//$app->patch('/patch', function () {
//    echo 'This is a PATCH route';
//});
//
//// DELETE route
//$app->delete(
//    '/delete',
//    function () {
//        echo 'This is a DELETE route';
//    }
//);



$app->group('/data', function () use ($app) {
    
    $app->get('/:db/:collection', function ($db, $collection)
    {
        browser_list($db, $collection);
    });
    $app->get('/:db/:collection/:id', function($db, $collection, $id)
    {
        browser_read($db, $collection, $id);
    });
    $app->get('/:db/:collection/cate/:cate', function($db, $collection, $cate)
    {
        browser_read_cate($db, $collection, $cate);
    });
    $app->post('/:db/:collection', function($db, $collection)
    {
        browser_create($db, $collection);
    });
//    $app->put('/:collection/:id',  '_update');
//    $app->delete('/:collection/:id',  '_delete');
    }
);



// API group
$app->group('/api', function () use ($app){
  
        $app->get('/data/:db/:collection', function ($db, $collection) use($app)
        {
            api_list($app, $db, $collection);
        });
        
        $app->get('/data/:db/:collection/:id', function($db, $collection, $id) use($app)
        {
            api_read($app, $db, $collection, $id);
        });
        
        $app->get('/data/:db/:collection/cate/:cate', function($db, $collection, $cate) use($app)
        {
            api_read_cate($app, $db, $collection, $cate);
        });

        $app->post('/data/:db/:collection', function($db, $collection) use($app)
        {
            api_create($app, $db, $collection);
        });
        
        $app->put('/data/:db/:collection/:id', function($db, $collection, $id) use($app)
        {
            _update($app, $db, $collection, $id);
        });
        
        $app->delete('/data/:db/:collection/:id', function($db, $collection, $id) use($app)
        {
            _delete($app, $db, $collection, $id);
            
        });
        $app->get('/file/download/:fname', function ($fname) use ($app){
            api_downloadFile($app, $fname);
        });
 
        $app->post('/file/upload', function () use ($app){
            api_uploadFile($app);
        });
        
        $app->delete('/file/delete/:fname', function ($fname) use ($app){
            _deleteFile($app, $fname);
        });
        
        $app->post('/file/upload/:db/:collection/:id', function ($db, $collection, $id) use ($app){
            api_uploadFile_update($app, $db, $collection, $id);
        });
        
        
    });


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();



function api_uploadFile_update($app, $db, $collection, $id)
{
    $target_dir = "repository/";
    $source_file = $app->request->getBody();
    $filename = basename($source_file);

    $target_file = $target_dir . $filename;
    
    try {
        
        
        $document = array('file' => 'http://localhost/demo/index.php/api/file/download/'.$filename);
        
        $data = mongoUpdate(
            "localhost", 
            $db, 
            $collection, 
            $id,
            $document
        ); 
        
        
        $src = fopen($source_file, 'r');
        $dest = fopen($target_file, 'w');
        stream_copy_to_stream($src, $dest, 1024);
        $response = $app->response;
        $response->headers->set('Content-Type', 'application/json');  
        $response->setBody("{ 'message': successed}");    
        $response->setStatus(201);
    } catch (Exception $ex) {
         $response = $app->response;
        $response->headers->set('Content-Type', 'application/json');  
        $response->setBody($ex);    
        $response->setStatus(403);
    }   
}

function api_uploadFile($app)
{
    $target_dir = "repository/";
    $source_file = $app->request->getBody();
    $filename = basename($source_file);

    $target_file = $target_dir . $filename;
    
    try {
        $src = fopen($source_file, 'r');
        $dest = fopen($target_file, 'w');
        stream_copy_to_stream($src, $dest, 1024);
        $response = $app->response;
        $response->headers->set('Content-Type', 'application/json');  
        $response->setBody("{ 'message': successed}");    
        $response->setStatus(201);
    } catch (Exception $ex) {
         $response = $app->response;
        $response->headers->set('Content-Type', 'application/json');  
        $response->setBody($ex);    
        $response->setStatus(403);
    }   
}

function login_demo()
{
    $source = $app->request->getBody();
    
    $document = json_decode($app->request->getBody(), true);   
    $data = mongoCreate(
    "localhost", 
    $db, 
    $collection, 
    $document
  ); 
  //header("Content-Type: application/json");
  //echo json_encode($data);
  
    $response = $app->response;
    $response->headers->set('Content-Type', 'application/json');  
    if($data != null){
        $response->setStatus(201);
    }
    else
    {
        $response->setStatus(403);
    }
    $response->setBody("{ 'message': successed}");
}
function browser_uploadFile()
{
    $target_dir = "repository/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
//echo $_FILES["fileToUpload"]["tmp_name"];
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
}
function api_downloadFile($app, $fname)
{
    $target_dir = "repository/";
    $target_file = $target_dir . $fname;
    if(file_exists($target_file))
    {
    $res = $app->response();
    $res['Content-Description'] = 'File Transfer';
    $res['Content-Type'] = 'application/octet-stream';
    $res['Content-Disposition'] ='attachment; filename=' . basename($target_file);
    $res['Content-Transfer-Encoding'] = 'binary';
    $res['Expires'] = '0';
    $res['Cache-Control'] = 'must-revalidate';
    $res['Pragma'] = 'public';
    $res['Content-Length'] = filesize($target_file);
    $res['body'] = json_encode(readfile($target_file));
    $res->setStatus(200);
    }
    else
    {
        $app->status(404);
        $res = $app->response();
       
        //$res['body'] = json_encode(readfile($target_file));
    }
}

function browser_downloadFile($fname)
{
    $target_dir = "repository/";
    $target_file = $target_dir . $fname;
    if(file_exists($target_file))
    {
        header("Pragma: public");
        header("Accept-Ranges: bytes");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=". basename($target_file));
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($target_file));
	ob_clean();
        readfile($target_file);
    }
    else
    {
        echo "file didn't exist!";
    }
}

function _deleteFile($app, $fname)
{
    $target_dir = "repository/";
    $target_file = $target_dir . $fname;
    if(file_exists($target_file))
    {
        
    unlink($target_file);
    $res = $app->response();

    $res->setBody("{ 'message': successed}");    
    $res->setStatus(200);
    }
    else
    {
        $app->status(404);
        $res = $app->response();
        $res->setBody("{ 'message': failed}");    

        //$res['body'] = json_encode(readfile($target_file));
    }
}
