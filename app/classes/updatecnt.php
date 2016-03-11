<?php

class UpdateCnt {

	private static $cnt = null;

	private static $view_cnt = null;

	private function __construct() {

	}

	public function get_all_cnt_review(){
		if ( self::$view_cnt == null ) {
			self::$view_cnt = rand( 1,1000 );
		}
		return self::$view_cnt; 
	}

	public static function getUpdateCnt() {
		if ( self::$cnt == null ) {
			self::$cnt = new self;
		}
		return self::$cnt;
	}
}