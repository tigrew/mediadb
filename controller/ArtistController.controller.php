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
        
        $this->refresh();
    }
    
    function delete(){
            
       if(isset($this->request['id'])){
           $this->artistDb->delete($this->request['id']);
       }   
    
        $this->refresh();
    }
    
    
    private function refresh(){
        
        
         $this->data->artists = $this->artistDb->findWithLimitOrderBy(
                 isset($this->request['offset']) ? $this->request['offset']*25 : 0, 
                 isset ($this->request['limit']) ? ($this->request['limit']) : 25,
                 'nickname'
        );
         
         $this->data->numberpage = count($this->data->artists);
 
         $this->getView("artist_index");
        
    }
}
