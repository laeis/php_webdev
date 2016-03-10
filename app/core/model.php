<?php

class Model {

	private static $db = null;
	
	protected $mysqli = null;

	protected $sym_query = "{?}";

	private function __construct() {
		$this->mysqli =  new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
		/* check conection */
		if ( $this->mysqli->connect_errno ) {
			if( DEBUG == true ) {
			    printf( "Не удалось подключиться: %s\n", $this->mysqli->connect_error );
			}
			exit();
		}else{ 
			if ( !$this->mysqli->set_charset( "utf8" ) ) {
				if( DEBUG == true )
			    	printf( "Ошибка при загрузке набора символов utf8: %s\n",$this->mysqli->error );
			} else {
				if( DEBUG == true )
			    	printf( "Текущий набор символов: %s\n", $this->mysqli->character_set_name() );
			}
		}
				/* ctreate table for project if not exists */
		if( ! $this->mysqli->query(  "SHOW TABLE STATUS LIKE `Status_resume`" ) ){
			$sql = "CREATE TABLE IF NOT EXISTS `Status_resume` (
						`status_id` TINYINT NOT NULL ,
						`status_type` varchar( 15 ) NOT NULL,
						PRIMARY KEY  ( `status_id` )
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			$this->mysqli->query( $sql );
			$sql = "INSERT INTO `Status_resume` ( `status_id`,  `status_type` ) VALUES ( '1', 'ожидает' ), ( '2', 'отклонено' ), ( '3', 'принято' )";
			$this->mysqli->query( $sql );
		}

		if(  ! $this->mysqli->query( "SHOW TABLE STATUS LIKE `Resume`" )  ){
			$sql = "CREATE TABLE IF NOT EXISTS `Resume` (
						`resume_id` mediumint(11) NOT NULL AUTO_INCREMENT,
						`resume_name` varchar(150) NOT NULL,
						`resume_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
						`resume_status` TINYINT NOT NULL,
						`resume_file_name` varchar(150) NOT NULL,
						`resume_file` BLOB NOT NULL,
						PRIMARY KEY  ( `resume_id` ),
						FOREIGN KEY ( `resume_status` ) REFERENCES Status_resume( `status_id` )
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			$this->mysqli->query( $sql );
		}

		if( ! $this->mysqli->query(  "SHOW TABLE STATUS LIKE `Review_resume`" ) ){
			$sql = "CREATE TABLE IF NOT EXISTS `Review_resume` (
						`review_id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`review_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
						`review_text` varchar( 50 ) NOT NULL,
						`review_author` varchar( 50 ) NOT NULL,
						`review_resume_id` MEDIUMINT NOT NULL,
						PRIMARY KEY  ( `review_id` ),
						FOREIGN KEY ( `review_resume_id` ) REFERENCES Resume( `resume_id` )
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			$this->mysqli->query( $sql );
		}

	}

	protected function getQuery($query, $params) {
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
	protected function resultSetToArray( $result_set ) {
		$array = array();
		while ( ($row = $result_set->fetch_assoc() ) != false) {
		  $array[] = $row;
		}
		return $array;
	}

	public static function getDB() {
		if ( self::$db == null ) {
			self::$db = new self;
		}
		return self::$db;
	}

}