<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_hello';

//clone list
$clone_trigger_id        = 'uix_pb_hello_hello_list';    // ID of clone trigger 
$clone_max               = 4;                     // Maximum of clone form 
               
//clone list of toggle class value @var array
$clone_list_toggle_class = [ 'uix_pb_hello_listitem_toggle_url', 'uix_pb_hello_listitem_toggle_icon' ];       


/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-page-builder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';



if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::page_builder_array_newlist( get_post_meta( $pid, 'uix-page-builder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) :
			$con         = UixPageBuilder::page_builder_output( $value->content );
		
		
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) :
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::page_builder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				endforeach;
			}
	
	        //loop content
			$col_content = UixPageBuilder::page_builder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
			
			
			if ( $col_content && is_array( $col_content ) ) {
				foreach ( $col_content as $key ) :
				    
					$detail_content = $key;
					
					//column id
					$colname           = $form_id.'-col';
					$cname             = str_replace( $form_id.'|', '', $key[1][0] );
					$id                = $key[0][1];
					$item[ $colname ]   =  $id;  //Usage: $item[ 'uix_pb_section_xxx-col' ];
					
				
					foreach ( $detail_content as $value ) :	
						$name           = str_replace( $form_id.'|', '', $value[0] );
						$content        = $value[1];
						$item[ $name ]  =  $content;	  //Usage:  $item[ 'uix_pb_section_xxx|[col-item-1_1---0][uix_pb_hello_xxx_xxx][0]' ];
						
					endforeach;
					
					
					
				endforeach;
			}	
		
		endforeach;
		

	}
	
	
}



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type = [
	'list' => false
];

$args_config = [
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
];						


$args = 
	[
	
	    array(
			'id'             => 'uix_pb_hello_tipinfo',
			'desc'           => sprintf( __( 'You can custom the boxed width of the container for Uix Page Builder stylesheets. <a target="_blank" href="%1$s">click here to custom</a>', 'uix-page-builder' ), admin_url( 'admin.php?page='.UixPageBuilder::HELPER.'&tab=custom-css' ) ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'note'  //error, success, warning, note
				                ),
		
		),	
		
	
	    array(
			'id'             => 'uix_pb_hello_dividingline',
			'title'          => __( 'Image Radio', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'solid',
			'placeholder'    => '',
			'type'           => 'radio-image',
			'default'        => array(
									'solid'     => UixPageBuilder::plug_directory() .'admin/uixpbform/images/line/line-style-1.png',
									'double'    => UixPageBuilder::plug_directory() .'admin/uixpbform/images/line/line-style-2.png',
									'dashed'    => UixPageBuilder::plug_directory() .'admin/uixpbform/images/line/line-style-3.png',
									'dotted'    => UixPageBuilder::plug_directory() .'admin/uixpbform/images/line/line-style-4.png',
									'shadow'    => UixPageBuilder::plug_directory() .'admin/uixpbform/images/line/line-style-5.png',
									'gradient'  => UixPageBuilder::plug_directory() .'admin/uixpbform/images/line/line-style-6.png',
									
				                )
		
		),
	
	    array(
			'id'             => 'uix_pb_hello_radioswitch_style',
			'title'          => __( 'Radio Switch', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 'grand-fill-yellow',
			'placeholder'    => '',
			'type'           => 'radio-image',
			'default'        => array(
									'grand-fill-yellow'   => UixPageBuilder::plug_directory() .'admin/uixpbform/images/heading/heading-style-1.jpg',
									'grand'               => UixPageBuilder::plug_directory() .'admin/uixpbform/images/heading/heading-style-2.jpg',
				                ),
			/* If the toggle of switch with radio is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
			                        array(
										'trigger_id'           => 'grand-fill-yellow', /* {option id} */
										'toggle_class'         => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_radioswitch_fillbg' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ]

									),
									
			                        array(
										'trigger_id'           => 'grand', /* {option id} */
										'toggle_class'         => [ ],
										'toggle_remove_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_radioswitch_fillbg' ).'_toggle_class' ]

									),	
									
				                )	
								
		
		),
			
			array(
				'id'             => 'uix_pb_hello_radioswitch_fillbg',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_radioswitch_fillbg' ).'_toggle_class', /*class of toggle item */
				'placeholder'    => __( 'Image for Text Fill', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),	
	

		array(
			'id'             => 'uix_pb_hello_text',
			'title'          => __( 'Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		/*
	    array(
			'id'             => 'uix_pb_hello_radio',
			'title'          => __( 'Radio', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 3,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'1'  => 'boy',
									'2'  => 'girl',
									'3'  => 'private',
				                )	
		
		),
		*/
		
	    array(
			'id'             => 'uix_pb_hello_radio',
			'title'          => __( 'Radio', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'1'  => 'boy',
									'2'  => 'girl',
									'3'  => 'private',
				                ),
			/* If the toggle of switch with radio is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
			                        array(
										'trigger_id'           => '1', /* {option id} */
										'toggle_class'         => [ ''.UixPBFormCore::fid( $colid, $sid, 'xxx' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'yyy' ).'_toggle_class', 
																    ''.UixPBFormCore::fid( $colid, $sid, 'zzz' ).'_toggle_class' 
																  ]

									),
			                        array(
										'trigger_id'           => '2', /* {option id} */
										'toggle_class'         => [ ''.UixPBFormCore::fid( $colid, $sid, 'yyy' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'xxx' ).'_toggle_class', 
																    ''.UixPBFormCore::fid( $colid, $sid, 'zzz' ).'_toggle_class' 
																  ]

									),
				                    array(
										'trigger_id'           => '3', /* {option id} */
										'toggle_class'         => [ ''.UixPBFormCore::fid( $colid, $sid, 'zzz' ).'_toggle_class' ],
										'toggle_remove_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'xxx' ).'_toggle_class',
																    ''.UixPBFormCore::fid( $colid, $sid, 'yyy' ).'_toggle_class'
																  ]

									),
									
				                )		
		
		),

	    array(
			'id'             => 'uix_pb_hello_slider',
			'title'          => __( 'Slider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'    => 'uix_pb_hello_slider_units',
									'units'       => 'px',
									'min'         => 1,
									'max'         => 20,
									'step'        => 1
				                )
		
		),
		
		
		array(
			'id'             => 'uix_pb_hello_paddingdis', 
		    /*
		    @js vars: 
				uix_pb_hello_paddingdis_top 
				uix_pb_hello_paddingdis_right
				uix_pb_hello_paddingdis_bottom
				uix_pb_hello_paddingdis_left
			*/
			'title'          => __( 'Padding (px)', 'uix-page-builder' ),
			'desc'           => __( 'Use the input fields below to customize the padding of your column shortcode. Measurement units is pixels (px).', 'uix-page-builder' ),
			'value'          => array(
									'top'     => 20,
									'right'   => 0,
									'bottom'  => 20,
									'left'    => 0
				                ),
			'placeholder'    => '',
			'type'           => 'margin',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),
		
		array(
			'id'             => 'uix_pb_hello_editor',
			'title'          => __( 'Editor', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'editor',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
		
		array(
			'id'             => 'uix_pb_hello_textarea',
			'title'          => __( 'Textarea(by default value)', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
				                )
		
		),
		
		array(
			'id'             => 'uix_pb_hello_image',
			'title'          => __( 'Upload Image', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
			'type'           => 'image',
			'default'        => array(
									'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
									'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
	
									/* Show image properties */
									'prop'        => true,
									'prop_id'     => array(
														'repeat'      => 'uix_pb_hello_image_repeat', 
														'position'    => 'uix_pb_hello_image_position', 
														'attachment'  => 'uix_pb_hello_image_attachment', 
														'size'        => 'uix_pb_hello_image_size'
													),
						
									'prop_value'  => array(
														'repeat'      => 'no-repeat', 
														'position'    => 'left', 
														'attachment'  => 'scroll', 
														'size'        => 'cover' 
													),
				                )
		
		),	

		
	    array(
			'id'             => 'uix_pb_hello_shorttext',
			'title'          => __( 'Short Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => 'px'
				                )
		
		),
	    array(
			'id'             => 'uix_pb_hello_shortunitstext',
			'title'          => __( 'Short Units Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'short-units-text',
			'default'        => array(
									'units'       => [ 'px', 'em', '%' ],
									'units_id'    => 'uix_pb_hello_shortunitstext_units',
									'units_value' => 'px',
				                )
		
		),
		
		//------toggle begin
		array(
			'id'             => 'uix_pb_hello_toggle',
			'title'          => '',
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'toggle',
			'default'        => array(
		                            //'btn_textclass' => 'table-link-icon',
			                        'btn_text'      => __( 'set up links with toggle', 'uix-page-builder' ),
									'toggle_class'  => [ UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_toggle_url' ).'_class' ]
				                )
		
		),	

			array(
				'id'             => 'uix_pb_hello_toggle_url',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_toggle_url' ).'_class', /*class of toggle item */
				'placeholder'    => __( 'Toggle URL', 'uix-page-builder' ),
				'type'           => 'text',
				'default'        => ''
			
			),
			
			
		
		//------toggle end
		
		
		
		array(
			'id'             => 'uix_pb_hello_single_color',
			'title'          => __( 'Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#f5f5dc',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#fffff0', '#f5f5dc', '#f5deb3', '#d2b48c', '#c3b091', '#c0c0c0', '#808080', '#464646', '#333333', '#000080', '#084c9e', '#007fff', '#0E90D2', '#4BB1CF', '#5F9EA0', '#00ffff', '#7fffd4', '#008080', '#228b22', '#808000', '#a2bf2f', '#7fff00', '#bfff00', '#ffd700', '#daa520', '#ff7f50', '#fa8072', '#fc0fc0', '#ff77ff', '#e0b0ff', '#b57edc', '#843179', '#E1A0A1', '#D84F51', '#dc143c', '#990002' ,'#800000' ]
		
		),
		
		array(
			'id'             => 'uix_pb_hello_select',
			'title'          => __( 'Select', 'uix-page-builder' ),
			'desc'           => __( 'This is infomation.', 'uix-page-builder' ),
			'value'          => 2,
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => array(
									'1'  => 'student',
									'2'  => 'teacher',
									'3'  => 'manager'
	
				                )
		
		
		),
		
		array(
			'id'             => 'uix_pb_hello_multiselect',
			'title'          => __( 'Multiple Selector', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '1,3', //It takes a variable like '1,3'  if the value is empty.
			'placeholder'    => '',
			'type'           => 'multiselect',
			'default'        => array(
									'1'  => 'student',
									'2'  => 'teacher',
									'3'  => 'manager',
									'4'  => 'children'
	
				                )
		
		
		),
		
		array(
			'id'             => 'uix_pb_hello_icon',
			'title'          => __( 'This is Icon Selector ', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'icon',
			'default'        => array(
			                        'social'  => false
				                )
		
		),
			
		
		array(
			'id'             => 'uix_pb_hello_colormap',
			'title'          => __( 'Color Map', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'colormap',
			'default'        => array(
								'swatches' => 1
							)
		
		
		),
		
		array(
			'id'             => 'uix_pb_hello_checkbox',
			'title'          => __( 'Checkbox', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, //0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		
		),	
		
		array(
			'id'             => 'uix_pb_hello_checkbox_toggle',
			'title'          => __( 'Switch', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:close  1:open
			'placeholder'    => '',
			'type'           => 'checkbox',
		
			/* If the toggle of switch with checkbox is enabled, the target id require class like "toggle-row" */
			'toggle'        => array(
									'trigger_id'    => '', /* {option id} */
									'toggle_class'  => [ ''.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_checkbox_toggle_text' ).'_class' ],
									
									/* if this toggle contains another toggle, please specifies "toggle_not_class" in order that default hiding form is still valid . */
									/*
									'toggle_not_class'  => [ '' ]
									*/
									
				                )	
		
		
		),	
		
			array(
				'id'             => 'uix_pb_hello_checkbox_toggle_text',
				'title'          => '',
				'desc'           => '',
				'value'          => 555,
				'class'          => 'toggle-row '.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_checkbox_toggle_text' ).'_class', /*class of toggle item */
				'placeholder'    => '',
				'type'           => 'short-text',
				'default'        => array(
										'units'  => 'px'
									)
			
			),	
			
		


		
		//------list begin
		array(
			'desc'           => sprintf( __( '<strong>Note:</strong>  %1$s items per row. Per section insert for a maximum of <strong>%1$s</strong>.', 'uix-page-builder' ), $clone_max ),
			'type'           => 'text'
		
		),
		
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'title'          => __( 'List Item', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-page-builder' ),
									'clone_class'               => [ 
										array(
											'id'             => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgURL' ).'',
											'type'      => 'image'
										), 
										array(
											'id'             => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgtitle' ).'',
											'type'      => 'text'
										),						
										
										array(
											'id'             => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'    => [ 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_url' ).'', 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_icon' ).'' ]
										), 									
										
										

									 ],
									'max'                       => $clone_max
				                )
									
		),
		
			array(
				'id'             => 'uix_pb_hello_listitem_imgURL',
				'title'          => '',
				'desc'           => '',
				'value'          => '',
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgURL' ).'', /*class of list item */
				'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' ),
									)
			
			),	
		
		
			array(
				'id'             => 'uix_pb_hello_listitem_imgtitle',
				'title'          => '',
				'desc'           => '',
				'value'          => __( 'Image Title', 'uix-page-builder' ),
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgtitle' ).'', /*class of list item */
				'placeholder'    => __( 'Text', 'uix-page-builder' ),
				'type'           => 'text'
			
			),
			
			//------toggle begin
			array(
				'id'             => 'uix_pb_hello_listitem_toggle',
				'title'          => '',
				'desc'           => '',
				'value'          => 0, // 0:close  1:open
				'class'          => 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-page-builder' ),
										'toggle_class'  => [ 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_url' ).'', 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_icon' ).'' ]
									)
			
			),	
	
				array(
					'id'             => 'uix_pb_hello_listitem_toggle_url',
					'title'          => '',
					'desc'           => '',
					'value'          => esc_url( '#' ),
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_url' ).'', /*class of toggle item */
					'placeholder'    => __( 'Toggle URL', 'uix-page-builder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				array(
					'id'             => 'uix_pb_hello_listitem_toggle_icon',
					'title'          => '',
					'desc'           => '',
					'value'          => '',
					'class'          => 'toggle-row dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_icon' ).'',/*class of toggle item */
					'placeholder'    => '',
					'type'           => 'icon',
					'default'        => array(
											'social'  => true
										)
				
				),

			
			//------toggle end
			
			
					
		
		
		//------list end
		
	
	
        //------- template
		array(
			'id'             => $form_id.'_temp',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),	

	

	]
;


$form_html    = UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'html' );
$form_js_vars = UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );


$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgURL' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgtitle' ).'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle' ).'', $form_html, 'toggle' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_url' ).'', $form_html, 'toggle-row' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_icon' ).'', $form_html, 'toggle-row' );


/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
			
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Form Demo 1', 'uix-page-builder' ) ); ?>            
				} ); 
			} ) ( jQuery );
			</script>
	 
			<?php
	
			
		}
	}
	
}


/**
 * Returns forms with ajax
 * ----------------------------------------------------
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
	
    /*-- Dynamic Adding Input ( Default Value ) --*/
	for ( $i = 2; $i <= $clone_max; $i++ ) {
		$uid = $i.'-';
		$field = 'uix_pb_hello_listitem_imgURL';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [ 'uix_pb_hello_listitem_imgURL', 'uix_pb_hello_listitem_imgtitle', 'uix_pb_hello_listitem_toggle', 'uix_pb_hello_listitem_toggle_url', 'uix_pb_hello_listitem_toggle_icon' ];
							  
			UixPageBuilder::push_cloneform( $uid, $item, $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	?>

 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		function uix_pb_temp() {
			
			/* Vars */
			<?php echo $form_js_vars; ?>


			/* Radio (Requires quotes) */
			var show_radio;

			switch( uix_pb_hello_radio ){ 
				case '1': 
					show_radio = 'boy';

				break; 

				case '2': 
					show_radio = 'girl';

				break; 

				case '3': 
					show_radio = 'private';

				break;			

				default: 

			}


			/* Multiple Selector (Requires quotes) */
			var multiselector      = uix_pb_hello_multiselect.split( ',' ),
				show_multiselector = '';

			for ( var k = 0; k < multiselector.length; k++ ) {


				switch( multiselector[k] ){ 
					case '1': 
						show_multiselector += 'student, ';

					break; 

					case '2': 
						show_multiselector += 'teacher, ';

					break; 

					case '3': 
						show_multiselector += 'manager, ';

					break; 	

					case '4': 
						show_multiselector += 'children, ';

					break; 				

					default: 

				}

			}	

			show_multiselector = show_multiselector.substring( 0, show_multiselector.length - 2 );


			/* Checkbox */
			var show_checkbox = ( uix_pb_hello_checkbox === true ) ? 'True' : 'False';


			/* List Item */
			var list_num       = <?php echo $clone_max; ?>,
				show_list_item = '';


			for ( var i = 1; i <= list_num; i++ ){

				var _uid         = ( i >= 2 ) ? '#'+i+'-' : '#',
					_img         = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgURL' ); ?>' ).val(),
					_title       = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_imgtitle' ); ?>' ).val(),
					_toggleurl   = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_url' ); ?>' ).val(),
					_toggleicon  = $( _uid+'<?php echo UixPBFormCore::fid( $colid, $sid, 'uix_pb_hello_listitem_toggle_icon' ); ?>' ).val();

				var _item_v_img         = ( _img != undefined && _img != '' ) ? encodeURI( _img ) : '',
					_item_v_toggleurl   = ( _toggleurl != undefined && _toggleurl != '' ) ? encodeURI( _toggleurl ) : '',
					_item_v_toggleicon  = ( _toggleicon != undefined && _toggleicon != '' ) ? uixpbform_htmlEncode( _toggleicon ) : '';


				if ( _title != undefined && _title != '' ) {

					//Do not include spaces
					show_list_item += '<p>';
					show_list_item += ''+_item_v_img+' <strong>('+_title+')</strong><br>';
					show_list_item += 'Toggle URL: '+_item_v_toggleurl+'<br>';
					show_list_item += 'Toggle Icon: <i class="fa fa-'+_item_v_toggleicon+'"></i><br>';
					show_list_item += '</p>';	

				}


			}	


			var temp = '';
				temp += '<div id="uix-pb-hello">';
				temp += '<h4>Text:</h4> '+uix_pb_hello_text+'';
				temp += '<hr><h4>Textarea:</h4> '+uix_pb_hello_textarea+'';
				temp += '<hr><h4>ToggleSwitch:</h4> '+uix_pb_hello_checkbox_toggle;
				temp += '<hr><h4>Short Text:</h4> '+uix_pb_hello_shorttext+'';
				temp += '<hr><h4>Short Units Text:</h4> '+uix_pb_hello_shortunitstext+''+uix_pb_hello_shortunitstext_units+'';
				temp += '<hr><h4>Select:</h4> '+uix_pb_hello_select+'';
				temp += '<hr><h4>Upload Image:</h4> '+uix_pb_hello_image+' ('+uix_pb_hello_image_repeat+', '+uix_pb_hello_image_position+', '+uix_pb_hello_image_attachment+', '+uix_pb_hello_image_size+', )';
				temp += '<hr><h4>Toggle URL:</h4> '+uix_pb_hello_toggle_url+'';
				temp += '<hr><h4>Icon:</h4> <i class="fa fa-'+uix_pb_hello_icon+'"></i>';
				temp += '<hr><h4>Radio:</h4> '+show_radio+'';
				temp += '<hr><h4>Slider:</h4> '+uix_pb_hello_slider+''+uix_pb_hello_slider_units+'';
				temp += '<hr><h4>Color:</h4> '+uix_pb_hello_colormap+'';
				temp += '<hr><h4>Multiple Selector:</h4> '+show_multiselector+'';
				temp += '<hr><h4>Padding:</h4> '+uixpbform_floatval( uix_pb_hello_paddingdis_top )+', '+uixpbform_floatval( uix_pb_hello_paddingdis_right )+', '+uixpbform_floatval( uix_pb_hello_paddingdis_bottom )+', '+uixpbform_floatval( uix_pb_hello_paddingdis_left )+''; 
				temp += '<hr><h4>Checkbox:</h4> '+show_checkbox+'';
				temp += '<hr><h4>List Item:</h4> '+show_list_item+'';
				temp += '</div>';

			
			/* Save data */
			$( "#<?php echo UixPBFormCore::fid( $colid, $sid, $form_id.'_temp' ); ?>" ).val( temp );
			
		}
		
		uix_pb_temp();
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() { uix_pb_temp(); });
		
		
		
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

