<?php

class IProperty_Struts {
	static protected $_config = NULL;

	static public function load_config( array $config ) {
		self::$_config = $config;
	}

	static public function config( $name ) {
		if ( isset( self::$_config[$name] ) ) {
			return self::$_config[$name];
		} else {
			return NULL;
		}
	}
}

function iproperty_struts_autoloader( $class ) {
	$class = str_replace( 'IProperty_', '', $class );
	$filename = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . strtolower( str_replace( '_', DIRECTORY_SEPARATOR, $class ) . '.php' );

	if ( file_exists( $filename ) ) {
		require_once $filename;
	}
}

spl_autoload_register( 'iproperty_struts_autoloader' );

define( 'IPROPERTY_STRUTS_DIR', dirname( __FILE__ ) . '/../' );
define( 'IPROPERTY_STRUTS_TEMPLATE_DIR', IPROPERTY_STRUTS_DIR . 'templates/' );