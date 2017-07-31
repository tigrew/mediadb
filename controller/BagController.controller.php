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
class BagController extends Controller {

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
    private $emptyMessage;

    /**
     * 
     */
    public function __construct() {
        parent::__construct();

        $this->bagDb = new BagDb();
        // récupération de l'utilisateur courant de l'application.
        $this->user = Engine::GetUser();
        $this->emptyMessage = "Empty Basket";
    }

    /**
     * 
     */
    public function index() {
        $this->data->BagLines = $this->bagDb->findAll($this->user['id']);
        $this->data->bag = $this->bagDb->searchOneBy('User_id', array($this->user['id'], PDO::PARAM_INT)
        );
        $this->data->emptyResultMessage = $this->emptyMessage;
        $this->getView('bag_index');
    }

    /**
     * 
     */
    public function process() {
        $this->data->bag = $this->bagDb->searchOneBy('User_id', array($this->user['id'], PDO::PARAM_INT)
        );
        $this->bagDb->removeAllBaglines($this->request['id']);
        $this->data->emptyResultMessage = $this->emptyMessage;
        $this->data->message = "Payement is processed ... Thank u.";
        $this->getView('bag_processed');
    }

    /**
     * 
     */
    public function remove() {
        $this->data->bag = $this->bagDb->searchOneBy('User_id', array($this->user['id'], PDO::PARAM_INT)
        );
        $this->bagDb->removeBagLine($this->request['id']);
        $this->data->emptyResultMessage = $this->emptyMessage;
        $this->redirect(array("controller" => "Bag" , "action" => "index"));
    }

    public function addBasket() {
        if (isset($this->request['id'])) {
            if (Engine::HasUser()) {
                $user = Engine::GetUser();
                
                $this->bagDb->addToBag($this->request['id'], $user['id']);
                $this->data->BagLines = $this->bagDb->findAll($user['id']);
                
                $this->data->BagLines = $this->bagDb->findAll($this->user['id']);
                $this->data->bag = $this->bagDb->searchOneBy('User_id', array($this->user['id'], PDO::PARAM_INT)
                );
                
                $this->redirect(array("controller" => "Bag" , "action" => "index"));
            }
        }
    }

}
