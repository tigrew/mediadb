<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BagDb
 *
 * @author ginomazzola
 */
class BagDb extends DbBase {
    
    public function __construct(){
        parent::__construct('Bag');
    }
    
    
    public function removeAllBaglines($bagId = 0){
        $this->execute("DELETE FROM Bag_Line WHERE Bag_id = ? ", array(
                array($bagId , PDO::PARAM_INT)
            )
        );
    }
    
     public function removeBagLine($bagLineId = 0){
        $this->execute("DELETE FROM Bag_Line WHERE Album_id = ? ", array(
                array($bagLineId , PDO::PARAM_INT)
            )
        );
    }
    
    public function findAll($userId = 0){
        
        return $this->fetchAll(" SELECT * FROM $this->table "
            . " LEFT JOIN Bag_Line ON Bag_Line.Bag_id = Bag.id"
            . " LEFT JOIN User ON User.id = Bag.User_id "
            . " LEFT JOIN Album ON Album.id = Bag_Line.Album_id "
            . " LEFT JOIN Artist ON Artist.id = Album.Artist_id "
            . " WHERE User.id = ? " , array(
                
                array($userId, PDO::PARAM_INT)
            )
        );
    }
    
    public function addToBag($albumId = 0, $customerId = 0){
        
        $bag = $this->searchOneBy('User_id', array($customerId, PDO::PARAM_INT));
       
        $bagLineDb = new DbBase('Bag_Line');
        
        return $bagLineDb->insert(array(
            'Album_id'=>array($albumId, PDO::PARAM_INT),
            'Bag_id'=>array($bag['id'], PDO::PARAM_INT)
        ));    
                
    }
   
}
