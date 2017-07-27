<?php 


Class Engine {
    
    public static function Credential($controller, $action, $role) {
        $credentials = Config::getInstance()->get('credentials');
        $RouteAuthorized = false;
        foreach ($credentials as $c) {
            if ($c['Controller'] === $controller && $c['Action'] === $action) {
                if (strpos($c['UserType'], $role) !== false) {
                    $RouteAuthorized = true;
                }
            }
        }
        return $RouteAuthorized;
    }
    public static function Route($controller = "", $action = "", $data = array()) {

        if (isset($controller) && isset($action)) {
            
            if (isset($_SESSION['user'])) {
                $role = UserDb::$roles[$_SESSION['user']['Role_id']];
            } else {
                $role = "User";
            }

            if (self::Credential($controller, $action, $role)) {
                $controlerClass = $controller . "Controller";
                $controler = new $controlerClass();
                $controler->setData($data);
                $controler->$action();
            } else {
                $controlerClass = "DashboardController";
                $action = "index";
                $controler = new $controlerClass();
                $data = new stdClass();
                $data->message = "This operation is not permitted ... Please Contact an Administrator";
                $controler->setData($data);
                $controler->$action();
            }
        }
    }
    public static function GetUser(){
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        return null;
        
    }
    public static function SetUser($user){
        $_SESSION['user'] = $user;
    }
}