<?php

class Wpsclp_Custom_Buttons_Theme extends Wpsclp_Locker_Theme_Handler {

	protected $name = 'Custom Buttons';

	protected $description = 'Social Locker theme';

	protected $id = 'theme2';

	protected $path = '';

	protected $template_name = 'theme2';

	function init() {

		$this->path =  WPSCLP_PLUGIN_VIEW_DIRECTORY . 'themes/theme2/template.php';
	
	}

	function link_locker_render( $locker_id, $shortcode_atts, $content ) {

		if ( ! $this->is_activated( $locker_id ) )
			return FALSE;

		$options = wpsclp_get_locker_meta( $locker_id, 'options' );

		$options['shortcode_content'] = $content;

		$options['urlCurl'] = plugins_url( 'includes/libs/sharrre.php', WPSCLP_PLUGIN_MAIN_FILE );

		include $this->path;

	}

	function auto_locker_render( $locker_id ) {

		if ( ! $this->check_rules( $locker_id ) )
			return FALSE;

		$options = wpsclp_get_locker_meta( $locker_id, 'options' );

		$options['shortcode_content'] = $content;

		$options['urlCurl'] = plugins_url( 'includes/libs/sharrre.php', WPSCLP_PLUGIN_MAIN_FILE );

		include WPSCLP_PLUGIN_VIEW_DIRECTORY . 'themes/theme2/auto_template.php';


	}
}
