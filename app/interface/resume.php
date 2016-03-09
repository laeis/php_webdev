<?php
interface Resume{

	public function addResume( $resume_name, $resume_date, $resume_status, $resume_file_name, $resume_file );

	public function returnResume();

} 
