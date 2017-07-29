<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SongDb
 *
 * @author ginomazzola
 */
class SongDb extends DbBase {
    public function __construct() {
        parent::__construct("song");
    }
    public function findAllByAlbumId($albumId = 0){
        return $this->fetchAll("SELECT * FROM song WHERE Album_id = ? ", array(
            array($albumId, PDO::PARAM_INT)
        ));
    }
}
