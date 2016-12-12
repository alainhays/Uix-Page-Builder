<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  WP Menu Extensions: One-page
 *
 */
if ( !class_exists( 'UixPB_Menu_Extensions_Onepage' ) ) {
	class UixPB_Menu_Extensions_Onepage {
	
	
		public static function init() {
			add_action( 'admin_init', array( __CLASS__, 'nav_menu_meta_box' ) );
			add_action( 'wp_ajax_uix_pagebuilder_anchorlinks_save_settings', array( __CLASS__, 'save' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_menu_page_scripts' ) );
		}
	
	
	   /**
		 * Enqueue required CSS and JS
		 */
		public static function enqueue_menu_page_scripts() {
	
			// Register the script
			wp_register_script( 'uix_pagebuilder_anchorlinks_save_handle', UixPageBuilder::plug_directory() .'admin/js/menu.js' );
		
			wp_localize_script( 'uix_pagebuilder_anchorlinks_save_handle', 'uix_pagebuilder_anchorlinks_data', array(
				'send_string_nonce' => wp_create_nonce( 'uix_pagebuilder_anchorlinks_save_nonce' ),
			) );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'uix_pagebuilder_anchorlinks_save_handle' );

		}	
	
		/**
		 * Save the mega menu settings (submitted from Menus Page Meta Box)
		 *
		 */
		public static function save() {
			
			check_ajax_referer( 'uix_pagebuilder_anchorlinks_save_nonce', 'security' );
			
			if ( isset( $_POST[ 'postID' ] ) ) {
				
				$postID = $_POST[ 'postID' ];
				
				
				$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $postID, 'uix-pagebuilder-layoutdata', true ) );
				$item              = [];
				$cols              = [ 
										[ '3_4', 'uix-pb-col-8' ],
										[ '1_4', 'uix-pb-col-4' ],
										[ '2_3', 'uix-pb-col-9' ],
										[ '1_3', 'uix-pb-col-3' ],
										[ '4__1', 'uix-pb-col-3' ],
										[ '4__2', 'uix-pb-col-3' ],
										[ '4__3', 'uix-pb-col-3' ],
										[ '4__4', 'uix-pb-col-3' ],
										[ '3__1', 'uix-pb-col-4' ],
										[ '3__2', 'uix-pb-col-4' ],
										[ '3__3', 'uix-pb-col-4' ],
										[ '2__1', 'uix-pb-col-6' ],
										[ '2__2', 'uix-pb-col-6' ],
										[ '1__1', 'uix-pb-col-12' ]
									];
				
				if ( $builder_content && is_array( $builder_content ) ) {
					
					echo '
					<div class="tabs-panel tabs-panel-active">
						<ul class="categorychecklist form-no-clear">
					';
					
		
					foreach ( $builder_content as $key => $value ) :
						$con                  = UixPageBuilder::pagebuilder_output( $value->content );
						$col                  = $value->col;
						$row                  = $value->row;
						$size_x               = $value->size_x;
						$section_id           = $value->secindex;
						$custom_id            = $value->customid;
						$section_title        = $value->title;
						$element_code         = '';
						$element_grid_before  = '';
						$element_grid_after   = '</div>';
						
						if ( empty( $custom_id ) ) $custom_id = 'uix-pagebuilder-section-'.$row;
						
					
						if ( $con && is_array( $con ) ) {
							foreach ( $con as $key ) :
								
								$$key[0] = $key[ 1 ];
								$item[ UixPageBuilder::pagebuilder_item_name( $key[0] ) ]  =  $$key[0];
							endforeach;
						}
				
						//------------------------------------   loop sections
						if ( sizeof( $item ) > 3 && !empty( $value->content ) ) {
							
							$col_content   = UixPageBuilder::pagebuilder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
							
							if ( $col_content && is_array( $col_content ) ) {
								foreach ( $col_content as $key => $value ) :
									
									$colid           = $value[0][1]; //column id
									$temp_index      = count( $value ) - 1;
								
									if ( UixPageBuilder::inc_str( $value[ $temp_index ][0], '_temp' ) || UixPageBuilder::inc_str( $value[ $temp_index ][0], 'uix_pb_section_undefined' ) ) {
										
										$html = ( !empty( UixPageBuilder::theme_value( $value[$temp_index][1] ) ) ) ? UixPageBuilder::theme_value( $value[$temp_index][1] ) : '&nbsp;';
										
										//Determine the grid system
										foreach ( $cols as $id ) :
											if ( $colid == $id[0] ) {
												$element_grid_before = '<div class="'.$id[1].' {last}">';
											}
										endforeach;
										
										$element_code .= $element_grid_before.$html.$element_grid_after;	
									
										
									}
		
								
								
								endforeach;
								
							    echo '
								<li>
									<label class="menu-item-title">
										<input type="checkbox" class="menu-item-checkbox" name="menu-item['.esc_attr( $section_id ).'][menu-item-object-id]" value="'.esc_attr( $section_id ).'"> '.$section_title.'<br><span class="custom-prop"><strong>'.__( 'ID', 'uix-pagebuilder' ).':</strong> '.$custom_id.'</span>
									</label>
									<input type="hidden" class="menu-item-type" name="menu-item['.esc_attr( $section_id ).'][menu-item-type]" value="custom">
									<input type="hidden" class="menu-item-title" name="menu-item['.esc_attr( $section_id ).'][menu-item-title]" value="'.esc_attr( $section_title ).'">
									<input type="hidden" class="menu-item-url" name="menu-item['.esc_attr( $section_id ).'][menu-item-url]" value="#'.esc_attr( $custom_id ).'">
									<input type="hidden" class="menu-item-classes" name="menu-item['.esc_attr( $section_id ).'][menu-item-classes]" value="nav-anchor">
								</li>
								';
								
							}
							
			
						}
						
						//------------------------------------ end sections
		
						
				
					endforeach;
					
					echo '
						</ul>
					</div>
					';		
			
			
				}
					
	
			}
			
	
			wp_die();
	
		}	
		
	
	
	
	
		/**
		 * Adding meta box in Admin Menu page
		 *
		 * @https://developer.wordpress.org/reference/functions/add_meta_box/
		 *
		 */
		public static function nav_menu_meta_box() {
			add_meta_box( 
				'uix-pb-menu-onepage-links',
				__( 'Uix Page Builder Anchor Links', 'uix-pagebuilder' ),
				array( __CLASS__, 'display_menu_custom_box' ),
				'nav-menus', 
				'side', 
				'high' 
			);
		}
	
		 
		public static function display_menu_custom_box() {
			 
			 ?>
                <p>
                <select style=" width: 100%;" id="uix-pagebuilder-anchorlinks"> 
                 <option value="">
                <?php echo esc_attr( __( 'Select page', 'uix-pagebuilder' ) ); ?></option> 
                 <?php 
				$pages = get_pages(); 
				$pb_total = 0;
				foreach ( $pages as $page ) {
				
					if ( get_page_template_slug( $page->ID ) ==  'page-uix_pagebuilder.php' ) {
						$option = '<option value="'.esc_attr( $page->ID ).'">';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
						
						$pb_total = $pb_total + 1;
	
					}
				
				}
                 ?>
                </select>
                
                </p>    
             <?php
			 if ( !UixPageBuilder::tempfile_exists() || $pb_total == 0 ) {
				 _e( '<em>No custom pages based on Uix Page Builder.</em>', 'uix-pagebuilder' );
				 
			 } else {
				 printf( __( '<div style="background:#FCDBD6;border:1px solid #ECD5D8;-webkit-box-shadow:0 1px 1px 0 rgba(255,255,255,.1);box-shadow:0 1px 1px 0 rgba(255,255,255,.1);margin:5px 2px 12px 0;padding:8px 12px;border-color:#f5df52;background:#fcf7d4;box-shadow:inset 0 0 0 1px #ffffff,0 0 10px 0 rgba(0,0,0,0.05);"><strong>Usage Suggestions:</strong><br><br> Click on <a href="%1$s">Settings &raquo; Reading</a>. Select the option of Static Page, now select one of your page based on "Uix Page Builder" to be the homepage.</div>', 'uix-pagebuilder' ), esc_url( admin_url( 'options-reading.php' ) ) );
			?>
                <span id="uix_pagebuilder_anchorlinks_loader" style="display: none"><?php echo __( 'Loading...', 'uix-pagebuilder' ); ?></span>
				<div id="posttype-uix_pagebuilder_anchorlinks_options" class="posttypediv">

				    <span id="uix-pagebuilder-anchorlinks-result"></span>

					<p class="button-controls">
                        <span id="uix-pagebuilder-anchorlinks-selectall" style="display: none">
                            <span class="list-controls">
                                <a href="<?php echo esc_url( admin_url( 'nav-menus.php?page-tab=all&amp;selectall=1#posttype-uix_pagebuilder_anchorlinks_options' ) ); ?>" class="select-all"><?php _e( 'Select All', 'uix-pagebuilder' ); ?></a>
                            </span>

                        </span>
						<span class="add-to-menu" id="uix-pagebuilder-anchorlinks-addbtn" style="display: none">
							<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php echo esc_attr__( 'Add to Menu', 'uix-pagebuilder' ); ?>" name="add-post-type-menu-item" id="submit-posttype-uix_pagebuilder_anchorlinks_options">
							<span class="spinner"></span>
						</span>
					</p>
				</div>
			<?php
			 }
			
		}
		
	}
		
	
}


UixPB_Menu_Extensions_Onepage::init();
