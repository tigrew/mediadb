<?php

/**
 * Description of UserController
 *
 * @author ginomazzola
 */
class UserController extends Controller{
    
    private $userDb;
    private $roleDb;
    
    
    public function __construct() {
        parent::__construct();
        $this->userDb = new UserDb();
        $this->roleDb = new RoleDb();
    }
    
    public function login(){
        
        if(isset($this->request['email']) && isset($this->request['password'])){
           $user = $this->userDb->login(array(
               array($this->request['email'], PDO::PARAM_STR),
               array($this->request['password'], PDO::PARAM_STR),
           ));
           
           if(!empty($user)){
               $_SESSION['user'] = $user;
               $this->getView('index');
           }else{
               $this->data->message = "Wrong connection information";
               $this->getView('index');
           }
        }
        
    }
    
    public function logout(){
        unset($_SESSION['user']);
        $data = new stdClass();
        $data->message = "You are logged out";
        $this->route("Dashboard" , "index", $data);
        
    }

    public function index(){ 
       $this->initView();
       $this->getView('user_index');
    }
    
    
    
    public function add(){ 
       
       if(isset($this->request['email']) 
               && isset($this->request['password'])
               && isset($this->request['role'])){
           $this->userDb->insert(array(
               "mail" => array($this->request['email'], PDO::PARAM_STR),
               "password" => array($this->request['password'], PDO::PARAM_STR),
               "Role_id" => array($this->request['role'], PDO::PARAM_INT)
           ));
       }else{
           $this->data->message = "Wrong or empty informations";
       }
       $this->initView();
       $this->getView('user_index');
    }
     public function delete(){ 
       if(isset($this->request['id'])){
           $this->userDb->delete($this->request['id']);
       }
       $this->initView();
       $this->getView('user_index');
    }
    
    
     public function edit(){ 
       
       if(isset($this->request['id']) && isset($this->request['email']) && isset($this->request['role'])){
           $this->userDb->update($this->request['id'], array(
               "mail" => array($this->request['email'], PDO::PARAM_STR),
               "Role_id" => array($this->request['role'], PDO::PARAM_INT)
           ));
           $this->data->user = $this->userDb->findById($this->request['id']);
           $this->data->message = "User Edited With Success";
           $this->initView(); 
           $this->getView('user_block');
       }elseif(isset($this->request['id'])){
          $this->data->user = $this->userDb->findById($this->request['id']);
          $this->initView(); 
          $this->getView('user_block');
       }else{
          $this->data->message('Unknow user');
          $this->initView(); 
          $this->getView('user_index');
       }
       
       
    }
    
    public function search(){
        
        if(isset($this->request['email'])){
           $key = "mail";
           $value = "%".$this->request['email']."%";
           $type = PDO::PARAM_STR;
        }
        
        if(isset($this->request['role'])){
            $key = "Role_id";
            $value = $this->request['role'];
            $type = PDO::PARAM_INT;
        }
        
        $this->data->users = $this->userDb->searchBy($key, array($value, $type));
        $this->data->roles = $this->roleDb->findAll();
        
        $this->getView("user_index");
        
    }
    
    private function initView(){
        $this->data->users = $this->userDb->findAll();
        $this->data->roles = $this->roleDb->findAll();
    }
}
