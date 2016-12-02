<?php
/**
 * Template Name: Uix Page Builder Template
 *
 * The template for displaying all pages with Uix Page Builder.
 *
 */
if ( !class_exists( 'UixPageBuilder' ) ) {
    return;
}

get_header(); ?>
     
	<?php while ( have_posts() ) : the_post(); ?>
            
  
		<?php
		$builder_content   = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $post->ID, 'uix-pagebuilder-layoutdata', true ) );
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
			foreach ( $builder_content as $key => $value ) :
				$con                  = UixPageBuilder::pagebuilder_output( $value->content );
				$col                  = $value->col;
				$row                  = $value->row;
				$size_x               = $value->size_x;
				$section_id           = $value->secindex;
				$section_title        = $value->title;
				$element_code         = '';
				$element_grid_before  = '';
				$element_grid_after   = '</div>';
				
			
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
						
						$matchCount = preg_match( '/(.*){last}(.*)$/', $element_code, $matches );
						if ( $matchCount > 0 ) {
							
							$element_code = str_replace( '{last}', '',
											str_replace( '{last}'.$matches[2], 'uix-pb-col-last'.$matches[2], 
											$element_code 
											) );
											
										
						}
										
						//Section container
						echo  '<div class="uix-pagebuilder-section" id="uix-pagebuilder-section-'.$row.'" data-row="'.$section_id.'"><div class="uix-pb-row">'.$element_code.'</div></div>'; 
						//WP menu title of anchor link
						echo "\n".'<div data-pb-section-title="'.esc_attr( $section_title ).'"></div>'."\n<!-- ".wp_kses( __( 'End Section', 'uix-pagebuilder' ), wp_kses_allowed_html( 'post' ) )." -->\n\n";	
						

						
					}
					
	
				}
				
				//------------------------------------ end sections

				
		
			endforeach;
	
	
   
	
		}
	
        ?>                      
                         
                               
    
    <?php endwhile; ?>  

<?php get_footer(); ?>


