<?php

//Configurações do Framework
define( 'APPPATH', dirname( __FILE__ ) );

define( 'DB_HOSTNAME', '127.0.0.1' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', '' );
define( 'DB_CHARSET', 'utf-8' );

define( 'DEBUG', true ); // Troque o valor para FALSE em um ambiente de Produção

define( 'APP_NAME', 'PROJECT-NAME' );
define( 'APP_COPYRIGHT', '&copy; 2016 - All rights reserved' );
define( 'APP_OWNER', 'AUTHOR-NAME' );
define( 'APP_DESCRIPTION', 'DESCRIPTION-PROJECT' );
define( 'HOME_PATH', 'http://127.0.0.1:8888/' ); // Para evitar problemas, sempre use um Virtual Host no seu Servidor WEB para rodar esse Framework

define( 'APP_VERSION_BIG', '0' );
define( 'APP_VERSION_MID', '0' );
define( 'APP_VERSION_MIN', '0' );

require_once APPPATH . '/engine.php';
