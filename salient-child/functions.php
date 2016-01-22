<?php 


add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));
}

#-----------------------------------------------------------------#
# Bottom menu
#-----------------------------------------------------------------#
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'bottom_nav' => 'Bottom Navigation Menu',
		)
	);
}	



#-----------------------------------------------------------------#
# Exclude Category from Shop
#-----------------------------------------------------------------#

add_filter( 'get_terms', 'get_subcategory_terms', 10, 3 );

function get_subcategory_terms( $terms, $taxonomies, $args ) {

  $new_terms = array();

  // if a product category and on the shop page
  if ( in_array( 'product_cat', $taxonomies ) && ! is_admin() && is_shop() ) {

    foreach ( $terms as $key => $term ) {

      if ( ! in_array( $term->slug, array( 'joint-health', 'lean-gainer', 'multivitamin', 'muscle-building', 'nitric-oxide', 'pre-workout', 'protein', 'recovery', 'test-booster', 'thermogenic', 'weight-loss','merch') ) ) {
        $new_terms[] = $term;
      }

    }

    $terms = $new_terms;
  }

  return $terms;
}



/**
 * Media - set default image link location to 'None' 
 */

update_option('image_default_link_type','none');

/**
 * Always Show Kitchen Sink in WYSIWYG Editor
 */

function unhide_kitchensink( $args ) {
  $args['wordpress_adv_hidden'] = false;
  return $args;
}

add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );


?>