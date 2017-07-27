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
        $this->request = $this->sanitizeRequest(array_merge($_GET, $_POST));
        $this->data = new stdClass();
    }

    private function sanitizeRequest($request) {
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($request));
        $result = array();
        foreach ($iterator as $key => $value) {
            $result[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        return $result;
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
        $this->data = $data;
    }
    /**
     * @param type $controler
     * @param type $action
     * @param type $data
     */
    protected function route($controler = "", $action = "", $data = null){
        Engine::Route($controler, $action, $data);
    }
}
