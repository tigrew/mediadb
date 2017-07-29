<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryDb
 *
 * @author ginomazzola
 */
class CategoryDb extends DbBase {
    //put your code here
    
    public function __construct() {
        parent::__construct('category');
    }
    public function findByAlbumId($albumId = 0){
        $albumCategories = new DbBase('Album_has_Category');
        return $albumCategories->searchBy('Album_id', array($albumId, PDO::PARAM_INT));
    }
    public function batchSave($albumId = 0 , $categories){
        
        $this->execute("DELETE FROM Album_has_Category WHERE Album_id = ? ", array(
            array($albumId, PDO::PARAM_INT)
        ));
        
        $queryInsert = " INSERT INTO Album_has_Category (Album_id, Category_id ) values ";
        $params = array();
        
        
        if(count($categories)>1){
            $i = 0;
            foreach($categories as $c){
                if($i === (count($categories)-1)){
                    $queryInsert.= "( ? , ?)";
                }else{
                    $queryInsert.= "( ? , ?),";
                }
                
                $params[] = array($albumId, PDO::PARAM_INT);
                $params[] = array($c, PDO::PARAM_INT);
                
                $i ++;
            }
        }else{
            $queryInsert.= "( ? , ?)";
            $params[] = array($albumId, PDO::PARAM_INT);
            $params[] = array($c, PDO::PARAM_INT);
        }
        $this->execute($queryInsert , $params);
    }
    
}
