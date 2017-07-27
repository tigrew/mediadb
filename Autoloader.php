<?php 

// change this, if this code isn't "higher" than ALL classfiles

/**
* autoload classes (no need to include them one by one)
*
* @uses classFolder()
* @param $className string
*/
class Autoloader
{
    public static function register()
    {
        
        spl_autoload_register(function ($class) {
            
            $fileLibrary =  __DIR__.'/'.Config::getInstance()->get('library_dir').'/'.$class.'.library.php';
            $fileController =  __DIR__.'/'.Config::getInstance()->get('controller_dir').'/'.$class.'.controller.php';
            $fileModel =  __DIR__.'/'.Config::getInstance()->get('model_dir').'/'.$class.'.model.php';
            
            if (file_exists($fileLibrary)) {
                require $fileLibrary;
                return true;
            }elseif(file_exists($fileController)){
                require $fileController;
            }elseif(file_exists($fileModel)){
                require $fileModel;
                return true;
            }else{
                return false;
            }
            
        });
    }
}
Autoloader::register();

?>