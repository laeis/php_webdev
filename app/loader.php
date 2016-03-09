<?php
require_once "/../config.php";

if( DEBUG == true ){
	ini_set('display_errors', 'on'); 
}else {
	ini_set('display_errors', 'off'); 
}
error_reporting( E_ALL ); 

session_start();

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/core.php';

$core = Core::getInstance(); 