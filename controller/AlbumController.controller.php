<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlbumController
 *
 * @author ginomazzola
 */
class AlbumController extends Controller {
    
    private $albumDb;
    /**
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->albumDb = new AlbumDb();
        
    }
    /**
     * 
     */
    public function index(){
        $this->data->albums = $this->albumDb->findAll();
        $this->getView("album_index");
    }
    
    
    
}
