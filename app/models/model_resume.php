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

	/*	Select COUNT() as `review_count` FROM `Review_resume`, `Resume` WHERE Review_resume.review_resume_id = Resume.resume_id */

	/*SELECT `resume_id`, `resume_name`, `resume_date`, `resume_status`, `resume_file_name`, `status_type`, ( Select COUNT(*) FROM `Review_resume`, `Resume` WHERE Review_resume.review_resume_id = Resume.resume_id )as `review_count` FROM `Resume`, `Status_resume` WHERE Resume.resume_status = Status_resume.status_id */

		$sql = "SELECT `resume_id`, `resume_name`, `resume_date`, `resume_status`, `resume_file_name`, `status_type` FROM `Resume` LEFT JOIN `Status_resume` ON Resume.resume_status = Status_resume.status_id ";
		$result_set = $this->mysqli->query( $sql );

		if ( 0 == $result_set->num_rows ){
			return false;	
		} 
		return $this->resultSetToArray( $result_set ); 
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