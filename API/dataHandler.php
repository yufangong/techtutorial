<?php
require_once 'mongoOperations.php';

date_default_timezone_set('UTC');

const DEFAULT_DB_NAME = 'tt';
const USER_COLLECTION_NAME = 'user';
const TUTORIAL_COLLECTION_NAME = 'Tutorials';
const MONGO_HOST_NAME = 'localhost';
const MONGO_PORT_NAME = '27017';


const ROOT_PATH="../repository/";



function sendReply($app,$result,$data)
{
    $response = $app->response;
        $response->headers->set('Content-Type', 'application/json');  
        if(isset($data['message']) and $data['message']=="No tutorials")
        {
            $response->setStatus(204);
        }
        elseif($result == TRUE){
            $response->setStatus(200);
        }
        else
        {
            $response->setStatus(403);
        }   
        $response->setBody(json_encode($data)); 
}

function userLogin($app)
{
    $document=json_decode($app->request->getBody(),true);
    $result=FALSE;
    $data=array("messagefail"=>"Invalid username or password!");
    try{
        $db=DEFAULT_DB_NAME;
        $collection=TUTORIAL_COLLECTION_NAME;

        if(isset($document['username']) and isset($document['password']))
        {
            $mongo = new MongoOperations(MONGO_HOST_NAME, MONGO_PORT_NAME, USER_COLLECTION_NAME);
            $u=$document['username'];
            $p=$document['password'];
            if($mongo->isUserAuthorized($db, $u, $p, 'user'))
            {
                $data=array("messagefail"=>"client cannot edit tutorial");
                $result=TRUE;
            }
            elseif ($mongo->isUserAuthorized($db, $u, $p, 'editor')) {
                $data = $mongo->mongoRead($db, $collection, array('author'=>$u));
                if($data!=FALSE){
                    $data = iterator_to_array($data);  
                }
                else{$data=array("message"=>"No tutorials");}
                $result=TRUE;
            }
            elseif ($mongo->isUserAuthorized($db, $u, $p, 'admin')) {
                $data = $mongo->mongoRead($db, $collection, array());
                if($data!=FALSE){
                    $data = iterator_to_array($data); 
                }
                else{$data=array("message"=>"No tutorials");}
                $result=TRUE;
            }
        }
    } catch (Exception $ex) {
        $result=FALSE;
        $data=array("messagefail"=>$ex);
    } finally {
        sendReply($app, $result, $data);
    }   
}
   
/*
 * 
 */
function create($app){
    $document = json_decode($app->request->getBody(), true);  
    $result=FALSE;
    $data=array("messagefail"=>"Create error!");
    try{
        if(isset($document['username']) and isset($document['password']) and isset($document['tutorial']))
        {
            $tutorial_info = makeTutorial($document['tutorial'], $document['username']);
            $mongo = new MongoOperations(MONGO_HOST_NAME, MONGO_PORT_NAME, USER_COLLECTION_NAME);
            $result = $mongo->mongoCreate(DEFAULT_DB_NAME, TUTORIAL_COLLECTION_NAME, $tutorial_info, $document['username'], $document['password']);
        
            if($result==TRUE){$data=array("messagefail"=>"Create succeed!");}
        }   
    } catch (Exception $ex) {
        $result=FALSE;
        $data=array("messagefail"=>"Server Error!");
    } finally {
        sendReply($app, $result, $data);
    }   
}


/*
 * 1.Tutorials
 *     
 * title
 * author
 * created_at
 * updated_at
 * category
 * files[]
 * content
 * keywords[]
 * 
 * message => ""
 * 
 * 2.Users
 * 
 * 
 * 3.
 * 
 */
function makeTutorial($document, $username)
{
        $title = '';
        if(isset($document['title'])) {$title = $document['title'];}
        
        $author=$username;
        
        $category = '';
        if(isset($document['category'])) {
            $category = $document['category'];
            /*$mongo=new MongoOperations('localhost', '27017', '');
            $result = $mongo->mongoRead($db, 'categories', array('$in'=>$category));
            if($result->count()<1){$category='';}*/
        }
        
        $keywords = array();
        if(isset($document['keywords'])) {$keywords = $document['keywords'];}
        
        $files = array();
        if(isset($document['files'])) {$files = $document['files'];}
        
        $content = '';
        if(isset($document['content'])) {$content = $document['content'];}
        
        $create_time = date("Y-m-d H:i:s");
        $lastmodifiedtime=date("Y-m-d H:i:s");
        
    $out=array('title' => $title, 'author' => $author, 'category' => $category, 'keywords' => $keywords, 'files' => $files, 'content' => $content, 'created_at' => $create_time, 'updated_at'=>$lastmodifiedtime);
    
    
    return $out;
}

function checkTutorial($document, $username, $title)
{
        $out=array();
        if(isset($document['title']) and $document['title'] != $title) {$out = array_merge($out,array('title'=>$document['title']));}
        
        if(isset($document['category'])) {$out = array_merge($out,array('category'=>$document['category']));}

        if(isset($document['keywords'])) {$out = array_merge($out,array('keywords'=>$document['keywords']));}
        
        if(isset($document['files'])) {$out = array_merge($out,array('files'=>$document['files']));}
        
        if(isset($document['content'])) {$out = array_merge($out,array('content'=>$document['content']));}
        
        $out = array_merge($out,array('updated_at'=>date("Y-m-d H:i:s")));
    return $out;
}

// Read
function read($app){
    $result=FALSE;
    $data=array("messagefail"=>"Read error!");
    try{
        $document = json_decode($app->request->getBody(), true);
        if(isset($document['title'])){
            $mongo = new MongoOperations(MONGO_HOST_NAME, MONGO_PORT_NAME, USER_COLLECTION_NAME);
            $data = $mongo->mongoRead(DEFAULT_DB_NAME, TUTORIAL_COLLECTION_NAME, array('title'=>$document['title']));
            if($data!=FALSE){
                $data = iterator_to_array($data); 
                $result=TRUE;
            }
            else{$data=array("message"=>"No tutorials");}
        }
    
    } catch (Exception $ex) {
        $result=FALSE;
        $data=array("messagefail"=>"Server Error!");
    } finally {
        sendReply($app, $result, $data);
    }    
}

function readByCategory($app){
    $result=FALSE;
    $data=array("messagefail"=>"Read error!");
    try{
        $document = json_decode($app->request->getBody(), true);
        if(isset($document['category'])){
            $mongo = new MongoOperations(MONGO_HOST_NAME, MONGO_PORT_NAME, USER_COLLECTION_NAME);
            $data = $mongo->mongoRead(DEFAULT_DB_NAME, TUTORIAL_COLLECTION_NAME, array('category'=>$document['category']));
            if($data!=FALSE){
                $data = iterator_to_array($data); 
                $result=TRUE;
            }
            else{$data=array("message"=>"No tutorials");}
        }
    } catch (Exception $ex) {
        $result=FALSE;
        $data=array("messagefail"=>"Server Error!");
    } finally {
        sendReply($app, $result, $data);
    }    
}


function update($app){
    $document = json_decode($app->request->getBody(), true);   
    $result=FALSE;
    $data=array("messagefail"=>"Update error!");
    try{
        if(isset($document['username']) and isset($document['password']) and isset($document['tutorial']) and isset($document['title']))
        {
            $tutorial_info = checkTutorial($document['tutorial'], $document['username'],$document['title']);
            $mongo = new MongoOperations(MONGO_HOST_NAME, MONGO_PORT_NAME, USER_COLLECTION_NAME);
            $result = $mongo->mongoUpdate(DEFAULT_DB_NAME, TUTORIAL_COLLECTION_NAME, array('title'=>$document['title']), $tutorial_info, $document['username'], $document['password']);
        
            if($result==TRUE){$data=array("messagefail"=>"Update succeed!");}
        }
    
    } catch (Exception $ex) {
        $result=FALSE;
        $data=array("messagefail"=>"Server Error!");
    } finally {
        sendReply($app, $result, $data);
    }      
}

function delete($app){
    $document = json_decode($app->request->getBody(), true);   
    $result=FALSE;
    $data=array("messagefail"=>"Delete error!");
    try{
        if(isset($document['username']) and isset($document['password']) and isset($document['title']))
        {
            $mongo = new MongoOperations(MONGO_HOST_NAME, MONGO_PORT_NAME, USER_COLLECTION_NAME);
            $result = $mongo->mongoDelete(DEFAULT_DB_NAME, TUTORIAL_COLLECTION_NAME, array('title'=>$document['title']), $document['username'], $document['password']);
            if($result==TRUE){$data=array("messagefail"=>"Delete succeed!");}
        }
    
    } catch (Exception $ex) {
        $result=FALSE;
        $data=array("messagefail"=>"Server Error!");
    } finally {
        sendReply($app, $result, $data);
    }   
}


//---------------------------------------file-----------------------------------------------------------


function createFile($app,$filename)
{  
    try {
       $target_dir = ROOT_PATH;
       $target_file = $target_dir . $filename;
       $fp = fopen($target_file, "w");
       fclose($fp);   
        $response = $app->response;
        $response->headers->set('Content-Type', 'application/json');  
        $response->setBody(json_encode(array("messagefail"=>"Succeed!")));    
        $response->setStatus(200);
    } catch (Exception $ex) {
         $response = $app->response;
         $response->headers->set('Content-Type', 'application/json');  
         $response->setBody($ex);    
         $response->setStatus(403);
    }   
}

function downloadFile($app, $fname)
{
    $target_dir = ROOT_PATH;
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
        $app->status(403);
        $res = $app->response();
       
        //$res['body'] = json_encode(readfile($target_file));
    }
}


function uploadFile($app,$filename)
{  
    try {
        $target_dir = ROOT_PATH;
        $target_file = $target_dir . $filename;
        $putdata = fopen("php://input", "r");

        while ($data = fread($putdata, 512))
        {file_put_contents($target_file, $data, FILE_APPEND | LOCK_EX);}
        fclose($putdata);
        $response = $app->response;
        $response->headers->set('Content-Type', 'application/json');  
        $response->setStatus(200);
        $response->setBody(json_encode((array("messagefail"=>"Succeed!"))));    
        
    } catch (Exception $ex) {
         $response = $app->response;
         $response->headers->set('Content-Type', 'application/json');
         $response->setStatus(403);
         $response->setBody($ex);    
         
    }   
}

function deleteFile($app, $fname)
{
    $target_dir = ROOT_PATH;
    $target_file = $target_dir . $fname;
    if(file_exists($target_file))
    {
        unlink($target_file);
        $res = $app->response;
        $res->setStatus(200);
        $res->setBody(json_encode(array("messagefail"=>"Succeed!")));    
        
    }
    else
    {
        $app->status(403);
        $res = $app->response;
        $res->setBody(json_encode(array("messagefail"=>"Failed!")));    

        //$res['body'] = json_encode(readfile($target_file));
    }
}
