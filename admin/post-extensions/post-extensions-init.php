<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/*
 * Save with Ajax
 * 
 */
if ( !function_exists( 'uix_page_builder_save' ) ) {
	add_action( 'wp_ajax_uix_page_builder_metaboxes_save_settings', 'uix_page_builder_save' );		
	function uix_page_builder_save() {
		check_ajax_referer( 'uix_page_builder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'layoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
			update_post_meta( $_POST[ 'postID' ], 'uix-page-builder-layoutdata', wp_unslash( $_POST[ 'layoutdata' ] ) );
		}
		
		wp_die();	
	}
}

if ( !function_exists( 'uix_page_builder_save_script' ) ) {
	add_action( 'admin_enqueue_scripts', 'uix_page_builder_save_script' );
	function uix_page_builder_save_script() {
        if ( get_post_type() == "page" ) {
			global $post;
			
			// Register the script
			wp_register_script( 'uix_page_builder_metaboxes_save_handle', UixPageBuilder::plug_directory() .'admin/js/core.js' );
			
			// Localize the script with new data
			$translation_array = array(
				'send_string_nonce' => wp_create_nonce( 'uix_page_builder_metaboxes_save_nonce' ),
				'send_string_postid' => $post->ID
			);
			
			
			wp_localize_script( 'uix_page_builder_metaboxes_save_handle', 'uix_page_builder_layoutdata', $translation_array );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'uix_page_builder_metaboxes_save_handle' );
	
		}
			
	}
}



/*
 * Display the Correct Metabox at the Correct Time
 * 
 */
if ( !function_exists( 'uix_page_builder_metaboxes_display_script' ) ) {
	add_action( 'admin_print_scripts', 'uix_page_builder_metaboxes_display_script', 1000 );
	function uix_page_builder_metaboxes_display_script() {
		global $metaboxes;
		if ( get_post_type() == "page" ) :
			?>
			<script type="text/javascript">
			( function( $ ) {
	 
				$(function() {
					
					
					var hidedivs    = [ '#postdivrich' ],
					    hideID      = '',
						selectedElt = $( "input[name='uix-page-builder-status']:checked" ).attr( 'id' ),
						pbID        = '#uix_page_builder_page_meta_pagerbuilder_container';
					$( '.postbox' ).each( function()  {
						if ( $( this ).attr( 'id' ).indexOf( 'dis_pagebuilder' ) >= 0 ) {
							hidedivs.push( '#' + $( this ).attr( 'id' ) );
						}
						
					});
					
					for (var i = 0, len = hidedivs.length; i < len; i++ ) {	
						hideID += hidedivs[ i ] + ',';
					}
					hideID = hideID.substring( 0, hideID.length-1 );
					
					
					if ( selectedElt == 'uix-page-builder-status2' ) {
						uixpagebuilderHide();
					} else {
						uixpagebuilderShow();
					}
					
					$( '#uix-page-builder-status1' ).on( 'click', function() {
						uixpagebuilderShow();
					});
					$( '#uix-page-builder-status2' ).on( 'click', function() {
						uixpagebuilderHide();
					});
					
					
					
					function uixpagebuilderHide() {
					    $( hideID ).slideDown( 300 ).css( 'width', '100%' );
						$( pbID ).slideUp( 300 );	
						uixpagebuilderInit();
					}
					function uixpagebuilderShow() {
					    $( hideID ).slideUp( 300 );
						$( pbID ).slideDown( 300 ).css( 'width', '100%' );
						uixpagebuilderInit();
					}				
					function uixpagebuilderInit() {
						$( 'html, body' ).animate( {scrollTop: 10 }, 100 );
						$( 'html, body' ).delay( 300 ).animate( {scrollTop: 5 }, 100 );
						$( '.uix-page-builder-gridster ul' ).css( 'width', '100%' );
					}				
								
					
				});
			
			} )( jQuery );
			</script>
			<?php
		endif;
	}		
	
}
if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_type' ) ) {
	
	add_action( 'admin_init', 'uix_page_builder_page_ex_metaboxes_pagerbuilder_type' );  
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_type(){  
		add_meta_box( 
			'uix_page_builder_page_meta_pagerbuilder_type', 
			__( '<i class="dashicons dashicons-editor-kitchensink"></i>&nbsp;&nbsp;Uix Page Builder Attributes', 'uix-page-builder' ), 
			'uix_page_builder_page_ex_metaboxes_pagerbuilder_type_options', 
			'page', 
			'side', 
			'high',
			null
		);  
	}  
}
   
if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_type_options' ) ) {
	
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_type_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce-pagebuilder' );
    ?>

    <div class="uix-metabox-group">
        <h3><?php _e( 'Page Builder Editor', 'uix-page-builder' ); ?></h3>
        <div class="uix-metabox-con">
            <p>
                 <label for="uix-page-builder-status">
                    <input name="uix-page-builder-status" id="uix-page-builder-status1" type="radio" value="enable" <?php echo ( get_post_meta( $object->ID, 'uix-page-builder-status', true ) == 'enable' ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Enable', 'uix-page-builder' ); ?>
                </label>
                
                <label for="uix-page-builder-status2">
                    <input name="uix-page-builder-status" id="uix-page-builder-status2" type="radio" value="disable" <?php echo ( get_post_meta( $object->ID, 'uix-page-builder-status', true ) == 'disable'  || empty( get_post_meta( $object->ID, 'uix-page-builder-status', true ) )  ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Disable', 'uix-page-builder' ); ?>
                </label>  
    
            </p>
        </div>

    </div>
    
    <div class="uix-metabox-group">
        <h3><?php _e( 'Automatically Generated Menu', 'uix-page-builder' ); ?></h3>
        <div class="uix-metabox-con">
            <p>
                
                <label for="uix-page-builder-nav">
                    <input name="uix-page-builder-nav" type="radio" value="enable" <?php echo ( get_post_meta( $object->ID, 'uix-page-builder-nav', true ) == 'enable' ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Enable', 'uix-page-builder' ); ?>
                </label>
                
                <label for="uix-page-builder-nav2">
                    <input name="uix-page-builder-nav" type="radio" value="disable" <?php echo ( get_post_meta( $object->ID, 'uix-page-builder-nav', true ) == 'disable'  || empty( get_post_meta( $object->ID, 'uix-page-builder-nav', true ) )  ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Disable', 'uix-page-builder' ); ?>
                </label>  
        
            </p>
            <p class="uix-metabox-note">
               <?php _e( 'If you have it enabled, this page menu anchor links will be generated automatically.', 'uix-page-builder' ); ?>
            </p>

        </div>

    
    </div>


        
<?php  
	}  
}


/*
 * Page Builder
 * 
 */ 
 
if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container' ) ) {
	
	add_action( 'admin_init', 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container' );  
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_container(){  
		add_meta_box( 
			'uix_page_builder_page_meta_pagerbuilder_container', 
			__( 'Uix Page Builder', 'uix-page-builder' ), 
			'uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options', 
			'page', 
			'normal', 
			'high',
			null
		);  
	}  

}
   

if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options' ) ) {
	
	function uix_page_builder_page_ex_metaboxes_pagerbuilder_container_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce-pagebuilder' );
	
		$old_layoutdata = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $object->ID, 'uix-page-builder-layoutdata', true ) );
		

    ?>
   
        <a class="button button-primary" href="javascript:gridsterAddWidget();"><?php _e( 'Add Section', 'uix-page-builder' ); ?></a>

        <div class="gridster uix-page-builder-gridster">
            <ul><?php
            if ( empty( $old_layoutdata ) ) {
				echo '<span id="uix-page-builder-layoutdata-none">';
				_e( 'Add section here.', 'uix-page-builder' );
				echo '</span>';
			}
			?>
            </ul>
        </div>
        
        <textarea name="uix-page-builder-layoutdata" id="uix-page-builder-layoutdata" ><?php echo esc_textarea( get_post_meta( $object->ID, 'uix-page-builder-layoutdata', true ) ); ?></textarea>

       
        <script type="text/javascript">
		    
			var gridsterWidth = 0;
	
			jQuery( function(){
			    gridsterWidth = jQuery( '#titlediv .inside' ).width() - 80;
				gridsterWidgetsInit();
				jQuery( window ).on( 'resize', function() {
					gridsterWidgetsInit();
		
				});
				
			});
				
				
				
			var gridster = null;
			var currently_editing = null;
			var currently_removing = null;
			var saved_data = '<?php echo json_encode( $old_layoutdata ); ?>';
			
			jQuery( function(){
				jQuery( '.gridster ul' ).gridster({
					widget_base_dimensions : [ gridsterWidth, 80 ],
					widget_margins         : [10, 15],
					resize                 : {
						enabled: false
					},
					draggable: {
						stop: function() {
						    uixPBFormDataSave();	
						}
					},
					serialize_params: function( $w, wgd ){ 
						var obj = {
							col: wgd.col, 
							row: wgd.row, 
							size_x: wgd.size_x, 
							size_y: wgd.size_y, 
							content: jQuery( $w[0] ).find( '.content-box' ).val(),
							title: jQuery( $w[0] ).find( '.title-box' ).val()
						} ;
						return obj;
					}
				});
				
				//save with ajax
				jQuery( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
					e.preventDefault();
					
					setTimeout( function() {
						var settings = jQuery( "[name='uix-page-builder-layoutdata']" ).val();
						//console.log( settings );
				
						// retrieve the widget settings form
						jQuery.post( ajaxurl, {
							action               : 'uix_page_builder_metaboxes_save_settings',
							layoutdata           : settings,
							postID               : uix_page_builder_layoutdata.send_string_postid,
							security             : uix_page_builder_layoutdata.send_string_nonce
						}, function ( response ) {
							
						});
	
					}, 500 );
				});

				gridster = jQuery( '.gridster ul' ).gridster().data( 'gridster' );
		

				saved_data = JSON.parse( saved_data );
				
				
				for(var iii = 0; iii < saved_data.length; iii++) {
					
					var uid       = gridsterContentID( saved_data[iii].content ),
					    titleid   = 'title-data-'+uid,
					    contentid = 'content-data-'+uid;
					
					gridster.gridsterAddWidget( '<li class="uix-page-builder-gridster-widget" data-id="'+uid+'" data-row="'+saved_data[iii].row+'" data-col="'+saved_data[iii].col+'" data-sizex="'+saved_data[iii].size_x+'" data-sizey="'+saved_data[iii].size_y+'"><div class="uix-page-builder-gridster-drag"><input type="text" placeholder="<?php _e( 'Title', 'uix-page-builder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="'+ saved_data[iii].title +'"></div><button class="remove-gridster-widget" onclick="gridsterRemoveWidget(event);"><i class="dashicons dashicons-no"></i></button><button class="edit-gridster-widget" data-target="'+contentid+'" onclick="gridsterEditWidget(event);"><i class="dashicons dashicons-edit"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'">'+gridsterHtmlUnescape( saved_data[iii].content )+'</textarea><div class="widget-items-container"><?php UixPageBuilder::list_page_buttons();?></div></li>', 1, 1 );
					     
				}
				
				gridsterWidgetsInit();
				
			});


			
			function gridsterAddWidget() {
				
				var gLi = jQuery( '.gridster ul > li' ).length;
				    gLi = gLi + 1,
					titleid = 'title-data-'+gLi,
					contentid = 'content-data-'+gLi,
					uid  = gLi;
				
				
				gridster.gridsterAddWidget( '<li class="uix-page-builder-gridster-widget" data-id="'+gLi+'"><div class="uix-page-builder-gridster-drag"><input type="text" placeholder="<?php _e( 'Title', 'uix-page-builder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="<?php _e( 'Title', 'uix-page-builder' ); ?> '+uid+'"></div><button class="remove-gridster-widget" onclick="gridsterRemoveWidget(event);"><i class="dashicons dashicons-no"></i></button><button class="edit-gridster-widget" data-target="'+contentid+'" onclick="gridsterEditWidget(event);"><i class="dashicons dashicons-edit"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'"></textarea><div class="widget-items-container"><?php UixPageBuilder::list_page_buttons();?></div></li>', 1, 1 ).fadeIn( 100, function() {
						gridsterInputsave();
				});
				uixPBFormDataSave();
				gridsterWidgetsInit();
				jQuery( '#uix-page-builder-layoutdata-none' ).hide();
			}

			function gridsterRemoveWidget(e){
				jQuery( function(){
					currently_removing = e.srcElement.parentNode;
					var thisWidget    = jQuery( currently_removing ).parent( '.uix-page-builder-gridster-widget' ); 
						
					gridster.gridsterRemoveWidget( thisWidget );
						
					uixPBFormDataSave();
	
				} );
				e.preventDefault();
			}

			function uixPBFormDataSave(){
				var json_str = JSON.stringify( gridster.serialize() );
				json_str = json_str.replace(/\\n/g, '<br>' ).replace(/\\r/g, '' ).replace(/\\/g, '' );
				document.getElementById( 'uix-page-builder-layoutdata' ).value = json_str;
				gridsterWidgetStatus();
				
			}
			function gridsterWidgetStatus(){
				jQuery( document ).ready( function() {  
					jQuery( '.gridster ul > li' ).each( function() {
						var $this = jQuery( this );
						if ( $this.find( '.content-box' ).val() != '') {
							$this.addClass( 'active' );
						} else {
							$this.removeClass( 'active' );
						}
					});
				
				});
				
			}	
			
			
            function gridsterEditWidget(e) {
				jQuery( function(){
					currently_editing = e.srcElement.parentNode;
					var thisWidget    = jQuery( currently_editing ).parent( '.uix-page-builder-gridster-widget' ),
						thisID        = thisWidget.data( 'id' ),
						oldValue      = gridsterHtmlUnescape( thisWidget.find( '.content-data-'+thisID ).val() ); 
					
					thisWidget.find( '.content-data-'+thisID ).focus().show();
					
	
				} );
                e.preventDefault();
            }

           
			
			function gridsterInputsave(){
				jQuery( document ).ready( function() {  
					jQuery( '.gridster ul > li' ).each( function() {
						var $this = jQuery( this );
						$this.find( '.content-box, .title-box' ).on( 'input change keyup', function() {
							$this.find( 'content-data' ).html( jQuery( this ).val() );
							uixPBFormDataSave();
						});
	
					});
				
				});

			}	
			
	
			function gridsterWidgetsInit() {
				jQuery( '.uix-page-builder-gridster-widget' ).css( 'width', jQuery( '#titlediv .inside' ).width() - 80 + 'px' );
			}
			

			function gridsterHtmlUnescape( str ){
				return str
					.replace(/&quot;/g, '"')
					.replace(/&#39;/g, "'")
					.replace(/&lt;/g, '<')
					.replace(/&gt;/g, '>');
					
					
			}
			function gridsterHtmlUnescape( str ){
				return str
					.replace(/"/g, '&quot;')
					.replace(/'/g, "&#39;")
					.replace(/</g, '&lt;')
					.replace(/>/g, '&gt;');
			}
			
		    function gridsterContentID( str ){
				var nstr = str
				           .replace(/\$__\$/g, '"');
						   
				var tmpStr  = nstr.match("\"row\",\"(.*)\"]");
				
				if( Object.prototype.toString.call( tmpStr ) === '[object Array]' && str.length > 0){
					return tmpStr[1][0];
				} else {
					return 0;
				}
				
			}
			
			gridsterInputsave();	
			gridsterWidgetStatus();
			


        </script>
        
<?php  
	}  
}


 
/*
 * Saving the Custom Data
 * 
 */ 
if ( !function_exists( 'uix_page_builder_page_save_custom_meta_box' ) ) {
	
	add_action( 'save_post', 'uix_page_builder_page_save_custom_meta_box', 10, 3);
	function uix_page_builder_page_save_custom_meta_box( $post_id, $post, $update ) {
		if ( !isset( $_POST[ 'meta-box-nonce-pagebuilder' ] ) || !wp_verify_nonce($_POST[ 'meta-box-nonce-pagebuilder' ], basename( __FILE__ ) ) ) return $post_id;
		if( !current_user_can( 'edit_post', $post_id ) )return $post_id;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
		$slug = "page";
		if( $slug != $post->post_type ) return $post_id;
		
	
		$layoutdata 	                         = wp_unslash( $_POST[ 'uix-page-builder-layoutdata' ] );
		$buildernav 	                         = sanitize_text_field( $_POST[ 'uix-page-builder-nav' ] );
		$builderstatus 	                     = sanitize_text_field( $_POST[ 'uix-page-builder-status' ] );
		
		
		if( isset( $_POST[ 'uix-page-builder-layoutdata' ] ) ) update_post_meta( $post_id, 'uix-page-builder-layoutdata', $layoutdata );
		if( isset( $_POST[ 'uix-page-builder-nav' ] ) ) update_post_meta( $post_id, 'uix-page-builder-nav', $buildernav );
		if( isset( $_POST[ 'uix-page-builder-status' ] ) ) update_post_meta( $post_id, 'uix-page-builder-status', $builderstatus );
		
		
	
	}

}






 