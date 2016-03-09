<?php 
class Model_Review extends Model {

	protected $mysqli;
	
	public function __construct() {
			$this->mysqli = Model::getDB()->mysqli;	
	}


}