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


/* if your sistem is window need change 'upload/' on '/upload/' */
define( 'UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/upload/' );

/*if your sistem is window define IS_WINDOWS need change to "true" */
define( 'IS_WINDOWS' , true );

define( 'UPLOAD_URL', $_SERVER['SERVER_NAME'] . '/upload/' );

define( 'DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] );

