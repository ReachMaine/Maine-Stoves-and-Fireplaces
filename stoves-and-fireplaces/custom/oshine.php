<?php /* customizing of oshine */

function be_themes_fallback_nav_menu(){
    // empty function to stop display of "SET THE MAIN MANU"
	}

// remove share widgets on (function is pluggable, could override funtions)
// one of two ways,  unplug function or remove action
//remove_action('woocommerce_single_product_summary', 'be_themes_share_woo_products');
if(!function_exists('be_themes_share_woo_products')) {
		function be_themes_share_woo_products() {

		}

		//add_action('woocommerce_single_product_summary', 'be_themes_share_woo_products', 59);
	}
	/***************************************
					HEADER DETAILS\
					over ride function to show hero image in archive pages.
	***************************************/
	if ( !function_exists( 'be_themes_header_details' ) ) {
		function be_themes_header_details() {
			global $be_themes_data, $post;
			$result = array();
			$post_id = be_get_page_id();
			if( is_singular( 'post' ) && is_single($post_id) && isset( $be_themes_data[ 'single_blog_style' ] ) && !empty( $be_themes_data[ 'single_blog_style' ] ) ) {
				if( !empty( $be_themes_data[ 'single_wide_header_transparent' ] ) && isset( $be_themes_data[ 'single_wide_header_transparent' ] ) && 'none' != $be_themes_data[ 'single_wide_header_transparent' ] ) {
					$header_transparent = $be_themes_data['single_wide_header_transparent'];
				}else{
					$header_transparent = 0;
				}
				if( !empty( $be_themes_data[ 'single_wide_navigation_color_scheme' ] ) && isset( $be_themes_data[ 'single_wide_navigation_color_scheme' ] ) ) {
					$color_scheme = $be_themes_data[ 'single_wide_navigation_color_scheme' ];
				}else{
					$color_scheme = 'light';
				}
				$hero_section = 1;
			}else if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
				if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && 'none' != $be_themes_data['single_blog_header_transparent'] ) {
					$header_transparent = $be_themes_data['single_blog_header_transparent'];
				} else {
					$header_transparent = 0;
				}
				if(!empty($be_themes_data['single_blog_header_transparent_color_scheme']) && isset($be_themes_data['single_blog_header_transparent_color_scheme']) && 'none' != $be_themes_data['single_blog_header_transparent_color_scheme'] ) {
					$color_scheme = $be_themes_data['single_blog_header_transparent_color_scheme'];
				} else {
					$color_scheme = '';
				}
				$hero_section = $be_themes_data['single_blog_hero_section'];
			} else if ( (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && (is_product($post_id)) || is_product_category()) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
				if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && ('none' !=  $be_themes_data['single_shop_header_transparent']) ) {
					$header_transparent = $be_themes_data['single_shop_header_transparent'];
				} else {
					$header_transparent = 0;
				}
				if(!empty($be_themes_data['single_shop_header_transparent_color_scheme']) && isset($be_themes_data['single_shop_header_transparent_color_scheme']) && ('none' !=  $be_themes_data['single_shop_header_transparent_color_scheme']) ) {
					$color_scheme = $be_themes_data['single_shop_header_transparent_color_scheme'];
				} else {
					$color_scheme = '';
				}
				$hero_section = $be_themes_data['single_shop_hero_section'];
			} else {
				$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
				$hero_section = get_post_meta($post_id, 'be_themes_hero_section', true);
				$color_scheme = get_post_meta($post_id, 'be_themes_header_transparent_color_scheme', true);
				$sticky_sections = get_post_meta($post_id, 'be_themes_sticky_sections', true);
				if( isset( $sticky_sections ) && !empty( $sticky_sections ) ) {
					$hero_section = 'none';
				}
			}

			if ( 'left' === $be_themes_data['opt-header-type'] ) {
				$header_transparent = 0;
			}

			$header_class = $full_screen_header_scheme = '';

			if(!empty($header_transparent) && isset($header_transparent) && 'none' != $header_transparent) {
				if($be_themes_data['layout'] == 'layout-border-header-top' ) {
					$header_class = 'no-transparent';
				} elseif ('transparent' == $header_transparent) {
					$header_class = 'transparent';
				} elseif ('semitransparent' == $header_transparent) {
					$header_class = 'semi-transparent transparent';
				}
			}
			//this is where you have to add the logic for first section color scheme
			if((!empty($header_transparent) && isset($header_transparent) && 'none' != $header_transparent ) ) {
				if( !empty($hero_section) && isset($hero_section) && $hero_section != 'none' ) {
					if(!empty($color_scheme) && isset($color_scheme) && $color_scheme) {
						if($color_scheme == 'dark') {
							$header_class .= ' background--light';
							$full_screen_header_scheme = 'data-headerscheme="background--light"';
						} elseif($color_scheme == 'light') {
							$header_class .= ' background--dark';
							$full_screen_header_scheme = 'data-headerscheme="background--dark"';
						}
					}
				}else{
					$pattern = get_shortcode_regex();
					if (  preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'tatsu_section', $matches[2] ) && isset( $matches[ 3 ] ) && !empty( $matches[ 3 ] ) ) {
						// shortcode is being used
						$shortcode_atts = shortcode_parse_atts( $matches[3][0] );
						if( !empty( $shortcode_atts ) && array_key_exists( 'full_screen_header_scheme', $shortcode_atts ) ) {
							$first_section_header_background_scheme = $shortcode_atts[ 'full_screen_header_scheme' ];
							$header_class .= ' ' . $first_section_header_background_scheme;
							$full_screen_header_scheme .= 'data-headerscheme = "' . $first_section_header_background_scheme . '"';
						}
					}
				}
			}

			if ( isset($be_themes_data['opt-header-type']) && ('top' == $be_themes_data['opt-header-type'] ) ) {
				$header_style = basename($be_themes_data['opt-header-style'],'.png') ;
			} else {
				$header_style = '';
			}
			if ( isset($be_themes_data['mobile_menu_icon_bg']) && !empty($be_themes_data['mobile_menu_icon_bg']['alpha']) && 'left' !== $be_themes_data['opt-header-type'] ){
				$header_class .= ' exclusive-mobile-bg';
			}
			$result[ 'header_transparent' ] = $header_transparent;
			$result[ 'color_scheme' ] = $color_scheme;
			$result[ 'header_class' ] = $header_class;
			$result[ 'full_screen_header_scheme' ] = $full_screen_header_scheme;
			$result[ 'header_style' ] = $header_style;
			return $result;
		}
	}
