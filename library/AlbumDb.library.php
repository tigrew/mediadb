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
    
    private $categoryDb;
    public function __construct() {
        parent::__construct('Album');
        $this->categoryDb = new CategoryDb();
    }
    public function findAll() {
         return $this->fetchAll(" SELECT * FROM $this->table "
            . " LEFT JOIN Artist ON Artist.id = Album.Artist_id ", array(
               
            )
        );
    }
     public function save($album , $cover , $id = 0){
          if($id === 0){
              $this->insertAlbum($album, $cover);
          }else{
              $this->updateAlbum($album, $cover, $id);
          }
         
    }
    private function updateAlbum($album , $cover , $id = 0){
        $this->update($id , array(
            'title' => array($album['title'], PDO::PARAM_STR),
            'releasedate' => array($album['releasedate'], PDO::PARAM_STR),
            'numbersong' => array($album['numbersong'], PDO::PARAM_INT),
            'stock' => array($album['stock'], PDO::PARAM_INT),
            'price' => array($album['price'], PDO::PARAM_INT),
            'cover' => array($cover['file'], PDO::PARAM_STR),
            'Artist_id' => array(Engine::GetUser()['id'], PDO::PARAM_STR)
        ));
        $this->categoryDb->batchSave($id, $album['categories']);
       
      
        
    }
    private function insertAlbum($album , $cover, $categories){
        
         $id = $this->insert(array(
             
            'title' => array($album['title'], PDO::PARAM_STR),
            'releasedate' => array($album['releasedate'], PDO::PARAM_STR),
            'numbersong' => array($album['numbersong'], PDO::PARAM_INT),
            'stock' => array($album['stock'], PDO::PARAM_INT),
            'price' => array($album['price'], PDO::PARAM_INT),
            'cover' => array($cover['file'], PDO::PARAM_STR),
            'Artist_id' => array(Engine::GetUser()['id'], PDO::PARAM_STR)
             
        ));
        $this->categoryDb->batchSave($id , $album['categories']);
         
    }
    
    
}
