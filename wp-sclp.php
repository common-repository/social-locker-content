<?php
/**
Plugin Name: Social Content Locker
Plugin URI: http://web-settler.com/wordpress-social-locker/
Description: Adds a responsive social content locker to your site. 
Author: Umar
Author URI: http://web-settler.com/wordpress-social-locker/
Version: 1.0
**/

require plugin_dir_path( __FILE__ ) . 'config.php';

require WPSCLP_PLUGIN_INCLUDE_DIRECTORY . 'functions.php';

load_wpsclp();

