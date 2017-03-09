<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_hello2';

/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-page-builder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';




/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = array(
    'list' => 1
);

$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
);						



$module_config = 
	array(
	
		array(
			'id'             => 'uix_pb_features_col2_config_title',
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_features_col2_config_intro',
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	
	)
;



$form_type_col2 = array(
    'list'       => 2
);


$args_col2_1 = 
	array(
	


		array(
			'id'             => 'uix_pb_col_demo_col2_1_text',
			'title'          => __( 'Text2 - 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
			
		array(
			'id'             => 'uix_pb_col_demo_col2_1_textarea',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
								)
		
		),
		
		array(
			'id'             => 'uix_pb_col_demo_col2_1_icon',
			'title'          => __( 'Icon', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Demo Icon', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => false
								)
		
		),
		
		array(
				'id'             => 'uix_pb_col_demo_col2_1_upload',
				'title'          => __( 'Upload Image', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' )
									)
			
		),	
			
		
	    array(
			'id'             => 'uix_pb_col_demo_col2_1_slider',
			'title'          => __( 'SLider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'        => 'uix_pb_col_demo_col2_1_slider_units',
									'units'           => '',
									'min'             => 0,
									'max'             => 10,
									'step'            => 0.1
				                )
		
		),		
		
	
	)
;


$args_col2_2 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col2_2',
			'title'          => __( 'Text2 - 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		array(
			'id'             => 'uix_pb_col_demo_col2_2_textarea',
			'title'          => '',
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
								)
		
		),
		
		array(
			'id'             => 'uix_pb_col_demo_col2_2_icon',
			'title'          => __( 'Icon', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => __( 'Choose Demo Icon', 'uix-page-builder' ),
			'type'           => 'icon',
			'default'        => array(
									'social'  => false
								)
		
		),
		
		array(
				'id'             => 'uix_pb_col_demo_col2_2_upload',
				'title'          => __( 'Upload Image', 'uix-page-builder' ),
				'desc'           => '',
				'value'          => '',
				'placeholder'    => __( 'Image URL', 'uix-page-builder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-page-builder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-page-builder' )
									)
			
		),	
			
	    array(
			'id'             => 'uix_pb_col_demo_col2_2_slider',
			'title'          => __( 'SLider', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0,
			'placeholder'    => '',
			'type'           => 'slider',
			'default'        => array(
			                        'units_id'        => 'uix_pb_col_demo_col2_2_slider_units',
									'units'           => '',
									'min'             => 0,
									'max'             => 10,
									'step'            => 0.1
				                )
		
		),			
	
	)
;


//---------

$form_type_col3 = array(
    'list' => 3
);


$args_col3_1 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col3_1',
			'title'          => __( 'Text3 - 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;

$args_col3_2 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col3_2',
			'title'          => __( 'Text3 - 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;


$args_col3_3 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col3_3',
			'title'          => __( 'Text3 - 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;



//---------

$form_type_col4 = array(
    'list' => 4
);


$args_col4_1 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_1',
			'title'          => __( 'Text4 - 1', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;

$args_col4_2 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_2',
			'title'          => __( 'Text4 - 2', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;
$args_col4_3 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_3',
			'title'          => __( 'Text4 - 3', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
	
	)
;
$args_col4_4 = 
	array(
		array(
			'id'             => 'uix_pb_col_demo_col4_4',
			'title'          => __( 'Text4 - 4', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		
		
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
		
		
	
	)
;


//---
$form_html  = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );

$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'html', __( 'General Settings', 'uix-page-builder' ) );

$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_1, 'html', __( 'Item 1', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_2, 'html', __( 'Item 2', 'uix-page-builder' ) );


$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_1, 'html', __( 'Item 1', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_2, 'html', __( 'Item 2', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_3, 'html', __( 'Item 3', 'uix-page-builder' ) );


$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_1, 'html', __( 'Item 1', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_2, 'html', __( 'Item 2', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_3, 'html', __( 'Item 3', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_4, 'html', __( 'Item 4', 'uix-page-builder' ) );


$form_html .= UixPBFormCore::form_after();



//----
$form_js_vars  = '';

$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_config, $module_config, 'js_vars' );

$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col2, $args_col2_2, 'js_vars' );

$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_2, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col3, $args_col3_3, 'js_vars' );


$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_2, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_3, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $args_config, $colid, $wname, $sid, $form_id, $form_type_col4, $args_col4_4, 'js_vars' );





/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_id, __( 'Form Demo 2', 'uix-page-builder' ) ); ?>            
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
}

