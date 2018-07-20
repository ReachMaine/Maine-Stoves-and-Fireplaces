<?php
/* custom programing for woocommerce */
/* add the product document tab */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

    if (!has_term('services', 'product_cat')) { // dont  add product documents tab on services
    // Adds the new tab
      $tabs['product_docs'] = array(
          'title'     => __( 'Product Documents', 'woocommerce' ),
          'priority'  => 50,
          'callback'  => 'woo_product_document_tab_content'
      );
    }
    return $tabs;
}
function woo_product_document_tab_content() {
    // The  tab content
    echo do_shortcode('[woocommerce_product_documents]');
}

// add the product brand image after title, before excerpt
// [product_brand width="120px" class="alignright"]
add_action( 'woocommerce_single_product_summary', 'msfp_add_brand_image', 15 );

function msfp_add_brand_image() {
echo do_shortcode('[product_brand width="120px" class="alignright"]');
}
