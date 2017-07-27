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
    
    public function findById($id){
        
        return $this->fetch("Select * From category Where id = ?", array(
            array($id, PDO::PARAM_INT))
        );
    }
    
}
