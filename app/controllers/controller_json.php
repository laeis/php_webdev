<?php 

class Controller_Json extends Controller {

	private $model_resume;
	private $model_review;

	function __construct() {
		parent::__construct();
		$this->model_resume = new Model_Resume();
		$this->model_review = new Model_Review();
	}

	function action_index() {
		$data = array(); 
		$data['all_resume'] = $this->model_resume->returnResume();
		if( !empty( $data ) ) {
			echo  json_encode( $data );
		}
	}

}
