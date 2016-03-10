<?php
class Model_Resume extends Model implements Resume{

	protected $mysqli;
	

	public function __construct() {
			$this->mysqli = Model::getDB()->mysqli;	
	}

	function addResume( $resume_name, $resume_date, $resume_status, $resume_file_name, $resume_file ){
		$sql = "INSERT INTO `Resume` ( `resume_name`, `resume_date`, `resume_status`, `resume_file_name`, `resume_file` ) VALUES (  {?}, {?}, {?}, {?}, {?} )";
		$sql = $this->getQuery( $sql, array(  $resume_name, $resume_date, $resume_status, $resume_file_name, $resume_file) );
		$success = $this->mysqli->query( $sql );
		if ( !empty( $success ) )
			return true;

	}

	function returnResume(){
		$sql = "( SELECT  `resume_id`, `resume_name`, `resume_date`, `resume_status`, `resume_file_name`, `status_type` , cnt_review FROM `Resume` 
				LEFT JOIN  `Status_resume` ON ( Resume.resume_status = Status_resume.status_id )
				LEFT JOIN ( SELECT `review_resume_id`, count( `review_resume_id` ) as cnt_review FROM `Review_resume`  GROUP BY `review_resume_id` ) AS Review_resume_snt ON ( Review_resume_snt.review_resume_id = Resume.resume_id ) ORDER BY `resume_date` ) ORDER BY resume_id DESC";
		$result_set = $this->mysqli->query( $sql );

		if ( 0 == $result_set->num_rows ){
			return false;	
		} 
		return $this->resultSetToArray( $result_set ); 
	}


	function updateStatusResume( $resume_status, $resume_id ){
		$sql = "UPDATE `Resume` SET `resume_status` = {?} WHERE `resume_id` = {?}";
		$sql = $this->getQuery( $sql, array( $resume_status, $resume_id ) );
		$success = $this->mysqli->query( $sql );
		if ( !empty( $success ) )
			return true;

	}

	function returnResumeStatus(){
		$sql = "SELECT * FROM `Status_resume`";
		$result_set = $this->mysqli->query( $sql );
		if ( 0 == $result_set->num_rows ){
			return false;	
		} 
		return $this->resultSetToArray( $result_set ); 
	}



}