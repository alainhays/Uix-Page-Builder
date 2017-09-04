<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}


/**
 * Initialize sections template parameters
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::init_template_parameters( basename( __FILE__, '.php' ) );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;

							 

/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type = array(
	'list' => false
);


$args_config = array(
	'col_id'    => $colid,
	'sid'       => $sid,
	'form_id'   => $form_id,
	'items'     => $item
);	


//Show All Sidebars
global $wp_registered_sidebars;
$sidebars_value = array();

if ( !empty( $wp_registered_sidebars ) ) {
	foreach ( $wp_registered_sidebars as $value ) {
		UixPageBuilder::array_push_associative( $sidebars_value, array( esc_attr( $value['id'] ) => esc_html( $value['name'] ) ) );
	}
	
}



$args = 
	array(
	

	
		array(
			'id'             => 'uix_pb_sidebar_id',
			'title'          => esc_html__( 'Select Sidebar', 'uix-page-builder' ),
			'desc'           => wp_kses( sprintf( __( 'Calls each of the active widget callbacks in order, which prints the markup for the sidebar. <a href="%1$s" target="_blank">Customize Your Sidebar</a>', 'uix-page-builder' ), esc_url( admin_url( 'widgets.php' ) ) ), wp_kses_allowed_html( 'post' ) ),
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'select',
			'default'        => $sidebars_value

		),

		

	
	)
;


/**
 * Returns form javascripts
 * ----------------------------------------------------
 */			
UixPageBuilder::form_scripts( array(
	    'clone'        => '',
	    'defalt_value' => $item,
	    'widget_name'  => $wname,
		'form_id'      => $form_id,
		'section_id'   => $sid,
	    'column_id'    => $colid,
		'fields'       => array(
							array(
								 'config'  => $args_config,
								 'type'    => $form_type,
								 'values'  => $args
							),

						),
		'title'        => esc_html__( 'WP Sidebar', 'uix-page-builder' ),
	    'js_template'  => '
		
			var temp = \'[uix_pb_sidebar id=\\\'\'+uixpbform_htmlEncode( uix_pb_sidebar_id )+\'\\\']\';
		
		
		'
    )
);

