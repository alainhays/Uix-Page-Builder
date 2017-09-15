<?php
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}


/**
 * Returns each variable in module data
 * ----------------------------------------------------
 */
$form_vars = UixPageBuilder::get_module_data_vars( basename( __FILE__, '.php' ) );
if ( !is_array( $form_vars ) ) return;
foreach ( $form_vars as $key => $v ) :
	$$key = $v;
endforeach;


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
			'id'             => 'uix_pb_pricing2_col3_config_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Text Here', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => 'uix_pb_pricing2_col3_config_intro',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'This is the description text for the title.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3
								)
		
		),
		
	
	)
;


$form_type = array(
    'list' => 3
);


$args_1 = 
	array(
	
		array(
			'id'             => 'uix_pb_pricing2_col3_one_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'free', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_one_price',
			'title'          => esc_html__( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 49,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_one_emphasis_color',
			'title'          => esc_html__( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing2_col3_one_currency',
			'title'          => esc_html__( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_one_period',
			'title'          => esc_html__( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_one_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_one_btn_label',
			'title'          => esc_html__( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'TRY FOR FREE', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_pricing2_col3_one_btn_link',
			'title'          => esc_html__( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_one_btn_color',
			'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		array(
			'id'             => 'uix_pb_pricing2_col3_one_btn_win',
			'title'          => esc_html__( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_one_features',
			'title'          => esc_html__( 'Features', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::html_listTran( wp_kses( __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row' => 5
									
				                )
		
		),	
		
	    array(
			'id'             => 'uix_pb_pricing2_col3_one_features_tipinfo',
			'desc'           => esc_html__( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
		),	
		
		array(
			'id'             => 'uix_pb_pricing2_col3_one_active',
			'title'          => esc_html__( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),

	
	)
;


$args_2 = 
	array(
	
		array(
			'id'             => 'uix_pb_pricing2_col3_two_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'premium', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_two_price',
			'title'          => esc_html__( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 69,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_two_emphasis_color',
			'title'          => esc_html__( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing2_col3_two_currency',
			'title'          => esc_html__( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_two_period',
			'title'          => esc_html__( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_two_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_two_btn_label',
			'title'          => esc_html__( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'BUY', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_pricing2_col3_two_btn_link',
			'title'          => esc_html__( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_two_btn_color',
			'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		array(
			'id'             => 'uix_pb_pricing2_col3_two_btn_win',
			'title'          => esc_html__( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_two_features',
			'title'          => esc_html__( 'Features', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::html_listTran( wp_kses( __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row' => 5
									
				                )
		
		),	
		
		
	    array(
			'id'             => 'uix_pb_pricing2_col3_two_features_tipinfo',
			'desc'           => esc_html__( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
		),	
		
		array(
			'id'             => 'uix_pb_pricing2_col3_two_active',
			'title'          => esc_html__( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 1, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),

	
	)
;


$args_3 = 
	array(
	
		array(
			'id'             => 'uix_pb_pricing2_col3_three_title',
			'title'          => esc_html__( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'professional', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_three_price',
			'title'          => esc_html__( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 109,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_three_emphasis_color',
			'title'          => esc_html__( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#d59a3e',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		
		array(
			'id'             => 'uix_pb_pricing2_col3_three_currency',
			'title'          => esc_html__( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( '$', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => 'uix_pb_pricing2_col3_three_period',
			'title'          => esc_html__( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'per month', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_three_desc',
			'title'          => esc_html__( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'Some description text here.', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2
				                )
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_three_btn_label',
			'title'          => esc_html__( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_html__( 'BUY', 'uix-page-builder' ),
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => 'uix_pb_pricing2_col3_three_btn_link',
			'title'          => esc_html__( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => esc_url( '#' ),
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_three_btn_color',
			'title'          => esc_html__( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => '#a2bf2f',
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => array( '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' )
		
		),
		
		array(
			'id'             => 'uix_pb_pricing2_col3_three_btn_win',
			'title'          => esc_html__( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),	
		array(
			'id'             => 'uix_pb_pricing2_col3_three_features',
			'title'          => esc_html__( 'Features', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => UixPageBuilder::html_listTran( wp_kses( __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s><br>Another Feature Description', 'uix-page-builder' ), wp_kses_allowed_html( 'post' ) ) ),
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'  => 5
									
				                )
		
		),	
		
	    array(
			'id'             => 'uix_pb_pricing2_col3_three_features_tipinfo',
			'desc'           => esc_html__( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'type'           => 'note',
			'default'        => array(
		                            'fullwidth'  => false,
									'type'       => 'default'  //error, success, warning, note, default
				                ),
		
		),	
		
		
		
		array(
			'id'             => 'uix_pb_pricing2_col3_three_active',
			'title'          => esc_html__( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => 0, // 0:false  1:true
			'placeholder'    => '',
			'type'           => 'checkbox'
		
		),
		

	
	)
;


/**
 * Returns form javascripts
 * ----------------------------------------------------
 */
UixPageBuilder::form_scripts( array(
	    'clone'                   => '',
	    'defalt_value'            => $item,
	    'widget_name'             => $wname,
		'form_id'                 => $form_id,
		'section_id'              => $sid,
	    'column_id'               => $colid,
		'fields'                  => array(
										array(
											 'config'  => $args_config,
											 'type'    => $form_type_config,
											 'values'  => $module_config,
											 'title'   => esc_html__( 'General Settings', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type,
											 'values'  => $args_1,
											 'title'   => esc_html__( 'Table 1', 'uix-page-builder' )
										),
	
										array(
											 'config'  => $args_config,
											 'type'    => $form_type,
											 'values'  => $args_2,
											 'title'   => esc_html__( 'Table 2', 'uix-page-builder' )
										),
										array(
											 'config'  => $args_config,
											 'type'    => $form_type,
											 'values'  => $args_3,
											 'title'   => esc_html__( 'Table 3', 'uix-page-builder' )
										),
	

									),
		'title'                   => esc_html__( 'Pricing Table (3 column)', 'uix-page-builder' ),
	
	
		/**
		 * /////////////// Customizing HTML output on the frontend /////////////// 
		 * 
		 * 
		 * Usage:
		 *
		 * 1) Written as pure JavaScript syntax.
		 * 2) Please push the value of final output to the JavaScript variable "temp", For example: var temp = '...';
		 * 3) Be sure to note the escape of quotation marks and slashes.
		 * 4) Directly use the controls ID as a JavaScript variable as the value for each control.
		 * 5) Value of controls with dynamic form need to use, For example:
		 *    $( '{index}<?php echo UixPBFormCore::fid( $colid, $sid, '{controlID}' ); ?>' ).val();
		 *  
		 *  ---------------------------------
		 *     {index}      @var Number      ->  Index value and starting with 2, For example: 2-, 3-, 4-, 5-, ...
		 *     {controlID}  @var String      ->  The ID of a control.
		 */
	    'js_template'             => '
		
			var win_one        = ( uix_pb_pricing2_col3_one_btn_win === true ) ? \'target="_blank"\' : \'\',
				win_two        = ( uix_pb_pricing2_col3_two_btn_win === true ) ? \'target="_blank"\' : \'\',
				win_three      = ( uix_pb_pricing2_col3_three_btn_win === true ) ? \'target="_blank"\' : \'\',

				imclass_one    = ( uix_pb_pricing2_col3_one_active === true ) ? \'uix-pb-price2-important\' : \'\',
				imclass_two    = ( uix_pb_pricing2_col3_two_active === true ) ? \'uix-pb-price2-important\' : \'\',
				imclass_three  = ( uix_pb_pricing2_col3_three_active === true ) ? \'uix-pb-price2-important\' : \'\',

				btncolor_one   = uixpbform_colorTran( uix_pb_pricing2_col3_one_btn_color ),
				btncolor_two   = uixpbform_colorTran( uix_pb_pricing2_col3_two_btn_color ),
				btncolor_three = uixpbform_colorTran( uix_pb_pricing2_col3_three_btn_color );


			var _config_t      = ( uix_pb_pricing2_col3_config_title != undefined && uix_pb_pricing2_col3_config_title != \'\' ) ? \'<h2 class="uix-pb-section-heading">\'+uix_pb_pricing2_col3_config_title+\'</h2><div class="uix-pb-section-hr"></div>\' : \'\',
				_config_desc   = ( uix_pb_pricing2_col3_config_intro != undefined && uix_pb_pricing2_col3_config_intro != \'\' ) ? \'<div class="uix-pb-section-desc">\'+uixpbform_format_textarea_entering( uix_pb_pricing2_col3_config_intro )+\'</div>\' : \'\';

			

			var temp = \'\';
				temp += _config_t;
				temp += _config_desc;
				temp += \'<div class="uix-pb-price2">\';
				temp += \'<div class="uix-pb-row">\';
			    
			    //--- one
				temp += \'<div class="uix-pb-col-4 uix-pb-price2-border-hover" data-bcolor="\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_one_btn_color )+\'" data-tcolor="\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_one_emphasis_color )+\'">\';
				temp += \'<div class="uix-pb-price2-bg-hover uix-pb-price2-init-height">\';
				temp += \'<div class="uix-pb-price2-border \'+uixpbform_htmlEncode( imclass_one )+\'">\';
				temp += \'<h5 class="uix-pb-price2-level">\'+uix_pb_pricing2_col3_one_title+\'</h5>\';
				temp += \'<h2 class="uix-pb-price2-num" style="color:\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_one_emphasis_color )+\'"><span class="uix-pb-price2-currency">\'+uix_pb_pricing2_col3_one_currency+\'</span><span class="uix-pb-price2-num-text">\'+uixpbform_floatval( uix_pb_pricing2_col3_one_price )+\'</span><span class="uix-pb-price2-period">\'+uix_pb_pricing2_col3_one_period+\'</span></h2>\';
				temp += \'<div class="uix-pb-price2-excerpt">\';
				temp += \'<p>\'+uixpbform_format_textarea_entering( uix_pb_pricing2_col3_one_desc )+\'</p>\';
				temp += \'</div> <a href="\'+encodeURI( uix_pb_pricing2_col3_one_btn_link )+\'" \'+win_one+\' class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-\'+btncolor_one+\'">\'+uix_pb_pricing2_col3_one_btn_label+\'</a>\';
				temp += \'<div class="uix-pb-price2-hr"></div>\';
				temp += \'<div class="uix-pb-price2-detail">\';
				temp += \'<ul>\';
				temp += uixpbform_html_listTran( uix_pb_pricing2_col3_one_features, \'li\' );
				temp += \'</ul>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';

			    //--- two
				temp += \'<div class="uix-pb-col-4 uix-pb-price2-border-hover" data-bcolor="\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_two_btn_color )+\'" data-tcolor="\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_two_emphasis_color )+\'">\';
				temp += \'<div class="uix-pb-price2-bg-hover uix-pb-price2-init-height">\';
				temp += \'<div class="uix-pb-price2-border \'+uixpbform_htmlEncode( imclass_two )+\'">\';
				temp += \'<h5 class="uix-pb-price2-level">\'+uix_pb_pricing2_col3_two_title+\'</h5>\';
				temp += \'<h2 class="uix-pb-price2-num" style="color:\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_two_emphasis_color )+\'"><span class="uix-pb-price2-currency">\'+uix_pb_pricing2_col3_two_currency+\'</span><span class="uix-pb-price2-num-text">\'+uixpbform_floatval( uix_pb_pricing2_col3_two_price )+\'</span><span class="uix-pb-price2-period">\'+uix_pb_pricing2_col3_two_period+\'</span></h2>\';
				temp += \'<div class="uix-pb-price2-excerpt">\';
				temp += \'<p>\'+uixpbform_format_textarea_entering( uix_pb_pricing2_col3_two_desc )+\'</p>\';
				temp += \'</div> <a href="\'+encodeURI( uix_pb_pricing2_col3_two_btn_link )+\'" \'+win_two+\' class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-\'+btncolor_two+\'">\'+uix_pb_pricing2_col3_two_btn_label+\'</a>\';
				temp += \'<div class="uix-pb-price2-hr"></div>\';
				temp += \'<div class="uix-pb-price2-detail">\';
				temp += \'<ul>\';
				temp += uixpbform_html_listTran( uix_pb_pricing2_col3_two_features, \'li\' );
				temp += \'</ul>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
			
			
			    //--- three
				temp += \'<div class="uix-pb-col-4 uix-pb-col-last uix-pb-price2-border-hover" data-bcolor="\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_three_btn_color )+\'" data-tcolor="\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_three_emphasis_color )+\'">\';
				temp += \'<div class="uix-pb-price2-bg-hover uix-pb-price2-init-height">\';
				temp += \'<div class="uix-pb-price2-border \'+uixpbform_htmlEncode( imclass_three )+\'">\';
				temp += \'<h5 class="uix-pb-price2-level">\'+uix_pb_pricing2_col3_three_title+\'</h5>\';
				temp += \'<h2 class="uix-pb-price2-num" style="color:\'+uixpbform_htmlEncode( uix_pb_pricing2_col3_three_emphasis_color )+\'"><span class="uix-pb-price2-currency">\'+uix_pb_pricing2_col3_three_currency+\'</span><span class="uix-pb-price2-num-text">\'+uixpbform_floatval( uix_pb_pricing2_col3_three_price )+\'</span><span class="uix-pb-price2-period">\'+uix_pb_pricing2_col3_three_period+\'</span></h2>\';
				temp += \'<div class="uix-pb-price2-excerpt">\';
				temp += \'<p>\'+uixpbform_format_textarea_entering( uix_pb_pricing2_col3_three_desc )+\'</p>\';
				temp += \'</div> <a href="\'+encodeURI( uix_pb_pricing2_col3_three_btn_link )+\'" \'+win_three+\' class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-\'+btncolor_three+\'">\'+uix_pb_pricing2_col3_three_btn_label+\'</a>\';
				temp += \'<div class="uix-pb-price2-hr"></div>\';
				temp += \'<div class="uix-pb-price2-detail">\';
				temp += \'<ul>\';
				temp += uixpbform_html_listTran( uix_pb_pricing2_col3_three_features, \'li\' );
				temp += \'</ul>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
				temp += \'</div>\';
			
                //---
				temp += \'</div>\';
				temp += \'<!-- /.uix-pb-row -->\';
				temp += \'</div>\';
				temp += \'<!-- /.uix-pb-price2 -->\';
		
		'
    )
);
