<?php 
class Model_Review extends Model {

	protected $mysqli;
	
	public function __construct() {
			$this->mysqli = Model::getDB()->mysqli;	
	}

	function returnLastViews( $id ){
		$sql = "SELECT `review_id`, `review_date`, `review_author`, `review_text`, `review_resume_id`, `resume_name` FROM `Review_resume` LEFT JOIN `Resume` ON Resume.resume_id =  Review_resume.review_resume_id WHERE `review_id` = {?}";
		$sql = $this->getQuery( $sql, array( $id ) );
		$result_set = $this->mysqli->query( $sql );
		if ( 0 == $result_set->num_rows ){
			return false;	
		} 
		return $this->resultSetToArray( $result_set ); 
	}

	function returnAllViews( $id ){
		$sql = "SELECT `review_id`, `review_date`, `review_author`, `review_text`,  `review_resume_id`, `resume_name` FROM `Review_resume` LEFT JOIN `Resume` ON Resume.resume_id =  Review_resume.review_resume_id WHERE  `review_resume_id` = {?} ORDER BY `review_date` DESC";
		$sql = $this->getQuery( $sql, array( $id ) );
		$result_set = $this->mysqli->query( $sql );
		if ( 0 == $result_set->num_rows ){
			return false;	
		} 
		return $this->resultSetToArray( $result_set ); 
	}

	function returnViewsCnt(){
		$sql = "SELECT COUNT( `review_id` ) AS review_cnt FROM `Review_resume`";
		$result_set = $this->mysqli->query( $sql );
		if ( 0 == $result_set->num_rows ){
			return false;	
		} 
		return $this->resultSetToArray( $result_set ); 
	}

	function addViews( $review_text, $review_author, $review_resume_id ){
		$sql = "INSERT INTO `Review_resume` ( `review_text`, `review_author`, `review_resume_id` ) VALUES ( {?}, {?}, {?} )";
		$sql = $this->getQuery( $sql, array( $review_text, $review_author, $review_resume_id ) );
		$success = $this->mysqli->query( $sql );
		if ( !empty( $success ) )
			return $this->mysqli->insert_id;

	}
}