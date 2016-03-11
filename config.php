<?php 
/*config for DB conection*/
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** MySQL database username */
define( 'DB_USER', 'root' );
/** MySQL database password */
define( 'DB_PASSWORD', '' );
/** The name of the database for project */
define( 'DB_NAME', 'test_webdev_base' );

/* define for DEBUG option */
/* Change this to true to enable the display of notices during development.*/
define( "DEBUG", false );

/* for create demo messages */
/* Change this to true to reate demo messages */
define( "DEMO_UPLOAD", false );

/* for pagination  */
/* Specify the number of messages on a single page */
define( "LIMIT", 15 );

define( 'UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . 'upload/' );
define( 'UPLOAD_URL', $_SERVER['SERVER_NAME'] . '/upload/' );
define( 'DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] );

/*if your sistem is window define IS_WINDOWS need change to "true" */
define( 'IS_WINDOWS' , false );