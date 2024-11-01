<?php

define( 'WPSCLP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'WPSCLP_PLUGIN_DIR_NAME', dirname( plugin_basename( __FILE__ ) ) );

define( 'WPSCLP_PLUGIN_PREFIX', 'wpsclp' );

define( 'WPSCLP_PLUGIN_INCLUDE_DIRECTORY_NAME', 'includes' );

define( 'WPSCLP_PLUGIN_VIEW_DIRECTORY_NAME', 'views' );

define( 'WPSCLP_PLUGIN_CSS_DIRECTORY_NAME', 'css' );

define( 'WPSCLP_PLUGIN_JS_DIRECTORY_NAME', 'js' );

define( 'WPSCLP_PLUGIN_INCLUDE_DIRECTORY', WPSCLP_PLUGIN_PATH .
									  	WPSCLP_PLUGIN_INCLUDE_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'WPSCLP_PLUGIN_VIEW_DIRECTORY', WPSCLP_PLUGIN_PATH .
									  	WPSCLP_PLUGIN_VIEW_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'WPSCLP_PLUGIN_CSS_DIRECTORY', WPSCLP_PLUGIN_PATH .
									  	WPSCLP_PLUGIN_CSS_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'WPSCLP_PLUGIN_JS_DIRECTORY', WPSCLP_PLUGIN_PATH .
									  	WPSCLP_PLUGIN_JS_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'WPSCLP_PLUGIN_MAIN_FILE', WPSCLP_PLUGIN_PATH . 'wp-sclp.php' );

define( 'WPSCLP_PLUGIN_VERSION', '1.0' );
