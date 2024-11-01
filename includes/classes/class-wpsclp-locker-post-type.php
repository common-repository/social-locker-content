<?php

class Wpsclp_Locker_Post_Type {

	private $slug = 'wpsclp_locker';

	function __construct() {

		$this->start();

	}

	function start() {

		$this->hooks();

		$this->filters();

		$this->shortcodes();

	}

	function includes() {


	}

	function hooks() {

		add_action( 'init', array( $this, 'register_post_type' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );


		/** Add and remove meta boxes **/
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_menu', array( $this, 'remove_meta_boxes' ) );


		/** Save the theme and locker options data into database **/
		add_action( 'save_post', array( $this, 'save_post' ) );

		/** Add js scripts and css styles to frontend **/
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );
		add_action( 'wp_head', array( $this, 'frontend_js_wp_head' ) );

		//Add the intro box with the support and social network links
		add_action( 'admin_footer', array( $this, 'intro_box' ) );

	}

	function filters() {

		add_filter( 'post_updated_messages',
			array( $this, 'custom_update_messages' ) );

		add_filter( 'post_row_actions',
			array( $this, 'remove_post_row_actions' ) );

		add_filter( 'the_content', array( $this, 'add_when_rule_element' ) );

	}

	function shortcodes() {

		$shortcode = 'content_locker';

		add_shortcode( $shortcode, array( $this, 'content_locker_shortcode' ) );

	}

	function content_locker_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
				'id' => null
			), $atts ) );
		
		if ( ! $id )
			return FALSE;

		if ( get_post_status( $id ) !== 'publish' )
			return FALSE;

		$locker_id = $id;

		$content = wpautop( do_shortcode( $content ) );

		$options = wpsclp_get_locker_meta( $locker_id, 'options' );

		ob_start();

		if ( $options['rules']['show_to_logged_in_users'] && is_user_logged_in() )
			echo $content;
		else
			do_action( 'wpsclp_locker_shortcode', $locker_id, $atts, $content );

		return ob_get_clean();

	}

	function register_post_type() {

		$labels = array(
			'name' => _x( 'Lockers', 'post type general name' ),
			'singular_name' => _x( 'Locker', 'post type singular name' ),
			'add_new' => _x( 'Add New', 'Locker' ),
			'add_new_item' => __( 'Add New Locker' ),
			'edit_item' => __( 'Edit Locker' ),
			'new_item' => __( 'New Locker' ),
			'all_items' => __( 'All Locker' ),
			'view_item' => __( 'View Locker' ),
			'search_items' => __( 'Search Locker' ),
			'not_found' =>  __( 'No Lockers found' ),
			'not_found_in_trash' => __( 'No Lockers found in Trash' ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Lockers' )

		);

		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => false,
			'rewrite' => false,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon' => 'dashicons-plus-alt',
			'supports' => array( 'title' )
		);

		register_post_type( 'wpsclp_locker', $args );

	}

	function add_meta_boxes() {


		//Custom publish or save box
		add_meta_box(
			'wpsclp_custom_publish_meta_box',
			__( 'Save', 'wpsclp' ),
			array( $this, 'custom_publish_meta_box' ),
			$this->slug,
			'side'
		);

		//Theme Meta Box
		add_meta_box(
			'wpsclp_social_meta_box',
			__( 'Social Networks', 'wpsclp' ),
			array( $this, 'social_meta_box' ),
			$this->slug,
			'normal'
		);

		//Locker options/settings meta box
		add_meta_box(
			'wpsclp_options_meta_box',
			__( 'Options', 'wpsclp' ),
			array( $this, 'options_meta_box' ),
			$this->slug,
			'normal'
		);

		//Link Locker shortcode metabox
		add_meta_box(
			'wpsclp_locker_shortcode',
			__( 'Shortcode', 'wpsclp' ),
			array( $this, 'content_locker_shortcode_meta_box' ),
			$this->slug,
			'side'
		);		

	}

	function custom_publish_meta_box( $post ) {

		$locker_id = $post->ID;

		$post_status = get_post_status( $locker_id );

		$delete_link = get_delete_post_link( $locker_id );

		$nonce = wp_create_nonce( 'wpsclp_locker_nonce' );

		include wpsclp_view_path( 'admin-settings/custom_publish_meta_box' );

	}

	function social_meta_box( $post ) {

		$locker_id = $post->ID;

		$options = wpsclp_get_locker_meta( $locker_id, 'options' );

		$default_options = $this->default_options();

		$options = wp_parse_args( $options, $default_options );

		include wpsclp_view_path( 'admin-settings/social-networks-metabox' );

	}

	function options_meta_box( $post ) {

		$locker_id = $post->ID;

		$themes = wpsclp_get_locker_themes();

		$active_theme = wpsclp_get_locker_theme( $locker_id );

		$options = wpsclp_get_locker_meta( $locker_id, 'options' );

		$default_options = $this->default_options();

		$options = wp_parse_args( $options, $default_options );

		if ( ! $active_theme )
			$active_theme = 'default_theme';

		include wpsclp_view_path( 'admin-settings/options_meta_box' );

	}

	function content_locker_shortcode_meta_box( $post ) {

		$locker_id = $post->ID;

		$shortcode = 'content_locker';

		if ( get_post_status( $locker_id ) !== 'publish' ) {

			echo __( '<p>Click on the Create Locker button to get the shortcode.</p>', 'wpsclp' );

			return;

		}

		$locker_title = get_the_title( $locker_id );

		$shortcode = sprintf( "[%s id='%s' name='%s']", 
		$shortcode, $locker_id, $locker_title );

		include wpsclp_view_path( 'admin-settings/locker_shortcode_meta_box' );

	}

	function validate_page() {

		if ( isset( $_GET['post_type'] ) )
			if ( $_GET['post_type'] == $this->slug )
				return TRUE;

		if ( get_post_type() === $this->slug )
			return TRUE;

		return FALSE;

	}

	function admin_enqueue() {


		if ( ! $this->validate_page() )
			return FALSE;

		wp_enqueue_script( 'jquery' );

		wp_enqueue_style( 'wpsclp-locker-admin',
			plugins_url( 'css/wpsclp-locker-admin.css', WPSCLP_PLUGIN_MAIN_FILE ) ,
			array(), WPSCLP_PLUGIN_VERSION );

		wp_enqueue_style( 'jquery-ibutton',
			plugins_url( 'css/jquery-ibutton/jquery.ibutton.min.css',
				WPSCLP_PLUGIN_MAIN_FILE ),
			array(), WPSCLP_PLUGIN_VERSION );

		wp_enqueue_script( 'jquery-ibutton',
			plugins_url( 'js/jquery.ibutton.min.js', WPSCLP_PLUGIN_MAIN_FILE ) ,
			array(), WPSCLP_PLUGIN_VERSION );

		wp_enqueue_script( 'wpsclp-locker-admin',
			plugins_url( 'js/wpsclp-locker-admin.js', WPSCLP_PLUGIN_MAIN_FILE ) ,
			array(), WPSCLP_PLUGIN_VERSION );
		
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );

		wp_enqueue_style( 'farbtastic' );
    	wp_enqueue_script( 'farbtastic' );

		wp_dequeue_script( 'autosave' );

		wp_dequeue_script( 'media-upload' );

	}

	function frontend_enqueue() {

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'jquery-sharrre',
			plugins_url( 'js/jquery.sharrre.js', WPSCLP_PLUGIN_MAIN_FILE ) ,
			array(), WPSCLP_PLUGIN_VERSION );

		wp_enqueue_script( 'wpsclp-frontend',
			plugins_url( 'js/wpsclp-frontend.js', WPSCLP_PLUGIN_MAIN_FILE ) ,
			array(), WPSCLP_PLUGIN_VERSION );
		
		wp_enqueue_style( 'wpsclp-frontend',
			plugins_url( 'css/wpsclp-frontend.css', WPSCLP_PLUGIN_MAIN_FILE ) ,
			array(), WPSCLP_PLUGIN_VERSION );

	}

	function frontend_js_wp_head() {

	}

	function custom_update_messages( $messages ) {

		global $post;

		$messages[$this->slug] = array(
			0 => '',
			1 =>  __( 'Locker updated.' ),
			2 => __( 'Custom field updated.' ),
			3 => __( 'Custom field deleted.' ),
			4 => __( 'Locker updated.' ),
			5 => isset( $_GET['revision'] ) ? sprintf( __( 'Locker restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => __( 'Locker created.' ),
			7 => __( 'Locker saved.' ),
			8 => '',
			9 => sprintf( __( 'Locker scheduled for: <strong>%1$s</strong>.' ),
				date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Locker draft updated.' )
		);

		return $messages;

	}

	function remove_meta_boxes() {

		remove_meta_box( 'submitdiv', $this->slug, 'side' );

	}

	function remove_post_row_actions( $actions ) {

		if ( ! $this->validate_page() )
			return $actions;

		unset( $actions['view'] );
		unset( $actions['inline hide-if-no-js'] );
		unset( $actions['pgcache_purge'] );

		return $actions;

	}

	function save_post( $post_id ) {

		if ( ! $this->validate_page() )
			return FALSE;

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return FALSE;

		if ( wp_is_post_revision( $post_id ) )
			return FALSE;
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		if ( ! isset( $_POST['wpsclp_locker_nonce'] ) )
			return FALSE;

		if ( ! wp_verify_nonce( $_POST['wpsclp_locker_nonce'], 'wpsclp_locker_nonce' ) )
			return FALSE;

		$locker_id = $post_id;

		$options = $_POST['options'];

		if ( isset( $options['enabled'] ) )
			$options['enabled'] = true;
		else
			$options['enabled'] = false;

		if ( ! defined('WPSCLP_PREMIUM_FUNCTIONALITY') )
			$options['enabled'] = false;

		if ( ! isset( $options['rules']['show_on_homepage'] ) )
			$options['rules']['show_on_homepage'] = false;

		if ( ! isset( $options['rules']['show_only_on_homepage'] ) )
			$options['rules']['show_only_on_homepage'] = false;

		if ( ! isset( $options['rules']['show_to_logged_in_users'] ) )
			$options['rules']['show_to_logged_in_users'] = false;

		if ( ! isset( $options['rules']['hide_on_mobile_devices'] ) )
			$options['rules']['hide_on_mobile_devices'] = false;

		if ( ! isset( $options['rules']['show_only_to_search_engine_visitors'] ) )
			$options['rules']['show_only_to_search_engine_visitors'] = false;

		if ( ! isset( $options['rules']['exit_locker'] ) )
			$options['rules']['exit_locker'] = false;

		if ( ! isset( $options['rules']['when_post_end_rule'] ) )
			$options['rules']['when_post_end_rule'] = false;

		if ( ! isset( $options['rules']['use_cookies'] ) )
			$options['rules']['use_cookies'] = false;

		if ( ! isset( $options['rules']['counter'] ) )
			$options['rules']['counter'] = false;

		if ( ! isset( $options['rules']['google_plus'] ) )
			$options['rules']['google_plus'] = false;

		if ( ! isset( $options['rules']['facebook'] ) )
			$options['rules']['facebook'] = false;

		if ( ! isset( $options['rules']['twitter'] ) )
			$options['rules']['twitter'] = false;

		if ( ! isset( $options['rules']['linkedin'] ) )
			$options['rules']['linkedin'] = false;

		foreach( $options['rules'] as $key => $rule ):

			if ( $rule === "true" )
				$options['rules'][$key] = true;

			if ( $rule === "false" )
				$options['rules'][$key] = false;

		endforeach;

		wpsclp_save_locker_meta( $locker_id, 'options', $options );

		wpsclp_save_locker_meta( $locker_id, 'theme', $options['theme'] );

		do_action( 'wpsclp_save_locker_data', $locker_id );

		if ( function_exists('w3tc_pgcache_flush') ) {
		  w3tc_pgcache_flush();
		} else if ( function_exists('wp_cache_clear_cache') ) {
		  wp_cache_clear_cache();
		}
		
	}

	public static function default_options() {

		$rules = array(
					'show_on_homepage' => true,
					'show_only_on_homepage' => false,
					'show_to_logged_in_users' => true,
					'hide_on_mobile_devices' => false,
					'show_only_to_search_engine_visitors' => false,
					'use_cookies' => true,
					'cookie_expiration_time' => '',
					'when_post_end_rule' => false,
					'exit_locker' => false,
					'comment_autofill' => false,
					'google_plus' => true,
					'facebook' => true,
					'facebook_share' => false,
					'twitter' => true,
					'linkedin' => true,
					'counter' => true
  				);

		$rules = apply_filters( 'wpsclp_default_locker_options_rules', $rules );

		$options = array(
				'enabled' => false,
				'theme' => 'default_theme',
				'delay_time' => 500,
				'mask_color' => '#000',
				'border_color' => '#000',
				'transition' => 'elastic',
				'rules' => $rules,
				'url_to_share' => '',
				'header_msg' => __( 'The content is locked', 'wpsclp' ),
				'message' => __( 'Use one of the buttons below to unlock the content' ),
				'share_txt' => __( 'Text to use with sharing buttons', 'wpsclp' )
			);

		return apply_filters( 'wpsclp_default_locker_options', $options );

	}

	function add_when_rule_element( $content ) {

		//Add the when rule element at the end of a post content
		$end_element = '<div style="display: block !important; margin:0 !important; padding: 0 !important" id="wpsclp_locker_post_end_element"></div>';

		return $content . PHP_EOL . $end_element;

	}

	function intro_box() {

		if ( ! $this->validate_page() )
			return FALSE;

		if ( defined( 'WPSCLP_PREMIUM_FUNCTIONALITY' ) )
			$path = 'admin-settings/premium_intro_box';
		else
			$path = 'admin-settings/intro_box';

		include wpsclp_view_path( $path );

	}

}
