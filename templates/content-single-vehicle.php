<?php 

	global $post;

	// Car
	$vehicle_condition = esc_attr(get_post_meta($post->ID, 'vehicle_condition',true));
	$vehicle_year = esc_attr(get_post_meta($post->ID, 'vehicle_year',true));
	$vehicle_make = esc_attr(get_post_meta($post->ID, 'vehicle_make',true));
	$vehicle_model = esc_attr(get_post_meta($post->ID, 'vehicle_model',true));
	$vehicle_trim_id = esc_attr(get_post_meta($post->ID, 'vehicle_trim_id',true));
	$vehicle_trim_desc_init = esc_attr(get_post_meta($post->ID, 'vehicle_trim_desc_init',true));
	$vehicle_make_desc_init = esc_attr(get_post_meta($post->ID, 'vehicle_make_desc_init',true));
	$vehicle_vin = esc_attr(get_post_meta($post->ID, 'vehicle_vin',true));

	//
	$vehicle_body_style = esc_attr(get_post_meta($post->ID, 'vehicle_body_style',true));
	$vehicle_doors = esc_attr(get_post_meta($post->ID, 'vehicle_doors',true));
	$vehicle_seats = esc_attr(get_post_meta($post->ID, 'vehicle_seats',true));

	//
	$vehicle_exterior_color = get_the_terms($post->ID, 'vehicle_exterior_color' );
	if(!empty($vehicle_exterior_color)) {
		$color      = cardojo_get_term_color( $vehicle_exterior_color[0]->term_id, true );
		$color_id   = $vehicle_exterior_color[0]->term_id;
		$color_name = $vehicle_exterior_color[0]->name;
		$color_type = get_term_meta( $vehicle_exterior_color[0]->term_id, 'color_type', true );
	} else {
		$color_type = "";
	}

	//

	$vehicle_body_style = get_the_terms($post->ID, 'vehicle_body_style' );
	if ($vehicle_body_style && ! is_wp_error($vehicle_body_style)) :
		$term_slugs_arr_cat = array();
			foreach ($vehicle_body_style as $term_cat) {
				$term_vehicle_body_style[] = $term_cat->name;
			}
		$terms_vehicle_body_style = join( " ", $term_vehicle_body_style);
	endif;

	$vehicle_fuel_type = get_the_terms($post->ID, 'vehicle_fuel_type' );
	if ($vehicle_fuel_type && ! is_wp_error($vehicle_fuel_type)) :
		$term_slugs_arr_cat = array();
			foreach ($vehicle_fuel_type as $term_cat) {
				$term_vehicle_fuel_type[] = $term_cat->name;
			}
		$terms_vehicle_fuel_type = join( " ", $term_vehicle_fuel_type);
	endif;

	$vehicle_drive = get_the_terms($post->ID, 'vehicle_drive' );
	if ($vehicle_drive && ! is_wp_error($vehicle_drive)) :
		$term_slugs_arr_cat = array();
			foreach ($vehicle_drive as $term_cat) {
				$term_vehicle_drive[] = $term_cat->name;
			}
		$terms_vehicle_drive = join( " ", $term_vehicle_drive);
	endif;

	$vehicle_transmission = get_the_terms($post->ID, 'vehicle_transmission' );
	if ($vehicle_transmission && ! is_wp_error($vehicle_transmission)) :
		$term_slugs_arr_cat = array();
			foreach ($vehicle_transmission as $term_cat) {
				$term_vehicle_transmission[] = $term_cat->name;
			}
		$terms_vehicle_transmission = join( " ", $term_vehicle_transmission);
	endif;

	//
	$vehicle_engine_type = esc_attr(get_post_meta($post->ID, 'vehicle_engine_type',true));
	$vehicle_cilinders = esc_attr(get_post_meta($post->ID, 'vehicle_cilinders',true));
	$vehicle_emission_class = esc_attr(get_post_meta($post->ID, 'vehicle_emission_class',true));

	//
	$vehicle_retail_price = esc_attr(get_post_meta($post->ID, 'vehicle_retail_price',true));
	$vehicle_discounted_price = esc_attr(get_post_meta($post->ID, 'vehicle_discounted_price',true));
	$price = esc_attr(get_post_meta($post->ID, 'vehicle_price',true));

	// Gallery
	$vehicle_image_gallery = get_post_meta($post->ID, 'vehicle_image_gallery',true);
	$vehicle_image_extended_gallery = get_post_meta($post->ID, 'vehicle_image_extended_gallery',true);

	// Car Details
	$vehicle_engine_volume_ccm = esc_attr(get_post_meta($post->ID, 'vehicle_engine_volume_ccm',true));
	$vehicle_power_hp = esc_attr(get_post_meta($post->ID, 'vehicle_power_hp',true));
	$vehicle_power_kw = esc_attr(get_post_meta($post->ID, 'vehicle_power_kw',true));
	$vehicle_max_power_rpm = esc_attr(get_post_meta($post->ID, 'vehicle_max_power_rpm',true));
	$vehicle_torque_nm = esc_attr(get_post_meta($post->ID, 'vehicle_torque_nm',true));
	$vehicle_max_torque_rpm = esc_attr(get_post_meta($post->ID, 'vehicle_max_torque_rpm',true));
	$vehicle_gears_num = esc_attr(get_post_meta($post->ID, 'vehicle_gears_num',true));
	$vehicle_mileage = esc_attr(get_post_meta($post->ID, 'vehicle_mileage',true));
	$vehicle_owners = esc_attr(get_post_meta($post->ID, 'vehicle_owners',true));

	$vehicle_condition_num = esc_attr(get_post_meta($post->ID, 'vehicle_condition_num',true));
	$vehicle_description = wp_kses(get_post_meta($post->ID, 'vehicle_description', true), true);

	$vehicle_stock = esc_attr(get_post_meta($post->ID, 'vehicle_stock',true));
	$vehicle_vin = esc_attr(get_post_meta($post->ID, 'vehicle_vin',true));
	$vehicle_carfax_link = esc_attr(get_post_meta($post->ID, 'vehicle_carfax_link',true));

	$vehicle_consumption_combined = esc_attr(get_post_meta($post->ID, 'vehicle_consumption_combined',true));
	$vehicle_consumption_urban = esc_attr(get_post_meta($post->ID, 'vehicle_consumption_urban',true));
	$vehicle_consumption_highway = esc_attr(get_post_meta($post->ID, 'vehicle_consumption_highway',true));
	$vehicle_emissions = esc_attr(get_post_meta($post->ID, 'vehicle_emissions',true));

	//
	$vehicle_length = esc_attr(get_post_meta($post->ID, 'vehicle_length',true));
	$vehicle_width = esc_attr(get_post_meta($post->ID, 'vehicle_width',true));
	$vehicle_height = esc_attr(get_post_meta($post->ID, 'vehicle_height',true));
	$vehicle_wheelbase = esc_attr(get_post_meta($post->ID, 'vehicle_wheelbase',true));
	$vehicle_weight = esc_attr(get_post_meta($post->ID, 'vehicle_weight',true));

	// Location
	$vehicle_location_name = "";
	$vehicle_location_mobile_phone = "";
	$vehicle_location_phone = "";
	$vehicle_location_email = "";
	$vehicle_location_address = "";
	$vehicle_location_latitude = "";
	$vehicle_location_longitude = "";

	$vehicle_location = get_the_terms($post->ID, 'vehicle_location' );
	if(!empty($vehicle_location)) {
		$term_id = $vehicle_location[0]->term_id;
		$vehicle_location_name = get_term_meta( $term_id, 'vehicle_location_name', true );
		$vehicle_location_mobile_phone = get_term_meta( $term_id, 'vehicle_location_mobile_phone', true );
		$vehicle_location_phone = get_term_meta( $term_id, 'vehicle_location_phone', true );
		$vehicle_location_email = get_term_meta( $term_id, 'vehicle_location_email', true );
		$vehicle_location_address = get_term_meta( $term_id, 'vehicle_location_address', true );
		$vehicle_location_latitude = get_term_meta( $term_id, 'vehicle_location_latitude', true );
		$vehicle_location_longitude = get_term_meta( $term_id, 'vehicle_location_longitude', true );
	}

	cardojo_setPostViews(get_the_ID());
	cardojo_setPostVisited(get_the_ID());

	// Enqueue styles
	wp_enqueue_style( 'jquery-ui' );
	wp_enqueue_style( 'bootstrap-select' );

	// Enqueue scripts
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'time-picker' );
	wp_enqueue_script( 'bootstrap-select' );

?>

<div class="single_car" itemscope itemtype=”http://schema.org/Product”>

	<meta itemprop="itemCondition" content="<?php echo esc_attr($vehicle_condition); ?>" >
	<meta itemprop="modelYear" content="<?php echo esc_attr($vehicle_year); ?>" >
	<meta itemprop="manufacturer" content="<?php echo esc_attr($vehicle_make_desc_init); ?>" >
	<meta itemprop="model" content="<?php echo esc_attr($vehicle_model); ?>" >
	<meta itemprop="modelTrim" content="<?php echo esc_attr($vehicle_trim_desc_init); ?>" >
	<meta itemprop="sku" content="<?php echo esc_attr($vehicle_stock); ?>" >

	<?php
		/**
		 * single_car_start hook
		 *
		 */
		do_action( 'single_car_start' );
	?>

	<div class="text-uppercase sidebar-car-meta">

      	<div class="car-color <?php if($color_type == "combined") { echo "car_combined_color"; } elseif($color_type == "na") { echo "car_na_color"; } ?>" <?php if(!empty($color)) { echo "style='background-color: ". $color .";'"; } ?>></div>

      	<p>
      		<?php if(!empty($color_name)) { echo esc_attr($color_name); echo " "; } ?>
      		<?php if(!empty($terms_vehicle_body_style)) { echo esc_attr($terms_vehicle_body_style); echo ", "; } ?>
      		<?php if(!empty($vehicle_seats)) { echo esc_attr($vehicle_seats); echo " "; esc_html_e('seats', 'cardojo' ); echo ", "; } ?>
      		<?php if(!empty($vehicle_doors)) { echo esc_attr($vehicle_doors); echo " "; esc_html_e('doors', 'cardojo' ); echo ", "; } ?>
      		<?php if(!empty($vehicle_engine_type)) { echo esc_attr($vehicle_engine_type); } ?><?php if(!empty($vehicle_cilinders)) { echo esc_attr($vehicle_cilinders); echo ", "; } ?>
      		<?php if(!empty($vehicle_emission_class)) { echo esc_attr($vehicle_emission_class); } ?>
      	</p>

      	<span class="car-id"><?php esc_html_e('id', 'cardojo' ); ?> <?php echo get_the_ID(); ?></span>

    </div>

    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="cardojo-price-list">
      	<h2 itemprop="price" class="cardojo-price"><?php echo cardojo_price($price); ?> <?php if(!empty($vehicle_discounted_price)) { ?><s><?php echo cardojo_price($vehicle_retail_price); ?></s><?php } ?></h2>
    </div>

    <!-- carousel -->
  	<div id="cd-item-slider" class="carousel slide" data-ride="carousel">

	    <!-- Wrapper for slides -->
	    <div class="carousel-inner rounded" role="listbox">
			
			<?php

				$i = 0;

				if(!empty($vehicle_image_gallery)) {

					foreach ($vehicle_image_gallery as $vehicle_image_gallery_item) {
						
						if( !empty($vehicle_image_gallery_item['url']) ) {

			?>

	      	<div class="item overlayed1 <?php if($i == 0) { ?>active<?php } ?>" data-bg="<?php echo esc_url($vehicle_image_gallery_item['url']); ?>"></div>

	      	<?php $i++; } } } ?>

	      	<?php

				if(!empty($vehicle_image_extended_gallery)) {

					foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
						
						if( !empty($vehicle_image_extended_gallery_item['url']) ) {

			?>

	      	<div class="item overlayed1 <?php if($i == 0) { ?>active<?php } ?>" data-bg="<?php echo esc_url($vehicle_image_extended_gallery_item['url']); ?>"></div>

	      	<?php $i++; } } } ?>

	    </div>

	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      	
	      	<?php

				$i = 0;

				if(!empty($vehicle_image_gallery)) {

					foreach ($vehicle_image_gallery as $vehicle_image_gallery_item) {
						
						if( !empty($vehicle_image_gallery_item['url']) ) {

			?>

	      	<li class="thumbnail <?php if($i == 0) { ?>active<?php } ?>" data-target="#cd-item-slider" data-slide-to="<?php echo $i; ?>" data-bg="<?php echo esc_url($vehicle_image_gallery_item['url']); ?>"></li>

	      	<?php $i++; } } } ?>

	      	<?php

				if(!empty($vehicle_image_extended_gallery)) {

					foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
						
						if( !empty($vehicle_image_extended_gallery_item['url']) ) {

			?>

	      	<li class="thumbnail <?php if($i == 0) { ?>active<?php } ?>" data-target="#cd-item-slider" data-slide-to="<?php echo $i; ?>" data-bg="<?php echo esc_url($vehicle_image_extended_gallery_item['url']); ?>"></li>

	      	<?php $i++; } } } ?>
	      	
	    </ol>

	    <div class="clearfix"></div>

  	</div>
  	<!-- /.carousel -->

  	<div class="cd-condition-blk">

        <div class="blk">
          
          	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 15.4 12.1" style="enable-background:new 0 0 15.4 12.1;" xml:space="preserve">
          		<path class="st0" d="M14.9,6.2c-0.3,0-0.5,0.2-0.5,0.5v0.6h-1.1V6.8c0-0.3-0.2-0.5-0.5-0.5h-0.7l-0.7-0.7V3.3c0-0.3-0.2-0.5-0.5-0.5
            H5.1V1.5h1.8c0.3,0,0.5-0.2,0.5-0.5S7.1,0.5,6.9,0.5h-4C2.5,0.5,2.3,0.8,2.3,1s0.2,0.5,0.5,0.5h1.8v1.3H2.8C2.5,2.8,2.3,3,2.3,3.3
            v2.8H1V4.4c0-0.3-0.2-0.5-0.5-0.5S0,4.1,0,4.4v4c0,0.3,0.2,0.5,0.5,0.5S1,8.7,1,8.4V6.6h1.3v3c0,0.3,0.2,0.5,0.5,0.5h1.3l0.3,0.3
            v0.9c0,0.3,0.2,0.5,0.5,0.5h7.8c0.3,0,0.5-0.2,0.5-0.5v-0.5h1.1v0.7c0,0.3,0.2,0.5,0.5,0.5s0.5-0.2,0.5-0.5v-1.2V7.8V6.7
            C15.4,6.5,15.2,6.2,14.9,6.2z M12.8,9.9c-0.3,0-0.5,0.2-0.5,0.5v0.5H5.5v-0.7c0-0.1-0.1-0.3-0.2-0.4L4.7,9.3
            C4.6,9.2,4.4,9.1,4.3,9.1h-1V3.8h7.1v2.1c0,0.1,0.1,0.3,0.1,0.4l1,1c0.1,0.1,0.2,0.1,0.4,0.1h0.4v0.5c0,0.3,0.2,0.5,0.5,0.5h1.6v1.5
            H12.8z"></path>
          	</svg>

          	<h6 class="heading text-uppercase"><?php esc_html_e('Engine', 'cardojo' ); ?></h6>
          	<h5 class="heading"><?php if(!empty($vehicle_engine_volume_ccm)) { echo esc_attr($vehicle_engine_volume_ccm); echo " "; esc_html_e('ccm', 'cardojo' ); } ?></h5>
          	<h5 class="heading"><?php if(!empty($terms_vehicle_fuel_type)) { echo esc_attr($terms_vehicle_fuel_type); } ?></h5>
          	<h5 class="heading"><?php if(!empty($vehicle_power_hp)) { echo esc_attr($vehicle_power_hp); echo " "; esc_html_e('hp', 'cardojo' ); }?> <?php if(!empty($vehicle_power_kw)) { ?>(<?php echo esc_attr($vehicle_power_kw); ?> <?php esc_html_e('KW', 'cardojo' ); ?>)<?php } ?> <?php if(!empty($vehicle_max_power_rpm)) { ?>@ <?php echo esc_attr($vehicle_max_power_rpm); ?> <?php esc_html_e('rpm', 'cardojo' ); ?><?php } ?></h5>
          	<h5 class="heading"><?php if(!empty($vehicle_torque_nm)) { echo esc_attr($vehicle_torque_nm); echo " "; esc_html_e('Nm', 'cardojo' ); } ?> <?php if(!empty($vehicle_max_torque_rpm)) { ?>@ <?php echo esc_attr($vehicle_max_torque_rpm); ?> <?php esc_html_e('rpm', 'cardojo' ); ?><?php } ?></h5>

        </div>

        <div class="blk">

          	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 12.1 7.2" style="enable-background:new 0 0 12.1 7.2;" xml:space="preserve">
	          	<style type="text/css">
	            .st0{fill:#606161;}
	          	</style>
	          	<g>
	            	<path class="st0" d="M6,1.5c-2.5,0-4.5,2-4.5,4.5c0,0.1,0.1,0.2,0.2,0.2S2,6.2,2,6c0-2.2,1.8-4,4-4c1.2,0,2.3,0.5,3,1.4
	              c0.1,0.1,0.2,0.1,0.4,0c0.1-0.1,0.1-0.2,0-0.4C8.6,2.1,7.4,1.5,6,1.5z"></path>
	            	<path class="st0" d="M6,0C2.7,0,0,2.7,0,6c0,0.3,0.2,0.5,0.5,0.5S1,6.3,1,6c0-2.8,2.3-5,5-5s5,2.3,5,5c0,0.3,0.2,0.5,0.5,0.5
	              s0.5-0.2,0.5-0.5C12.1,2.7,9.4,0,6,0z"></path>
	            	<path class="st0" d="M8,4L6.4,5.6C6.3,5.6,6.2,5.5,6,5.5c-0.4,0-0.8,0.4-0.8,0.8S5.6,7.2,6,7.2s0.8-0.4,0.8-0.8
	              c0-0.1,0-0.3-0.1-0.4l1.6-1.6c0.1-0.1,0.1-0.3,0-0.4S8.1,3.9,8,4z M6,6.7c-0.2,0-0.3-0.1-0.3-0.3S5.9,6,6,6s0.3,0.1,0.3,0.3
	              S6.2,6.7,6,6.7z"></path>
	          	</g>
          	</svg>

          	<h6 class="heading text-uppercase"><?php esc_html_e('Usage', 'cardojo' ); ?></h6>
          	<h5 class="heading"><?php if(!empty($vehicle_year)) { echo esc_attr($vehicle_year); } ?></h5>
          	<h5 class="heading"><?php if(!empty($vehicle_condition)) { echo esc_attr($vehicle_condition); } ?></h5>
          	<h5 class="heading"><?php if(!empty($vehicle_mileage)) { echo cardojo_number($vehicle_mileage); $unit_system = get_option( 'cardojo_measurement_type' ); if( empty($unit_system) OR $unit_system == "metric") { echo " "; echo "Km"; } else { echo " "; echo "Mi"; } } ?></h5>
          	<h5 class="heading"><?php if(!empty($vehicle_owners)) { echo esc_attr($vehicle_owners); echo " "; if($vehicle_owners == 1) { esc_html_e('Owner', 'cardojo' ); } else { esc_html_e('Owners', 'cardojo' ); } } ?></h5>

        </div>

        <div class="blk">

          	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16.8 14.1" style="enable-background:new 0 0 16.8 14.1;" xml:space="preserve">
          	<path class="st0" d="M16.8,2.4c0-1.3-1.1-2.4-2.4-2.4C13.1,0,12,1.1,12,2.4c0,1.2,0.9,2.2,2.1,2.4v2.1H8.6V4.7
            c1.2-0.1,2.1-1.1,2.1-2.4C10.8,1.1,9.7,0,8.4,0C7.1,0,6,1.1,6,2.4c0,1.2,0.9,2.2,2.1,2.4v2.1H2.6V4.7c1.2-0.1,2.1-1.1,2.1-2.4
            C4.8,1.1,3.7,0,2.4,0C1.1,0,0,1.1,0,2.4c0,1.2,0.9,2.2,2.1,2.4v4.6C0.9,9.5,0,10.5,0,11.8c0,1.3,1.1,2.4,2.4,2.4
            c1.3,0,2.4-1.1,2.4-2.4c0-1.2-0.9-2.2-2.1-2.4V7.3h5.5v2.1C6.9,9.5,6,10.5,6,11.8c0,1.3,1.1,2.4,2.4,2.4c1.3,0,2.4-1.1,2.4-2.4
            c0-1.2-0.9-2.2-2.1-2.4V7.3h5.8c0.1,0,0.2-0.1,0.2-0.2V4.7C15.8,4.6,16.8,3.6,16.8,2.4z M7,2.4C7,1.6,7.6,1,8.4,1
            c0.8,0,1.4,0.6,1.4,1.4S9.2,3.8,8.4,3.8C7.6,3.8,7,3.2,7,2.4z M1,2.4C1,1.6,1.6,1,2.4,1c0.8,0,1.4,0.6,1.4,1.4S3.2,3.8,2.4,3.8
            C1.6,3.8,1,3.2,1,2.4z M3.8,11.8c0,0.8-0.6,1.4-1.4,1.4c-0.8,0-1.4-0.6-1.4-1.4s0.6-1.4,1.4-1.4C3.2,10.4,3.8,11,3.8,11.8z
             M9.8,11.8c0,0.8-0.6,1.4-1.4,1.4c-0.8,0-1.4-0.6-1.4-1.4s0.6-1.4,1.4-1.4C9.2,10.4,9.8,11,9.8,11.8z M14.4,3.8
            c-0.8,0-1.4-0.6-1.4-1.4S13.6,1,14.4,1c0.8,0,1.4,0.6,1.4,1.4S15.2,3.8,14.4,3.8z"></path>
          	</svg>

          	<h6 class="heading text-uppercase"><?php esc_html_e('Transmission', 'cardojo' ); ?></h6>
          	<h5 class="heading"><?php if(!empty($terms_vehicle_transmission)) { echo esc_attr($terms_vehicle_transmission); } ?></h5>
          	<h5 class="heading"><?php if(!empty($vehicle_gears_num)) { echo esc_attr($vehicle_gears_num); echo " "; esc_html_e('Speeds', 'cardojo' ); } ?></h5>
          	<h5 class="heading"><?php if(!empty($terms_vehicle_drive)) { echo esc_attr($terms_vehicle_drive); } ?></h5>

        </div>

  	</div>

  	<div class="listing-title">

      	<h4 class="heading"><?php esc_html_e('Listing description', 'cardojo' ); ?></h4>

      	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16.8 13.9" style="enable-background:new 0 0 16.8 13.9;" xml:space="preserve">
	      	<g>
		        <path class="st0" d="M11.2,3H5C4.9,3,4.7,3.2,4.7,3.3S4.9,3.5,5,3.5h6.2c0.1,0,0.2-0.1,0.2-0.2S11.3,3,11.2,3z"></path>
		        <path class="st0" d="M10.5,4.6H4.3c-0.1,0-0.2,0.1-0.2,0.2s0.1,0.2,0.2,0.2h6.2c0.1,0,0.2-0.1,0.2-0.2S10.7,4.6,10.5,4.6z"></path>
		        <path class="st0" d="M10.1,6.2H3.9c-0.1,0-0.2,0.1-0.2,0.2s0.1,0.2,0.2,0.2h6.2c0.1,0,0.2-0.1,0.2-0.2S10.2,6.2,10.1,6.2z"></path>
		        <path class="st0" d="M9.7,7.8H3.5C3.3,7.8,3.2,7.9,3.2,8s0.1,0.2,0.2,0.2h6.2c0.1,0,0.2-0.1,0.2-0.2S9.8,7.8,9.7,7.8z"></path>
		        <path class="st0" d="M5.9,9.3H3.1C3,9.3,2.9,9.4,2.9,9.6S3,9.8,3.1,9.8h2.8c0.1,0,0.2-0.1,0.2-0.2S6,9.3,5.9,9.3z"></path>
		        <path class="st0" d="M15.5,0.2C15.4,0.1,15.3,0,15.1,0h-11C4,0,3.9,0.1,3.8,0.2C0.6,4.4,0.2,13,0.2,13.4c0,0.1,0,0.3,0.1,0.4
		          c0.1,0.1,0.2,0.2,0.4,0.2h10.5c0.3,0,0.5-0.2,0.5-0.4c0-0.1,0.6-5.7,2.4-9.9h2.5c0.1,0,0.2-0.1,0.2-0.2C16.8,1.5,15.9,0.5,15.5,0.2
		          z M10.7,12.9H1.2C1.3,11,2,4.4,4.4,1h9.8C11.8,4.8,10.9,11.1,10.7,12.9z M15.5,0.9c0.3,0.4,0.7,1.1,0.8,2.2h-2
		          C14.6,2.2,15,1.5,15.5,0.9z"></path>
	      	</g>
      	</svg>

    </div>
	
	<?php if(!empty($vehicle_condition_num)) { ?>
    <div class="listing-content">

      	<h3 class="pull-left"><?php esc_html_e('Condition', 'cardojo' ); ?> <?php echo esc_attr($vehicle_condition_num); ?><span class="condition-indicator">/100</span></h3>
      	<span class="condition-label text-uppercase pull-right">
		<?php

			switch ($vehicle_condition_num){

		        case ($vehicle_condition_num >= 90 && $vehicle_condition_num <= 100): 
		            echo esc_html_e('Perfect', 'cardojo' );
		        break;

		        case ($vehicle_condition_num >= 80 && $vehicle_condition_num <= 90): 
		            echo esc_html_e('Almost perfect', 'cardojo' );
		        break;

		        case ($vehicle_condition_num >= 70 && $vehicle_condition_num <= 80): 
		            echo esc_html_e('Mint condition', 'cardojo' );
		        break;

		        case ($vehicle_condition_num >= 60 && $vehicle_condition_num <= 70): 
		            echo esc_html_e('Good', 'cardojo' );
		        break;

		        case ($vehicle_condition_num >= 50 && $vehicle_condition_num <= 60): 
		            echo esc_html_e('Medium', 'cardojo' );
		        break;

		        case ($vehicle_condition_num >= 0 && $vehicle_condition_num <= 50): 
		            echo esc_html_e('Damaged', 'cardojo' );
		        break;

		        default: //default
		            echo "-";
		        break;
	     	}

		?>
      	</span>

      	<div class="clearfix"></div>
	
		<div class="vehicle_description">
      		<?php echo wpautop($vehicle_description, true); ?>
      	</div>

    </div>
    <?php } ?>
	
	<?php if(!empty($vehicle_carfax_link)) { ?>
    <ul class="list-inline certified-list">

      	<li>
        	<img src="<?php echo CARDOJO_PLUGIN_URL; ?>/assets/images/carfax-logo_03.png" alt="carfax-logo" class="img-responsive">
      	</li>
		<?php

			if(!empty($vehicle_vin)) {

				$final = substr($vehicle_vin, 0, -7) . "*******";

		?>
      	<li>
        	<span class="cd-item-vin-number"><?php esc_html_e('VIN Number', 'cardojo' ); ?>: <?php echo esc_attr($final); ?></span>
      	</li>
      	<?php } ?>

      	<li class="text-right">
        	<a href="<?php echo esc_url($vehicle_carfax_link); ?>" class="btn-link" target="_blank">
          		<i class="fa fa-external-link"></i><?php esc_html_e('Verify carfax vehicle history report', 'cardojo' ); ?>
        	</a>
      	</li>

    </ul>
    <?php } ?>

    <div class="listing-content">

      	<h3 class="heading"><?php esc_html_e('Vehicles features and specification', 'cardojo' ); ?></h3>

      	<div class="row columns-content">
            <div class="col-sm-6">
              
              	<!-- consumption -->
              	<div class="column-blk">

	                <div class="title">
	                  	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 14.7 14.2" style="enable-background:new 0 0 14.7 14.2;" xml:space="preserve">
		                  <g>
		                    <path class="st0" d="M14.6,5.8L11.8,3c-0.1-0.1-0.3-0.1-0.4,0s-0.1,0.3,0,0.4l1.1,1.1l0,1.5c0,0.1,0,0.1,0.1,0.2l1.6,1.6v2.9
		                      c0,0.5-0.4,0.8-0.8,0.8s-0.8-0.4-0.8-0.8V9.5c0-1.5-1.1-2.7-2.5-3V0.8c0-0.3-0.2-0.5-0.5-0.5h-7C2.2,0.3,2,0.5,2,0.8v12.4H0.5
		                      c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h2h7h2c0.3,0,0.5-0.2,0.5-0.5s-0.2-0.5-0.5-0.5H10V7.1c1.2,0.2,2,1.3,2,2.5v1.1
		                      c0,0.7,0.6,1.3,1.3,1.3s1.3-0.6,1.3-1.3V6C14.7,5.9,14.7,5.9,14.6,5.8z M9,1.3v5.2H3V1.3H9z M3,13.2V7h6v6.1H3z M13,5.9L13,5
		                      l1.1,1.1v1L13,5.9z"></path>
		                    <path class="st0" d="M4.5,5.7c0.8-0.8,2.1-0.8,2.9,0c0,0,0.1,0.1,0.2,0.1s0.1,0,0.2-0.1c0.1-0.1,0.1-0.3,0-0.4
		                      C7.6,5.1,7.3,5,7.1,4.9l0.3-0.6C7.4,4.2,7.4,4,7.3,4S7,4,6.9,4.1L6.6,4.7c-0.8-0.2-1.8,0-2.4,0.7c-0.1,0.1-0.1,0.3,0,0.4
		                      C4.3,5.8,4.4,5.8,4.5,5.7z"></path>
		                  </g>
	                  	</svg>
	                  	<h4 class="heading"><?php esc_html_e('Consumption & Emissions', 'cardojo' ); ?></h4>
	                </div>

	                <ol class="list-unstyled">

	                  	<li>
		                    <span class="pull-left">~<?php if(!empty($vehicle_consumption_combined)) { echo esc_attr($vehicle_consumption_combined); } ?><?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('l/100km', 'cardojo' ); } else { esc_html_e('mpg', 'cardojo' ); } ?> (<?php esc_html_e('combined', 'cardojo' ); ?>)</span>
		                    <span class="pull-right"><?php if(!empty($vehicle_emissions)) { echo esc_attr($vehicle_emissions); ?><?php esc_html_e('g CO2/km', 'cardojo' ); } ?></span>
	                  	</li>

	                  	<li class="clearfix"></li>

	                  	<li>
		                    <span class="pull-left">~<?php if(!empty($vehicle_consumption_urban)) { echo esc_attr($vehicle_consumption_urban); } ?><?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('l/100km', 'cardojo' ); } else { esc_html_e('mpg', 'cardojo' ); } ?> (<?php esc_html_e('urban', 'cardojo' ); ?>)</span>
		                    <span class="pull-right"><?php if(!empty($vehicle_emission_class)) { echo esc_attr($vehicle_emission_class); } ?></span>
	                  	</li>

	                  	<li class="clearfix"></li>

	                  	<li>
	                    	<span class="pull-left">~<?php if(!empty($vehicle_consumption_highway)) { echo esc_attr($vehicle_consumption_highway); } ?><?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('l/100km', 'cardojo' ); } else { esc_html_e('mpg', 'cardojo' ); } ?> (<?php esc_html_e('extra-urban', 'cardojo' ); ?>)</span>
	                  	</li>

	                  	<li class="clearfix"></li>

	                </ol>

              	</div>

              	<!-- safety -->
              	<div class="column-blk">

	                <div class="title">

	                  	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 12.8 13.6" style="enable-background:new 0 0 12.8 13.6;" xml:space="preserve">
		                  	<g>
			                    <path class="st0" d="M12.2,0H0.5C0.2,0,0,0.2,0,0.5v6.7c0,3.5,2.9,6.4,6.4,6.4s6.4-2.9,6.4-6.4V0.5C12.8,0.2,12.5,0,12.2,0z
			                       M11.8,7.2c0,3-2.4,5.4-5.4,5.4S1,10.1,1,7.2V1h10.8V7.2z"></path>
			                    <path class="st0" d="M6.4,9.3c0.1,0,0.2-0.1,0.2-0.2V2.6c0-0.1-0.1-0.2-0.2-0.2S6.1,2.5,6.1,2.6v6.4C6.1,9.2,6.2,9.3,6.4,9.3z"></path>
		                  	</g>
	                  	</svg>

	                  	<h4 class="heading"><?php esc_html_e('Safety', 'cardojo' ); ?></h4>

	                </div>

                	<ul class="list-unstyled checked">
						
						<?php 

							$vehicle_safety = wp_get_post_terms( $post->ID, 'vehicle_safety', array( 'orderby' => 'name', 'order' => 'ASC') ); 

							if( $vehicle_safety && ! is_wp_error($vehicle_safety) ) { 

								foreach ($vehicle_safety as $vehicle_safety_item) {

									$nume_cat = $vehicle_safety_item->name;
									$id_cat = $vehicle_safety_item->term_id;

									if( !cd_category_has_children($id_cat) ) {

									?>

			                    	<li><?php echo esc_attr($nume_cat); ?></li>

			                    	<?php

			                    	}

		                    	} 

	                    	} 

                    	?>

                	</ul>
              	</div>

              	<!-- exterior -->
              	<div class="column-blk">
                
	                <div class="title">

	                  	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 14.4 6.9" style="enable-background:new 0 0 14.4 6.9;" xml:space="preserve">
	                  		<path class="st0" d="M12.9,2l-2-0.3c-0.1,0-0.2-0.1-0.3-0.1l-1-0.8C9,0.3,8.3,0,7.6,0H4.9C3.9,0,3,0.4,2.4,1.2L2.2,1.5
	                    C2.1,1.6,1.9,1.7,1.8,1.7L1.2,1.8C0.5,1.9,0,2.5,0,3.2v1.1C0,5,0.5,5.5,1.2,5.5h0.5c0.1,0.8,0.8,1.4,1.6,1.4c0.8,0,1.5-0.6,1.6-1.4
	                    h4.4c0.1,0.8,0.8,1.4,1.6,1.4c0.8,0,1.5-0.6,1.6-1.4h0.7c0.7,0,1.2-0.5,1.2-1.2V3.7C14.4,2.9,13.8,2.1,12.9,2z M3.3,5.9
	                    C3,5.9,2.7,5.6,2.7,5.2c0-0.4,0.3-0.6,0.6-0.6S4,4.9,4,5.2C4,5.6,3.7,5.9,3.3,5.9z M11,5.9c-0.4,0-0.6-0.3-0.6-0.6
	                    c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C11.6,5.6,11.3,5.9,11,5.9z M13.9,4.3c0,0.4-0.3,0.7-0.7,0.7h-0.7c-0.1-0.8-0.8-1.4-1.6-1.4
	                    c-0.8,0-1.5,0.6-1.6,1.4H4.9C4.8,4.2,4.1,3.6,3.3,3.6C2.5,3.6,1.8,4.2,1.7,5H1.2C0.8,5,0.5,4.7,0.5,4.3V3.2c0-0.5,0.3-0.8,0.8-0.9
	                    l0.6-0.1c0.3,0,0.5-0.2,0.7-0.4l0.2-0.3c0.5-0.6,1.3-1,2.1-1h2.6c0.6,0,1.3,0.2,1.7,0.6l1,0.8c0.2,0.1,0.4,0.2,0.6,0.3l2,0.3
	                    c0.6,0.1,1.1,0.6,1.1,1.3V4.3z"></path>
	                  	</svg>

	                  	<h4 class="heading"><?php esc_html_e('Exterior', 'cardojo' ); ?></h4>

	                </div>

	                <ul class="list-unstyled checked">

	                    <?php 

							$vehicle_exterior = wp_get_post_terms( $post->ID, 'vehicle_exterior', array( 'orderby' => 'name', 'order' => 'ASC') ); 

							if( $vehicle_exterior && ! is_wp_error($vehicle_exterior) ) { 

								foreach ($vehicle_exterior as $vehicle_exterior_item) {

									$nume_cat = $vehicle_exterior_item->name;
									$id_cat = $vehicle_exterior_item->term_id;

									if( !cd_category_has_children($id_cat) ) {

									?>

			                    	<li><?php echo esc_attr($nume_cat); ?></li>

			                    	<?php

			                    	}

		                    	} 

	                    	} 

                    	?>
	                    
	                </ul>

              	</div>

              	<!-- multimedia -->
              	<div class="column-blk">

	                <div class="title">

	                  	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 17.4 13.8" style="enable-background:new 0 0 17.4 13.8;" xml:space="preserve">
	                  		<path class="st0" d="M17.4,2.7C17.4,2.7,17.4,2.7,17.4,2.7c0-0.1,0-0.2-0.1-0.2c0,0,0-0.1-0.1-0.1c0,0,0,0-0.1-0.1c0,0,0,0-0.1-0.1
	                    c0,0-0.1,0-0.1,0c0,0,0,0,0,0L6.2,0c0,0,0,0-0.1,0c0,0,0,0-0.1,0c0,0,0,0,0,0C6,0,6,0,6,0c0,0-0.1,0-0.1,0c0,0,0,0-0.1,0
	                    c0,0-0.1,0-0.1,0.1c0,0,0,0,0,0.1c0,0,0,0.1,0,0.1c0,0,0,0,0,0c0,0,0,0,0,0.1c0,0,0,0,0,0.1v7.6C5,7.6,4.2,7.2,3.3,7.2
	                    C1.5,7.2,0,8.7,0,10.5s1.5,3.3,3.3,3.3c0.5,0,1-0.1,1.4-0.3c1.1-0.5,1.9-1.7,1.9-3V4l9.8,2.1v2.8c-0.5-0.4-1.1-0.7-1.8-0.7
	                    c-1.5,0-2.8,1.2-2.8,2.8s1.2,2.8,2.8,2.8c1.5,0,2.8-1.2,2.8-2.8L17.4,2.7C17.4,2.8,17.4,2.7,17.4,2.7z M4.3,12.6
	                    C4.3,12.6,4.3,12.6,4.3,12.6c-0.3,0.1-0.6,0.2-1,0.2c-1.3,0-2.3-1-2.3-2.3s1-2.3,2.3-2.3s2.3,1,2.3,2.3C5.6,11.4,5.1,12.2,4.3,12.6z
	                     M6.6,3.5V1.1l9.8,2.1v2.4L6.6,3.5z M14.6,12.8c-1,0-1.8-0.8-1.8-1.8s0.8-1.8,1.8-1.8c1,0,1.8,0.8,1.8,1.8S15.6,12.8,14.6,12.8z"></path>
	                  	</svg>

	                  	<h4 class="heading"><?php esc_html_e('Multimedia', 'cardojo' ); ?></h4>

	                </div>

	                <ul class="list-unstyled checked">
	                  
	                  	<?php 

							$vehicle_multimedia = wp_get_post_terms( $post->ID, 'vehicle_multimedia', array( 'orderby' => 'name', 'order' => 'ASC') ); 

							if( $vehicle_multimedia && ! is_wp_error($vehicle_multimedia) ) { 

								foreach ($vehicle_multimedia as $vehicle_multimedia_item) {

									$nume_cat = $vehicle_multimedia_item->name;
									$id_cat = $vehicle_multimedia_item->term_id;

									if( !cd_category_has_children($id_cat) ) {

									?>

			                    	<li><?php echo esc_attr($nume_cat); ?></li>

			                    	<?php

			                    	}

		                    	} 

	                    	} 

                    	?>

	                </ul>

              	</div>

        	</div>

            <div class="col-sm-6">
              
              	<!-- comfort -->
              	<div class="column-blk">
                
	                <div class="title">
	                  	
	                  	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 17.6 14.9" style="enable-background:new 0 0 17.6 14.9;" xml:space="preserve">
	                  		<path class="st0" d="M16.3,6.3c-0.3-0.3-0.7-0.4-1-0.6l0.6-2.4c0.1-0.8-0.2-1.6-0.7-2.2c-0.5-0.6-1.3-0.9-2.1-0.9H4.7
	                    c-0.8,0-1.6,0.3-2.1,0.9C2.1,1.8,1.9,2.6,2,3.4l0.6,2.4c-0.4,0.1-0.7,0.3-1,0.6c-0.6,0.5-1,1.3-1,2.2c0,1.3,0.8,2.4,2,2.7
	                    c0.2,0.1,0.3,0.2,0.3,0.5l0.3,2.5c0,0.3,0.2,0.4,0.5,0.4h2.1c0.3,0,0.5-0.2,0.5-0.5v-1.5h5.4v1.5c0,0.3,0.2,0.5,0.5,0.5h2.1
	                    c0.3,0,0.5-0.2,0.5-0.4l0.3-2.5c0-0.2,0.1-0.4,0.3-0.4c1.2-0.4,2-1.5,2-2.7C17.3,7.7,17,6.9,16.3,6.3z M2.5,3.3C2.4,2.7,2.6,2,3,1.5
	                    s1.1-0.8,1.7-0.8h8.4c0.7,0,1.3,0.3,1.7,0.8s0.6,1.1,0.6,1.8l-0.6,2.4c-0.3,0-0.5,0-0.8,0c-1.1,0.2-2,1-2.3,2.1
	                    c-1-0.3-3.2-0.8-5.7,0c-0.3-1.1-1.2-2-2.3-2.2c-0.3,0-0.5,0-0.8,0L2.5,3.3z M2.8,10.3C2,10,1.5,9.3,1.5,8.5c0-0.5,0.2-1.1,0.7-1.4
	                    c0.4-0.4,1-0.5,1.5-0.4c0.9,0.1,1.5,1,1.5,2v3.5H3.9l0-0.5C3.8,11,3.4,10.5,2.8,10.3z M5.2,13.6H4l-0.1-1h1.3V13.6z M6.2,12.1V8.9
	                    c2.5-0.8,4.7-0.3,5.4,0v3.3H6.2z M12.6,13.6v-1h1.3l-0.1,1H12.6z M15,10.3c-0.6,0.2-1,0.7-1,1.3l-0.1,0.5h-1.3V8.6
	                    c0-1,0.7-1.8,1.5-2c0.6-0.1,1.1,0.1,1.5,0.4c0.4,0.4,0.7,0.9,0.7,1.4C16.3,9.3,15.8,10,15,10.3z"></path>
	                  	</svg>

	                  	<h4 class="heading"><?php esc_html_e('Comfort', 'cardojo' ); ?></h4>

	                </div>

	                <ul class="list-unstyled checked">
	                  	
	                  	<?php 

							$vehicle_comfort = wp_get_post_terms( $post->ID, 'vehicle_comfort', array( 'orderby' => 'name', 'order' => 'ASC') ); 

							if( $vehicle_comfort && ! is_wp_error($vehicle_comfort) ) { 

								foreach ($vehicle_comfort as $vehicle_comfort_item) {

									$nume_cat = $vehicle_comfort_item->name;
									$id_cat = $vehicle_comfort_item->term_id;

									if( !cd_category_has_children($id_cat) ) {

									?>

			                    	<li><?php echo esc_attr($nume_cat); ?></li>

			                    	<?php

			                    	}

		                    	} 

	                    	} 

                    	?>

	                </ul>

              	</div>

              	<!-- interior -->
              	<div class="column-blk">

	                <div class="title">

	                  	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16.9 16.9" style="enable-background:new 0 0 16.9 16.9;" xml:space="preserve">
	                  		<g>
			                    <path class="st0" d="M8.4,0C3.8,0,0,3.8,0,8.4c0,4.7,3.8,8.5,8.4,8.5s8.5-3.8,8.5-8.5C16.9,3.8,13.1,0,8.4,0z M8.4,15.9
			                      C4.3,15.9,1,12.6,1,8.4S4.3,1,8.4,1c4.1,0,7.5,3.3,7.5,7.4S12.6,15.9,8.4,15.9z"></path>
			                    <path class="st0" d="M8.4,1.8c-3.3,0-6,2.4-6.5,5.6c0,0,0,0,0,0c0,0,0,0,0,0c-0.1,0.3-0.1,0.7-0.1,1c0,3.6,3,6.6,6.6,6.6
			                      c3.6,0,6.6-3,6.6-6.6S12.1,1.8,8.4,1.8z M12.2,7.7h2.3c0,0.3,0.1,0.5,0.1,0.8c0,0.1,0,0.2,0,0.3l-2.3,0.4c0-0.2,0.1-0.4,0.1-0.6
			                      C12.3,8.2,12.3,7.9,12.2,7.7z M8.4,2.3c2.9,0,5.4,2.1,6,4.8H12c-0.5-1.5-2-2.6-3.7-2.6S5.2,5.6,4.7,7.2H2.5
			                      C3.1,4.4,5.5,2.3,8.4,2.3z M8.4,11.4c-1.6,0-2.9-1.3-2.9-2.9c0-1.6,1.3-2.9,2.9-2.9s2.9,1.3,2.9,2.9C11.3,10.1,10,11.4,8.4,11.4z
			                       M2.3,8.4c0-0.3,0-0.5,0.1-0.8h2.1C4.5,7.9,4.4,8.2,4.4,8.4c0,0.2,0,0.4,0.1,0.6L2.4,8.7C2.3,8.6,2.3,8.5,2.3,8.4z M2.4,9.2
			                      l2.2,0.4C5,10.8,5.9,11.7,7,12.1l0.4,2.4C4.8,14,2.7,11.9,2.4,9.2z M7.9,14.5l-0.4-2.3c0.3,0.1,0.6,0.1,0.9,0.1
			                      c0.4,0,0.7-0.1,1.1-0.2L9,14.5c-0.2,0-0.4,0-0.6,0C8.3,14.6,8.1,14.6,7.9,14.5z M9.5,14.5L10,12c1-0.5,1.8-1.3,2.1-2.4l2.4-0.4
			                      C14.2,11.9,12.1,14,9.5,14.5z"></path>
			                    <path class="st0" d="M8.4,7C7.6,7,6.9,7.7,6.9,8.4s0.6,1.4,1.4,1.4s1.4-0.6,1.4-1.4S9.2,7,8.4,7z M8.4,9.4C7.9,9.4,7.4,9,7.4,8.4
			                      s0.4-0.9,0.9-0.9s0.9,0.4,0.9,0.9S8.9,9.4,8.4,9.4z"></path>
	                  		</g>
	                  	</svg>

	                  	<h4 class="heading"><?php esc_html_e('Interior', 'cardojo' ); ?></h4>

	                </div>

	                <ul class="list-unstyled checked">
		                  
	                	<?php 

							$vehicle_interior = wp_get_post_terms( $post->ID, 'vehicle_interior', array( 'orderby' => 'name', 'order' => 'ASC') ); 

							if( $vehicle_interior && ! is_wp_error($vehicle_interior) ) { 

								foreach ($vehicle_interior as $vehicle_interior_item) {

									$nume_cat = $vehicle_interior_item->name;
									$id_cat = $vehicle_interior_item->term_id;

									if( !cd_category_has_children($id_cat) ) {

									?>

			                    	<li><?php echo esc_attr($nume_cat); ?></li>

			                    	<?php

			                    	}

		                    	} 

	                    	} 

                    	?>

	                </ul>

              	</div>

              	<!-- visibility -->
              	<div class="column-blk">

	                <div class="title">

	                  	<svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 14.5 13.3" style="enable-background:new 0 0 14.5 13.3;" xml:space="preserve">
		                  	<g>
			                    <path class="st0" d="M8,7C7.9,7.1,7.9,7.2,7.9,7.4c0,0.1,0.1,0.1,0.2,0.1c0,0,0.1,0,0.1,0l3.3-1.8c0.1-0.1,0.2-0.2,0.1-0.3
			                      c-0.1-0.1-0.2-0.2-0.3-0.1L8,7z"></path>
			                    <path class="st0" d="M14.4,6.7L14,5.8c0,0,0,0,0,0l-0.1-0.2c0,0,0.1-0.1,0.1-0.1c0.5-1.7-0.5-3.6-2.2-4.1c0,0-0.1,0-0.1,0l-0.1-0.2
			                      c0,0,0,0,0,0l-0.5-0.9c-0.1-0.2-0.4-0.3-0.7-0.2C10,0.2,9.9,0.5,10.1,0.7l0.2,0.4l-5.5,3C4.7,4.2,4.6,4.3,4.5,4.5
			                      c0,0.1,0,0.3,0,0.4l0.3,0.6L2.4,6.8C2.4,6.9,2.3,6.9,2.3,7c0,0.1,0,0.1,0,0.2l0.1,0.3L1.1,8.2L0.9,7.9C0.8,7.7,0.5,7.6,0.3,7.7
			                      C0,7.9-0.1,8.2,0.1,8.4c0,0,0,0,1.6,3c0.1,0.2,0.3,0.3,0.4,0.3c0.1,0,0.2,0,0.2-0.1c0.2-0.1,0.3-0.4,0.2-0.7l-0.1-0.3l1.4-0.8
			                      l0.1,0.3c0,0.1,0.1,0.1,0.2,0.1c0,0,0.1,0,0.1,0l2.5-1.4l0.3,0.6c0.1,0.1,0.2,0.2,0.3,0.2c0,0,0.1,0,0.1,0c0.1,0,0.2,0,0.2-0.1
			                      l5.5-3l0.2,0.4c0.1,0.2,0.3,0.3,0.4,0.3c0.1,0,0.2,0,0.2-0.1C14.5,7.2,14.6,6.9,14.4,6.7z M2.2,10.2L1.3,8.6l1.4-0.8l0.9,1.6
			                      L2.2,10.2z M13.5,5l-1.6-3C13,2.5,13.7,3.7,13.5,5z M4.3,9.7L3.1,7.6L3,7.4l0,0L2.9,7.2l2.3-1.2l1.4,2.5L4.3,9.7z M7.8,8.6L5.7,4.8
			                      l5.1-2.8l2.1,3.8L7.8,8.6z"></path>
			                    <path class="st0" d="M6.9,11.1V11c0-0.3-0.2-0.5-0.5-0.5S5.9,10.7,5.9,11v0.1l-1.5,1.5c-0.1,0.1-0.1,0.3,0,0.4c0,0,0.1,0.1,0.2,0.1
			                      s0.1,0,0.2-0.1l1.1-1.1v1c0,0.3,0.2,0.5,0.5,0.5s0.5-0.2,0.5-0.5v-1L8.1,13c0,0,0.1,0.1,0.2,0.1s0.1,0,0.2-0.1
			                      c0.1-0.1,0.1-0.3,0-0.4L6.9,11.1z"></path>
		                  	</g>
	                  	</svg>

	                  	<h4 class="heading"><?php esc_html_e('Visibility', 'cardojo' ); ?></h4>

	                </div>
	                
	                <ul class="list-unstyled checked">
	                  	
	                  	<?php 

							$vehicle_visibility = wp_get_post_terms( $post->ID, 'vehicle_visibility', array( 'orderby' => 'name', 'order' => 'ASC') ); 

							if( $vehicle_visibility && ! is_wp_error($vehicle_visibility) ) { 

								foreach ($vehicle_visibility as $vehicle_visibility_item) {

									$nume_cat = $vehicle_visibility_item->name;
									$id_cat = $vehicle_visibility_item->term_id;

									if( !cd_category_has_children($id_cat) ) {

									?>

			                    	<li><?php echo esc_attr($nume_cat); ?></li>

			                    	<?php

			                    	}

		                    	} 

	                    	} 

                    	?>
	                  
	                </ul>

              	</div>

            </div>

      	</div>

  	</div>

  	<div class="listing-content">

      	<h3 class="heading"><?php esc_html_e('Dimensions & Weight', 'cardojo' ); ?></h3>

      	<div class="specs-box noborder">
          	<!-- width -->
          	<div class="car-width flexbox">

	            <span><?php if( !empty($vehicle_length) ) { echo esc_attr($vehicle_length); } else { echo esc_html_e('N/A', 'cardojo' ); } ?> <?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?></span>
	              <!-- icon -->
	            <svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 44.3 38.9" style="enable-background:new 0 0 44.3 38.9;" xml:space="preserve">
	            <style type="text/css">
	              .st5{fill:none;stroke:#d3d5da;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
	              .st6{fill:none;stroke:#d3d5da;stroke-width:0.5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
	              .st7{fill:#d3d5da;}
	            </style>
	            <path class="st5" d="M79.4,23.8H58.3c-0.3,0-0.6-0.3-0.6-0.6v-6.1c0-1.8,1.5-3.3,3.3-3.3h15.7c1.8,0,3.3,1.5,3.3,3.3v6.1
	              C80,23.6,79.8,23.8,79.4,23.8z"></path>
	            <path class="st5" d="M62.2,23.8V26c0,0.8-0.7,1.5-1.5,1.5h-1.6c-0.8,0-1.5-0.7-1.5-1.5v-3.8"></path>
	            <path class="st5" d="M75.5,23.8V26c0,0.8,0.7,1.5,1.5,1.5h1.6c0.8,0,1.5-0.7,1.5-1.5v-3.8"></path>
	            <path class="st6" d="M77.8,13.8H59.9l0.7-3.3c0.2-1.1,1-2.2,2.2-2.2h12c1.2,0,2,1.1,2.2,2.2L77.8,13.8z"></path>
	            <circle class="st6" cx="62.2" cy="18" r="1.8"></circle>
	            <circle class="st6" cx="75.5" cy="18" r="1.8"></circle>
	            <line class="st6" x1="66.6" y1="18" x2="71.2" y2="18"></line>
	            <line class="st6" x1="57.7" y1="21.5" x2="80" y2="21.5"></line>
	            <line class="st6" x1="57.7" y1="2.8" x2="80" y2="2.8"></line>
	            <polyline class="st6" points="78.1,1 79.8,2.8 78.1,4.5 "></polyline>
	            <polyline class="st6" points="59.7,4.5 58,2.8 59.7,1 "></polyline>
	            <line class="st6" x1="57.7" y1="0" x2="57.7" y2="5.5"></line>
	            <line class="st6" x1="80" y1="0" x2="80" y2="5.5"></line>
	            <line class="st6" x1="92.9" y1="27.5" x2="92.9" y2="8.2"></line>
	            <polyline class="st6" points="91.2,10.1 92.9,8.4 94.6,10.1 "></polyline>
	            <polyline class="st6" points="94.6,25.4 92.9,27.1 91.2,25.4 "></polyline>
	            <line class="st6" x1="90.2" y1="27.5" x2="95.7" y2="27.5"></line>
	            <line class="st6" x1="90.2" y1="8.2" x2="95.7" y2="8.2"></line>
	            <g>
	              <path class="st7" d="M39.1,13.8L33.8,13c-0.4-0.1-0.8-0.2-1.2-0.5l-3.1-2.5c-1.8-1.4-4-2.2-6.3-2.2h-8.3c-3,0-5.8,1.3-7.7,3.7
	                l-0.7,0.8c-0.4,0.5-0.9,0.8-1.5,0.9c-3.1,0.5-5.3,3.2-5.3,6.3v1.5c0,1.9,1.5,3.4,3.4,3.4h2.6c0.2,2,2,3.6,4.1,3.6
	                c2.1,0,3.8-1.6,4.1-3.6h15.9c0.2,2,2,3.6,4.1,3.6c2.1,0,3.8-1.6,4.1-3.6h3.1c1.9,0,3.4-1.5,3.4-3.4v-0.8
	                C44.5,16.9,42.2,14.3,39.1,13.8z M7.3,12.8L8,12c1.7-2.1,4.2-3.3,6.9-3.3h8.3c2.1,0,4.1,0.7,5.7,2l3.1,2.5L6.9,13.3
	                C7,13.1,7.2,13,7.3,12.8z M9.9,27c-1.7,0-3.1-1.4-3.1-3.1s1.4-3.1,3.1-3.1c1.7,0,3.1,1.4,3.1,3.1S11.6,27,9.9,27z M33.9,27
	                c-1.7,0-3.1-1.4-3.1-3.1s1.4-3.1,3.1-3.1c1.7,0,3.1,1.4,3.1,3.1S35.6,27,33.9,27z M43.5,20.9c0,1.3-1.1,2.4-2.4,2.4h-3.1
	                c-0.2-2-2-3.6-4.1-3.6c-2.1,0-3.8,1.6-4.1,3.6H13.9c-0.2-2-2-3.6-4.1-3.6c-2.1,0-3.8,1.6-4.1,3.6H3.2c-1.3,0-2.4-1.1-2.4-2.4v-1.5
	                c0-2.6,1.9-4.9,4.5-5.3c0.3,0,0.5-0.1,0.8-0.2l26.8-0.1c0.3,0.1,0.5,0.2,0.8,0.2l5.3,0.8c2.7,0.4,4.6,2.7,4.6,5.4V20.9z"></path>
	              <path class="st7" d="M33.9,32.9c-0.1,0-0.2,0.1-0.2,0.2v2.4L32.1,34c-0.1-0.1-0.3-0.1-0.4,0s-0.1,0.3,0,0.4l1.3,1.3H10.7l1.3-1.3
	                c0.1-0.1,0.1-0.3,0-0.4c-0.1-0.1-0.3-0.1-0.4,0l-1.6,1.6v-2.4c0-0.1-0.1-0.2-0.2-0.2s-0.2,0.1-0.2,0.2v5.5c0,0.1,0.1,0.2,0.2,0.2
	                s0.2-0.1,0.2-0.2v-2.4l1.6,1.6c0,0,0.1,0.1,0.2,0.1c0.1,0,0.1,0,0.2-0.1c0.1-0.1,0.1-0.3,0-0.4l-1.3-1.3H33l-1.3,1.3
	                c-0.1,0.1-0.1,0.3,0,0.4c0,0,0.1,0.1,0.2,0.1s0.1,0,0.2-0.1l1.5-1.5v2.4c0,0.1,0.1,0.2,0.2,0.2s0.2-0.1,0.2-0.2v-5.5
	                C34.1,33.1,34,32.9,33.9,32.9z"></path>
	              <path class="st7" d="M0.2,5.8c0.1,0,0.2-0.1,0.2-0.2V3.1l1.6,1.6c0,0,0.1,0.1,0.2,0.1s0.1,0,0.2-0.1c0.1-0.1,0.1-0.3,0-0.4L1.1,3
	                h42l-1.3,1.3c-0.1,0.1-0.1,0.3,0,0.4c0,0,0.1,0.1,0.2,0.1s0.1,0,0.2-0.1l1.5-1.5v2.4c0,0.1,0.1,0.2,0.2,0.2s0.2-0.1,0.2-0.2V0
	                c0-0.1-0.1-0.2-0.2-0.2S43.8-0.1,43.8,0v2.4l-1.5-1.5c-0.1-0.1-0.3-0.1-0.4,0c-0.1,0.1-0.1,0.3,0,0.4l1.3,1.3h-42l1.3-1.3
	                c0.1-0.1,0.1-0.3,0-0.4s-0.3-0.1-0.4,0L0.5,2.4V0c0-0.1-0.1-0.2-0.2-0.2S0-0.1,0,0v5.5C0,5.6,0.1,5.8,0.2,5.8z"></path>
	            </g>
	            </svg>
	            <!-- /.icon -->

	            <span><?php if(!empty($vehicle_wheelbase)) { echo esc_attr($vehicle_wheelbase); } else { echo esc_html_e('N/A', 'cardojo' ); } ?> <?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?></span>

          	</div>

          	<!-- height & weight -->
          	<div class="car-height flexbox flexbox-start">
	            
	            <span><?php if(!empty($vehicle_width)) { echo esc_attr($vehicle_width); } else { echo esc_html_e('N/A', 'cardojo' ); } ?> <?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?></span>
	              <!-- icon -->
	            <svg class="svg-icon grey" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 39.2 28.2" style="enable-background:new 0 0 39.2 28.2;" xml:space="preserve">
	              <style type="text/css">
	                  .st8{fill:none;stroke:#ccc;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
	                  .st9{fill:none;stroke:#ccc;stroke-width:0.5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
	                  .st10{fill:#ccc;}
	              </style>
	              <g>
	                <circle class="st8" cx="-46.9" cy="24.1" r="3.6"></circle>
	                <circle class="st8" cx="-22.9" cy="24.1" r="3.6"></circle>
	                <line class="st0" x1="-43.3" y1="24.1" x2="-26.5" y2="24.1"></line>
	                <path class="st0" d="M-50.5,24.1h-3.1c-1.6,0-2.9-1.3-2.9-2.9v-1.5c0-2.9,2.1-5.3,4.9-5.8h0c0.7-0.1,1.3-0.5,1.8-1l0.7-0.8
	                    c1.8-2.2,4.5-3.5,7.3-3.5h8.3c2.2,0,4.3,0.7,6,2.1l3.1,2.5c0.4,0.3,0.9,0.5,1.4,0.6l5.3,0.8c2.9,0.4,5,2.9,5,5.9v0.8
	                    c0,1.6-1.3,2.9-2.9,2.9h-3.6"></path>
	              </g>
	                <line class="st9" x1="-46.9" y1="36.2" x2="-22.9" y2="36.2"></line>
	                <polyline class="st9" points="-24.9,34.5 -23.2,36.2 -24.9,37.9 "></polyline>
	                <polyline class="st9" points="-44.9,37.9 -46.6,36.2 -44.9,34.5 "></polyline>
	                <line class="st9" x1="-46.9" y1="33.4" x2="-46.9" y2="38.9"></line>
	                <line class="st9" x1="-22.9" y1="33.4" x2="-22.9" y2="38.9"></line>
	              <g>
	                <path class="st10" d="M21.3,13.7l-0.7-3.1c-0.2-1.2-1-2.4-2.5-2.4h-12c-1.4,0-2.3,1.3-2.5,2.4L3,13.7c-1.5,0.5-2.5,1.9-2.5,3.6v5.1
	                  v1.1v2.7c0,1.1,0.9,2,2,2H4c1.1,0,2-0.9,2-2v-1.6h12.3v1.6c0,1.1,0.9,2,2,2h1.6c1.1,0,2-0.9,2-2v-2.7v-1.1v-5.1
	                   C23.8,15.7,22.7,14.3,21.3,13.7z M4.1,10.7c0.2-1,0.8-2,2-2h12c1.1,0,1.8,1,2,2l0.6,2.9c-0.2-0.1-0.5-0.1-0.8-0.1H4.3
	                  c-0.3,0-0.5,0-0.8,0.1L4.1,10.7z M22.8,22.4v1.1c0,0.1-0.1,0.1-0.1,0.1H1.6c-0.1,0-0.1-0.1-0.1-0.1v-1.1V22h21.3V22.4z M5,26.2
	                    c0,0.5-0.4,1-1,1H2.4c-0.5,0-1-0.4-1-1v-1.7c0,0,0.1,0,0.1,0H5V26.2z M21.8,27.2h-1.6c-0.5,0-1-0.4-1-1v-1.6h3.4c0,0,0.1,0,0.1,0
	                    v1.7C22.8,26.8,22.3,27.2,21.8,27.2z M22.8,21.5H1.4v-4.2c0-1.6,1.3-2.8,2.8-2.8h15.7c1.6,0,2.8,1.3,2.8,2.8V21.5z"></path>
	                <path class="st10" d="M5.5,16.2c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S6.6,16.2,5.5,16.2z M5.5,19.8c-0.8,0-1.5-0.7-1.5-1.5
	                  s0.7-1.5,1.5-1.5c0.8,0,1.5,0.7,1.5,1.5S6.3,19.8,5.5,19.8z"></path>
	                <path class="st10" d="M18.8,16.2c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S19.9,16.2,18.8,16.2z M18.8,19.8c-0.8,0-1.5-0.7-1.5-1.5
	                    s0.7-1.5,1.5-1.5c0.8,0,1.5,0.7,1.5,1.5S19.6,19.8,18.8,19.8z"></path>
	                <path class="st10" d="M14.4,18H9.8c-0.1,0-0.2,0.1-0.2,0.2s0.1,0.2,0.2,0.2h4.6c0.1,0,0.2-0.1,0.2-0.2S14.6,18,14.4,18z"></path>
	                <path class="st10" d="M0.9,6c0.1,0,0.2-0.1,0.2-0.2V3.3l1.6,1.6c0,0,0.1,0.1,0.2,0.1c0.1,0,0.1,0,0.2-0.1c0.1-0.1,0.1-0.3,0-0.4
	                    L1.8,3.3h20.6l-1.3,1.3c-0.1,0.1-0.1,0.3,0,0.4c0,0,0.1,0.1,0.2,0.1s0.1,0,0.2-0.1L23,3.4v2.4C23,5.9,23.1,6,23.3,6
	                    s0.2-0.1,0.2-0.2V0.2c0-0.1-0.1-0.2-0.2-0.2S23,0.1,23,0.2v2.4l-1.5-1.5c-0.1-0.1-0.3-0.1-0.4,0c-0.1,0.1-0.1,0.3,0,0.4l1.3,1.3
	                    H1.8l1.3-1.3c0.1-0.1,0.1-0.3,0-0.4S2.8,1,2.7,1.1L1.2,2.7V0.2C1.2,0.1,1.1,0,0.9,0S0.7,0.1,0.7,0.2v5.5C0.7,5.9,0.8,6,0.9,6z"></path>
	                <path class="st10" d="M38.9,27.5h-2.5l1.6-1.6c0.1-0.1,0.1-0.3,0-0.4s-0.3-0.1-0.4,0l-1.3,1.3V9.2l1.3,1.3c0,0,0.1,0.1,0.2,0.1
	                   s0.1,0,0.2-0.1c0.1-0.1,0.1-0.3,0-0.4l-1.5-1.5h2.3c0.1,0,0.2-0.1,0.2-0.2S39,8.2,38.9,8.2h-5.5c-0.1,0-0.2,0.1-0.2,0.2
	                    s0.1,0.2,0.2,0.2h2.3l-1.5,1.5c-0.1,0.1-0.1,0.3,0,0.4c0.1,0.1,0.3,0.1,0.4,0l1.3-1.3v17.6l-1.3-1.3c-0.1-0.1-0.3-0.1-0.4,0
	                    s-0.1,0.3,0,0.4l1.6,1.6h-2.5c-0.1,0-0.2,0.1-0.2,0.2s0.1,0.2,0.2,0.2h5.5c0.1,0,0.2-0.1,0.2-0.2S39,27.5,38.9,27.5z"></path>
	              </g>
	              <line class="st9" x1="-56.5" y1="3" x2="-12.8" y2="3"></line>
	              <polyline class="st9" points="-14.7,1.3 -13,3 -14.7,4.7 "></polyline>
	              <polyline class="st9" points="-54.5,4.7 -56.3,3 -54.5,1.3 "></polyline>
	              <line class="st9" x1="-56.5" y1="0.2" x2="-56.5" y2="5.8"></line>
	              <line class="st9" x1="-12.8" y1="0.2" x2="-12.8" y2="5.8"></line>
	              <line class="st9" x1="-51.6" y1="13.8" x2="-23.1" y2="13.7"></line>
	            </svg>
	            <!-- /. icon -->

	            <span><?php if(!empty($vehicle_weight)) { echo esc_attr($vehicle_weight); } else { echo esc_html_e('N/A', 'cardojo' ); } ?> <?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('kg', 'cardojo' ); } else { esc_html_e('lbs', 'cardojo' ); } ?></span>
	            <span class="pull-right"><?php if(!empty($vehicle_height)) { echo esc_attr($vehicle_height); } else { echo esc_html_e('N/A', 'cardojo' ); } ?> <?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?></span>

          	</div>
          	<div class="clearfix"></div>

        </div>

  	</div>

  	<?php

  		$website_type = get_option("cardojo_webiste_type");
  		if( !empty($website_type) AND $website_type == "marketplace" ) {

  	?>

  	<div class="listing-content">

      	<h3 class="heading"><?php esc_html_e('Owner contact info', 'cardojo' ); ?></h3>

  		<div class="cd-map-wrapp">

            <div class="cd-dealer-address">

            	<?php

            		// Dealer Info
            		$user_id = get_the_author_meta('ID');

					$dealer_name = get_user_meta( $user_id, 'dealer_name', true );
					$mobile_phone = get_user_meta( $user_id, 'mobile_phone', true );
					$office_phone = get_user_meta( $user_id, 'office_phone', true );

					$dealer_address = get_user_meta( $user_id, 'dealer_address', true );
					$dealer_address_latitude = get_user_meta( $user_id, 'dealer_address_latitude', true );
					$dealer_address_longitude = get_user_meta( $user_id, 'dealer_address_longitude', true );

					if( empty($dealer_name)) {

						$user = get_userdata( $user_id ); 
						$dealer_name = $user->user_nicename;

					}

            	?>

            	<?php $author_page_url = cardojo_get_permalink( 'user' ); ?>
              	
              	<h4 class="heading"><a href="<?php echo esc_url($author_page_url); ?>?user_id=<?php echo esc_attr($user_id); ?>"><?php echo esc_attr($dealer_name); ?></a></h4>
              	
              	<?php if( !empty($dealer_address)) { ?>
              	<address><?php echo esc_attr($dealer_address); ?></address>
              	<?php } ?>

              	<ul class="list-unstyled phone-nrs">
              		
              		<?php if(!empty($mobile_phone)) { ?>
                  	<li>
                  		<span><?php esc_html_e('mobile', 'cardojo' ); ?></span>
                   		<a href="callto:<?php echo esc_attr($mobile_phone); ?>" ><?php echo esc_attr($mobile_phone); ?></a>
                  	</li>
                  	<li class="clearfix"></li>
                  	<?php } ?>

                  	<?php if(!empty($office_phone)) { ?>
                  	<li>
                  		<span><?php esc_html_e('office', 'cardojo' ); ?></span>
                    	<a href="callto:<?php echo esc_attr($office_phone); ?>" ><?php echo esc_attr($office_phone); ?></a>
                  	</li>
                  	<li class="clearfix"></li>
                  	<?php } ?>
                  	
              	</ul>

            </div>

      	</div>

      	<?php 

      		$current_form = "";

      		if(isset($_GET['form']) AND !empty($_GET['form'])) {
      			$current_form = $_GET['form'];
      		}

      		$finance_form = "";
      		$pre_qualify_form = "";
      		$test_drive_form = "";
      		$trade_in_form = "";

      		if($current_form == "pre_qualify") {
      			$pre_qualify_form = "active";
      		} elseif($current_form == "finance") {
      			$finance_form = "active";
      		} elseif($current_form == "test_drive") {
      			$test_drive_form = "active";
      		} elseif($current_form == "trade_in") {
      			$trade_in_form = "active";
      		} else {
      			$pre_qualify_form = "active";
      		}

      	?>

      	<ul id="cardojo-contact-forms-holder" class="caredojo_contact_forms_nav">
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($pre_qualify_form); ?>" data-id="form_pre_qualify"><?php esc_html_e('Pre-Qualify', 'cardojo' ); ?></li>
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($finance_form); ?>" data-id="form_finance"><?php esc_html_e('Finance Application', 'cardojo' ); ?></li>
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($test_drive_form); ?>" data-id="form_test_drive"><?php esc_html_e('Test Drive', 'cardojo' ); ?></li>
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($trade_in_form); ?>" data-id="form_trade_in"><?php esc_html_e('Trade-In', 'cardojo' ); ?></li>
		</ul>

		<div class="caredojo_contact_forms_container <?php echo esc_attr($pre_qualify_form); ?>" id="form_pre_qualify">

      		<?php cardojo_pre_qualify_application( 0 ); ?>

      	</div>

      	<div class="caredojo_contact_forms_container <?php echo esc_attr($finance_form); ?>" id="form_finance">

      		<?php cardojo_financial_application( 0 ); ?>

      	</div>

      	<div class="caredojo_contact_forms_container <?php echo esc_attr($test_drive_form); ?>" id="form_test_drive">

      		<?php cardojo_test_drive_application( 0 ); ?>

      	</div>

      	<div class="caredojo_contact_forms_container <?php echo esc_attr($trade_in_form); ?>" id="form_trade_in">

      		<?php cardojo_trade_in_application( 0 ); ?>

      	</div>

	</div>

  	<?php } else { ?>

  	<div class="listing-content">

      	<h3 class="heading"><?php esc_html_e('Location and contact information', 'cardojo' ); ?></h3>

  		<div class="cd-map-wrapp">

  			<input type="hidden" id="vehicle_location_latitude" name="vehicle_location_latitude" value="<?php echo esc_attr($vehicle_location_latitude); ?>" />
			<input type="hidden" id="vehicle_location_longitude" name="vehicle_location_longitude" value="<?php echo esc_attr($vehicle_location_longitude); ?>" />

            <div id="cd-map" class="rounded"></div>

            <div class="cd-dealer-address">
              	
              	<h4 class="heading"><?php echo esc_attr($vehicle_location_name); ?></h4>
              	<address><?php echo esc_attr($vehicle_location_address); ?></address>

              	<ul class="list-unstyled phone-nrs">
              		<?php if(!empty($vehicle_location_mobile_phone)) { ?>
                  	<li>
                  		<span><?php esc_html_e('mobile', 'cardojo' ); ?></span>
                   		<a href="callto:<?php echo esc_attr($vehicle_location_mobile_phone); ?>" ><?php echo esc_attr($vehicle_location_mobile_phone); ?></a>
                  	</li>
                  	<li class="clearfix"></li>
                  	<?php } ?>
                  	<?php if(!empty($vehicle_location_phone)) { ?>
                  	<li>
                  		<span><?php esc_html_e('office', 'cardojo' ); ?></span>
                    	<a href="callto:<?php echo esc_attr($vehicle_location_phone); ?>" ><?php echo esc_attr($vehicle_location_phone); ?></a>
                  	</li>
                  	<li class="clearfix"></li>
                  	<?php } ?>
              	</ul>

            </div>

      	</div>

      	<?php 

      		$current_form = "";

      		if(isset($_GET['form']) AND !empty($_GET['form'])) {
      			$current_form = $_GET['form'];
      		}

      		$finance_form = "";
      		$pre_qualify_form = "";
      		$test_drive_form = "";
      		$trade_in_form = "";

      		if($current_form == "pre_qualify") {
      			$pre_qualify_form = "active";
      		} elseif($current_form == "finance") {
      			$finance_form = "active";
      		} elseif($current_form == "test_drive") {
      			$test_drive_form = "active";
      		} elseif($current_form == "trade_in") {
      			$trade_in_form = "active";
      		} else {
      			$pre_qualify_form = "active";
      		}

      	?>

      	<ul id="cardojo-contact-forms-holder" class="caredojo_contact_forms_nav">
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($pre_qualify_form); ?>" data-id="form_pre_qualify"><?php esc_html_e('Pre-Qualify', 'cardojo' ); ?></li>
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($finance_form); ?>" data-id="form_finance"><?php esc_html_e('Finance Application', 'cardojo' ); ?></li>
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($test_drive_form); ?>" data-id="form_test_drive"><?php esc_html_e('Test Drive', 'cardojo' ); ?></li>
			<li class="caredojo_contact_forms_nav_item <?php echo esc_attr($trade_in_form); ?>" data-id="form_trade_in"><?php esc_html_e('Trade-In', 'cardojo' ); ?></li>
		</ul>

		<div class="caredojo_contact_forms_container <?php echo esc_attr($pre_qualify_form); ?>" id="form_pre_qualify">

      		<?php cardojo_pre_qualify_application( 0 ); ?>

      	</div>

      	<div class="caredojo_contact_forms_container <?php echo esc_attr($finance_form); ?>" id="form_finance">

      		<?php cardojo_financial_application( 0 ); ?>

      	</div>

      	<div class="caredojo_contact_forms_container <?php echo esc_attr($test_drive_form); ?>" id="form_test_drive">

      		<?php cardojo_test_drive_application( 0 ); ?>

      	</div>

      	<div class="caredojo_contact_forms_container <?php echo esc_attr($trade_in_form); ?>" id="form_trade_in">

      		<?php cardojo_trade_in_application( 0 ); ?>

      	</div>

	</div>

	<?php } ?>

	<?php
		/**
		 * single_car_end hook
		 */
		do_action( 'single_car_end' );
	?>

</div>
