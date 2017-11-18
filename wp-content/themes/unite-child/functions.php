<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', array( 'unite-icons' ) );
}


// Our custom post type films function
function create_posttype() {
 
    register_post_type( 'films',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Films' ),
                'singular_name' => __( 'Film' ),
				 'add_new_item' => __( 'Add New Film' ),
				'edit_item' => __( 'Edit Film' ),
      			'update_item' => __( 'Update Film' )
            ),
            'public' => true,
			
            'has_archive' => true,
            'rewrite' => array('slug' => 'films'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );




function add_custom_taxonomies() {
  // Add new "Genres" taxonomy to Films
  register_taxonomy('genre', 'films', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Genres', 'taxonomy general name' ),
      'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Genres' ),
      'all_items' => __( 'All Genres' ),
      'parent_item' => __( 'Parent Genre' ),
      'parent_item_colon' => __( 'Parent Genre:' ),
      'edit_item' => __( 'Edit Genre' ),
      'update_item' => __( 'Update Genre' ),
      'add_new_item' => __( 'Add New Genre' ),
      'new_item_name' => __( 'New Genre Name' ),
      'menu_name' => __( 'Genres' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'genres', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
	
	register_taxonomy('country', 'films', array(
	// Hierarchical taxonomy (like categories)
	'hierarchical' => true,
	// This array of options controls the labels displayed in the WordPress Admin UI
	'labels' => array(
	  'name' => _x( 'Country', 'taxonomy general name' ),
	  'singular_name' => _x( 'Country', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Countries' ),
	  'all_items' => __( 'All Countries' ),
	  'parent_item' => __( 'Parent Country' ),
	  'parent_item_colon' => __( 'Parent Country:' ),
	  'edit_item' => __( 'Edit Country' ),
	  'update_item' => __( 'Update Country' ),
	  'add_new_item' => __( 'Add New Country' ),
	  'new_item_name' => __( 'New Country Name' ),
	  'menu_name' => __( 'Country' ),
	),
	// Control the slugs used for this taxonomy
	'rewrite' => array(
	  'slug' => 'country', // This controls the base slug that will display before each term
	  'with_front' => false, // Don't display the category base before "/locations/"
	  'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
	),
	));
	
	register_taxonomy('year', 'films', array(
	// Hierarchical taxonomy (like categories)
	'hierarchical' => true,
	// This array of options controls the labels displayed in the WordPress Admin UI
	'labels' => array(
	  'name' => _x( 'Years', 'taxonomy general name' ),
	  'singular_name' => _x( 'Year', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Year' ),
	  'all_items' => __( 'All Years' ),
	  'parent_item' => __( 'Parent Year' ),
	  'parent_item_colon' => __( 'Parent Year:' ),
	  'edit_item' => __( 'Edit Year' ),
	  'update_item' => __( 'Update Year' ),
	  'add_new_item' => __( 'Add New Year' ),
	  'new_item_name' => __( 'New Year Name' ),
	  'menu_name' => __( 'Years' ),
	),
	// Control the slugs used for this taxonomy
	'rewrite' => array(
	  'slug' => 'year', // This controls the base slug that will display before each term
	  'with_front' => false, // Don't display the category base before "/locations/"
	  'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
	),
	));
	
	
	register_taxonomy('actors', 'films', array(
	// Hierarchical taxonomy (like categories)
	'hierarchical' => true,
	// This array of options controls the labels displayed in the WordPress Admin UI
	'labels' => array(
	  'name' => _x( 'Actors', 'taxonomy general name' ),
	  'singular_name' => _x( 'Actor', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Actors' ),
	  'all_items' => __( 'All Actors' ),
	  'parent_item' => __( 'Parent Actor' ),
	  'parent_item_colon' => __( 'Parent Actor:' ),
	  'edit_item' => __( 'Edit Actor' ),
	  'update_item' => __( 'Update Actor' ),
	  'add_new_item' => __( 'Add New Actor' ),
	  'new_item_name' => __( 'New Actor Name' ),
	  'menu_name' => __( 'Actors' ),
	),
	// Control the slugs used for this taxonomy
	'rewrite' => array(
	  'slug' => 'actors', // This controls the base slug that will display before each term
	  'with_front' => false, // Don't display the category base before "/locations/"
	  'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
	),
	));
	
}
add_action( 'init', 'add_custom_taxonomies', 0 );


add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'films' ) );
	
		$film[] = get_taxonomies();
	
    //return var_dump($query);
}


add_shortcode( 'shortcodename', 'display_custom_post_type' );

    function display_custom_post_type(){
        $args = array(
            'post_type' => 'films',
			'posts_per_page' => 5,
            'post_status' => 'publish'
        );

        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '<ul>';
            while( $query->have_posts() ){
                $query->the_post();
                $string .= '<li><a href="'. get_post_permalink().'">' . get_the_title() . '</a></li>';
            }
            $string .= '</ul>';
        }
        wp_reset_postdata();
        return $string;
    }



?>