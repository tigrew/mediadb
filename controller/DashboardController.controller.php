<?php

/**
 * Description of UserController
 *
 * @author ginomazzola
 */
class DashboardController extends Controller{
    /**
     * 
     */
    public function index(){ 
        
       $this->data->bienvenue = "Bienvenue dans notre site";
       $this->data->image_url = "url";
       
       
       
       $this->getView('index');
    }
    
    public function formsubmission(){
        $this->data->request = $this->request;
        
        
        $this->getView('index');
    }
}
