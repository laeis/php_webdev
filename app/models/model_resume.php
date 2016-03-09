<?php
class Model_Resume extends Model implements Resume{

	protected $mysqli;
	private $sym_query = "{?}";

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
		$sql = "SELECT  `resume_id`, `resume_name`, `resume_date`, `resume_status`, `resume_file_name`, `status_type` FROM `Resume`, `Status_resume` WHERE Resume.resume_status = Status_resume.status_id";
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

	private function getQuery($query, $params) {
		if ( !empty( $params ) ) {
			for ( $i = 0; $i < count($params); $i++ ) {
				$pos = strpos( $query, $this->sym_query );
				$arg = "'".$this->mysqli->real_escape_string( $params[$i] )."'";
				$query = substr_replace( $query, $arg, $pos, strlen( $this->sym_query ) );
			}
		}
		return $query;
	}
	/* Преобразование result_set в двумерный массив */
	private function resultSetToArray( $result_set ) {
		$array = array();
		while ( ($row = $result_set->fetch_assoc() ) != false) {
		  $array[] = $row;
		}
		return $array;
	}

}