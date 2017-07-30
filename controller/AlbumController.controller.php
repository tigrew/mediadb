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
    private $categoriesDb;
    private $songDb;

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
        
        $this->albumDb = new AlbumDb();
        $this->categoriesDb = new CategoryDb();
        $this->songDb = new SongDb();
        
    }

    /**
     * 
     */
    public function index() {
        $this->data->albums = $this->albumDb->findAll();
        // proper_debug($this->data->albums);
        $this->getView("album_index");
    }

    public function add() {
        $this->getView("album_add");
    }
    /**
     * 
     */
    public function edit() {
        
        
        $this->data->categories = $this->categoriesDb->findAll();
        $this->data->songs = $this->songDb->findAllByAlbumId($this->request['id']);
        $album = $this->albumDb->findById($this->request['id']);
        $this->data->selectedCategories = $this->categoriesDb->findByAlbumId($this->request['id']);

        
        
        if (isset($this->request['submit']) ) {
            
            $cover = FileManager::SaveFile("cover");

            if(isset($this->request['id']) && $this->request['id'] !== null){
                
                
                if($cover['file'] === false ){
                    $cover['file'] = $album['cover'];
                }
                $this->albumDb->save($this->request, $cover, $this->request['id']);
                
                $this->data->message = 'Album Edited With Success';
                $this->data->album = $this->request;
                $this->data->album['cover'] = $cover['file'];
                $this->data->selectedCategories = $this->categoriesDb->findByAlbumId($this->request['id']);
                
            }else{
                if($cover['file'] === false ){
                    $this->data->message = $cover['message'];
                    $this->data->album = $this->request;
                }else{
                    // INSERT
                    $this->request['id'] = $this->albumDb->save($this->request, $cover);
                    
                    $this->data->message = 'Album Created With Success';
                    $this->redirect(array(
                        'controller' => 'Album',
                        'action' => 'edit',
                        'params' => array(
                            'id' => $this->request['id']
                        )
                    ));
                }
            }
        }else{
            
            $this->data->album = $album;
            
            
        }  
        $this->getView("album_add");
    }
    
    public function addSong(){
        if(isset($this->request['id'])){
          
            if(isset($this->request['Add'])){
                
                $this->songDb->insert(array(
                    'title' => array($this->request['title'], PDO::PARAM_STR),
                    'duration' => array($this->request['duration'], PDO::PARAM_INT),
                    'Album_id' => array($this->request['id'], PDO::PARAM_INT)
                ));
            }   
        }
        $this->route("Album" , "edit", new stdClass(), $this->request);
    }
    public function view(){
         if(isset($this->request['id'])){
                $this->data->album = $this->albumDb->findById($this->request['id']);
                $this->data->categories = $this->categoriesDb->findAll();
                $this->data->songs = $this->songDb->findAllByAlbumId($this->request['id']);
                $album = $this->albumDb->findById($this->request['id']);
                $this->data->selectedCategories = $this->categoriesDb->findByAlbumId($this->request['id']);
                $this->getView('album_block');
         }
    }
    
    
    
}
