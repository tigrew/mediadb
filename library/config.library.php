<?php
 
class Config {
 
  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;
   private $config = array();
 
   /**
    * Constructeur de la classe
    *
    * @param void
    * @return void
    */
   private function __construct() {  
       
      $preconfig =  __DIR__.'/../config/init.json';
      
       
   
       $contents = file_get_contents($preconfig); 
    
       $preconfig = json_decode($contents, true);
       
      
       $this->config = $preconfig;
       $this->set('current_app', $preconfig['current_app']);
   }
 
   /**
    * Méthode qui crée l'unique instance de la classe
    * si elle n'existe pas encore puis la retourne.
    *
    * @param void
    * @return Singleton
    */
   public static function getInstance() {
 
     if(is_null(self::$_instance)) {
       self::$_instance = new Config();  
     }
 
     return self::$_instance;
   }
   
   public function get($key = ""){
       
       if(is_null($this->config[$key]) || empty($this->config[$key])){
           
           throw new ErrorException("the key has not been set properly in init.json");
           
       }
      return $this->config[$key];
   }
   
   public function set($key = "", $value = ""){
       $this->config[$key] = $value;
   }
   
}
 
?>