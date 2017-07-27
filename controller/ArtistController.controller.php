<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArtistController
 *
 * @author ginomazzola
 */
class ArtistController extends Controller{
    
    private  $artistDb;
    
    
    public function __construct() {
        parent::__construct();
        $this->artistDb = new ArtistDb();
    }
    
    
    function show(){
         $this->data->artists = $this->artistDb->findAll();
         $this->getView("artist_index");
    }
    //put your code here
}
