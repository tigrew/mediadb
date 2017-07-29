<?php

session_start();
include 'library/config.library.php';
include 'Autoloader.php';

function proper_debug($resource){
    var_dump($resource);
    echo "<pre>".print_r($resource , true)."</pre>";
}


Engine::Route($_GET['controller'], $_GET['action'], new stdClass());


