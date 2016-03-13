<?php


class Controller_Counter  extends Controller {

	private $model_resume;
	private $model_review;

	function __construct() {
		parent::__construct();
		$this->model_resume = new Model_Resume();
		$this->model_review = new Model_Review();
	}

	function action_index() {
		$views_cnt =  $this->model_review->returnViewsCnt();
		echo json_encode( $views_cnt[0] );
	}

	function countViews() {

	}

	function action_update_count() {
		echo json_encode( $this->model_review->returnViewEachCnt() );
	}
	
}