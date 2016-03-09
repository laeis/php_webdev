<?php
class Core {
	
	private $controllers = 'Controller_';
	private $models = 'Model_';
	private $themplate;
	private static $core;

	public function __construct() {
		spl_autoload_register( function ( $class_name ) {
			$class_name = strtolower( $class_name );
			if ( false !== strripos( $class_name, $this->controllers ) ) {
				if( file_exists( "app/controllers/" .$class_name . '.php' ) ){
					include_once "/../controllers/" . $class_name . '.php';
				} else {
					//$this->error_page404();
				}
			} else if( false !== strripos( $class_name, $this->models ) ) {
				if( file_exists( "app/models/" .$class_name . '.php' ) ){
					include_once "/../models/" . $class_name . '.php';
				} 
			} else{
    			include "/../interface/" . $class_name . '.php';
    		}
		} );
	}

	public function route(){

		$_controller_name = 'Main';
		$_action_name = 'index';

		$request = parse_url( $_SERVER['REQUEST_URI'] );
		$routes = explode('/', $request['path'] );

		if ( !empty( $routes[1] ) ) {
			if( 1 == preg_match( "/^\w\w{1,}\w$/i" , $routes[1] ) ){
				$_controller_name =  trim( $routes[1] );	
			} else{
				$this->error_page404();
			}

			$controller_name = $this->controllers . $_controller_name;
			$controller = new $controller_name;

			if ( empty($routes[2] ) ) {
				$action = 'action_'. $_action_name;
			}else {
				$action_name = strtolower( trim( $routes[2] ) );
				if( method_exists( $controller, 'action_'. $action_name ) ){
					$action = 'action_'. $action_name;
				} else {
					$this->error_page404();
				}
			}
			$controller->$action();
		} else {
			$controller_name = $this->controllers . $_controller_name;
			$action = 'action_'. $_action_name;
			$controller = new $controller_name;
			$controller->$action();
		}	
	}

	public static function error_page404(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location: /' );
    }

	public static function getInstance() {
		if ( self:: $core == null ) {
			self::$core = new Core();
		}
		return self::$core;
	}
}