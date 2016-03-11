<?php

class Controller_404 extends Controller {
	
	function action_index() {
		$this->get_views( 'page_404.php' );
	}

}
