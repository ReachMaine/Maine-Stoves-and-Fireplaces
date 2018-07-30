<?php
/* custom programing for woocommerce */
/* add the product document tab */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

    $tabs ['contact'] = array(
        'title'     => __( 'Contact', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_contact_tab_content'
    );
    return $tabs;
}

function woo_contact_tab_content() {
    // The contact tab content
    echo do_shortcode('[ninja_form id=2]');
}


// add the product brand image after title, before excerpt
// [product_brand width="120px" class="alignright"]
add_action( 'woocommerce_single_product_summary', 'msfp_add_brand_image', 15 );

function msfp_add_brand_image() {
echo do_shortcode('[product_brand width="120px" class="alignright"]');
}


/**
 * Opens all product documents links in new window/tabs
 */
add_filter( 'wc_product_documents_link_target', 'wc_product_documents_open_link_in_new_window', 10, 4 );
function wc_product_documents_open_link_in_new_window( $target, $product, $section, $document ) {
	return '_blank';
}

// dont show brand in product meta
add_action( 'wp_head', 'remove_brand_product_meta' );
function remove_brand_product_meta(){
  //if (is_plugin_active('woocommerce-brands')) {
  global $WC_Brands;
  if ($WC_Brands) {
  	remove_action( 'woocommerce_product_meta_end', array( $WC_Brands, 'show_brand' ) );
  }
}

// put category in body tag...
// add taxonomy term to body_class
function woo_custom_taxonomy_in_body_class( $classes ){
  if( is_singular( 'product' ) )
  {
    $custom_terms = get_the_terms(0, 'product_cat');
    if ($custom_terms) {
      foreach ($custom_terms as $custom_term) {
        $classes[] = 'product_cat_' . $custom_term->slug;
      }
    }
  }
  return $classes;
}
add_filter( 'body_class', 'woo_custom_taxonomy_in_body_class' );

// add product documents to the end of products
function pippin_filter_content_sample($content) {
	if( is_singular('product') && is_main_query() ) {
		$new_content = do_shortcode('[woocommerce_product_documents]');
		$content .= $new_content;
	}
	return $content;
}
add_filter('the_content', 'pippin_filter_content_sample');

// remove the default order ddl
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
