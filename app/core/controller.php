<?php

abstract class Controller {
	
	public $view;
	
	function __construct() {
		$this->view = new View();

	}
	
	abstract function action_index();

}
