<?php

class Model {

	private static $db = null;
	protected $mysqli = null;
	
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
						`resume_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
						`review_author` MEDIUMINT NOT NULL,
						`review_resume_id` MEDIUMINT NOT NULL,
						PRIMARY KEY  ( `review_id` ),
						FOREIGN KEY ( `review_resume_id` ) REFERENCES Resume( `resume_id` )
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			$this->mysqli->query( $sql );
		}

	}

	
	public static function getDB() {
		if ( self::$db == null ) {
			self::$db = new self;
		}
		return self::$db;
	}

}