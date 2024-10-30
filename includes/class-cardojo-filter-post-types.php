<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Content class.
 */
class CarDojo_Filter_Post_Type {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_filter_post_type' ), 0 );

		add_filter( 'the_filter_description', 'wptexturize'        );
		add_filter( 'the_filter_description', 'convert_smilies'    );
		add_filter( 'the_filter_description', 'convert_chars'      );
		add_filter( 'the_filter_description', 'wpautop'            );
		add_filter( 'the_filter_description', 'shortcode_unautop'  );
		add_filter( 'the_filter_description', 'prepend_attachment' );
		if ( ! empty( $GLOBALS['wp_embed'] ) ) {
			add_filter( 'the_filter_description', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
			add_filter( 'the_filter_description', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
		}

		add_filter( 'wp_insert_post_data', array( $this, 'fix_filter_post_name' ), '99', 2 );

	}

	/**
	 * register_filter_post_type function.
	 *
	 * @access public
	 * @return void
	 */
	public function register_filter_post_type() {
		
		if ( post_type_exists( "filter" ) )
			return;

	    /**
		 * Post types
		 */
		$singular  = __( 'Filter', 'cardojo' );
		$plural    = __( 'Filters', 'cardojo' );

		if ( current_theme_supports( 'filter-manager-templates' ) ) {
			$has_archive = _x( 'Filters', 'Post type archive slug - resave permalinks after changing this', 'cardojo' );
		} else {
			$has_archive = false;
		}

		$rewrite     = array(
			'slug'       => _x( 'filter', 'Filter permalink - resave permalinks after changing this', 'cardojo' ),
			'with_front' => false,
			'feeds'      => true,
			'pages'      => false
		);

		register_post_type( "filter",
			apply_filters( "register_post_type_filter", array(
				'labels' => array(
					'name'			=> $plural,
					'singular_name' 	=> $singular,
					'menu_name'             => __( 'Filters', 'cardojo' ),
					'all_items'             => sprintf( __( 'All Filters', 'cardojo' ), $plural ),
					'add_new' 		=> __( 'Add New Filter', 'cardojo' ),
					'add_new_item' 		=> sprintf( __( 'Add %s', 'cardojo' ), $singular ),
					'edit' 			=> __( 'Edit', 'cardojo' ),
					'edit_item' 		=> sprintf( __( 'Edit %s', 'cardojo' ), $singular ),
					'new_item' 		=> sprintf( __( 'New %s', 'cardojo' ), $singular ),
					'view' 			=> sprintf( __( 'View %s', 'cardojo' ), $singular ),
					'view_item' 		=> sprintf( __( 'View %s', 'cardojo' ), $singular ),
					'search_items' 		=> sprintf( __( 'Search %s', 'cardojo' ), $plural ),
					'not_found' 		=> sprintf( __( 'No %s found', 'cardojo' ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'cardojo' ), $plural ),
					'parent' 		=> sprintf( __( 'Parent %s', 'cardojo' ), $singular ),
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', 'cardojo' ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'car',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> $rewrite,
				'query_var' 			=> true,
				'supports' 				=> array( 'title', 'editor', 'custom-fields', 'publicize', 'thumbnail' ),
				'has_archive' 			=> $has_archive,
				'show_in_nav_menus' 	=> false
			) )
		);

		// Hide text editor in filter back end
		add_action('init', 'init_remove_editor_filter',100);
		function init_remove_editor_filter(){
			$post_type = 'filter';
			remove_post_type_support( $post_type, 'editor');
		}
	}

	/**
	 * Fix post name when wp_update_post changes it
	 * @param  array $data
	 * @return array
	 */
	public function fix_filter_post_name( $data, $postarr ) {

		global $post, $id;

	  	if( 'filter' == $data['post_type'] && isset($data['post_type']) ) {

	  		$id = $postarr['ID'];

			if($id) {

				$post_filter_email = get_post_meta(get_the_ID(), 'filter_email',true);
		        $post_filter_make = get_post_meta(get_the_ID(), 'filter_make',true);
		        $post_filter_model = get_post_meta(get_the_ID(), 'filter_model',true);
		        $post_filter_fuel_type = get_post_meta(get_the_ID(), 'filter_fuel_type',true);
		        $post_filter_price = get_post_meta(get_the_ID(), 'filter_price',true);
		        $post_filter_year = get_post_meta(get_the_ID(), 'filter_year',true);
		        $post_filter_mileage = get_post_meta(get_the_ID(), 'filter_mileage',true);
		        $post_filter_condition = get_post_meta(get_the_ID(), 'filter_condition',true);

				$postNewTitle = $post_filter_email . " " . $post_filter_make . " " . $post_filter_model . " " . $post_filter_fuel_type . " " . $post_filter_price . " " . $post_filter_year . " " . $post_filter_mileage . " " . $post_filter_condition;

				$data['post_name'] = sanitize_title( $postNewTitle );
				$data['post_title'] = $postNewTitle;

			}

		}

	  	return $data; // Returns the modified data.

	}

}
