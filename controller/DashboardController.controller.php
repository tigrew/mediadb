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
       
       $this->data->albums = $this->albumDb->findAll();
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
