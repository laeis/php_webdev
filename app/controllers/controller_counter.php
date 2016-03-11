<?php


class Controller_Counter extends Controller {

	private $model_resume;
	private $model_review;

	function __construct() {
		parent::__construct();
		$this->model_resume = new Model_Resume();
		$this->model_review = new Model_Review();
	}

	function action_index() {
		$data = array(); 
		if( isset( $_POST['action'] ) && 'get-cnt' == ( $_POST['action'] ) ){
			$data = $this->model_review->returnViewsCnt();
			if( !empty( $data['0'] ) ) {
				echo  json_encode( $data['0'] );
			}
		}

	}

}