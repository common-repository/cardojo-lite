<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Content class.
 */
class CarDojo_Car_Post_Type {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'register_vehicle_post_type' ), 0 );

		add_filter( 'the_car_description', 'wptexturize'        );
		add_filter( 'the_car_description', 'convert_smilies'    );
		add_filter( 'the_car_description', 'convert_chars'      );
		add_filter( 'the_car_description', 'wpautop'            );
		add_filter( 'the_car_description', 'shortcode_unautop'  );
		add_filter( 'the_car_description', 'prepend_attachment' );

		if ( ! empty( $GLOBALS['wp_embed'] ) ) {
			add_filter( 'the_car_description', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
			add_filter( 'the_car_description', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
		}

		add_filter( 'wp_insert_post_data', array( $this, 'fix_car_post_name' ), '99', 2 );
		add_action( 'wp_insert_post', array( $this, 'maybe_add_default_meta_data' ), '10', 2 );

		// Single car content
		$this->car_content_filter( true );

	}

	/**
	 * register_vehicle_post_type function.
	 *
	 * @access public
	 * @return void
	 */
	public function register_vehicle_post_type() {
		
		if ( post_type_exists( "vehicle" ) )
			return;

		$admin_capability = 'manage_vehicles';

		/**
		* Model
		*/
		$singular  = __( 'Model', 'cardojo' );
		$plural    = __( 'Models', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-model', 'vehicle model slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_model",
			apply_filters( 'register_taxonomy_vehicle_model_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_model_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Year/Maker/Model/Trim', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Year/Maker/Model/Trim', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Year/Maker/Model/Trim', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Year/Maker/Model/Trim:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Year/Maker/Model/Trim', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Year/Maker/Model/Trim', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Year/Maker/Model/Trim', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Year/Maker/Model/Trim Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Body Style
	    $singular  = __( 'Body Style', 'cardojo' );
		$plural    = __( 'Body Style', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-body-style', 'vehicle  body style slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_body_style",
			apply_filters( 'register_taxonomy_vehicle_body_style_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_body_style_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Body Style', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Body Styles', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Body Style', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Body Style:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Body Style', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Body Style', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Body Style', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Body Style Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Exterior Color
	    $singular  = __( 'Exterior Color', 'cardojo' );
		$plural    = __( 'Exterior Colors', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-ext-color', 'vehicle exterior color slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_exterior_color",
			apply_filters( 'register_taxonomy_vehicle_exterior_color_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_exterior_color_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Color', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Color', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Color', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Color:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Color', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Color', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Color', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Color Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    function cardojo_register_meta() {
		    register_meta( 'term', 'color', 'cardojo_sanitize_hex' );
		}

		// make sure that we have a valid color hex code.
		function cardojo_sanitize_hex( $color ) {

		    $color = ltrim( $color, '#' );

		    return preg_match( '/([A-Fa-f0-9]{3}){1,2}$/', $color ) ? $color : '';
		}

		function cardojo_get_term_color( $term_id, $hash = false ) {

		    $color = get_term_meta( $term_id, 'color', true );
		    $color = cardojo_sanitize_hex( $color );

		    return $hash && $color ? "#{$color}" : $color;

		}

		add_action( 'vehicle_exterior_color_add_form_fields', 'ccp_new_term_color_field' );

		function ccp_new_term_color_field() {

		    wp_nonce_field( basename( __FILE__ ), 'cardojo_term_color_nonce' ); ?>

		    <div class="form-field cardojo-term-color-wrap">
		        <label for="cardojo-term-color"><?php esc_html_e( 'Color', 'cardojo' ); ?></label>
		        <input type="text" name="cardojo_term_color" id="cardojo-term-color" value="" class="cardojo-color-field" data-default-color="#ffffff" />
		    </div>
	
			<div class="form-field cardojo-term-color-wrap">
				
				<label for="cardojo-term-color"><?php esc_html_e( 'Color Type', 'cardojo' ); ?></label>
		    	<input type="radio" name="color_type" value="default" checked> <?php esc_html_e('Default', 'cardojo' ); ?><br>
	  			<input type="radio" name="color_type" value="combined" > <?php esc_html_e('Combined', 'cardojo' ); ?><br>
	  			<input type="radio" name="color_type" value="na" > <?php esc_html_e('N/A', 'cardojo' ); ?>

		  	</div>

		<?php }

		add_action( 'vehicle_exterior_color_edit_form_fields', 'ccp_edit_term_color_field' );

		function ccp_edit_term_color_field( $term ) {

		    $default      = '#ffffff';
		    $color        = cardojo_get_term_color( $term->term_id, true );
		    $color_type   = get_term_meta( $term->term_id, 'color_type', true );

		    if(empty($color_type)) {
		    	$color_type = "default";
		    }

		    if ( ! $color )
		        $color = $default; ?>

		    <tr class="form-field cardojo-term-color-wrap">
		        <th scope="row"><label for="cardojo-term-color"><?php esc_html_e( 'Color', 'cardojo' ); ?></label></th>
		        <td>
		            <?php wp_nonce_field( basename( __FILE__ ), 'cardojo_term_color_nonce' ); ?>
		            <input type="text" name="cardojo_term_color" id="cardojo-term-color" value="<?php echo esc_attr( $color ); ?>" class="cardojo-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
		        </td>
		    </tr>

		    <tr class="form-field cardojo-term-color-wrap">
		        <th scope="row"><label for="cardojo-term-color"><?php esc_html_e( 'Color Type', 'cardojo' ); ?></label></th>
		        <td>
		            <?php wp_nonce_field( basename( __FILE__ ), 'cardojo_term_color_nonce' ); ?>
		            <input type="radio" name="color_type" value="default" <?php if($color_type == "default") { echo "checked"; } ?>> <?php esc_html_e('Default', 'cardojo' ); ?><br>
		  			<input type="radio" name="color_type" value="combined" <?php if($color_type == "combined") { echo "checked"; } ?>> <?php esc_html_e('Combined', 'cardojo' ); ?><br>
		  			<input type="radio" name="color_type" value="na" <?php if($color_type == "na") { echo "checked"; } ?>> <?php esc_html_e('N/A', 'cardojo' ); ?>
		        </td>
		    </tr>

		<?php }

		add_action( 'edited_vehicle_exterior_color', 'cardojo_save_term_color' );
		add_action( 'create_vehicle_exterior_color', 'cardojo_save_term_color' );

		function cardojo_save_term_color( $term_id ) {

		    if ( ! isset( $_POST['cardojo_term_color_nonce'] ) || ! wp_verify_nonce( $_POST['cardojo_term_color_nonce'], basename( __FILE__ ) ) )
		        return;

		    $old_color = cardojo_get_term_color( $term_id );
		    $new_color = isset( $_POST['cardojo_term_color'] ) ? cardojo_sanitize_hex( $_POST['cardojo_term_color'] ) : '';

		    if ( $old_color && '' === $new_color )
		        delete_term_meta( $term_id, 'color' );

		    else if ( $old_color !== $new_color )
		        update_term_meta( $term_id, 'color', $new_color );

		    $color_type = isset( $_POST['color_type'] ) ? esc_attr( $_POST['color_type'] ) : '';
		    update_term_meta( $term_id, 'color_type', $color_type );
		}

		add_filter( 'manage_edit-vehicle_exterior_color_columns', 'cardojo_edit_term_columns' );

		function cardojo_edit_term_columns( $columns ) {

		    $columns['color'] = __( 'Color', 'cardojo' );

		    return $columns;
		}

		// Handle the output for the column
		add_filter( 'manage_vehicle_exterior_color_custom_column', 'cardojo_manage_term_custom_column', 10, 3 );

		function cardojo_manage_term_custom_column( $out, $column, $term_id ) {

		    if ( 'color' === $column ) {

		        $color = cardojo_get_term_color( $term_id, true );

		        if ( ! $color )
		            $color = '#ffffff';

		        $out = sprintf( '<span class="color-block" style="background:%s;">&nbsp;</span>', esc_attr( $color ) );
		    }

		    return $out;
		}

		// Interior Color
	    $singular  = __( 'Interior Color', 'cardojo' );
		$plural    = __( 'Interior Colors', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-int-color', 'vehicle interior color slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_interior_color",
			apply_filters( 'register_taxonomy_vehicle_interior_color_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_interior_color_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Color', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Color', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Color', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Color:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Color', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Color', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Color', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Color Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

		add_action( 'vehicle_interior_color_add_form_fields', 'ccp_new_term_interior_color_field' );

		function ccp_new_term_interior_color_field() {

		    wp_nonce_field( basename( __FILE__ ), 'cardojo_term_interior_color_nonce' ); ?>

		    <div class="form-field cardojo-term-color-wrap">
		        <label for="cardojo-term-color"><?php esc_html_e( 'Color', 'cardojo' ); ?></label>
		        <input type="text" name="cardojo_term_color" id="cardojo-term-color" value="" class="cardojo-color-field" data-default-color="#ffffff" />
		    </div>
	
			<div class="form-field cardojo-term-color-wrap">
				
				<label for="cardojo-term-color"><?php esc_html_e( 'Color Type', 'cardojo' ); ?></label>
		    	<input type="radio" name="color_type" value="default" checked> <?php esc_html_e('Default', 'cardojo' ); ?><br>
	  			<input type="radio" name="color_type" value="combined" > <?php esc_html_e('Combined', 'cardojo' ); ?><br>
	  			<input type="radio" name="color_type" value="na" > <?php esc_html_e('N/A', 'cardojo' ); ?>

		  	</div>

		<?php }

		add_action( 'vehicle_interior_color_edit_form_fields', 'ccp_edit_term_interior_color_field' );

		function ccp_edit_term_interior_color_field( $term ) {

		    $default      = '#ffffff';
		    $color        = cardojo_get_term_color( $term->term_id, true );
		    $color_type   = get_term_meta( $term->term_id, 'color_type', true );

		    if(empty($color_type)) {
		    	$color_type = "default";
		    }

		    if ( ! $color )
		        $color = $default; ?>

		    <tr class="form-field cardojo-term-color-wrap">
		        <th scope="row"><label for="cardojo-term-color"><?php esc_html_e( 'Color', 'cardojo' ); ?></label></th>
		        <td>
		            <?php wp_nonce_field( basename( __FILE__ ), 'cardojo_term_interior_color_nonce' ); ?>
		            <input type="text" name="cardojo_term_color" id="cardojo-term-color" value="<?php echo esc_attr( $color ); ?>" class="cardojo-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
		        </td>
		    </tr>

		    <tr class="form-field cardojo-term-color-wrap">
		        <th scope="row"><label for="cardojo-term-color"><?php esc_html_e( 'Color Type', 'cardojo' ); ?></label></th>
		        <td>
		            <?php wp_nonce_field( basename( __FILE__ ), 'cardojo_term_color_nonce' ); ?>
		            <input type="radio" name="color_type" value="default" <?php if($color_type == "default") { echo "checked"; } ?>> <?php esc_html_e('Default', 'cardojo' ); ?><br>
		  			<input type="radio" name="color_type" value="combined" <?php if($color_type == "combined") { echo "checked"; } ?>> <?php esc_html_e('Combined', 'cardojo' ); ?><br>
		  			<input type="radio" name="color_type" value="na" <?php if($color_type == "na") { echo "checked"; } ?>> <?php esc_html_e('N/A', 'cardojo' ); ?>
		        </td>
		    </tr>

		<?php }

		add_action( 'edited_vehicle_interior_color', 'cardojo_save_term_interior_color' );
		add_action( 'create_vehicle_interior_color', 'cardojo_save_term_interior_color' );

		function cardojo_save_term_interior_color( $term_id ) {

		    if ( ! isset( $_POST['cardojo_term_color_nonce'] ) || ! wp_verify_nonce( $_POST['cardojo_term_color_nonce'], basename( __FILE__ ) ) )
		        return;

		    $old_color = cardojo_get_term_color( $term_id );
		    $new_color = isset( $_POST['cardojo_term_color'] ) ? cardojo_sanitize_hex( $_POST['cardojo_term_color'] ) : '';

		    if ( $old_color && '' === $new_color )
		        delete_term_meta( $term_id, 'color' );

		    else if ( $old_color !== $new_color )
		        update_term_meta( $term_id, 'color', $new_color );

		    $color_type = isset( $_POST['color_type'] ) ? esc_attr( $_POST['color_type'] ) : '';
		    update_term_meta( $term_id, 'color_type', $color_type );
		}

		add_filter( 'manage_edit-vehicle_interior_color_columns', 'cardojo_edit_interior_term_columns' );

		function cardojo_edit_interior_term_columns( $columns ) {

		    $columns['color'] = __( 'Color', 'cardojo' );

		    return $columns;
		}

		// Handle the output for the column
		add_filter( 'manage_vehicle_interior_color_custom_column', 'cardojo_manage_interior_term_custom_column', 10, 3 );

		function cardojo_manage_interior_term_custom_column( $out, $column, $term_id ) {

		    if ( 'color' === $column ) {

		        $color = cardojo_get_term_color( $term_id, true );

		        if ( ! $color )
		            $color = '#ffffff';

		        $out = sprintf( '<span class="color-block" style="background:%s;">&nbsp;</span>', esc_attr( $color ) );
		    }

		    return $out;
		}

	    // Interior Materials
	    $singular  = __( 'Interior Material', 'cardojo' );
		$plural    = __( 'Interior Materials', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-interior-material', 'vehicle interior material slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_interior_material",
			apply_filters( 'register_taxonomy_vehicle_interior_type_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_interior_type_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Interior Material', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Interior Material', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Interior Material', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Interior Material:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Interior Material', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Interior Material', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Interior Material', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Interior Material Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Fuel Type
	    $singular  = __( 'Fuel Type', 'cardojo' );
		$plural    = __( 'Fuel Types', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-fuel-type', 'vehicle fule type slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_fuel_type",
			apply_filters( 'register_taxonomy_vehicle_fuel_type_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_fuel_type_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Fuel Type', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Fuel Type', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Fuel Type', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Fuel Type:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Fuel Type', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Fuel Type', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Fuel Type', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Fuel Type Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Transmission
	    $singular  = __( 'Transmission', 'cardojo' );
		$plural    = __( 'Transmissions', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-transmission', 'vehicle transmission slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_transmission",
			apply_filters( 'register_taxonomy_vehicle_transmission_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_transmission_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Transmission', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Transmission', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Transmission', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Transmission:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Transmission', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Transmission', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Transmission', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Transmission Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Drive
	    $singular  = __( 'Drive', 'cardojo' );
		$plural    = __( 'Drive', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-drive', 'vehicle drive slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_drive",
			apply_filters( 'register_taxonomy_vehicle_drive_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_drive_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Drive', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Drive', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Drive', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Drive:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Drive', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Drive', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Drive', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Drive Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Safety
	    $singular  = __( 'Safety', 'cardojo' );
		$plural    = __( 'Safety', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-safety', 'vehicle safety slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_safety",
			apply_filters( 'register_taxonomy_vehicle_safety_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_safety_args', array(
	            'hierarchical' 			=> false,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Safety', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Safety', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Safety', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Safety:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Safety', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Safety', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Safety', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Safety Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Comfort
	    $singular  = __( 'Comfort', 'cardojo' );
		$plural    = __( 'Comfort', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-comfort', 'vehicle comfort slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => true
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_comfort",
			apply_filters( 'register_taxonomy_vehicle_comfort_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_comfort_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Comfort', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Comfort', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Comfort', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Comfort:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Comfort', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Comfort', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Comfort', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Comfort Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Exterior
	    $singular  = __( 'Exterior', 'cardojo' );
		$plural    = __( 'Exterior', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-exterior', 'vehicle exterior slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => true
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_exterior",
			apply_filters( 'register_taxonomy_vehicle_exterior_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_exterior_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Exterior', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Exterior', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Exterior', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Exterior:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Exterior', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Exterior', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Exterior', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Exterior Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Interior
	    $singular  = __( 'Interior', 'cardojo' );
		$plural    = __( 'Interior', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-interior', 'vehicle interior slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => true
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_interior",
			apply_filters( 'register_taxonomy_vehicle_interior_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_interior_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Interior', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Interior', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Interior', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Interior:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Interior', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Interior', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Interior', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Interior Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Multimedia
	    $singular  = __( 'Multimedia', 'cardojo' );
		$plural    = __( 'Multimedia', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-multimedia', 'vehicle multimedia slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => false
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_multimedia",
			apply_filters( 'register_taxonomy_vehicle_multimedia_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_multimedia_args', array(
	            'hierarchical' 			=> false,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Multimedia', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Multimedia', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Multimedia', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Multimedia:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Multimedia', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Multimedia', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Multimedia', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Multimedia Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Visibility
	    $singular  = __( 'Visibility', 'cardojo' );
		$plural    = __( 'Visibility', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-visibility', 'vehicle visibility slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => true
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_visibility",
			apply_filters( 'register_taxonomy_vehicle_visibility_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_visibility_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Visibility', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Visibility', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Visibility', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Visibility:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Visibility', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Visibility', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Visibility', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Visibility Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Locations
	    $singular  = __( 'Location', 'cardojo' );
		$plural    = __( 'Locations', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-location', 'vehicle location slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => true
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_location",
			apply_filters( 'register_taxonomy_vehicle_location_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_location_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Location', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Location', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Location', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Location:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Location', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Location', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Location', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Location Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );

	    // Collections
	    $singular  = __( 'Collection', 'cardojo' );
		$plural    = __( 'Collections', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$rewrite   = array(
				'slug'         => _x( 'vehicle-collection', 'vehicle collection slug - resave permalinks after changing this', 'cardojo' ),
				'with_front'   => false,
				'hierarchical' => true
			);
			$public    = true;
		} else {
			$rewrite   = false;
			$public    = false;
		}

		register_taxonomy( "vehicle_collection",
			apply_filters( 'register_taxonomy_vehicle_collection_object_type', array( 'vehicle' ) ),
       	 	apply_filters( 'register_taxonomy_vehicle_collection_args', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> $plural,
	            'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search Collection', 'cardojo' ), $plural ),
					'all_items'         => sprintf( __( 'Collection', 'cardojo' ), $plural ),
					'parent_item'       => sprintf( __( 'Parent Collection', 'cardojo' ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent Collection:', 'cardojo' ), $singular ),
					'edit_item'         => sprintf( __( 'Edit Collection', 'cardojo' ), $singular ),
					'update_item'       => sprintf( __( 'Update Collection', 'cardojo' ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New Collection', 'cardojo' ), $singular ),
					'new_item_name'     => sprintf( __( 'New Collection Name', 'cardojo' ),  $singular )
            	),
	            'show_ui' 				=> true,
	            'show_tagcloud'			=> false,
	            'public' 	     		=> $public,
	            'rewrite' 				=> $rewrite,
	        ) )
	    );


	    function cardojo_add_default_term_colors( $term_id, $term_color ) {
		    update_term_meta( $term_id, 'color', $term_color );
		}

		function cardojo_add_default_term_color_types( $term_id, $term_type ) {
		    update_term_meta( $term_id, 'color_type', $term_type );
		}

	    $taxonomies = array(
			'vehicle_body_style' => array(
				'SUV',
				'Coupe',
				'Sport Utility Vehicle',
				'Hatchback',
				'Covertible',
				'Truck',
				'Station Wagon',
				'Van',
				'Minivan',
				'Sports Cars',
				'Compact Cars',
				'Roadster',
				'Pickup Truck',
				'Full-size car',
				'Luxury Vehicle',
				'Mid-size car',
				'Limousine',
				'Sedan'
			),
			'vehicle_exterior_color' => array(
				'Black',
				'White',
				'Silver',
				'Gray',
				'Beige',
				'Brown',
				'Gold',
				'Yellow',
				'Orange',
				'Red',
				'Pink',
				'Purple',
				'Blue',
				'Green',
				'Combined',
				'N/A'
			),
			'vehicle_interior_color' => array(
				'Black',
				'White',
				'Silver',
				'Gray',
				'Beige',
				'Brown',
				'Combined',
				'N/A'
			),
			'vehicle_fuel_type' => array(
				'Diesel',
				'Petrol',
				'LPG',
				'Hybrid',
				'Electric'
			),
			'vehicle_interior_material' => array(
				'Full Leather',
				'Part Leather',
				'Cloth',
				'Velour',
				'Cloth',
				'Alkantara',
				'Other'
			),
			'vehicle_transmission' => array(
				'Manual',
				'Automatic'
			),
			'vehicle_drive' => array(
				'Front-wheel drive',
				'Rear Wheel Drive',
				'4WD',
				'4x4',
				'AWD'
			),
			'vehicle_safety' => array(
				'ABS',
				'ESP',
				'Traction control',
				'Isofix (child seat anchor points)',
				'Lane Assist',
				'Blind spot monitor',
				'Driver airbag',
				'Knees airbag',
				'Passenger airbag',
				'Side airbags front',
				'Side airbags back',
				'Window curtain airbags',
				'Immobilizer',
				'Alarm/anti-theft system',
				'Night vision system',
				'Down hill assist',
				'Up hill assist',
				'Precolission system',
				'Central locking'
			),
			'vehicle_comfort' => array(
				'Air conditioning' => array(
					'Air conditioning',
					'A/C (man)',
					'Automatic air condition',
					'2 zone climate',
					'3 zone climate',
					'4 zone climate'
				),
				'Cruise control' => array(
					'Cruise control',
					'Standard cruise control',
					'Adaptive cruise control',
				),
				'Automatic parking',
				'Keyless entry',
				'Keyless engine start-stop',
				'Adaptive cruise-control',
				'Active steering wheel',
				'Tire pressure monitoring system',
				'Remote engine start',
				'Front heated seats',
				'Back heated seats',
				'Front ventilated seats',
				'Back ventilated seats',
				'On-board computer',
				'Privacy glass',
				'Power assisted steering' => array(
					'Power assisted steering',
					'Standard power assisted steering',
					'Hydraulic power assisted steering',
					'Electric power assiste steering'
				),
				'Electric steering wheel adjustment',
				'Seats position memory',
				'Electric windows',
				'Suspension' => array(
					'Suspension',
					'Standard suspension',
					'Sport suspension',
					'Air suspension',
					'Hydraulic suspension'
				),
				'Head-up display'
			),
			'vehicle_exterior' => array(
				'Rims Size' => array(
					'Rims Size',
					'12" whell size',
					'13" whell size',
					'14" whell size',
					'15" whell size',
					'16" whell size',
					'17" whell size',
					'17.5" whell size',
					'18" whell size',
					'19" whell size',
					'19.5" whell size',
					'20" whell size',
					'21" whell size',
					'22" whell size',
					'22.5" whell size',
					'23" whell size',
					'24" whell size',
					'25" whell size',
					'26" whell size',
					'28" whell size'
				),
				'Rims material' => array(
					'Rims material',
					'Alloy discs',
					'Steel discs',
					'Aluminium discs',
					'Plastic discs',
					'Stainless steel discs',
					'Metal discs',
					'PVC discs'
				),
				'Tyres' => array(
					'Tyres',
					'Winter tyres',
					'Summer tyres',
					'All seasons tyres'
				),
				'Aerography',
				'Decals / Vinyls',
				'Roof racks',
				'Trailer coupling',
				'Sports package'
			),
			'vehicle_interior' => array(
				'Auxiliary heating',
				'Tilt/telescope steering wheel adjustement' => array(
					'Tilt/telescope steering adjustment',
					'Tilt steering wheel adjustment',
					'Telescope steering wheel adjustment',
					'Tilt/Telescope steering wheel adjustment',
				),
				'Electric seat adjustment',
				'Roof' => array(
					'Roof',
					'Sun roof',
					'Panoramic roof'
				)
			),
			'vehicle_multimedia' => array(
				'AUX',
				'Bluetooth music streaming',
				'USB',
				'12V',
				'TV tuner',
				'CD changer',
				'DVD changer',
				'Navigation',
				'Hand-free kit',
				'MP3 support',
				'Multifunction steering wheel',
				'Wireless charging',
				'Apple car play',
				'Android auto'
			),
			'vehicle_visibility' => array(
				'Lights' => array(
					'Lights',
					'Halogen Lights',
					'Halogen/Xenon Lights',
					'Bi-xenon Lights',
					'Led/Xenon Lights',
					'Led Lights',
					'Laser Lights'
				),
				'Fog lamps',
				'Light sensor',
				'Rain sensor',
				'Adaptive lightning',
				'Auto high beam',
				'Rear-view camera',
				'360 degree camera',
				'Electric mirrors',
				'Heated mirrors',
				'Heated windscreen',
				'Front parking sensors',
				'Back parking sensors'
			),
			'vehicle_collection' => array(
				'Luxury',
				'Electric',
				'Budget'
			),
		);

		$cardojo_installed_terms = get_option( 'cardojo_installed_terms' );

		if( !isset($cardojo_installed_terms) OR empty($cardojo_installed_terms) ) {

			foreach ( $taxonomies as $taxonomy => $terms ) {

				foreach ( $terms as $term ) {

					if( is_array( $term ) ) {

						if ( ! get_term_by( 'slug', sanitize_title( $term[0] ), $taxonomy ) ) {
							
							$submit_term = wp_insert_term( $term[0], $taxonomy );

							if ( is_wp_error( $submit_term ) ) {
							   	$error_string = $submit_term->get_error_message();
							   	echo '<div id="message" class="error"><p>' . $error_string . ' - ' . $taxonomy . ' - ' . $s . '</p></div>';
							}

							if ( ! is_wp_error( $submit_term ) ) {
							    // Get term_id, set default as 0 if not set
							    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;

							    foreach ( $term as $sub_term ) {

									if ( ! get_term_by( 'slug', sanitize_title( $sub_term ), $taxonomy ) ) {

										if( $term[0] != $sub_term ) {

											$submit_term = wp_insert_term( $sub_term, $taxonomy, array( 'parent' => $term_id) );

										}

									}

								}
							}

						};

					} else {
						
						if ( ! get_term_by( 'slug', sanitize_title( $term ), $taxonomy ) ) {
							
							$submit_term = wp_insert_term( $term, $taxonomy );

							if ( ! is_wp_error( $submit_term ) ) {
							    // Get term_id, set default as 0 if not set
							    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
							}

							if ( is_wp_error( $submit_term ) ) {
							   	$error_string = $submit_term->get_error_message();
							   	echo '<div id="message" class="error"><p>' . $error_string . ' - ' . $taxonomy . ' - ' . $s . '</p></div>';
							}

							if( $taxonomy == "vehicle_exterior_color" OR $taxonomy == "vehicle_interior_color" ) {

								$term_color = "#ffffff";

								if($term == "White") {
									$term_color = "#ffffff";
									$term_type = "default";
								} elseif($term == "Black") {
									$term_color = "#000000";
									$term_type = "default";
								} elseif($term == "Silver") {
									$term_color = "#cccccc";
									$term_type = "default";
								} elseif($term == "Gray") {
									$term_color = "#949494";
									$term_type = "default";
								} elseif($term == "Beige") {
									$term_color = "#ebdec9";
									$term_type = "default";
								} elseif($term == "Brown") {
									$term_color = "#ab6f49";
									$term_type = "default";
								} elseif($term == "Gold") {
									$term_color = "#ebc458";
									$term_type = "default";
								} elseif($term == "Yellow") {
									$term_color = "#ffea0b";
									$term_type = "default";
								} elseif($term == "Orange") {
									$term_color = "#ff9e13";
									$term_type = "default";
								} elseif($term == "Red") {
									$term_color = "#e33535";
									$term_type = "default";
								} elseif($term == "Pink") {
									$term_color = "#ff4493";
									$term_type = "default";
								} elseif($term == "Purple") {
									$term_color = "#b26ee5";
									$term_type = "default";
								} elseif($term == "Blue") {
									$term_color = "#00a2ff";
									$term_type = "default";
								} elseif($term == "Green") {
									$term_color = "#5cb74d";
									$term_type = "default";
								} elseif($term == "Combined") {
									$term_color = "#666666";
									$term_type = "combined";
								} elseif($term == "N/A") {
									$term_color = "#666666";
									$term_type = "na";
								}
								
								cardojo_add_default_term_colors( $term_id, $term_color );
								cardojo_add_default_term_color_types( $term_id, $term_type );
							}
						}

					}

				}

			}

			if( !is_wp_error($submit_term) && isset($submit_term['term_id']) ) {
	            update_option( 'cardojo_installed_terms', 1 );
	        }

		} 

	    /**
		 * Post types
		 */
		$singular  = __( 'Car', 'cardojo' );
		$plural    = __( 'Cars', 'cardojo' );

		if ( current_theme_supports( 'vehicle-manager-templates' ) ) {
			$has_archive = _x( 'Cars', 'Post type archive slug - resave permalinks after changing this', 'cardojo' );
		} else {
			$has_archive = false;
		}

		$rewrite     = array(
			'slug'       => _x( 'vehicle', 'vehicle permalink - resave permalinks after changing this', 'cardojo' ),
			'with_front' => false,
			'feeds'      => true,
			'pages'      => false
		);

		register_post_type( "vehicle",
			apply_filters( "register_post_type_car", array(
				'labels' => array(
					'name'			=> $plural,
					'singular_name' 	=> $singular,
					'menu_name'             => __( 'Cars', 'cardojo' ),
					'all_items'             => sprintf( __( 'Inventory', 'cardojo' ), $plural ),
					'add_new' 		=> __( 'Add New Car', 'cardojo' ),
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
				'capability_type' 		=> 'vehicle',
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

		// Hide text editor in car back end
		add_action('init', 'init_remove_editor_car',100);
		function init_remove_editor_car(){
			$post_type = 'vehicle';
			remove_post_type_support( $post_type, 'editor');
		}

		/**
		 * Feeds
		 */
		add_feed( 'car_feed', array( $this, 'car_feed' ) );
	}

	/**
	 * Toggle filter on and off
	 */
	private function car_content_filter( $enable ) {
		if ( ! $enable ) {
			remove_filter( 'the_content', array( $this, 'car_content' ) );
		} else {
			add_filter( 'the_content', array( $this, 'car_content' ) );
		}
	}

	/**
	 * Add extra content before/after the post for single car listings.
	 */
	public function car_content( $content ) {
		global $post;

		if ( ! is_singular( 'vehicle' ) || ! in_the_loop() || 'vehicle' !== $post->post_type ) {
			return $content;
		}

		ob_start();

		$this->car_content_filter( false );

		do_action( 'car_content_start' );

		get_cardojo_template_part( 'content-single', 'vehicle' );

		do_action( 'car_content_end' );

		$this->car_content_filter( true );

		return apply_filters( 'cardojo_single_car_content', ob_get_clean(), $post );
	}

	/**
	 * car listing feeds
	 */
	public function car_feed() {
		$query_args = array(
			'post_type'           => 'vehicle',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => isset( $_GET['posts_per_page'] ) ? absint( $_GET['posts_per_page'] ) : 10,
			'tax_query'           => array(),
			'meta_query'          => array()
		);

		if ( ! empty( $_GET['car_categories'] ) ) {
			$cats     = explode( ',', sanitize_text_field( $_GET['car_categories'] ) ) + array( 0 );
			$field    = is_numeric( $cats ) ? 'term_id' : 'slug';
			$operator = 'all' === get_option( 'cardojo_category_filter_type', 'all' ) && sizeof( $args['search_categories'] ) > 1 ? 'AND' : 'IN';
			$query_args['tax_query'][] = array(
				'taxonomy'         => 'vehicle_model',
				'field'            => $field,
				'terms'            => $cats,
				'include_children' => $operator !== 'AND' ,
				'operator'         => $operator
			);
		}

		if ( $cardojo_keyword = sanitize_text_field( $_GET['search_keywords'] ) ) {
			$query_args['_keyword'] = $cardojo_keyword; // Does nothing but needed for unique hash
			add_filter( 'posts_clauses', 'get_cars_keyword_search' );
		}

		if ( empty( $query_args['meta_query'] ) ) {
			unset( $query_args['meta_query'] );
		}

		if ( empty( $query_args['tax_query'] ) ) {
			unset( $query_args['tax_query'] );
		}

		query_posts( apply_filters( 'car_feed_args', $query_args ) );
		add_action( 'rss2_ns', array( $this, 'car_feed_namespace' ) );
		add_action( 'rss2_item', array( $this, 'car_feed_item' ) );
		do_feed_rss2( false );
	}

	/**
	 * Add a custom namespace to the car feed
	 */
	public function car_feed_namespace() {
		echo 'xmlns:vehicle="' .  site_url() . '"' . "\n";
	}

	/**
	 * Add custom data to the car feed
	 */
	public function car_feed_item() {
		$post_id  = get_the_ID();
		
		/**
		 * Fires at the end of each car RSS feed item.
		 *
		 * @param int $post_id The post ID of the car.
		 */
		 do_action( 'car_feed_item', $post_id );
	}

	/**
	 * Fix post name when wp_update_post changes it
	 * @param  array $data
	 * @return array
	 */
	public function fix_car_post_name( $data, $postarr ) {

		global $post, $id;

	  	if( 'vehicle' == $data['post_type'] && isset($data['post_type']) ) {

	  		$id = $postarr['ID'];

			if($id) {

				$postID = $id;

				if( isset($_POST['cq-year'])) {
					$vehicle_year = sanitize_text_field( $_POST['cq-year'] );
				} else {
					$vehicle_year = "";
				}

				if( isset($_POST['cq-make'])) {
					$vehicle_make_slug = sanitize_text_field( $_POST['cq-make'] );
				} else {
					$vehicle_make_slug = "";
				}

				if( isset($_POST['vehicle_make_desc_init'])) {
					$vehicle_make_desc_init = sanitize_text_field( $_POST['vehicle_make_desc_init'] );
				} else {
					$vehicle_make_desc_init = "";
				}

				if( isset($_POST['cq-model'])) {
					$vehicle_model = sanitize_text_field( $_POST['cq-model'] );
				} else {
					$vehicle_model = "";
				}

				if( isset($_POST['vehicle_trim_desc_init'])) {
					$vehicle_trim_desc_init = sanitize_text_field( $_POST['vehicle_trim_desc_init'] );
				} else {
					$vehicle_trim_desc_init = "";
				}

				if( !empty($vehicle_year) AND !empty($vehicle_make_slug) AND !empty($vehicle_model) AND !empty($vehicle_trim_desc_init) ) {

					$postNewTitle = $vehicle_year . " " . $vehicle_make_slug . " " . $vehicle_model . " " . $vehicle_trim_desc_init . " #" . $postID;
					$data['post_name'] = sanitize_title( $postNewTitle );

				}

				if( !empty($vehicle_year) AND !empty($vehicle_make_desc_init) AND !empty($vehicle_model) AND !empty($vehicle_trim_desc_init) ) {

					$postNewName = $vehicle_year . " " . $vehicle_make_desc_init . " " . $vehicle_model . " " . $vehicle_trim_desc_init;
					$data['post_title'] = $postNewName;

				}

			}

		}

	  	return $data; // Returns the modified data.

	}


	/**
	 * Maybe set default meta data for car listings
	 * @param  int $post_id
	 * @param  WP_Post $post
	 */
	public function maybe_add_default_meta_data( $post_id, $post = '' ) {

		if ( empty( $post ) || 'vehicle' === $post->post_type ) {

			add_post_meta( $post_id, '_promoted', 0, true );
			add_post_meta( $post_id, '_featured', 0, true );
			add_post_meta( $post_id, '_paid_featured', 0, true );
			add_post_meta( $post_id, '_sold', 0, true );
			add_post_meta( $post_id, '_sold_date', "", true );
			add_post_meta( $post_id, '_submit_fee', 0, true );

			$cat_ids = array();

			$vehicle_year = esc_attr(get_post_meta($post_id, 'vehicle_year',true));
			$vehicle_make = esc_attr(get_post_meta($post_id, 'vehicle_make',true));
			$vehicle_model = esc_attr(get_post_meta($post_id, 'vehicle_model',true));
			$vehicle_trim_desc_init = esc_attr(get_post_meta($post_id, 'vehicle_trim_desc_init',true));
			$vehicle_make_desc_init = esc_attr(get_post_meta($post_id, 'vehicle_make_desc_init',true));

			if(!empty($vehicle_year)) {
				$v_year = $this->insert_term( $vehicle_year, 'vehicle_model' );
			}
			
			if( !empty($vehicle_year) AND !empty($vehicle_make) ) {
				$v_make = $this->insert_term( $vehicle_make_desc_init , 'vehicle_model', array('parent'=>$v_year['term_id']) );
			}

			if( !empty($vehicle_year) AND !empty($vehicle_make) AND !empty($vehicle_model) ) {
				$v_model = $this->insert_term( $vehicle_model, 'vehicle_model', array('parent'=>$v_make['term_id']) );
			}

			if( !empty($vehicle_year) AND !empty($vehicle_make) AND !empty($vehicle_model) AND !empty($vehicle_trim_desc_init) ) {

				$v_trim = $this->insert_term( $vehicle_trim_desc_init, 'vehicle_model', array('parent'=>$v_model['term_id']) );

				$cat_ids = array( $v_year['term_id'], $v_make['term_id'], $v_model['term_id'], $v_trim['term_id'] );
				$cat_ids = array_map( 'intval', $cat_ids );
				$cat_ids = array_unique( $cat_ids );

				$vehicle_model_set = wp_set_object_terms( $post_id, $cat_ids, 'vehicle_model' );
				
			}

		}

	}

	public function insert_term ($term, $taxonomy, $args = array()) {

        if (isset($args['parent'])) {
            $parent = $args['parent'];
        } else {
            $parent = 0;
        }
        $result = term_exists($term, $taxonomy, $parent);
        if ($result == false || $result == 0) {
            return wp_insert_term($term, $taxonomy, $args);             
        } else {
            return (array) $result;
        }       

	}

}
