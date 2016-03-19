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
require 'dataHandler.php';


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
        echo "Welcome to Tutorials.com web API service!";
    }
);


// API group
$app->group('/api', function () use ($app){
        
    
    //test
    /*$app->get('/tutorials', function() use($app)
        {
            echo 'It works!';
        });*/
    
    
        /* -------user log in------------------
         * URL input: none
         * Jasn: 
         * {
         * username
         * password
         * }
         */
        $app->post('/users', function () use ($app){
            userLogin($app);
        });  
        
        /* -------read------------------
         * URL input:
         * Jasn: 
         * {
         * username
         * password
         * title
         * }
         */
        $app->post('/tutorials', function() use($app)
        {
            read($app);
        });
        
        /* -------read by category------------------
         * URL input: cate
         * Jasn: 
         * {
         * username
         * password
         * }
         */
        $app->post('/tutorials/category', function() use($app)
        {
            readByCategory($app);
        });

        /* -------create a tutorial------------------
         * URL input: none
         * Jasn: 
         * {
         * username
         * password
         * turtorial
         * }
         */
        $app->post('/tutorials/tutorial', function() use($app)
        {
            create($app);
        });
        
        /* -------update a tutorial------------------
         * URL input: /
         * Jasn: 
         * {
         * username
         * password
         * tutorial
         * title
         * }
         */
        $app->put('/tutorials/tutorial', function() use($app)
        {
            update($app);
        });
        
        /* -------delete a tutorial------------------
         * URL input: /
         * Jasn: 
         * {
         * username
         * password
         * title
         * }
         */
        $app->delete('/tutorials/tutorial', function() use($app)
        {
            delete($app);
        });
        
        
        
        //-------file------------------
        $app->get('/file/download/:fname', function ($fname) use ($app){
            downloadFile($app, $fname);
        });
 
        $app->post('/file/upload/:fname', function ($fname) use ($app){
            uploadFile($app, $fname);
        });
        
        $app->delete('/file/delete/:fname', function ($fname) use ($app){
            deleteFile($app, $fname);
        });
        
        $app->post('/file/create/:fname', function ($fname) use ($app){
            createFile($app, $fname);
        });
     
    });
    
    

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();





