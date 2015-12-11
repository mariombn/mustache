<?php
//Configurações do Framework
define( 'APPPATH', dirname( __FILE__ ) );
define( 'DB_HOSTNAME', '192.168.52.52' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', 'admindb' );
define( 'DB_DATABASE', 'mustache' );
define( 'DB_CHARSET', 'utf-8' );
define( 'DEBUG', true );

define( 'APP_NAME', 'PROJECT-NAME' );
define( 'APP_COPYRIGHT', '&copy; 2015 - TODOS OS DIREITOS RESERVADOS' );
define( 'APP_OWNER', 'AUTHOR-NAME' );
define( 'APP_DESCRIPTION', 'DESCRIPTION-PROJECT' );
define( 'HOME_PATH', 'http://mustache.dev/' );

define( 'APP_VERSION_BIG', '0' );
define( 'APP_VERSION_MID', '0' );
define( 'APP_VERSION_MIN', '0' );

require_once APPPATH . '/engine.php';