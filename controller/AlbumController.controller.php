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
    public function index() {
        $this->data->albums = $this->albumDb->findAll();
        $this->getView("album_index");
    }

    public function add() {
        $this->getView("album_add");
    }
    /**
     * 
     */
    public function edit() {

        if (isset($this->request['submit'])) {

            $album = $this->request;
            $cover = FileManager::SaveFile("cover");
            if(Engine::HasUser()){
            
                if (($cover['file'] !== false) && ( !empty($album))) {
                    
                    $this->albumDb->insert(array(
                        
                        'title'       => array($album['title'], PDO::PARAM_STR),
                        'releasedate' => array($album['releasedate'], PDO::PARAM_STR),
                        'numbersong'  => array($album['numbersong'], PDO::PARAM_INT),
                        'stock'       => array($album['stock'], PDO::PARAM_INT),
                        'price'        => array($album['price'], PDO::PARAM_INT),
                        'cover'        => array($cover['file'], PDO::PARAM_STR),
                        'Artist_id'   => array(Engine::GetUser()['id'] , PDO::PARAM_STR)
                        
                    ));
                     $this->data->message = "New album added";
                } else {
                    $this->data->message = $cover['message'];
                }
            
            }
        }
        $this->getView("album_add");
    }

}
