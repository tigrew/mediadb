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
    private $bagDb;
    private $user;
    
    public function __construct(){
        $this->bagDb = new BagDb();
        // récupération de l'utilisateur courant de l'application.
        $this->user = Engine::GetUser();
    }
    
    public function index(){
        
    }
    
    public function process(){
        
    }
}
