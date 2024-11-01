<?php

class Wpsclp_Locker_Theme_Handler {

	protected $name;

	protected $description;

	protected $id;

	protected $settings;

	function __construct() {

		$this->hooks();

		$this->filters();

		$this->init();

	}

	function hooks() {

		add_action( 'wpsclp_save_locker_data', array( $this, 'save_settings' ) );

		add_action( 'wpsclp_admin_theme_view', array( $this, 'render_settings' ) );

		add_action( 'wpsclp_locker_shortcode',
			array( $this, 'link_locker_render' ), 10, 3 );

		add_action( 'wp_footer', array( $this, 'auto_locker_hook' ) );

	}

	function filters() {

		add_filter( 'wpsclp_locker_themes', array( $this, 'register_theme' ) );

	}

	function init() {

	}

	function register_theme( $themes ) {

		if ( isset( $themes[$this->id] ) )
			return $themes;

		$themes[$this->id] = $this;

		return $themes;

	}

	public function is_activated( $locker_id, $id = '' ) {

		if ( empty( $id ) )
			$id = $this->id();

		$theme = wpsclp_get_locker_theme( $locker_id );

		return $theme == $id;

	}

	function check_rules( $locker_id ) {

		$options = wpsclp_get_locker_meta( $locker_id, 'options' );

		if ( ! $options['enabled'] )
			return apply_filters( 'wpsclp_check_rules_false', FALSE, $locker_id, 'enabled' );

		$rules = $options['rules'];

		if ( ! $rules['show_to_logged_in_users'] && is_user_logged_in() )
			return apply_filters( 'wpsclp_check_rules_false', FALSE, $locker_id, 'show_to_logged_in_users' );

		if ( $rules['show_only_on_homepage'] && ! ( is_front_page() || is_home() ) )
			return apply_filters( 'wpsclp_check_rules_false', FALSE, $locker_id, 'show_only_on_homepage' );

		if ( ! $rules['show_on_homepage'] && ( is_front_page() || is_home() ) )
			return apply_filters( 'wpsclp_check_rules_false', FALSE, $locker_id, 'show_on_homepage' );

		if ( $rules['show_only_to_search_engine_visitors'] ):

		$is_se_visitor = false;

		$ref = $_SERVER['HTTP_REFERER'];
		
		$SE = array( '/search?', 'images.google.', 'web.info.com', 'search.', 
			'del.icio.us/search', 'soso.com', '/search/', '.yahoo.', '.google.',
			 '.bing.', 'search.twitter.com' );
		
		foreach ( $SE as $source ) {
			
			if ( strpos( $ref, $source ) !== false ) {
			
				setcookie( 'wpsclp_is_searchengine_visitor', 1, time()+3600*24*100, COOKIE_DOMAIN, false );
				
				$is_se_visitor = true;
			
			}
		}

		if ( $is_se_visitor !== true ||
			! $_COOKIE['wpsclp_is_searchengine_visitor'] == 1 )
			return apply_filters( 'wpsclp_check_rules_false', FALSE, $locker_id, 'show_only_to_search_engine_visitors' );

		endif;

		return apply_filters( 'wpsclp_check_rules', TRUE, $locker_id );

	}

	function is_link_locker( $locker_id ) {

		return FALSE;

	}


	function save_settings( $locker_id ) {



	}

	public function auto_locker_render( $locker_id ) {

		if ( ! $this->check_rules( $locker_id ) )
			return FALSE;

	}

	function link_locker_render( $locker_id, $shortcode_atts, $content ) {



	}

	function render_settings( $locker_id ) {



	}

	public function name( $name = '' ) {

		if (  empty( $name ) )
			return $this->name;

		$this->name = $name;

	}

	public function description( $description = '' ) {

		if (  empty( $description ) )
			return $this->description;

		$this->description = $description;

	}

	public function id( $id = '' ) {

		if (  empty( $id ) )
			return $this->id;

		$this->id = $id;

	}

	function save_settings_to_db( $locker_id, $settings ) {

		return wpsclp_save_locker_meta( $locker_id, $this->id() . '_settings', $settings );

	}

	function get_settings( $locker_id ) {

		$settings = wpsclp_get_locker_meta( $locker_id, $this->id() . '_settings' );

		if ( ! $settings )
			return $this->default_settings();

		return $settings;

	}

	function default_settings() {

		return array();

	}

	function auto_locker_hook() {

		$lockers = get_posts( array(
				'post_type' => 'wpsclp_locker',
				'numberposts' => -1,
				'post_status' => 'publish'
			) );

		$themes = wpsclp_get_locker_themes();

		foreach ( $lockers as $locker ):

		$locker_id = $locker->ID;

		if ( ! $this->is_activated( $locker_id ) )
			continue;

		if ( ! $this->check_rules( $locker_id ) )
			continue;

		$theme = wpsclp_get_locker_theme( $locker_id );

		if ( ! isset( $themes[ $theme ] ) )
			continue;

		$themes[$theme]->auto_locker_render( $locker_id );
		
		endforeach;

	}

	public static function echo_locker_options_in_json( $locker_id ) {

		$options = wpsclp_get_locker_meta( $locker_id, 'options' );

		$options = json_encode( $options );

		echo apply_filters( 'wpsclp_echo_locker_options_in_json',  $options, $locker_id );

	}



}