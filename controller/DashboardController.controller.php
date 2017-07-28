<?php

/**
 * Description of UserController
 *
 * @author ginomazzola
 */
class DashboardController extends Controller{
    /**
     * @var type 
     */
    private $albumDb;
    /**
     * 
     */
    public function __construct(){
        parent::__construct();
        $this->albumDb = new AlbumDb();
    }
    /**
     * 
     */
    public function index(){ 
        
        $list = $this->albumDb->findAll();
        if(!empty($list) && !is_null($list)){
            
            $this->data->albums = $list;
            
        }else{
            $this->data->albums = array();
        }
       $this->getView('index');
    }
    /**
     * 
     */
    public function formsubmission(){
        $this->data->request = $this->request;
        $this->getView('index');
    }
}
