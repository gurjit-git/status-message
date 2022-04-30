<?php
namespace Status_Msg\Controllers;

use \Status_Msg\Models\Status_Msg_Settings_Model;

/**
 * Admin Controller Class
 *
 * Functionality for the admin area of WordPress
 *
 * @package Status_Msg\Controller
 */
class Status_Msg_Settings_Controller extends Controller {

    public function register_actions() {
       // add_action( 'admin_init', array( $this, 'status_msg_plugin_settings' ) );
	   	add_action( 'admin_init', array( $this, 'status_msg_add_settings_page') );
		add_action( 'admin_menu', array( $this, 'status_msg_submenu_page') );
		add_action( 'network_admin_menu', array( $this, 'status_msg_submenu_page') );
    }

    public function status_msg_render_plugin_settings() {
		echo $this->the_view( 'admin/add_status_msg_form' );
    }
	
	public function status_msg_add_settings_page(){
		
		$setting_model = new Status_Msg_Settings_Model();
		
		$args_field_1 = array(
			'setting_field_id' => 'status_msg_field',
			'setting_field_title' => 'Status Message',
			'view_function' => array( $this, 'status_msg_render_plugin_settings' ),
			'page_slug'  => 'status_msg',
			'setting_section_id' => 'status_msg_section_id',
			//'section_title' => 'Status Message Section'
		); 

		$setting_model->SM_Add_Settings_Page( $args_field_1 );
		
		$args_field_2 = array(
			'setting_field_id' => 'status_msg_remove',
			'setting_field_title' => 'Remove Status Message on plugin deativation',
			'view_function' => array( $this, 'status_msg_render_plugin_settings' ),
			'page_slug'  => 'status_msg',
			'setting_section_id' => 'status_msg_section_id',
			//'section_title' => 'Status Message Section'
		); 

		$setting_model->SM_Add_Settings_Page( $args_field_2 );
		
	}
	
	public function status_msg_submenu_page(){
		
		$setting_model = new Status_Msg_Settings_Model();
		
		$args = array(
			'parent_slug' => 'tools.php',
			'page_title' => 'Status Message Settings',
			'menu_title' => 'Status Message',
			'capability'  => 'manage_options',
			'page_slug' => 'status_msg',
			'function'   => array( $this, 'status_msg_render_plugin_settings' )
		); 
				
		$setting_model->SM_Add_Settings_Submenu_Page( $args );
		
	}
	
}