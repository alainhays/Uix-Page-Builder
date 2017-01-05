<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}


/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id                 = 'uix_pb_section_portfolio1';

//clone list
$clone_trigger_id        = 'uix_pb_portfolio1_list';    // ID of clone trigger 
$clone_max               = 30;                         // Maximum of clone form 

//clone list of toggle class value
$clone_list_toggle_class = '#{colID}'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'';       




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
 * Element Template
 * ----------------------------------------------------
 */
$uix_pb_portfolio1_config_title            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_title', __( 'Text Here', 'uix-pagebuilder' ) );
$uix_pb_portfolio1_config_intro            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_intro', __( 'This is the description text for the title.', 'uix-pagebuilder' ) );
$uix_pb_portfolio1_config_filterable        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_filterable', 0 ); // 0:false  1:true
$uix_pb_portfolio1_config_filterable_chk    = ( $uix_pb_portfolio1_config_filterable == 1 ) ? true : false;
$uix_pb_portfolio1_config_urlwindow         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_urlwindow', 0 ); // 0:false  1:true
$uix_pb_portfolio1_config_urlwindow_chk     = ( $uix_pb_portfolio1_config_urlwindow == 1 ) ? true : false;
$uix_pb_portfolio1_config_thumbnail_fillet  = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_thumbnail_fillet', 0 ) );
$uix_pb_portfolio1_config_grid              = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_config_grid', 3 );


$uix_pb_portfolio1_listitem_thumbnail       = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_thumbnail', '' ) );
$uix_pb_portfolio1_listitem_fullimage       = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_fullimage', '' ) );
$uix_pb_portfolio1_listitem_title           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_title', __( 'Name', 'uix-pagebuilder' ) );
$uix_pb_portfolio1_listitem_cat             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_cat', __( 'Position', 'uix-pagebuilder' ) );
$uix_pb_portfolio1_listitem_intro           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_intro', __( 'The Introduction of this member.', 'uix-pagebuilder' ) );
$uix_pb_portfolio1_listitem_toggle          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_toggle', 0 ); // 0:close  1:open
$uix_pb_portfolio1_listitem_toggle_url      = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_portfolio1_listitem_toggle_url', '' ) );


//dynamic adding input
$list_portfolio1_item_content = '';
$thumbnailfillet              =  $uix_pb_portfolio1_config_thumbnail_fillet.'%';

for ( $k = 1; $k <= $clone_max; $k++ ) {
	$_uid = ( $k >= 2 ) ? $k.'-' : '';
	$_field = 'uix_pb_portfolio1_listitem_title';
	if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) ) {
		
		
		$thumbnailURL       = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_thumbnail]['.$sid.']' ] ) ) ? $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_thumbnail]['.$sid.']' ] : UixPBFormCore::photo_placeholder();
		$fullimageURL       = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_fullimage]['.$sid.']' ] ) ) ? $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_fullimage]['.$sid.']' ] : $thumbnailURL;
		$url                = ( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_toggle_url]['.$sid.']' ] ) ) ? '<a href="'.esc_url( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_toggle_url]['.$sid.']' ] ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_1 ).'"></i></a>' : '';
		
		
		$list_portfolio1_item_content .= '
        <div class="uix-pb-portfolio-item" data-groups=\'["'.UixPageBuilder::transform_slug( $type ).'"]\'>
            <span class="uix-pb-portfolio-image" {imagefillet}>
                <a '.$targetcode.' href="'.$fullimgURL.'" title="'.esc_attr( $title ).'">
                <img src="'.$image.'" id="'.UixPageBuilder::get_attachment_id( $image ).'" alt="" {imagefillet}>
                </a>
            </span>
            <h3><a '.$targetcode.' href="'.$fullimgURL.'" title="'.esc_attr( $title ).'">'.$title.'</a></h3>
			'.( !empty( $type ) ? '<div class="uix-pb-portfolio-type">'.$type.'</div>' : '' ).'
            <div class="uix-pb-portfolio-content">
                '.str_replace( '[uix_portfolio_item_desc]', '',
                  str_replace( '[/uix_portfolio_item_desc]', '',
                   $content
                   ) ).'
				<a class="uix-pb-portfolio-link" '.$targetcode.' href="'.$fullimgURL.'" title="'.esc_attr( $title ).'"></a>
            </div>
    
        </div> 
		
		
		
		
		
		<div class="uix-pb-gallery-list uix-pb-gallery-list-col'.$uix_pb_portfolio1_config_grid.' '.( $uix_pb_portfolio1_config_filterable == 1 ? ' uix-pb-gray' : '' ).'">
			<div class="uix-pb-gallery-list-imgbox" '.$height.'>
				<img src="'.esc_url( $avatarURL ).'" alt="'.esc_attr( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ] ).'" style="-webkit-border-radius: '.$thumbnailfillet.'; -moz-border-radius: '.$thumbnailfillet.'; border-radius: '.$thumbnailfillet.';">
				'.( !empty( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_cat]['.$sid.']' ] )  ? '<span class="uix-pb-gallery-list-position">'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_cat]['.$sid.']' ] ).'</span>' : '' ).'
			</div>
			<div class="uix-pb-gallery-list-info">
				<h3 class="uix-pb-gallery-list-title">'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ] ).'</h3>	
				<div class="uix-pb-gallery-list-desc">
					<p>'.uix_pb_kses( $item[ '['.$colid.']'.$_uid.'[uix_pb_portfolio1_listitem_intro]['.$sid.']' ] ).'</p>
				</div>
				<div class="uix-pb-gallery-list-social">
					&nbsp;&nbsp;
					'.$social_out_1.'
					'.$social_out_2.'
					'.$social_out_3.'									
				
				</div>
				
			</div>
		</div>
		';	
		
	} 
	
	//The default value is not taken for any operation
	if ( is_array( $item ) && !array_key_exists( '['.$colid.']'.$_uid.'['.$_field.']['.$sid.']', $item ) && $k == 1 ) {
		

		$thumbnailURL       = ( !empty( $uix_pb_portfolio1_listitem_thumbnail ) ) ? $uix_pb_portfolio1_listitem_thumbnail : UixPBFormCore::photo_placeholder();
		$fullimageURL       = ( !empty( $uix_pb_portfolio1_listitem_fullimage ) ) ? $uix_pb_portfolio1_listitem_fullimage : $thumbnailURL;
		  
		$url                = ( !empty( $uix_pb_portfolio1_listitem_toggle_url ) ) ? '<a href="'.esc_url( $uix_pb_portfolio1_listitem_toggle_url ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_icon_1 ).'"></i></a>' : '';
		
		
		
		$list_portfolio1_item_content .= '
		<div class="uix-pb-gallery-list uix-pb-gallery-list-col'.$uix_pb_portfolio1_config_grid.' '.( $uix_pb_portfolio1_config_filterable == 1 ? ' uix-pb-gray' : '' ).'">
			<div class="uix-pb-gallery-list-imgbox" '.$height.'>
				<img src="'.esc_url( $avatarURL ).'" alt="'.esc_attr( $uix_pb_portfolio1_listitem_title ).'" style="-webkit-border-radius: '.$thumbnailfillet.'; -moz-border-radius: '.$thumbnailfillet.'; border-radius: '.$thumbnailfillet.';">
				'.( !empty( $uix_pb_portfolio1_listitem_cat )  ? '<span class="uix-pb-gallery-list-position">'.uix_pb_kses( $uix_pb_portfolio1_listitem_cat ).'</span>' : '' ).'
			</div>
			<div class="uix-pb-gallery-list-info">
				<h3 class="uix-pb-gallery-list-title">'.uix_pb_kses( $uix_pb_portfolio1_listitem_title ).'</h3>	
				<div class="uix-pb-gallery-list-desc">
					<p>'.uix_pb_kses( $uix_pb_portfolio1_listitem_intro ).'</p>
				</div>
				<div class="uix-pb-gallery-list-social">
					&nbsp;&nbsp;
					'.$social_out_1.'
					'.$social_out_2.'
					'.$social_out_3.'									
				
				</div>
				
			</div>
		</div>
		';	
		
	}
	
}
	
				
$element_temp = '
{heading}
{desc}
<div class="uix-pb-portfolio-tiles uix-pb-portfolio-col'.$uix_pb_portfolio1_config_grid.'">
	{list_content}
</div><!-- /.uix-pb-portfolio-tiles -->        
';


$uix_pb_section_portfolio1_temp = str_replace( '{list_content}', $list_portfolio1_item_content,
								 str_replace( '{heading}', ( !empty( $uix_pb_portfolio1_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_portfolio1_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_portfolio1_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_portfolio1_config_intro.'</div>' : '' ),			  
					
							     $element_temp 
								 ) ) );



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = [
    'list' => 1
];



$args_config = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_title' ),
			'title'          => __( 'Title', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_intro' ),
			'title'          => __( 'Description', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_filterable' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_filterable' ),
			'title'          => __( 'Filterable by Category', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_filterable,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_portfolio1_config_filterable_chk
				                )
		
		
		),	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_urlwindow' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_urlwindow' ),
			'title'          => __( 'Open link in new tab', 'uix-pagebuilder' ),
			'desc'           => __( 'This option is valid when you use destination URL.', 'uix-pagebuilder' ),
			'value'          => $uix_pb_portfolio1_config_urlwindow,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_portfolio1_config_urlwindow_chk
				                )
		
		
		),	
		

		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_thumbnail_fillet' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_thumbnail_fillet' ),
			'title'          => __( 'Radius of Fillet Avatar', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_thumbnail_fillet,
			'placeholder'    => '',
			'type'           => 'short-text',
			'default'        => array(
									'units'  => '%'
								)
		
		),	
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_grid' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_config_grid' ),
			'title'          => __( 'Column', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => $uix_pb_portfolio1_config_grid,
			'placeholder'    => '',
			'type'           => 'radio',
			'default'        => array(
									'4'  => '4',
									'3'  => '3',
									'2'  => '2',
								)
		
		),	
			
	
	]
;


$form_type = [
    'list' => 1
];



$args = 
	[
		
		//------list begin

		
		array(
			'id'             => $clone_trigger_id,
			'colid'          => $colid, /*clone required */
			'name'           => UixPageBuilder::fname( $colid, $form_id, $clone_trigger_id ),
			'title'          => __( 'List Item', 'uix-pagebuilder' ),
			'desc'           => '',
			'value'          => '',
			'placeholder'    => '',
			'type'           => 'list',
			'default'        => array(
									'btn_text'                  => __( 'click here to add an item', 'uix-pagebuilder' ),
									'clone_class'               => [ 
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'',
											'type'      => 'image'
										), 
		
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'',
											'type'      => 'image'
										), 					
		
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'',
											'type'      => 'text'
										), 										
										
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'',
											'type'      => 'text'
										), 
									
										array(
											'id'        => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'',
											'type'      => 'textarea'
										), 
										
										array(
											'id'             => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'',
											'type'            => 'toggle',
											'toggle_class'  => [ 
												'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
											 ]
										), 			
		

									 ],
									'max'                       => $clone_max
				                )
									
		),
	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_thumbnail' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_thumbnail,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'', /*class of list item */
				'placeholder'    => __( 'Thumbnail', 'uix-pagebuilder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
									)
			
			),	
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_fullimage' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_fullimage,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'', /*class of list item */
				'placeholder'    => __( 'Full Preview', 'uix-pagebuilder' ),
				'type'           => 'image',
				'default'        => array(
										'remove_btn_text'  => __( 'Remove image', 'uix-pagebuilder' ),
										'upload_btn_text'  => __( 'Upload', 'uix-pagebuilder' ),
									)
			
			),			
		
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_title' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_title,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_cat' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_cat,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'text'
			
			),			
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ),
		        'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_intro' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_intro,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'textarea',
				'default'        => array(
										'row'     => 5,
										'format'  => true
									)
			
			),
		
		
			//------toggle begin
			array(
				'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ),
				'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_toggle' ),
				'title'          => '',
				'desc'           => '',
				'value'          => $uix_pb_portfolio1_listitem_toggle,
				'class'          => 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'', /*class of list item */
				'placeholder'    => '',
				'type'           => 'toggle',
				'default'        => array(
										'btn_text'      => __( 'set up links with toggle', 'uix-pagebuilder' ),
										'toggle_class'  => [ 
											'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'',
	                                     ]
									)
			
			),	
	
				array(
					'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ),
					'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_portfolio1_listitem_toggle_url' ),
					'title'          => '',
					'desc'           => '',
					'value'          => $uix_pb_portfolio1_listitem_toggle_url,
					'class'          => 'toggle-row dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'', /*class of toggle item */
					'placeholder'    => __( 'Destination URL', 'uix-pagebuilder' ),
					'type'           => 'text',
					'default'        => ''
				
				),
				
		
			
		
		//------list end
		
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_portfolio1_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_portfolio1_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_portfolio1_temp,
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


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'html', __( 'General Settings', 'uix-pagebuilder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'html', __( 'Content', 'uix-pagebuilder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js' );


//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args, 'js_vars' );




$clone_value = UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )	
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle' )
.UixPBFormCore::dynamic_form_code( 'dynamic-row-'.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ).'', 'section_'.$sid.'__'.$colid.'---'.$sid.'', $form_html, 'toggle-row' );

/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( get_post_type() == 'page' ) {
		if ( is_admin()) {
			
		/* List Item - Register clone vars ( step 1) */
		UixPBFormCore::reg_clone_vars( $clone_trigger_id, $clone_value );
		
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Portfolio Grid', 'uix-pagebuilder' ) ); ?>            
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
		$field = 'uix_pb_portfolio1_listitem_title';
		if ( is_array( $item ) && array_key_exists( '['.$colid.']'.$uid.'['.$field.']['.$sid.']', $item ) ) {
			
			$cur_id        = $i;
			$cur_form_id   = '#'.$uid.$field;
			$value         =  [
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_thumbnail]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_fullimage]['.$sid.']' ]
								),				
				
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_title]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_cat]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_intro]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_toggle]['.$sid.']' ]
								),
								array(
									'id'       => $uid.UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ),
									'default'  => $item[ '['.$colid.']'.$uid.'[uix_pb_portfolio1_listitem_toggle_url]['.$sid.']' ]
								),
								
				
			                  ];
							  
			UixPageBuilder::push_cloneform( $clone_trigger_id, $cur_id, $colid, $clone_value, $sid, $value, $clone_list_toggle_class );
	
		} 
	}
	
	?>
    
 <script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "change keyup focusout click", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]'], [data-spy='<?php echo $clone_trigger_id; ?>__<?php echo $colid; ?>']", function() {
			
			    
			var tempcode                                  = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_portfolio1_config_title            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_title' ); ?>' ).val(),
				uix_pb_portfolio1_config_intro            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_intro' ); ?>' ).val(),
				uix_pb_portfolio1_config_filterable_chk   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_filterable' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_portfolio1_config_urlwindow_chk    = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_urlwindow' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_portfolio1_config_thumbnail_fillet = uixpbform_floatval( $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_thumbnail_fillet' ); ?>' ).val() ) + '%',
				uix_pb_portfolio1_config_grid             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_config_grid' ); ?>' ).val();
	
	
				
			if ( tempcode.length > 0 ) {
		
				
				
				var _config_t          = ( uix_pb_portfolio1_config_title != undefined && uix_pb_portfolio1_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_portfolio1_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc       = ( uix_pb_portfolio1_config_intro != undefined && uix_pb_portfolio1_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_portfolio1_config_intro+'</div>' : '',
					_config_filterable = ( uix_pb_portfolio1_config_filterable_chk === true ) ? ' ' : '',
					_config_urlwindow  = ( uix_pb_portfolio1_config_urlwindow_chk === true ) ? ' ' : '';
;
						
					
				
				
				/* List Item */
				var list_num               = <?php echo $clone_max; ?>,
					show_list_item_content = '';
				
			
				for ( var i = 1; i <= list_num; i++ ){
					
					
					var _uid         = ( i >= 2 ) ? '#'+i+'-' : '#',
						_thumbnail   = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_thumbnail' ); ?>' ).val(),
						_fullimage = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_fullimage' ); ?>' ).val(),
						_title       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_title' ); ?>' ).val(),
						_cat         = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_cat' ); ?>' ).val(),
						_intro       = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_intro' ); ?>' ).val(),
						_url         = $( _uid+'<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_portfolio1_listitem_toggle_url' ); ?>' ).val();
					
						
						var _item_v_thumbnailURL     = ( _thumbnail != undefined && _thumbnail != '' ) ? _thumbnail : '<?php echo UixPBFormCore::photo_placeholder(); ?>',
						_item_v_fullimageURL   = ( _fullimage != undefined && _fullimage != '' ) ? _fullimage : _item_v_thumbnailURL,
						_item_v_url              = ( _toggleurl1 != undefined && _toggleurl1 != '' ) ? '<a href="'+encodeURI( _toggleurl1 )+'" target="_blank"><i class="fa fa-'+uixpbform_htmlEncode( _item_v_social_icon_1 )+'"></i></a>' : '';
					
					
	
					
					if ( _intro != undefined && _intro != '' ) {
										
						//Do not include spaces
						
						show_list_item_content += '<div class="uix-pb-gallery-list uix-pb-gallery-list-col'+uix_pb_portfolio1_config_grid+' '+_config_gray+'">';
						show_list_item_content += '<div class="uix-pb-gallery-list-imgbox" '+_config_height+'>';
						show_list_item_content += '<img src="'+encodeURI( _item_v_thumbnailURL )+'" alt="'+uixpbform_htmlEncode( _title )+'" style="-webkit-border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+'; -moz-border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+'; border-radius: '+uix_pb_portfolio1_config_thumbnail_fillet+';">';
						show_list_item_content += _item_v_pos;
						show_list_item_content += '</div>';
						show_list_item_content += '<div class="uix-pb-gallery-list-info">';
						show_list_item_content += '<h3 class="uix-pb-gallery-list-title">'+_title+'</h3>	';
						show_list_item_content += '<div class="uix-pb-gallery-list-desc">';
						show_list_item_content += '<p>'+_intro+'</p>';
						show_list_item_content += '</div>';
						show_list_item_content += '<div class="uix-pb-gallery-list-social">';
						show_list_item_content += '&nbsp;&nbsp;';
						show_list_item_content += _item_v_social_out_1;
						show_list_item_content += _item_v_social_out_2;
						show_list_item_content += _item_v_social_out_3;									
						show_list_item_content += '</div>';
						show_list_item_content += '</div>';
						show_list_item_content += '</div>';
	
					}
					
					
				}

                
				//---
				
				tempcode = tempcode.replace(/{list_content}/g, show_list_item_content )
								    .replace(/{heading}/g, _config_t )
								    .replace(/{desc}/g, _config_desc );
								
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_portfolio1_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script>  
    
    <?php

	
}

