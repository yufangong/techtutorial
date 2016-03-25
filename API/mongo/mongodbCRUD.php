<?php

// connect
//$m = new MongoClient();
//
//// select a database
//$db = $m->comedy;
//
//// select a collection (analogous to a relational database's table)
//$collection = $db->cartoons;
//
//// add a record
//$document = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson" );
//$collection->insert($document);
//
//// add another record, with a different "shape"
//$document = array( "title" => "XKCD", "online" => true );
//$collection->insert($document);
//
//// find everything in the collection
//$cursor = $collection->find();
//
//// iterate through the results
//foreach ($cursor as $document) {
//    echo "<p>{$document['title']}</p>";
//}


function mongoCreate($server, $db, $collection, $document) {
  try {
  
    $conn = new MongoClient($server);
    $_db = $conn->{$db};
    $_collection = $_db->{$collection};
    $_collection->insert($document);
    $conn->close();
    
    $document['_id'] = $document['_id']->{'$id'};
    
    return $document;
    
  } catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
  }
  
}
/**
 * Read (findOne)
 */
function mongoRead($server, $db, $collection, $id) {
  
  try {
  
    $conn = new MongoClient($server);
    $_db = $conn->{$db};
    $_collection = $_db->{$collection};
    
    $criteria = array(
      "id" => $id
    );
    
    $document = $_collection->findOne($criteria);
    $conn->close();
    
    //$document['id'] = $document['id'];

    //$document['_id'] = $document['_id']->{'$id'};

    return $document;
    
  } catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
  }
  
}

function mongoReadCate($server, $db, $collection, $cate) {
  
  try {
  
    $conn = new MongoClient($server);
    $_db = $conn->{$db};
    $_collection = $_db->{$collection};
    
    $criteria = array(
      'cate' => $cate
    );

    $cursor = $_collection->find($criteria);
    $conn->close();
    $document = iterator_to_array($cursor);
    //$document['id'] = $document['id'];
//    foreach ($curs as $doc) {
//        var_dump($doc);
//        echo "space \n";
//        //$document += $doc;
//    }
    
    return $document;
    
  } catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
  }
  
}
/**
 * Update (set properties)
 */
function mongoUpdate($server, $db, $collection, $id, $document) {
  try {
  
    $conn = new MongoClient($server);
    $_db = $conn->{$db};
    $_collection = $_db->{$collection};
    
    $criteria = array(
      'id' => $id
    );
    
    // make sure that an _id never gets through
    unset($document['_id']);
    
    $_collection->update($criteria,array('$set' => $document));
    $conn->close();
    
    //$document['_id'] = $id;
    return $document;
    
  } catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
  }
  
}
/**
 * Delete (remove)
 */
function mongoDelete($server, $db, $collection, $id) {
  try {
  
    $conn = new MongoClient($server);
    $_db = $conn->{$db};
    $_collection = $_db->{$collection};
    
    $criteria = array(
      'id' => $id
    );
    $_collection->remove(
      $criteria,
      array(
        'safe' => true
      )
    );
    
    $conn->close();
    
    return array('success'=>'deleted');
    
  } catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
  }
  
}
?>
