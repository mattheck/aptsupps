<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles',50);
function salient_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
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
/*
if ( ! function_exists( 'woocommerce_template_single_excerpt' ) ) {

     /**
      * Output the product short description (excerpt).
      *
      * @subpackage  Product
      *//*
     function woocommerce_template_single_excerpt() {
         wc_get_template( 'single-product/short-description.php' );
     }
 }

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) : 

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
          
            $wpse_excerpt = trim(force_balance_tags($excerptOutput));
               
            return $wpse_excerpt;   

        }
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif; 

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt'); 
*/
function wp_trim_excerpt($text) { // Fakes an excerpt if needed
  global $post;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace('\]\]\>', ']]&gt;', $text);
    $text = strip_tags($text, '<p>' , '<li>' , '<ul>');
    $excerpt_length = 55;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words)> $excerpt_length) {
      array_pop($words);
      array_push($words, '[...]');
      $text = implode(' ', $words);
    }
  }
return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

// remove filters.
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );

// no wpautop or wptexturize will be used.
the_content();

// put things back the way you found them.
add_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wptexturize' );


?>