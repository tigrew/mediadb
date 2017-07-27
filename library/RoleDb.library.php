<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoleDb
 *
 * @author ginomazzola
 */
class RoleDb extends DbBase {
     public function findAll(){
        return $this->fetchAll("SELECT * FROM Role");
    }   
}
