<?php
if ( !class_exists( 'UixFormCore' ) ) {
    return;
}

/**
 * Sections template parameters
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$item    = '';


if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $pid, 'uix-page-builder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) {
			$con     = UixPageBuilder::pagebuilder_output( $value->content );
			$col     = $value->col;
			$row     = $value->row;
			$size_x  = $value->size_x;
			
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) {
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				}	
			}
			 
		}
		
		echo $pagebuilder_echo;

	}
	
	
}


/**
 * Form ID
 */
$form_id = 'uix_pb_section_code';

/**
 * Form Type
 */
$form_type = [
	'list' => false
];



$args = 
	[
		
		array(
			'id'             => 'uix_pb_code_info',
			'name'           => UixPageBuilder::fname( $form_id, 'uix_pb_code_info' ),
			'title'          => __( 'Text', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => ( $item && is_array( $item ) ) ? $item[ '[uix_pb_code_info]['.$sid.']' ] : '',
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 5,
									'format'  => true
								)
		
		),
	
	
	
	]
;

$form_html = UixFormCore::add_form( $sid, $form_id, $form_type, $args, 'html' );
$form_js = UixFormCore::add_form( $sid, $form_id, $form_type, $args, 'js' );
$form_js_vars = UixFormCore::add_form( $sid, $form_id, $form_type, $args, 'js_vars' );



/**
 * Returns actions of javascript
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
			echo UixFormCore::add_form( $sid, $form_id, '', '', 'active_btn' );
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixFormCore::uixform_callback( $form_js, $form_js_vars, $form_id, __( 'Insert Code', 'uix-page-builder' ) ); ?>            
				} ); 
			} ) ( jQuery );
			</script>
	 
			<?php
	
			
		}
	}
	
}


/**
 * Returns forms with ajax
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
}

