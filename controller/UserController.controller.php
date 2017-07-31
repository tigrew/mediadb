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
    /**
     * 
     */
    public function login(){
        
        if(isset($this->request['email']) && isset($this->request['password'])){
           $user = $this->userDb->login(array(
               array($this->request['email'], PDO::PARAM_STR),
               array($this->request['password'], PDO::PARAM_STR),
           ));
           
           if(!empty($user)){
               Engine::SetUser($user);
               $this->route("Dashboard" , "index", new stdClass());
           }else{
               $this->data->message = "Wrong connection information";
               $this->getView('index');
           }
        }
        
    }
    /**
     * 
     */
    public function logout(){
        Engine::UnsetUser();
        $data = new stdClass();
        $data->message = "You are logged out";
        $this->route("Dashboard" , "index", $data);
        
    }
    /**
     * 
     */
    public function index(){ 
       $this->initView();
       $this->getView('user_index');
    }
    /**
     * 
     */
    public function add(){
       
       if(isset($this->request['email']) 
               && isset($this->request['password'])
               && isset($this->request['role'])){
           
           $insertCustomer =   array(
               "mail" => array($this->request['email'], PDO::PARAM_STR),
               "password" => array($this->request['password'], PDO::PARAM_STR),
               "Role_id" => array($this->request['role'], PDO::PARAM_INT)
           );
            
           // tester si c'est un artiste
           if(intval($this->request['role']) === UserDb::_Artist){
              // creation fiche artiste
                // creation d'un bag
                $artistedb = new ArtistDb();
                
                
                
                
                $id_artist = $artistedb->insert(array(
                    'nickname' => array($this->request['nickname'], PDO::PARAM_STR)
                ));
                $insertCustomer['Artist_id'] = array($id_artist, PDO::PARAM_INT) ; 
            }
       
           $id = $this->userDb->insert($insertCustomer);
           
           // tester si c'est un client
           if(intval($this->request['role']) === UserDb::_Customer){
               // creation d'un bag
               $insertBag = array(
                   'User_id' => array($id, PDO::PARAM_INT)
               );
               
               $bag = new BagDb();
               $bag->insert($insertBag);
           }
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
    /**
     * 
     */
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
    /**
     * 
     */
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
    /**
     * 
     */
    private function initView(){
        $this->data->users = $this->userDb->findAll();
        $this->data->roles = $this->roleDb->findAll();
    }
}
