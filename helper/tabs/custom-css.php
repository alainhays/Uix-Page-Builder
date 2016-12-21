<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_pb_customcss';



// If they did, this hidden field will be set to 'Y'
if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_pb_customcss' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		
		update_option( 'uix_pb_opt_cssnewcode', wp_unslash( $_POST[ 'uix_pb_opt_cssnewcode' ] ) );
	
	
		// Put a "settings saved" message on the screen
		echo '<div class="updated"><p><strong>'.__('Settings saved.', 'uix-pagebuilder' ).'</strong></p></div>';

	
	}
	
	
	

 }  


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'custom-css' ) {

	if ( file_exists( UixPageBuilder::backend_path( 'dir' ).'css/uix-pagebuilder.css' ) ) {

?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_pb_customcss' ); ?>
        
        <h4><?php _e( 'You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files.', 'uix-pagebuilder' ); ?></h4>
            
        <table class="form-table">
          <tr>
            <th scope="row">
              <?php _e( 'Paste your CSS code', 'uix-pagebuilder' ); ?>
            </th>
            <td>
              <textarea name="uix_pb_opt_cssnewcode" class="regular-text" rows="25" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_pb_opt_cssnewcode' ) ); ?></textarea>
            </td>
          </tr>
        </table> 
        
          
<?php

	
	$org_cssname_uix_shortcodes = 'uix-pagebuilder.css';
	$org_csspath_uix_shortcodes = UixPageBuilder::backend_path( 'uri' ).'css/uix-pagebuilder.css';
	$filepath                   = 'uix-pagebuilder-sections/css/';
	
	
	if ( UixPageBuilder::tempfolder_exists() ) {
		$filetype = 'theme';
	} else {
		$filetype = 'plugin';
	}

	
	// capture output from WP_Filesystem
	ob_start();
	
		UixPageBuilder::wpfilesystem_read_file( 'css-filesystem-nonce', 'edit.php?post_type='.UixPageBuilder::get_slug().'&page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_shortcodes, $filetype );
		$filesystem_uix_shortcodes_out = ob_get_contents();
	ob_end_clean();
	
	if ( empty( $filesystem_uix_shortcodes_out ) ) {
		
		$style_org_code_uix_shortcodes = UixPageBuilder::wpfilesystem_read_file( 'css-filesystem-nonce', 'edit.php?post_type='.UixPageBuilder::get_slug().'&page='.UixPageBuilder::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_shortcodes, $filetype );
		
		echo '
		
		         <p>'.__( 'CSS file root directory:', 'uix-pagebuilder' ).' 
				     <a href="javascript:" id="uix_shortcodes_view_css" >'.$org_csspath_uix_shortcodes.'</a>
					 <div class="uix-pagebuilder-dialog-mask"></div>
					 <div class="uix-pagebuilder-dialog" id="uix-pagebuilder-view-css-container">  
						<textarea rows="15" style=" width:95%;" class="regular-text">'.$style_org_code_uix_shortcodes.'</textarea>
						<a href="javascript:" id="uix_shortcodes_close_css" class="close button button-primary">'.__( 'Close', 'uix-pagebuilder' ).'</a>  
					</div>
				 </p><hr />
				<script type="text/javascript">
					
				( function($) {
					
					"use strict";
					
					$( function() {
						
						var dialog_uix_shortcodes = $( "#uix-pagebuilder-view-css-container, .uix-pagebuilder-dialog-mask" );  
						
						$( "#uix_shortcodes_view_css" ).click( function() {
							dialog_uix_shortcodes.show();
						});
						$( "#uix_shortcodes_close_css" ).click( function() {
							dialog_uix_shortcodes.hide();
						});
					
			
					} );
					
				} ) ( jQuery );
				
				</script>
		
		';	

	} else {
		
		echo '
		         <p>'.__( 'CSS file root directory:', 'uix-pagebuilder' ).' 
				     <a href="'.$org_csspath_uix_shortcodes.'" target="_blank">'.$org_csspath_uix_shortcodes.'</a>
				 </p><hr />

		';	
		
		
	}
?>
        
        
        <?php submit_button(); ?>

    
    </form>


    
<?php 
	} else {
		echo __( '<p>The .css file does not exist.</p>', 'uix-pagebuilder' );
		
	}																			
} 
?>
																				
																			