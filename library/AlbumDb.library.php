<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlbumDb
 *
 * @author ginomazzola
 */
class AlbumDb extends DbBase {
    public function __construct() {
        parent::__construct('Album');
    }
    public function findAll() {
         return $this->fetchAll(" SELECT * FROM $this->table "
            . " LEFT JOIN Artist ON Artist.id = Album.Artist_id ", array(
               
            )
        );
    }
    
    
}
