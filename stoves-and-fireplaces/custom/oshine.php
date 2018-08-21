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
