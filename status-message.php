<?php
/*
* Plugin Name: Status Message MVC
* Description: Status Message MVC plugin. Ability to add Status Message In Single and Multisite
* Version: 0.1
* Author: Gurjit Singh
* Author URI: https://gurjitsingh.co
* Text Domain: status-msg-mvc
* Domain Path: \languages
*/

// Direcy Access not allowed. 
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Globals
 */
if( !defined('STATUS_MSG_PLUGIN_FILE') ){
	define( 'STATUS_MSG_PLUGIN_FILE', __FILE__ );
}

if( !defined('STATUS_MSG_PLUGIN_PATH') ){
	define( 'STATUS_MSG_PLUGIN_PATH', trailingslashit( __DIR__ ) );
}

if( !defined('STATUS_MSG_PLUGIN_URL') ){
	define( 'STATUS_MSG_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}

if( !defined('SM_TXT_DOMAIN') ){
	define( 'SM_TXT_DOMAIN', 'status-msg');
}

/**
 * Autoload Classes
 */
include( STATUS_MSG_PLUGIN_PATH . 'app/Core/Autoloader.php' );
$loader = new \Status_Msg\Core\Autoloader();
$loader->addNamespace('Status_Msg', dirname(__FILE__) . '/app');
$loader->register();

if ( !function_exists( 'status_msg_init' ) ){
	add_action( 'plugins_loaded', 'status_msg_init' );
	function status_msg_init() {
		$status_msg = new \Status_Msg\Core\Bootstrap();

		try {
			$status_msg->run();
		} catch ( Exception $e ) {
			wp_die( print_r( $e, true ) );
		}
	}
}

/*
* On plugin deactivation perform actions. 1) Delate Status Message field and Data
*/
function status_msg_deactivation_actions(){
    do_action( 'status_msg_plugin_deactivation' );
}
register_deactivation_hook( __FILE__, 'status_msg_deactivation_actions' );
// Set default values here
function status_msg_delete_options(){
	$status_msg_remove = get_option( 'status_msg_remove' );
	if( 1 == $status_msg_remove ) {
		delete_option( 'status_msg_field' );
	}
}
add_action( 'status_msg_plugin_deactivation', 'status_msg_delete_options' );

/*
* Display Status Message in Dashboard widget
*/
if ( !function_exists( 'status_msg_dashboard_widgets' ) ){
	add_action('wp_dashboard_setup', 'status_msg_dashboard_widgets'); 
	function status_msg_dashboard_widgets() {
		global $wp_meta_boxes;
		wp_add_dashboard_widget('status_msg_widget', 'Status Message', 'status_msg_dashboard_help');
	}
}
if ( !function_exists( 'status_msg_dashboard_help' ) ){
	function status_msg_dashboard_help() {
		$status_msg_field = get_option( 'status_msg_field' );
		echo wp_kses( $status_msg_field, '' );
	}
}