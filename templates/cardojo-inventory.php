<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$action_name = "";
	if ( isset( $_GET['action'] ) ) {
        $action_name = $_GET['action'];
    }

	$car_id = "";
	if ( isset( $_GET['car_id'] ) ) {
        $car_id = $_GET['car_id'];
    }

    if($action_name == "add_expenses" AND !empty($car_id) AND $expenses_status == 0 ) {

    	if ( cardojo_user_can_edit_car( $car_id ) ) {

    		$vehicle_expenses = get_post_meta($car_id, 'vehicle_expenses',true);

    		$vehicle_year = esc_attr(get_post_meta($car_id, 'vehicle_year',true));
			$vehicle_make = esc_attr(get_post_meta($car_id, 'vehicle_make',true));
			$vehicle_model = esc_attr(get_post_meta($car_id, 'vehicle_model',true));
			$vehicle_trim_desc_init = esc_attr(get_post_meta($car_id, 'vehicle_trim_desc_init',true));
			$vehicle_make_desc_init = esc_attr(get_post_meta($car_id, 'vehicle_make_desc_init',true));
			$vehicle_stock = esc_attr(get_post_meta($car_id, 'vehicle_stock',true));
			$vehicle_vin = esc_attr(get_post_meta($car_id, 'vehicle_vin',true));

			$action_url = add_query_arg( array( 'action' => 'add_expenses', 'car_id' => $car_id, 'expense_status' => '1' ) );
			$action_url = wp_nonce_url( $action_url, 'cardojo_inventory_actions' );

?>

<div id="cardojo-inventory">

	<div class="table-toolbar">

		<div class="row">

			<div id="car_expenses">

				<div class="options_group">

					<div class="col-sm-12">
						
						<h2><span><?php echo esc_attr($vehicle_year); ?></span> <?php echo esc_attr($vehicle_make_desc_init); ?> <?php echo esc_attr($vehicle_model); ?> <?php echo esc_attr($vehicle_trim_desc_init); ?></h2>

					</div>

					<div class="col-sm-12">

						<fieldset>

							<form id="cardojo-add-expenses" action="<?php echo esc_url( $action_url ); ?>" class="cardojo-add-expenses" method="post">

								<div class="col-sm-12">

									<h3 class="options_group_heading"><?php esc_html_e('Expenses', 'cardojo' ); ?></h3>

								</div>

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
											<textarea cols="20" rows="4" class="input-text" name="vehicle_expenses[<?php echo esc_attr($i); ?>][desc]" placeholder="<?php esc_html_e('Write down vehicle’s expense description here...', 'cardojo' ); ?>"><?php if(!empty($vehicle_expenses_item[desc])) { echo wp_kses($vehicle_expenses_item[desc], true); } ?></textarea>

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

								<div class="col-sm-12">
									
									<div class="add_new_expense"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php esc_html_e('Add New Expense', 'cardojo' ); ?></div>

								</div>

								<div class="cardojo-col-12">

									<a id="cardojo_save_expenses" href="#" class="btn btn-default"><?php esc_html_e( 'Save expenses', 'cardojo' ) ?></a>

									<a id="cardojo_discard_expenses" href="<?php echo esc_url(cardojo_get_permalink( 'inventory' )); ?>" class="btn btn-default"><?php esc_html_e( 'Cancel', 'cardojo' ) ?></a>

								</div>

							</form>

						</fieldset>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<?php

		}

    } else {

?>

<div id="cardojo-inventory">

	<div class="table-toolbar">

		<div class="row">

			<div class="col-sm-12">
				
				<?php if ( cardojo_get_permalink( 'submit_car_form' ) ) { ?>
				
					<a id="cardojo_add_vehicle" href="<?php echo esc_url(cardojo_get_permalink( 'submit_car_form' )); ?>" class="btn btn-default"><i class="fa fa-car" aria-hidden="true"></i> <?php esc_html_e( 'Add Vehicle', 'cardojo' ) ?></a>

				<?php } ?>

			</div>

		</div>

		<div class="row cardojo-inventory-stats">

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Vehicles', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_total_cars_all(); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Avg. Photos', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo round(cardojo_get_avg_photos()); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Avg. Mileage', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_number(cardojo_get_avg_mileage()); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Avg. Days', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_avg_days(); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Avg. Cost', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_clean_price(cardojo_get_avg_cost()); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Cost', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_clean_price(cardojo_get_total_cost()); ?></span>

				</div>

			</div>

		</div>

	</div>

	<div class="table-toolbar">

		<div class="row">

			<?php 

				$inventory_url = "#";

				if ( cardojo_get_permalink( 'inventory' ) ) { 

					$inventory_url = cardojo_get_permalink( 'inventory' );

				} 

			?>

			<form class="cardojo-inventory-filter" action="<?php echo esc_url($inventory_url); ?>" method="get">

				<?php

					$filter = "off";

					$keyword = "";
	        		if ( isset( $_GET['keyword'] ) AND !empty(isset( $_GET['keyword'] ) ) ) {
			            $keyword = $_GET['keyword'];
			            $filter = "on";
			        }

					$posts_per_page = "10";
	        		if ( isset( $_GET['posts_per_page'] ) AND !empty($_GET['posts_per_page']) ) {
			            $posts_per_page = $_GET['posts_per_page'];
			        } 

			        $filterby = "all";
	        		if ( isset( $_GET['filterby'] ) AND !empty($_GET['filterby']) ) {
			            $filterby = $_GET['filterby'];
			        }

			        $orderby = "default";
	        		if ( isset( $_GET['orderby'] ) AND !empty($_GET['orderby']) ) {
			            $orderby = $_GET['orderby'];
			        }

			        //
			        if( !empty($posts_per_page) AND $posts_per_page != 10) {
			        	$filter = "on";
			        }

			        if( !empty($filterby) AND $filterby != "all") {
			        	$filter = "on";
			        }

			        if( !empty($orderby) AND $orderby != "default") {
			        	$filter = "on";
			        }

			        $post_status = array( 'publish', 'pending', 'draft' );

			        if( !empty($_GET['filterby']) AND $_GET['filterby'] == "Draft") {

			        	$post_status = 'draft';

			        } elseif( !empty($_GET['filterby']) AND $_GET['filterby'] == "Pending") {

			        	$post_status = 'pending';

			        } else {

			        	$post_status = array( 'publish', 'pending', 'draft' );

			        }

			        
					$search_args = apply_filters( 'cardojo_get_inventory_cars_args', array(
						'post_type'           => 'vehicle',
						'post_status'         => $post_status,
						'posts_per_page'      => $posts_per_page,
						'offset'              => ( max( 1, get_query_var('paged') ) - 1 ) * $posts_per_page,
						'orderby'             => 'date',
						'order'               => 'desc',
						'author'              => get_current_user_id(),
						'ignore_sticky_posts' => 1
					) );

					$search_args = apply_filters( 'cardojo_search_parameters', $search_args );
					$cars_query = new WP_Query;
					$cars = $cars_query->query( $search_args );

					$max_num_pages = $cars_query->max_num_pages;

				?>

				<div class="col-sm-3">

					<div class="dataTables_length" id="posts_per_page">

						<?php

							$paged    = max( 1, get_query_var('paged') );
							$per_page = $posts_per_page;
							$total    = $cars_query->found_posts;
							$first    = ( $per_page * $paged ) - $per_page + 1;
							$last     = min( $total, $posts_per_page * $paged );

							if ( $total <= $per_page || -1 == $per_page ) {
								/* translators: %d: total results */
								printf( _n( 'Showing the single vehicle', 'Showing all %d vehicles', $total, 'cardojo' ), $total );
							} else {
								/* translators: 1: first result 2: last result 3: total results */
								printf( _nx( 'Showing the single vehicle', 'Showing %1$d to %2$d of %3$d', $total, 'with first and last vehicle', 'cardojo' ), $first, $last, $total );
							}

						?>

					</div>

				</div>

				<div class="col-sm-9">

					<div id="sample_1_filter" class="dataTables_filter">

						<label><?php esc_html_e('Search:', 'cardojo' ); ?>
							<input type="search" name="keyword" class="cardojo-filter-keyword input-sm input-small input-inline" placeholder="" aria-controls="sample_1" value="<?php echo esc_attr($keyword); ?>">
						</label>

						<label><?php esc_html_e('Filter', 'cardojo' ); ?> 

							<select name="filterby" aria-controls="sample_2" class="input-sm input-xsmall input-inline cardojo-inventory-select-filter">
								<option value="all" <?php if( $filterby == 'all' ) { echo "selected"; } ?>><?php esc_html_e('All Vehicles', 'cardojo' ); ?></option>
								<option value="Used" <?php if( $filterby == 'Used' ) { echo "selected"; } ?>><?php esc_html_e('Used', 'cardojo' ); ?></option>
								<option value="New" <?php if( $filterby == 'New' ) { echo "selected"; } ?>><?php esc_html_e('New', 'cardojo' ); ?></option>
								<option value="Sold" <?php if( $filterby == 'Sold' ) { echo "selected"; } ?>><?php esc_html_e('Sold', 'cardojo' ); ?></option>
								<option value="Featured" <?php if( $filterby == 'Featured' ) { echo "selected"; } ?>><?php esc_html_e('Featured', 'cardojo' ); ?></option>
								<option value="Promoted" <?php if( $filterby == 'Promoted' ) { echo "selected"; } ?>><?php esc_html_e('Promoted', 'cardojo' ); ?></option>
								<option value="Draft" <?php if( $filterby == 'Draft' ) { echo "selected"; } ?>><?php esc_html_e('Draft', 'cardojo' ); ?></option>
								<option value="Pending" <?php if( $filterby == 'Pending' ) { echo "selected"; } ?>><?php esc_html_e('Pending', 'cardojo' ); ?></option>
							</select>

						</label>

						<label><?php esc_html_e('Sort', 'cardojo' ); ?> 

							<select name="orderby" class="input-sm input-xsmall input-inline cardojo-inventory-select-order">
								<option value="default" <?php if( $orderby == 'default' ) { echo "selected"; } ?>><?php esc_html_e('Default Sorting', 'cardojo' ); ?></option>
								<option value="year_asc" <?php if( $orderby == 'year_asc' ) { echo "selected"; } ?>><?php esc_html_e('Year &uarr;', 'cardojo' ); ?></option>
								<option value="year_desc" <?php if( $orderby == 'year_desc' ) { echo "selected"; } ?>><?php esc_html_e('Year &darr;', 'cardojo' ); ?></option>
								<option value="make_asc" <?php if( $orderby == 'make_asc' ) { echo "selected"; } ?>><?php esc_html_e('Make &uarr;', 'cardojo' ); ?></option>
								<option value="make_desc" <?php if( $orderby == 'make_desc' ) { echo "selected"; } ?>><?php esc_html_e('Make &darr;', 'cardojo' ); ?></option>
								<option value="model_asc" <?php if( $orderby == 'model_asc' ) { echo "selected"; } ?>><?php esc_html_e('Model &uarr;', 'cardojo' ); ?></option>
								<option value="model_desc" <?php if( $orderby == 'model_desc' ) { echo "selected"; } ?>><?php esc_html_e('Model &darr;', 'cardojo' ); ?></option>
								<option value="mileage_asc" <?php if( $orderby == 'mileage_asc' ) { echo "selected"; } ?>><?php esc_html_e('Mileage &uarr;', 'cardojo' ); ?></option>
								<option value="mileage_desc" <?php if( $orderby == 'mileage_desc' ) { echo "selected"; } ?>><?php esc_html_e('Mileage &darr;', 'cardojo' ); ?></option>
								<option value="cost_asc" <?php if( $orderby == 'cost_asc' ) { echo "selected"; } ?>><?php esc_html_e('Cost &uarr;', 'cardojo' ); ?></option>
								<option value="cost_desc" <?php if( $orderby == 'cost_desc' ) { echo "selected"; } ?>><?php esc_html_e('Cost &darr;', 'cardojo' ); ?></option>
								<option value="price_asc" <?php if( $orderby == 'price_asc' ) { echo "selected"; } ?>><?php esc_html_e('Price &uarr;', 'cardojo' ); ?></option>
								<option value="price_desc" <?php if( $orderby == 'price_desc' ) { echo "selected"; } ?>><?php esc_html_e('Price &darr;', 'cardojo' ); ?></option>
								<option value="age_asc" <?php if( $orderby == 'age_asc' ) { echo "selected"; } ?>><?php esc_html_e('Age &uarr;', 'cardojo' ); ?></option>
								<option value="age_desc" <?php if( $orderby == 'age_desc' ) { echo "selected"; } ?>><?php esc_html_e('Age &darr;', 'cardojo' ); ?></option>
							</select>

						</label>

						<label><?php esc_html_e('Show', 'cardojo' ); ?> 

							<select name="posts_per_page" aria-controls="sample_1" class="input-sm input-xsmall input-inline cardojo-inventory-select-ppp">
								<option value="10" <?php if( $posts_per_page == '10' ) { echo "selected"; } ?>>10</option>
								<option value="25" <?php if( $posts_per_page == '25' ) { echo "selected"; } ?>>25</option>
								<option value="50" <?php if( $posts_per_page == '50' ) { echo "selected"; } ?>>50</option>
								<option value="-1" <?php if( $posts_per_page == '-1' ) { echo "selected"; } ?>>All</option>
							</select>

						</label>
						
						<?php if($filter == "on") { ?>
							<?php if ( cardojo_get_permalink( 'inventory' ) ) { ?>
							<a href="<?php echo esc_url(cardojo_get_permalink( 'inventory' )); ?>" id="clear-inventory-filter"><i class="fa fa-times" aria-hidden="true"></i></a>
							<?php } ?>
						<?php } ?>

					</div>

				</div>

			</form>

		</div>

	</div>

	<table id="cardojo_inventory_table" class="car-manager-cars">
		<thead>
			<tr>
				<th class="hidden-sm hidden-xs text-center"><i class="fa fa-camera" aria-hidden="true"></i></th>
				<th class="visible-xs sorting maxWidth sorting-vehicle <?php if($orderby == "year_asc"){ echo "sorting_asc"; } elseif($orderby == "year_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Inventory', 'cardojo' ); ?></th>
				<th class="hidden-xs maxWidth sorting-vehicle <?php if($orderby == "year_asc"){ echo "sorting_asc"; } elseif($orderby == "year_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Vehicle', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs text-center"><?php esc_html_e( 'Status', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs text-center sorting-mileage <?php if($orderby == "mileage_asc"){ echo "sorting_asc"; } elseif($orderby == "mileage_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Mileage', 'cardojo' ); ?></th>
				<th class="hidden-md hidden-sm hidden-xs text-center sorting-cost <?php if($orderby == "cost_asc"){ echo "sorting_asc"; } elseif($orderby == "cost_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Cost', 'cardojo' ); ?></th>
				<th class="hidden-xs text-center sorting-price <?php if($orderby == "price_asc"){ echo "sorting_asc"; } elseif($orderby == "price_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Retail', 'cardojo' ); ?></th>
				<th class="hidden-md hidden-sm hidden-xs text-center sorting-age <?php if($orderby == "age_asc"){ echo "sorting_asc"; } elseif($orderby == "age_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Age', 'cardojo' ); ?></th>
				<th class="hidden-xs text-center"><?php esc_html_e( 'Actions', 'cardojo' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php 

				if ( ! $cars ) : 

			?>
				<tr>
					<td colspan="8"><?php esc_html_e( 'You do not have any active listings.', 'cardojo' ); ?></td>
				</tr>
			<?php else : ?>
				<?php foreach ( $cars as $car ) : ?>

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
						$vehicle_cover_image = get_post_meta($car_ID, 'vehicle_cover_image',true);

						$sold_date_year = esc_attr(get_post_meta($car_ID, '_sold_date_year',true));
						$sold_date_month = esc_attr(get_post_meta($car_ID, '_sold_date_month',true));

					?>

					<tr class="listing-item <?php if( is_position_featured( $car ) ){ echo "featured-listing"; } ?> <?php if( is_position_promoted( $car ) ){ echo "promoted-listing"; } ?>">

						<td class="hidden-sm hidden-xs text-center">
							<?php 

								$i = 0;
								if(!empty($vehicle_image_gallery)) {

									foreach ($vehicle_image_gallery as $vehicle_image_gallery_item) {
										
										if( !empty($vehicle_image_gallery_item['url']) ) {

											$i++;

										}

									}

								}
								if(!empty($vehicle_image_extended_gallery)) {

									foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
										
										if( !empty($vehicle_image_extended_gallery_item['url']) ) {

											$i++;

										}

									}

								}

								echo esc_attr($i);

							?>
						</td>

						<td class="visible-xs maxWidth">

							<div class="cd-offer-short">
								
								<?php if(!empty($vehicle_cover_image)) { ?>
								<img src="<?php echo esc_url($vehicle_cover_image); ?>" alt="" class="img-rounded">
								<?php } elseif(!empty($vehicle_image_gallery[0]['url'])) { ?>
			                    <img src="<?php echo esc_url($vehicle_image_gallery[0]['url']); ?>" alt="" class="img-rounded">
			                    <?php } elseif(!empty($vehicle_image_extended_gallery[0]['url'])) { ?>
								<img src="<?php echo esc_url($vehicle_image_extended_gallery[0]['url']); ?>" alt="" class="img-rounded">
			                    <?php } ?>

			                    <h4 class="heading">
			                    	<?php if ( $car->post_status == 'publish' ) : ?>
			                    		<a href="<?php echo get_permalink( $car_ID ); ?>"><span><?php echo esc_attr($vehicle_year); ?></span> <?php echo esc_attr($vehicle_make_desc_init); ?> <?php echo esc_attr($vehicle_model); ?> <?php echo esc_attr($vehicle_trim_desc_init); ?></a>
			                    	<?php else : ?>
										<span><?php echo esc_attr($vehicle_year); ?></span> <?php echo esc_attr($vehicle_make_desc_init); ?> <?php echo esc_attr($vehicle_model); ?> <?php echo esc_attr($vehicle_trim_desc_init); ?>
									<?php endif; ?>
			                    </h4>

			                    <span class="cd-car-spec"><?php if(!empty($vehicle_stock)) { echo esc_html_e( 'SKU:', 'cardojo' ); echo " "; echo "<span>"; echo esc_attr($vehicle_stock); echo "</span>"; } ?></span>

			                    <span class="cd-car-spec"><?php if(!empty($vehicle_vin)) { echo esc_html_e( 'VIN:', 'cardojo' ); echo " "; echo "<span>"; echo esc_attr($vehicle_vin); echo "</span>"; } ?></span>

			                    <span class="cd-car-spec"><?php if(!empty($color_name)) { echo esc_html_e( 'COLOR:', 'cardojo' ); echo " ";echo "<span>";  echo esc_attr($color_name); echo "</span>"; } ?></span>

			                    <span class="cd-car-spec"><?php if(!empty($vehicle_mileage)) { echo esc_html_e( 'MILEAGE:', 'cardojo' ); echo " "; echo "<span>";  echo cardojo_number($vehicle_mileage); $unit_system = get_option( 'cardojo_measurement_type' ); if( empty($unit_system) OR $unit_system == "metric") { echo " "; echo "Km"; } else { echo " "; echo "Mi"; } echo "</span>"; } ?></span>

			                    <span class="cd-car-spec">

			                    	<?php  

										$i = 0;
										if(!empty($vehicle_image_gallery)) {

											foreach ($vehicle_image_gallery as $vehicle_image_gallery_item) {
												
												if( !empty($vehicle_image_gallery_item['url']) ) {

													$i++;

												}

											}

										}
										if(!empty($vehicle_image_extended_gallery)) {

											foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
												
												if( !empty($vehicle_image_extended_gallery_item['url']) ) {

													$i++;

												}

											}

										}

			                    		echo esc_html_e( 'PHOTOS:', 'cardojo' ); echo " ";echo "<span>";  echo esc_attr($i); echo "</span>";

			                    	?>
			                    		
		                    	</span>

		                    	<span class="cd-car-spec"><span><?php echo cardojo_price($price); ?></span></span>

		                  	</div>
						</td>

						<td class="hidden-xs maxWidth">

							<div class="cd-offer-short">
								<?php if(!empty($vehicle_cover_image)) { ?>
								<img src="<?php echo esc_url($vehicle_cover_image); ?>" alt="" class="img-rounded">
								<?php } elseif(!empty($vehicle_image_gallery[0]['url'])) { ?>
			                    <img src="<?php echo esc_url($vehicle_image_gallery[0]['url']); ?>" alt="" class="img-rounded">
			                    <?php } elseif(!empty($vehicle_image_extended_gallery[0]['url'])) { ?>
								<img src="<?php echo esc_url($vehicle_image_extended_gallery[0]['url']); ?>" alt="" class="img-rounded">
			                    <?php } ?>
			                    <h4 class="heading">
			                    	<?php if ( $car->post_status == 'publish' ) : ?>
			                    		<a href="<?php echo get_permalink( $car_ID ); ?>"><span><?php echo esc_attr($vehicle_year); ?></span> <?php echo esc_attr($vehicle_make_desc_init); ?> <?php echo esc_attr($vehicle_model); ?> <?php echo esc_attr($vehicle_trim_desc_init); ?></a>
			                    	<?php else : ?>
										<span><?php echo esc_attr($vehicle_year); ?></span> <?php echo esc_attr($vehicle_make_desc_init); ?> <?php echo esc_attr($vehicle_model); ?> <?php echo esc_attr($vehicle_trim_desc_init); ?>
									<?php endif; ?>
			                    </h4>
			                    <span class="cd-car-spec"><?php if(!empty($vehicle_stock)) { echo esc_html_e( 'SKU:', 'cardojo' ); echo " "; echo "<span>"; echo esc_attr($vehicle_stock); echo "</span>"; } ?> <?php if(!empty($vehicle_vin)) { echo esc_html_e( 'VIN:', 'cardojo' ); echo " "; echo "<span>"; echo esc_attr($vehicle_vin); echo "</span>"; } ?> <?php if(!empty($color_name)) { echo esc_html_e( 'COLOR:', 'cardojo' ); echo " ";echo "<span>";  echo esc_attr($color_name); echo "</span>"; } ?></span>
		                  	</div>
						</td>

						<td class="hidden-sm hidden-xs text-center">
							<?php 

								if ( get_post_status ( $car_ID ) == 'publish' )  {
									$sold = esc_attr(get_post_meta($car_ID, '_sold',true));
									$featured = esc_attr(get_post_meta($car_ID, '_featured',true));
									$promoted = esc_attr(get_post_meta($car_ID, '_promoted',true));
									if( $sold == 1 ) {
										echo esc_html_e( 'Sold', 'cardojo' );
									} elseif( $featured == 1 ) {
										echo esc_html_e( 'Featured', 'cardojo' );
									} elseif( $promoted == 1 ) {
										echo esc_html_e( 'Promoted', 'cardojo' );
									}  else {
										echo esc_html_e( 'Publish', 'cardojo' );
									}
								} else {
									echo get_post_status ( $car_ID );
								}

							?>
						</td>

						<td class="hidden-sm hidden-xs text-center">
							<?php if(!empty($vehicle_mileage)) { echo cardojo_number($vehicle_mileage); } ?>
						</td>

						<td class="hidden-md hidden-sm hidden-xs text-center">
							<?php echo cardojo_price($vehicle_cost); ?>
						</td>

						<td class="hidden-xs maxWidth text-center">
							<?php echo cardojo_price($price); ?>
						</td>

						<td class="hidden-md hidden-sm hidden-xs text-center">
							<?php 

								$format = get_option('date_format');
								$pfx_date = get_the_date( $format, $car_ID ); 
								$sold = esc_attr(get_post_meta($car_ID, '_sold_date',true));

								if(!empty($sold)) {
									$now = $sold;
								} else {
									$now = strtotime(date("Y-m-d H:i:s")); 
								}

								$days = ($now - strtotime($pfx_date)) / (60 * 60 * 24); 
								echo round($days); 

							?>
						</td>

						<td class="hidden-xs text-center inventory-car-actions">
							
							<div class="btn-group">

								<button class="btn btn-xs blue dropdown-toggle inventory-car-actions-button" type="button" data-toggle="dropdown" aria-expanded="false">
									<?php esc_html_e( 'Actions', 'cardojo' ); ?>
	                                <i class="fa fa-angle-down"></i>
	                            </button>

								<ul class="dropdown-menu car-inventory-actions">
									<?php
										$actions = array();

										switch ( $car->post_status ) {
											case 'publish' :
												$actions['edit'] = array( 'label' => __( 'Edit', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-pencil" aria-hidden="true"></i>' );

												if ( is_position_sold( $car ) ) {
													$actions['mark_not_sold'] = array( 'label' => __( 'Mark not Sold', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-usd" aria-hidden="true"></i>' );
												} else {
													$actions['mark_sold'] = array( 'label' => __( 'Mark as Sold', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-usd" aria-hidden="true"></i>' );

													if ( is_position_featured( $car ) ) {
														$actions['mark_not_featured'] = array( 'label' => __( 'Mark not Featured', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-trophy" aria-hidden="true"></i>' );
													} else {
														$featured_price = get_option( 'cardojo_featured_listing_price' );
														if( !empty($featured_price) AND !current_user_can('administrator') ) {
															$featured_clean_price = cardojo_clean_price($featured_price);
															$featured_clean_price_holder = " (" . $featured_clean_price . "/Day)";
														} else {
															$featured_clean_price_holder = "";
														}
														$actions['mark_featured'] = array( 'label' => __( 'Mark Featured'.$featured_clean_price_holder, 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-trophy" aria-hidden="true"></i>' );
													}
													if ( !is_position_featured( $car ) ) {

														if ( is_position_promoted( $car ) ) {
															$actions['mark_not_promoted'] = array( 'label' => __( 'Stop Promotion', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-star" aria-hidden="true"></i>' );
														} else {
															$promoted_price = get_option( 'cardojo_promoted_listing_price' );
															if( !empty($promoted_price) AND !current_user_can('administrator') ) {
																$promoted_clean_price = cardojo_clean_price($promoted_price);
																$promoted_clean_price_holder = " (" . $promoted_clean_price . "/Day)";
															} else {
																$promoted_clean_price_holder = "";
															}
															$actions['mark_promoted'] = array( 'label' => __( 'Promote'.$promoted_clean_price_holder, 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-star" aria-hidden="true"></i>' );
														}
													}
													$actions['add_expenses'] = array( 'label' => __( 'Add Expenses', 'cardojo' ), 'nonce' => false, 'icon' => '<i class="fa fa-plus" aria-hidden="true"></i>' );
												}

												$actions['duplicate'] = array( 'label' => __( 'Duplicate', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-files-o" aria-hidden="true"></i>' );

												$actions['unpublish'] = array( 'label' => __( 'Unpublish', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-eye-slash" aria-hidden="true"></i>' );

												break;
											case 'pending_payment' :
											case 'pending' :
												$actions['edit'] = array( 'label' => __( 'Edit', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-pencil" aria-hidden="true"></i>' );
												$actions['add_expenses'] = array( 'label' => __( 'Add Expenses', 'cardojo' ), 'nonce' => false, 'icon' => '<i class="fa fa-plus" aria-hidden="true"></i>' );
											case 'draft' :
												$actions['edit'] = array( 'label' => __( 'Edit', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-pencil" aria-hidden="true"></i>' );
												$actions['add_expenses'] = array( 'label' => __( 'Add Expenses', 'cardojo' ), 'nonce' => false, 'icon' => '<i class="fa fa-plus" aria-hidden="true"></i>' );

												$submit_fee = get_option("cardojo_submit_listing_price");
												$vehicle_fee = esc_attr(get_post_meta($car->ID, '_submit_fee',true));
												if( !empty($vehicle_fee) AND $vehicle_fee == 1 ) {
													$vehicle_fee_status = 1;
												} else {
													$vehicle_fee_status = 0;
												}

												if( !empty($submit_fee) AND $submit_fee > 0 AND !current_user_can('administrator') AND $vehicle_fee_status == 0 ) {
													$actions['publish'] = array( 'label' => __( 'Publish', 'cardojo' ) . ' (' . cardojo_clean_price($submit_fee) . ')', 'nonce' => true, 'icon' => '<i class="fa fa-eye" aria-hidden="true"></i>' );
												} else {
													$actions['publish'] = array( 'label' => __( 'Publish', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-eye" aria-hidden="true"></i>' );
												}
											break;
										}

										$actions['delete'] = array( 'label' => __( 'Delete', 'cardojo' ), 'nonce' => true, 'icon' => '<i class="fa fa-trash" aria-hidden="true"></i>' );
										$actions           = apply_filters( 'cardojo_inventory_actions', $actions, $car );

										foreach ( $actions as $action => $value ) {
											if( $action == 'add_expenses' ) {
												$action_url = add_query_arg( array( 'action' => $action, 'car_id' => $car->ID, 'expense_status' => '0' ) );
											} else {
												$action_url = add_query_arg( array( 'action' => $action, 'car_id' => $car->ID ) );
											}
											if ( $value['nonce'] ) {
												$action_url = wp_nonce_url( $action_url, 'cardojo_inventory_actions' );
											}
											echo '<li><a href="' . esc_url( $action_url ) . '" class="car-inventory-action-' . esc_attr( $action ) . '">' . wp_kses( $value['icon'], true ) . ' ' . esc_html( $value['label'] ) . '</a></li>';
										}
									?>
								</ul>

							</div>

						</td>

					</tr>

				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php get_cardojo_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
</div>

<?php } ?>
