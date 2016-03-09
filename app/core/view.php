<?php

class View {
	
	private static $view = null;

	function generate( $template_view, $content_view = null, $data = null) {
		$content_view_include = array();
		if( is_array( $data ) ) {		
			extract( $data );
		} 

		
		if( !empty( $content_view ) && is_string( $content_view ) ) {
			$content_view_include[] = 'views/'. $content_view;
		} else if (  !empty( $content_view ) && is_array( $content_view ) ){
			foreach( $content_view  as $key =>$value ){
				$content_view_include[$key] = 'views/'. $value;
			}
		}


		include 'app/themplate/'.$template_view;
	}

	function update_content( $content_view, $data = null) {
		$content_view_include = array();
		if( is_array( $data ) ) {		
			extract( $data );
		}
		ob_start();
			include_once 'app/themplate/views/'.$content_view;
		$test = ob_get_clean();
		return $test;
	}

	public static function getInstance() {
		if ( self:: $view == null ) {
			self::$view = new Model();
		}
		return self::$view;
	}

}
