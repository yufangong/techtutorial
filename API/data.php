<?php
require 'mongo/mongodbList.php';
require 'mongo/mongoCommand.php';
require 'mongo/mongodbCRUD.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
date_default_timezone_set('UTC');

function browser_list($db, $collection){
  
  $select = array(
    'limit' =>    (isset($_GET['limit']))   ? $_GET['limit'] : false, 
    'page' =>     (isset($_GET['page']))    ? $_GET['page'] : false,
    'filter' =>   (isset($_GET['filter']))  ? $_GET['filter'] : false,
    'regex' =>    (isset($_GET['regex']))   ? $_GET['regex'] : false,
    'sort' =>     (isset($_GET['sort']))    ? $_GET['sort'] : false
  );
  
  $data = mongoList(
    'localhost',
    $db, 
    $collection,
    $select
  );
  
  echo 
  "<!DOCTYPE html>
    <html>
    <head>
    <style>
    body {
    width: 100%;
    height: 100%;
    font-family: 'Ek Mukta', sans-serif;
	font-weight: 300;
    color: #666;
    background-color: #fff;
	font-size: 16px;
    line-height: 1.6em;
	font-weight: 400;
    }  
        table{
	color: #000000;
        background: #fff;
	border: 1px solid #f7f7f7;
	padding: 20px;
    }
        td{
        padding-left: 20px;
        }
    </style>
    </head>
    <body>";
       
  echo "<table>";
  echo "<th>Tutorial Name</th>"
  . "<th>Category</th>";
  foreach ($data['results'] as $result) {
       $id = $result['id'];
       $cate = $result['cate'];
       echo "<tr>"
      . "<td><a href='tutorials/{$id}'>{$result['name']}</a></td>"
      . "<td><a href='tutorials/cate/{$cate}'>{$result['cate']}</a></td>"
      . "</tr>"; 

  }
  echo "</table></body></html>";
   //header("Content-Type: application/json");
   //echo json_encode($data);
  exit;
}
function api_list($app, $db, $collection){
  
  $select = array(
    'limit' =>    (isset($_GET['limit']))   ? $_GET['limit'] : false, 
    'page' =>     (isset($_GET['page']))    ? $_GET['page'] : false,
    'filter' =>   (isset($_GET['filter']))  ? $_GET['filter'] : false,
    'regex' =>    (isset($_GET['regex']))   ? $_GET['regex'] : false,
    'sort' =>     (isset($_GET['sort']))    ? $_GET['sort'] : false
  );
  
  $data = mongoList(
    'localhost',
    $db, 
    $collection,
    $select
  );
  
  $response = $app->response;
  $response->headers->set('Content-Type', 'application/json');  
  if($data != null){
  $response->setStatus(200);
  }
  else
  {
        $response->setStatus(404);
  }
  $response->setBody(json_encode($data) );
  //echo $response;
  //header("Content-Type: application/json");
  //echo json_encode($data);
  //exit;
}

function browser_create($db, $collection){

    $tutorialDate = date("Y-m-d H:i:s");
    $document = array('id' => $_POST["TutorialId"],
                      'name' => $_POST["TutorialName"],
                      'cate' => $_POST["TutorialCategory"],
                      'author' => $_POST["TutorialAuthor"],
                      'content' => $_POST["TutorialContent"],
                      'date' => $tutorialDate
                      );
    mongoCreate(
    "localhost", 
    $db, 
    $collection, 
    $document
  ); 
  //header("Content-Type: application/json");
  echo "Create tutorial sussesfully";
  exit;
}
function api_create($app, $db, $collection){

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
  //exit;
}
// Read

function browser_read($db, $collection, $id){

    $data = mongoRead(
        "localhost",
        $db,
        $collection,
        $id
        );
  header("Content-Type: application/json");
  echo json_encode($data);
  exit;
}
function browser_read_cate($db, $collection, $cate){

    $data = mongoReadCate(
        "localhost",
        $db,
        $collection,
        $cate
        );
    
  header("Content-Type: application/json");
  echo json_encode($data);
  exit;
}
function api_read($app, $db, $collection, $id){

    $data = mongoRead(
        "localhost",
        $db,
        $collection,
        $id
        );
    
    
    $response = $app->response;
    $response->headers->set('Content-Type', 'application/json');  
    if($data != null){
        $response->setStatus(200);
    }
    else
    {
        $response->setStatus(404);
    }
    $response->setBody(json_encode($data) );  
  //header("Content-Type: application/json");
  //echo json_encode($data);
  //exit;
}

function api_read_cate($app, $db, $collection, $cate){

    $data = mongoReadCate(
        "localhost",
        $db,
        $collection,
        $cate
        );
    
    
    $response = $app->response;
    $response->headers->set('Content-Type', 'application/json');  
    if($data != null){
        $response->setStatus(200);
    }
    else
    {
        $response->setStatus(404);
    }   
    $response->setBody(json_encode($data) );  

}

function _update($app, $db, $collection, $id){

    $document = json_decode($app->request->getBody(), true);   

  $data = mongoUpdate(
    "localhost", 
    $db, 
    $collection, 
    $id,
    $document
  ); 
   $response = $app->response;
    $response->headers->set('Content-Type', 'application/json');  
    if($data != null){
        $response->setStatus(200);
    }
    else
    {
        $response->setStatus(403);
    }
    $response->setBody("{ 'message': successed}");    
}
function _delete($app, $db, $collection, $id){

  $data = mongoDelete(
    "localhost", 
    $db, 
    $collection, 
    $id
  ); 
    $response = $app->response;
    $response->headers->set('Content-Type', 'application/json');  
    if($data != null){
        $response->setStatus(200);
    }
    else
    {
        $response->setStatus(403);
    }
    $response->setBody("{ 'message': successed}");    
}
