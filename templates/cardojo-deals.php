<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$action_name = "";
	if ( isset( $_GET['action'] ) ) {
        $action_name = $_GET['action'];
    }

	$deal_ID = "";
	if ( isset( $_GET['deal_ID'] ) ) {
        $deal_ID = $_GET['deal_ID'];
    }

?>

<div id="cardojo-inventory">

	<div class="table-toolbar">

		<div class="row">

			<div class="col-sm-12">
				
				<?php if ( cardojo_get_permalink( 'submit_deal_form' ) ) { ?>
				
					<a id="cardojo_add_vehicle" href="<?php echo esc_url(cardojo_get_permalink( 'submit_deal_form' )); ?>" class="btn btn-default"><i class="fa fa-usd" aria-hidden="true"></i> <?php esc_html_e( 'Add Deal', 'cardojo' ) ?></a>

				<?php } ?>

			</div>

		</div>

		<div class="row cardojo-inventory-stats">

			<div class="col-md-3 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Deals', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_total_deals(); ?></span>

				</div>

			</div>

			<div class="col-md-3 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Closed Deals', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_closed_deals(); ?></span>

				</div>

			</div>

			<div class="col-md-3 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Profit', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_clean_price(cardojo_get_deals_total_profit()); ?></span>

				</div>

			</div>

			<div class="col-md-3 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Average Profit', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_clean_price(cardojo_get_deals_avg_profit()); ?></span>

				</div>

			</div>

		</div>

	</div>

	<div class="table-toolbar">

		<div class="row">

			<?php 

				$deals_url = "#";

				if ( cardojo_get_permalink( 'deals' ) ) { 

					$deals_url = cardojo_get_permalink( 'deals' );

				} 

			?>

			<form class="cardojo-deals-filter" action="<?php echo esc_url($deals_url); ?>" method="get">

				<?php

					$filter = "off";

					$keyword = "";
	        		if ( isset( $_GET['keyword'] ) AND !empty(isset( $_GET['keyword'] ) ) ) {
			            $keyword = $_GET['keyword'];
			        }

					$posts_per_page = "10";
	        		if ( isset( $_GET['posts_per_page'] ) AND !empty($_GET['posts_per_page']) ) {
			            $posts_per_page = $_GET['posts_per_page'];
			        } 

			        $start_date = "";
	        		if ( isset( $_GET['start_date'] ) AND !empty($_GET['start_date']) ) {
			            $start_date = $_GET['start_date'];
			        }

			        $end_date = "";
	        		if ( isset( $_GET['end_date'] ) AND !empty($_GET['end_date']) ) {
			            $end_date = $_GET['end_date'];
			        }

			        $orderby = "default";
	        		if ( isset( $_GET['orderby'] ) AND !empty($_GET['orderby']) ) {
			            $orderby = $_GET['orderby'];
			        }

			        //
			        if( !empty($posts_per_page) AND $posts_per_page != 10) {
			        	$filter = "on";
			        }

			        if( !empty($start_date) AND $start_date != "30daysago") {
			        	$filter = "on";
			        }

			        if( !empty($end_date) AND $end_date != "today") {
			        	$filter = "on";
			        }

			        if( !empty($orderby) AND $orderby != "default") {
			        	$filter = "on";
			        }

			        if( $start_date == "today" ) {
			        	$start_date_query = date('Y-m-d');
			        } elseif( $start_date == "yesterday" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-1 days'));
			        } elseif( $start_date == "7daysago" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-7 days'));
			        } elseif( $start_date == "15daysago" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-15 days'));
			        } elseif( $start_date == "30daysago" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-30 days'));
			        } elseif( $start_date == "60daysago" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-60 days'));
			        } elseif( $start_date == "90daysago" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-90 days'));
			        } elseif( $start_date == "120daysago" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-120 days'));
			        } elseif( $start_date == "1yearago" ) {
			        	$start_date_query = date('Y-m-d', strtotime('-1 year'));
			        }

			        if( $end_date == "today" ) {
			        	$end_date_query = date('Y-m-d');
			        } elseif( $end_date == "yesterday" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-1 days'));
			        } elseif( $end_date == "7daysago" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-7 days'));
			        } elseif( $end_date == "15daysago" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-15 days'));
			        } elseif( $end_date == "30daysago" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-30 days'));
			        } elseif( $end_date == "60daysago" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-60 days'));
			        } elseif( $end_date == "90daysago" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-90 days'));
			        } elseif( $end_date == "120daysago" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-120 days'));
			        } elseif( $end_date == "1yearago" ) {
			        	$end_date_query = date('Y-m-d', strtotime('-1 year'));
			        }

			        if( !empty($start_date_query) AND !empty($end_date_query) ) {

						$search_args = apply_filters( 'cardojo_get_deals_args', array(
							'post_type'           => 'deal',
							'post_status'         => 'publish',
							'posts_per_page'      => $posts_per_page,
							'offset'              => ( max( 1, get_query_var('paged') ) - 1 ) * $posts_per_page,
							'orderby'             => 'date',
							'order'               => 'desc',
							'author'              => get_current_user_id(),
							'date_query' => array(
								array(
									'after'     => $start_date_query,
									'before'    => $end_date_query,
									'inclusive' => true,
								),
							),
						) );

					} else {

						$search_args = apply_filters( 'cardojo_get_deals_args', array(
							'post_type'           => 'deal',
							'post_status'         => 'publish',
							'posts_per_page'      => $posts_per_page,
							'offset'              => ( max( 1, get_query_var('paged') ) - 1 ) * $posts_per_page,
							'orderby'             => 'date',
							'order'               => 'desc',
							'author'              => get_current_user_id(),
						) );

					}

					$search_args = apply_filters( 'cardojo_deals_search_parameters', $search_args );
					$deals_query = new WP_Query;
					$deals = $deals_query->query( $search_args );

					$max_num_pages = $deals_query->max_num_pages;

				?>

				<div class="col-sm-3">

					<div class="dataTables_length" id="posts_per_page">

						<?php

							$paged    = max( 1, get_query_var('paged') );
							$per_page = $posts_per_page;
							$total    = $deals_query->found_posts;
							$first    = ( $per_page * $paged ) - $per_page + 1;
							$last     = min( $total, $posts_per_page * $paged );

							if ( $total <= $per_page || -1 == $per_page ) {
								/* translators: %d: total results */
								printf( _n( 'Showing the single deal', 'Showing all %d deals', $total, 'cardojo' ), $total );
							} else {
								/* translators: 1: first result 2: last result 3: total results */
								printf( _nx( 'Showing the single deal', 'Showing %1$d to %2$d of %3$d', $total, 'with first and last deal', 'cardojo' ), $first, $last, $total );
							}

						?>

					</div>

				</div>

				<div class="col-sm-9">

					<div id="sample_1_filter" class="dataTables_filter">

						<input type="hidden" id="orderby" name="orderby" value="<?php echo esc_attr($orderby); ?>" />

						<?php if( !empty($start_date_query) AND !empty($end_date_query) ) { ?>

						<label><?php esc_html_e('Start', 'cardojo' ); ?> 

							<select name="start_date" aria-controls="sample_2" class="input-sm input-xsmall input-inline cardojo-deals-select-start-date">
								<option value="today" <?php if( $start_date == 'today' ) { echo "selected"; } ?>><?php esc_html_e('Today', 'cardojo' ); ?></option>
								<option value="yesterday" <?php if( $start_date == 'yesterday' ) { echo "selected"; } ?>><?php esc_html_e('Yesterday', 'cardojo' ); ?></option>
								<option value="7daysago" <?php if( $start_date == '7daysago' ) { echo "selected"; } ?>><?php esc_html_e('7 Days Ago', 'cardojo' ); ?></option>
								<option value="15daysago" <?php if( $start_date == '15daysago' ) { echo "selected"; } ?>><?php esc_html_e('15 Days Ago', 'cardojo' ); ?></option>
								<option value="30daysago" <?php if( $start_date == '30daysago' ) { echo "selected"; } ?>><?php esc_html_e('30 Days Ago', 'cardojo' ); ?></option>
								<option value="60daysago" <?php if( $start_date == '60daysago' ) { echo "selected"; } ?>><?php esc_html_e('60 Days Ago', 'cardojo' ); ?></option>
								<option value="90daysago" <?php if( $start_date == '90daysago' ) { echo "selected"; } ?>><?php esc_html_e('90 Days Ago', 'cardojo' ); ?></option>
								<option value="120daysago" <?php if( $start_date == '120daysago' ) { echo "selected"; } ?>><?php esc_html_e('120 Days Ago', 'cardojo' ); ?></option>
								<option value="1yearago" <?php if( $start_date == '1yearago' ) { echo "selected"; } ?>><?php esc_html_e('1 Year Ago', 'cardojo' ); ?></option>
							</select>

						</label>

						<label><?php esc_html_e('End', 'cardojo' ); ?> 

							<select name="end_date" aria-controls="sample_2" class="input-sm input-xsmall input-inline cardojo-deals-select-end-date">
								<option value="today" <?php if( $end_date == 'today' ) { echo "selected"; } ?>><?php esc_html_e('Today', 'cardojo' ); ?></option>
								<option value="yesterday" <?php if( $end_date == 'yesterday' ) { echo "selected"; } ?>><?php esc_html_e('Yesterday', 'cardojo' ); ?></option>
								<option value="7daysago" <?php if( $end_date == '7daysago' ) { echo "selected"; } ?>><?php esc_html_e('7 Days Ago', 'cardojo' ); ?></option>
								<option value="15daysago" <?php if( $end_date == '15daysago' ) { echo "selected"; } ?>><?php esc_html_e('15 Days Ago', 'cardojo' ); ?></option>
								<option value="30daysago" <?php if( $end_date == '30daysago' ) { echo "selected"; } ?>><?php esc_html_e('30 Days Ago', 'cardojo' ); ?></option>
								<option value="60daysago" <?php if( $end_date == '60daysago' ) { echo "selected"; } ?>><?php esc_html_e('60 Days Ago', 'cardojo' ); ?></option>
								<option value="90daysago" <?php if( $end_date == '90daysago' ) { echo "selected"; } ?>><?php esc_html_e('90 Days Ago', 'cardojo' ); ?></option>
								<option value="120daysago" <?php if( $end_date == '120daysago' ) { echo "selected"; } ?>><?php esc_html_e('120 Days Ago', 'cardojo' ); ?></option>
								<option value="1yearago" <?php if( $end_date == '1yearago' ) { echo "selected"; } ?>><?php esc_html_e('1 Year Ago', 'cardojo' ); ?></option>
							</select>

						</label>

						<?php } ?>

						<label><?php esc_html_e('Show', 'cardojo' ); ?> 

							<select name="posts_per_page" aria-controls="sample_1" class="input-sm input-xsmall input-inline cardojo-deals-select-ppp">
								<option value="10" <?php if( $posts_per_page == '10' ) { echo "selected"; } ?>>10</option>
								<option value="25" <?php if( $posts_per_page == '25' ) { echo "selected"; } ?>>25</option>
								<option value="50" <?php if( $posts_per_page == '50' ) { echo "selected"; } ?>>50</option>
								<option value="-1" <?php if( $posts_per_page == '-1' ) { echo "selected"; } ?>>All</option>
							</select>

						</label>
						
						<?php if($filter == "on") { ?>
							<?php if ( cardojo_get_permalink( 'deals' ) ) { ?>
							<a href="<?php echo esc_url(cardojo_get_permalink( 'deals' )); ?>" id="clear-deals-filter"><i class="fa fa-times" aria-hidden="true"></i></a>
							<?php } ?>
						<?php } ?>

						<div id="refresh-deals-filter">
							<i class="fa fa-refresh" aria-hidden="true"></i> <?php esc_html_e('Refresh', 'cardojo' ); ?>
						</div>

					</div>

				</div>

			</form>

		</div>

	</div>

	<table id="cardojo_deals_table" class="car-manager-cars table-hover" data-edit-url="<?php if ( ! cardojo_get_permalink( 'submit_deal_form' ) ) { echo "no-page"; } else { echo esc_url(cardojo_get_permalink( 'submit_deal_form' )); } ?>">
		<thead>
			<tr>
				<th class="hidden-sm hidden-xs deal-sorting-date <?php if($orderby == "date_asc"){ echo "sorting_asc"; } elseif($orderby == "date_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Date', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs deal-sorting-name <?php if($orderby == "name_asc"){ echo "sorting_asc"; } elseif($orderby == "name_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Name', 'cardojo' ); ?></th>
				<th class="visible-xs deal-sorting-name <?php if($orderby == "name_asc"){ echo "sorting_asc"; } elseif($orderby == "name_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Deal', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs text-center deal-sorting-sku <?php if($orderby == "sku_asc"){ echo "sorting_asc"; } elseif($orderby == "sku_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Sku', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs deal-sorting-vehicle-name <?php if($orderby == "vehicle_name_asc"){ echo "sorting_asc"; } elseif($orderby == "vehicle_name_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Vehicle', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs text-center deal-sorting-price <?php if($orderby == "price_asc"){ echo "sorting_asc"; } elseif($orderby == "price_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Price', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs text-center deal-sorting-profit <?php if($orderby == "profit_asc"){ echo "sorting_asc"; } elseif($orderby == "profit_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Profit', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs text-center deal-sorting-age <?php if($orderby == "age_asc"){ echo "sorting_asc"; } elseif($orderby == "age_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Days to Sell', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs text-center deal-sorting-next-payment <?php if($orderby == "next_payment_asc"){ echo "sorting_asc"; } elseif($orderby == "next_payment_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Next Payment', 'cardojo' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php 

				if ( ! $deals ) : 

			?>
				<tr>
					<td colspan="8"><?php esc_html_e( 'You do not have any deals.', 'cardojo' ); ?></td>
				</tr>
			<?php else : ?>
				<?php foreach ( $deals as $deal ) : ?>

					<?php 

						$deal_ID = $deal->ID; 

						$deal_sold_date = esc_attr(get_post_meta($deal_ID, 'deal_sold_date',true));
						$deal_loan_next_payments_date = esc_attr(get_post_meta($deal_ID, 'deal_loan_next_payments_date',true));
						$deal_first_name = esc_attr(get_post_meta($deal_ID, 'deal_first_name',true));
						$deal_last_name = esc_attr(get_post_meta($deal_ID, 'deal_last_name',true));

						$deal_vehicle_id = esc_attr(get_post_meta($deal_ID, 'deal_vehicle_id',true));
						$deal_vehicle_sku = esc_attr(get_post_meta($deal_vehicle_id, 'vehicle_stock',true));
						$deal_vehicle_year = esc_attr(get_post_meta($deal_vehicle_id, 'vehicle_year',true));
						$deal_vehicle_make = esc_attr(get_post_meta($deal_vehicle_id, 'vehicle_make_desc_init',true));
						$deal_vehicle_model = esc_attr(get_post_meta($deal_vehicle_id, 'vehicle_model',true));
						$deal_vehicle_trim = esc_attr(get_post_meta($deal_vehicle_id, 'vehicle_trim_desc_init',true));
						$vehicle_exterior_color = get_the_terms($deal_vehicle_id, 'vehicle_exterior_color' );
						$color              = cardojo_get_term_color( $vehicle_exterior_color[0]->term_id, true );
						$color_id           = $vehicle_exterior_color[0]->term_id;
						$deal_vehicle_color = $vehicle_exterior_color[0]->name;

						$price = esc_attr(get_post_meta($deal_ID, 'deal_vehicle_price',true));
						$cost = esc_attr(get_post_meta($deal_ID, 'deal_vehicle_cost',true));
						$profit = esc_attr(get_post_meta($deal_ID, 'deal_vehicle_profit',true));

						$age = esc_attr(get_post_meta($deal_ID, 'deal_vehicle_age',true));

						$today = strtotime("now");
						$payment_date_raw = strtotime($deal_loan_next_payments_date);

						if( !empty($payment_date_raw) && $payment_date_raw <= $today ) {
							$class = "cardojo_loan_payment_paid_faild";
						} else {
							$class = "";
						}

						if( $deal_loan_next_payments_date == "done" ) {
							$class = "cardojo_loan_payment_paid_done";
						}

						$deal_loan_payments_num = get_post_meta($deal_ID, 'deal_loan_payments_num',true);

					?>

					<tr class="listing-item" data-id="<?php echo esc_attr($deal_ID); ?>">

						<td class="hidden-sm hidden-xs">
							<?php echo date( get_option('date_format'), strtotime($deal_sold_date) ); ?>
						</td>

						<td class="hidden-xs">
							<?php echo esc_attr($deal_first_name); ?> <?php echo esc_attr($deal_last_name); ?>
						</td>

						<td class="visible-xs">
							<strong><?php echo esc_attr($deal_first_name); ?> <?php echo esc_attr($deal_last_name); ?></strong>
							<br><?php esc_html_e( 'Stock #', 'cardojo' ); ?>: <?php echo esc_attr($deal_vehicle_sku); ?>

							<br><?php esc_html_e( 'Vehicle', 'cardojo' ); ?>: <?php echo esc_attr($deal_vehicle_year); echo " "; echo esc_attr($deal_vehicle_make); echo " "; echo esc_attr($deal_vehicle_model); echo " "; echo esc_attr($deal_vehicle_trim);  echo " "; echo esc_attr($deal_vehicle_color);?>
							<br><?php esc_html_e( 'Sales Amount', 'cardojo' ); ?>: 
							<br><?php esc_html_e( 'Profit', 'cardojo' ); ?>: 
							<br><?php esc_html_e( 'Days to Sell', 'cardojo' ); ?>: 
							<br><?php esc_html_e( 'Next Payment', 'cardojo' ); ?>: <?php echo esc_attr($deal_loan_next_payments_date); ?>
						</td>

						<td class="hidden-sm hidden-xs text-center">
							<?php echo esc_attr($deal_vehicle_sku); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($deal_vehicle_year); echo " "; echo esc_attr($deal_vehicle_make); echo " <br>"; echo esc_attr($deal_vehicle_model); echo " "; echo esc_attr($deal_vehicle_trim); echo " "; echo esc_attr($deal_vehicle_color); ?>
						</td>

						<td class="hidden-sm hidden-xs text-center">
							<?php echo cardojo_clean_price($price); ?>
						</td>

						<td class="hidden-sm hidden-xs text-center">
							<?php echo cardojo_clean_price($profit); ?>
						</td>

						<td class="hidden-sm hidden-xs text-center">
							<?php echo round($age); ?>
						</td>

						<td class="hidden-sm hidden-xs text-center <?php echo esc_attr($class); ?>">
							<?php if( $deal_loan_next_payments_date == "done" ) { echo esc_html_e( 'Closed', 'cardojo' ); } else { echo esc_attr($deal_loan_next_payments_date); } ?>
						</td>

					</tr>

				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php get_cardojo_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
</div>
