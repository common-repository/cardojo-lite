<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$action_name = "";
	if ( isset( $_GET['action'] ) ) {
        $action_name = $_GET['action'];
    }

	$lead_ID = "";
	if ( isset( $_GET['lead_ID'] ) ) {
        $lead_ID = $_GET['lead_ID'];
    }

?>

<div id="cardojo-inventory">

	<div class="table-toolbar">

		<div class="row">

			<div class="col-sm-12">
				
				<?php if ( cardojo_get_permalink( 'submit_lead_form' ) ) { ?>
				
					<a id="cardojo_add_vehicle" href="<?php echo esc_url(cardojo_get_permalink( 'submit_lead_form' )); ?>" class="btn btn-default"><i class="fa fa-user-circle" aria-hidden="true"></i> <?php esc_html_e( 'Add Lead', 'cardojo' ) ?></a>

				<?php } ?>

			</div>

		</div>

		<div class="row cardojo-inventory-stats">

			<div class="col-md-3 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'New Leads & Ups', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_new_leads(); ?></span>

				</div>

			</div>

			<div class="col-md-3 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Leads & Ups', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_total_leads(); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Floor Ups', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_floor_leads(); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Internet Ups', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_internet_leads(); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Phone Ups', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_phone_leads(); ?></span>

				</div>

			</div>

		</div>

	</div>

	<div class="table-toolbar">

		<div class="row">

			<?php 

				$leads_url = "#";

				if ( cardojo_get_permalink( 'leads' ) ) { 

					$leads_url = cardojo_get_permalink( 'leads' );

				} 

			?>

			<form class="cardojo-leads-filter" action="<?php echo esc_url($leads_url); ?>" method="get">

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

			        	$search_args = apply_filters( 'cardojo_get_leads_args', array(
							'post_type'           => 'lead',
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

			        	$search_args = apply_filters( 'cardojo_get_leads_args', array(
							'post_type'           => 'lead',
							'post_status'         => 'publish',
							'posts_per_page'      => $posts_per_page,
							'offset'              => ( max( 1, get_query_var('paged') ) - 1 ) * $posts_per_page,
							'orderby'             => 'date',
							'order'               => 'desc',
							'author'              => get_current_user_id(),
						) );

			        }

					$search_args = apply_filters( 'cardojo_leads_search_parameters', $search_args );
					$leads_query = new WP_Query;
					$leads = $leads_query->query( $search_args );

					$max_num_pages = $leads_query->max_num_pages;

				?>

				<div class="col-sm-3">

					<div class="dataTables_length" id="posts_per_page">

						<?php

							$paged    = max( 1, get_query_var('paged') );
							$per_page = $posts_per_page;
							$total    = $leads_query->found_posts;
							$first    = ( $per_page * $paged ) - $per_page + 1;
							$last     = min( $total, $posts_per_page * $paged );

							if ( $total <= $per_page || -1 == $per_page ) {
								/* translators: %d: total results */
								printf( _n( 'Showing the single lead', 'Showing all %d leads', $total, 'cardojo' ), $total );
							} else {
								/* translators: 1: first result 2: last result 3: total results */
								printf( _nx( 'Showing the single lead', 'Showing %1$d to %2$d of %3$d', $total, 'with first and last lead', 'cardojo' ), $first, $last, $total );
							}

						?>

					</div>

				</div>

				<div class="col-sm-9">

					<div id="sample_1_filter" class="dataTables_filter">

						<input type="hidden" id="orderby" name="orderby" value="<?php echo esc_attr($orderby); ?>" />

						<?php  if( !empty($start_date_query) AND !empty($end_date_query) ) { ?>

						<label><?php esc_html_e('Start', 'cardojo' ); ?> 

							<select name="start_date" aria-controls="sample_2" class="input-sm input-xsmall input-inline cardojo-leads-select-start-date">
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

							<select name="end_date" aria-controls="sample_2" class="input-sm input-xsmall input-inline cardojo-leads-select-end-date">
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

							<select name="posts_per_page" aria-controls="sample_1" class="input-sm input-xsmall input-inline cardojo-leads-select-ppp">
								<option value="10" <?php if( $posts_per_page == '10' ) { echo "selected"; } ?>>10</option>
								<option value="25" <?php if( $posts_per_page == '25' ) { echo "selected"; } ?>>25</option>
								<option value="50" <?php if( $posts_per_page == '50' ) { echo "selected"; } ?>>50</option>
								<option value="-1" <?php if( $posts_per_page == '-1' ) { echo "selected"; } ?>>All</option>
							</select>

						</label>
						
						<?php if($filter == "on") { ?>
							<?php if ( cardojo_get_permalink( 'leads' ) ) { ?>
							<a href="<?php echo esc_url(cardojo_get_permalink( 'leads' )); ?>" id="clear-leads-filter"><i class="fa fa-times" aria-hidden="true"></i></a>
							<?php } ?>
						<?php } ?>

						<div id="refresh-leads-filter">
							<i class="fa fa-refresh" aria-hidden="true"></i> <?php esc_html_e('Refresh', 'cardojo' ); ?>
						</div>

					</div>

				</div>

			</form>

		</div>

	</div>

	<table id="cardojo_leads_table" class="car-manager-cars table-hover" data-edit-url="<?php if ( ! cardojo_get_permalink( 'submit_lead_form' ) ) { echo "no-page"; } else { echo esc_url(cardojo_get_permalink( 'submit_lead_form' )); } ?>">
		<thead>
			<tr>
				<th class="hidden-sm hidden-xs lead-sorting-date <?php if($orderby == "date_asc"){ echo "sorting_asc"; } elseif($orderby == "date_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Date', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-name <?php if($orderby == "name_asc"){ echo "sorting_asc"; } elseif($orderby == "name_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Name', 'cardojo' ); ?></th>
				<th class="visible-xs lead-sorting-name <?php if($orderby == "name_asc"){ echo "sorting_asc"; } elseif($orderby == "name_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Lead', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-sku <?php if($orderby == "sku_asc"){ echo "sorting_asc"; } elseif($orderby == "sku_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Stock #', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-status <?php if($orderby == "status_asc"){ echo "sorting_asc"; } elseif($orderby == "status_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Status', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-uptype <?php if($orderby == "uptype_asc"){ echo "sorting_asc"; } elseif($orderby == "uptype_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Up Type', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-adsource <?php if($orderby == "adsource_asc"){ echo "sorting_asc"; } elseif($orderby == "adsource_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Ad Source', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-websiteleadtype <?php if($orderby == "webleadtype_asc"){ echo "sorting_asc"; } elseif($orderby == "webleadtype_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Website Lead Type', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-appointment <?php if($orderby == "appointment_asc"){ echo "sorting_asc"; } elseif($orderby == "appointment_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Appointment', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs lead-sorting-phone <?php if($orderby == "phone_asc"){ echo "sorting_asc"; } elseif($orderby == "phone_desc") { echo "sorting_desc"; } else { echo "sorting"; } ?>"><?php esc_html_e( 'Phone', 'cardojo' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php 

				if ( ! $leads ) : 

			?>
				<tr>
					<td colspan="9"><?php esc_html_e( 'You do not have any leads.', 'cardojo' ); ?></td>
				</tr>
			<?php else : ?>
				<?php foreach ( $leads as $lead ) : ?>

					<?php 

						$lead_ID = $lead->ID; 

						$lead_first_name = esc_attr(get_post_meta($lead_ID, 'lead_first_name',true));
						$lead_last_name = esc_attr(get_post_meta($lead_ID, 'lead_last_name',true));
						$lead_vehicle_id = esc_attr(get_post_meta($lead_ID, 'lead_vehicle_id',true));
						$lead_vehicle_sku = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_stock',true));
						$lead_status = get_the_terms($lead_ID, 'lead_status' );
						$lead_uptype = get_the_terms($lead_ID, 'lead_up_type' );
						$lead_adsource = get_the_terms($lead_ID, 'lead_ad_source' );
						$lead_webleadtype = esc_attr(get_post_meta($lead_ID, 'lead_website_lead_type',true));
						$lead_appointment_date = esc_attr(get_post_meta($lead_ID, 'lead_appointment_date',true));
						$lead_appointment_time = esc_attr(get_post_meta($lead_ID, 'lead_appointment_time',true));
						$lead_mobile_phone = esc_attr(get_post_meta($lead_ID, 'lead_mobile_phone',true));
						$lead_vehicle_sku_own = esc_attr(get_post_meta($lead_ID, 'lead_vehicle_sku',true));

						$lead_appointment_strtotime = esc_attr(get_post_meta($lead_ID, 'lead_appointment_strtotime',true));

					?>

					<tr class="listing-item" data-id="<?php echo esc_attr($lead_ID); ?>">

						<td class="hidden-sm hidden-xs">
							<?php echo get_the_date( get_option('date_format'), $lead_ID ); ?>
						</td>

						<td class="hidden-xs">
							<?php echo esc_attr($lead_first_name); ?> <?php echo esc_attr($lead_last_name); ?>
						</td>

						<td class="visible-xs">
							<strong><?php echo esc_attr($lead_first_name); ?> <?php echo esc_attr($lead_last_name); ?></strong>
							<br><?php esc_html_e( 'Stock #', 'cardojo' ); ?>: <?php echo esc_attr($lead_vehicle_sku); ?>
							<br><?php esc_html_e( 'Status', 'cardojo' ); ?>: <?php if(!empty($lead_status[0])) { echo esc_attr($lead_status[0]->name); } ?>
							<br><?php esc_html_e( 'Up Type', 'cardojo' ); ?>: <?php if(!empty($lead_uptype[0])) { echo esc_attr($lead_uptype[0]->name); } ?>
							<br><?php esc_html_e( 'Ad Source', 'cardojo' ); ?>: <?php if(!empty($lead_adsource[0])) { echo esc_attr($lead_adsource[0]->name); } ?>
							<br><?php esc_html_e( 'Phone', 'cardojo' ); ?>: <?php echo esc_attr($lead_mobile_phone); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($lead_vehicle_sku); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php if(!empty($lead_status[0])) { echo esc_attr($lead_status[0]->name); } ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php if(!empty($lead_uptype[0])) { echo esc_attr($lead_uptype[0]->name); } ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php if(!empty($lead_adsource[0])) { echo esc_attr($lead_adsource[0]->name); } ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($lead_webleadtype); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($lead_appointment_date); ?> <?php echo esc_attr($lead_appointment_time); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($lead_mobile_phone); ?>
						</td>

					</tr>

				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php get_cardojo_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
</div>
