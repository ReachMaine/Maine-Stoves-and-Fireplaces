<?php

//add_action( 'after_setup_theme', 'be_themes_child_theme_setup' );


// function be_restore_default_gallery() {
// remove_shortcode('gallery');
// add_shortcode('gallery','gallery_shortcode');
// remove_shortcode('video');
// add_shortcode('video','wp_video_shortcode');
// }
// add_action( 'init', 'be_restore_default_gallery');

  require_once(get_stylesheet_directory().'/custom/branding.php');
  require_once(get_stylesheet_directory().'/custom/language.php');
  require_once(get_stylesheet_directory().'/custom/reach_CTAs.php');
  require_once(get_stylesheet_directory().'/custom/oshine.php');

?>
