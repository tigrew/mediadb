<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ArtistDetailController extends Controller {
    
 private  $artistDb;
 private  $awardDb;
    
    
    public function __construct() {
        parent::__construct();
        $this->artistDb = new ArtistDb();
        $this->awardDb = new AwardDb();
        $this->artistHasAwardDb = new ArtistHasAwardDb();
    }
    
    
     function biography(){
        
      
       $this->data->artist =  $this->getArtist();
       $this->data->awards = $this->getAwards();
       $this->getView("artist_detail");
    }
    
    function edit(){
        
        $this->data->artist =  $this->getArtist();
        $this->data->awards = $this->getAwards();
        $this->data->awardsNotWon = $this->awardDb->getAwardsNotWonForArtist($this->request['id']);
        $this->getView("artist_detail_edit");
    }
    
    function update(){
        
      
        
        
        if (isset($this->request['submit']) ) {
            
          
                
            $picture = FileManager::SaveImage("fileToUpload",225,225);
            
            foreach ($this->request as $key => $value) {
                
                if(!isset($this->request[$key])){
                    
                    $this->data->message = "Artist profile has not been edited";
                    return $this->getView("artist_detail_edit");
                }
                
            }
            
            $this->data->artist = $this->getArtist();
            
            if(!Engine::isLoggedUserWithId($this->data->artist['User_id'])){
            
             throw new ErrorException("Artist User is trying Url Hacking .");
            
             }
             
             if($picture['file'] != $this->data->artist['picture']){
                 
                 FileManager::DeleteImage($this->data->artist['picture']);
                 
             }
            
                
                    
               $this->artistDb->update($this->request['id'], array(
               "name" => array($this->request['name'], PDO::PARAM_STR),
               "surname" => array($this->request['surname'], PDO::PARAM_STR),
               "nickname" => array($this->request['nickname'], PDO::PARAM_STR),
               "birthdate" => array($this->request['birthdate'], PDO::PARAM_STR),
               "birthplace" => array($this->request['birthplace'], PDO::PARAM_STR),
               "biography" => array($this->request['biography'], PDO::PARAM_STR),
               "picture" => array($picture['file'], PDO::PARAM_STR),
               "website" => array($this->request['website'], PDO::PARAM_STR),
           ));
         
                    
                
            
            
           $this->data->artist = $this->getArtist();
           $this->data->awards = $this->getAwards();
           $this->data->message = "Artist profile has been edited";
           $this->getView('artist_detail');
            
        }
        
    }
    
    
    function addaward(){
        
         if(isset($this->request['id'])){
             
             $json = file_get_contents('php://input');
             $data = json_decode($json,true);
            
             try{
               $this->artistHasAwardDb->insert(array(
                   
               "Artist_id" => array($this->request['id'], PDO::PARAM_INT),
               "Award_id" => array($data['award_id'], PDO::PARAM_INT),  
               "place" => array($data['place'], PDO::PARAM_STR),
               "dateDelivery" => array($data['dateDelivery'], PDO::PARAM_STR)));
            
             }
             catch(Exception $ex){
                 
                  var_dump($ex);
             }
         
            
         }
         
       
        
    }
    
    private function getArtist(){
        
          if(isset($this->request['id'])){
           
           return  $this->data->artist =  $this->artistDb->findById($this->request['id']);
          } 
          return null;
    }
    
    private function getAwards(){
        
          if(isset($this->request['id'])){
           
           return  $this->awardDb->getArtistAwards($this->request['id']);
          } 
          return null;
        
        
    }
    
}