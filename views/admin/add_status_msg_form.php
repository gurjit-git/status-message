<?php
 // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
 
    // add error/update messages
 
    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'sm_messages', 'sm_message', __( 'Settings Saved', 'status_msg' ), 'updated' );
    }
 
    // show error/update messages
    settings_errors( 'sm_messages' );
?>

<style>
	input[type='text']{
		width: 70%
	}
</style>

<div class="wrap">
	<h1>Status Message Settings</h1>
	<form action="options.php" method="post">
		<?php
		// output security fields for the registered setting "status_msg"
		settings_fields( 'status_msg' );
		// output setting sections and their fields
		// (sections are registered for "status_msg", each field is registered to a specific section)
		do_settings_sections( 'status_msg' );
		
		$status_msg_field = get_option( 'status_msg_field' );
		$status_msg_remove = get_option( 'status_msg_remove' );

		?>
			<p>
				<b>Status Message: </b><?php echo wp_kses( $status_msg_field, '' ); ?>
			</p>
			<table class="form-table" role="presentation">
				<tr>
					<th>
						<label for="status_msg_field"><?php _e( 'Status Message' ); ?></label>
					</th>
					<td>
						<input type="text" id="status_msg_field" name="status_msg_field" value="<?php echo wp_kses( $status_msg_field, '' ); ?>">
					</td>
				</tr>
				<tr>
					<th>
						<label for="status_msg_remove"><?php _e( 'Check to Remove Status Message on plugin deativation' ); ?></label>
					</th>
					<td>
						<input type="checkbox" name="status_msg_remove" value="1"<?php checked( 1 == $status_msg_remove ); ?> />
					</td>
				</tr>
			</table>
		<?php
		
		// output save settings button
		submit_button( 'Save Settings' );
		?>
	</form>
</div>