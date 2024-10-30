<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CarDojo_Content class.
 */
class CarDojo_Car_Post_Type_MetaBoxes {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action('add_meta_boxes', 'register_car_settings');
		function register_car_settings () {
			add_meta_box('car_basic_settings', 'Car Info', 'display_car_basic_settings','vehicle');
			add_meta_box('car_condition_settings', 'Condition', 'display_car_condition_settings','vehicle');
			add_meta_box('car_characteristics_settings', 'Characteristics', 'display_car_characteristics_settings','vehicle');
			add_meta_box('car_description', 'Description', 'display_car_description','vehicle');
			add_meta_box('car_price_settings', 'Price', 'display_car_price_settings','vehicle');
			add_meta_box('car_engine_transmission', 'Engine and Transmission', 'display_car_engine_transmission','vehicle');
			add_meta_box('car_fuel_consumption_emissions', 'Fuel consumption and emissions', 'display_car_fuel_consumption_emissions','vehicle');
			add_meta_box('car_dimensions_weight', 'Dimenions and weight', 'display_car_dimensions_weight','vehicle');
			add_meta_box('car_features_specifications', 'Vehicle features and specifications', 'display_car_features_specifications','vehicle');
			add_meta_box('car_locations', 'Location & Contact info', 'display_car_locations','vehicle');
			add_meta_box('car_gallery_settings', 'Photo Gallery', 'display_car_gallery_settings','vehicle');
			add_meta_box('car_expenses', 'Expenses', 'display_car_expenses','vehicle');
		}

		function display_car_basic_settings ($post) {
			//get the post meta data
			
			$vehicle_year = esc_attr(get_post_meta($post->ID, 'vehicle_year',true));
			$vehicle_make = esc_attr(get_post_meta($post->ID, 'vehicle_make',true));
			$vehicle_model = esc_attr(get_post_meta($post->ID, 'vehicle_model',true));
			$vehicle_trim_id = esc_attr(get_post_meta($post->ID, 'vehicle_trim_id',true));
			$vehicle_trim_desc_init = esc_attr(get_post_meta($post->ID, 'vehicle_trim_desc_init',true));
			$vehicle_make_desc_init = esc_attr(get_post_meta($post->ID, 'vehicle_make_desc_init',true));

			?>
			
			<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

			<input id="vehicle_year_init" type="hidden" name="vehicle_year_init" value="<?php echo esc_attr($vehicle_year); ?>" />
			<input id="vehicle_make_init" type="hidden" name="vehicle_make_init" value="<?php echo esc_attr($vehicle_make); ?>" />
			<input id="vehicle_model_init" type="hidden" name="vehicle_model_init" value="<?php echo esc_attr($vehicle_model); ?>" />
			<input id="vehicle_trim_id_init" type="hidden" name="vehicle_trim_id_init" value="<?php echo esc_attr($vehicle_trim_id); ?>" />
			<input id="vehicle_trim_desc_init" type="hidden" name="vehicle_trim_desc_init" value="<?php echo esc_attr($vehicle_trim_desc_init); ?>" />
			<input id="vehicle_make_desc_init" type="hidden" name="vehicle_make_desc_init" value="<?php echo esc_attr($vehicle_make_desc_init); ?>" />

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-3">

							<label for="cq-make" class="control-label"><?php esc_html_e('Make', 'cardojo' ); ?></label>
							<input type="text" id="cq-make" name="cq-make" value="<?php echo esc_attr($vehicle_make_desc_init); ?>" placeholder="" />

						</div>

						<div class="cardojo-col-3">

							<label for="cq-model" class="control-label"><?php esc_html_e('Model', 'cardojo' ); ?></label>
							<input type="text" id="cq-model" name="cq-model" value="<?php echo esc_attr($vehicle_model); ?>" placeholder="" />

						</div>

						<div class="cardojo-col-3">

							<label for="cq-year" class="control-label"><?php esc_html_e('Year', 'cardojo' ); ?></label>
							<input type="text" id="cq-year" name="cq-year" value="<?php echo esc_attr($vehicle_year); ?>" placeholder="" />

						</div>

						<div class="cardojo-col-3">

							<label for="cq-trim" class="control-label"><?php esc_html_e('trim', 'cardojo' ); ?></label>
							<input type="text" id="cq-trim" name="cq-trim" value="<?php echo esc_attr($vehicle_trim_desc_init); ?>" placeholder="" />

						</div>

					</div>
					
				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_condition_settings ($post) {
			//get the post meta data

			$vehicle_condition = esc_attr(get_post_meta($post->ID, 'vehicle_condition',true));

			$vehicle_mileage = esc_attr(get_post_meta($post->ID, 'vehicle_mileage',true));
			$vehicle_condition_num = esc_attr(get_post_meta($post->ID, 'vehicle_condition_num',true));
			$vehicle_owners = esc_attr(get_post_meta($post->ID, 'vehicle_owners',true));
			$vehicle_accident_free = esc_attr(get_post_meta($post->ID, 'vehicle_accident_free',true));
			$vehicle_service_history = esc_attr(get_post_meta($post->ID, 'vehicle_service_history',true));
			$vehicle_vin = esc_attr(get_post_meta($post->ID, 'vehicle_vin',true));
			$vehicle_stock = esc_attr(get_post_meta($post->ID, 'vehicle_stock',true));
			$vehicle_carfax_link = esc_attr(get_post_meta($post->ID, 'vehicle_carfax_link',true));

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-5">

							<label for="vehicle_condition" class="control-label"><?php esc_html_e('Condition', 'cardojo' ); ?></label>
							<select name="vehicle_condition" id="vehicle_condition">

								<option value="New" <?php selected( $vehicle_condition, 'New' ); ?>><?php esc_html_e('New', 'cardojo' ); ?></option>
								<option value="Used" <?php selected( $vehicle_condition, 'Used' ); ?>><?php esc_html_e('Used', 'cardojo' ); ?></option>

							</select>

						</div>

					</div>

				</fieldset>

				<fieldset>

					<div class="cardojo-row show-hide-condition">

						<div class="cardojo-col-5">

							<label for="vehicle_mileage" class="control-label"><?php esc_html_e('Mileage', 'cardojo' ); ?> (<?php $unit_system = get_option( 'cardojo_measurement_type' ); if( empty($unit_system) OR $unit_system == "metric") { echo "Km"; } else { echo "Mi"; } ?>)</label>
							<input type="text" id="vehicle_mileage" class="numericonly" name="vehicle_mileage" value="<?php echo esc_attr($vehicle_mileage); ?>" placeholder="2000" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_condition_num" class="control-label"><?php esc_html_e('Condition (0 - 100)', 'cardojo' ); ?></label>
							<select name="vehicle_condition_num" id="vehicle_condition_num">

								<?php for($i = 100; $i >= 0; --$i) { ?>
									<option value="<?php echo esc_attr($i); ?>" <?php selected( $i, $vehicle_condition_num ); ?>><?php echo esc_attr($i); ?></option>
								<?php } ?>
								
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_owners" class="control-label"><?php esc_html_e('Owners (number)', 'cardojo' ); ?></label>
							<select name="vehicle_owners" id="vehicle_owners">

								<?php for($i = 0; $i <= 20; ++$i) { ?>
									<option value="<?php echo esc_attr($i); ?>" <?php selected( $i, $vehicle_owners ); ?>><?php echo esc_attr($i); ?></option>
								<?php } ?>
								
							</select>

						</div>

						<div class="cardojo-col-5 cardojo-checkbox-field">

							<input type="checkbox" name="vehicle_accident_free" <?php if($vehicle_accident_free == "on") { echo "checked"; } ?>>
							<label for="vehicle_accident_free"><?php esc_html_e('Accident Free', 'cardojo' ); ?></label>

						</div>

						<div class="cardojo-col-5 cardojo-checkbox-field">

							<input type="checkbox" name="vehicle_service_history" <?php if($vehicle_service_history == "on") { echo "checked"; } ?>>
							<label for="vehicle_service_history"><?php esc_html_e('Service History', 'cardojo' ); ?></label>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_stock" class="control-label"><?php esc_html_e('Stock #', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_stock" name="vehicle_stock" value="<?php echo esc_attr($vehicle_stock); ?>" placeholder="" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_vin" class="control-label"><?php esc_html_e('VIN Number', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_vin" name="vehicle_vin" value="<?php echo esc_attr($vehicle_vin); ?>" placeholder="" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_carfax_link" class="control-label"><?php esc_html_e('Carfax Link', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_carfax_link" name="vehicle_carfax_link" value="<?php echo esc_attr($vehicle_carfax_link); ?>" placeholder="http://www.carfax.com/" />

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_characteristics_settings ($post) {
			//get the post meta data

			$vehicle_metalic_paint = esc_attr(get_post_meta($post->ID, 'vehicle_metalic_paint',true));
			$vehicle_doors = esc_attr(get_post_meta($post->ID, 'vehicle_doors',true));
			$vehicle_seats = esc_attr(get_post_meta($post->ID, 'vehicle_seats',true));

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-9">

							<label for="vehicle_exterior_color" class="control-label"><?php esc_html_e('Exterior color', 'cardojo' ); ?></label>

							<?php

								$terms_slug_str_cat = "";

								$terms_cat = get_the_terms($post->ID, 'vehicle_exterior_color' );
								if ($terms_cat && ! is_wp_error($terms_cat)) :
									$term_slugs_arr_cat = array();
										foreach ($terms_cat as $term_cat) {
											$term_slugs_arr_cat[] = $term_cat->term_id;
										}
									$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
								endif;

								$categories = get_categories( array('taxonomy' => 'vehicle_exterior_color', 'hide_empty' => false,  'parent' => 0, 'orderby' => 'id', 'order' => 'ASC') );

								foreach ($categories as $category) {

									$color      = cardojo_get_term_color( $category->term_id, true );
									$color_id   = $category->term_id;
									$color_name = $category->cat_name;
									$color_type = get_term_meta( $category->term_id, 'color_type', true );

									?>

										<label class="control control--checkbox">
									      	<input type="radio" class="cardojo-select-color" name="radio" value="<?php echo esc_attr($category->term_id); ?>" <?php if($color_id == $terms_slug_str_cat) { ?>checked="checked"<?php } ?>/>
									      	<?php if($color_type == "combined") { ?>
												<div class="control__indicator car_combined_color"></div>
									      	<?php } elseif($color_type == "na") { ?>
												<div class="control__indicator car_na_color"><?php echo esc_attr($color_name); ?></div>
									      	<?php } else { ?>
									      		<div class="control__indicator" style="background-color: <?php echo esc_attr($color); ?>"></div>
									      	<?php } ?>
									      	<span class="tooltiptext"><?php echo esc_attr($color_name); ?></span>
									    </label>

									<?php
								}

							?>

							<input type="hidden" id="vehicle_exterior_color" name="vehicle_exterior_color" value="<?php echo esc_attr($terms_slug_str_cat); ?>"/>

						</div>

						<div class="cardojo-col-3 cardojo-checkbox-field">

							<input type="checkbox" name="vehicle_metalic_paint" <?php if($vehicle_metalic_paint == "on") { echo "checked"; } ?>>
							<label for="vehicle_metalic_paint"><?php esc_html_e('Metalic Paint', 'cardojo' ); ?></label>

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_body_style" class="control-label"><?php esc_html_e('Body Style', 'cardojo' ); ?></label>
							<select name="vehicle_body_style" id="vehicle_body_style">

								<?php

									$terms_cat = get_the_terms($post->ID, 'vehicle_body_style' );
									if ($terms_cat && ! is_wp_error($terms_cat)) :
										$term_slugs_arr_cat = array();
											foreach ($terms_cat as $term_cat) {
												$term_slugs_arr_cat[] = $term_cat->slug;
											}
										$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
									endif;

									$categories = get_categories( array('taxonomy' => 'vehicle_body_style', 'hide_empty' => false,  'parent' => 0) );

									foreach ($categories as $category) {
										$option = '<option value="'.$category->term_id.'" '. selected( $terms_slug_str_cat, $category->slug ) .' >';
										$option .= $category->cat_name;
										$option .= '</option>';

										$catID = $category->term_id;

										$categories_child = get_categories( array('taxonomy' => 'vehicle_body_style', 'hide_empty' => false,  'parent' => $catID) );

										foreach ($categories_child as $category_child) {
											$option .= '<option value="'.$category_child->term_id.'" '. selected( $terms_slug_str_cat, $category_child->slug ) .' > - ';
											$option .= $category_child->cat_name;
											$option .= '</option>';

										}

										echo $option;
									}

								?>
								
							</select>

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_doors" class="control-label"><?php esc_html_e('Doors', 'cardojo' ); ?></label>
							<select name="vehicle_doors" id="vehicle_doors">
								<option value="<?php esc_html_e('2', 'cardojo' ); ?>" <?php selected( $vehicle_doors, esc_html__('2', 'cardojo' ) ); ?>><?php esc_html_e('2', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('3', 'cardojo' ); ?>" <?php selected( $vehicle_doors, esc_html__('3', 'cardojo' ) ); ?>><?php esc_html_e('3', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('4', 'cardojo' ); ?>" <?php selected( $vehicle_doors, esc_html__('4', 'cardojo' ) ); ?>><?php esc_html_e('4', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('5', 'cardojo' ); ?>" <?php selected( $vehicle_doors, esc_html__('5', 'cardojo' ) ); ?>><?php esc_html_e('5', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('6', 'cardojo' ); ?>" <?php selected( $vehicle_doors, esc_html__('6', 'cardojo' ) ); ?>><?php esc_html_e('6', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('7', 'cardojo' ); ?>" <?php selected( $vehicle_doors, esc_html__('7', 'cardojo' ) ); ?>><?php esc_html_e('7', 'cardojo' ); ?></option>
							</select>

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_seats" class="control-label"><?php esc_html_e('Seats', 'cardojo' ); ?></label>
							<select name="vehicle_seats" id="vehicle_seats">
								<option value="<?php esc_html_e('2', 'cardojo' ); ?>" <?php selected( $vehicle_seats, esc_html__('2', 'cardojo' ) ); ?>><?php esc_html_e('2', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('4', 'cardojo' ); ?>" <?php selected( $vehicle_seats, esc_html__('4', 'cardojo' ) ); ?>><?php esc_html_e('4', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('5', 'cardojo' ); ?>" <?php selected( $vehicle_seats, esc_html__('5', 'cardojo' ) ); ?>><?php esc_html_e('5', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('6', 'cardojo' ); ?>" <?php selected( $vehicle_seats, esc_html__('6', 'cardojo' ) ); ?>><?php esc_html_e('6', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('7', 'cardojo' ); ?>" <?php selected( $vehicle_seats, esc_html__('7', 'cardojo' ) ); ?>><?php esc_html_e('7', 'cardojo' ); ?></option>
							</select>

						</div>

					</div>

				</fieldset>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-9">

							<label for="vehicle_interior_color" class="control-label"><?php esc_html_e('Interior color', 'cardojo' ); ?></label>

							<?php

								$terms_slug_str_cat = "";

								$terms_cat = get_the_terms($post->ID, 'vehicle_interior_color' );
								if ($terms_cat && ! is_wp_error($terms_cat)) :
									$term_slugs_arr_cat = array();
										foreach ($terms_cat as $term_cat) {
											$term_slugs_arr_cat[] = $term_cat->term_id;
										}
									$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
								endif;

								$categories = get_categories( array('taxonomy' => 'vehicle_interior_color', 'hide_empty' => false,  'parent' => 0, 'orderby' => 'id', 'order' => 'ASC') );

								foreach ($categories as $category) {

									$color      = cardojo_get_term_color( $category->term_id, true );
									$color_id   = $category->term_id;
									$color_name = $category->cat_name;
									$color_type = get_term_meta( $category->term_id, 'color_type', true );

									?>

										<label class="control control--checkbox">
									      	<input type="radio" class="cardojo-select-interior-color" name="radio-int" value="<?php echo esc_attr($category->term_id); ?>" <?php if($color_id == $terms_slug_str_cat) { ?>checked="checked"<?php } ?>/>
									      	<?php if($color_type == "combined") { ?>
												<div class="control__indicator car_combined_color"></div>
									      	<?php } elseif($color_type == "na") { ?>
												<div class="control__indicator car_na_color"><?php echo esc_attr($color_name); ?></div>
									      	<?php } else { ?>
									      		<div class="control__indicator" style="background-color: <?php echo esc_attr($color); ?>"></div>
									      	<?php } ?>
									      	<span class="tooltiptext"><?php echo esc_attr($color_name); ?></span>
									    </label>

									<?php
								}

							?>

							<input type="hidden" id="vehicle_interior_color" name="vehicle_interior_color" value="<?php echo esc_attr($terms_slug_str_cat); ?>"/>

						</div>

						<div class="cardojo-col-3">

							<label for="Interior materials" class="control-label"><?php esc_html_e('Interior materials', 'cardojo' ); ?></label>
							<select name="vehicle_interior_material" id="vehicle_interior_material">

								<?php

									$terms_cat = get_the_terms($post->ID, 'vehicle_interior_material' );
									if ($terms_cat && ! is_wp_error($terms_cat)) :
										$term_slugs_arr_cat = array();
											foreach ($terms_cat as $term_cat) {
												$term_slugs_arr_cat[] = $term_cat->slug;
											}
										$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
									endif;

									$categories = get_categories( array('taxonomy' => 'vehicle_interior_material', 'hide_empty' => false,  'parent' => 0) );

									foreach ($categories as $category) {
										$option = '<option value="'.$category->term_id.'" '. selected( $terms_slug_str_cat, $category->slug ) .' >';
										$option .= $category->cat_name;
										$option .= '</option>';

										$catID = $category->term_id;

										$categories_child = get_categories( array('taxonomy' => 'vehicle_interior_material', 'hide_empty' => false,  'parent' => $catID) );

										foreach ($categories_child as $category_child) {
											$option .= '<option value="'.$category_child->term_id.'" '. selected( $terms_slug_str_cat, $category_child->slug ) .' > - ';
											$option .= $category_child->cat_name;
											$option .= '</option>';

										}

										echo $option;
									}

								?>

							</select>

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_description ($post) {
			//get the post meta data

			$vehicle_description = get_post_meta($post->ID, 'vehicle_description', true);

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-12">

							<textarea cols="20" rows="7" class="input-text" name="vehicle_description" id="vehicle_description" placeholder="<?php esc_html_e('Write down your vehicle’s description here...', 'cardojo' ); ?>"><?php echo strip_tags($vehicle_description, true); ?></textarea>

						</div>

						<div class="cardojo-col-12 cardojo-style-margin-bottom-30">
							
							<h2 class="cardojo-subtitle"><span><?php esc_html_e('Add vehicle to collections', 'cardojo' ); ?></span></h2>

							<?php

								$categories = get_categories( array('taxonomy' => 'vehicle_collection', 'hide_empty' => false,  'parent' => 0) );

								foreach ($categories as $category) {

								?>

								<div class="cardojo-checkbox-field-small">

									<input type="checkbox" name="vehicle_collection[]" value="<?php echo esc_attr($category->term_id); ?>" <?php if( has_term( $category->cat_name, 'vehicle_collection' ) ) { echo "checked"; } ?>>
									<label for="vehicle_collection"><?php echo esc_attr($category->cat_name); ?></label>

								</div>

								<?php

							}

							?>

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_engine_transmission ($post) {
			//get the post meta data

			$vehicle_engine_volume_l = esc_attr(get_post_meta($post->ID, 'vehicle_engine_volume_l',true));
			$vehicle_engine_volume_ccm = esc_attr(get_post_meta($post->ID, 'vehicle_engine_volume_ccm',true));
			$vehicle_engine_position = esc_attr(get_post_meta($post->ID, 'vehicle_engine_position',true));
			$vehicle_cilinders = esc_attr(get_post_meta($post->ID, 'vehicle_cilinders',true));
			$vehicle_engine_type = esc_attr(get_post_meta($post->ID, 'vehicle_engine_type',true));
			$vehicle_power_hp = esc_attr(get_post_meta($post->ID, 'vehicle_power_hp',true));
			$vehicle_power_kw = esc_attr(get_post_meta($post->ID, 'vehicle_power_kw',true));
			$vehicle_max_power_rpm = esc_attr(get_post_meta($post->ID, 'vehicle_max_power_rpm',true));
			$vehicle_torque_nm = esc_attr(get_post_meta($post->ID, 'vehicle_torque_nm',true));
			$vehicle_max_torque_rpm = esc_attr(get_post_meta($post->ID, 'vehicle_max_torque_rpm',true));
			$vehicle_gears_num = esc_attr(get_post_meta($post->ID, 'vehicle_gears_num',true));
			$vehicle_accel_0_100 = esc_attr(get_post_meta($post->ID, 'vehicle_accel_0_100',true));

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-5">

							<label for="vehicle_fuel_type" class="control-label"><?php esc_html_e('Fuel Type', 'cardojo' ); ?></label>
							<select name="vehicle_fuel_type" id="vehicle_fuel_type">

								<?php

									$terms_cat = get_the_terms($post->ID, 'vehicle_fuel_type' );
									if ($terms_cat && ! is_wp_error($terms_cat)) :
										$term_slugs_arr_cat = array();
											foreach ($terms_cat as $term_cat) {
												$term_slugs_arr_cat[] = $term_cat->slug;
											}
										$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
									endif;

									$categories = get_categories( array('taxonomy' => 'vehicle_fuel_type', 'hide_empty' => false,  'parent' => 0) );

									foreach ($categories as $category) {
										$option = '<option value="'.$category->term_id.'" '. selected( $terms_slug_str_cat, $category->slug ) .' >';
										$option .= $category->cat_name;
										$option .= '</option>';

										$catID = $category->term_id;

										$categories_child = get_categories( array('taxonomy' => 'vehicle_fuel_type', 'hide_empty' => false,  'parent' => $catID) );

										foreach ($categories_child as $category_child) {
											$option .= '<option value="'.$category_child->term_id.'" '. selected( $terms_slug_str_cat, $category_child->slug ) .' > - ';
											$option .= $category_child->cat_name;
											$option .= '</option>';

										}

										echo $option;
									}

								?>
								
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_engine_volume_l" class="control-label"><?php esc_html_e('Engine volume (L)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_engine_volume_l" name="vehicle_engine_volume_l" value="<?php echo esc_attr($vehicle_engine_volume_l); ?>" placeholder="3.0" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_engine_volume_ccm" class="control-label"><?php esc_html_e('Engine volume (ccm)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_engine_volume_ccm" name="vehicle_engine_volume_ccm" value="<?php echo esc_attr($vehicle_engine_volume_ccm); ?>" placeholder="2987" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_engine_position" class="control-label"><?php esc_html_e('Engine position', 'cardojo' ); ?></label>
							<select name="vehicle_engine_position" id="vehicle_engine_position">

								<option value="<?php esc_html_e('Front', 'cardojo' ); ?>" <?php selected( $vehicle_engine_position, esc_html__('Front', 'cardojo' ) ); ?>><?php esc_html_e('Front', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Rear', 'cardojo' ); ?>" <?php selected( $vehicle_engine_position, esc_html__('Rear', 'cardojo' ) ); ?>><?php esc_html_e('Rear', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Middle', 'cardojo' ); ?>" <?php selected( $vehicle_engine_position, esc_html__('Middle', 'cardojo' ) ); ?>><?php esc_html_e('Middle', 'cardojo' ); ?></option>
								
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_cilinders" class="control-label"><?php esc_html_e('Number of cilinders', 'cardojo' ); ?></label>
							<select name="vehicle_cilinders" id="vehicle_cilinders">
								<option value="<?php esc_html_e('2', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('2', 'cardojo' ) ); ?>><?php esc_html_e('2', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('3', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('3', 'cardojo' ) ); ?>><?php esc_html_e('3', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('4', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('4', 'cardojo' ) ); ?>><?php esc_html_e('4', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('5', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('5', 'cardojo' ) ); ?>><?php esc_html_e('5', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('6', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('6', 'cardojo' ) ); ?>><?php esc_html_e('6', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('7', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('7', 'cardojo' ) ); ?>><?php esc_html_e('7', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('8', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('8', 'cardojo' ) ); ?>><?php esc_html_e('8', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('9', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('9', 'cardojo' ) ); ?>><?php esc_html_e('9', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('10', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('10', 'cardojo' ) ); ?>><?php esc_html_e('10', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('12', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('12', 'cardojo' ) ); ?>><?php esc_html_e('12', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('14', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('14', 'cardojo' ) ); ?>><?php esc_html_e('14', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('16', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('16', 'cardojo' ) ); ?>><?php esc_html_e('16', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('18', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('18', 'cardojo' ) ); ?>><?php esc_html_e('18', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('20', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('20', 'cardojo' ) ); ?>><?php esc_html_e('20', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('24', 'cardojo' ); ?>" <?php selected( $vehicle_cilinders, esc_html__('24', 'cardojo' ) ); ?>><?php esc_html_e('24', 'cardojo' ); ?></option>
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_power_hp" class="control-label"><?php esc_html_e('Power (hp)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_power_hp" name="vehicle_power_hp" value="<?php echo esc_attr($vehicle_power_hp); ?>" placeholder="265" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_power_kw" class="control-label"><?php esc_html_e('Power (kw)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_power_kw" name="vehicle_power_kw" value="<?php echo esc_attr($vehicle_power_kw); ?>" placeholder="265" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_max_power_rpm" class="control-label"><?php esc_html_e('Max Power (RPM)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_max_power_rpm" name="vehicle_max_power_rpm" value="<?php echo esc_attr($vehicle_max_power_rpm); ?>" placeholder="4500" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_torque_nm" class="control-label"><?php esc_html_e('Torque (Nm)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_torque_nm" name="vehicle_torque_nm" value="<?php echo esc_attr($vehicle_torque_nm); ?>" placeholder="265" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_max_torque_rpm" class="control-label"><?php esc_html_e('Max Torque (RPM)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_max_torque_rpm" name="vehicle_max_torque_rpm" value="<?php echo esc_attr($vehicle_max_torque_rpm); ?>" placeholder="4500" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_engine_type" class="control-label"><?php esc_html_e('Engine type', 'cardojo' ); ?></label>
							<select name="vehicle_engine_type" id="vehicle_engine_type">
								<option value="<?php esc_html_e('V', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('V', 'cardojo' ) ); ?>><?php esc_html_e('V', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Inline', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('Inline', 'cardojo' ) ); ?>><?php esc_html_e('Inline', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Flat', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('Flat', 'cardojo' ) ); ?>><?php esc_html_e('Flat', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('W', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('W', 'cardojo' ) ); ?>><?php esc_html_e('W', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('H', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('H', 'cardojo' ) ); ?>><?php esc_html_e('H', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('U', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('U', 'cardojo' ) ); ?>><?php esc_html_e('U', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Square four', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('Square four', 'cardojo' ) ); ?>><?php esc_html_e('Square four', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('VR', 'cardojo' ); ?>" <?php selected( $vehicle_engine_type, esc_html__('VR', 'cardojo' ) ); ?>><?php esc_html_e('VR', 'cardojo' ); ?></option>
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_transmission" class="control-label"><?php esc_html_e('Transmission', 'cardojo' ); ?></label>
							<select name="vehicle_transmission" id="vehicle_transmission">

								<?php

									$terms_cat = get_the_terms($post->ID, 'vehicle_transmission' );
									if ($terms_cat && ! is_wp_error($terms_cat)) :
										$term_slugs_arr_cat = array();
											foreach ($terms_cat as $term_cat) {
												$term_slugs_arr_cat[] = $term_cat->slug;
											}
										$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
									endif;

									$categories = get_categories( array('taxonomy' => 'vehicle_transmission', 'hide_empty' => false,  'parent' => 0) );

									foreach ($categories as $category) {
										$option = '<option value="'.$category->term_id.'" '. selected( $terms_slug_str_cat, $category->slug ) .' >';
										$option .= $category->cat_name;
										$option .= '</option>';

										$catID = $category->term_id;

										$categories_child = get_categories( array('taxonomy' => 'vehicle_transmission', 'hide_empty' => false,  'parent' => $catID) );

										foreach ($categories_child as $category_child) {
											$option .= '<option value="'.$category_child->term_id.'" '. selected( $terms_slug_str_cat, $category_child->slug ) .' > - ';
											$option .= $category_child->cat_name;
											$option .= '</option>';

										}

										echo $option;
									}

								?>
								
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_gears_num" class="control-label"><?php esc_html_e('Number of gears', 'cardojo' ); ?></label>
							<select name="vehicle_gears_num" id="vehicle_gears_num">

								<?php for($i = 0; $i <= 24; ++$i) { ?>
									<option value="<?php echo esc_attr($i); ?>" <?php selected( $i, $vehicle_gears_num ); ?>><?php echo esc_attr($i); ?></option>
								<?php } ?>
								
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_drive" class="control-label"><?php esc_html_e('Drive', 'cardojo' ); ?></label>
							<select name="vehicle_drive" id="vehicle_drive">

								<?php

									$terms_cat = get_the_terms($post->ID, 'vehicle_drive' );
									if ($terms_cat && ! is_wp_error($terms_cat)) :
										$term_slugs_arr_cat = array();
											foreach ($terms_cat as $term_cat) {
												$term_slugs_arr_cat[] = $term_cat->slug;
											}
										$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
									endif;

									$categories = get_categories( array('taxonomy' => 'vehicle_drive', 'hide_empty' => false,  'parent' => 0) );

									foreach ($categories as $category) {
										$option = '<option value="'.$category->term_id.'" '. selected( $terms_slug_str_cat, $category->slug ) .' >';
										$option .= $category->cat_name;
										$option .= '</option>';

										$catID = $category->term_id;

										$categories_child = get_categories( array('taxonomy' => 'vehicle_drive', 'hide_empty' => false,  'parent' => $catID) );

										foreach ($categories_child as $category_child) {
											$option .= '<option value="'.$category_child->term_id.'" '. selected( $terms_slug_str_cat, $category_child->slug ) .' > - ';
											$option .= $category_child->cat_name;
											$option .= '</option>';

										}

										echo $option;
									}

								?>
								
							</select>

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_accel_0_100" class="control-label"><?php esc_html_e('0-100km/h accel', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_accel_0_100" name="vehicle_accel_0_100" value="<?php echo esc_attr($vehicle_accel_0_100); ?>" placeholder="6.2" />

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_fuel_consumption_emissions ($post) {
			//get the post meta data

			$vehicle_consumption_combined = esc_attr(get_post_meta($post->ID, 'vehicle_consumption_combined',true));
			$vehicle_consumption_urban = esc_attr(get_post_meta($post->ID, 'vehicle_consumption_urban',true));
			$vehicle_consumption_highway = esc_attr(get_post_meta($post->ID, 'vehicle_consumption_highway',true));
			$vehicle_emissions = esc_attr(get_post_meta($post->ID, 'vehicle_emissions',true));
			$vehicle_emission_class = esc_attr(get_post_meta($post->ID, 'vehicle_emission_class',true));
			$vehicle_fuel_tank = esc_attr(get_post_meta($post->ID, 'vehicle_fuel_tank',true));

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-6">

							<label for="vehicle_consumption_combined" class="control-label"><?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('Combined l/100km', 'cardojo' ); } else { esc_html_e('Combined mpg', 'cardojo' ); } ?></label>
							<input type="text" id="vehicle_consumption_combined" name="vehicle_consumption_combined" value="<?php echo esc_attr($vehicle_consumption_combined); ?>" placeholder="10.4" />

						</div>

						<div class="cardojo-col-6">

							<label for="vehicle_consumption_urban" class="control-label"><?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('Urban l/100km', 'cardojo' ); } else { esc_html_e('Urban mpg', 'cardojo' ); } ?></label>
							<input type="text" id="vehicle_consumption_urban" name="vehicle_consumption_urban" value="<?php echo esc_attr($vehicle_consumption_urban); ?>" placeholder="11" />

						</div>

						<div class="cardojo-col-6">

							<label for="vehicle_consumption_highway" class="control-label"><?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('Highway l/100km', 'cardojo' ); } else { esc_html_e('Highway mpg', 'cardojo' ); } ?></label>
							<input type="text" id="vehicle_consumption_highway" name="vehicle_consumption_highway" value="<?php echo esc_attr($vehicle_consumption_highway); ?>" placeholder="8" />

						</div>

						<div class="cardojo-col-6">

							<label for="vehicle_emissions" class="control-label"><?php esc_html_e('Emissions g CO2/km', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_emissions" name="vehicle_emissions" value="<?php echo esc_attr($vehicle_emissions); ?>" placeholder="235" />

						</div>

						<div class="cardojo-col-6">

							<label for="vehicle_emission_class" class="control-label"><?php esc_html_e('Class', 'cardojo' ); ?></label>
							<select name="vehicle_emission_class" id="vehicle_emission_class">
								<option value="<?php esc_html_e('Euro 6', 'cardojo' ); ?>" <?php selected( $vehicle_emission_class, esc_html__('Euro 6', 'cardojo' ) ); ?>><?php esc_html_e('Euro 6', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Euro 5', 'cardojo' ); ?>" <?php selected( $vehicle_emission_class, esc_html__('Euro 5', 'cardojo' ) ); ?>><?php esc_html_e('Euro 5', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Euro 4', 'cardojo' ); ?>" <?php selected( $vehicle_emission_class, esc_html__('Euro 4', 'cardojo' ) ); ?>><?php esc_html_e('Euro 4', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Euro 3', 'cardojo' ); ?>" <?php selected( $vehicle_emission_class, esc_html__('Euro 3', 'cardojo' ) ); ?>><?php esc_html_e('Euro 3', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Euro 2', 'cardojo' ); ?>" <?php selected( $vehicle_emission_class, esc_html__('Euro 2', 'cardojo' ) ); ?>><?php esc_html_e('Euro 2', 'cardojo' ); ?></option>
								<option value="<?php esc_html_e('Euro 1', 'cardojo' ); ?>" <?php selected( $vehicle_emission_class, esc_html__('Euro 1', 'cardojo' ) ); ?>><?php esc_html_e('Euro 1', 'cardojo' ); ?></option>
							</select>

						</div>

						<div class="cardojo-col-6">

							<label for="vehicle_fuel_tank" class="control-label"><?php esc_html_e('Fuel tank', 'cardojo' ); ?> (<?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('liters', 'cardojo' ); } else { esc_html_e('gallons', 'cardojo' ); } ?>)</label>
							<input type="text" id="vehicle_fuel_tank" name="vehicle_fuel_tank" value="<?php echo esc_attr($vehicle_fuel_tank); ?>" placeholder="80" />

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_dimensions_weight ($post) {
			//get the post meta data

			$vehicle_length = esc_attr(get_post_meta($post->ID, 'vehicle_length',true));
			$vehicle_width = esc_attr(get_post_meta($post->ID, 'vehicle_width',true));
			$vehicle_height = esc_attr(get_post_meta($post->ID, 'vehicle_height',true));
			$vehicle_wheelbase = esc_attr(get_post_meta($post->ID, 'vehicle_wheelbase',true));
			$vehicle_weight = esc_attr(get_post_meta($post->ID, 'vehicle_weight',true));

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-5">

							<label for="vehicle_length" class="control-label"><?php esc_html_e('Length', 'cardojo' ); ?> (<?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?>)</label>
							<input type="text" id="vehicle_length" name="vehicle_length" value="<?php echo esc_attr($vehicle_length); ?>" placeholder="4636" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_width" class="control-label"><?php esc_html_e('Width', 'cardojo' ); ?> (<?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?>)</label>
							<input type="text" id="vehicle_width" name="vehicle_width" value="<?php echo esc_attr($vehicle_width); ?>" placeholder="2060" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_height" class="control-label"><?php esc_html_e('Height', 'cardojo' ); ?> (<?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?>)</label>
							<input type="text" id="vehicle_height" name="vehicle_height" value="<?php echo esc_attr($vehicle_height); ?>" placeholder="1783" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_wheelbase" class="control-label"><?php esc_html_e('Wheelbase', 'cardojo' ); ?> (<?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('mm', 'cardojo' ); } else { esc_html_e('in', 'cardojo' ); } ?>)</label>
							<input type="text" id="vehicle_wheelbase" name="vehicle_wheelbase" value="<?php echo esc_attr($vehicle_wheelbase); ?>" placeholder="2694" />

						</div>

						<div class="cardojo-col-5">

							<label for="vehicle_weight" class="control-label"><?php esc_html_e('Weight', 'cardojo' ); ?> (<?php $measurement_type = get_option( 'cardojo_measurement_type' ); if($measurement_type == "metric") { esc_html_e('kg', 'cardojo' ); } else { esc_html_e('lbs', 'cardojo' ); } ?>)</label>
							<input type="text" id="vehicle_weight" name="vehicle_weight" value="<?php echo esc_attr($vehicle_weight); ?>" placeholder="2987" />

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_features_specifications ($post) {
			//get the post meta data

			$vehicle_wheel_size = get_post_meta($post->ID, 'vehicle_wheel_size', true);

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-12">

							<div class="cardojo-row">

								<div class="cardojo-col-4 cardojo-style-margin-bottom-30">

									<h2 class="cardojo-subtitle"><span><?php esc_html_e('Safety', 'cardojo' ); ?></span></h2>

									<?php

										$categories = get_categories( array('taxonomy' => 'vehicle_safety', 'hide_empty' => false,  'parent' => 0) );

										foreach ($categories as $category) {

										?>

										<div class="cardojo-checkbox-field-small">

											<input type="checkbox" name="vehicle_safety[]" value="<?php echo esc_attr($category->cat_name); ?>" <?php if( has_term( $category->cat_name, 'vehicle_safety' ) ) { echo "checked"; } ?>>
											<label for="vehicle_safety"><?php echo esc_attr($category->cat_name); ?></label>

										</div>

										<?php

									}

									?>

								</div>

								<div class="cardojo-col-4 cardojo-style-margin-bottom-30">

									<h2 class="cardojo-subtitle"><span><?php esc_html_e('Comfort', 'cardojo' ); ?></span></h2>

									<?php

										$categories = get_categories( array('taxonomy' => 'vehicle_comfort', 'hide_empty' => false,  'parent' => 0) );

										foreach ($categories as $category) {

											$catID = $category->term_id;

											$categories_child = get_categories( array('taxonomy' => 'vehicle_comfort', 'hide_empty' => false, 'parent' => $catID, 'orderby' => 'id', 'order' => 'ASC' ) );

										?>

										<div class="cardojo-checkbox-field-small <?php if(!empty($categories_child)) { ?>cardojo-checkbox-sub-category<?php } ?>">

											<input type="checkbox" <?php if(!empty($categories_child)) { ?>class="vehicle_comfort_sub_main"<?php } ?> name="vehicle_comfort[]" value="<?php echo esc_attr($category->term_id); ?>" <?php if( has_term( $category->cat_name, 'vehicle_comfort' ) ) { echo "checked"; } ?>>

											<?php if(empty($categories_child)) { ?>
											<label for="vehicle_safety"><?php echo esc_attr($category->cat_name); ?></label>
											<?php } ?>

											<?php

												if(!empty($categories_child)) {

													?>

													<select class="taxonomy-subcategory-select" name="vehicle_comfort[]">

														<option value="na" <?php if( !has_term( $category->term_id, 'vehicle_comfort' ) ) { echo "selected"; } ?>><?php esc_html_e('Select', 'cardojo' ); ?> - <?php echo $category->cat_name; ?></option>

													<?php

													foreach ($categories_child as $category_child) {

														?>
														
															<option value="<?php echo $category_child->term_id; ?>" <?php if( has_term( $category_child->term_id, 'vehicle_comfort' ) ) { echo "selected"; } ?>><?php echo $category_child->cat_name; ?></option>

														<?php

													}

													?></select><?php

												}

											?>

										</div>

										<?php

									}

									?>

								</div>

								<div class="cardojo-col-4 cardojo-style-margin-bottom-30">

									<h2 class="cardojo-subtitle"><span><?php esc_html_e('Visibility', 'cardojo' ); ?></span></h2>

									<?php

										$categories = get_categories( array('taxonomy' => 'vehicle_visibility', 'hide_empty' => false,  'parent' => 0) );

										foreach ($categories as $category) {

											$catID = $category->term_id;

											$categories_child = get_categories( array('taxonomy' => 'vehicle_visibility', 'hide_empty' => false, 'parent' => $catID, 'orderby' => 'id', 'order' => 'ASC' ) );

										?>

										<div class="cardojo-checkbox-field-small <?php if(!empty($categories_child)) { ?>cardojo-checkbox-sub-category<?php } ?>">

											<input type="checkbox" <?php if(!empty($categories_child)) { ?>class="vehicle_comfort_sub_main"<?php } ?> name="vehicle_visibility[]" value="<?php echo esc_attr($category->term_id); ?>" <?php if( has_term( $category->cat_name, 'vehicle_visibility' ) ) { echo "checked"; } ?>>

											<?php if(empty($categories_child)) { ?>
											<label for="vehicle_safety"><?php echo esc_attr($category->cat_name); ?></label>
											<?php } ?>

											<?php

												if(!empty($categories_child)) {

													?>

													<select class="taxonomy-subcategory-select" name="vehicle_visibility[]">

														<option value="na" <?php if( !has_term( $category->term_id, 'vehicle_visibility' ) ) { echo "selected"; } ?>><?php esc_html_e('Select', 'cardojo' ); ?> - <?php echo $category->cat_name; ?></option>

													<?php

													foreach ($categories_child as $category_child) {

														?>
														
															<option value="<?php echo $category_child->term_id; ?>" <?php if( has_term( $category_child->term_id, 'vehicle_visibility' ) ) { echo "selected"; } ?>><?php echo $category_child->cat_name; ?></option>

														<?php

													}

													?></select><?php

												}

											?>

										</div>

										<?php

									}

									?>

								</div>

							</div>

						</div>

						<div class="cardojo-col-12">

							<div class="cardojo-row">

								<div class="cardojo-col-4 cardojo-style-margin-bottom-30">

									<h2 class="cardojo-subtitle"><span><?php esc_html_e('Multimedia', 'cardojo' ); ?></span></h2>

									<?php

										$terms_cat = get_the_terms($post->ID, 'vehicle_multimedia' );
										if ($terms_cat && ! is_wp_error($terms_cat)) :
											$term_slugs_arr_cat = array();
												foreach ($terms_cat as $term_cat) {
													$term_slugs_arr_cat[] = $term_cat->slug;
												}
											$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
										endif;

										$categories = get_categories( array('taxonomy' => 'vehicle_multimedia', 'hide_empty' => false,  'parent' => 0) );

										foreach ($categories as $category) {

										?>

										<div class="cardojo-checkbox-field-small">

											<input type="checkbox" name="vehicle_multimedia[]" value="<?php echo esc_attr($category->cat_name); ?>" <?php if( has_term( $category->cat_name, 'vehicle_multimedia' ) ) { echo "checked"; } ?>>
											<label for="vehicle_multimedia"><?php echo esc_attr($category->cat_name); ?></label>

										</div>

										<?php

									}

									?>

								</div>

								<div class="cardojo-col-4 cardojo-style-margin-bottom-30">

									<h2 class="cardojo-subtitle"><span><?php esc_html_e('Exterior', 'cardojo' ); ?></span></h2>

									<?php

										$categories = get_categories( array('taxonomy' => 'vehicle_exterior', 'hide_empty' => false,  'parent' => 0) );

										foreach ($categories as $category) {

											$catID = $category->term_id;

											$categories_child = get_categories( array('taxonomy' => 'vehicle_exterior', 'hide_empty' => false, 'parent' => $catID, 'orderby' => 'id', 'order' => 'ASC' ) );

										?>

										<div class="cardojo-checkbox-field-small <?php if(!empty($categories_child)) { ?>cardojo-checkbox-sub-category<?php } ?>">

											<input type="checkbox" <?php if(!empty($categories_child)) { ?>class="vehicle_comfort_sub_main"<?php } ?> name="vehicle_exterior[]" value="<?php echo esc_attr($category->term_id); ?>" <?php if( has_term( $category->cat_name, 'vehicle_exterior' ) ) { echo "checked"; } ?>>

											<?php if(empty($categories_child)) { ?>
											<label for="vehicle_safety"><?php echo esc_attr($category->cat_name); ?></label>
											<?php } ?>

											<?php

												if(!empty($categories_child)) {

													?>

													<select class="taxonomy-subcategory-select" name="vehicle_exterior[]">

														<option value="na" <?php if( !has_term( $category->term_id, 'vehicle_exterior' ) ) { echo "selected"; } ?>><?php esc_html_e('Select', 'cardojo' ); ?> - <?php echo $category->cat_name; ?></option>

													<?php

													foreach ($categories_child as $category_child) {

														?>
														
															<option value="<?php echo $category_child->term_id; ?>" <?php if( has_term( $category_child->term_id, 'vehicle_exterior' ) ) { echo "selected"; } ?>><?php echo $category_child->cat_name; ?></option>

														<?php

													}

													?></select><?php

												}

											?>

										</div>

										<?php

									}

									?>

								</div>

								<div class="cardojo-col-4 cardojo-style-margin-bottom-30">

									<h2 class="cardojo-subtitle"><span><?php esc_html_e('Interior', 'cardojo' ); ?></span></h2>

									<?php

										$categories = get_categories( array('taxonomy' => 'vehicle_interior', 'hide_empty' => false,  'parent' => 0) );

										foreach ($categories as $category) {

											$catID = $category->term_id;

											$categories_child = get_categories( array('taxonomy' => 'vehicle_interior', 'hide_empty' => false, 'parent' => $catID, 'orderby' => 'id', 'order' => 'ASC' ) );

										?>

										<div class="cardojo-checkbox-field-small <?php if(!empty($categories_child)) { ?>cardojo-checkbox-sub-category<?php } ?>">

											<input type="checkbox" <?php if(!empty($categories_child)) { ?>class="vehicle_comfort_sub_main"<?php } ?> name="vehicle_interior[]" value="<?php echo esc_attr($category->term_id); ?>" <?php if( has_term( $category->cat_name, 'vehicle_interior' ) ) { echo "checked"; } ?>>

											<?php if(empty($categories_child)) { ?>
											<label for="vehicle_safety"><?php echo esc_attr($category->cat_name); ?></label>
											<?php } ?>

											<?php

												if(!empty($categories_child)) {

													?>

													<select class="taxonomy-subcategory-select" name="vehicle_interior[]">

														<option value="na" <?php if( !has_term( $category->term_id, 'vehicle_interior' ) ) { echo "selected"; } ?>><?php esc_html_e('Select', 'cardojo' ); ?> - <?php echo $category->cat_name; ?></option>

													<?php

													foreach ($categories_child as $category_child) {

														?>
														
															<option value="<?php echo $category_child->term_id; ?>" <?php if( has_term( $category_child->term_id, 'vehicle_interior' ) ) { echo "selected"; } ?>><?php echo $category_child->cat_name; ?></option>

														<?php

													}

													?></select><?php

												}

											?>

										</div>

										<?php

									}

									?>

								</div>

							</div>

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_locations ($post) {
			//get the post meta data

			$vehicle_location = get_categories( array('taxonomy' => 'vehicle_location', 'hide_empty' => false,  'parent' => 0) );

			?>

			<div id='options_group'>

				<?php if(isset($vehicle_location) AND !empty($vehicle_location)) { ?>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-5">

							<label for="vehicle_location" class="control-label"><?php esc_html_e('Existent locations', 'cardojo' ); ?></label>
							<select name="vehicle_location" id="vehicle_location">

								<option value="new" data-name="" data-mobile="" data-phone="" data-email="" data-address="" data-latitude="" data-longitude="" ><?php esc_html_e('New location', 'cardojo' ); ?></option>

								<?php

									$terms_slug_str_cat = "";
									$terms_cat = get_the_terms($post->ID, 'vehicle_location' );
									if ($terms_cat && ! is_wp_error($terms_cat)) :
										$term_slugs_arr_cat = array();
											foreach ($terms_cat as $term_cat) {
												$term_slugs_arr_cat[] = $term_cat->slug;
											}
										$terms_slug_str_cat = join( " ", $term_slugs_arr_cat);
									endif;

									foreach ($vehicle_location as $category) {

										$term_id = $category->term_id;
										$vehicle_location_name = get_term_meta( $term_id, 'vehicle_location_name', true );
										$vehicle_location_mobile_phone = get_term_meta( $term_id, 'vehicle_location_mobile_phone', true );
										$vehicle_location_phone = get_term_meta( $term_id, 'vehicle_location_phone', true );
										$vehicle_location_email = get_term_meta( $term_id, 'vehicle_location_email', true );
										$vehicle_location_address = get_term_meta( $term_id, 'vehicle_location_address', true );
										$vehicle_location_latitude = get_term_meta( $term_id, 'vehicle_location_latitude', true );
										$vehicle_location_longitude = get_term_meta( $term_id, 'vehicle_location_longitude', true );

									?>

										<option value="<?php echo $category->term_id; ?>" <?php selected( $terms_slug_str_cat, $category->slug ); ?> data-name="<?php echo esc_attr($vehicle_location_name); ?>" data-mobile="<?php echo esc_attr($vehicle_location_mobile_phone); ?>" data-phone="<?php echo esc_attr($vehicle_location_phone); ?>" data-email="<?php echo esc_attr($vehicle_location_email); ?>" data-address="<?php echo esc_attr($vehicle_location_address); ?>" data-latitude="<?php echo esc_attr($vehicle_location_latitude); ?>" data-longitude="<?php echo esc_attr($vehicle_location_longitude); ?>" ><?php echo $category->cat_name; ?></option>

									<?php

									}

								?>
								
							</select>

						</div>

					</div>

				</fieldset>

				<?php } else { ?>

				<input type="hidden" class="vehicle_location" name="vehicle_location" value="new" />

				<?php } ?>

				<fieldset>

					<?php

						$vehicle_location_name = "";
						$vehicle_location_mobile_phone = "";
						$vehicle_location_phone = "";
						$vehicle_location_email = "";
						$vehicle_location_address = "";
						$vehicle_location_latitude = "0";
						$vehicle_location_longitude = "0";

						$terms_cat = get_the_terms($post->ID, 'vehicle_location' );
						if(isset($terms_cat) AND !empty($terms_cat)) {

							$term_id = $terms_cat[0]->term_id;
							$vehicle_location_name = get_term_meta( $term_id, 'vehicle_location_name', true );
							$vehicle_location_mobile_phone = get_term_meta( $term_id, 'vehicle_location_mobile_phone', true );
							$vehicle_location_phone = get_term_meta( $term_id, 'vehicle_location_phone', true );
							$vehicle_location_email = get_term_meta( $term_id, 'vehicle_location_email', true );
							$vehicle_location_address = get_term_meta( $term_id, 'vehicle_location_address', true );
							$vehicle_location_latitude = get_term_meta( $term_id, 'vehicle_location_latitude', true );
							$vehicle_location_longitude = get_term_meta( $term_id, 'vehicle_location_longitude', true );

						}

					?>

					<div class="cardojo-row">

						<div class="cardojo-col-3">

							<label for="vehicle_location_name" class="control-label"><?php esc_html_e('Your Name / Company Name', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_location_name" name="vehicle_location_name" value="<?php echo esc_attr($vehicle_location_name); ?>" placeholder="">

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_location_mobile_phone" class="control-label"><?php esc_html_e('Mobile phone number', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_location_mobile_phone" name="vehicle_location_mobile_phone" value="<?php echo esc_attr($vehicle_location_mobile_phone); ?>" placeholder="">

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_location_phone" class="control-label"><?php esc_html_e('Phone number', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_location_phone" name="vehicle_location_phone" value="<?php echo esc_attr($vehicle_location_phone); ?>" placeholder="">

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_location_email" class="control-label"><?php esc_html_e('Email', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_location_email" name="vehicle_location_email" value="<?php echo esc_attr($vehicle_location_email); ?>" placeholder="">

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_location_address" class="control-label"><?php esc_html_e('Location (Full Address)', 'cardojo' ); ?></label>
							<input type="text" id="vehicle_location_address" name="vehicle_location_address" value="<?php echo esc_attr($vehicle_location_address); ?>" placeholder="">

							<input type="hidden" id="vehicle_location_latitude" name="vehicle_location_latitude" value="<?php echo esc_attr($vehicle_location_latitude); ?>" />
							<input type="hidden" id="vehicle_location_longitude" name="vehicle_location_longitude" value="<?php echo esc_attr($vehicle_location_longitude); ?>" />

						</div>

						<div class="cardojo-col-12">

							<div id="map-canvas"></div>

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_price_settings ($post) {
			//get the post meta data
			
			$vehicle_acquisition_price = esc_attr(get_post_meta($post->ID, 'vehicle_acquisition_price',true));
			$vehicle_retail_price = esc_attr(get_post_meta($post->ID, 'vehicle_retail_price',true));
			$vehicle_discounted_price = esc_attr(get_post_meta($post->ID, 'vehicle_discounted_price',true));
			$vehicle_discount = esc_attr(get_post_meta($post->ID, 'vehicle_discount',true));

			$vehicle_cheaper_car_exg = esc_attr(get_post_meta($post->ID, 'vehicle_cheaper_car_exg',true));
			$vehicle_expensive_car_exg = esc_attr(get_post_meta($post->ID, 'vehicle_expensive_car_exg',true));
			$vehicle_negociable_price = esc_attr(get_post_meta($post->ID, 'vehicle_negociable_price',true));

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-3">

							<label for="vehicle_acquisition_price" class="control-label"><?php esc_html_e('Acquisition Price', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; }  echo " - "; ?><?php esc_html_e('not public', 'cardojo' ); ?>)</label>
							<input type="text" id="vehicle_acquisition_price" name="vehicle_acquisition_price" value="<?php echo esc_attr($vehicle_acquisition_price); ?>" placeholder="15000" />

						</div>

						<div class="cardojo-col-3">

							<label for="vehicle_retail_price" class="control-label"><?php esc_html_e('Retail Price', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</label>
							<input type="text" id="vehicle_retail_price" name="vehicle_retail_price" value="<?php echo esc_attr($vehicle_retail_price); ?>" placeholder="20000" />

						</div>

						<div class="cardojo-col-3 cardojo-checkbox-field">

							<input type="checkbox" id="vehicle_discount" name="vehicle_discount" <?php if($vehicle_discount == "on") { echo "checked"; } ?>>
							<label for="vehicle_discount"><?php esc_html_e('Make a discount?', 'cardojo' ); ?></label>

						</div>

						<div class="cardojo-col-3 new-discounted-price">

							<label for="vehicle_discounted_price" class="control-label"><?php esc_html_e('New Retail Price', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</label>
							<input type="text" id="vehicle_discounted_price" name="vehicle_discounted_price" value="<?php echo esc_attr($vehicle_discounted_price); ?>" placeholder="19000" />

						</div>

					</div>

				</fieldset>

				<fieldset>

					<div class="cardojo-row">

						<div class="cardojo-col-3">
							
							<label for="vehicle_exchange_conditions" class="control-label checkbox-label"><?php esc_html_e('Willing to exchange on a...', 'cardojo' ); ?></label>

							<div class="full-width">

								<input type="checkbox" id="vehicle_expensive_car_exg" name="vehicle_expensive_car_exg" <?php if($vehicle_expensive_car_exg == "on") { echo "checked"; } ?>>
								<label for="vehicle_expensive_car_exg"><?php esc_html_e('expensive car + my', 'cardojo' ); ?> <?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo $cardojo_currency; } ?></label>

							</div>

							<div class="full-width">

								<input type="checkbox" id="vehicle_cheaper_car_exg" name="vehicle_cheaper_car_exg" <?php if($vehicle_cheaper_car_exg == "on") { echo "checked"; } ?>>
								<label for="vehicle_cheaper_car_exg"><?php esc_html_e('cheaper car + your', 'cardojo' ); ?> <?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo $cardojo_currency; } ?></label>

							</div>

						</div>

						<div class="cardojo-col-3 cardojo-checkbox-field">

							<input type="checkbox" id="vehicle_negociable_price" name="vehicle_negociable_price" <?php if($vehicle_negociable_price == "on") { echo "checked"; } ?>>
							<label for="vehicle_negociable_price"><?php esc_html_e('Negociable price', 'cardojo' ); ?></label>

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_gallery_settings ($post) {
			//get the post meta data

			$vehicle_image_gallery = get_post_meta($post->ID, 'vehicle_image_gallery',true);
			$vehicle_image_extended_gallery = get_post_meta($post->ID, 'vehicle_image_extended_gallery',true);

			?>

			<div id='options_group'>

				<fieldset>

					<div class="cardojo-row">

						<div id="vehicle_gallery_main_images">

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[0]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[0]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[0]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[0]['url'])) { echo esc_attr($vehicle_image_gallery[0]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 181.6 120.2" style="enable-background:new 0 0 181.6 120.2;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M181.2,53.6c-0.1-5.6-4.2-10.4-9.6-11.3l-7.5-1.7c-2.4-2.3-15.6-14.8-23.9-17.4c-5.7-1.8-13-1.6-20.2-1.5
				                          c-0.2,0-0.5,0-0.7,0c-0.1,0-0.1,0-0.1,0L88,22.4c-17.7,0.4-33.8,7.5-46.6,20.6l-0.2,0c-0.3,0-0.6,0.1-0.8,0.2l-0.7,0.1
				                          c-13,2.1-30.8,5-36.5,11.5C-1.2,59.6,0,70.2,0.7,76.4c0.1,1,0.2,1.9,0.3,2.6c0.4,4.2,3.7,7.5,7.9,7.8l0.5,0
				                          c1.5,8.2,5.2,10.5,8.2,10.9c0,0,0,0,0,0c0,0,0,0,0,0l12.6,1.1c0,0,0.1,0,0.1,0c0.1,0,0.2,0,0.3-0.1c0.2,0,0.4,0,0.5,0
				                          c0,0,0.1,0,0.1,0c3.5-0.1,6.5-3.9,7.9-10l22.6,1.5c1,8.7,5,14.2,10.3,14.2c0,0,0,0,0,0l12.8,1.5c0.1,0,0.1,0,0.2,0
				                          c0.1,0,0.2,0,0.4-0.1c0.2,0,0.4,0,0.5,0c0,0,0.1,0,0.1,0c3.1-0.1,5.8-2.4,7.7-6.7c1.5-3.4,2.4-7.7,2.5-12.2l5.3-0.5
				                          c1.6,2.2,3.4,3.5,5.4,3.5c0,0,0.1,0,0.1,0l12.1-0.2c0.1,0,0.2,0,0.3-0.1c0.2,0,0.3,0.1,0.5,0.1c0,0,0.1,0,0.1,0
				                          c2.5-0.1,4.8-2.1,6.4-5.6l16.2-1.5c1,7.8,4.5,13.1,8.9,13.1c0,0,0.1,0,0.1,0l10.7-0.2c2.6-0.1,5-2,6.5-5.6c1.2-2.7,1.9-6.2,2-9.9
				                          l0.2,0c5.9-0.6,10.5-5.7,10.4-11.6L181.2,53.6z M139.2,26.6c5.8,1.8,14.9,9.6,19.6,13.9L132,41.1c-0.4-6.9-2.1-12.8-3.1-15.8
				                          C132.6,25.3,136.2,25.7,139.2,26.6z M120.1,25.3c2.3,0,4.6-0.1,6.8-0.1c1,2.7,2.8,8.8,3.2,15.9l-37,0.8
				                          C98.9,32.3,109.8,25.5,120.1,25.3z M88,25.9l17.7-0.4c-6.9,3.6-13,9.4-16.6,16.4l-42.5,0.9C58.3,32.1,72.5,26.3,88,25.9z M17.9,96
				                          c-4-0.6-5.8-4.9-6.6-9l11.3,0.8c0.9,4,2.4,7.2,4.3,9.1L17.9,96z M31.3,97.1C31.3,97.1,31.3,97.1,31.3,97.1c-2.8,0-5.5-3.7-6.8-9.2
				                          l13,0.9C36.2,93.8,33.9,97.1,31.3,97.1z M72.5,101.1c0,0-0.1,0-0.1,0c0,0-0.1,0-0.1,0c0,0-0.1,0-0.1,0c-3.2,0-5.9-4.3-6.7-10.8
				                          l10-1.1c0.5,5.2,2,9.6,4,12.7L72.5,101.1z M90.7,98c-1.3,2.9-2.9,4.5-4.5,4.5c-3.3,0.1-7.2-6.8-7.4-16.8c-0.1-4.7,0.7-9.2,2.2-12.5
				                          c1.3-2.9,2.9-4.5,4.5-4.5c0,0,0,0,0,0c3.3,0,7.1,6.9,7.3,16.8C92.9,90.3,92.2,94.7,90.7,98z M107.1,88.4c-1.2,0.1-2.3-0.6-3.4-1.9
				                          l10.3-1c0.7,1.1,1.4,2,2.1,2.7L107.1,88.4z M120.2,88.2c-1.4,0-2.8-1-4.1-2.8l8.5-0.8C123.3,86.8,121.8,88.1,120.2,88.2z
				                           M151.8,92.3C151.8,92.3,151.8,92.3,151.8,92.3C151.7,92.3,151.7,92.3,151.8,92.3c-2.1,0-4.5-3.9-5.3-9.8l7-0.7
				                          c0.3,3.2,1.1,6.2,2.3,8.5c0.3,0.7,0.7,1.3,1.1,1.9L151.8,92.3z M167.5,78.7C167.5,78.7,167.5,78.7,167.5,78.7
				                          C167.5,78.7,167.5,78.7,167.5,78.7c0.1,3.8-0.5,7.3-1.7,10c-1,2.2-2.2,3.5-3.4,3.5c-1.1,0.1-2.4-1.2-3.5-3.3
				                          c-1.3-2.6-2-6.1-2.1-9.9c-0.2-8.3,2.8-13.4,5.1-13.5c0,0,0,0,0,0C164.2,65.4,167.3,70.4,167.5,78.7
				                          C167.5,78.7,167.5,78.7,167.5,78.7z M171,76.6c-0.7-8.5-4.4-14.7-9-14.7c0,0-0.1,0-0.1,0c-5,0.1-8.6,7.1-8.6,16.4l-57,5.4
				                          c-0.7-10.8-5.2-18.6-10.9-18.5c-3.1,0.1-5.8,2.4-7.7,6.7c-1.7,3.8-2.5,8.7-2.5,13.9l-11.8,1.2L9.2,83.3c-2.5-0.2-4.4-2.1-4.6-4.5
				                          C4.5,78,4.4,77.1,4.3,76c-0.6-5.3-1.8-15.2,1.5-18.9c4.9-5.5,22.7-8.4,34.4-10.3l2-0.3L163,44l7.9,1.8c3.8,0.7,6.7,4,6.8,7.9
				                          l0.3,14.9C178.1,72.6,175,76.1,171,76.6z"></path>
				                        <path class="st0" d="M55.6,61.5c-2.9,0.1-5.3,3.3-5.2,7.2c0,1.8,0.6,3.6,1.6,4.9c1,1.4,2.4,2.1,3.8,2.1c0,0,0.1,0,0.1,0
				                          c2.9-0.1,5.3-3.3,5.2-7.2c0-1.8-0.6-3.6-1.6-4.9C58.5,62.2,57,61.5,55.6,61.5z M55.8,74c-0.8,0.1-1.8-0.5-2.5-1.4
				                          c-0.8-1-1.2-2.4-1.2-3.9c-0.1-2.9,1.5-5.4,3.5-5.4c0,0,0,0,0,0c0.9,0,1.7,0.5,2.4,1.4c0.8,1,1.2,2.4,1.2,3.9
				                          C59.4,71.5,57.8,73.9,55.8,74z"></path>
				                        <path class="st0" d="M13.2,59.6c-1.2,0-2.4,0.7-3.2,1.9c-0.8,1.1-1.2,2.6-1.1,4.1c0.1,3.2,2.1,5.8,4.5,5.8c0,0,0,0,0.1,0
				                          c2.5-0.1,4.4-2.7,4.3-6C17.7,62.1,15.7,59.6,13.2,59.6z M13.4,69.6c-1.5,0-2.7-1.8-2.8-4c0-1.1,0.3-2.2,0.8-3
				                          c0.5-0.7,1.1-1.1,1.8-1.1c0,0,0,0,0,0c1.4,0,2.7,1.8,2.7,4C16.1,67.7,14.9,69.6,13.4,69.6z"></path>
				                        <path class="st0" d="M134.8,47.2l-8.9,0.2c-0.5,0-0.9,0.4-0.9,0.9c0,0.5,0.4,0.9,0.9,0.9c0,0,0,0,0,0l8.9-0.2
				                          c0.5,0,0.9-0.4,0.9-0.9C135.7,47.6,135.3,47.3,134.8,47.2z"></path>
				                        <path class="st0" d="M159.7,46.7l-7.1,0.1c-0.5,0-0.9,0.4-0.9,0.9c0,0.5,0.4,0.9,0.9,0.9c0,0,0,0,0,0l7.1-0.1
				                          c0.5,0,0.9-0.4,0.9-0.9C160.6,47.1,160.3,46.8,159.7,46.7z"></path>
				                        <path class="st0" d="M43.8,67.3l-21.8-1.3c-0.5,0-0.9,0.3-0.9,0.8c0,0.5,0.3,0.9,0.8,0.9l21.8,1.3c0,0,0,0,0.1,0
				                          c0.5,0,0.9-0.4,0.9-0.8C44.6,67.8,44.3,67.4,43.8,67.3z"></path>
				                        <path class="st0" d="M39,70.1l-12.5-0.7c-0.5,0-0.9,0.3-0.9,0.8c0,0.5,0.3,0.9,0.8,0.9l12.5,0.7c0,0,0,0,0.1,0
				                          c0.5,0,0.9-0.4,0.9-0.8C39.9,70.5,39.5,70.1,39,70.1z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[0][url]" value="<?php if(!empty($vehicle_image_gallery[0]['url'])) { echo esc_attr($vehicle_image_gallery[0]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[0][id]" value="<?php if(!empty($vehicle_image_gallery[0]["id"])) { echo esc_attr($vehicle_image_gallery[0]["id"]); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[1]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[1]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[1]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[1]['url'])) { echo esc_attr($vehicle_image_gallery[1]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 78 57.8" style="enable-background:new 0 0 78 57.8;" xml:space="preserve">
				                        <g>
				                          <path class="st0" d="M69.9,18.1L68.5,5.6c-0.3-3.2-3-5.6-6.2-5.6H15.7c-3.2,0-5.9,2.4-6.2,5.6L8.1,18.1c-4.5,0.5-8.1,4.3-8.1,9
				                            v16.7v13c0,0.6,0.4,1,1,1h11c0.6,0,1-0.4,1-1v-6.8h52v6.8c0,0.6,0.4,1,1,1h11c0.6,0,1-0.4,1-1v-13V27.1
				                            C78,22.4,74.4,18.6,69.9,18.1z M15.7,2h46.5c2,0,3.6,1.3,4.1,3.2H11.6C12.1,3.4,13.8,2,15.7,2z M11.5,6.2h55.1l1.4,11.9h-5.1
				                            c-1.5-3.2-4.7-5.3-8.3-5.3c-3.6,0-6.8,2.1-8.3,5.3H10.1L11.5,6.2z M54.5,15.8c-1.9,0-3.6,0.8-4.8,2.3h-1.1c1.3-2,3.5-3.3,6-3.3
				                            c2.5,0,4.7,1.3,6,3.3h-1.2C58.1,16.7,56.4,15.8,54.5,15.8z M57.9,18.1h-6.8c0.9-0.8,2.1-1.3,3.4-1.3C55.7,16.8,57,17.3,57.9,18.1z
				                             M11,55.8H2v-7.5c1.1,1,2.6,1.7,4.3,1.7H11V55.8z M76,55.8h-9v-5.8h4.7c1.6,0,3.1-0.6,4.3-1.7V55.8z M76,43.8
				                            c0,2.3-1.9,4.3-4.3,4.3H6.3c-2.3,0-4.3-1.9-4.3-4.3V27.1c0-3.9,3.1-7,7-7c0,0,0,0,0,0h60c0,0,0,0,0,0c3.8,0,7,3.1,7,7V43.8z"></path>
				                          <path class="st0" d="M57,28.7H21c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h36c0.3,0,0.5-0.2,0.5-0.5S57.3,28.7,57,28.7z"></path>
				                          <path class="st0" d="M47,30.7H31c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h16c0.3,0,0.5-0.2,0.5-0.5S47.3,30.7,47,30.7z"></path>
				                          <path class="st0" d="M12,25c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6s4.6-2.1,4.6-4.6S14.6,25,12,25z M12,33.2c-2,0-3.6-1.6-3.6-3.6
				                            S10,26,12,26s3.6,1.6,3.6,3.6S14,33.2,12,33.2z"></path>
				                          <path class="st0" d="M66,25c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6s4.6-2.1,4.6-4.6S68.6,25,66,25z M66,33.2c-2,0-3.6-1.6-3.6-3.6
				                            S64,26,66,26s3.6,1.6,3.6,3.6S68,33.2,66,33.2z"></path>
				                        </g>
				                        </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[1][url]" value="<?php if(!empty($vehicle_image_gallery[1]['url'])) { echo esc_attr($vehicle_image_gallery[1]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[1][id]" value="<?php if(!empty($vehicle_image_gallery[1]['id'])) { echo esc_attr($vehicle_image_gallery[1]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[2]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[2]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[2]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[2]['url'])) { echo esc_attr($vehicle_image_gallery[2]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 101.9 47.5" style="enable-background:new 0 0 101.9 47.5;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M0,26.3c-0.1,3.3,2.5,6.2,5.8,6.5l0.1,0c0.1,2.1,0.4,4,1.1,5.6c0.9,2,2.2,3.1,3.7,3.1l6,0.1c0,0,0,0,0.1,0
				                          c2.4,0,4.4-3,5-7.3l9.1,0.9c0.9,2,2.2,3.1,3.6,3.1c0,0,0,0,0.1,0c0.1,0,0.2,0,0.3,0c0.1,0,0.1,0,0.2,0l6.8,0.1c0,0,0,0,0.1,0
				                          c1.1,0,2.2-0.7,3-1.9l3,0.3c0.1,2.6,0.5,5,1.4,6.9c1.1,2.4,2.6,3.7,4.3,3.7c0,0,0,0,0.1,0c0.1,0,0.2,0,0.3,0c0.1,0,0.1,0,0.2,0
				                          c0,0,0.1,0,0.1,0l7.2-0.8c0,0,0,0,0,0c3,0,5.2-3.1,5.8-8l12.7-0.9c0.8,3.4,2.5,5.6,4.5,5.6c0,0,0,0,0.1,0c0.1,0,0.2,0,0.3,0
				                          c0.1,0,0.1,0,0.2,0c0,0,0,0,0,0l7.1-0.6c0,0,0,0,0,0c0,0,0,0,0,0c1.7-0.2,3.8-1.5,4.6-6.1l0.3,0c2.4-0.2,4.2-2,4.4-4.4
				                          c0-0.4,0.1-0.9,0.2-1.5c0.4-3.5,1.1-9.4-1.4-12.2c-3.2-3.6-13.2-5.3-20.5-6.4l-0.4-0.1C79.1,12,79,12,78.8,12l-0.1,0
				                          C71.5,4.6,62.5,0.6,52.5,0.4L35,0.1c0,0-0.1,0-0.1,0c-0.1,0-0.3,0-0.4,0c-4-0.1-8.2-0.2-11.3,0.8c-4.7,1.4-12,8.5-13.4,9.8
				                          l-4.2,0.9c-3,0.5-5.3,3.2-5.4,6.4L0,26.3z M23.8,2.8c1.6-0.5,3.7-0.7,5.8-0.8c-0.6,1.7-1.5,5-1.8,8.9l-15.1-0.3
				                          C15.4,8.2,20.5,3.8,23.8,2.8z M34.5,2c5.8,0.1,11.9,4,15.1,9.3l-20.8-0.4c0.2-4,1.3-7.4,1.8-8.9C31.9,2,33.2,2,34.5,2z M75.8,11.9
				                          l-23.9-0.5c-2-3.9-5.4-7.2-9.3-9.2l9.9,0.2C61.2,2.6,69.2,5.9,75.8,11.9z M91.9,41.8l-5.1,0.4c1-1.1,1.9-2.8,2.4-5.1l6.3-0.4
				                          C95.1,39,94.1,41.4,91.9,41.8z M80.9,37.7l7.3-0.5c-0.8,3.1-2.2,5.2-3.8,5.2c0,0,0,0,0,0C82.9,42.3,81.6,40.5,80.9,37.7z
				                           M61.4,44.6C61.4,44.6,61.4,44.6,61.4,44.6c-0.1,0-0.1,0-0.1,0c0,0,0,0-0.1,0l-3.9,0.5c1.2-1.7,2-4.2,2.3-7.1l5.6,0.6
				                          C64.7,42.2,63.2,44.6,61.4,44.6z M49.8,35.9c0.1-5.6,2.2-9.4,4.1-9.4c0,0,0,0,0,0c0.9,0,1.8,0.9,2.5,2.6c0.8,1.9,1.3,4.4,1.2,7
				                          c-0.1,5.6-2.3,9.5-4.1,9.4c-0.9,0-1.8-0.9-2.5-2.6C50.2,41,49.8,38.5,49.8,35.9z M36.7,37.4c0.4-0.4,0.8-0.9,1.2-1.5l5.8,0.6
				                          c-0.6,0.7-1.2,1.1-1.9,1.1L36.7,37.4z M32,35.3l4.8,0.5c-0.7,1-1.5,1.6-2.3,1.6C33.6,37.3,32.7,36.6,32,35.3z M16.7,39.7
				                          C16.7,39.7,16.7,39.7,16.7,39.7C16.7,39.7,16.7,39.7,16.7,39.7l-2.9-0.1c0.2-0.3,0.4-0.7,0.6-1.1c0.7-1.3,1.1-3,1.3-4.8l4,0.4
				                          C19.3,37.5,17.9,39.7,16.7,39.7z M7.9,32C7.9,32,7.9,32,7.9,32C7.9,32,7.9,32,7.9,32C7.9,32,7.9,32,7.9,32c0.1-4.6,1.9-7.5,3.1-7.5
				                          c0,0,0,0,0,0c1.3,0,2.9,2.9,2.8,7.6c0,2.1-0.5,4.1-1.2,5.6c-0.6,1.2-1.3,1.9-2,1.9c-0.6,0-1.3-0.7-1.9-2C8.2,36.1,7.8,34.1,7.9,32z
				                           M2,26.3L2.2,18c0-2.2,1.6-4.1,3.8-4.4l4.4-1l67.8,1.4l1.1,0.2c6.6,1.1,16.6,2.7,19.3,5.8c1.9,2.1,1.2,7.6,0.9,10.6
				                          c-0.1,0.6-0.1,1.1-0.2,1.5c-0.1,1.4-1.2,2.4-2.6,2.5l-30.5,2.1L59.7,36c0-2.9-0.4-5.7-1.4-7.8c-1.1-2.4-2.6-3.7-4.3-3.7
				                          c-3.2-0.1-5.8,4.3-6.1,10.4l-32-3c0-5.2-2-9.2-4.8-9.2c0,0,0,0-0.1,0c-2.6,0-4.7,3.5-5.1,8.3C3.7,30.6,2,28.6,2,26.3z"></path>
				                        <path class="st0" d="M68.5,23.6c-0.5,0.7-0.9,1.7-0.9,2.7c0,2.2,1.3,4,2.9,4.1c0,0,0,0,0,0c0.8,0,1.6-0.4,2.2-1.2
				                          c0.5-0.7,0.9-1.7,0.9-2.7c0-2.2-1.3-4-2.9-4.1C69.9,22.4,69.1,22.8,68.5,23.6z M68.6,26.3c0-0.8,0.3-1.6,0.7-2.2
				                          c0.4-0.5,0.9-0.8,1.4-0.8c0,0,0,0,0,0c1.1,0,2,1.4,1.9,3c0,0.8-0.3,1.6-0.7,2.2c-0.4,0.5-0.9,0.8-1.4,0.8
				                          C69.5,29.4,68.6,28,68.6,26.3z"></path>
				                        <path class="st0" d="M91.9,24.6c0,1.8,1,3.3,2.4,3.4c0,0,0,0,0,0c1.4,0,2.5-1.4,2.5-3.2c0-0.9-0.2-1.7-0.6-2.3
				                          c-0.5-0.7-1.1-1.1-1.8-1.1C93.1,21.3,92,22.7,91.9,24.6z M92.9,24.6c0-1.2,0.7-2.3,1.5-2.3c0,0,0,0,0,0c0.4,0,0.7,0.2,1,0.6
				                          c0.3,0.5,0.5,1.1,0.5,1.7c0,1.2-0.7,2.2-1.5,2.3C93.6,26.9,92.9,25.8,92.9,24.6z"></path>
				                        <path class="st0" d="M26.3,14.4l5,0.1c0.3,0,0.5,0.2,0.5,0.5c0,0.3-0.2,0.5-0.5,0.5c0,0,0,0,0,0l-5-0.1c-0.3,0-0.5-0.2-0.5-0.5
				                          C25.7,14.6,26,14.4,26.3,14.4z"></path>
				                        <path class="st0" d="M12.3,14.1l4,0.1c0.3,0,0.5,0.2,0.5,0.5c0,0.3-0.2,0.5-0.5,0.5c0,0,0,0,0,0l-4-0.1c-0.3,0-0.5-0.2-0.5-0.5
				                          C11.7,14.3,11.9,14.1,12.3,14.1z"></path>
				                        <path class="st0" d="M77.3,25.7l12.3-0.7c0.3,0,0.5,0.2,0.5,0.5s-0.2,0.5-0.5,0.5l-12.3,0.7c0,0,0,0,0,0c-0.3,0-0.5-0.2-0.5-0.5
				                          C76.9,25.9,77.1,25.7,77.3,25.7z"></path>
				                        <path class="st0" d="M80,27.2l7-0.4c0.3,0,0.5,0.2,0.5,0.5c0,0.3-0.2,0.5-0.5,0.5l-7,0.4c0,0,0,0,0,0c-0.3,0-0.5-0.2-0.5-0.5
				                          C79.5,27.4,79.7,27.2,80,27.2z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[2][url]" value="<?php if(!empty($vehicle_image_gallery[2]['url'])) { echo esc_attr($vehicle_image_gallery[2]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[2]['id']" value="<?php if(!empty($vehicle_image_gallery[2]['id'])) { echo esc_attr($vehicle_image_gallery[2]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[3]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[3]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[3]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[3]['url'])) { echo esc_attr($vehicle_image_gallery[3]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 102 47" style="enable-background:new 0 0 102 47;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M13,37.5c0,5.2,4.3,9.5,9.5,9.5s9.5-4.3,9.5-9.5S27.7,28,22.5,28S13,32.3,13,37.5z M15,37.5
				                          c0-4.1,3.4-7.5,7.5-7.5s7.5,3.4,7.5,7.5S26.6,45,22.5,45S15,41.6,15,37.5z"></path>
				                        <path class="st0" d="M69,37.5c0,5.2,4.3,9.5,9.5,9.5s9.5-4.3,9.5-9.5S83.7,28,78.5,28S69,32.3,69,37.5z M71,37.5
				                          c0-4.1,3.4-7.5,7.5-7.5s7.5,3.4,7.5,7.5S82.6,45,78.5,45S71,41.6,71,37.5z"></path>
				                        <path class="st0" d="M0,19.4l0,11.9C0,35,3,38,6.7,38h3.8c0.6,0,1-0.4,1-1c0-5.8,4.9-10.5,11-10.5c6.1,0,11,4.7,11,10.5
				                          c0,0.6,0.4,1,1,1h32c0.6,0,1-0.4,1-1c0-5.8,4.9-10.5,11-10.5c6.1,0,11,4.7,11,10.5c0,0.6,0.4,1,1,1h4.8c3.7,0,6.7-3,6.7-6.7v-6.8
				                          c0-4.8-3.6-8.9-8.3-9.6l-10-1.9c-3.1-0.6-5.9-1.8-8.6-3.5c-0.8-0.5-1.7-1.2-2.6-1.8C67.6,4.3,61.4,0,53.5,0L35.1,0
				                          c-3.2,0-6.4,0.9-9.1,2.7L19,7.4c-1,0.6-2.1,1.4-3.1,2.3C14,11.2,11.7,12,9.4,12H9h0H7.4C3.3,12,0,15.3,0,19.4z M35.1,2h8.4v10.5
				                          l-27.6-0.4c0.4-0.3,0.8-0.6,1.2-0.9c1-0.8,2-1.5,2.9-2.1l7.1-4.7C29.5,2.8,32.3,2,35.1,2z M77.1,12.9l-8.3-0.1l0.7-2
				                          c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6l-0.9,2.6l-22.2-0.3V2h9c7.3,0,12.9,3.9,17.9,7.4c0.9,0.6,1.8,1.3,2.7,1.8
				                          C75,11.8,76,12.4,77.1,12.9z M86.9,27.5H100v3.8c0,2.6-2.1,4.7-4.7,4.7h-3.9C91.2,32.6,89.5,29.6,86.9,27.5z M22.5,24.5
				                          c-2.2,0-4.3,0.5-6.2,1.5H2v-6.6c0-3,2.4-5.4,5.4-5.4H9l74.5,1c0,0,0,0,0,0c0,0,0,0,0,0l9.8,1.9c3.8,0.6,6.6,3.8,6.6,7.6v2H85.5
				                          c-2-1.3-4.4-2-7-2c-6.8,0-12.4,5.1-13,11.5H35.5C34.9,29.6,29.3,24.5,22.5,24.5z M2,31.3V27h12.7c-2.9,2.1-4.9,5.3-5.2,9H6.7
				                          C4.1,36,2,33.9,2,31.3z"></path>
				                        <path class="st0" d="M18.5,16h4c0.3,0,0.5,0.2,0.5,0.5S22.8,17,22.5,17h-4c-0.3,0-0.5-0.2-0.5-0.5S18.2,16,18.5,16z"></path>
				                        <path class="st0" d="M46.5,16.5h5c0.3,0,0.5,0.2,0.5,0.5s-0.2,0.5-0.5,0.5h-5c-0.3,0-0.5-0.2-0.5-0.5S46.2,16.5,46.5,16.5z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[3][url]" value="<?php if(!empty($vehicle_image_gallery[3]['url'])) { echo esc_attr($vehicle_image_gallery[3]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[3][id]" value="<?php if(!empty($vehicle_image_gallery[3]['id'])) { echo esc_attr($vehicle_image_gallery[3]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[4]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[4]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[4]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[4]['url'])) { echo esc_attr($vehicle_image_gallery[4]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 97.5 47" style="enable-background:new 0 0 97.5 47;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M84.3,11C82.8,9.7,75.2,3,68.8,1c-3.3-1-6.3-1-9.8-1c0,0,0,0,0,0h-0.3c-0.2,0-0.4,0-0.6,0l-0.7,0h-16
				                          c-9.6,0-17.9,3.6-25.4,11H16c0,0,0,0,0,0c-7.6,0-11.4,0.3-13.6,2.5C0,15.9,0,19.9,0,27.9l0,2.8c0,2.3,1.9,4.3,4.4,4.5l1.4,0.1
				                          c0.5,3.1,2.1,5.4,4.1,5.6c0,0,0,0,0,0l5.8,0.7c0,0,0,0,0.1,0c0,0,0.1,0,0.1,0c0.1,0,0.2,0,0.3,0c1.8,0,3.3-1.9,4-5L33,37.9
				                          c0.5,4.9,2.6,8,5.6,8.1l7.2,1c0,0,0.1,0,0.1,0c0.1,0,0.1,0,0.2,0c0.1,0,0.2,0,0.4,0c3.2,0,5.7-4.4,5.9-10.5l0.1,0
				                          c0.8,1.2,1.8,1.8,2.9,1.8h6.8c0.1,0,0.1,0,0.2,0c0.1,0,0.2,0,0.4,0c1.4,0,2.7-1.1,3.6-2.9l9.2-0.7C76.1,39,78,42,80.5,42h6
				                          c2.7,0,4.8-3.6,5-8.6l0.1,0c3.3-0.2,6-3.1,6-6.4v-5.3C97.5,14.2,89.1,11.5,84.3,11z M81.2,11H64.5c-0.8-3.8-2.4-7.2-3.3-9
				                          c2.4,0.1,4.6,0.3,6.9,0.9C72.9,4.3,78.4,8.6,81.2,11z M58.5,2c0.6,0,1.1,0,1.6,0c0.8,1.5,2.5,5,3.4,9H43.3c2.7-4.6,7.7-9,14.1-9
				                          H58.5z M41.5,2h8.2c-3.9,2.1-6.9,5.6-8.7,9H19C25.7,5,33.1,2,41.5,2z M2.2,19.9c0-0.2,0-0.4,0-0.5l5.7,0.5v3l-5.8-0.5V19.9z
				                           M2,30.8l0-2.8c0-0.5,0-0.9,0-1.4l28.2,1.9c0.9,0.1,1.9,0.1,2.8,0.1c1.6,0,3.2-0.1,4.8-0.3l4.3-0.5c-0.9,2-1.5,4.6-1.5,7.7L34,36
				                          L7.9,33.6C7.8,32.3,7,31.3,6,31.3c-0.9,0-1.7,0.8-1.9,1.9C2.9,32.9,2,31.9,2,30.8z M6.8,35.5l5.2,0.5c0.4,2,1,3.6,1.9,4.6l-3.9-0.5
				                          c0,0,0,0,0,0C8.6,39.9,7.3,38,6.8,35.5z M16.3,40.8c-1.3,0-2.6-1.9-3.2-4.7l6.2,0.6C18.7,39.1,17.5,40.8,16.3,40.8z M35,37.9
				                          l5.6-0.5c0.2,2.9,1,5.4,2.1,7.1L38.9,44c0,0,0,0-0.1,0c0,0,0,0-0.1,0C36.9,44,35.4,41.5,35,37.9z M46.5,45c-1.9,0-3.9-3.9-3.9-9.5
				                          s2.1-9.5,3.9-9.5c1.9,0,3.9,3.9,3.9,9.5S48.4,45,46.5,45z M53.8,36.4l5.7-0.5c0.3,0.5,0.7,1,1.1,1.4h-5.1
				                          C54.9,37.3,54.3,37,53.8,36.4z M62.8,37.3c-0.8,0-1.5-0.5-2.2-1.5l4.6-0.4C64.5,36.6,63.7,37.3,62.8,37.3z M77.6,34.4l4-0.3
				                          c0.2,2.4,0.8,4.5,1.8,5.9h-2.9C79.3,40,78,37.8,77.6,34.4z M86.5,40c-1.3,0-3-2.9-3-7.5s1.7-7.5,3-7.5s3,2.9,3,7.5c0,0,0,0,0,0
				                          c0,0,0,0,0,0c0,0,0,0,0,0C89.5,37.2,87.7,40,86.5,40z M95.5,27c0,2.3-1.8,4.2-4,4.4c-0.3-4.8-2.3-8.4-5-8.4c-2.8,0-4.9,3.9-5,9.1
				                          l-4.8,0.4c-0.1,0-0.1,0-0.2,0c-0.1,0-0.2,0-0.2,0.1l-23.8,1.9c-0.2-6-2.7-10.5-5.9-10.5c-1.5,0-2.9,1-3.9,2.7l-5,0.6
				                          c-2.5,0.3-5,0.3-7.4,0.2L2,25.5c0-0.8,0-1.5,0-2.2l6.4,0.5c0,0,0,0,0,0c0.1,0,0.2,0,0.3-0.1c0.1-0.1,0.2-0.2,0.2-0.4v-4
				                          c0-0.3-0.2-0.5-0.5-0.5l-6.2-0.5c0.2-1.6,0.7-2.7,1.4-3.4C5.4,13.3,8.8,13,16.5,13h67.4c0.6,0.1,11.6,1.2,11.6,8.6V27z"></path>
				                        <path class="st0" d="M57.4,14.5h-5c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h5c0.3,0,0.5-0.2,0.5-0.5S57.7,14.5,57.4,14.5z"></path>
				                        <path class="st0" d="M74.3,14.5h-4c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h4c0.3,0,0.5-0.2,0.5-0.5S74.6,14.5,74.3,14.5z"></path>
				                        <path class="st0" d="M33.4,20L25,19.5c-0.1,0-0.3,0-0.4,0.1c-0.1,0.1-0.2,0.2-0.2,0.4v4.4c0,0.3,0.2,0.5,0.5,0.5l8.3,0.5
				                          c0,0,0,0,0,0c0.1,0,0.2,0,0.3-0.1c0.1-0.1,0.2-0.2,0.2-0.4v-4.4C33.8,20.3,33.6,20.1,33.4,20z M32.8,24.4l-7.3-0.4v-3.4l7.3,0.4
				                          V24.4z"></path>
				                        <path class="st0" d="M9.4,32.7l13.4,1.1c0,0,0,0,0,0c0.1,0,0.2,0,0.3-0.1c0.1-0.1,0.2-0.2,0.2-0.4v-3.5c0-0.3-0.2-0.5-0.5-0.5
				                          L9.5,28.2c-0.1,0-0.3,0-0.4,0.1C9,28.4,9,28.5,9,28.7v3.5C9,32.5,9.2,32.7,9.4,32.7z M10,29.2l12.4,1v2.5l-12.4-1V29.2z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[4][url]" value="<?php if(!empty($vehicle_image_gallery[4]['url'])) { echo esc_attr($vehicle_image_gallery[4]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[4][id]" value="<?php if(!empty($vehicle_image_gallery[4]['id'])) { echo esc_attr($vehicle_image_gallery[4]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[5]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[5]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[5]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[5]['url'])) { echo esc_attr($vehicle_image_gallery[5]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 78 57.8" style="enable-background:new 0 0 78 57.8;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M69.9,18.1L68.5,5.6c-0.3-3.2-3-5.6-6.2-5.6H15.7c-3.2,0-5.9,2.4-6.2,5.6L8.1,18.1c-4.5,0.5-8.1,4.3-8.1,9
				                          v16.7v13c0,0.6,0.4,1,1,1h11c0.6,0,1-0.4,1-1v-6.8h0.7c0.6,0,1-0.4,1-1c0-1.4,1.1-2.5,2.5-2.5s2.5,1.1,2.5,2.5c0,0.6,0.4,1,1,1H65
				                          v6.8c0,0.6,0.4,1,1,1h11c0.6,0,1-0.4,1-1v-13V27.1C78,22.4,74.4,18.6,69.9,18.1z M76,27.1v6.6h-9.4l0.5-2.3h5.6
				                          c1,0,1.8-0.8,1.8-1.8v-2.4c0-1-0.8-1.8-1.8-1.8h-4.4l1-5.3C73,20.3,76,23.3,76,27.1z M12.4,33.7l-0.5-2.3H16c1,0,1.8-0.8,1.8-1.8
				                          v-2.4c0-1-0.8-1.8-1.8-1.8h-5.3l-1-5.3h58.6l-1,5.3H63c-1,0-1.8,0.8-1.8,1.8v2.4c0,1,0.8,1.8,1.8,1.8h3.1l-0.5,2.3H12.4z M7,28.8
				                          h3.4l0.3,1.5H6.3c-0.4,0-0.8-0.4-0.8-0.8v-2.4c0-0.4,0.4-0.8,0.8-0.8h3.6l0.3,1.5H7c-0.3,0-0.5,0.2-0.5,0.5S6.7,28.8,7,28.8z
				                           M11.5,28.8h3.8c0.3,0,0.5-0.2,0.5-0.5s-0.2-0.5-0.5-0.5h-4L11,26.3H16c0.4,0,0.8,0.4,0.8,0.8v2.4c0,0.4-0.4,0.8-0.8,0.8h-4.3
				                          L11.5,28.8z M66.5,6.2l1.4,11.9H10.1l1.4-11.9H66.5z M72,27.8h-4.2l0.3-1.5h4.6c0.4,0,0.8,0.4,0.8,0.8v2.4c0,0.4-0.4,0.8-0.8,0.8
				                          h-5.4l0.3-1.5H72c0.3,0,0.5-0.2,0.5-0.5S72.3,27.8,72,27.8z M66.7,27.8h-3.1c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h2.9l-0.3,1.5
				                          H63c-0.4,0-0.8-0.4-0.8-0.8v-2.4c0-0.4,0.4-0.8,0.8-0.8H67L66.7,27.8z M15.7,2h46.5c2,0,3.6,1.3,4.1,3.2H11.6
				                          C12.1,3.4,13.8,2,15.7,2z M8.7,20.1l1,5.3H6.3c-1,0-1.8,0.8-1.8,1.8v2.4c0,1,0.8,1.8,1.8,1.8h4.6l0.5,2.3H2v-6.6
				                          C2,23.3,5,20.3,8.7,20.1z M11,55.8H2v-7.5c1.1,1,2.6,1.7,4.3,1.7H11V55.8z M17.2,44.6c-2.1,0-3.9,1.5-4.4,3.5H6.3
				                          c-2.3,0-4.3-1.9-4.3-4.3v-9.1h74v9.1c0,2.3-1.9,4.3-4.3,4.3H21.6C21.1,46.1,19.3,44.6,17.2,44.6z M67,55.8v-5.8h4.7
				                          c1.6,0,3.1-0.6,4.3-1.7v7.5H67z"></path>
				                        <path class="st0" d="M27,44.7h24c0.3,0,0.5-0.2,0.5-0.5v-5.3c0-0.3-0.2-0.5-0.5-0.5H27c-0.3,0-0.5,0.2-0.5,0.5v5.3
				                          C26.5,44.5,26.7,44.7,27,44.7z M27.5,39.4h23v4.3h-23V39.4z"></path>
				                        <path class="st0" d="M17.2,47.2c-1,0-1.8,0.8-1.8,1.8c0,1,0.8,1.8,1.8,1.8c1,0,1.8-0.8,1.8-1.8C19,48.1,18.2,47.2,17.2,47.2z
				                           M17.2,49.9c-0.5,0-0.8-0.4-0.8-0.8s0.4-0.8,0.8-0.8s0.8,0.4,0.8,0.8S17.7,49.9,17.2,49.9z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[5][url]" value="<?php if(!empty($vehicle_image_gallery[5]['url'])) { echo esc_attr($vehicle_image_gallery[5]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[5][id]" value="<?php if(!empty($vehicle_image_gallery[5]['id'])) { echo esc_attr($vehicle_image_gallery[5]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[6]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[6]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[6]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[6]['url'])) { echo esc_attr($vehicle_image_gallery[6]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 97.5 47" style="enable-background:new 0 0 97.5 47;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M95.1,13.5c-2.2-2.2-6.1-2.5-13.6-2.5c0,0,0,0,0,0h-0.1C73.9,3.6,65.6,0,56,0H40l-0.7,0c-0.2,0-0.5,0-0.7,0
				                          h-0.2c0,0,0,0,0,0c-3.4,0-6.5,0.1-9.8,1C22.2,3,14.6,9.7,13.1,11C8.4,11.5,0,14.2,0,21.6V27c0,3.3,2.6,6.2,6,6.4l0.1,0
				                          c0.2,5,2.3,8.6,5,8.6h6c2.5,0,4.4-3,4.9-7.4l9.2,0.7c0.9,1.9,2.2,2.9,3.6,2.9c0.1,0,0.2,0,0.4,0c0.1,0,0.1,0,0.2,0H42
				                          c1.1,0,2.1-0.6,2.9-1.8l0.1,0c0.2,6,2.7,10.5,5.9,10.5c0.1,0,0.2,0,0.4,0c0.1,0,0.1,0,0.2,0c0,0,0.1,0,0.1,0l7.2-1
				                          c3-0.1,5.1-3.2,5.6-8.1l12.7-1.2c0.7,3.1,2.3,5,4,5c0.1,0,0.2,0,0.3,0c0,0,0.1,0,0.1,0c0,0,0,0,0.1,0l5.8-0.7c0,0,0,0,0,0
				                          c2-0.3,3.6-2.6,4.1-5.6l1.4-0.1c2.4-0.2,4.4-2.2,4.4-4.5l0-2.8C97.5,19.9,97.5,15.9,95.1,13.5z M95.3,19.3c0,0.2,0,0.4,0,0.5v2.5
				                          l-5.8,0.5v-3L95.3,19.3z M56,2c8.4,0,15.8,3,22.5,9h-22c-1.8-3.4-4.8-6.9-8.7-9H56z M38.7,2H40c6.5,0,11.4,4.4,14.1,9H34
				                          c0.9-4,2.6-7.5,3.4-9C37.8,2,38.3,2,38.7,2z M29.3,3c2.3-0.7,4.5-0.9,6.9-0.9c-0.9,1.8-2.4,5.1-3.3,9h-2.4
				                          c-0.3-2.2-2.1-3.9-4.4-3.9c-2.2,0-4.1,1.7-4.4,3.9h-5.6C19.1,8.6,24.6,4.4,29.3,3z M29.5,11h-6.7c0.3-1.6,1.7-2.9,3.4-2.9
				                          S29.3,9.4,29.5,11z M11,40c-1.3,0-3-2.8-3-7.5c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0-4.6,1.7-7.5,3-7.5s3,2.9,3,7.5S12.3,40,11,40
				                          z M17,40h-2.9c0.9-1.4,1.6-3.5,1.8-5.9l4,0.3C19.5,37.8,18.2,40,17,40z M34.7,37.3c-0.9,0-1.7-0.7-2.4-1.8l4.6,0.4
				                          C36.2,36.8,35.4,37.3,34.7,37.3z M42,37.3h-5.1c0.4-0.4,0.7-0.8,1.1-1.4l5.7,0.5C43.2,37,42.6,37.3,42,37.3z M50.9,45
				                          c-1.9,0-3.9-3.9-3.9-9.5s2.1-9.5,3.9-9.5c1.9,0,3.9,3.9,3.9,9.5S52.8,45,50.9,45z M58.7,44C58.7,44,58.7,44,58.7,44
				                          c-0.1,0-0.1,0-0.1,0l-3.9,0.5c1.1-1.7,1.9-4.2,2.1-7.1l5.6,0.5C62,41.5,60.6,44,58.7,44z M81.2,40.8c-1.2,0-2.4-1.6-3-4.1l6.2-0.6
				                          C83.8,38.9,82.5,40.8,81.2,40.8z M87.4,40.1C87.4,40.1,87.4,40.1,87.4,40.1l-3.9,0.5c0.9-1,1.5-2.6,1.9-4.6l5.2-0.5
				                          C90.2,38,88.8,39.9,87.4,40.1z M95.5,27.9l0,2.8c0,1.3-1.1,2.4-2.5,2.5l-21,1.9c-0.3-0.8-1-1.4-1.7-1.4c-0.9,0-1.6,0.7-1.8,1.7
				                          L63.5,36l-6.6-0.6c0-3-0.6-5.7-1.5-7.7l4.3,0.5c1.6,0.2,3.2,0.3,4.8,0.3c0.9,0,1.9,0,2.8-0.1l28.2-1.9C95.5,27,95.5,27.5,95.5,27.9
				                          z M67.2,27.4c-2.5,0.2-5,0.1-7.4-0.2l-5-0.6c-1-1.7-2.4-2.7-3.9-2.7c-3.2,0-5.7,4.4-5.9,10.5l-23.8-1.9c-0.1,0-0.2-0.1-0.2-0.1
				                          c-0.1,0-0.1,0-0.2,0L16,32.1c-0.1-5.2-2.2-9.1-5-9.1c-2.6,0-4.7,3.5-5,8.4c-2.3-0.2-4-2.1-4-4.4v-5.3c0-7.5,11-8.6,11.6-8.6H81
				                          c7.6,0,11.1,0.3,12.7,1.9c0.7,0.7,1.2,1.9,1.4,3.4L89,18.9c-0.3,0-0.5,0.2-0.5,0.5v4c0,0.1,0.1,0.3,0.2,0.4
				                          c0.1,0.1,0.2,0.1,0.3,0.1c0,0,0,0,0,0l6.4-0.5c0,0.7,0,1.4,0,2.2L67.2,27.4z"></path>
				                        <path class="st0" d="M45,14.5h-5c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h5c0.3,0,0.5-0.2,0.5-0.5S45.3,14.5,45,14.5z"></path>
				                        <path class="st0" d="M27.2,14.5h-4c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h4c0.3,0,0.5-0.2,0.5-0.5S27.5,14.5,27.2,14.5z"></path>
				                        <path class="st0" d="M72.4,19.5L64.1,20c-0.3,0-0.5,0.2-0.5,0.5v4.4c0,0.1,0.1,0.3,0.2,0.4c0.1,0.1,0.2,0.1,0.3,0.1c0,0,0,0,0,0
				                          l8.3-0.5c0.3,0,0.5-0.2,0.5-0.5V20c0-0.1-0.1-0.3-0.2-0.4C72.7,19.6,72.6,19.5,72.4,19.5z M72,23.9l-7.3,0.4V21l7.3-0.4V23.9z"></path>
				                        <path class="st0" d="M74.6,33.8C74.6,33.8,74.7,33.8,74.6,33.8L88,32.7c0.3,0,0.5-0.2,0.5-0.5v-3.5c0-0.1-0.1-0.3-0.2-0.4
				                          s-0.2-0.1-0.4-0.1l-13.4,1.1c-0.3,0-0.5,0.2-0.5,0.5v3.5c0,0.1,0.1,0.3,0.2,0.4C74.4,33.7,74.5,33.8,74.6,33.8z M75.1,30.2l12.4-1
				                          v2.5l-12.4,1V30.2z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[6][url]" value="<?php if(!empty($vehicle_image_gallery[6]['url'])) { echo esc_attr($vehicle_image_gallery[6]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[6][id]" value="<?php if(!empty($vehicle_image_gallery[6]['id'])) { echo esc_attr($vehicle_image_gallery[6]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[7]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[7]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[7]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[7]['url'])) { echo esc_attr($vehicle_image_gallery[7]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 102 47" style="enable-background:new 0 0 102 47;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M79.5,28c-5.2,0-9.5,4.3-9.5,9.5s4.3,9.5,9.5,9.5s9.5-4.3,9.5-9.5S84.7,28,79.5,28z M79.5,45
				                          c-4.1,0-7.5-3.4-7.5-7.5s3.4-7.5,7.5-7.5s7.5,3.4,7.5,7.5S83.6,45,79.5,45z"></path>
				                        <path class="st0" d="M23.5,28c-5.2,0-9.5,4.3-9.5,9.5s4.3,9.5,9.5,9.5s9.5-4.3,9.5-9.5S28.7,28,23.5,28z M23.5,45
				                          c-4.1,0-7.5-3.4-7.5-7.5s3.4-7.5,7.5-7.5s7.5,3.4,7.5,7.5S27.6,45,23.5,45z"></path>
				                        <path class="st0" d="M94.6,12H93h0h-0.4c-2.4,0-4.7-0.8-6.5-2.3C85.1,8.8,84,8,83,7.4l-7.1-4.7C73.2,0.9,70.1,0,66.9,0H48.5
				                          c-7.9,0-14.1,4.3-19,7.7c-0.9,0.6-1.8,1.2-2.6,1.8c-2.6,1.7-5.5,2.9-8.6,3.5l-10,1.9C3.6,15.6,0,19.7,0,24.5v6.8C0,35,3,38,6.7,38
				                          h4.8c0.6,0,1-0.4,1-1c0-5.8,4.9-10.5,11-10.5c6.1,0,11,4.7,11,10.5c0,0.6,0.4,1,1,1h32c0.6,0,1-0.4,1-1c0-5.8,4.9-10.5,11-10.5
				                          c6.1,0,11,4.7,11,10.5c0,0.6,0.4,1,1,1h3.8c3.7,0,6.7-3,6.7-6.7V19.4C102,15.3,98.7,12,94.6,12z M74.8,4.4l7.1,4.7
				                          c0.9,0.6,2,1.3,2.9,2.1c0.4,0.3,0.8,0.6,1.2,0.9l-27.6,0.4V2h8.4C69.7,2,72.5,2.8,74.8,4.4z M28,11.2c0.9-0.6,1.7-1.2,2.7-1.8
				                          C35.6,5.9,41.2,2,48.5,2h9v10.5l-22.2,0.3l-0.9-2.6c-0.2-0.5-0.7-0.8-1.3-0.6c-0.5,0.2-0.8,0.7-0.6,1.3l0.7,2l-8.3,0.1
				                          C26,12.4,27,11.8,28,11.2z M10.5,36H6.7C4.1,36,2,33.9,2,31.3v-3.8h13.1C12.5,29.6,10.8,32.6,10.5,36z M66.5,36H36.5
				                          c-0.5-6.4-6.1-11.5-13-11.5c-2.6,0-5,0.7-7,2H2v-2c0-3.8,2.8-7.1,6.6-7.6l9.8-1.9c0,0,0,0,0,0c0,0,0,0,0,0L93,14h1.6
				                          c3,0,5.4,2.4,5.4,5.4V26H85.6c-1.8-1-3.9-1.5-6.2-1.5C72.7,24.5,67.1,29.6,66.5,36z M95.3,36h-2.9c-0.3-3.7-2.3-6.9-5.2-9H100v4.3
				                          C100,33.9,97.9,36,95.3,36z"></path>
				                        <path class="st0" d="M83.5,16h-4c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h4c0.3,0,0.5-0.2,0.5-0.5S83.8,16,83.5,16z"></path>
				                        <path class="st0" d="M55.5,16.5h-5c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h5c0.3,0,0.5-0.2,0.5-0.5S55.8,16.5,55.5,16.5z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[7][url]" value="<?php if(!empty($vehicle_image_gallery[7]['url'])) { echo esc_attr($vehicle_image_gallery[7]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[7][id]" value="<?php if(!empty($vehicle_image_gallery[7]['id'])) { echo esc_attr($vehicle_image_gallery[7]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[8]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[8]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[8]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[8]['url'])) { echo esc_attr($vehicle_image_gallery[8]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 78 57.8" style="enable-background:new 0 0 78 57.8;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M69.9,18L68.5,5.6V1c0-0.6-0.4-1-1-1h-57C10.2,0,10,0.1,9.8,0.3S9.5,0.7,9.5,1l0,4.8L8.1,18
				                          C3.6,18.5,0,22.3,0,27v16.7v13c0,0.6,0.4,1,1,1h11c0.6,0,1-0.4,1-1V50h0.7c0.6,0,1-0.4,1-1c0-1.4,1.1-2.5,2.5-2.5s2.5,1.1,2.5,2.5
				                          c0,0.6,0.4,1,1,1H65v6.8c0,0.6,0.4,1,1,1h11c0.6,0,1-0.4,1-1v-13V27C78,22.3,74.4,18.5,69.9,18z M76,27v6.6h-8.9l0.5-2.3h5.1
				                          c1,0,1.8-0.8,1.8-1.8v-2.4c0-1-0.8-1.8-1.8-1.8h-3.9l1-5.2C73.3,20.5,76,23.4,76,27z M13.5,7h3.6c0.3,0,0.5-0.2,0.5-0.5
				                          S17.4,6,17.2,6h-4l-0.6-1.5h5.4c0.4,0,0.8,0.4,0.8,0.8v2.4c0,0.4-0.4,0.8-0.8,0.8h-3.7L13.5,7z M11.5,5.6l0-0.9l1.8,4.4
				                          c0,0,0,0.1,0,0.1l1,2.4h48.8l3.3-7.2V18h-55l0-12.1l0-0.1C11.5,5.7,11.5,5.7,11.5,5.6z M10.5,20h57c0.1,0,0.2,0,0.3-0.1l-2.6,13.2
				                          H12.8l-2.6-13.2C10.3,20,10.4,20,10.5,20z M68.1,28.8H72c0.3,0,0.5-0.2,0.5-0.5s-0.2-0.5-0.5-0.5h-3.7l0.3-1.5h4.1
				                          c0.4,0,0.8,0.4,0.8,0.8v2.4c0,0.4-0.4,0.8-0.8,0.8h-4.9L68.1,28.8z M64.7,6h-4.3c-0.3,0-0.5,0.2-0.5,0.5S60.1,7,60.4,7h3.8
				                          l-0.7,1.5h-3.8c-0.4,0-0.8-0.4-0.8-0.8V5.3c0-0.4,0.4-0.8,0.8-0.8h5.7L64.7,6z M9.7,27.8H7c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5
				                          h2.9l0.3,1.5H6.3c-0.4,0-0.8-0.4-0.8-0.8v-2.4c0-0.4,0.4-0.8,0.8-0.8h3.1L9.7,27.8z M66.5,2l-0.7,1.5h-6.1c-1,0-1.8,0.8-1.8,1.8
				                          v2.4c0,1,0.8,1.8,1.8,1.8h3.4l-0.5,1.1H15l-0.5-1.1h3.3c1,0,1.8-0.8,1.8-1.8V5.3c0-1-0.8-1.8-1.8-1.8h-5.8l-0.6-1.4l0-0.1H66.5z
				                           M8.2,20.1l1,5.2H6.3c-1,0-1.8,0.8-1.8,1.8v2.4c0,1,0.8,1.8,1.8,1.8h4.1l0.5,2.3H2V27C2,23.4,4.7,20.5,8.2,20.1z M11,55.8H2v-7.5
				                          c1.1,1,2.6,1.7,4.3,1.7H11V55.8z M17.2,44.5c-2.1,0-3.9,1.5-4.4,3.5H6.3C3.9,48,2,46.1,2,43.8v-9.1h9.1c0,0,0.1,0.1,0.1,0.1
				                          c0,0,0.1,0.1,0.1,0.1c0.1,0.1,0.1,0.1,0.2,0.1c0,0,0.1,0,0.1,0.1c0.1,0,0.2,0.1,0.4,0.1c0,0,0,0,0,0c0,0,0,0,0,0h54c0,0,0,0,0,0
				                          c0,0,0,0,0,0c0.1,0,0.2,0,0.4-0.1c0,0,0.1,0,0.1-0.1c0.1,0,0.1-0.1,0.2-0.1c0,0,0.1-0.1,0.1-0.1c0,0,0.1-0.1,0.1-0.1H76v9.1
				                          c0,2.3-1.9,4.3-4.3,4.3H21.6C21.1,46,19.3,44.5,17.2,44.5z M67,55.8V50h4.7c1.6,0,3.1-0.6,4.3-1.7v7.5H67z"></path>
				                        <path class="st0" d="M27,44.7h24c0.3,0,0.5-0.2,0.5-0.5v-5.3c0-0.3-0.2-0.5-0.5-0.5H27c-0.3,0-0.5,0.2-0.5,0.5v5.3
				                          C26.5,44.4,26.7,44.7,27,44.7z M27.5,39.3h23v4.3h-23V39.3z"></path>
				                        <path class="st0" d="M17.2,47.2c-1,0-1.8,0.8-1.8,1.8s0.8,1.8,1.8,1.8c1,0,1.8-0.8,1.8-1.8S18.2,47.2,17.2,47.2z M17.2,49.8
				                          c-0.5,0-0.8-0.4-0.8-0.8s0.4-0.8,0.8-0.8S18,48.5,18,49S17.7,49.8,17.2,49.8z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[8][url]" value="<?php if(!empty($vehicle_image_gallery[8]['url'])) { echo esc_attr($vehicle_image_gallery[8]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[8][id]" value="<?php if(!empty($vehicle_image_gallery[8]['id'])) { echo esc_attr($vehicle_image_gallery[8]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[9]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[9]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[9]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[9]['url'])) { echo esc_attr($vehicle_image_gallery[9]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 97.3 56.9" style="enable-background:new 0 0 97.3 56.9;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M24.5,22.3c-5.6,0-10.2,4.1-11.1,9.4c0,0.1,0,0.1,0,0.2c0,0,0,0,0,0c-0.1,0.6-0.1,1.1-0.1,1.7
				                          c0,6.2,5.1,11.3,11.3,11.3c6.2,0,11.3-5.1,11.3-11.3C35.8,27.3,30.7,22.3,24.5,22.3z M24.5,23.3c4.9,0,9,3.5,10.1,8.1h-3.8
				                          c-0.9-2.7-3.5-4.6-6.4-4.6s-5.5,1.9-6.4,4.6h-3.5C15.5,26.7,19.6,23.3,24.5,23.3z M31,32.3h3.7c0.1,0.4,0.1,0.8,0.1,1.3
				                          c0,0.1,0,0.3,0,0.4l-3.7,0.6c0-0.3,0.1-0.6,0.1-1C31.2,33.2,31.1,32.7,31,32.3z M24.3,38.4c-2.7,0-4.8-2.2-4.8-4.8
				                          c0-2.7,2.2-4.8,4.8-4.8s4.8,2.2,4.8,4.8C29.2,36.2,27,38.4,24.3,38.4z M14.2,33.6c0-0.4,0-0.8,0.1-1.3h3.4
				                          c-0.1,0.4-0.1,0.8-0.1,1.3c0,0.3,0,0.6,0.1,1L14.2,34C14.2,33.9,14.2,33.7,14.2,33.6z M14.3,35l3.6,0.6c0.6,2,2.1,3.6,4.1,4.4
				                          l0.7,3.8C18.3,42.9,14.9,39.4,14.3,35z M23.6,43.9L23,40.3c0.4,0.1,0.9,0.1,1.3,0.1c0.6,0,1.1-0.1,1.7-0.2l-0.6,3.7
				                          c-0.3,0-0.6,0-0.9,0C24.2,43.9,23.9,43.9,23.6,43.9z M26.4,43.7l0.7-3.9c1.8-0.8,3.2-2.3,3.8-4.2l3.9-0.6
				                          C34.1,39.4,30.7,42.9,26.4,43.7z"></path>
				                        <path class="st0" d="M24.3,31.1c-1.4,0-2.5,1.1-2.5,2.5c0,1.4,1.1,2.5,2.5,2.5c1.4,0,2.5-1.1,2.5-2.5
				                          C26.9,32.2,25.7,31.1,24.3,31.1z M24.3,35.1c-0.8,0-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5s1.5,0.7,1.5,1.5S25.2,35.1,24.3,35.1z"></path>
				                        <path class="st0" d="M93.9,4.5C87.8,2.8,73.7,0,48.6,0C23.6,0,9.5,2.8,3.3,4.5C1,5.2-0.4,7.5,0.1,9.9l2.7,13c0,0,0,0.1,0,0.1
				                          c0.7,2.1,2.6,3.5,4.8,3.5c0.2,0,0.4-0.1,0.6-0.2l1.4-1c1.4-1,3-1.7,4.7-2.1c-2.7,2.6-4.3,6.3-4.3,10.3c0,1.7,0.3,3.3,0.8,4.8H6.2
				                          c-0.6,0-1,0.4-1,1s0.4,1,1,1h5.5c2.4,4.6,7.3,7.7,12.8,7.7s10.4-3.1,12.8-7.7h0.3c1.9,0,3.5,1.3,3.8,3.2l1.2,6.4
				                          c-1.2,0.1-3.1,0.5-4.3,1.7c-8.4-1-18-0.8-27.1,0.5c-1.6-1.7-4.7-2.2-4.9-2.2c0,0,0,0-0.1,0c0,0,0,0-0.1,0c0,0-0.1,0-0.1,0
				                          c0,0,0,0,0,0c0,0-0.1,0-0.1,0.1c0,0,0,0,0,0c-1.2,1.2-1.8,3.6-2,4.9c-0.4,0.1-0.6,0.5-0.6,0.9c0,0.6,0.4,1,1,1h39.4
				                          c0.6,0,1-0.4,1-1v-5.5c0,0,0-0.1,0-0.1c0,0,0-0.1,0-0.1l-1.3-7c-0.5-2.6-2.6-4.5-5.2-4.8c0.5-1.5,0.9-3.2,0.9-4.9
				                          c0-4.2-1.8-7.9-4.6-10.6H51c3.3,0,6.1,0.9,7.9,1.7c2.9,1.2,6.1,1.8,9.4,1.8h21.3c2.2,0,4.2-1.4,4.8-3.5c0,0,0-0.1,0-0.1l2.7-13
				                          C97.6,7.5,96.2,5.2,93.9,4.5z M38.9,52.4c1-1,2.7-1.3,3.7-1.4v3.9h-3.7V52.4z M37.9,52.6v2.3H10.6c0.2-1,0.5-1.5,0.6-1.8
				                          C20.2,51.8,29.6,51.7,37.9,52.6z M10.3,52.7c-0.2,0.4-0.5,1.1-0.7,2.2H4.9c0.2-1.1,0.7-2.9,1.5-3.9C7.1,51.1,9.2,51.6,10.3,52.7z
				                           M37,33.6c0,6.9-5.6,12.5-12.5,12.5S12,40.5,12,33.6c0-6.9,5.6-12.5,12.5-12.5S37,26.7,37,33.6z M95.2,9.4l-2.7,12.9
				                          c-0.4,1.3-1.6,2.1-2.9,2.1H68.4c-3.1,0-6-0.6-8.6-1.7C57.7,22,54.6,21,51,21H31.7c-2.1-1.2-4.6-1.9-7.2-1.9s-5.1,0.7-7.2,1.9h-0.7
				                          c-2.9,0-5.8,1-8.1,2.7l-1.1,0.8c-1.2-0.1-2.2-0.9-2.6-2.1l-2.7-13c-0.3-1.3,0.5-2.6,1.8-3C9.9,4.8,23.8,2,48.6,2
				                          c24.8,0,38.7,2.8,44.8,4.5C94.7,6.8,95.5,8.1,95.2,9.4z"></path>
				                        <path class="st0" d="M56.6,4.5H40.7c-1,0-1.7,0.8-1.7,1.7v1.5c0,1,0.8,1.7,1.7,1.7h15.9c1,0,1.7-0.8,1.7-1.7V6.2
				                          C58.3,5.3,57.5,4.5,56.6,4.5z M57.3,7.8c0,0.4-0.3,0.7-0.7,0.7H40.7c-0.4,0-0.7-0.3-0.7-0.7V6.2c0-0.4,0.3-0.7,0.7-0.7h15.9
				                          c0.4,0,0.7,0.3,0.7,0.7V7.8z"></path>
				                        <path class="st0" d="M54.6,34.1c0.3,0,0.5-0.2,0.5-0.5v-5.8c0-0.3-0.2-0.5-0.5-0.5h-9.9c-0.3,0-0.5,0.2-0.5,0.5v5.8
				                          c0,0.3,0.2,0.5,0.5,0.5H54.6z M45.2,28.3h8.9v4.8h-8.9V28.3z"></path>
				                        <path class="st0" d="M46.1,39.5c1.1,0,1.9-0.9,1.9-1.9s-0.9-1.9-1.9-1.9s-1.9,0.9-1.9,1.9S45,39.5,46.1,39.5z M46.1,36.7
				                          c0.5,0,0.9,0.4,0.9,0.9s-0.4,0.9-0.9,0.9s-0.9-0.4-0.9-0.9S45.6,36.7,46.1,36.7z"></path>
				                        <path class="st0" d="M53.2,35.7c-1.1,0-1.9,0.9-1.9,1.9s0.9,1.9,1.9,1.9s1.9-0.9,1.9-1.9S54.2,35.7,53.2,35.7z M53.2,38.5
				                          c-0.5,0-0.9-0.4-0.9-0.9s0.4-0.9,0.9-0.9s0.9,0.4,0.9,0.9S53.7,38.5,53.2,38.5z"></path>
				                        <path class="st0" d="M57.1,33.6v-5.8c0-0.3-0.2-0.5-0.5-0.5s-0.5,0.2-0.5,0.5v5.8c0,0.3,0.2,0.5,0.5,0.5S57.1,33.9,57.1,33.6z"></path>
				                        <path class="st0" d="M42.2,27.8v5.8c0,0.3,0.2,0.5,0.5,0.5s0.5-0.2,0.5-0.5v-5.8c0-0.3-0.2-0.5-0.5-0.5S42.2,27.5,42.2,27.8z"></path>
				                        <path class="st0" d="M92.6,34.6v-3.8c0-0.3-0.2-0.5-0.5-0.5s-0.5,0.2-0.5,0.5v3.8c0,0.3,0.2,0.5,0.5,0.5S92.6,34.9,92.6,34.6z"></path>
				                        <path class="st0" d="M5.7,34.6v-3.8c0-0.3-0.2-0.5-0.5-0.5s-0.5,0.2-0.5,0.5v3.8c0,0.3,0.2,0.5,0.5,0.5S5.7,34.9,5.7,34.6z"></path>
				                        <path class="st0" d="M71.7,33.1h-3.6c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h3.6c0.3,0,0.5-0.2,0.5-0.5S72,33.1,71.7,33.1z"></path>
				                        <path class="st0" d="M51.1,51.2c-0.1-0.2-0.3-0.3-0.5-0.3h-0.5V50c1.1-0.2,1.9-1.2,1.9-2.3c0-1.3-1.1-2.4-2.4-2.4s-2.4,1.1-2.4,2.4
				                          c0,1.1,0.8,2.1,1.9,2.3v0.9h-0.5c-0.2,0-0.4,0.1-0.5,0.3l-1,2.5c-0.1,0.2,0,0.3,0.1,0.5c0.1,0.1,0.2,0.2,0.4,0.2h4.1
				                          c0.2,0,0.3-0.1,0.4-0.2c0.1-0.1,0.1-0.3,0.1-0.5L51.1,51.2z M48.2,47.7c0-0.8,0.6-1.4,1.4-1.4c0.8,0,1.4,0.6,1.4,1.4
				                          c0,0.8-0.6,1.4-1.4,1.4C48.9,49.1,48.2,48.5,48.2,47.7z M48.3,53.4l0.6-1.5h1.4l0.6,1.5H48.3z"></path>
				                        <path class="st0" d="M53.2,41.4h-7.1c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h7.1c0.3,0,0.5-0.2,0.5-0.5S53.4,41.4,53.2,41.4z"></path>
				                        <path class="st0" d="M95.4,54.9c-0.2-1.3-0.8-3.7-2-4.9c0,0,0,0,0,0c0,0-0.1-0.1-0.1-0.1c0,0,0,0,0,0c0,0-0.1,0-0.1,0
				                          c0,0,0,0-0.1,0c0,0,0,0-0.1,0c-0.1,0-3.3,0.5-4.9,2.2C79,50.8,69.4,50.7,61,51.6c-1.3-1.2-3.1-1.6-4.3-1.7l1.2-6.4
				                          c0.3-1.8,1.9-3.2,3.8-3.2h30.4c0.6,0,1-0.4,1-1s-0.4-1-1-1h-4.8v-6.1c0-1.1-0.9-2.1-2.1-2.1H67.1c-1.1,0-2.1,0.9-2.1,2.1v6.1h-3.4
				                          c-2.8,0-5.3,2-5.8,4.8l-1.3,7c0,0,0,0.1,0,0.1c0,0,0,0.1,0,0.1v5.5c0,0.6,0.4,1,1,1H95c0.6,0,1-0.4,1-1
				                          C96,55.5,95.8,55.1,95.4,54.9z M66.1,32.3c0-0.6,0.5-1.1,1.1-1.1h18.1c0.6,0,1.1,0.5,1.1,1.1v6.1H66.1V32.3z M92.8,50.9
				                          c0.8,1,1.3,2.8,1.5,3.9h-4.7c-0.2-1.1-0.5-1.8-0.7-2.2C90.1,51.6,92.1,51.1,92.8,50.9z M88,53.1c0.1,0.2,0.4,0.8,0.6,1.8H61.3v-2.3
				                          C69.6,51.7,79.1,51.8,88,53.1z M56.6,50.9c1,0.1,2.7,0.4,3.7,1.4v2.5h-3.7V50.9z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[9][url]" value="<?php if(!empty($vehicle_image_gallery[9]['url'])) { echo esc_attr($vehicle_image_gallery[9]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[9][id]" value="<?php if(!empty($vehicle_image_gallery[9]['id'])) { echo esc_attr($vehicle_image_gallery[9]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[10]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[10]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[10]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[10]['url'])) { echo esc_attr($vehicle_image_gallery[10]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 101.6 55.9" style="enable-background:new 0 0 101.6 55.9;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M28.7,40.9c-1.1,0-1.9,0.9-1.9,1.9s0.9,1.9,1.9,1.9s1.9-0.9,1.9-1.9S29.8,40.9,28.7,40.9z M28.7,43.7
				                          c-0.5,0-0.9-0.4-0.9-0.9s0.4-0.9,0.9-0.9s0.9,0.4,0.9,0.9S29.2,43.7,28.7,43.7z"></path>
				                        <path class="st0" d="M72.2,40.9c-1.1,0-1.9,0.9-1.9,1.9s0.9,1.9,1.9,1.9s1.9-0.9,1.9-1.9S73.2,40.9,72.2,40.9z M72.2,43.7
				                          c-0.5,0-0.9-0.4-0.9-0.9s0.4-0.9,0.9-0.9s0.9,0.4,0.9,0.9S72.7,43.7,72.2,43.7z"></path>
				                        <path class="st0" d="M60.4,0H41.1C16.5,0,0,16.1,0,40c0,8.7,7.1,15.9,15.9,15.9h69.8c8.7,0,15.9-7.1,15.9-15.9
				                          C101.6,16.1,85,0,60.4,0z M85.7,53.9H15.9C8.2,53.9,2,47.7,2,40C2,16.9,17.4,2,41.1,2h19.3c23.8,0,39.1,14.9,39.1,38
				                          C99.6,47.7,93.3,53.9,85.7,53.9z"></path>
				                        <path class="st0" d="M29.4,10C18.7,10,10,18.7,10,29.4s8.7,19.4,19.4,19.4s19.4-8.7,19.4-19.4S40.1,10,29.4,10z M35.4,45.7
				                          c-1.9,0.7-3.9,1.1-6,1.1c-4.8,0-9.1-1.9-12.3-5.1c-2.1-2.6-3.3-5.8-3.3-9.3c0-8.2,6.7-14.9,14.9-14.9s14.9,6.7,14.9,14.9
				                          C43.6,38.2,40.2,43.3,35.4,45.7z M41.4,41.9c2-2.7,3.2-6,3.2-9.5c0-8.8-7.1-15.9-15.9-15.9s-15.9,7.1-15.9,15.9
				                          c0,1.1,0.1,2.2,0.3,3.2c-0.7-1.9-1.2-4-1.2-6.2C12,19.8,19.8,12,29.4,12s17.4,7.8,17.4,17.4C46.8,34.3,44.7,38.8,41.4,41.9z"></path>
				                        <path class="st0" d="M72.2,10c-10.7,0-19.4,8.7-19.4,19.4s8.7,19.4,19.4,19.4s19.4-8.7,19.4-19.4S82.9,10,72.2,10z M81,44.3
				                          c-2.6,1.6-5.6,2.5-8.9,2.5s-6.3-0.9-8.9-2.5c-3.6-2.7-6-7-6-11.9c0-8.2,6.7-14.9,14.9-14.9s14.9,6.7,14.9,14.9
				                          C87.1,37.3,84.7,41.6,81,44.3z M86.5,39.2c1-2.1,1.6-4.4,1.6-6.8c0-8.8-7.1-15.9-15.9-15.9s-15.9,7.1-15.9,15.9
				                          c0,2.5,0.6,4.8,1.6,6.8c-1.9-2.8-3.1-6.2-3.1-9.8c0-9.6,7.8-17.4,17.4-17.4s17.4,7.8,17.4,17.4C89.5,33,88.4,36.4,86.5,39.2z"></path>
				                        <path class="st0" d="M26.9,31.9c0,0.1-0.1,0.3-0.1,0.4c0,1.1,0.9,1.9,1.9,1.9s1.9-0.9,1.9-1.9s-0.9-1.9-1.9-1.9
				                          c-0.2,0-0.3,0-0.4,0.1l-4.1-4.1c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4L26.9,31.9z"></path>
				                        <path class="st0" d="M70.8,31c-0.7,0.7-0.7,2,0,2.7c0.4,0.4,0.9,0.6,1.4,0.6s1-0.2,1.4-0.6c0.7-0.7,0.7-2,0-2.7
				                          c-0.1-0.1-0.2-0.2-0.4-0.3l0-5.7c0-0.6-0.4-1-1-1c0,0,0,0,0,0c-0.6,0-1,0.4-1,1l0,5.7C71,30.8,70.9,30.9,70.8,31z"></path>
				                        <path class="st0" d="M18.6,27.4L17.5,27c-0.3-0.1-0.5,0-0.6,0.3c-0.1,0.3,0,0.5,0.3,0.6l1.1,0.4c0.1,0,0.1,0,0.2,0
				                          c0.2,0,0.4-0.1,0.5-0.3C19,27.8,18.9,27.5,18.6,27.4z"></path>
				                        <path class="st0" d="M17.9,30.9l-1.2,0c-0.3,0-0.5,0.2-0.5,0.5c0,0.3,0.2,0.5,0.5,0.5l1.2,0c0,0,0,0,0,0c0.3,0,0.5-0.2,0.5-0.5
				                          C18.4,31.2,18.2,30.9,17.9,30.9z"></path>
				                        <path class="st0" d="M19.2,24c-0.2-0.2-0.5-0.1-0.7,0.1c-0.2,0.2-0.1,0.5,0.1,0.7l0.9,0.7c0.1,0.1,0.2,0.1,0.3,0.1
				                          c0.2,0,0.3-0.1,0.4-0.2c0.2-0.2,0.1-0.5-0.1-0.7L19.2,24z"></path>
				                        <path class="st0" d="M24.1,21.7c0.1,0.2,0.3,0.3,0.5,0.3c0.1,0,0.1,0,0.2,0c0.3-0.1,0.4-0.4,0.3-0.7l-0.5-1.1
				                          c-0.1-0.3-0.4-0.4-0.7-0.3c-0.3,0.1-0.4,0.4-0.3,0.7L24.1,21.7z"></path>
				                        <path class="st0" d="M27.4,21.3C27.4,21.3,27.4,21.3,27.4,21.3c0.3,0,0.5-0.3,0.5-0.6l-0.2-1.1c0-0.3-0.3-0.5-0.6-0.4
				                          c-0.3,0-0.5,0.3-0.4,0.6l0.2,1.1C26.9,21.1,27.1,21.3,27.4,21.3z"></path>
				                        <path class="st0" d="M30.3,21.2C30.3,21.2,30.3,21.2,30.3,21.2c0.3,0,0.5-0.2,0.6-0.4l0.1-1.1c0-0.3-0.2-0.5-0.4-0.6
				                          c-0.3,0-0.5,0.2-0.6,0.4l-0.1,1.1C29.8,20.9,30,21.2,30.3,21.2z"></path>
				                        <path class="st0" d="M35.8,23.3c0.2,0,0.3-0.1,0.4-0.2l0.7-0.9c0.2-0.2,0.1-0.5-0.1-0.7c-0.2-0.2-0.5-0.1-0.7,0.1l-0.7,0.9
				                          c-0.2,0.2-0.1,0.5,0.1,0.7C35.6,23.2,35.7,23.3,35.8,23.3z"></path>
				                        <path class="st0" d="M37.9,25.3c0.1,0,0.2,0,0.3-0.1l0.9-0.7c0.2-0.2,0.3-0.5,0.1-0.7c-0.2-0.2-0.5-0.3-0.7-0.1l-0.9,0.7
				                          c-0.2,0.2-0.3,0.5-0.1,0.7C37.6,25.3,37.8,25.3,37.9,25.3z"></path>
				                        <path class="st0" d="M39,27.8c0.1,0.2,0.3,0.3,0.5,0.3c0.1,0,0.1,0,0.2,0l1.1-0.4c0.3-0.1,0.4-0.4,0.3-0.7
				                          c-0.1-0.3-0.4-0.4-0.7-0.3l-1.1,0.4C39,27.2,38.9,27.5,39,27.8z"></path>
				                        <path class="st0" d="M22.8,22.3L22,21.4c-0.3-0.4-1-0.5-1.4-0.2c-0.4,0.3-0.5,1-0.2,1.4l0.7,0.9c0.2,0.2,0.5,0.4,0.8,0.4
				                          c0.2,0,0.4-0.1,0.6-0.2C23,23.4,23.1,22.7,22.8,22.3z"></path>
				                        <path class="st0" d="M32.8,22.3c0.1,0,0.2,0.1,0.4,0.1c0.4,0,0.8-0.2,0.9-0.6l0.4-1.1c0.2-0.5,0-1.1-0.6-1.3
				                          c-0.5-0.2-1.1,0-1.3,0.6L32.3,21C32.1,21.5,32.3,22.1,32.8,22.3z"></path>
				                        <path class="st0" d="M41.2,30L40,30c-0.6,0-1,0.5-0.9,1.1c0,0.5,0.5,0.9,1,0.9c0,0,0,0,0.1,0l1.2-0.1c0.6,0,1-0.5,0.9-1.1
				                          C42.2,30.3,41.7,29.9,41.2,30z"></path>
				                        <path class="st0" d="M41.2,33.7l-1.1-0.1c-0.3,0-0.5,0.2-0.6,0.4c0,0.3,0.2,0.5,0.4,0.6l1.1,0.1c0,0,0,0,0.1,0
				                          c0.2,0,0.5-0.2,0.5-0.4C41.7,34,41.5,33.7,41.2,33.7z"></path>
				                        <path class="st0" d="M38.3,39.1c-0.2-0.2-0.5-0.1-0.7,0.1c-0.2,0.2-0.1,0.5,0.1,0.7l0.9,0.7c0.1,0.1,0.2,0.1,0.3,0.1
				                          c0.2,0,0.3-0.1,0.4-0.2c0.2-0.2,0.1-0.5-0.1-0.7L38.3,39.1z"></path>
				                        <path class="st0" d="M36.7,41c-0.3-0.4-1-0.5-1.4-0.2c-0.4,0.3-0.5,1-0.2,1.4l0.7,0.9c0.2,0.3,0.5,0.4,0.8,0.4
				                          c0.2,0,0.4-0.1,0.6-0.2c0.4-0.3,0.5-1,0.2-1.4L36.7,41z"></path>
				                        <path class="st0" d="M40.6,36.9l-1.1-0.4c-0.3-0.1-0.5,0-0.7,0.3c-0.1,0.3,0,0.5,0.3,0.7l1.1,0.4c0.1,0,0.1,0,0.2,0
				                          c0.2,0,0.4-0.1,0.5-0.3C41,37.3,40.9,37,40.6,36.9z"></path>
				                        <path class="st0" d="M61.8,27.4L60.7,27c-0.3-0.1-0.5,0-0.6,0.3c-0.1,0.3,0,0.5,0.3,0.6l1.1,0.4c0.1,0,0.1,0,0.2,0
				                          c0.2,0,0.4-0.1,0.5-0.3C62.2,27.8,62.1,27.5,61.8,27.4z"></path>
				                        <path class="st0" d="M61.1,30.9l-1.2,0c-0.3,0-0.5,0.2-0.5,0.5c0,0.3,0.2,0.5,0.5,0.5l1.2,0c0,0,0,0,0,0c0.3,0,0.5-0.2,0.5-0.5
				                          C61.5,31.2,61.3,30.9,61.1,30.9z"></path>
				                        <path class="st0" d="M62.4,24c-0.2-0.2-0.5-0.1-0.7,0.1c-0.2,0.2-0.1,0.5,0.1,0.7l0.9,0.7c0.1,0.1,0.2,0.1,0.3,0.1
				                          c0.2,0,0.3-0.1,0.4-0.2c0.2-0.2,0.1-0.5-0.1-0.7L62.4,24z"></path>
				                        <path class="st0" d="M67.7,20.2C67.6,20,67.3,19.9,67,20c-0.3,0.1-0.4,0.4-0.3,0.7l0.5,1.1c0.1,0.2,0.3,0.3,0.5,0.3
				                          c0.1,0,0.1,0,0.2,0c0.3-0.1,0.4-0.4,0.3-0.7L67.7,20.2z"></path>
				                        <path class="st0" d="M70.6,21.3c0.3,0,0.5-0.3,0.4-0.6l-0.2-1.1c0-0.3-0.3-0.5-0.6-0.4c-0.3,0-0.5,0.3-0.4,0.6l0.2,1.1
				                          C70.1,21.1,70.3,21.3,70.6,21.3C70.6,21.3,70.6,21.3,70.6,21.3z"></path>
				                        <path class="st0" d="M73.7,19.1c-0.3,0-0.5,0.2-0.6,0.4L73,20.7c0,0.3,0.2,0.5,0.4,0.6c0,0,0,0,0.1,0c0.2,0,0.5-0.2,0.5-0.4
				                          l0.1-1.1C74.2,19.4,74,19.1,73.7,19.1z"></path>
				                        <path class="st0" d="M79,23.3c0.2,0,0.3-0.1,0.4-0.2l0.7-0.9c0.2-0.2,0.1-0.5-0.1-0.7c-0.2-0.2-0.5-0.1-0.7,0.1l-0.7,0.9
				                          c-0.2,0.2-0.1,0.5,0.1,0.7C78.8,23.2,78.9,23.3,79,23.3z"></path>
				                        <path class="st0" d="M81.1,25.3c0.1,0,0.2,0,0.3-0.1l0.9-0.7c0.2-0.2,0.3-0.5,0.1-0.7c-0.2-0.2-0.5-0.3-0.7-0.1l-0.9,0.7
				                          c-0.2,0.2-0.3,0.5-0.1,0.7C80.8,25.3,81,25.3,81.1,25.3z"></path>
				                        <path class="st0" d="M82.1,27.8c0.1,0.2,0.3,0.3,0.5,0.3c0.1,0,0.1,0,0.2,0l1.1-0.4c0.3-0.1,0.4-0.4,0.3-0.7
				                          c-0.1-0.3-0.4-0.4-0.7-0.3l-1.1,0.4C82.2,27.2,82,27.5,82.1,27.8z"></path>
				                        <path class="st0" d="M64.8,21.7c-0.2-0.2-0.5-0.3-0.7-0.1c-0.2,0.2-0.3,0.5-0.1,0.7l0.7,0.9c0.1,0.1,0.2,0.2,0.4,0.2
				                          c0.1,0,0.2,0,0.3-0.1c0.2-0.2,0.3-0.5,0.1-0.7L64.8,21.7z"></path>
				                        <path class="st0" d="M77,19.9c-0.3-0.1-0.5,0-0.7,0.3l-0.4,1.1c-0.1,0.3,0,0.5,0.3,0.7c0.1,0,0.1,0,0.2,0c0.2,0,0.4-0.1,0.5-0.3
				                          l0.4-1.1C77.4,20.2,77.2,20,77,19.9z"></path>
				                        <path class="st0" d="M82.8,31.1c0,0.3,0.2,0.5,0.5,0.5c0,0,0,0,0,0l1.2-0.1c0.3,0,0.5-0.3,0.5-0.5s-0.3-0.5-0.5-0.5l-1.2,0.1
				                          C83,30.6,82.8,30.8,82.8,31.1z"></path>
				                        <path class="st0" d="M84.4,33.7l-1.1-0.1c-0.3,0-0.5,0.2-0.6,0.4c0,0.3,0.2,0.5,0.4,0.6l1.1,0.1c0,0,0,0,0.1,0
				                          c0.2,0,0.5-0.2,0.5-0.4C84.9,34,84.7,33.7,84.4,33.7z"></path>
				                        <path class="st0" d="M81.5,39.1c-0.2-0.2-0.5-0.1-0.7,0.1c-0.2,0.2-0.1,0.5,0.1,0.7l0.9,0.7c0.1,0.1,0.2,0.1,0.3,0.1
				                          c0.2,0,0.3-0.1,0.4-0.2c0.2-0.2,0.1-0.5-0.1-0.7L81.5,39.1z"></path>
				                        <path class="st0" d="M79.5,41.3c-0.2-0.2-0.5-0.3-0.7-0.1c-0.2,0.2-0.3,0.5-0.1,0.7l0.7,0.9c0.1,0.1,0.2,0.2,0.4,0.2
				                          c0.1,0,0.2,0,0.3-0.1c0.2-0.2,0.3-0.5,0.1-0.7L79.5,41.3z"></path>
				                        <path class="st0" d="M83.8,36.9l-1.1-0.4c-0.3-0.1-0.5,0-0.7,0.3c-0.1,0.3,0,0.5,0.3,0.7l1.1,0.4c0.1,0,0.1,0,0.2,0
				                          c0.2,0,0.4-0.1,0.5-0.3C84.2,37.3,84.1,37,83.8,36.9z"></path>
				                        <path class="st0" d="M34.4,35.5h-3.6H23c-0.3,0-0.5,0.2-0.5,0.5v3.2c0,0.3,0.2,0.5,0.5,0.5h7.7h3.6c0.3,0,0.5-0.2,0.5-0.5V36
				                          C34.9,35.7,34.7,35.5,34.4,35.5z M23.5,36.5h6.7v2.2h-6.7V36.5z M33.9,38.7h-2.6v-2.2h2.6V38.7z"></path>
				                        <path class="st0" d="M51.2,42c-0.2-0.3-0.6-0.3-0.8,0L47,47.2c-0.1,0.2-0.1,0.4,0,0.5c0.1,0.2,0.3,0.3,0.4,0.3h6.8
				                          c0.2,0,0.4-0.1,0.4-0.3c0.1-0.2,0.1-0.4,0-0.5L51.2,42z M48.3,46.9l2.5-3.7l2.5,3.7H48.3z"></path>
				                        <path class="st0" d="M50.6,13.1c1.2,0,2.1-1,2.1-2.1c0-1.2-1-2.1-2.1-2.1c-1.2,0-2.1,1-2.1,2.1C48.4,12.2,49.4,13.1,50.6,13.1z
				                           M50.6,9.9c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1S49.9,9.9,50.6,9.9z"></path>
				                        <path class="st0" d="M55.4,13.1c1.2,0,2.1-1,2.1-2.1c0-1.2-1-2.1-2.1-2.1c-1.2,0-2.1,1-2.1,2.1C53.3,12.2,54.2,13.1,55.4,13.1z
				                           M55.4,9.9c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1S54.8,9.9,55.4,9.9z"></path>
				                        <path class="st0" d="M45.7,13.1c1.2,0,2.1-1,2.1-2.1c0-1.2-1-2.1-2.1-2.1s-2.1,1-2.1,2.1C43.6,12.2,44.6,13.1,45.7,13.1z M45.7,9.9
				                          c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1S45.1,9.9,45.7,9.9z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[10][url]" value="<?php if(!empty($vehicle_image_gallery[10]['url'])) { echo esc_attr($vehicle_image_gallery[10]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[10][id]" value="<?php if(!empty($vehicle_image_gallery[10]['id'])) { echo esc_attr($vehicle_image_gallery[10]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[11]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[11]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[11]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[11]['url'])) { echo esc_attr($vehicle_image_gallery[11]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 53.9 53.9" style="enable-background:new 0 0 53.9 53.9;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M31,27c0-2.2-1.8-4-4-4c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4C29.2,31,31,29.2,31,27z M25,27c0-1.1,0.9-2,2-2
				                          s2,0.9,2,2s-0.9,2-2,2S25,28.1,25,27z"></path>
				                        <path class="st0" d="M27,0C12.1,0,0,12.1,0,27s12.1,27,27,27s27-12.1,27-27S41.8,0,27,0z M27,51.9c-13.8,0-25-11.2-25-25
				                          S13.2,2,27,2s25,11.2,25,25S40.7,51.9,27,51.9z"></path>
				                        <path class="st0" d="M27,6.7C15.8,6.7,6.7,15.8,6.7,27S15.8,47.2,27,47.2S47.2,38.1,47.2,27S38.1,6.7,27,6.7z M45.2,28
				                          c-0.8-0.2-1.7-0.4-2.6-0.6c0-0.1,0-0.3,0-0.4c0-3.2-1-6.3-2.9-9c0.6-0.8,1.2-1.6,1.7-2.2c2.4,3.1,3.8,7,3.8,11.2
				                          C45.2,27.3,45.2,27.6,45.2,28z M39.1,18.8c1.6,2.4,2.5,5.2,2.5,8.2c0,0.1,0,0.2,0,0.3c-1.2-0.2-2.4-0.4-3.3-0.4
				                          c-0.4,0-1-0.7-1.7-2.3c-0.5-1.3-0.5-2.2-0.2-2.6C37.2,21.1,38.1,20,39.1,18.8z M32.5,9.6c-0.4,0.7-0.8,1.6-1.3,2.4
				                          c-2.8-0.8-5.8-0.8-8.5,0c-0.4-0.8-0.9-1.7-1.3-2.4C23.2,9,25,8.7,27,8.7C28.9,8.7,30.8,9,32.5,9.6z M30.8,12.9
				                          c-0.6,1.2-1.1,2.4-1.5,3.2C29.1,16.6,28.2,17,27,17c-1.2,0-2.1-0.4-2.3-0.8c-0.3-0.9-0.9-2-1.5-3.2C25.7,12.2,28.3,12.2,30.8,12.9z
				                           M12.8,15.4c0.5,0.7,1.1,1.4,1.7,2.1c-2,2.6-3.1,5.6-3.2,8.9c-0.9,0.2-1.9,0.4-2.7,0.6c0,0,0,0,0,0C8.7,22.6,10.3,18.5,12.8,15.4z
				                           M17.5,20.7c0.4,0.4,0.3,1.4-0.1,2.6c-0.6,1.6-1.2,2.3-1.6,2.3c-0.9,0.1-2.2,0.3-3.4,0.5c0.2-2.9,1.1-5.6,2.9-7.9
				                          C16.1,19.2,16.9,20.1,17.5,20.7z M11.6,36.8c0.8-0.4,1.6-0.8,2.4-1.2c1.4,2.1,3.3,3.8,5.4,5c-0.1,1-0.3,1.9-0.4,2.8
				                          C16,41.9,13.4,39.6,11.6,36.8z M20.1,37c-0.2,0.7-0.4,1.6-0.5,2.6c-1.9-1.1-3.5-2.6-4.7-4.4c0.5-0.3,1-0.6,1.5-0.9
				                          c0.5-0.3,1.4,0,2.4,0.7C19.7,35.6,20.3,36.4,20.1,37z M20,43.8c0.1-1.1,0.3-2.3,0.5-3.4c0,0,0,0,0,0c0.2-1.2,0.4-2.3,0.6-3.2
				                          c0.2-1-0.5-2.1-1.8-3.1c-1.3-0.9-2.6-1.2-3.5-0.7c-1.4,0.9-3,1.7-4.8,2.5c-1.3-2.4-2.2-5.1-2.3-7.9c2.2-0.6,5.4-1.2,7.2-1.3
				                          c0.9-0.1,1.7-1.1,2.4-3c0.6-1.7,0.5-3-0.1-3.7c-1.3-1.3-3.4-3.6-4.7-5.4c1.9-2.1,4.3-3.7,7-4.7c1.1,2,2.6,4.9,3.3,6.6
				                          c0.4,0.9,1.6,1.4,3.2,1.5c1.6,0,2.8-0.6,3.2-1.5c0.7-1.7,2.1-4.6,3.2-6.6c2.8,1.1,5.3,2.8,7.3,5.1c-1.2,1.7-3.6,4.8-5,6.2
				                          c-0.7,0.7-0.7,2-0.1,3.7c0.7,1.8,1.5,2.8,2.5,2.9c1.9,0.1,4.9,0.7,6.9,1.2c-0.4,3.4-1.7,6.5-3.6,9c-1.8-1-3.6-2.4-5-3.5
				                          c-0.7-0.6-2-0.4-3.8,0.4c-1.6,0.8-2.5,1.7-2.5,2.7c0,1.9-0.2,5.2-0.4,7.4c-0.9,0.1-1.8,0.2-2.7,0.2C24.5,45.2,22.2,44.7,20,43.8z
				                           M37.7,36.8c-0.8,0.9-1.6,1.6-2.6,2.3c-1.3,0.9-2.6,1.5-4.1,1.9c0.1-1.3,0.1-2.5,0.1-3.3c0-0.6,0.7-1.2,1.9-1.8
				                          c1.6-0.7,2.5-0.7,2.8-0.5C36.4,35.8,37.1,36.3,37.7,36.8z M30.7,44.8C30.8,44,30.9,43,31,42c1.7-0.4,3.3-1.2,4.7-2.1
				                          c1.1-0.7,2-1.6,2.9-2.5c0.7,0.5,1.5,1,2.3,1.5C38.3,41.8,34.7,44,30.7,44.8z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[11][url]" value="<?php if(!empty($vehicle_image_gallery[11]['url'])) { echo esc_attr($vehicle_image_gallery[11]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[11][id]" value="<?php if(!empty($vehicle_image_gallery[11]['id'])) { echo esc_attr($vehicle_image_gallery[11]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[12]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[12]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[12]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[12]['url'])) { echo esc_attr($vehicle_image_gallery[12]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 85.7 63.4" style="enable-background:new 0 0 85.7 63.4;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M39.1,17c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h2L40,19.8h-7.8c-0.6,0-1,0.4-1,1s0.4,1,1,1h11.7
				                          c0.6,0,1-0.4,1-1s-0.4-1-1-1h-0.2l1.8-2.8H39.1z M42.4,18h1.3l-1.2,1.8h-1.3L42.4,18z"></path>
				                        <path class="st0" d="M84.6,12.2c-0.1,0-14.6,1.8-27.3-1c-0.3-0.2-0.7-0.3-1-0.4c-1.9-0.9-3.9-2-6.1-3.3C44,4,37,0,28.8,0H2.7
				                          c-0.6,0-1,0.4-1,1s0.4,1,1,1h14.9v3.7c0,0,0,0-0.1,0c-1.7,0-3.3,0.8-4.2,2.2C12,7,10.4,6.6,8.8,6.6C3.9,6.6,0,10.5,0,15.3
				                          c0,3,1.5,5.6,3.8,7.2L20,58.7c1.3,2.9,4.2,4.8,7.3,4.8h22c4.5,0,8.3-3,9.4-7.3c0.2-0.9,0.4-1.8,0.5-2.8c0,0,0-0.1,0-0.1
				                          c0.2-2.2,0-4.5-0.6-6.6c-0.2-0.7-0.4-1.3-0.7-2c4.7-0.2,7.1-1.2,8.2-1.9c5.1,5.4,11.8,11.2,17.4,11.4c0,0,0,0,0.1,0
				                          c0.5,0,1-0.4,1-1c0-0.6-0.4-1-0.9-1c-3.5-0.2-7.7-3-11.6-6.4c-0.4-1.4-0.9-3.9,0.2-7c1.5-4.3,5.3-7.9,11.5-10.9
				                          c0.2,0,0.3-0.1,0.4-0.2c0.5-0.3,0.6-0.9,0.2-1.4c-2.4-3.4-11.1-7.8-20.3-12c3.3,0.3,6.6,0.5,9.5,0.5c6.3,0,10.9-0.6,11.3-0.6
				                          c0.5-0.1,0.9-0.6,0.9-1.1C85.6,12.5,85.1,12.1,84.6,12.2z M18.6,2h10.1c7.7,0,14.5,3.9,20.4,7.3c2.2,1.3,4.3,2.5,6.3,3.3
				                          c0.1,0,0.2,0.1,0.3,0.1l-3.3,0c0-1-0.2-1.8-0.9-2c-0.7-0.2-1.4,0.4-2.3,1.8c-0.1,0.1-0.1,0.2-0.2,0.3l-26.7,0.3
				                          c0.3-0.7,0.5-1.4,0.5-2.2c0-2.6-1.8-4.7-4.2-5.2V2z M50.5,32.1l-0.8-0.9c-1.7-2.2-4.5-3.3-7.1-2.9c-3.8,0.6-8.1,2.6-10,3.5
				                          c1.1-7.7-9.7-15.3-11.8-16.7c0.4-0.3,0.7-0.6,1-1l26.8-0.3c-0.5,1-0.9,2.1-1.3,3.3c-0.6,1.8-0.9,3.5-1,4.8
				                          c-0.1,1.6,0.1,2.5,0.8,2.8c0.1,0,0.2,0,0.3,0c0.6,0,1.3-0.6,2-1.8c0.1-0.2,0.3-0.5,0.4-0.8l2.7,3.1c0.8,0.9,1.2,2.1,1,3.2
				                          c-0.1,1.1-0.7,2.1-1.5,2.8C51.5,31.6,51,31.9,50.5,32.1z M54,41.9c-9.3-0.7-18.2,1.5-21.1,2.4c0-0.4-0.1-0.9-0.2-1.3l0.4-0.2
				                          c5.1-2.3,10.7-3.2,16.3-2.9C51.1,40,52.7,40.8,54,41.9z M28.6,53.3c4.5-1,18.8-3.9,28.8-3c0.1,0.7,0.1,1.5,0,2.2l-3.9,1.4
				                          c-7.2,2.6-15,3.3-22.5,2.1l-2.5-0.4c-0.1-0.7-0.2-1.3-0.3-1.9C28.3,53.6,28.4,53.5,28.6,53.3z M29.9,52c1.1-1.4,2.4-3.5,3-6.7
				                          c2.8-0.8,12.3-3.3,22-2.3c0.3,0.5,0.7,1,0.9,1.6c0.4,0.9,0.7,1.8,1,2.7c0.2,0.7,0.4,1.3,0.5,2C48.1,48.5,35.6,50.8,29.9,52z
				                           M30.9,45c-0.7,3.6-2.2,5.6-3.3,6.5c-0.8-2.9-2-5.6-3.5-8.2L12.2,23.4c1.7-0.7,3.1-1.9,4-3.4l10,12.9C28.8,36.4,30.6,40.9,30.9,45z
				                           M17.6,16.3c0.8,0,1.6-0.2,2.3-0.6c0,0,0,0,0.1,0.1c0.1,0.1,13.6,8.8,11.5,16.7L29.3,34c-0.5-0.8-1-1.6-1.5-2.3L17.1,18
				                          C17.3,17.5,17.4,16.9,17.6,16.3C17.5,16.3,17.5,16.3,17.6,16.3z M32.2,33.2c0.3-0.2,5.9-3.2,10.6-3.9c2.3-0.4,4.7,0.6,6.2,2.5
				                          l0.6,0.8c-5.9,2.5-15.8,2.3-19.4,2.1L32.2,33.2z M48.1,17.8l1.4,0.2l-2,2.2C47.6,19.5,47.8,18.7,48.1,17.8z M47.4,23.7
				                          c-0.2-0.1-0.2-0.8-0.2-1.7l2.9-3.2C49,22,47.8,23.7,47.4,23.7z M50.6,17.2l-2.2-0.3c0.4-1.2,0.9-2.2,1.3-3l1.6,0
				                          C51.2,14.7,51,15.8,50.6,17.2z M50.3,12.8c0.4-0.7,0.8-1.1,0.9-1.1c0.1,0.1,0.2,0.5,0.2,1.1L50.3,12.8z M17.6,6.7
				                          c2.4,0,4.3,1.9,4.3,4.3s-1.9,4.3-4.3,4.3c0,0,0,0,0,0c0-2.8-1.4-5.3-3.4-6.9C14.9,7.3,16.2,6.7,17.6,6.7z M2,15.3
				                          c0-3.7,3-6.8,6.8-6.8s6.8,3,6.8,6.8c0,0.9-0.2,1.7-0.5,2.5c0,0,0,0,0,0c-1,1.9-2.2,3.1-3.7,3.8c-0.2,0.1-0.3,0.1-0.5,0.2
				                          c0,0,0,0-0.1,0c-0.2,0.1-0.4,0.1-0.6,0.1c0,0-0.1,0-0.1,0c0,0,0,0,0,0c-2.2,0.4-4.3-0.6-4.8-0.9C3.3,19.9,2,17.8,2,15.3z
				                           M49.4,61.4h-22c-2.4,0-4.5-1.4-5.5-3.6l-15.3-34C7.3,24,8,24.1,8.8,24.1c0.5,0,0.9,0,1.4-0.1l12.2,20.3c2.2,3.7,3.6,7.8,4.2,12.1
				                          c0.1,0.6,0.5,1,1.1,1.1l3,0.5c2.5,0.4,5,0.6,7.5,0.6c5.4,0,10.9-0.9,16-2.8l3-1.1c-0.1,0.3-0.1,0.6-0.2,0.9
				                          C56,59,52.9,61.4,49.4,61.4z M57.6,43.7C57,42.2,56,41,54.8,40c2.6-1.2,4.1-3.3,4.8-4.9c1.2,1.5,3.3,4.1,5.8,6.9
				                          C64.4,42.6,62.1,43.6,57.6,43.7z M61.6,34.4c0.3-0.7,0.8-1.7,1.4-3.4c0.1-0.3,0.3-0.5,0.6-0.6c0.3-0.1,0.6-0.1,0.9,0.1l4.6,2.7
				                          c0.4,0.2,0.6,0.5,0.7,1c0.1,0.4,0,0.8-0.2,1.2c-0.7,1.2-1.5,3.3-1.7,6.4C65.3,38.9,63,36.1,61.6,34.4z M82.7,27.3
				                          c-6,3-9.8,6.8-11.3,11.1c-0.8,2.4-0.8,4.5-0.5,6.1c-0.6-0.6-1.3-1.2-1.9-1.8c-0.1-3.4,0.8-5.7,1.5-6.9c0.3-0.6,0.5-1.3,0.3-1.9
				                          c-0.2-0.7-0.6-1.2-1.2-1.6L65,29.6c-0.5-0.3-1.1-0.4-1.7-0.2c-0.6,0.2-1,0.6-1.2,1.2c-0.4,1-0.8,2.1-1.2,2.9
				                          c-0.5-0.6-0.7-0.9-0.7-1c-0.2-0.3-0.6-0.5-1-0.4c-0.4,0.1-0.7,0.4-0.8,0.8c0,0.2-1.2,4.9-5.8,5.8c-1-0.4-2-0.7-3.1-0.8
				                          c-5.9-0.4-11.9,0.6-17.2,3l0,0c-0.5-1.8-1.2-3.6-2-5.3c1,0.1,2.6,0.1,4.4,0.1c4.8,0,11.6-0.4,16-2.5c0,0,0,0,0,0
				                          c0.7-0.4,1.4-0.8,2-1.2c1.1-0.8,1.8-2.1,1.9-3.5c0.1-1.4-0.3-2.9-1.3-4l-2.9-3.4c0.4-0.8,0.7-1.8,1.1-2.8c0.4-1.3,0.9-3.1,1-4.6
				                          l5.6-0.1c0,0,0.1,0,0.1,0.1C65.1,16.9,79.7,23.4,82.7,27.3z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[12][url]" value="<?php if(!empty($vehicle_image_gallery[12]['url'])) { echo esc_attr($vehicle_image_gallery[12]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[12][id]" value="<?php if(!empty($vehicle_image_gallery[12]['id'])) { echo esc_attr($vehicle_image_gallery[12]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[13]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[13]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[13]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[13]['url'])) { echo esc_attr($vehicle_image_gallery[13]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 96 63.2" style="enable-background:new 0 0 96 63.2;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M95.3,16.9c-4.2-1.7-8.4-4.4-8.5-4.4c-1.1-0.7-2.3-1.5-3.4-2.4C76.9,5.6,68.9,0,58.5,0H34.3
				                          C30.1,0,26,1.2,22.5,3.5l-10,6.6c-0.9,0.6-1.6,1.1-2.5,1.7L6.2,9.9c-0.1,0-0.1,0-0.2-0.1c-1.8-0.5-3.7,0.1-5,1.6
				                          c-1.2,1.5-1.4,3.5-0.6,5.2l14.7,29.1c0.5,0.9,1.4,1.5,2.4,1.5c-0.1,0.9,0.1,1.9,0.7,2.7l4.3,6.3c0.9,1.3,2.1,2.2,3.5,2.6
				                          c3.2,2.4,7.2,3.8,11.3,4l14,0.4c0,0,0,0,0,0c0.1,0,0.3-0.1,0.4-0.2c0.1-0.1,0.1-0.3,0.1-0.4L50,51.2c0-0.1,0.1-0.1,0.1-0.2
				                          c0.5-1.3,0.3-2.6-0.5-3.8l-5.8-8.7c1.4-0.5,2.3-1.9,2.3-3.4V18.3h1.5c0,0,0,0.1,0,0.1c-0.2,1.5,0.2,2.9,1.3,4
				                          c0.2,0.2,0.4,0.3,0.6,0.5v15.9c0,1.5,0.6,3,1.7,4.1l6.5,6.4c0.1,0.1,0.2,0.1,0.4,0.1h2.1c0.3,1,0.8,1.9,1.6,2.7
				                          c0,0,0.1,0.1,0.1,0.1l12.8,9.6c0,0,0,0,0,0l0,0c0,0,0.1,0,0.1,0c0.1,0,0.1,0.1,0.2,0.1c0.1,0,0.1,0,0.2,0c0,0,0.1,0,0.1,0
				                          c0,0,0,0,0,0c0.1,0,0.1,0,0.2,0c0,0,0,0,0,0l2.6-0.7c1.9-0.5,6.4-5.2,6.4-11.8c0-2.8-0.8-5.8-2.3-9c-0.4-0.8-0.7-1.4-1-1.9
				                          c-0.8-1.5-1.2-2.1-1.4-4.5l0-0.2c-0.3-5.3-4-9.9-9.1-11.5c-0.5-0.2-1.1-0.3-1.6-0.4c0.1,0,0.1-0.1,0.2-0.1c1-1,1.6-2.2,1.7-3.5
				                          c0.1,0,0.1,0,0.2,0h22.4c0.3,0.2,0.7,0.3,1,0.4c0.1,0,0.2,0.1,0.4,0.1c0.4,0,0.8-0.2,0.9-0.6C96.1,17.7,95.9,17.1,95.3,16.9z
				                           M17.8,45.2c-0.2,0-0.5,0-0.7-0.4L2.3,15.7c-0.5-1-0.4-2.1,0.3-3c0.5-0.7,1.3-1,2.1-1c0.2,0,0.5,0,0.7,0.1l4.3,2.1c0,0,0,0,0,0l2,1
				                          c0.1,0,0.1,0,0.2,0.1c1.6,0.4,2.9,1.5,3.6,3l6.1,13.3c1,2.1,1,4.5,0,6.6l-3.1,6.8C18.3,45.2,17.9,45.2,17.8,45.2z M50.9,62.2
				                          l-13.4-0.4c-3.2-0.1-6.3-1-9-2.6c0.6,0,1.2-0.1,1.9-0.3l17-5.2c0.7-0.2,1.4-0.6,1.9-1.2L50.9,62.2z M48,48.4c0.4,0.6,0.5,1.3,0.2,2
				                          c-0.2,0.7-0.8,1.2-1.4,1.4l-17,5.2c-2.1,0.6-4.2-0.1-5.5-1.9L20,48.8c-0.2-0.2-0.3-0.5-0.3-0.8c1.6-0.4,6.1-1.5,18.3-4.3
				                          c3.7-0.8,6.4,0.4,8.2,2L48,48.4z M44.8,43.6c-1.8-1-4.2-1.5-7-0.9c-10.9,2.5-15.8,3.6-18,4.2c0,0,0-0.1,0-0.1l3.4-7.6l0.2-0.4
				                          c0,0,0,0,0-0.1l0.1-0.2c1.3-2.4,3.8-3.2,5.7-3.4l5.5-0.6c0.2,0,0.5,0,0.7,0c2.1,0,4,1,5.2,2.8L44.8,43.6z M45.1,35.2
				                          c0,1.2-0.8,2.2-1.9,2.5l-1-1.6c-0.6-0.9-1.3-1.6-2.1-2.2h2c0.3,0,0.5-0.2,0.5-0.5S42.4,33,42.1,33h-4c-1.2-0.4-2.4-0.6-3.7-0.5
				                          L29,33.2c-1.8,0.2-3.3,0.7-4.6,1.6c0-1.5-0.3-2.9-0.9-4.3l-5.6-12.2h27.3V35.2z M45.1,17.3H17.4l-0.1-0.1c-0.9-2-2.7-3.5-4.8-4.1
				                          l-0.5-0.2c0.5-0.3,1-0.7,1.5-1l10-6.6C26.8,3.1,30.4,2,34.3,2h10.9V17.3z M48.6,18.6c0.2-1.1,0.5-2,0.9-2.4c0.4-0.4,1-0.7,1.5-0.9
				                          c0.6,0.2,1.1,0.5,1.5,0.9c1.5,1.5,1.5,4,0,5.5c-0.3,0.3-0.9,0.6-1.6,0.8c-0.5-0.2-0.9-0.4-1.3-0.8C48.8,20.9,48.4,19.7,48.6,18.6z
				                           M52.7,15.1c0.8,0.1,1.7,0.5,2.3,1.1c1.5,1.5,1.5,4,0,5.5c-0.4,0.4-1.1,0.7-2,0.9c0.1,0,0.1-0.1,0.2-0.1c1.9-1.9,1.9-5,0-7
				                          C53.1,15.4,52.9,15.2,52.7,15.1z M51.9,42.1c-0.9-0.9-1.4-2.1-1.4-3.4V23.4c0,0,0,0,0,0c3.5,1.2,5.9,4.4,6.1,8l0.9,16.2L51.9,42.1z
				                           M58.4,48.3l-0.9-17c-0.2-3.2-1.9-6.1-4.4-7.8c0.4-0.1,0.7-0.2,1.1-0.3c1.7,0.6,3.3,1.6,4.4,3.1c0,0.1,0.1,0.1,0.2,0.1l1.2,21.6
				                          c0,0,0,0.1,0,0.1H58.4z M60.4,22.7c-0.3,0.1-0.6,0.2-0.8,0.4c-0.6,0.5-0.9,1.2-1,1.9c-0.9-1-2-1.8-3.2-2.3c0.1-0.1,0.3-0.2,0.4-0.3
				                          c1.1-1.1,1.6-2.7,1.4-4.2h2c0.1,1.3,0.7,2.5,1.6,3.4c0.3,0.3,0.5,0.5,0.8,0.7l-1,0.3C60.5,22.7,60.5,22.7,60.4,22.7z M60.1,17
				                          c0.2-1.5,0.6-2.5,1.2-3.1c0.6-0.6,1.3-1,2-1.2c0.7,0.2,1.4,0.7,2,1.2c2,2,2,5.2,0,7.2c-0.3,0.3-0.7,0.5-1.2,0.7
				                          c-0.3,0-0.7,0.1-1,0.2L63,22c-0.6-0.2-1.1-0.6-1.5-1C60.4,19.9,59.9,18.5,60.1,17z M63,50.5c-0.7-0.6-1.1-1.5-1.1-2.4l-1.3-22.8
				                          c0-0.3,0.2-0.5,0.3-0.6c0,0,0.1-0.1,0.2-0.1l0,0c0.1,0,0.2,0,0.4,0l3.5,1.1c4.3,1.3,7.4,5.2,7.7,9.7l1.4,23.5L63,50.5z M70.1,24.3
				                          c4.3,1.3,7.4,5.2,7.7,9.7l0,0.2c0.3,2.7,0.8,3.7,1.6,5.2c0.3,0.5,0.6,1.1,0.9,1.8c1,2,2.1,5,2.1,8.1c0,5.9-3.9,9.6-4.9,9.9
				                          l-1.4,0.4l-1.4-24.4c-0.3-5.3-4-9.9-9.1-11.5l0,0C67.1,23.6,68.7,23.8,70.1,24.3z M68.6,21.1c-0.2,0.2-0.6,0.5-1,0.6
				                          c-0.5,0-0.9-0.1-1.4-0.1c2.3-2.4,2.2-6.2-0.1-8.5c-0.3-0.3-0.6-0.5-1-0.8c1.3,0,2.6,0.5,3.5,1.5C70.6,15.9,70.6,19.1,68.6,21.1z
				                           M71.2,17.3c0,0-0.1,0-0.1,0c0-1.6-0.7-3-1.8-4.1c-1.2-1.2-2.7-1.8-4.3-1.8c-0.6,0-1.1,0.1-1.7,0.2c-0.1,0-0.2,0-0.2,0.1
				                          c-0.9,0.3-1.7,0.8-2.4,1.5c-0.7,0.7-1.2,1.9-1.5,3.6c0,0.2,0,0.3,0,0.5h-2.2c-0.2-0.7-0.6-1.3-1.1-1.8c-1.3-1.3-3.1-1.7-4.8-1.2
				                          c-0.1,0-0.2,0-0.3,0.1c-0.7,0.2-1.3,0.6-1.9,1.2c-0.4,0.4-0.7,1-0.9,1.8h-1.7V2h12.4c9.7,0,17.5,5.4,23.8,9.8
				                          c1.2,0.8,2.4,1.7,3.5,2.4c0.1,0.1,2.6,1.6,5.6,3.1H71.2z"></path>
				                        <path class="st0" d="M27.6,27.7H40c0.6,0,1-0.4,1-1s-0.4-1-1-1h-0.3l2-3H35c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h2.2l-1.3,2
				                          h-8.3c-0.6,0-1,0.4-1,1S27,27.7,27.6,27.7z M38.4,23.7h1.4l-1.3,2h-1.4L38.4,23.7z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[13][url]" value="<?php if(!empty($vehicle_image_gallery[13]['url'])) { echo esc_attr($vehicle_image_gallery[13]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[13][id]" value="<?php if(!empty($vehicle_image_gallery[13]['id'])) { echo esc_attr($vehicle_image_gallery[13]['id']); } ?>" />

								</div>

							</div>

							<div class="cardojo-col-5">

								<div class="vehicle_gallery_image_holder_<?php if(empty($vehicle_image_gallery[14]['url'])) { echo "no_image"; } else { echo "has_image vehicle_gallery_image_loaded"; } ?>" <?php if(!empty($vehicle_image_gallery[14]['url'])) { ?>style="background-image: url(<?php echo esc_url($vehicle_image_gallery[14]['url']); ?>);"<?php } ?>>

									<img class="image-holder" src="<?php if(!empty($vehicle_image_gallery[14]['url'])) { echo esc_attr($vehicle_image_gallery[14]['url']); } ?>" alt=""/>

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 74 61.8" style="enable-background:new 0 0 74 61.8;" xml:space="preserve">
				                      <g>
				                        <path class="st0" d="M71.1,28c-1.5-3.3-5-10.4-8-12.5l6.8-8.1c0.7-0.9,0.7-2.1,0.2-3.2c-0.5-1-1.5-1.6-2.6-1.6
				                          C66.4,2.3,57.4,0,38.8,0C20.2,0,8.3,2.4,7.1,2.6C6,2.7,5,3.3,4.5,4.2C4,5.2,4,6.3,4.6,7.3c0,0,0,0.1,0.1,0.1l6.4,8.1
				                          c-1.4,1.1-3.7,4-7.8,12.2C1.1,31.9,0,36.8,0,41.6V50c0,3.1,1.2,6.1,3.5,8.3c2.2,2.2,5.2,3.4,8.3,3.4c0,0,0,0,0.1,0l50.8-0.2
				                          c6.3,0,11.4-5.2,11.4-11.4v-8.9C74,36.6,73,32.2,71.1,28z M71.3,34.6L63.3,36L61,32.7c-0.1-0.4,0-0.9,0.3-1.3
				                          c0.3-0.4,0.7-0.7,1.2-0.8l7-1.4C70.2,31,70.8,32.8,71.3,34.6z M54.8,37.2v-6.4c0-2,1.4-3.8,3.3-4.3l8.4-2.3c0.2,0,0.3-0.2,0.3-0.3
				                          c0.7,1.3,1.5,2.8,2.3,4.5l-6.8,1.3c-0.7,0.1-1.4,0.6-1.8,1.2c-0.4,0.6-0.5,1.3-0.4,2v3.5C58.3,36.8,56.5,37,54.8,37.2z M20.7,37.4
				                          v-2.8c1.7-0.2,3.1-1.3,3.9-2.1l0.4,1.3c-1.9,0.2-3.4,1.7-3.6,3.7C21.1,37.4,20.9,37.4,20.7,37.4z M17.7,37v-3.2
				                          c0.4-0.2,0.8-0.5,1.1-0.8c0.3-0.3,0.6-0.7,0.9-1.1v5.2C19.1,37.2,18.4,37.1,17.7,37z M11.5,36.1l-2.9-0.5c0.1-0.4,0.4-0.8,0.7-1
				                          c0.4-0.3,1-0.4,1.6-0.3c0.6,0.1,1.1,0.5,1.3,0.9c0.2,0.3,0.2,0.6,0.2,1C12.1,36.2,11.8,36.1,11.5,36.1z M12.6,16.8h48.9
				                          c0.4,0,1.1,0.7,2.1,2c-1-0.3-2.4-0.4-3.3-0.4c-1.1,0-2.8,0.2-3.9,0.6c-18.5-2.7-32.2-1.3-38.8-0.1c-1-0.3-2.5-0.5-3.5-0.5
				                          c-1.1,0-2.5,0.1-3.6,0.5C12,17,12.6,16.9,12.6,16.8z M60.3,19.4c2.5,0,3.8,0.6,3.9,0.8c-0.1,0.2-1.4,0.8-3.9,0.8
				                          c-2.4,0-3.7-0.5-3.9-0.8C56.6,19.9,57.9,19.4,60.3,19.4z M56.4,21.4c1.1,0.5,2.7,0.6,3.9,0.6c1.5,0,4-0.3,4.7-1.2
				                          c0.5,0.7,0.9,1.5,1.5,2.4c-0.1,0-0.2,0-0.2,0l-8.4,2.3c-0.5,0.1-1,0.4-1.4,0.7V21.4z M14.2,19.4c1.5,0,2.6,0.2,3.2,0.4
				                          c0,0,0,0,0.1,0c0.3,0.1,0.5,0.2,0.6,0.3c-0.2,0.3-1.5,0.8-3.9,0.8c-2.5,0-3.8-0.6-3.9-0.8C10.4,20,11.7,19.4,14.2,19.4z M19.7,28.6
				                          c0,1.4-0.6,2.7-1.6,3.7c-0.6,0.5-1.3,0.9-2,1.1l0,0c0.1-0.2,0.2-0.3,0.3-0.5c1.3-0.7,2-2.1,2-3.6c0-2.3-1.9-4.2-4.2-4.2
				                          c-1.2,0-2.4,0.5-3.1,1.3c-0.7,0.8-1.1,1.8-1,3c-0.1,0.1-0.2,0.2-0.4,0.4c-0.1-0.4-0.2-0.8-0.2-1.2c0-2.8,2.3-5.1,5.1-5.1
				                          S19.7,25.8,19.7,28.6z M29.8,33.7v-1.9c0-0.4,0-0.7,0.1-1l0.2-0.5c0.6-1.6,2.2-2.7,4-2.7c2.1,0,3.9,1.5,4.2,3.6l0.1,0.8v1.9H29.8z
				                           M28.4,33.7c-0.2-0.7-0.9-1.3-1.7-1.3c-0.4,0-0.7,0.1-1,0.3l-0.3-0.9c-0.2-1-0.2-2.1-0.1-3.1c1.2-1,3-1,4.1,0l-0.3,1.1
				                          c-0.2,0.6-0.3,1.2-0.3,1.9v1.9H28.4z M26.1,33.7c0.1-0.2,0.3-0.3,0.6-0.3c0.2,0,0.4,0.1,0.6,0.3H26.1z M27.2,34.7
				                          c-0.1,0.2-0.3,0.3-0.6,0.3c-0.2,0-0.4-0.1-0.6-0.3H27.2z M39.3,31.8c0-0.1,0-0.3,0-0.4c0.8-0.6,2.7-1.5,4.8-1.1
				                          c1.7,0.3,3.1,1.5,4.2,3.4h-9V31.8z M44.3,29.3c-2-0.4-3.9,0.2-5.1,0.9l-0.7-7.9c1.2-1,3.1-0.9,4.1,0.3l3.3,4
				                          c1.3,1.6,2.1,3.4,2.5,5.4C47.1,30.3,45.5,29.6,44.3,29.3z M38.1,28.3c-1-1.1-2.4-1.8-4-1.8c-1.2,0-2.3,0.4-3.1,1l0.5-1.6
				                          c0,0,0,0,0,0l0.9-3c0.8-2.6,2-3,3.1-3c1.1,0,2.1,0.9,2.1,2.1L38.1,28.3z M30.7,24.9c-0.6-0.5-1.4-0.9-2.3-0.9
				                          c-0.7,0-1.3,0.1-1.9,0.4c0.4-1.1,0.6-1.4,0.7-1.5c0,0,0,0,0.1-0.1c0.6-0.5,1.4-0.8,2.2-0.8c0.7,0,1.4,0.3,1.9,0.8L30.7,24.9z
				                           M26.1,25.9c0.6-0.7,1.4-1,2.3-1c0.8,0,1.6,0.4,2,1l-0.6,1.8c-0.6-0.5-1.4-0.7-2.3-0.7c-0.6,0-1.3,0.1-1.9,0.4
				                          C25.8,26.9,25.9,26.4,26.1,25.9z M24.4,31.3c-0.4,0.5-1.9,2-3.6,2.3V32c1.5-0.2,2.7-1.2,3.6-2.1C24.3,30.3,24.3,30.8,24.4,31.3z
				                           M16.7,31.4c0-0.6-0.1-1.1-0.4-1.6c-0.6-1.1-1.7-1.8-3-1.8c-0.6,0-1.4,0.2-2.2,0.7c0.1-0.6,0.3-1.1,0.7-1.6c0.6-0.6,1.5-1,2.4-1
				                          c1.8,0,3.2,1.4,3.2,3.2C17.4,30.1,17.2,30.9,16.7,31.4z M13.3,29C13.3,29,13.3,29,13.3,29c0.9,0,1.6,0.5,2.1,1.3
				                          c0.5,0.9,0.4,1.9-0.1,2.7l-1.9,2.9c0-0.4-0.2-0.7-0.3-1c-0.4-0.7-1.1-1.2-2-1.4c-0.9-0.2-1.7,0-2.3,0.4C8.6,33.9,8.5,34,8.4,34
				                          C9.3,30.7,11.9,29,13.3,29z M15.3,34.7c0.5-0.1,1-0.2,1.4-0.3v2.5c-0.9-0.1-1.8-0.2-2.6-0.4L15.3,34.7z M25,34.8
				                          c0.2,0.7,0.9,1.2,1.7,1.2c0.8,0,1.5-0.5,1.7-1.3h21.3c1.6,0,2.9,1.2,3.1,2.7c-10.1,1.1-20.3,1.1-30.5,0.1
				                          C22.5,36.1,23.6,35,25,34.8z M53.8,37.3c-0.3-2-2-3.6-4.1-3.6h0c-0.1-2.8-1.1-5.5-2.9-7.7l-3.3-4c-1.3-1.4-3.4-1.7-5-0.8
				                          C38,20,36.9,19,35.5,19c-1.7,0-2.9,0.9-3.7,2.8c-0.6-0.5-1.4-0.8-2.2-0.8c-1.1,0-2.1,0.3-2.9,1c-0.5,0.3-1,1.5-1.5,3.5c0,0,0,0,0,0
				                          c-0.2,0.7-0.4,1.6-0.6,2.5c-0.3,0.4-1.9,2.6-3.8,2.9v-1.9c0,0,0,0,0,0c0-0.1,0-0.3,0-0.4c0-1.7-0.7-3.2-1.7-4.3
				                          c0.1-0.1,0.1-0.2,0.1-0.3v-3.9c0-0.2-0.1-0.4-0.2-0.5c6.8-1,19.6-2.1,36.5,0.2c0,0.1-0.1,0.2-0.1,0.3V27c-1,1-1.6,2.4-1.6,3.8
				                          L53.8,37.3C53.8,37.3,53.8,37.3,53.8,37.3z M61.1,34.5l1.1,1.6c-0.4,0.1-0.8,0.1-1.1,0.2V34.5z M6.3,5.2C6.4,5,6.6,4.6,7.2,4.6
				                          c0.1,0,0.1,0,0.2,0C7.5,4.6,19.5,2,38.8,2c19.3,0,28.3,2.6,28.4,2.6c0.1,0,0.2,0,0.3,0c0.4,0,0.8,0.2,0.9,0.6c0.2,0.4,0.2,0.8,0,1
				                          l-7.3,8.6h-48L6.3,6.2C6,5.7,6.2,5.3,6.3,5.2z M5.1,28.5c1.8-3.6,3.2-6.1,4.3-7.9c0.6,1,3.2,1.3,4.8,1.3c1.2,0,2.8-0.2,3.9-0.6v2.3
				                          c-1-0.7-2.2-1.1-3.5-1.1c-3.4,0-6.1,2.7-6.1,6.1c0,0.7,0.1,1.4,0.4,2.1c-0.9,1.2-1.5,2.7-1.7,4.6l-4.3-0.7
				                          C3.4,32.5,4.1,30.5,5.1,28.5z M72,50.1c0,5.2-4.2,9.4-9.4,9.4l-50.8,0.2c-2.6,0-5.1-1-6.9-2.8C3,55.1,2,52.6,2,50v-8.4
				                          c0-2,0.2-4.1,0.6-6l8.7,1.5c0.4,0.1,0.9,0.1,1.3,0.2c0,0,0,0,0,0c0,0,0.1,0,0.1,0c0,0,0,0,0,0c0.1,0,0.3,0,0.4,0.1c0,0,0,0,0,0
				                          c0,0,0,0,0,0c2.3,0.4,4.6,0.7,6.9,0.9c0,0,0,0,0,0c0,0,0,0,0,0c0.5,0.1,1,0.1,1.6,0.2c0,0,0,0,0,0c0,0,0,0,0,0
				                          c5.1,0.5,10.1,0.8,15.2,0.8c5.8,0,11.5-0.3,17.3-1c0,0,0,0,0,0c0,0,0,0,0,0c2.1-0.2,4.2-0.5,6.2-0.8c0,0,0,0,0,0c0,0,0,0,0,0
				                          c0.7-0.1,1.4-0.2,2-0.3l8.8-1.5c0.4,1.8,0.5,3.7,0.5,5.6V50.1z"></path>
				                        <path class="st0" d="M52.3,46.6H19.4c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h32.9c0.3,0,0.5-0.2,0.5-0.5S52.6,46.6,52.3,46.6z"></path>
				                        <path class="st0" d="M43.2,49H28.6c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5h14.6c0.3,0,0.5-0.2,0.5-0.5S43.5,49,43.2,49z"></path>
				                        <path class="st0" d="M9.7,41.7c-3,0-5.4,2.4-5.4,5.4s2.4,5.4,5.4,5.4s5.4-2.4,5.4-5.4S12.7,41.7,9.7,41.7z M9.7,51.6
				                          c-2.5,0-4.4-2-4.4-4.4s2-4.4,4.4-4.4s4.4,2,4.4,4.4S12.1,51.6,9.7,51.6z"></path>
				                        <path class="st0" d="M63.4,41.7c-3,0-5.4,2.4-5.4,5.4s2.4,5.4,5.4,5.4c3,0,5.5-2.4,5.5-5.4S66.4,41.7,63.4,41.7z M63.4,51.6
				                          c-2.5,0-4.4-2-4.4-4.4s2-4.4,4.4-4.4s4.5,2,4.5,4.4S65.9,51.6,63.4,51.6z"></path>
				                      </g>
				                      </svg>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_gallery[14][url]" value="<?php if(!empty($vehicle_image_gallery[14]['url'])) { echo esc_attr($vehicle_image_gallery[14]['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_gallery[14][id]" value="<?php if(!empty($vehicle_image_gallery[14]['id'])) { echo esc_attr($vehicle_image_gallery[14]['id']); } ?>" />

								</div>

							</div>

						</div>

						<div id="vehicle_gallery_more_images">

							<?php 

								$i = 0;

								if(!empty($vehicle_image_extended_gallery)) {

									foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
										
										if( !empty($vehicle_image_extended_gallery_item['url']) ) {

											$i++;

							?>

							<div class="cardojo-col-5" data-id="<?php echo esc_attr($i); ?>">

								<div class="vehicle_gallery_image_holder_has_image vehicle_gallery_image_loaded add_more_button" style="background-image: url(<?php if(!empty($vehicle_image_extended_gallery_item['url'])) { echo esc_attr($vehicle_image_extended_gallery_item['url']); } ?>);">

									<img class="image-holder" src="<?php if(!empty($vehicle_image_extended_gallery_item['url'])) { echo esc_attr($vehicle_image_extended_gallery_item['url']); } ?>" alt=""/>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_extended_gallery[<?php echo esc_attr($i); ?>][url]" value="<?php if(!empty($vehicle_image_extended_gallery_item['url'])) { echo esc_attr($vehicle_image_extended_gallery_item['url']); } ?>" />
									<input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_extended_gallery[<?php echo esc_attr($i); ?>][id]" value="<?php if(!empty($vehicle_image_extended_gallery_item['id'])) { echo esc_attr($vehicle_image_extended_gallery_item['id']); } ?>" />

								</div>

							</div>

							<?php } } } ?>

							<div class="cardojo-col-5" data-id="<?php $totalImg = count($vehicle_image_extended_gallery); $totalImg++; echo esc_attr($totalImg); ?>">

								<div class="vehicle_gallery_image_holder_no_image add_more_button">

									<img class="image-holder" src="" alt=""/>

									<div class="vehicle_gallery_image_holder_no_image_inner">

										<div class="your_image_url_button">
											<i class="fa fa-cloud-upload" aria-hidden="true"></i>
											<?php esc_html_e('Upload Image', 'cardojo' ); ?>
										</div>

									</div>

									<div class="vehicle_gallery_image_holder_with_image_inner">

										<div class="your_image_url_button_remove">
											<i class="fa fa-trash" aria-hidden="true"></i>
											<?php esc_html_e('Remove Image', 'cardojo' ); ?>
										</div>
										
									</div>

									<input type="hidden" class="vehicle_gallery_image_url" name="" value="" />
									<input type="hidden" class="vehicle_gallery_image_id" name="" value="" />

								</div>

							</div>

						</div>

					</div>

				</fieldset>

				<br>

			</div>	<!-- end review_options_pop -->

		<?php

		}

		function display_car_expenses ($post) {
			//get the post meta data`

			$vehicle_expenses = get_post_meta($post->ID, 'vehicle_expenses',true);

		?>
		
		<div id='options_group'>

			<fieldset>

				<div class="cardojo-row">

					<div id="vehicle_expenses_container">

						<?php 

							$i = 0;

							if(!empty($vehicle_expenses)) {

								foreach ($vehicle_expenses as $vehicle_expenses_item) {
									
									if( !empty($vehicle_expenses_item['price']) ) {

										$i++;

						?>

						<div class="vehicle_expenses_item" data-id="<?php echo esc_attr($i); ?>">

							<div class="cardojo-col-3">

								<label for="vehicle_expenses" class="control-label"><?php esc_html_e('Price', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</label>
								<input type="text" id="vehicle_expenses" name="vehicle_expenses[<?php echo esc_attr($i); ?>][price]" value="<?php if(!empty($vehicle_expenses_item['price'])) { echo esc_attr($vehicle_expenses_item['price']); } ?>" placeholder="200" />

							</div>

							<div class="cardojo-col-half">

								<label for="vehicle_expenses" class="control-label"><?php esc_html_e('Description', 'cardojo' ); ?></label>
								<textarea cols="20" rows="4" class="input-text" name="vehicle_expenses[<?php echo esc_attr($i); ?>][desc]" placeholder="<?php esc_html_e('Write down vehicle’s expense description here...', 'cardojo' ); ?>"><?php if(!empty($vehicle_expenses_item['desc'])) { echo wp_kses($vehicle_expenses_item['desc'], true); } ?></textarea>

							</div>

							<div class="cardojo-col-3">

								<div class="delete_expense"><i class="fa fa-times" aria-hidden="true"></i> <?php esc_html_e('Delete', 'cardojo' ); ?></div>

							</div>

						</div>

						<?php } } } ?>
						<?php if( $i == 0 ) { ?>

						<div class="vehicle_expenses_item" data-id="<?php echo esc_attr($i); ?>">

							<div class="cardojo-col-3">

								<label for="vehicle_expenses" class="control-label"><?php esc_html_e('Price', 'cardojo' ); ?> (<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</label>
								<input type="text" id="vehicle_expenses" name="vehicle_expenses[<?php echo esc_attr($i); ?>][price]" value="" placeholder="200" />

							</div>

							<div class="cardojo-col-half">

								<label for="vehicle_expenses" class="control-label"><?php esc_html_e('Description', 'cardojo' ); ?></label>
								<textarea cols="20" rows="4" class="input-text" name="vehicle_expenses[<?php echo esc_attr($i); ?>][desc]" placeholder="<?php esc_html_e('Write down vehicle’s expense description here...', 'cardojo' ); ?>"></textarea>

							</div>

							<div class="cardojo-col-3">

								<div class="delete_expense"><i class="fa fa-times" aria-hidden="true"></i> <?php esc_html_e('Delete', 'cardojo' ); ?></div>

							</div>

						</div>

						<?php } ?>

					</div>

					<div class="cardojo-col-12">
						
						<div class="add_new_expense"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php esc_html_e('Add New Expense', 'cardojo' ); ?></div>

					</div>

				</div>

			</fieldset>

		</div>

		<?php

		}
		
		add_action ('save_post', 'update_car_settings');
		function update_car_settings ( $td_post_id ) {
			// verify nonce.  

			if (!isset($_POST['cmb_nonce'])) {
				return false;		
			}

			if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__))) {
				return false;
			}

			global $td_allowed;

			// Car Info
			update_post_meta($td_post_id, 'vehicle_year', sanitize_text_field($_POST['cq-year']));
			update_post_meta($td_post_id, 'vehicle_make', sanitize_text_field($_POST['cq-make']));
			update_post_meta($td_post_id, 'vehicle_model', sanitize_text_field($_POST['cq-model']));
			update_post_meta($td_post_id, 'vehicle_trim_id', sanitize_text_field($_POST['cq-trim']));
			update_post_meta($td_post_id, 'vehicle_trim_desc_init', sanitize_text_field($_POST['vehicle_trim_desc_init']));
			update_post_meta($td_post_id, 'vehicle_make_desc_init', sanitize_text_field($_POST['vehicle_make_desc_init']));
			update_post_meta($td_post_id, 'vehicle_stock', sanitize_text_field($_POST['vehicle_stock']));
			update_post_meta($td_post_id, 'vehicle_vin', sanitize_text_field($_POST['vehicle_vin']));
			update_post_meta($td_post_id, 'vehicle_carfax_link', sanitize_text_field($_POST['vehicle_carfax_link']));

			update_post_meta($td_post_id, 'vehicle_condition', sanitize_text_field($_POST['vehicle_condition']));

			if(!isset($_POST['vehicle_mileage']) OR empty($_POST['vehicle_mileage'])) {
				$mileage = "0";
			} else {
				$mileage = sanitize_text_field($_POST['vehicle_mileage']);
			}
			update_post_meta($td_post_id, 'vehicle_mileage', $mileage);
			update_post_meta($td_post_id, 'vehicle_condition_num', sanitize_text_field($_POST['vehicle_condition_num']));
			update_post_meta($td_post_id, 'vehicle_owners', sanitize_text_field($_POST['vehicle_owners']));

			if( isset($_POST['vehicle_accident_free'])) {
				$vehicle_accident_free = sanitize_text_field($_POST['vehicle_accident_free']);
			} else {
				$vehicle_accident_free = "";
			}
			update_post_meta($td_post_id, 'vehicle_accident_free', $vehicle_accident_free);

			if( isset($_POST['vehicle_service_history'])) {
				$vehicle_service_history = sanitize_text_field($_POST['vehicle_service_history']);
			} else {
				$vehicle_service_history = "";
			}
			update_post_meta($td_post_id, 'vehicle_service_history', $vehicle_service_history);

			update_post_meta($td_post_id, 'vehicle_doors', sanitize_text_field($_POST['vehicle_doors']));
			update_post_meta($td_post_id, 'vehicle_seats', sanitize_text_field($_POST['vehicle_seats']));

			// Vehicle Body Style
			if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_body_style'] ), 'vehicle_body_style' ) ) {

				$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_body_style']), 'vehicle_body_style' );

				if ( ! is_wp_error( $submit_term ) ) {
				    // Get term_id, set default as 0 if not set
				    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
				    wp_set_post_terms( $td_post_id, $term_id, "vehicle_body_style", false );

				}

			} else {

				$terms_body_style = sanitize_text_field($_POST['vehicle_body_style']);
				wp_set_post_terms( $td_post_id, $terms_body_style, "vehicle_body_style", false );

			}

			// Vehicle Collection
			if(!empty($_POST['vehicle_collection'])) {
				$vehicle_collection = sanitize_text_field($_POST['vehicle_collection']);
			} else {
				$vehicle_collection = "";
			}
			wp_set_post_terms( $td_post_id, $vehicle_collection, "vehicle_collection", false );

			$terms_color = sanitize_text_field($_POST['vehicle_exterior_color']);
			wp_set_post_terms( $td_post_id, $terms_color, "vehicle_exterior_color", false );

			$terms_int_color = sanitize_text_field($_POST['vehicle_interior_color']);
			wp_set_post_terms( $td_post_id, $terms_int_color, "vehicle_interior_color", false );

			if( isset($_POST['vehicle_metalic_paint'])) {
				$vehicle_metalic_paint = sanitize_text_field($_POST['vehicle_metalic_paint']);
			} else {
				$vehicle_metalic_paint = "";
			}
			update_post_meta($td_post_id, 'vehicle_metalic_paint', $vehicle_metalic_paint);

			$vehicle_interior_material = sanitize_text_field($_POST['vehicle_interior_material']);
			wp_set_post_terms( $td_post_id, $vehicle_interior_material, "vehicle_interior_material", false );

			if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_fuel_type'] ), 'vehicle_fuel_type' ) ) {

				$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_fuel_type']), 'vehicle_fuel_type' );

				if ( ! is_wp_error( $submit_term ) ) {
				    // Get term_id, set default as 0 if not set
				    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
				    wp_set_post_terms( $td_post_id, $term_id, "vehicle_fuel_type", false );

				}

			} else {

				$vehicle_fuel_type = sanitize_text_field($_POST['vehicle_fuel_type']);
				wp_set_post_terms( $td_post_id, $vehicle_fuel_type, "vehicle_fuel_type", false );

			}

			update_post_meta($td_post_id, 'vehicle_engine_volume_l', sanitize_text_field($_POST['vehicle_engine_volume_l']));
			update_post_meta($td_post_id, 'vehicle_engine_volume_ccm', sanitize_text_field($_POST['vehicle_engine_volume_ccm']));
			update_post_meta($td_post_id, 'vehicle_engine_position', sanitize_text_field($_POST['vehicle_engine_position']));
			update_post_meta($td_post_id, 'vehicle_cilinders', sanitize_text_field($_POST['vehicle_cilinders']));
			update_post_meta($td_post_id, 'vehicle_engine_type', sanitize_text_field($_POST['vehicle_engine_type']));
			update_post_meta($td_post_id, 'vehicle_power_hp', sanitize_text_field($_POST['vehicle_power_hp']));
			update_post_meta($td_post_id, 'vehicle_power_kw', sanitize_text_field($_POST['vehicle_power_kw']));
			update_post_meta($td_post_id, 'vehicle_max_power_rpm', sanitize_text_field($_POST['vehicle_max_power_rpm']));
			update_post_meta($td_post_id, 'vehicle_torque_nm', sanitize_text_field($_POST['vehicle_torque_nm']));
			update_post_meta($td_post_id, 'vehicle_max_torque_rpm', sanitize_text_field($_POST['vehicle_max_torque_rpm']));
			update_post_meta($td_post_id, 'vehicle_gears_num', sanitize_text_field($_POST['vehicle_gears_num']));
			update_post_meta($td_post_id, 'vehicle_accel_0_100', sanitize_text_field($_POST['vehicle_accel_0_100']));

			// Car Description
			update_post_meta($td_post_id, 'vehicle_description', wp_kses($_POST['vehicle_description'], true));

			//
			if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_transmission'] ), 'vehicle_transmission' ) ) {

				$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_transmission']), 'vehicle_transmission' );

				if ( ! is_wp_error( $submit_term ) ) {
				    // Get term_id, set default as 0 if not set
				    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
				    wp_set_post_terms( $td_post_id, $term_id, "vehicle_transmission", false );

				}

			} else {

				$vehicle_transmission = sanitize_text_field($_POST['vehicle_transmission']);
				wp_set_post_terms( $td_post_id, $vehicle_transmission, "vehicle_transmission", false );

			}

			//
			if ( ! get_term_by( 'id', sanitize_title( $_POST['vehicle_drive'] ), 'vehicle_drive' ) ) {

				$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_drive']), 'vehicle_drive' );

				if ( ! is_wp_error( $submit_term ) ) {
				    // Get term_id, set default as 0 if not set
				    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;
				    wp_set_post_terms( $td_post_id, $term_id, "vehicle_drive", false );

				}

			} else {

				$vehicle_drive = sanitize_text_field($_POST['vehicle_drive']);
				wp_set_post_terms( $td_post_id, $vehicle_drive, "vehicle_drive", false );

			}

			// Car Fuel consumption and emissions
			update_post_meta($td_post_id, 'vehicle_consumption_combined', sanitize_text_field($_POST['vehicle_consumption_combined']));
			update_post_meta($td_post_id, 'vehicle_consumption_urban', sanitize_text_field($_POST['vehicle_consumption_urban']));
			update_post_meta($td_post_id, 'vehicle_consumption_highway', sanitize_text_field($_POST['vehicle_consumption_highway']));
			update_post_meta($td_post_id, 'vehicle_emissions', sanitize_text_field($_POST['vehicle_emissions']));
			update_post_meta($td_post_id, 'vehicle_emission_class', sanitize_text_field($_POST['vehicle_emission_class']));
			update_post_meta($td_post_id, 'vehicle_fuel_tank', sanitize_text_field($_POST['vehicle_fuel_tank']));

			// Car Dimensions and weight
			update_post_meta($td_post_id, 'vehicle_length', sanitize_text_field($_POST['vehicle_length']));
			update_post_meta($td_post_id, 'vehicle_width', sanitize_text_field($_POST['vehicle_width']));
			update_post_meta($td_post_id, 'vehicle_height', sanitize_text_field($_POST['vehicle_height']));
			update_post_meta($td_post_id, 'vehicle_wheelbase', sanitize_text_field($_POST['vehicle_wheelbase']));
			update_post_meta($td_post_id, 'vehicle_weight', sanitize_text_field($_POST['vehicle_weight']));

			// Car features and specifications
			if( isset($_POST['vehicle_wheel_size'])) {
				$vehicle_wheel_size = sanitize_text_field($_POST['vehicle_wheel_size']);
			} else {
				$vehicle_wheel_size = "";
			}
			update_post_meta($td_post_id, 'vehicle_wheel_size', $vehicle_wheel_size);

			if(!empty($_POST['vehicle_safety'])) {
				$vehicle_safety = esc_attr($_POST['vehicle_safety']);
			} else {
				$vehicle_safety = "";
			}
			wp_set_post_terms( $td_post_id, $vehicle_safety, "vehicle_safety", false );

			if(!empty($_POST['vehicle_comfort'])) {
				$vehicle_comfort = esc_attr($_POST['vehicle_comfort']);
			} else {
				$vehicle_comfort = "";
			}
			wp_set_post_terms( $td_post_id, $vehicle_comfort, "vehicle_comfort", false );

			if(!empty($_POST['vehicle_visibility'])) {
				$vehicle_visibility = esc_attr($_POST['vehicle_visibility']);
			} else {
				$vehicle_visibility = "";
			}
			wp_set_post_terms( $td_post_id, $vehicle_visibility, "vehicle_visibility", false );

			if(!empty($_POST['vehicle_exterior'])) {
				$vehicle_exterior = esc_attr($_POST['vehicle_exterior']);
			} else {
				$vehicle_exterior = "";
			}
			wp_set_post_terms( $td_post_id, $vehicle_exterior, "vehicle_exterior", false );

			if(!empty($_POST['vehicle_interior'])) {
				$vehicle_interior = esc_attr($_POST['vehicle_interior']);
			} else {
				$vehicle_interior = "";
			}
			wp_set_post_terms( $td_post_id, $vehicle_interior, "vehicle_interior", false );

			if(!empty($_POST['vehicle_multimedia'])) {
				$vehicle_multimedia = esc_attr($_POST['vehicle_multimedia']);
			} else {
				$vehicle_multimedia = "";
			}
			wp_set_post_terms( $td_post_id, $vehicle_multimedia, "vehicle_multimedia", false );

			// Car Price
			update_post_meta($td_post_id, 'vehicle_acquisition_price', sanitize_text_field($_POST['vehicle_acquisition_price']));
			update_post_meta($td_post_id, 'vehicle_retail_price', sanitize_text_field($_POST['vehicle_retail_price']));
			update_post_meta($td_post_id, 'vehicle_discounted_price', sanitize_text_field($_POST['vehicle_discounted_price']));

			if( isset($_POST['vehicle_discount'])) {
				$vehicle_discount = sanitize_text_field($_POST['vehicle_discount']);
			} else {
				$vehicle_discount = "";
			}
			update_post_meta($td_post_id, 'vehicle_discount', $vehicle_discount);

			$vehicle_retail_price = esc_attr(get_post_meta($td_post_id, 'vehicle_retail_price',true));
			$vehicle_discount = esc_attr(get_post_meta($td_post_id, 'vehicle_discount',true));
			$vehicle_discounted_price = esc_attr(get_post_meta($td_post_id, 'vehicle_discounted_price',true));
			if( $vehicle_discount == "on" AND !empty($vehicle_discounted_price) ) {
				$price = $vehicle_discounted_price;
			} else {
				$price = $vehicle_retail_price;
			}
			update_post_meta($td_post_id, 'vehicle_price', $price);

			if( isset($_POST['vehicle_cheaper_car_exg'])) {
				$vehicle_cheaper_car_exg = sanitize_text_field($_POST['vehicle_cheaper_car_exg']);
			} else {
				$vehicle_cheaper_car_exg = "";
			}
			update_post_meta($td_post_id, 'vehicle_cheaper_car_exg', $vehicle_cheaper_car_exg);

			if( isset($_POST['vehicle_expensive_car_exg'])) {
				$vehicle_expensive_car_exg = sanitize_text_field($_POST['vehicle_expensive_car_exg']);
			} else {
				$vehicle_expensive_car_exg = "";
			}
			update_post_meta($td_post_id, 'vehicle_expensive_car_exg', $vehicle_expensive_car_exg);

			if( isset($_POST['vehicle_negociable_price'])) {
				$vehicle_negociable_price = sanitize_text_field($_POST['vehicle_negociable_price']);
			} else {
				$vehicle_negociable_price = "";
			}
			update_post_meta($td_post_id, 'vehicle_negociable_price', $vehicle_negociable_price);

			// Car Location

			if(!empty($_POST['vehicle_location'])) {
				$vehicle_location = sanitize_text_field($_POST['vehicle_location']);
			} else {
				$vehicle_location = "";
			}

			if( $_POST['vehicle_location'] == "new" ) {

				$vehicle_location = "";

				if ( !get_term_by( 'slug', sanitize_title( $_POST['vehicle_location_address'] ), 'vehicle_location' ) ) {
								
					$submit_term = wp_insert_term( sanitize_text_field($_POST['vehicle_location_address']), 'vehicle_location' );

					if ( ! is_wp_error( $submit_term ) ) {
					    // Get term_id, set default as 0 if not set
					    $term_id = isset( $submit_term['term_id'] ) ? $submit_term['term_id'] : 0;

					    update_term_meta( $term_id, 'vehicle_location_name', sanitize_text_field($_POST['vehicle_location_name']) );
					    update_term_meta( $term_id, 'vehicle_location_mobile_phone', sanitize_text_field($_POST['vehicle_location_mobile_phone']) );
					    update_term_meta( $term_id, 'vehicle_location_phone', sanitize_text_field($_POST['vehicle_location_phone']) );
					    update_term_meta( $term_id, 'vehicle_location_email', sanitize_text_field($_POST['vehicle_location_email']) );
					    update_term_meta( $term_id, 'vehicle_location_address', sanitize_text_field($_POST['vehicle_location_address']) );
					    update_term_meta( $term_id, 'vehicle_location_latitude', sanitize_text_field($_POST['vehicle_location_latitude']) );
					    update_term_meta( $term_id, 'vehicle_location_longitude', sanitize_text_field($_POST['vehicle_location_longitude']) );

						$vehicle_location = $term_id;

					}

				}

			}

			wp_set_post_terms( $td_post_id, $vehicle_location, "vehicle_location", false );

			// Update selected location meta
			if(!empty($vehicle_location)) {

				update_term_meta( $vehicle_location, 'vehicle_location_name', sanitize_text_field($_POST['vehicle_location_name']) );
		    	update_term_meta( $vehicle_location, 'vehicle_location_mobile_phone', sanitize_text_field($_POST['vehicle_location_mobile_phone']) );
		    	update_term_meta( $vehicle_location, 'vehicle_location_phone', sanitize_text_field($_POST['vehicle_location_phone']) );
		    	update_term_meta( $vehicle_location, 'vehicle_location_email', sanitize_text_field($_POST['vehicle_location_email']) );
		    	update_term_meta( $vehicle_location, 'vehicle_location_address', sanitize_text_field($_POST['vehicle_location_address']) );
		    	update_term_meta( $vehicle_location, 'vehicle_location_latitude', sanitize_text_field($_POST['vehicle_location_latitude']) );
			    update_term_meta( $vehicle_location, 'vehicle_location_longitude', sanitize_text_field($_POST['vehicle_location_longitude']) );

		    	// update name and slug
		    	wp_update_term( $vehicle_location, 'vehicle_location', array(
				  	'name' => sanitize_text_field($_POST['vehicle_location_address']),
				  	'slug' => sanitize_title( $_POST['vehicle_location_address'] )
				));

			}

			// Car Image Gallery
			if( isset($_POST['vehicle_image_gallery'])) {
				$vehicle_image_gallery = $_POST['vehicle_image_gallery'];
			} else {
				$vehicle_image_gallery = "";
			}
			update_post_meta($td_post_id, 'vehicle_image_gallery', $vehicle_image_gallery);

			if( isset($_POST['vehicle_image_extended_gallery'])) {
				$vehicle_image_extended_gallery = $_POST['vehicle_image_extended_gallery'];
			} else {
				$vehicle_image_extended_gallery = "";
			}
			update_post_meta($td_post_id, 'vehicle_image_extended_gallery', $vehicle_image_extended_gallery);

			// Cover image
			$vehicle_image_gallery = get_post_meta($td_post_id, 'vehicle_image_gallery',true);
			$vehicle_image_extended_gallery = get_post_meta($td_post_id, 'vehicle_image_extended_gallery',true);
			$vehicle_cover_image = "";

			if(!empty($vehicle_image_gallery)) {

				foreach ($vehicle_image_gallery as $vehicle_image_gallery_item) {
					
					if( !empty($vehicle_image_gallery_item['url']) ) {

						if( empty($vehicle_cover_image) ) {

							$vehicle_cover_image = esc_url($vehicle_image_gallery_item['url']);

						}

					}

				}

			}

			if(!empty($vehicle_image_extended_gallery)) {

				foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
					
					if( !empty($vehicle_image_extended_gallery_item['url']) ) {

						if( empty($vehicle_cover_image) ) {

							$vehicle_cover_image = esc_url($vehicle_image_extended_gallery_item['url']);

						}

					}

				}

			}

			update_post_meta($td_post_id, 'vehicle_cover_image', $vehicle_cover_image);

			// Car Expenses
			if( isset($_POST['vehicle_expenses'])) {
				$vehicle_expenses = $_POST['vehicle_expenses'];
			} else {
				$vehicle_expenses = "";
			}
			update_post_meta($td_post_id, 'vehicle_expenses', $vehicle_expenses);

			// Car Cost
			$vehicle_expenses = get_post_meta($td_post_id, 'vehicle_expenses',true);
			$vehicle_acquisition_price = 0;
			$vehicle_acquisition_price = esc_attr(get_post_meta($td_post_id, 'vehicle_acquisition_price',true));
			$vehicle_expenses_num = $vehicle_acquisition_price;
			if(!empty($vehicle_expenses)) {
				foreach ($vehicle_expenses as $vehicle_expenses_item) {
					if( !empty($vehicle_expenses_item['price']) ) {
						$vehicle_expenses_num = $vehicle_expenses_num + $vehicle_expenses_item['price'];
					}
				}
			}

			update_post_meta($td_post_id, 'vehicle_cost', $vehicle_expenses_num);

		}

	}

}