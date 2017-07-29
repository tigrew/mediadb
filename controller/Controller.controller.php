<?php
/**
 * 
 */
abstract class Controller {
    /**
     * @var type 
     */
    protected $name;

    /**
     *
     * @var type 
     */
    protected $request = array();

    /**
     *
     * @var type 
     */
    protected $data;
    /**
     * 
     */
    public function __construct() {
        $this->request = $_REQUEST;
        //array_walk($this->request, 'self::sanitizeRequest');
        $this->data = new stdClass();
    }

    protected function sanitizeRequest(&$item1, $key) {
        $item1 = filter_var($item1, FILTER_SANITIZE_STRING);
    }
    /**
     * @param string $name
     */
    protected function getView($name = "") {
        
        $request = $this->request;
        $data = $this->data;
        $content = Config::getInstance()->get('view_dir') . "/_" . $name . '.php';
        
        $templatePath = Config::getInstance()->get('view_dir') . '/index.php';
        
        if (file_exists($templatePath)){
            include($templatePath);
        }
        
    }
    /**
     * @param type $data
     */
    public function setData($data = null){
        if($data === null){
            $data = new stdClass();
        }
        $this->data = $data;
    }
    
    /**
     * @param type $data
     */
    public function setRequest($request = null){
        $this->request = array_merge($this->request, $request);
    }
    
    
    /**
     * @param type $controler
     * @param type $action
     * @param type $data
     */
    protected function route($controler = "", $action = "", stdClass $data , $request = array() ){
        Engine::Route($controler, $action, $data, $request );
    }
}
