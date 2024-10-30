<?php
    
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $user_id = get_current_user_id();

    $filter_args = array(
		'post_type'           => 'filter',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish' ),
		'meta_key'            => 'filter_user_id',
		'meta_value'          => $user_id
	);

	$filters_query = new WP_Query;
	$filters = $filters_query->query( $filter_args );

?>

<div class="row" id="cardojo-notifications">

	<?php

		if ( $filters ) :

			foreach ( $filters as $filter ) :

				$filter_ID = $filter->ID;

				$post_filter_make = get_post_meta($filter_ID, 'filter_make',true);
		        $post_filter_model = get_post_meta($filter_ID, 'filter_model',true);
		        $post_filter_fuel_type = get_post_meta($filter_ID, 'filter_fuel_type',true);
		        $post_filter_price = get_post_meta($filter_ID, 'filter_price',true);
		        $post_filter_year = get_post_meta($filter_ID, 'filter_year',true);
		        $post_filter_mileage = get_post_meta($filter_ID, 'filter_mileage',true);
		        $post_filter_condition = get_post_meta($filter_ID, 'filter_condition',true);

		        $filter_vehicles_args = array(
					'post_type'           => 'vehicle',
					'posts_per_page'      => 4,
					'post_status'         => array( 'publish' ),
					'meta_query'          => array(
						'relation' => 'AND',
						array(
							'key'     => 'filter_ids',
					        'value'   => $filter_ID,
					        'compare' => 'LIKE',
				        ),/*
				        array(
							'key'     => 'filter_user_'.$user_id,
							'value'   => 'new',
							'compare' => '='
						)*/
					),
			        'orderby'             => 'date',
			        'order'               => 'DESC'
				);

				$total_vehicles = 0;

				$filter_vehicles_query = new WP_Query;
				$filter_vehicles = $filter_vehicles_query->query( $filter_vehicles_args );
				$total_vehicles  = $filter_vehicles_query->found_posts;

				?>
				
				<div id="user-filter-<?php echo esc_attr($filter_ID); ?>" class="col-md-12 user-filter-container">

					<div class="row">
					
						<div class="col-md-12">

							<h4 class="user-filter-title">
								<?php if(!empty($post_filter_make)) { echo esc_attr($post_filter_make); echo " "; } ?>
								<?php if(!empty($post_filter_model)) { echo esc_attr($post_filter_model); echo " "; } ?>
								<?php if(!empty($post_filter_fuel_type)) { echo esc_attr($post_filter_fuel_type); echo " "; } ?>
								<?php if(!empty($post_filter_year)) { echo esc_html_e( "from", 'cardojo' ); echo " "; echo esc_attr($post_filter_year); echo " "; } ?>
								<?php if(!empty($post_filter_condition)) { echo esc_attr($post_filter_condition); echo " "; } ?>
								<?php if( $total_vehicles > 0) { ?>
									<span class="show-filter-new-vehicles"><?php echo esc_attr($total_vehicles); ?> <?php esc_html_e( "New", 'cardojo' ); echo " "; if( $total_vehicles > 1) { esc_html_e( "listings", 'cardojo' ); } else { esc_html_e( "listing", 'cardojo' ); } ?></span>
								<?php } ?>
								<span class="delete-user-filter" data-id="<?php echo esc_attr($filter_ID); ?>"><span></span><?php esc_html_e( "Delete", 'cardojo' ); ?></span>
							</h4>

							<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="remove-filter-form-<?php echo esc_attr($filter_ID); ?>">
		                        <input type="hidden" name="filter_id" value="<?php echo esc_attr($filter_ID); ?>" />
		                        <input type="hidden" name="action" value="remove_filter_set" />
		                    </form>

						</div>

						<?php

							if ( ! $filter_vehicles ) : 

						?>

						<div class="col-md-12">
							<h5><?php esc_html_e( "No new vehicles yet.", 'cardojo' ); ?></h5>
						</div>

						<?php 

							else : 

						?>

						<div class="col-md-12">

							<div class="row">

								<?php foreach ( $filter_vehicles as $car ) : ?>

								<?php 

									$car_ID = $car->ID;

									$vehicle_year = esc_attr(get_post_meta($car_ID, 'vehicle_year',true));
									$vehicle_make = esc_attr(get_post_meta($car_ID, 'vehicle_make',true));
									$vehicle_model = esc_attr(get_post_meta($car_ID, 'vehicle_model',true));
									$vehicle_trim_desc_init = esc_attr(get_post_meta($car_ID, 'vehicle_trim_desc_init',true));
									$vehicle_make_desc_init = esc_attr(get_post_meta($car_ID, 'vehicle_make_desc_init',true));
									$vehicle_stock = esc_attr(get_post_meta($car_ID, 'vehicle_stock',true));
									$vehicle_vin = esc_attr(get_post_meta($car_ID, 'vehicle_vin',true));

									$vehicle_exterior_color = get_the_terms($car_ID, 'vehicle_exterior_color' );
									if(!empty($vehicle_exterior_color)) {
										$color      = cardojo_get_term_color( $vehicle_exterior_color[0]->term_id, true );
										$color_id   = $vehicle_exterior_color[0]->term_id;
										$color_name = $vehicle_exterior_color[0]->name;
									} else {
										$color_name = "";
									}

									$vehicle_mileage = esc_attr(get_post_meta($car_ID, 'vehicle_mileage',true));

									$vehicle_cost = esc_attr(get_post_meta($car_ID, 'vehicle_cost',true));
									$vehicle_retail_price = esc_attr(get_post_meta($car_ID, 'vehicle_retail_price',true));
									$vehicle_discounted_price = esc_attr(get_post_meta($car_ID, 'vehicle_discounted_price',true));
									$price = esc_attr(get_post_meta($car_ID, 'vehicle_price',true));

									$vehicle_image_gallery = get_post_meta($car_ID, 'vehicle_image_gallery',true);
									$vehicle_image_extended_gallery = get_post_meta($car_ID, 'vehicle_image_extended_gallery',true);
									$vehicle_image_url = "";

									if(!empty($vehicle_image_gallery[0]['url'])) {

										$vehicle_image_url = $vehicle_image_gallery[0]['url'];

									} elseif(!empty($vehicle_image_extended_gallery[0]['url'])) {

										$vehicle_image_url = $vehicle_image_extended_gallery[0]['url'];

									}

									$vehicle_engine_volume_l = esc_attr(get_post_meta($car_ID, 'vehicle_engine_volume_l',true));
									$vehicle_power_hp = esc_attr(get_post_meta($car_ID, 'vehicle_power_hp',true));

									$vehicle_drive = get_the_terms($car_ID, 'vehicle_drive' );
									$terms_vehicle_drive = $vehicle_drive[0]->name;

								?>

								<div id="cardojo-vehicle-block-<?php echo esc_attr($car_ID); ?>" class="col-lg-3 col-md-3 col-sm-6"> 

									<div class="cardojo-vehicle-block">
										
										<?php if(!empty($vehicle_image_url)) { ?>
										<a href="<?php echo get_permalink( $car_ID ); ?>" class="cardojo-vehicle-block-thumbnail" style="background-image: url(<?php echo esc_url($vehicle_image_url); ?>);"></a>
										<?php } else { ?>
										<a href="<?php echo get_permalink( $car_ID ); ?>" class="cardojo-vehicle-block-no-thumbnail">
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
										</a>
										<?php } ?>

										<div class="cardojo-vehicle-block-meta">

											<a class="heading" href="<?php echo get_permalink( $car_ID ); ?>"><?php echo esc_attr($vehicle_make_desc_init); ?> <?php echo esc_attr($vehicle_model); ?> <?php echo esc_attr($vehicle_trim_desc_init); ?> <span class="productYear"><?php echo esc_attr($vehicle_year); ?></span></a>

											<hr class="separator separator-nopadding-top">

											<h4 class="cardojo-vehicle-block-meta-price"><?php echo cardojo_price($price); ?></h4>

											<?php 

												if( is_user_logged_in() ){

													$user_id = get_current_user_id();
					                				$listing_id = $car_ID;
					                				$user_type = "id";

					                			} else {

					                				$user_id = CarDojoGetIP();
					                				$listing_id = $car_ID;
					                				$user_type = "ip";

					                			}

					            				if( is_added_to_favorite( $user_type, $user_id, $listing_id ) ){

											?>

											<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="add-to-favorite-form-<?php echo esc_attr($listing_id); ?>">
												<input type="hidden" name="user_type" value="<?php echo esc_attr($user_type); ?>" />
						                        <input type="hidden" name="user_id" value="<?php echo esc_attr($user_id); ?>" />
						                        <input type="hidden" name="listing_id" value="<?php echo esc_attr($listing_id); ?>" />
						                        <input type="hidden" name="action" value="remove_from_favorites" />
						                    </form>

											<a href="#" type="button" class="fav-button btn btn-danger pull-right favorited remove-from-favorite" data-id="<?php echo esc_attr($listing_id); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php esc_html_e( 'Remove from favorites', 'cardojo' ); ?>"> <i class="fa fa-heart-o"></i> <i class="fa fa-heart"></i></a>

											<?php } else { ?>

											<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="add-to-favorite-form-<?php echo esc_attr($listing_id); ?>">
												<input type="hidden" name="user_type" value="<?php echo esc_attr($user_type); ?>" />
						                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
						                        <input type="hidden" name="listing_id" value="<?php echo $listing_id; ?>" />
						                        <input type="hidden" name="action" value="add_to_favorite" />
						                    </form>

											<a href="#" type="button" class="fav-button btn btn-danger pull-right add-to-favorite" data-id="<?php echo esc_attr($listing_id); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php esc_html_e( 'Add to favorites', 'cardojo' ); ?>"> <i class="fa fa-heart-o"></i> <i class="fa fa-heart"></i></a>

											<?php } ?>

										</div>

									</div>

								</div>

								<?php endforeach; ?>

								<?php

									$page_url = cardojo_get_permalink( 'cars' );
									if( !empty($page_url)) {

								?>

								<div class="col-md-12"> 

									<form id="cardojo-advance-search-form" class="cardojo-horizontal-car-filter" action="<?php echo esc_url($page_url); ?>" method="get">

										<input type="hidden" name="make" value="<?php echo esc_attr($post_filter_make); ?>" />
										<input type="hidden" name="model" value="<?php echo esc_attr($post_filter_model); ?>" />
										<input type="hidden" name="fuel_type" value="<?php echo esc_attr($post_filter_fuel_type); ?>" />
										<input type="hidden" name="price" value="<?php echo esc_attr($post_filter_price); ?>" />
										<input type="hidden" name="vehicle_year" value="<?php echo esc_attr($post_filter_year); ?>" />
										<input type="hidden" name="mileage" value="<?php echo esc_attr($post_filter_mileage); ?>" />
										<input type="hidden" name="vehicle_condition" value="<?php echo esc_attr($post_filter_condition); ?>" />

										<button type="submit" class="btn btn-default cardojo-filter-button"><?php esc_html_e('View more', 'cardojo' ); ?></button> 

									</form>

								</div>

								<?php } ?>

							</div>

						</div>

						<?php 

							endif; 

						?>

					</div>

				</div>

				<?php 

			endforeach;

		endif;

	?>

</div>
