<?php

abstract class Controller {
	
	public $view;
	
	function __construct() {
		$this->view = new View();

	}
	
	abstract function action_index();

	public function get_views( $get_themplate, $get_views = false, $data = false ) {
		/* function for oauth with fb*/	
		$this->view->generate( 'header.php' );
		$this->view->generate( $get_themplate,  $get_views, $data );
		$this->view->generate( 'footer.php' );

	}

}
