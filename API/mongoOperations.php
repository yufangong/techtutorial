<?php

require "Security.php";


class MongoOperations{
    
    private $hosts="";
    private $port="";
    private $userCollection="";
    private $db_conx="";
            
    function __construct($hosts, $port, $userCollection)
    {
        $this->hosts = $hosts;
        $this->port = $port;
        $this->userCollection = $userCollection;
        //$this->db_conx = NULL;
        $this->getMongodbConnection();
    }
    
    function __destruct() {
        $this->db_conx->close();
    }



    /*Connect to mongo db
     * 
     * will initialize the db_conx
     * Success: db_conx will be set
     * Unsuccess: 
     */
    
    private function getMongodbConnection()
    {
        //build connection string
        $connecting_string =  sprintf('mongodb://%s:%d', $this->hosts, $this->port);
       
        //Connect
        try{
            $this->db_conx = new MongoClient( $connecting_string );
            //return TRUE;
        } catch (Exception $ex) {
            //return FALSE;
            $this->db_conx = NULL;
        }

    }

    /*check if the user is authorized
     * 
     * Success:True
     * Unsuccess:false
     */
    public function isUserAuthorized($db, $username, $password, $role){
        if($this->db_conx == NULL)
        {
            return FALSE;
        }
        try{
            $customers = new MongoCollection($this->db_conx->$db,  ($this->userCollection));
            $query=$customers->find(array('username' => $username,'role' => $role));
            $numrows=$query->count();
            if($numrows < 1){
                return FALSE;
            }
            ///////
            $security = new Security();
            
            if($security->validatePassword($password, $query->getNext()['password_hash']) == TRUE){
                return TRUE;
            }
            else{
                return FALSE;
            }
            
            
            ///////
            
            
        }
        catch (Exception $ex) {
            return FALSE;
        }
    }

    /*create a mongo document
     * 
     * Success: True
     * Unsuccess: False
     */
    public function mongoCreate($db, $collection, $document, $username, $password) {
        if($this->isUserAuthorized($db, $username, $password, 'admin') == FALSE){//admin can create anything
            if($collection == $this->userCollection || $this->isUserAuthorized($db, $username, $password, 'editor') == FALSE)
            {//editor can only create his own tutorials
                return FALSE;
            }
        }
        try {
            $_collection = $this->db_conx->$db->{$collection};
            if($this->isItemExist($_collection, $document['title']) == TRUE){
                return FALSE;
            }
            
            $result=$_collection->insert($document);
            if($result['err'] == NULL){
                return TRUE;
            }
            else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }
    
    /* Read a mongo document
     * 
     * Success: result list
     * Unsuccess: False
     */
    public function mongoRead($db, $collection, $query){
        if($collection == $this->userCollection)
        {
            return FALSE;
        }
        try {
            $_collection = $this->db_conx->$db->{$collection};
            $document = $_collection->find($query);
            if($document->count()>0){return $document;}
            else {return FALSE;}
        } catch (Exception $e) {
            return FALSE;
        }
    }
    
    /**
     * Update (set properties)
     * admin user can change anything
     * user can change nothing
     * editor can change his own things
     * 
     * editor cannot change title to existing ones
     * 
     */
    public function mongoUpdate($db, $collection, $criteria, $document, $username, $password) {
        $role='admin';//check if user is admin
        $r=  $this->mongoRead($db, $collection, $criteria);
        if($r != FALSE and $r->getNext()['author'] == $username)
        {
            $role='editor';//even editor can update his own file
        }
        //$role='editor';
        if($collection == $this->userCollection || $this->isUserAuthorized($db, $username, $password, $role) == FALSE)
        {
            return FALSE;
        }
        try {
            $_collection = $this->db_conx->$db->{$collection};
            
            if(isset($document['title']) and $this->isItemExist($_collection, $document['title']) == TRUE){
                return FALSE;
            }
            
            $result = $_collection->update($criteria, array('$set' => $document));
            if($result['err'] == NULL){
                return TRUE;
            }
            else {
                return FALSE;
            }
            //$document['_id'] = $id;
            //return $document;

        } catch (Exception $e) {
            return FALSE;
        }
    }
   
    /**
     * Delete (remove)
     */
    public function mongoDelete($db, $collection, $criteria, $username, $password) {
        $role='admin';
        $r =  $this->mongoRead($db, $collection, $criteria);
        if($r != FALSE and $r->getNext()['author'] == $username)
        {
            $role='editor';//even editor can update his own file
        }
        //$role='editor';
        if($collection == $this->userCollection || $this->isUserAuthorized($db, $username, $password, $role) == FALSE)
            {
                return FALSE;
            }
            try {
                $_collection = $this->db_conx->$db->{$collection};
                $result = $_collection->remove($criteria);
                if($result['err'] == NULL){
                    return TRUE;
                }
                else {
                    return FALSE;
                }
            } catch (Exception $e) {
                return FALSE;
            }  
    }
    
   
    private function isItemExist($collection, $name)
    {
        try {
            $result=$collection->find(array('title'=>$name));
            if($result->count() == 0)
            {
                return FALSE;
            }
            else {
                return TRUE;
            }

        } catch (Exception $e) {
            return TRUE;
        }
    }


}
