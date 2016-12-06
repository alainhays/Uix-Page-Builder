<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/*
 * Save with Ajax
 * 
 */
if ( !function_exists( 'uix_pagebuilder_save' ) ) {
	add_action( 'wp_ajax_uix_pagebuilder_metaboxes_save_settings', 'uix_pagebuilder_save' );		
	function uix_pagebuilder_save() {
		check_ajax_referer( 'uix_pagebuilder_metaboxes_save_nonce', 'security' );
		
		if ( isset( $_POST[ 'layoutdata' ] ) && isset( $_POST[ 'postID' ] ) ) {
			update_post_meta( $_POST[ 'postID' ], 'uix-pagebuilder-layoutdata', wp_unslash( $_POST[ 'layoutdata' ] ) );
		}
		
		wp_die();	
	}
}

if ( !function_exists( 'uix_pagebuilder_save_script' ) ) {
	add_action( 'admin_enqueue_scripts', 'uix_pagebuilder_save_script' );
	function uix_pagebuilder_save_script() {
        if ( get_post_type() == "page" ) {
			global $post;
			
			// Register the script
			wp_register_script( 'uix_pagebuilder_metaboxes_save_handle', UixPageBuilder::plug_directory() .'admin/js/core.js' );
			
			// Localize the script with new data
			if ( UixPageBuilder::tempfile_exists() ) {
				$tempfile_exists = 1;
			} else {
				$tempfile_exists = 0;
			}
			$translation_array = array(
				'send_string_nonce'            => wp_create_nonce( 'uix_pagebuilder_metaboxes_save_nonce' ),
				'send_string_postid'           => $post->ID,
				'send_string_tempfiles_exists' => $tempfile_exists
			);
			
			
			wp_localize_script( 'uix_pagebuilder_metaboxes_save_handle', 'uix_pagebuilder_layoutdata', $translation_array );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'uix_pagebuilder_metaboxes_save_handle' );
	
		}
			
	}
}



/*
 * Display the Core Metabox
 * 
 */
if ( !function_exists( 'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_type' ) ) {
	
	add_action( 'admin_init', 'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_type' );  
	function uix_pagebuilder_page_ex_metaboxes_pagerbuilder_type(){  
		add_meta_box( 
			'uix_pagebuilder_page_meta_pagerbuilder_type', 
			__( '<i class="dashicons dashicons-editor-kitchensink"></i>&nbsp;&nbsp;Uix Page Builder Attributes', 'uix-pagebuilder' ), 
			'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_type_options', 
			'page', 
			'side', 
			'high',
			null
		);  
	}  
}
   
if ( !function_exists( 'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_type_options' ) ) {
	
	function uix_pagebuilder_page_ex_metaboxes_pagerbuilder_type_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce-pagebuilder' );
    ?>

    <div class="uix-metabox-group">
        <h3><?php _e( 'Page Builder Editor', 'uix-pagebuilder' ); ?></h3>
        <div class="uix-metabox-con">
            <p>
                 <label for="uix-pagebuilder-status">
                    <input name="uix-pagebuilder-status" id="uix-pagebuilder-status1" type="radio" value="enable" <?php echo ( get_post_meta( $object->ID, 'uix-pagebuilder-status', true ) == 'enable' ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Enable', 'uix-pagebuilder' ); ?>
                </label>
                
                <label for="uix-pagebuilder-status2">
                    <input name="uix-pagebuilder-status" id="uix-pagebuilder-status2" type="radio" value="disable" <?php echo ( get_post_meta( $object->ID, 'uix-pagebuilder-status', true ) == 'disable'  || empty( get_post_meta( $object->ID, 'uix-pagebuilder-status', true ) )  ) ? esc_attr( 'checked' ) : ''; ?> /><?php _e( 'Disable', 'uix-pagebuilder' ); ?>
                </label>  
    
            </p>
        </div>

    </div>
    
    <div class="uix-metabox-group">
        <h3><?php _e( 'How To Create The One-Page Navigation? Here is an example:', 'uix-pagebuilder' ); ?></h3>
        <div class="uix-metabox-con">
            <p>
             <?php _e( '1. Move the mouse over per row, you can enter <code>my-portfolio</code> in the Custom ID field on the right.', 'uix-pagebuilder' ); ?></p>
             <p>
             <?php printf( __( '2. Create a new <a href="%1$s">menu</a>, and add a Custom Link for each menu item you plan on having. For each menu item, enter an id that you will assign later to the corresponding section. For example, for the menu item <code>My Portfolio</code>, you would enter <code>#my-portfolio</code> in the URL field.', 'my-text-domain' ), admin_url( "nav-menus.php" ) ); ?>
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
 
if ( !function_exists( 'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_container' ) ) {
	
	add_action( 'admin_init', 'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_container' );  
	function uix_pagebuilder_page_ex_metaboxes_pagerbuilder_container(){  
		add_meta_box( 
			'uix_pagebuilder_page_meta_pagerbuilder_container', 
			__( 'Uix Page Builder', 'uix-pagebuilder' ), 
			'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_container_options', 
			'page', 
			'normal', 
			'high',
			null
		);  
	}  

}
   

if ( !function_exists( 'uix_pagebuilder_page_ex_metaboxes_pagerbuilder_container_options' ) ) {
	
	function uix_pagebuilder_page_ex_metaboxes_pagerbuilder_container_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce-pagebuilder' );
		
	
		$old_layoutdata = get_post_meta( $object->ID, 'uix-pagebuilder-layoutdata', true );
		

    ?>
   
        <div class="uix-pagebuilder-gridster-addbtn">
            <a class="button" href="javascript:gridsterAddRow();"><i class="dashicons dashicons-plus"></i><?php _e( 'Add Section', 'uix-pagebuilder' ); ?></a>

        </div>
        
        <div class="gridster uix-pagebuilder-gridster">
            <ul><?php
            if ( empty( UixPageBuilder::pagebuilder_array_newlist( $old_layoutdata ) ) ) {
				echo '<span id="uix-pagebuilder-layoutdata-none">';
				_e( 'Add section here.', 'uix-pagebuilder' );
				echo '</span>';
			}
			?>
            </ul>
        </div>
         
        
        <textarea name="uix-pagebuilder-layoutdata" id="uix-pagebuilder-layoutdata" ><?php echo esc_textarea( $old_layoutdata ); ?></textarea>
       
        <script type="text/javascript">
		/*! 
		 * 
		 * Gridster Core
		 * ---------------------------------------------------
		 */
		var gridsterWidth = 0,
		    oww           = 0;
		
		
		jQuery( document ).ready( function() {
			gridsterWidth = ( jQuery( '#titlediv .inside' ).width() - 80 ) - 40;
			oww           = jQuery( window ).width();
			gridsterWidgetsInit();
			jQuery( window ).on( 'resize', function() {
				gridsterWidgetsInit();
		
			});
			
		});
			
			
			
		var gridster = null;
		var currently_editing = null;
		var currently_removing = null;
		var saved_data = '<?php echo json_encode( UixPageBuilder::pagebuilder_array_newlist( $old_layoutdata ) ); ?>';
		
		jQuery( document ).ready( function() {
			
			var layoutdata = jQuery( "[name='uix-pagebuilder-layoutdata']" ).val();
			
			jQuery( '.gridster ul' ).gridster({
				widget_base_dimensions : [ gridsterWidth, 80 ],
				widget_margins         : [ 16, 25 ],
				resize                 : {
					enabled: false
				},
				draggable: {
					handle: '.uix-pagebuilder-gridster-drag',
					stop: function( e, ui, $widget ) {
						uixPBFormDataSave();	
						var newpos = this.serialize($widget)[0];
						var thispos = ui.$player[0].dataset;
					    //console.log('draggable stop thispos = ' + JSON.stringify(thispos));
					    //console.log( "New col: " + newpos.col + " New row: " + newpos.row );
					}
				},
				serialize_params: function( $w, wgd ){ 
					var obj = {
						col         : wgd.col, 
						row         : wgd.row, 
						size_x      : wgd.size_x, 
						size_y      : wgd.size_y, 
						content     : jQuery( $w[0] ).find( '.content-box' ).val(),
						secindex    : jQuery( $w[0] ).find( '.sid-box' ).val(),
						customid    : gridsterStrToSlug( jQuery( $w[0] ).find( '.cusid-box' ).val() ),
						title       : jQuery( $w[0] ).find( '.title-box' ).val()
						
					} ;
					return obj;
				}
			});
			
		
			gridster = jQuery( '.gridster ul' ).gridster().data( 'gridster' );
		
		
			saved_data = JSON.parse( saved_data );
			
			
			for(var iii = 0; iii < saved_data.length; iii++) {
				
				var uid        = gridsterContent( saved_data[iii].content, 'id', saved_data[iii].secindex ),
					titleid    = 'title-data-'+uid,
					contentid  = 'content-data-'+uid;
			
				gridster.gridsterAddWidget( '<li class="uix-pagebuilder-gridster-widget" data-id="'+uid+'" data-row="'+saved_data[iii].row+'" data-col="'+saved_data[iii].col+'" data-sizex="'+saved_data[iii].size_x+'" data-sizey="'+saved_data[iii].size_y+'"><div class="uix-pagebuilder-gridster-drag"><i class="dashicons dashicons-sort"></i><input type="text" placeholder="<?php _e( 'Section', 'uix-pagebuilder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="'+ gridsterHtmlEscape( saved_data[iii].title ) +'"><span class="cusid-wrapper"><?php _e( 'Custom ID: ', 'uix-pagebuilder' ); ?><input type="text" size="10" class="cusid-box" value="'+saved_data[iii].customid+'"></span><input type="hidden" class="sid-box" value="'+saved_data[iii].secindex+'"></div><button class="remove-gridster-widget" onclick="gridsterRemoveWidget(event);"><i class="dashicons dashicons-no"></i></button><button class="edit-gridster-widget" data-target="'+contentid+'" onclick="gridsterEditWidget(event);"><i class="dashicons dashicons-edit"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-pagebuilder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'">'+gridsterHtmlUnescape( saved_data[iii].content )+'</textarea><?php UixPageBuilder::list_page_itembuttons();?></li>', saved_data[iii].size_x, saved_data[iii].size_y, saved_data[iii].col, saved_data[iii].row );
				
				
				if ( saved_data[iii].content != '' ) {
					
					var allcontent = gridsterContent( saved_data[iii].content, 'content', '' );
					
					//Transit the replacement value
					jQuery( '#cols-all-content-replace-' + uid ).val( saved_data[iii].content.replace( allcontent, '{allcontent}' ) );	
					 
				
							
					//Default value & form show
					var conLen          = gridsterColsContent( allcontent, 'length', 1 ),
						default_value   = [],
						list_code       = '',
						colid           = '',
						cid             = [ '3_4', '1_4', '2_3', '1_3', '4__1', '4__2', '4__3', '4__4', '3__1', '3__2', '3__3', '2__1', '2__2', '1__1' ];
							
					
					for ( var k = 1; k <= conLen; k ++ ) {
						default_value.push( gridsterColsContent( allcontent, 'content', k ) );
						
						for( var i in cid ) {
							if ( gridsterColsContent( allcontent, 'content', k ).indexOf( 'col-item-'+cid[i] ) >= 0  ) {
								colid  = cid[i];
								list_code += gridsterItemAddRowPer( uid, contentid, cid[i] );
								
								if ( colid == '3_4' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '3_4' );?>
								}
								if ( colid == '1_4' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '1_4' );?>
								}
								if ( colid == '2_3' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '2_3' );?>
								}
								if ( colid == '1_3' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '1_3' );?>
								}
								if ( colid == '4__1' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '4__1' );?>
								}
								if ( colid == '4__2' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '4__2' );?>
								}
								if ( colid == '4__3' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '4__3' );?>
								}
								if ( colid == '4__4' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '4__4' );?>
								}
								if ( colid == '3__1' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '3__1' );?>
								}
								if ( colid == '3__2' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '3__2' );?>
								}
								if ( colid == '3__3' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '3__3' );?>
								}
								if ( colid == '2__1' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '2__1' );?>
								}
								if ( colid == '2__2' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '2__2' );?>
								}
								if ( colid == '1__1' ) {
									<?php UixPageBuilder::list_page_sortable_li_btns( '1__1' );?>
								}



							}
							
						}

						
					}
					
					
					
					list_code = '<div class="sortable-list-container sortable-list-container-'+uid+'" data-elements-id="widget-items-elements-'+colid+'-'+uid+'" data-allcontent-tempid="cols-all-content-tempdata-'+uid+'" data-allcontent-replace-tempid="cols-all-content-replace-'+uid+'"  data-contentid="'+contentid+'"><ul class="sortable-list">'+list_code+'</ul></div>';
					
					gridsterItemAddRow( 1, uid, contentid, '', default_value, list_code );	
	
	
					

				}

					 
			}//end for
			
		
			gridsterWidgetsInit();
			
			
			//save with ajax
			jQuery( document ).on( 'click', '.uixpbform-modal-save-btn', function( e ) {
				e.preventDefault();
				
				setTimeout( function() {
					var settings = jQuery( "[name='uix-pagebuilder-layoutdata']" ).val();
					//console.log( settings );
			
					// retrieve the widget settings form
					jQuery.post( ajaxurl, {
						action               : 'uix_pagebuilder_metaboxes_save_settings',
						layoutdata           : settings,
						postID               : uix_pagebuilder_layoutdata.send_string_postid,
						security             : uix_pagebuilder_layoutdata.send_string_nonce
					}, function ( response ) {
						
						//Per column section buttons status
						gridsterItemElementsBTStatus( 1 );
						
					});
					
		
				}, 500 );
			});	
			
			
		});
		
		
		
		gridsterInputsave();	
		gridsterWidgetStatus();
		
		/*! 
		 * 
		 * Gridster Functions
		 * ---------------------------------------------------
		 */
		
		function gridsterAddRow() {
			
		
			var gLi = jQuery( '.gridster ul > li' ).length;
				gLi = gLi + 1,
				titleid = 'title-data-'+gLi,
				contentid = 'content-data-'+gLi,
				uid  = gLi;
		
			
			gridster.gridsterAddWidget( '<li class="uix-pagebuilder-gridster-widget" data-id="'+uid+'"><div class="uix-pagebuilder-gridster-drag"><i class="dashicons dashicons-sort"></i><input type="text" placeholder="<?php _e( 'Section', 'uix-pagebuilder' ); ?>" class="title-box '+titleid+'" id="'+titleid+'" value="<?php _e( 'Section', 'uix-pagebuilder' ); ?> '+uid+'"><span class="cusid-wrapper"><?php _e( 'Custom ID: ', 'uix-pagebuilder' ); ?><input type="text" size="10" class="cusid-box" value="section-'+uid+'"></span><input type="hidden" class="sid-box" value="'+uid+'"></div><button class="remove-gridster-widget" onclick="gridsterRemoveWidget(event);"><i class="dashicons dashicons-no"></i></button><button class="edit-gridster-widget" data-target="'+contentid+'" onclick="gridsterEditWidget(event);"><i class="dashicons dashicons-edit"></i></button><textarea placeholder="<?php _e( 'HTML Code...', 'uix-pagebuilder' ); ?>" class="content-box '+contentid+'" id="'+contentid+'"></textarea><?php UixPageBuilder::list_page_itembuttons();?></li>', 1, 1 ).fadeIn( 100, function() {
					gridsterInputsave();
			});
			
			//Default value & form show
			uixPBFormDataSave();
			gridsterWidgetsInit();
			jQuery( '#uix-pagebuilder-layoutdata-none' ).hide();
	

		}
		
		function gridsterRemoveWidget(e){
			jQuery( document ).ready( function() {
				currently_removing = e.srcElement.parentNode;
				var thisWidget    = jQuery( currently_removing ).parent( '.uix-pagebuilder-gridster-widget' ); 
					
				gridster.gridsterRemoveWidget( thisWidget );
					
				uixPBFormDataSave();
		
			} );
			e.preventDefault();
		}
		
		function uixPBFormDataSave(){
			jQuery( document ).ready( function() {  
				var json_str = JSON.stringify( gridster.serialize() );
				json_str = json_str.replace(/\\n/g, '<br>' ).replace(/\\r/g, '' ).replace(/\\/g, '' );
				
				jQuery( '#uix-pagebuilder-layoutdata' ).val( json_str );
				gridsterWidgetStatus();

			});
			
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
			jQuery( document ).ready( function() {
				currently_editing = e.srcElement.parentNode;
				var thisWidget    = jQuery( currently_editing ).parent( '.uix-pagebuilder-gridster-widget' ),
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
					$this.find( '.content-box, .title-box, .cusid-box' ).on( 'change keyup', function() {
						uixPBFormDataSave();
					});
		
				});
			
			});
		
		}	
		
		
		function gridsterWidgetsInit() {
			jQuery( document ).ready( function() {  
				var ow = ( jQuery( '#titlediv .inside' ).width() - 80 ) - 40;
				jQuery( '.uix-pagebuilder-gridster-widget' ).css( {'width': ow + 'px' } );
			});	
		}
		
		
		function gridsterHtmlUnescape( str ){
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				return str
					.replace(/&quot;/g, '"')
					.replace(/&#39;/g, "'")
					.replace(/&lt;/g, '<')
					.replace(/&gt;/g, '>');
	
			}
				
		}
		function gridsterHtmlEscape( str ){
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				return str
					.replace(/"/g, '&quot;')
					.replace(/'/g, "&#39;")
					.replace(/</g, '&lt;')
					.replace(/>/g, '&gt;');
	
			}
		}
	
		function gridsterStrToSlug( str ){
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				var pattern = new RegExp("[`~!+%@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）&;|{}【】\"；：”“'。，、？]");
				var rs = ""; 
				for (var i = 0; i < str.length; i++) { 
					rs = rs+str.substr( i, 1 ).replace( pattern, '' ); 
				} 
				
				rs = rs.replace(/ /g, '-').toLowerCase();
				return rs;
	
			}
		}
	
		function gridsterContent( str, type, repstr ){
			
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				
				var nstr   = str.replace(/{rqt:}/g, '"');
				
				if ( type == 'id' ) {
					var result = nstr.match( /row\",\"(.+?)\"\]/g );
					
					if ( result != null ) {
						return result[0].replace( 'row","', '' )
									   .replace( '"]', '' );
	
					}
					

	
				}
				if ( type == 'name' ) {
					var result = nstr.match( /widgetname\",\"(.+?)\"\]/g );
					
					if ( result != null ) {
						return result[0].replace( 'widgetname","', '' )
									   .replace( '"]', '' );
					}

				}	
				if ( type == 'content' ) {
					var result = nstr.match( /rowcontent\",\"(.+?)\"\]/g );
					
					if ( result != null ) {
						return result[0].replace( 'rowcontent","', '' )
									   .replace( '"]', '' );	
					}
				}
	
			} else {
				return repstr;
			}
			
		}
		
		function gridsterColsContent( str, type, index ){
			
			if ( index < 1 ) index = 1;
			
			index = index - 1;
			
			
			if ( typeof( str ) == 'string' && str.length > 0 ) {
				var nstr   = str.replace(/{rowqt:}/g, '"'),
				    result = '';
				nstr = eval( nstr );
				
				
				
				//item array
				var ia         = nstr[index],
				    rescontent = [];
				for( var j in ia ) {
					rescontent.push( '[{rqt:}'+ia[j][0]+'{rqt:},{rqt:}'+ia[j][1]+'{rqt:}]' );
				}
				
				if ( type == 'length' ) {
					result = nstr.length;
				}
					
				if ( type == 'col' ) {
					result = nstr[index][0][1];
				}
				if ( type == 'name' ) {
					result =  nstr[index][1][0];
				}	
				
				if ( type == 'form_id' ) {
					var r = nstr[index][1][0],
					    a = r.split("|");
						
					result =  a[0];
				}		
				
				if ( type == 'content' ) {
					result =  '{'+nstr[index][0][1]+'}['+rescontent+']';	
				}		
	            
				return result;
				
			} else {
				return '';
			}
			
		}	
		
		
		
		
		/*! 
		 * 
		 * Sortable Item
		 * ---------------------------------------------------
		 */
		 var item_sortable = '.sortable-list-container';
		function gridsterItemSortableInit( uid ){
			 jQuery( document ).ready( function() {
				
				jQuery( item_sortable + '-'+uid+' .sortable-list' ).sortable({
					start: function(event, ui) {
						var start_pos = ui.item.index();
						ui.item.data( 'start_pos', start_pos );
						
					},
					change : function(event, ui) {
						
						var start_pos = ui.item.data('start_pos');
						var index = ui.placeholder.index();
						if (start_pos < index) {
							jQuery( item_sortable + '-'+uid+' li:nth-child(' + index + ')' ).addClass( 'list-group-item-success' );
						} else {
							jQuery( item_sortable + '-'+uid+' li:eq(' + (index + 1) + ')' ).addClass( 'list-group-item-success' );
						}
						
						
			
					},
			
					update: function( event, ui ) {
						gridsterItemSave( uid );
						uixPBFormDataSave();
						jQuery( item_sortable + '-'+uid+' li' ).removeClass( 'list-group-item-success' );
			
					}
				});
				
				
				gridsterItemSave( uid );
				

				
			 });

		} 
		
		function gridsterItemSave( uid ) {
			jQuery( document ).ready( function() {  
				var result           = [],
					allcontentID     = '',
					allcontentRpID   = '',
					sectionContentID = '',
					total            = jQuery( item_sortable + '-'+uid+' li' ).length;
			
				jQuery( item_sortable + '-'+uid+' li' ).each(function( index ){
					var data                = jQuery( this ).find( 'textarea' ).val(),
						id                  = index + 1,
						classname           = jQuery( this ).attr( 'class' ),
						last                = ( id == total ) ? 'uix-pb-col-last' : '';
				
					if ( data == null ) data = '';
					allcontentID       = jQuery( this ).parent().parent().data( 'allcontent-tempid' );
					allcontentRpID       = jQuery( this ).parent().parent().data( 'allcontent-replace-tempid' );
					sectionContentID   = jQuery( this ).parent().parent().data( 'contentid' );
					
					result.push( data );
					
				});
				
				
			
				jQuery( '#' + allcontentID ).val( result );
				
				
				//Save All content
				if ( jQuery( '#' + allcontentRpID ).length > 0 ) {
					result = uixpbform_formatAllCodes( result );
				    var old = jQuery( '#' + allcontentRpID ).val();
		            var newv = old.replace( '{allcontent}', '['+result+']' );
					jQuery( '#' + sectionContentID ).val( newv );	
				}
			
				

			});
				
		}	 

		 
		function gridsterItemAddRow( add, uid, contentid, col, content, list ) {
			jQuery( document ).ready( function() {  
				var result        = '',
				    average_code  = '',
					colid         = col,
				    sid           = contentid.replace( 'content-data-', '' );
				
				
				//default value
				gridsterItemRowTextareaInit( content, uid );
	
				//output html code
				if ( add == 1 ) {
					jQuery( '#cols-content-data-'+uid+'' ).html( list );	
				}
				
				if ( add == 0 ) {
					result += '<div class="sortable-list-container sortable-list-container-'+uid+'" data-elements-id="widget-items-elements-'+col+'-'+uid+'" data-allcontent-tempid="cols-all-content-tempdata-'+uid+'" data-allcontent-replace-tempid="cols-all-content-replace-'+uid+'"  data-contentid="'+contentid+'"><ul class="sortable-list">';
		
					// 3_4-1_4 column
					if ( col == '3_4' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '3_4' );?><?php UixPageBuilder::list_page_sortable_li( '1_4' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '3_4' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_4' );?>
					}	
			
					
					// 1_4-3_4 column
					if ( col == '1_4' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '1_4' );?><?php UixPageBuilder::list_page_sortable_li( '3_4' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_4' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '3_4' );?>
		
					}	
					
					// 2_3-1_3 column
					if ( col == '2_3' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '2_3' );?><?php UixPageBuilder::list_page_sortable_li( '1_3' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '2_3' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_3' );?>
					}	
					
					
					// 1_3-2_3 column
					if ( col == '1_3' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '1_3' );?><?php UixPageBuilder::list_page_sortable_li( '2_3' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '1_3' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '2_3' );?>	
					}		
					
					// 4 column
					if ( col == '4__1' || col == '4__2' || col == '4__3' || col == '4__4' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '4__1' );?><?php UixPageBuilder::list_page_sortable_li( '4__2' );?><?php UixPageBuilder::list_page_sortable_li( '4__3' );?><?php UixPageBuilder::list_page_sortable_li( '4__4' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__1' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__2' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__3' );?>
						<?php UixPageBuilder::list_page_sortable_li_btns( '4__4' );?>
					}	
					
					// 3 column
					if ( col == '3__1' || col == '3__2' || col == '3__3' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '3__1' );?><?php UixPageBuilder::list_page_sortable_li( '3__2' );?><?php UixPageBuilder::list_page_sortable_li( '3__3' );?>';
						<?php UixPageBuilder::list_page_sortable_li_btns( '3__1' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '3__2' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '3__3' );?>	
					}
					// 2 column
					if ( col == '2__1' || col == '2__2' ) {
						result += '<?php UixPageBuilder::list_page_sortable_li( '2__1' );?><?php UixPageBuilder::list_page_sortable_li( '2__2' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '2__1' );?>	
						<?php UixPageBuilder::list_page_sortable_li_btns( '2__2' );?>	
					}
					
					// 1 column
					if ( col == '1__1' ) {	
						result += '<?php UixPageBuilder::list_page_sortable_li( '1__1' );?>';	
						<?php UixPageBuilder::list_page_sortable_li_btns( '1__1' );?>	
					}
					
					result += '</ul></div>';	
					
					jQuery( '#cols-content-data-'+uid+'' ).html( result );
					
				}
					

				//re-sortable
				gridsterItemSortableInit( uid );
				
				setTimeout(function(){
					
					//hide layout button
					jQuery( '.uix-pagebuilder-gridster-widget' ).each( function() {
						var c = jQuery( this ).find( '.temp-data-1' ).val();
						if ( c.length > 0 ) {
							if ( jQuery( this ).data( 'id' ) == uid ) {
								jQuery( this ).find( '.widget-items-col-container' ).hide();
							}
						}
						
					} );	
				
					
					
				}, 100);
				
				
				
	
			});
		}

		function gridsterItemAddRowPer( uid, contentid, col ) {
			var average_code  = '',
				sid           = contentid.replace( 'content-data-', '' );
			
		
			if ( col == '3_4' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3_4' );?>';
			if ( col == '1_4' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '1_4' );?>';
			if ( col == '2_3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '2_3' );?>';
			if ( col == '1_3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '1_3' );?>';
			if ( col == '4__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__1' );?>';
			if ( col == '4__2' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__2' );?>';
			if ( col == '4__3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__3' );?>';
			if ( col == '4__4' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '4__4' );?>';
			if ( col == '3__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3__1' );?>';
			if ( col == '3__2' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3__2' );?>';
			if ( col == '3__3' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '3__3' );?>';
			if ( col == '2__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '2__1' );?>';
			if ( col == '2__2' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '2__2' );?>';
			if ( col == '1__1' ) average_code = '<?php UixPageBuilder::list_page_sortable_li( '1__1' );?>';
			
			
			return average_code;

		}

		function gridsterItemRowTextareaInit( str, uid ) {
			jQuery( document ).ready( function() {  
				if ( Object.prototype.toString.call( str ) === '[object Array]' ) {
					
					var result = ''
					    cid    = [ '3_4', '1_4', '2_3', '1_3', '4__1', '4__2', '4__3', '4__4', '3__1', '3__2', '3__3', '2__1', '2__2', '1__1' ];
							
					for( var j in str ) {
						
						for( var i in cid ) {
							if ( str[j].indexOf( cid[i] ) >= 0  ) {
			
								result = str[j];
								result = result.replace( '{'+cid[i]+'}', '' );	
								
								jQuery( '#col-item-'+cid[i]+'---' + uid ).val( gridsterHtmlUnescape( result ) );
								
							}
	
						}
	
					}
			
					
				}

			});
		}
		
		
        </script>
        
<?php  
	}  
}


 
/*
 * Saving the Custom Data
 * 
 */ 
if ( !function_exists( 'uix_pagebuilder_page_save_custom_meta_box' ) ) {
	
	add_action( 'save_post', 'uix_pagebuilder_page_save_custom_meta_box', 10, 3);
	function uix_pagebuilder_page_save_custom_meta_box( $post_id, $post, $update ) {
		if ( !isset( $_POST[ 'meta-box-nonce-pagebuilder' ] ) || !wp_verify_nonce($_POST[ 'meta-box-nonce-pagebuilder' ], basename( __FILE__ ) ) ) return $post_id;
		if( !current_user_can( 'edit_post', $post_id ) )return $post_id;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
		$slug = "page";
		if( $slug != $post->post_type ) return $post_id;
		
	
		$layoutdata 	                         = wp_unslash( $_POST[ 'uix-pagebuilder-layoutdata' ] );
		$builderstatus 	                     = sanitize_text_field( $_POST[ 'uix-pagebuilder-status' ] );
		
		
		
		if( isset( $_POST[ 'uix-pagebuilder-layoutdata' ] ) ) update_post_meta( $post_id, 'uix-pagebuilder-layoutdata', $layoutdata );
		if( isset( $_POST[ 'uix-pagebuilder-status' ] ) ) update_post_meta( $post_id, 'uix-pagebuilder-status', $builderstatus );
		
		
	
	}

}






 