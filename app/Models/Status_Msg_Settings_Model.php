<?php
namespace Status_Msg\Models;

class Status_Msg_Settings_Model {

	public function SM_Add_Settings_Page( $args ){
		
		// Register a new setting for "page_slug" page.
		register_setting( $args['page_slug'], $args['setting_field_id'] );
	 
		// Register a new field in the "$args['setting_section_id']" section, inside the "$args['page_slug']" page.
		add_settings_field(
			$args['setting_field_id'],
			$args['setting_field_title'],
			$args['view_function'],
			$args['page_slug'],
			$args['setting_section_id']
		);
							
	}
	
	public function SM_Add_Settings_Submenu_Page( $args ){
		
		add_submenu_page(
			$args['parent_slug'],
			$args['page_title'],
			$args['menu_title'],
			$args['capability'],
			$args['page_slug'],
			$args['function']
		);
				
	}

}