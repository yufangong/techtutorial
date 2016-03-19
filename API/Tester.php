<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
/*
 * 1.Tutorials
 *     
 * title
 * author
 * category
 * keywords[]
 * files[]
 * contents
 * create_time
 * 
 * 2.Users
 * 
db:test_db;
collections: 1. tutorials 2. users

db.users.insert(
                    {
                      username: "editor1",
                      password_hash:"9003d1df22eb4d3820015070385194c8",
                      password_reset_token:"",
                      email:"eee1",
                      auth_key:"",
                      role:"editor",
                      status:"",
                      create_at:"",
                      updated_at:""
                    }
                 )
 db.users.insert(
                    {
                      username: "admin1",
                      password_hash:"9003d1df22eb4d3820015070385194c8",
                      password_reset_token:"",
                      email:"eee1",
                      auth_key:"",
                      role:"admin",
                      status:"",
                      create_at:"",
                      updated_at:""
                    }
                 )
 db.users.insert(
                    {
                      username: "user1",
                      password_hash:"9003d1df22eb4d3820015070385194c8",
                      password_reset_token:"",
                      email:"eee1",
                      auth_key:"",
                      role:"user",
                      status:"",
                      create_at:"",
                      updated_at:""
                    }
                 )

 * 
 * 3.
 * 
 */
        require_once 'data.php';
        //api_list($app, $db, $collection);
        
        /*$tutorial=array('title'=>'title2','author'=>'editor1','category'=>'cpp','keywords'=>array('k1','k2','k3'),'files'=>array('f1','f2','f3'),'contents'=>'some contents');
        $app=array('username'=>'editor1','password'=>'pwd','tutorial'=>$tutorial);
        api_create($app, "test_db", "tutorials");*/ //OK
        
        
        //api_read($app, "test_db", "tutorials", "title");//OK
        
        //api_read_cate($app, "test_db", "tutorials", "cpp");//OK  format?
        
        /*$tutorial=array('files'=>array('f11','f21','f31'),'contents'=>'some other contents');
        $app=array('username'=>'editor1','password'=>'pwd','tutorial'=>$tutorial);
        _update($app, "test_db", "tutorials", "title");*/  //OK
        
        /*$app=array('username'=>'editor1','password'=>'pwd');
        _delete($app, "test_db", "tutorials", "title");*/  //OK
        
        
        //api_uploadFile_update($app, $db, $collection, $id);
        //api_uploadFile($app);
        //api_downloadFile($app, $fname);
        //_deleteFile($app, $fname);
        
        
        /*$app=array('username'=>'editor1','password'=>'pwd');
        api_UserLogin($app,"test_db", "tutorials");*/ //OK
        
        
        //api_DeleteAndUpdate($db,$collection,$tutoTitle);
        //api_SaveEidt($db,$collection,$tutoTitle);
        //api_updateuser($app);
        
        ?>
    </body>
</html>
