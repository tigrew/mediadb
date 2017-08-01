<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Award
 *
 * @author ginomazzola
 */
class AwardDb extends DbBase {
    
    
     public function __construct($table = "") {
        parent::__construct('Award');
    }
    
    
    public function getArtistAwards($idArtist){
        
       return $this->fetchAll("SELECT id,Artist_id,dateDelivery,place,name FROM Artist_has_Award LEFT JOIN Award ON Award_id = Award.id WHERE Artist_id = ?", array(array($idArtist, PDO::PARAM_INT)));
        
        
    }
    
    public function getAwardsNotWonForArtist($idArtist){
        
        return $this->fetchAll("SELECT id,name FROM Award WHERE id NOT IN (
        SELECT id
        FROM Artist_has_Award 
        LEFT JOIN Award 
        ON Award_id = Award.id 
        WHERE Artist_id = ?
        )",array(array($idArtist, PDO::PARAM_INT))); 
        
    }
    
}
