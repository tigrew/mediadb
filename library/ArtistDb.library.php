<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArtistDb
 *
 * @author ginomazzola
 */
class ArtistDb extends DbBase {
    
    
    public function __construct($table = "") {
        parent::__construct('Artist');
    }
    
    
    
    
}
