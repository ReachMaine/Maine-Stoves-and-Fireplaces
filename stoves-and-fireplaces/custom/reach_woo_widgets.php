<?php /* reach woo widgets */

/*  add widget areas */
function rww_widgets_init() {
  register_sidebar(
    array(
     'name' => __( 'WOO: Under Product Thumb', 'reach-woo-widgets' ),
     'id'   => 'rww-under-thumbnail',
     'description'   => __( 'Widget under product thumbnail', 'reach-woo-widgets' ),
     'before_widget' => '<div class="%2$s widget">',
     'after_widget'  => '</div>',
     'before_title'  => '<h6>',
     'after_title'   => '</h6>',
    )
  );

}
add_action( 'widgets_init', 'rww_widgets_init' );


// add form under thumbnail & gallery
// [ninja_form id=2]
add_action( 'woocommerce_after_single_product_summary' , 'msfp_add_below_prod_gallery', 5 );

function msfp_add_below_prod_gallery() {
  if (is_active_sidebar('rww-under-thumbnail')) {
      echo '<div id="rww-under-product-gallery" ';
          dynamic_sidebar( 'rww-under-thumbnail');
      echo '</div>';
  }
}
