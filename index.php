<?php

session_start();
include 'library/config.library.php';
include 'Autoloader.php';

Engine::Route($_GET['controller'], $_GET['action'], new stdClass());


