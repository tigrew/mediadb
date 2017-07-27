<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BagController
 *
 * @author ginomazzola
 */
class BagController extends Controller{
    /**
     * @var type 
     */
    private $bagDb;
    /**
     * @var type 
     */
    private $user;
    /**
     * 
     */
    public function __construct(){
        
        parent::__construct();
        
        $this->bagDb = new BagDb();
        // récupération de l'utilisateur courant de l'application.
        $this->user = Engine::GetUser();
        $this->data->emptyResultMessage = "You have't album into your basket";
    }
    /**
     * 
     */
    public function index(){
        
        $this->data->BagLines = $this->bagDb->findAll($this->user['id']);
        
        
        $this->data->bag = $this->bagDb->searchOneBy('User_id', 
            array($this->user['id'], PDO::PARAM_INT));
        
       
        
        $this->getView('bag_index');
    }
    /**
     * 
     */
    public function process(){
        
        $this->data->bag = $this->bagDb->searchOneBy('User_id',
            array($this->user['id'], PDO::PARAM_INT)
        );
        
        
        $this->bagDb->removeAllBaglines($this->request['id']); 
        
        $this->getView('bag_index');
        
    }
     public function remove(){
      
        $this->data->bag = $this->bagDb->searchOneBy('User_id',
            array($this->user['id'], PDO::PARAM_INT)
        );
        
        $this->bagDb->removeBagLine($this->request['id']);
        
        $this->getView('bag_index');
        
    }
}
