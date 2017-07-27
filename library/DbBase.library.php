<?php

class DbBase {

    public $dbh;
    private $query;
    private $params;
    private $statement;
    protected $table;
    
    public function __construct($table = ""){
        
        /*+ @var $this->dbh PDO */
        $dsn = "mysql:dbname=".Config::getInstance()->get("db_name")
                     .";host=".Config::getInstance()->get("db_host")."";
        $user = Config::getInstance()->get("db_user");
        $pass = Config::getInstance()->get("db_pass");
        
        /** PDO Connection */
        $this->dbh = new PDO($dsn, $user, $pass);
        
        /** @var $this->query String */
        $this->query = "";
        
        /** @var $this->params Array */
        $this->params = array();
        $this->table = $table;
        
    }
 
    
    /**
     * @param type $query
     * @param type $params
     */
    private function executeQuery($query = "",  $params = array()){
        $this->statement = $this->dbh->prepare($query);
        $i = 1;
        foreach ($params as $key => $param){
            $this->statement->bindParam($i, $param[0], $param[1]);
            $i++;
        }
        $this->statement->execute();
    }
    /**
     * 
     * @param type $query
     * @param type $params
     */
    public function fetch($query = "", $params = array()){
       $this->executeQuery($query, $params);
       return $this->statement->fetch();
    }
    /**
     * 
     * @param type $query
     * @param type $params
     */
    public function fetchAll($query = "", $params = array()){
       $this->executeQuery($query, $params);
       return $this->statement->fetchAll();
    }
    /**
     * 
     */
    public function execute($query, $params){
        $this->executeQuery($query, $params);
    }
    
        public function findAll(){
        return $this->fetchAll("SELECT * FROM $this->table ");
    }
    public function findById( $id = 0 ){
        return $this->fetch("SELECT * FROM $this->table WHERE id = ? ", array(
            array($id , PDO::PARAM_INT)
        ));
    }
    
    public function findWithLimit($offset,$limit){
           
         return $this->fetchAll("SELECT * FROM $this->table LIMIT $offset , $limit");  
    }
    
    public function searchBy($field, $value){
        if($value[1] === PDO::PARAM_INT){
             return $this->fetchAll("SELECT * FROM $this->table WHERE $field = ? ", array(
                $value
            ));
        }
        return $this->fetchAll("SELECT * FROM $this->table WHERE $field like  ? ", array(
            $value
        ));
       
    }
    public function searchOneBy($field, $value){

         if($value[1] === PDO::PARAM_INT){
             return $this->fetch("SELECT * FROM $this->table WHERE $field = ? ", array(
                $value
            ));
        }
        return $this->fetch("SELECT * FROM $this->table WHERE $field like  ? ", array(
            $value
        ));
    }
    public function update($id = 0, $params = array()){
        $updateQuery = "UPDATE $this->table ";
        $first = true;
        foreach ($params as $key => $param){
            if($first === true){
                $updateQuery.= " SET  ".$key ." = ? ";
                $first = false;
            }else{
                $updateQuery.= ",  ".$key ." = ? ";
            }
        }
        $updateQuery.= " WHERE id = ? ";
        $params[] = array($id, PDO::PARAM_INT);
        $this->execute($updateQuery, $params);
    }
    
    public function insert($params = array()){
        $insertQuery = "INSERT INTO $this->table ";
        $first = true;
        foreach ($params as $key => $param){
            if($first === true){
                $insertQuery.= " SET  ".$key ." = ? ";
                $first = false;
            }else{
                $insertQuery.= ", ".$key ." = ? ";
            }
        }
        try{
             $this->execute($insertQuery, $params);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
       
    }
    
    public function delete($id = 0){
         return $this->execute("DELETE FROM $this->table WHERE id = ? " , array(
             array($id, PDO::PARAM_INT)
         ));
    }
    
}
