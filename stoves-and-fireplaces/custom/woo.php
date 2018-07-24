<?php
/* custom programing for woocommerce */
/* add the product document tab */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

    if (!has_term('services', 'product_cat')) { // dont  add product documents tab on services
    // Adds the new tab
      $tabs['product_docs'] = array(
          'title'     => __( 'Documents', 'woocommerce' ),
          'priority'  => 50,
          'callback'  => 'woo_product_document_tab_content'
      );
    } // end if services

    $tabs ['contact'] = array(
        'title'     => __( 'Contact', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_contact_tab_content'
    );
    return $tabs;
}

function woo_product_document_tab_content() {
    // The  documents tab content
    echo do_shortcode('[woocommerce_product_documents]');
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
