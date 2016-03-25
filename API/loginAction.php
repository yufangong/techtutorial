<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//
   try {
        $document = array(
                      'fname' => $_POST["fname"],
                      'lname' => $_POST["lname"],
                      'gender' => $_POST["gender"],
                      'age' => $_POST["age"],
                      );
    echo json_encode($document);

    $conn = new MongoClient();
    //echo $conn;
    $_db = $conn->db;
    $_collection = $_db->user; //selectCollection("user");
    $_collection->insert($document);
    //$conn->close();
    //$document['_id'] = $document['_id']->{'$id'};
    
    //return $document;
    
  } catch (MongoConnectionException $e) {
          echo "error";

    die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
          echo "error";

    die('Error: ' . $e->getMessage());
  }
  //echo "success";
  
  
    
    $criteria = array(
      "id" => "yufan"
    );
    
  $data = $_collection->find();
  echo json_encode($data);
  $conn->close();
?>
