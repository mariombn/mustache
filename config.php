<?php

//Configurações do Framework
define( 'APPPATH', dirname( __FILE__ ) );

if (file_exists(APPPATH . '/config.ini')) {
    $_local_file_config = parse_ini_file(APPPATH . '/config.ini'); // TODO: Tirar o DIST
} else {
    Mustache\Error::display('Configuration file not found');
}
foreach ($_local_file_config as $k => $v) {
    define( $k, $v );
}