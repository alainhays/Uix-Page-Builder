<?php
/**
 * Uix Page Builder Form
 *
 * @class 		: UixPBForm
 * @version		: 3.5 (September 21, 2017)
 * @author 		: UIUX Lab
 * @author URI 	: https://uiux.cc
 *
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'UixPBFormCore' ) ) {
	class UixPBFormCore {
		
		const PREFIX     = 'uix';
		const VERSION    = '3.5';	
		const MAPAPI     = 'AIzaSyA0kxSY0g5flUWptO4ggXpjhVB-ycdqsDk';
		
		/**
		 * Modules path of template directory with admin panel, not recommend changing it
		 *
		 * For admin panel only, template directory name of front-end can use filter "uixpb_templates_filter"
		 *
		 */
		const CUSTOMTEMP = 'uixpb_templates/modules/';
	
	
		
		/**
		 * Initialize
		 *
		 */
		public static function init() {
			
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
			add_action( 'admin_init', array( __CLASS__, 'load_form_core' ) );
			add_action( 'admin_footer', array( __CLASS__, 'icon_selector_win' ) );
			add_action( 'wp_ajax_nopriv_uixpbform_ajax_modules', array( __CLASS__, 'load_uixpbform_ajax_modules' ) );
			add_action( 'wp_ajax_uixpbform_ajax_modules', array( __CLASS__, 'load_uixpbform_ajax_modules' ) );
			add_action( 'wp_ajax_nopriv_uixpbform_ajax_iconlist', array( __CLASS__, 'load_uixpbform_ajax_iconlist' ) );
			add_action( 'wp_ajax_uixpbform_ajax_iconlist', array( __CLASS__, 'load_uixpbform_ajax_iconlist' ) );
			
			
		}
		
		
		/*
		 * Enqueue scripts and styles.
		 *
		 *
		 */
		public static function frontpage_scripts() {
			
			//Add Icons
			wp_enqueue_style( 'font-awesome', self::plug_directory() .'fontawesome/font-awesome.min.css', array(), '4.5.0', 'all');
			
	
		}
		
		/*
		 * Enqueue scripts and styles  in the backstage
		 *
		 *
		 */
		public static function backstage_scripts() {
		
			 if( UixPageBuilder::page_builder_mode() ) {
				  
					//Fix the image path of the editor
					$upload_dir     = wp_upload_dir();
				    $upload_dir_url = trailingslashit( $upload_dir[ 'baseurl' ] );
			 
				 
					////Register core functions (Require to enqueue the script before </body> instead of in the <head>.)
				    wp_register_script( 'uixpbform-functions', self::plug_directory() .'js/uixpbform.functions.min.js', array( 'jquery' ), self::VERSION, true );
					wp_localize_script( 'uixpbform-functions',  'uix_page_builder_wp_plugin', array( 
						'url'                       => self::plug_directory(),
						'site_url'                  => site_url(),
						'site_domain'               => parse_url( site_url(), PHP_URL_SCHEME ).'://'.parse_url( site_url(), PHP_URL_HOST ),
						'upload_dir_url'            => $upload_dir_url,
						'lang_media_title'          => __( 'Select Files', 'uix-page-builder' ),
						'lang_media_text'           => __( 'Insert', 'uix-page-builder' ),				
						'lang_mce_image'            => __( 'Insert Image', 'uix-page-builder' ),
						'lang_mce_unlink_title'     => __( 'Remove link', 'uix-page-builder' ),
						'lang_mce_link_title'       => __( 'Insert/Edit link', 'uix-page-builder' ),
						'lang_mce_link_field_url'   => __( 'URL', 'uix-page-builder' ),
						'lang_mce_link_field_text'  => __( 'Link Text', 'uix-page-builder' ),
						'lang_mce_link_field_win'   => __( 'Open link in a new tab', 'uix-page-builder' ),
					 ) );	
				 
				    wp_enqueue_script( 'uixpbform-functions' );

					//Add Icons
					wp_enqueue_style( 'font-awesome', self::plug_directory() .'fontawesome/font-awesome.min.css', array(), '4.5.0', 'all');

					//UixForm (Require to enqueue the script before </body> instead of in the <head>.)
					wp_enqueue_style( 'uixpbform', self::plug_directory() .'css/uixpbform.min.css', false, self::VERSION, 'all');
					//RTL		
					if ( is_rtl() ) {
						wp_enqueue_style( 'uixpbform-rtl', self::plug_directory() .'css/uixpbform.min-rtl.css', false, self::VERSION, 'all');
					}
				 
				 
					wp_enqueue_script( 'uixpbform', self::plug_directory() .'js/uixpbform.min.js', array( 'jquery' ), self::VERSION, true );
					

					//Colorpicker
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_script( 'wp-color-picker' );	
				    wp_enqueue_script( 'wp-color-picker-alpha', self::plug_directory() .'js/wp-color-picker-alpha.min.js', array( 'wp-color-picker', 'uixpbform-functions' ), '1.2.2', true );
	
				 
			  }
			
	
		}
		
		
		
		/*
		 * The function finds the position of the first occurrence of a string inside another string.
		 *
		 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
		 *
		 */
		public static function inc_str( $str, $incstr ) {

			$incstr = str_replace( '(', '\(',
					  str_replace( ')', '\)',
					  str_replace( '|', '\|',
					  str_replace( '*', '\*',
					  str_replace( '+', '\+',
					  str_replace( '.', '\.',
					  str_replace( '[', '\[',
					  str_replace( ']', '\]',
					  str_replace( '?', '\?',
					  str_replace( '/', '\/',
					  str_replace( '^', '\^',
					  str_replace( '{', '\{',
					  str_replace( '}', '\}',	
					  str_replace( '$', '\$',
					  str_replace( '\\', '\\\\',
					  $incstr 
					  )))))))))))))));

			if ( !empty( $incstr ) ) {
				if ( preg_match( '/'.$incstr.'/', $str ) ) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}


		}
	
		
		
		
		/*
		 * Callback the plugin directory URL
		 *
		 *
		 */
		public static function plug_directory() {
	
		  return trailingslashit( plugin_dir_url( __FILE__ ) );
	
		}
		
		/*
		 * Callback the plugin directory
		 *
		 *
		 */
		public static function plug_filepath() {
	
		  return trailingslashit( WP_PLUGIN_DIR .'/'.self::get_slug() );
	
		}	
		
		
		/*
		 * Callback this plugin slug
		 *
		 *
		 */
		public static function get_slug() {
			$curslug = '';
			$plugin_array = get_plugins();
		
			// First check if we have plugins, else return false
			if ( empty( $plugin_array ) )
				return false;
		
			// Define our variable as an empty array to avoid bugs if $plugin_array is empty
			$slugs = array();
		
			foreach ( $plugin_array as $plugin_slug=>$values ){
				$slugs[] = basename(
						$plugin_slug, // Get the key which holds the folder/file name
						'.php' // Strip away the .php part
					);
			}
			
			foreach ( $slugs as $value ){
				if( self::inc_str( dirname( plugin_basename( __FILE__ ) ), $value ) ) { 
					$curslug = $value;
					break;	
				}
			}	
			
			return $curslug;
		}
		
		
		
		/*
		 * Checks whether a template folder or directory exists
		 *
		 *
		 */
		public static function tempfolder_exists() {
	
			  $theme_template_dir_name = self::get_theme_template_dir_name();
			
			  if( is_dir( get_stylesheet_directory() . '/'.$theme_template_dir_name ) ) {
				  return true;
			  } else {
				  return false;
			  }
	
		}
		
		
		/**
		 * Returns the template directory name in order to your current theme.
		 *
		 * Themes can filter this by using the "uixpb_templates_filter" filter.
		 * 
		 */
		public static function get_theme_template_dir_name() {

			return untrailingslashit( apply_filters( 'uixpb_templates_filter', 'uixpb_templates' ) );
		}


		/**
		 * Returns the modules path of template directory in order to your current theme.
		 *
		 * Output:  uixpb_templates/modules/
		 *
		 * 
		 */
		public static function get_theme_template_modules_path() {

			return trailingslashit( self::get_theme_template_dir_name().'/modules' );
		}	

		
		
		/*
		 * Call the specified page modules
		 *
		 *
		 */
		public static function call_ajax_modules_tempfilepath( $name ) {
			
			if ( self::tempfolder_exists() ) {
				
				$theme_template_modules_path = self::get_theme_template_modules_path();
				
				include get_stylesheet_directory(). "/".$theme_template_modules_path."{$name}.php";
	
			} else {
				include self::plug_filepath().self::CUSTOMTEMP."{$name}.php";
			}
			
		}
		
	
		/*
		 * Load all the form fields in the directory
		 *
		 */
		 public static function load_form_core() {
	
			foreach ( glob( dirname(__FILE__). "/form-inc/*.php") as $file ) {
				include $file;
			}	 
		 }
		
		
	
		/*
		 * ========================================================================================================================================
		 * ========================================================================================================================================
		 */		

		
		/*
		 * Returns form id (Obtained via module ID)
		 *
		 *
		 */
		public static function fid( $col_id, $section_row, $field ) {
			$colid = str_replace( 'col-item-', 'section_'.$section_row.'__', $col_id );
			return $colid.'_'.$field;
		}	



		/*
		 * Returns form name
		 *
		 *
		 */
		public static function fname( $col_id, $form_id, $field ) {
			return $form_id.'|['.$col_id.']['.$field.']{index}';
		}


		/*
		 * Returns form value
		 *
		 *
		 */
		public static function fvalue( $col_id, $section_row, $arr, $field, $default = '' ) {

			$result = '';
			if ( is_array( $arr ) && array_key_exists( '['.$col_id.']['.$field.']['.$section_row.']', $arr ) ) {
				$result = $arr[ '['.$col_id.']['.$field.']['.$section_row.']' ];
			} else {
				$result = $default;
			}

			$result = str_replace( '{rowcapo:}', '&#039;',
					 str_replace( '{rowcqt:}', '&quot;',


					$result
					) );	


			return $result;


		}

		
		/*
		 * Print icon selector
		 *
		 */
		 public static function icon_selector_win() {
			 
			 if( UixPageBuilder::page_builder_mode() ) {
				 
			     echo '<div class="uixpbform-sub-window uixpbform-icon-selector-btn-target" id="" style="display:none;">';
				 require_once ( dirname( __FILE__ ) . '/'.self::icon_attr( 'selector' ) );
				 echo '</div>';	 
			 }
			 
				 
		 }	
		
	
		/*
		 * Returns icon attributes
		 *
		 */
		 public static function icon_attr( $type = 'prefix' ) {
			
			if ( $type == 'prefix' ) {
				return 'fa fa-';
				
			}
			 
			if ( $type == 'selector' ) {
				return 'fontawesome/font-awesome-custom.php';	
			}
		
			 
		 }	
		
		
		/*
		 * Register clone vars
		 *
		 *
		 */	
		public static function reg_clone_vars( $clone_id, $str ) {
			wp_localize_script( 'uixpbform-functions', $clone_id.'_clone_vars', array(
				'value' => $str
			) );
			wp_enqueue_script( 'uixpbform-functions' );
		}
		
		
		/*
		 * Get attachment ID
		 *
		 *
		 */	
		public static function get_attachment_id( $img_url ) {
			$cache_key	= md5($img_url);
			$post_id	= wp_cache_get($cache_key, 'wpjam_attachment_id' );
			if($post_id == false){
		
				$attr		= wp_upload_dir();
				$base_url	= $attr['baseurl']."/";
				$path = str_replace($base_url, "", $img_url);
				if($path){
					global $wpdb;
					$post_id	= $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '{$path}'");
					$post_id	= $post_id?$post_id:''; 
				}else{
					$post_id	= '';
				}
		
				wp_cache_set( $cache_key, $post_id, 'get_attachment_id', 86400);
			}
			return $post_id;
		}
	
	
		/*
		 * Shortcode Formatting Output
		 *
		 *
		 */
		public static function str_compression( $str ) {
			
			$str = str_replace( PHP_EOL, '', $str );
			$str = str_replace( "\t", '', $str );
			
			$pattern = array(
			"/> *([^ ]*) *</",
			"/[\s]+/",
			"/<!--[^!]*-->/",
			"/\"  /",
			"/ \"/",
			"'/\*[^*]*\*/'"
			);
			$replace = array(
			">\\1<",
			" ",
			"",
			"\"",
			"\"",
			""
			);
			
		  $outputcode = preg_replace( $pattern, $replace, $str );
			
		  return $outputcode;
	
		}
		
		
		
			
		/*
		 * Check if the user needs a browser update
		 *
		 *
		 */
		public static function is_IE() {
			 
			 if( self::inc_str( $_SERVER[ 'HTTP_USER_AGENT' ], 'MSIE' ) ) { 
				 return true;
			 } else {
				 return false;
			 }
			
		
		}
		
		/*
		 * Check if the Dynamic Adding Input
		 *
		 *
		 */
		public static function is_dynamic_input( $class ) {
			 
			 if( self::inc_str( $class, 'dynamic-row' ) ) { 
				 return true;
			 } else {
				 return false;
			 }
			
		
		}
		
		
		/*
		 * Returns Row Class of Table 
		 *
		 *
		 */
		public static function row_class( $class ) {
			 
			if( self::is_IE() && self::is_dynamic_input( $class ) ) {
				$new_class = str_replace( 'toggle-row', 'toggle-row isMSIE', $class );
			} else {
				$new_class = $class;
			}
			
			return $new_class;
			
		
		}
		
		
		
		/*
		 * Returns readable Colour
		 *
		 *
		 */	
		public static function readable_color( $color ){
			
			if ( self::inc_str( $color, 'rgb' ) ) {
				$color = self::rgb2hex( $color );
			}
			
			if ( self::inc_str( $color, '#' ) ) {
				$color = str_replace('#', '', $color );
			}
			
			$r = hexdec(substr( $color, 0, 2 ) );
			$g = hexdec(substr( $color, 2, 2 ) );
			$b = hexdec(substr( $color, 4, 2 ) );
		
			$contrast = sqrt(
				$r * $r * .241 +
				$g * $g * .691 +
				$b * $b * .068
			);
		
			//RGB Luminance
			if($contrast > 130){
				return '#000000';
			}else{
				return '#FFFFFF';
			}
		}
			
		public static function hex2rgb($hex) {
		   $hex = str_replace("#", "", $hex);
		
		   if(strlen($hex) == 3) {
			  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		   } else {
			  $r = hexdec(substr($hex,0,2));
			  $g = hexdec(substr($hex,2,2));
			  $b = hexdec(substr($hex,4,2));
		   }
		   $rgb = array($r, $g, $b);
		   //return implode(",", $rgb); // returns the rgb values separated by commas
		   return $rgb; // returns an array with the rgb values
		}
		
		public static function rgb2hex($rgb) {
		   $hex = "#";
		   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
		   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
		   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
		
		   return $hex; // returns the hex value including the number sign (#)
		}	
	
		
		/*
		 * Callback code of form
		 *
		 *
		 */
		public static function format_formcode( $str ) {
	
			$str = str_replace( '{apo:}', "'",
				   str_replace( '\'', '&apos;',
				   self::str_compression( $str )
				   ) );
		
		
			return $str;
	
		
			
		}
		

	
		/*
		 * Callback before tag of form
		 *
		 *
		 */
		public static function form_before( $widget_col_id, $widget_name, $section_row, $form_id ) {
			
			return '<div class="uixpbform-form-container"><div class="uixpbform-table-wrapper"><form method="post"><div class="uixpbform-modal-buttons"><input type="button" class="close-uixpbform-modal uixpbform-modal-button uixpbform-modal-button-secondary uixpbform-modal-cancel-btn" value="'.__( 'Cancel', 'uix-page-builder' ).'" /><input type="submit" class="uixpbform-modal-button uixpbform-modal-button-primary uixpbform-modal-save-btn" value="'.__( 'Save', 'uix-page-builder' ).'" /></div><input type="hidden" name="section" value="'.$form_id.'"><input type="hidden" name="row" value="'.$section_row.'"><input type="hidden" name="widgetname" value="'.$widget_name.'"><input type="hidden" name="colid" value="'.$widget_col_id.'">';
	
		}
		
		/*
		 * Callback after tag of form
		 *
		 *
		 */
		public static function form_after() {
			
			return '</form></div></div>';
	
		}
		
		/*
		 * Callback page modules with ajax
		 *
		 *
		 */
		public static function load_uixpbform_ajax_modules() {
			
			$tempID = isset( $_POST['tempID'] ) ? $_POST[ 'tempID' ] : '';
			self::call_ajax_modules_tempfilepath( $tempID );
			die();
		}
	
		/*
		 * Callback uixpbform icons list with ajax
		 *
		 *
		 */
		public static function load_uixpbform_ajax_iconlist() {
			
			$iconURL  = isset( $_POST['iconURL'] ) ? $_POST[ 'iconURL' ] : '';
			include $iconURL;
			
			die();
		}
	
	
		/*
		 * Callback before javascript of uixpbform
		 *
		 *
		 */
		public static function uixpbform_callback( $form_id, $title ) {
			
			$id         = get_the_ID();
			$old_formid = $form_id;
			$formid     = '.'.$old_formid.'';
			$postid     = empty( $id ) ? $_GET['post_id'] : $id;
			$title      = esc_attr( $title );
			
			
	
			return "if( $.isFunction( $.fn.UixPBFormPop ) ){ $(document).UixPBFormPop({postID:'{$postid}',trigger:'{$formid}',title:'{$title}'}); }; ";
	
		}
		
		
		 /*
		 * Returns dynamic form
		 *
		 *
		 */
		public static function dynamic_form_code( $class, $str, $toggle = null ) {
			
			
			 $searcharray[ 'list_str' ] = array(
				   'data-insert-preview="', //image
				   'data-insert-img="', //image
				   'id=',//input,textarea
				   '|[]',//name
				   '<td>',
				   '</td>'
				   
			
			  );
			  $replacearray[ 'list_str' ] = array(
				   'data-insert-preview="{colID}', 
				   'data-insert-img="{colID}',
				   'data-id=',
				   '|[{columnid}]',
				   '',
				   ''
			  );  
	
			 if ( $str ) {
				 
				 $v = $str;
				 
				 $matchCount = preg_match_all( '/<tr.*?'.$class.'">(.*?)<\/tr>/is', $v, $match );
				 
				 if ( $matchCount > 0 ) {
					 $v = str_replace( $searcharray[ 'list_str' ], $replacearray[ 'list_str' ], $match[1][0] );
				 }
				 
				 $v = preg_replace( '/<th.*?<\/th>/', '', $v );
				
				//inscure browser
				if( self::is_IE() ) {
					 if ( $toggle == 'toggle-row' ) {
						 $v = '<div class="toggle-row isMSIE">'.$v.'</div>';
					 }
					 if ( $toggle == 'toggle' ) {
						 $v = '<div class="toggle-btn isMSIE">'.$v.'</div>';
					 }	 
	
				} else {
					 if ( $toggle == 'toggle-row' ) {
						 $v = '<div class="toggle-row">'.$v.'</div>';
					 }
					 if ( $toggle == 'toggle' ) {
						 $v = '<div class="toggle-btn">'.$v.'</div>';
					 }	 
		
				}
			
				 return self::str_compression( $v );
			 } else {
				return '';
			 }
		
	
		}
		
		/*
		 * Callback form
		 *
		 * 
		 */
		 
		public static function add_form( $config_values, $widget_col_id, $widget_name, $section_row = -1, $config_id, $arr1 = null, $arr2 = null, $code = 'html', $wrapper_name = '' ) {
			
			$section_args = array();
			$field_total = array();
			$field_args = array();
			$before = '';
			$after = '';
			$field = '';
			$output = '';
			$jscode = '';
			$jscode_vars = '';
			
			
			
			
			/**
			 * Get the configuration options
			 */
			
			if ( is_array( $arr2 ) ) {
	
				foreach ( $arr2 as $field_key => $field_value ) {
					$field_total[] = $field_value;
				}	
		
			}
		
		
			if ( !empty( $config_id ) ) {
				
				
				/**
				 * Add the form container
				 */
				 if ( is_array( $arr1 ) ) { 
				 
						if ( $arr1[ 'list' ] == false ) {
			
								$before = '
								 '.self::form_before( $widget_col_id, $widget_name, $section_row, $config_id ).'
									<table class="uixpbform-table">
								'.PHP_EOL;
								
								
								$after = '
									</table>
								 '.self::form_after().'
								'.PHP_EOL;
			
				
						}
					 
					 
						//Column 1
						if ( $arr1[ 'list' ] == 1 ) {
						
								$before = '
								 
									 <div class="uixpbform-table-cols-wrapper uixpbform-table-col-1">
										<table class="uixpbform-table-list">
											
											<tr class="item">
												<th colspan="2" scope="col">
												'.$wrapper_name.'
												</th>
											</tr> 
											
								'.PHP_EOL;
								
								
								$after = '
										</table>
									</div><!-- /.uixpbform-table-cols-wrapper-->
								 
								'.PHP_EOL;
							
							
						} 
						
						//Column 2
						if ( $arr1[ 'list' ] == 2 ) {
						
								$before = '
								 
									 <div class="uixpbform-table-cols-wrapper uixpbform-table-col-2">
										<table class="uixpbform-table-list">
											
											<tr class="item">
												<th colspan="2" scope="col">
												'.$wrapper_name.'
												</th>
											</tr> 
											
								'.PHP_EOL;
								
								
								$after = '
										</table>
									</div><!-- /.uixpbform-table-cols-wrapper-->
								 
								'.PHP_EOL;
							
							
						}
						
						//Column 3
						if ( $arr1[ 'list' ] == 3 ) {
							$before = '
								 
									 <div class="uixpbform-table-cols-wrapper uixpbform-table-col-3">
										<table class="uixpbform-table-list">
										
											<tr class="item">
												<th colspan="2" scope="col">
												'.$wrapper_name.'
												</th>
											</tr> 
											
								'.PHP_EOL;
								
								
								$after = '
										</table>
									</div><!-- /.uixpbform-table-cols-wrapper-->
								 
								'.PHP_EOL;
							
						}
						
						//Column 4
						if ( $arr1[ 'list' ] == 4 ) {
							$before = '
								 
									 <div class="uixpbform-table-cols-wrapper uixpbform-table-col-4">
										<table class="uixpbform-table-list">
										
											<tr class="item">
												<th colspan="2" scope="col">
												'.$wrapper_name.'
												</th>
											</tr> 
											
								'.PHP_EOL;
								
								
								$after = '
										</table>
									</div><!-- /.uixpbform-table-cols-wrapper-->
								 
								'.PHP_EOL;
								
						}
				
				 }
				
				
				
	
				/**
				 * Add the field to the properly indexed
				 */
		
				foreach ( $field_total as $key) {
			
					$_title   = ( isset( $key['title'] ) ) ? $key['title'] : '';
					$_desc    = ( isset( $key['desc'] ) ) ? $key['desc'] : '';
					$_default = ( isset( $key['default'] ) ) ? $key['default'] : '';
					$_value   = ( isset( $key['value'] ) ) ? $key['value'] : '';
					$_ph      = ( isset( $key['placeholder'] ) ) ? $key['placeholder'] : '';
					$_id      = ( isset( $key['id'] ) ) ? $key['id'] : '';
					$_name    = ( isset( $key['name'] ) ) ? $key['name'] : '';
					$_type    = ( isset( $key['type'] ) ) ? $key['type'] : 'text';
					$_class   = ( isset( $key['class'] ) ) ? $key['class'] : '';
					$_toggle  = ( isset( $key['toggle'] ) ) ? $key['toggle'] : '';
					$_colid   = ( isset( $key['colid'] ) ) ? $key['colid'] : '';
				
					
					$args = array(
						'title'             => $_title,
						'desc'              => $_desc,
						'default'           => $_default,
						'value'             => $_value,
						'placeholder'       => $_ph,
						'id'                => $_id,
						'name'              => $_name,
						'type'              => $_type,
						'class'             => $_class,
						'toggle'            => $_toggle,
						'colid'             => $_colid
	
					);
				
					
					//icon
					$field .= UixPBFormType_Icon::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Icon::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Icon::add( $args, $config_values, 'js_vars' );
		
					
					//text
					$field .= UixPBFormType_Text::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Text::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Text::add( $args, $config_values, 'js_vars' );
		
		
					//textarea
					$field .= UixPBFormType_Textarea::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Textarea::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Textarea::add( $args, $config_values, 'js_vars' );
		
		
					//color
					$field .= UixPBFormType_Color::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Color::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Color::add( $args, $config_values, 'js_vars' );
					
					//image
					$field .= UixPBFormType_Image::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Image::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Image::add( $args, $config_values, 'js_vars' );
					
					
					//radio
					$field .= UixPBFormType_Radio::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Radio::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Radio::add( $args, $config_values, 'js_vars' );
					
					//radio image
					$field .= UixPBFormType_RadioImage::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_RadioImage::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_RadioImage::add( $args, $config_values, 'js_vars' );			
					
					//multiple selector
					$field .= UixPBFormType_MultiSelector::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_MultiSelector::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_MultiSelector::add( $args, $config_values, 'js_vars' );			
		
					//slider
					$field .= UixPBFormType_Slider::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Slider::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Slider::add( $args, $config_values, 'js_vars' );
					
					//margin
					$field .= UixPBFormType_Margin::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Margin::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Margin::add( $args, $config_values, 'js_vars' );
					
		
					//short text
					$field .= UixPBFormType_ShortText::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_ShortText::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_ShortText::add( $args, $config_values, 'js_vars' );
					
					//short units text
					$field .= UixPBFormType_ShortUnitsText::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_ShortUnitsText::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_ShortUnitsText::add( $args, $config_values, 'js_vars' );	
		
					//checkbox
					$field .= UixPBFormType_Checkbox::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Checkbox::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Checkbox::add( $args, $config_values, 'js_vars' );

					
					//colormap
					$field .= UixPBFormType_ColorMap::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_ColorMap::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_ColorMap::add( $args, $config_values, 'js_vars' );
						
					
		
					//select
					$field .= UixPBFormType_Select::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Select::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Select::add( $args, $config_values, 'js_vars' );
		

		
					//toggle 1
					$field .= UixPBFormType_Toggle::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Toggle::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Toggle::add( $args, $config_values, 'js_vars' );
		
					//Clone list
					$field .= UixPBFormType_ListClone::add( $args, $config_values, 'html', $section_row );
					$jscode .= UixPBFormType_ListClone::add( $args, $config_values, 'js', $section_row );
					$jscode_vars .= UixPBFormType_ListClone::add( $args, $config_values, 'js_vars', $section_row );
		
					//Note
					$field .= UixPBFormType_Note::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Note::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Note::add( $args, $config_values, 'js_vars' );
					
					//Editor
					$field .= UixPBFormType_Editor::add( $args, $config_values, 'html' );
					$jscode .= UixPBFormType_Editor::add( $args, $config_values, 'js' );
					$jscode_vars .= UixPBFormType_Editor::add( $args, $config_values, 'js_vars' );
									
					
					
	
	
				} // end foreach
				
	
				//HTML output
				if ( $code == 'html' ) $output = self::format_formcode ( $before.$field.$after );
				
				//Javascript output
				if ( $code == 'js' || $code == 'javascript' ) $output = $jscode;
				
				//Javascript vars output
				if ( $code == 'js_vars' ) $output = $jscode_vars;	
	
				
			}
			
			
			
			
			return $output;
		
		}
			
		
		
		/*
		 * Callback photo placeholder
		 *
		 *
		 */
		public static function photo_placeholder() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/no-photo.png';
	
		}
		
		/*
		 * Callback LOGO placeholder
		 *
		 *
		 */
		public static function logo_placeholder() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/no-logo.png';
	
		}
		
		
		/*
		 * Callback cover placeholder
		 *
		 *
		 */
		public static function cover_placeholder() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/default-cover.jpg';
	
		}	
		
		
		/*
		 * Callback map markers
		 *
		 *
		 */
		public static function map_marker() {
			
			return UixPageBuilder::plug_directory() .'uixpb_templates/images/UixPageBuilderTmpl/map/map-location.png';
	
		}	
		
		
	}

}

UixPBFormCore::init();	
