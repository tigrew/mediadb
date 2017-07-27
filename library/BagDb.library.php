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
    
    public function findAll($userId = 0){
        return $this->fetchAll(" SELECT * FROM Bag "
            . " LEFT JOIN Bag_Line ON Bag_Line.Bag_id = Bag.id"
            . " LEFT JOIN User ON User.id = Bag.User_id "
            . " WHERE User.id = ? " , array(
                $userId, PDO::PARAM_INT
        ));
    }
   
}
