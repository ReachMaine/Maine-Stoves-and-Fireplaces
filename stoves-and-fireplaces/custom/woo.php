<?php
/* custom programing for woocommerce */
/* add the product document tab */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

    // Adds the new tab
    $tabs['test_tab'] = array(
        'title'     => __( 'Product Documents', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_product_document_tab_content'
    );
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

// add form under thumbnail & gallery
// [ninja_form id=2]
add_action( 'woocommerce_after_single_product_summary' , 'msfp_add_below_prod_gallery', 5 );

function msfp_add_below_prod_gallery() {
    echo '<div class="msfp-under-product-gallery">';
    echo '<span>THIS IS A TEST. YOU CAN ADD TEXT, IMAGES AND ANY HTML</span>';
    echo '</div>';
}
