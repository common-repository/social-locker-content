<?php

function load_wpsclp() {

	load_wpsclp_classes();

	//Plugin loaded
	do_action( 'wpsclp_loaded' );

}

function wpsclp_when_plugins_loaded() {

	//Register and init the default theme
	new Wpsclp_Default_Theme();

	new Wpsclp_Custom_Buttons_Theme();

}


function load_wpsclp_classes() {

	wpsclp_include( 'classes/class-wpsclp-locker-theme-handler.php' );
	wpsclp_include( 'classes/class-wpsclp-locker-post-type.php' );
	wpsclp_include( 'classes/class-wpsclp-default-theme.php' );
	wpsclp_include( 'classes/class-wpsclp-custom-buttons-theme.php' );
	

	new Wpsclp_Locker_Post_Type();

	add_action( 'plugins_loaded', 'wpsclp_when_plugins_loaded' );
	
}

function wpsclp_include( $file_name, $require = true ) {

	if ( $require )
		require WPSCLP_PLUGIN_INCLUDE_DIRECTORY . $file_name;
	else
		include WPSCLP_PLUGIN_INCLUDE_DIRECTORY . $file_name;

}

function wpsclp_view_path( $view_name, $is_php = true ) {

	if ( strpos( $view_name, '.php' ) === FALSE && $is_php )
		return WPSCLP_PLUGIN_VIEW_DIRECTORY . $view_name . '.php';

	return WPSCLP_PLUGIN_VIEW_DIRECTORY . $view_name;

}

function wpsclp_settings_part( $view_name, $is_php = true ) {

	return wpsclp_view_path( 'admin-settings/' . $view_name, $is_php );

}

function wpsclp_image_url( $image_name ) {

	return plugins_url( 'images/' . $image_name, WPSCLP_PLUGIN_MAIN_FILE );

}

function wpsclp_css_url( $name ) {

	return plugins_url( 'css/' . $name, WPSCLP_PLUGIN_MAIN_FILE );

}

function wpsclp_get_locker_themes() {

	$themes = array();

	return apply_filters( 'wpsclp_locker_themes' , $themes );

}

function wpsclp_get_settings() {

	return Wpsclp_Settings::get_settings();

}

function wpsclp_get_single_setting( $key ) {

	$settings = wpsclp_get_settings();

	if ( ! isset( $settings[$key] ) )
		return apply_filters( 'wpsclp_get_single_setting', NULL );

	return apply_filters( 'wpsclp_get_single_setting', $settings[$key] ); 

}

function wpsclp_get_locker_meta( $locker_id, $key ) {

	return get_post_meta( $locker_id, $key, true );

}

function wpsclp_get_locker_theme( $locker_id ) {

	$theme = wpsclp_get_locker_meta( $locker_id, 'theme' );

	if ( ! $theme )
		$theme = 'default_theme';

	return apply_filters( 'wpsclp_get_locker_theme', $theme, $locker_id );

}

function wpsclp_save_locker_meta( $locker_id, $key, $value ) {

	return update_post_meta( $locker_id, $key, $value );

}