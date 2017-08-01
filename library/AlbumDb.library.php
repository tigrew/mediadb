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
    private $songDb;
    public function __construct() {
        parent::__construct('Album');
        $this->categoryDb = new CategoryDb();
        $this->songDb = new SongDb();
    }
    public function findAll() {
         return $this->fetchAll(" SELECT * FROM $this->table ");
    }
     public function save($album , $cover , $id = 0){
          if($id === 0){
              return $this->insertAlbum($album, $cover);
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
            'Artist_id' => array(Engine::GetUser()['Artist_id'], PDO::PARAM_STR)
        ));
        $this->categoryDb->batchSave($id, $album['categories']);
       
      
        
    }
    private function insertAlbum($album , $cover){
         $id = $this->insert(array(
            'title' => array($album['title'], PDO::PARAM_STR),
            'releasedate' => array($album['releasedate'], PDO::PARAM_STR),
            'numbersong' => array($album['numbersong'], PDO::PARAM_INT),
            'stock' => array($album['stock'], PDO::PARAM_INT),
            'price' => array($album['price'], PDO::PARAM_INT),
            'cover' => array($cover['file'], PDO::PARAM_STR),
            'Artist_id' => array(Engine::GetUser()['Artist_id'], PDO::PARAM_STR)
        ));
        
        return $id;
    }
    public function isArtistAlbum($albumId){
        
        $album = $this->fetch("SELECT * FROM Album WHERE Artist_id = ? AND id = ? ", array(
            array(Engine::GetUser()['Artist_id'], PDO::PARAM_INT),
            array($albumId, PDO::PARAM_INT)
        ));
        return is_array($album);
    }
    
    public function remove($idAlbum){
        // supprimer les catégories l'album
        $this->categoryDb->batchDelete($idAlbum);
        // supprimer les sons de l'album
        $this->songDb->batchDelete($idAlbum);
        // supprimer l'album
        $this->delete($idAlbum);
    }
    
    public function globalSearch($info = ""){
        $query = "
            
            SELECT Distinct Album.*, Artist.nickname as Artist FROM Album

            LEFT JOIN Artist ON Artist.id = Album.Artist_id
            LEFT JOIN Album_has_Category ON Album_has_Category.`Album_id` = Album.id
            LEFT JOIN Category ON Category.id = Album_has_Category.`Category_id`
            LEFT JOIN Song ON Song.`Album_id` = Album.id

            WHERE CONCAT(Artist.nickname, Category.name, song.title, Album.title ) like ?

         ";
        
        
        $info = '%'.$info.'%';
    
        return $this->fetchAll($query, array( 
            array($info, PDO::PARAM_STR),
   
            
        ));
    }
    
    
}
