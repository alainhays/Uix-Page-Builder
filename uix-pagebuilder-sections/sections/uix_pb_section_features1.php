<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_features1';

//clone list
$clone_trigger_id_1        = 'uix_pb_features_col2_one_list';    // ID of clone trigger 
$clone_trigger_id_2        = 'uix_pb_features_col2_two_list';    // ID of clone trigger 
$clone_max                 = 15;                                 // Maximum of clone form 

//clone list of toggle class value
$clone_list_toggle_class = '';


/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-pagebuilder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';


if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $pid, 'uix-pagebuilder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) :
			$con         = UixPageBuilder::pagebuilder_output( $value->content );
			
		
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) :
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::pagebuilder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				endforeach;
			}
	
	        //loop content
			$col_content = UixPageBuilder::pagebuilder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
			
			
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
						$item[ $name ]  =  $content;	  //Usage:  $item[ 'uix_pb_section_xxx|[col-item-1_1---0][uix_pb_xxx_xxx][0]' ];
						
					endforeach;
						
					
					
				endforeach;
			}	
		
		endforeach;
		

	}
	
	
}

/**
 * Element Template : features1
 * ----------------------------------------------------
 */
$uix_pb_features_col2_one_listitem_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_title', __( 'Feature Title', 'uix-pagebuilder' ) );
$uix_pb_features_col2_one_listitem_titlecolor     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_titlecolor', '' );
$uix_pb_features_col2_one_listitem_desc           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_desc', __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-pagebuilder' ) );
$uix_pb_features_col2_one_listitem_desccolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_desccolor', '' );
$uix_pb_features_col2_one_listitem_icon           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_icon', '' );
$uix_pb_features_col2_one_listitem_iconcolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_one_listitem_iconcolor', '' );


$uix_pb_features_col2_two_listitem_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_title', __( 'Feature Title', 'uix-pagebuilder' ) );
$uix_pb_features_col2_two_listitem_titlecolor     = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_titlecolor', '' );
$uix_pb_features_col2_two_listitem_desc           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_desc', __( 'Some description text here. You can add a lot of it or can choose to leave it blank.', 'uix-pagebuilder' ) );
$uix_pb_features_col2_two_listitem_desccolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_desccolor', '' );
$uix_pb_features_col2_two_listitem_icon           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_icon', '' );
$uix_pb_features_col2_two_listitem_iconcolor      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_features_col2_two_listitem_iconcolor', '' );




//dynamic adding input
$list_features1_item_1 = '';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_features_col2_one_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		$titlecolor   = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_titlecolor]['.$sid.']' ] ) ) ? 'style="color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_titlecolor]['.$sid.']' ].'"' : '';
		$desccolor    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_desccolor]['.$sid.']' ] ) ) ? 'style="color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_desccolor]['.$sid.']' ].'"' : '';
		$iconcolor    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_iconcolor]['.$sid.']' ] ) ) ? 'style="border-color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_iconcolor]['.$sid.']' ].';color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_iconcolor]['.$sid.']' ].'"' : '';
		$icon         = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_icon]['.$sid.']' ] ) ) ? '<i class="fa fa-'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_icon]['.$sid.']' ].'" '.$iconcolor.'></i>' : '<i class="fa fa-check" '.$iconcolor.'></i>';	
		
		$list_features1_item_1 .= '
		<div class="uix-pb-feature-li">
			<h3 class="uix-pb-feature-title" '.$titlecolor.'><span class="uix-pb-feature-icon-side">'.$icon.'</span>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_title]['.$sid.']' ].'</h3>
			<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '.$desccolor.'><p>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_one_listitem_desc]['.$sid.']' ].'</p></div>         
		</div>  
		';
	} 
}
	
	
$list_features1_item_2 = '';
for ( $kk = 1; $kk <= $clone_max; $kk++ ) {
	$_uid = ( $kk >= 2 ) ? $kk.'-' : '';
	$_field = 'uix_pb_features_col2_two_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		$titlecolor   = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_titlecolor]['.$sid.']' ] ) ) ? 'style="color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_titlecolor]['.$sid.']' ].'"' : '';
		$desccolor    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_desccolor]['.$sid.']' ] ) ) ? 'style="color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_desccolor]['.$sid.']' ].'"' : '';
		$iconcolor    = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_iconcolor]['.$sid.']' ] ) ) ? 'style="border-color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_iconcolor]['.$sid.']' ].';color:'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_iconcolor]['.$sid.']' ].'"' : '';
		$icon         = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_icon]['.$sid.']' ] ) ) ? '<i class="fa fa-'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_icon]['.$sid.']' ].'" '.$iconcolor.'></i>' : '<i class="fa fa-check" '.$iconcolor.'></i>';	
		
		$list_features1_item_2 .= '
		<div class="uix-pb-feature-li">
			<h3 class="uix-pb-feature-title" '.$titlecolor.'><span class="uix-pb-feature-icon-side">'.$icon.'</span>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_title]['.$sid.']' ].'</h3>
			<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '.$desccolor.'><p>'.$item[ '['.$colid.']'.$_uid.'[uix_pb_features_col2_two_listitem_desc]['.$sid.']' ].'</p></div>         
		</div>  
		';
	} 
}
	
				
$element_temp = '
<div class="uix-pb-feature">
	<div class="uix-pb-row">
		<div class="uix-pb-col-6">
		{list_1}
		</div>
		<div class="uix-pb-col-6 uix-pb-col-last">
		{list_2}
		</div>
	</div>
</div><!-- /.uix-pb-feature -->          
';


$uix_pb_section_features1_temp = str_replace( '{list_1}', $list_features1_item_1,
                                 str_replace( '{list_2}', $list_features1_item_2,
							     $element_temp 
								 ) );



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */
$form_type = [
    'list' => 2
];



$args_1 = 
	[
	
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-pagebuilder' ),
			'type'           => 'text'
		
		),
	 
		//------list begin
		array(
			'id'             => $clone_trigger_id_1,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id_1 ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'',
											'type'      => 'text'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_titlecolor' ).'',
											'type'      => 'colormap'
										), 		
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desccolor' ).'',
											'type'      => 'colormap'
										), 		
										 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_iconcolor' ).'',
											'type'      => 'colormap'
										), 										
																			

									 ],
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_one_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_titlecolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_titlecolor' ),
				'title'          => '',
				'desc'           => __( 'Title Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col2_one_listitem_titlecolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_titlecolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)

			
			),	
		
			

			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_desc' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_one_listitem_desc,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desccolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_desccolor' ),
				'title'          => '',
				'desc'           => __( 'Description Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col2_one_listitem_desccolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desccolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_icon' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_one_listitem_icon,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'', /*class of list item */
				'placeholder'    => __( 'Choose Feature Icon', 'uix-pagebuilder' ),
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_iconcolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_one_listitem_iconcolor' ),
				'title'          => '',
				'desc'           => __( 'Icon Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col2_one_listitem_iconcolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_iconcolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	

			
		
		//------list end
		
		


		
	
	]
;

$args_2 = 
	[
	
		array(
			'desc'           => __( 'Note: multiple items per column', 'uix-pagebuilder' ),
			'type'           => 'text'
		
		),
	
		//------list begin
		array(
			'id'             => $clone_trigger_id_2,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id_2 ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'',
											'type'      => 'text'
										), 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_titlecolor' ).'',
											'type'      => 'colormap'
										), 		
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'',
											'type'      => 'textarea'
										),
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desccolor' ).'',
											'type'      => 'colormap'
										), 		
										 
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'',
											'type'      => 'icon'
										), 	
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_iconcolor' ).'',
											'type'      => 'colormap'
										), 										
																			

									 ],
									'max'                       => $clone_max
				                )
									
		),
		

		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_two_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_titlecolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_titlecolor' ),
				'title'          => '',
				'desc'           => __( 'Title Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col2_two_listitem_titlecolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_titlecolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)

			
			),	
		
			

			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_desc' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_two_listitem_desc,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desccolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_desccolor' ),
				'title'          => '',
				'desc'           => __( 'Description Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col2_two_listitem_desccolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desccolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_icon' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_features_col2_two_listitem_icon,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'', /*class of list item */
				'placeholder'    => __( 'Choose Feature Icon', 'uix-pagebuilder' ),
				'type'           => 'icon',
				'default'        => array(
										'social'  => false
									)
			
			),
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_iconcolor' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_features_col2_two_listitem_iconcolor' ),
				'title'          => '',
				'desc'           => __( 'Icon Color', 'uix-pagebuilder' ),
				'value'          => $uix_pb_features_col2_two_listitem_iconcolor,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_iconcolor' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'colormap',
				'default'        => array(
										'swatches' => 1
									)
			
			),	

			
		
		//------list end	
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_features1_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_features1_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_features1_temp,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),		


		
	
	]
;


//---
$form_html = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );

$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'html', __( 'Left Section', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'html', __( 'Right Section', 'uix-pagebuilder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js' );


//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js_vars' );




$clone_value_1 = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_titlecolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desccolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_iconcolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );

$clone_value_2 = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_titlecolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desccolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_iconcolor' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html );


/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id_1, $clone_value_1 );
		UixPBFormCore::reg_clone_vars( $clone_trigger_id_2, $clone_value_2 );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'features1', 'uix-pagebuilder' ) ); ?>            
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
		$field = 'uix_pb_features_col2_one_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_title]['.$sid.']' ]
								),
								
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_titlecolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_titlecolor]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_desc]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desccolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_desccolor]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_icon]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_iconcolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_one_listitem_iconcolor]['.$sid.']' ]
								),	
														
								
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id_1, $cur_id, $colid, $clone_value_1, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	
	for ( $ii = 2; $ii <= $clone_max; $ii++ ) {
		$uid = $ii.'-';
		$field = 'uix_pb_features_col2_two_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $ii;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_title]['.$sid.']' ]
								),
								
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_titlecolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_titlecolor]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_desc]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desccolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_desccolor]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_icon]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_iconcolor' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_features_col2_two_listitem_iconcolor]['.$sid.']' ]
								),								
								
			                  ];
							  
			//UixPageBuilder::push_cloneform( $clone_trigger_id_2, $cur_id, $colid, $clone_value_2, $sid, $value, $clone_list_toggle_class );
	
		} 
	}	
	
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "change keyup focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() {
			
			
			var tempcode = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>';
				

				
			if ( tempcode.length > 0 ) {
		
			
				/* List Item */
				var list_num         = <?php echo $clone_max; ?>,
					show_list_item_1 = '',
					show_list_item_2 = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid              = ( i >= 2 ) ? '#'+i+'-' : '#',
						_title_1          = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_title' ); ?>' ).val(),
						_titlecolor_1     = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_titlecolor' ); ?>' ).val(),
						_desc_1           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desc' ); ?>' ).val(),
						_desccolor_1      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_desccolor' ); ?>' ).val(),
						_icon_1           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_icon' ); ?>' ).val(),
						_iconcolor_1      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_one_listitem_iconcolor' ); ?>' ).val(),

						_title_2           = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_title' ); ?>' ).val(),
						_titlecolor_2      = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_titlecolor' ); ?>' ).val(),
						_desc_2            = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desc' ); ?>' ).val(),
						_desccolor_2       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_desccolor' ); ?>' ).val(),
						_icon_2            = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_icon' ); ?>' ).val(),
						_iconcolor_2       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_features_col2_two_listitem_iconcolor' ); ?>' ).val();

						
					var _item_v_titlecolor_1   = ( _titlecolor_1 != undefined && _titlecolor_1 != '' ) ? 'style="color:'+_titlecolor_1+'"' : '',
					    _item_v_title_1        = ( _title_1 != undefined && _title_1 != '' ) ? _title_1 : '',
						_item_v_desccolor_1    = ( _desccolor_1 != undefined && _desccolor_1 != '' ) ? 'style="color:'+_desccolor_1+'"' : '',
						_item_v_desc_1         = ( _desc_1 != undefined && _desc_1 != '' ) ? _desc_1 : '',
						_item_v_iconcolor_1    = ( _iconcolor_1 != undefined && _iconcolor_1 != '' ) ? 'style="border-color:'+_iconcolor_1+';color:'+_iconcolor_1+'"' : '',
						_item_v_icon_1         = ( _icon_1 != undefined && _icon_1 != '' ) ? '<i class="fa fa-'+_icon_1+'" '+_item_v_iconcolor_1+'></i>' : '<i class="fa fa-check" '+_item_v_iconcolor_1+'></i>',
						
						_item_v_titlecolor_2   = ( _titlecolor_2 != undefined && _titlecolor_2 != '' ) ? 'style="color:'+_titlecolor_2+'"' : '',
					    _item_v_title_2        = ( _title_2 != undefined && _title_2 != '' ) ? _title_2 : '',
					    _item_v_desccolor_2    = ( _desccolor_2 != undefined && _desccolor_2 != '' ) ? 'style="color:'+_desccolor_2+'"' : '',
						_item_v_desc_2         = ( _desc_2 != undefined && _desc_2 != '' ) ? _desc_2 : '',
						_item_v_iconcolor_2    = ( _iconcolor_2 != undefined && _iconcolor_2 != '' ) ? 'style="border-color:'+_iconcolor_2+';color:'+_iconcolor_2+'"' : '',
						_item_v_icon_2         = ( _icon_2 != undefined && _icon_2 != '' ) ? '<i class="fa fa-'+_icon_2+'" '+_item_v_iconcolor_2+'></i>' : '<i class="fa fa-check" '+_item_v_iconcolor_2+'></i>';
						
						
						
					if ( _title_1 != undefined && _title_1 != '' ) {
										
						//Do not include spaces
						show_list_item_1 += '<div class="uix-pb-feature-li">';
						show_list_item_1 += '<h3 class="uix-pb-feature-title" '+_item_v_titlecolor_1+'><span class="uix-pb-feature-icon-side">'+_item_v_icon_1+'</span>'+_item_v_title_1+'</h3>';
						show_list_item_1 += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '+_item_v_desccolor_1+'><p>'+_item_v_desc_1+'</p></div>';             
						show_list_item_1 += '</div>';
	
					}
					
					
					if ( _title_2 != undefined ) {
										
						//Do not include spaces
						show_list_item_2 += '<div class="uix-pb-feature-li">';
						show_list_item_2 += '<h3 class="uix-pb-feature-title" '+_item_v_titlecolor_2+'><span class="uix-pb-feature-icon-side">'+_item_v_icon_2+'</span>'+_item_v_title_2+'</h3>';
						show_list_item_2 += '<div class="uix-pb-feature-desc uix-pb-feature-desc-singlerow" '+_item_v_desccolor_2+'><p>'+_item_v_desc_2+'</p></div>';             
						show_list_item_2 += '</div>';
	
					}
	   	
					
				}

                
				//---
				
				tempcode = tempcode.replace(/{list_1}/g, show_list_item_1 )
				                   .replace(/{list_2}/g, show_list_item_2 );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_features1_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

