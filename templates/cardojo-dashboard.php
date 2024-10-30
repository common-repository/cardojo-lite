<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div id="cardojo-dashboard">
	
	<div class="table-toolbar">

		<div class="row">

			<div class="col-sm-12">
				
				<?php if ( cardojo_get_permalink( 'submit_deal_form' ) ) { ?>
				
					<a id="cardojo_add_vehicle" href="<?php echo esc_url(cardojo_get_permalink( 'submit_deal_form' )); ?>" class="btn btn-default"><i class="fa fa-usd" aria-hidden="true"></i> <?php esc_html_e( 'Add Deal', 'cardojo' ) ?></a>

				<?php } ?>

				<?php if ( cardojo_get_permalink( 'submit_lead_form' ) ) { ?>
				
					<a id="cardojo_add_lead" href="<?php echo esc_url(cardojo_get_permalink( 'submit_lead_form' )); ?>" class="btn btn-default"><i class="fa fa-user-circle" aria-hidden="true"></i> <?php esc_html_e( 'Add Lead', 'cardojo' ) ?></a>

				<?php } ?>

				<?php if ( cardojo_get_permalink( 'submit_car_form' ) ) { ?>
				
					<a id="cardojo_add_deal" href="<?php echo esc_url(cardojo_get_permalink( 'submit_car_form' )); ?>" class="btn btn-default"><i class="fa fa-car" aria-hidden="true"></i> <?php esc_html_e( 'Add Vehicle', 'cardojo' ) ?></a>

				<?php } ?>

			</div>

		</div>

		<div class="row cardojo-inventory-stats">

			<div class="col-md-2 col-sm-4">

				<?php

					$leads_url = "";

					if ( cardojo_get_permalink( 'leads' ) ) {

						$leads_url = esc_url(cardojo_get_permalink( 'leads' ));

					}

					$new_leads = cardojo_get_new_leads();

					if($new_leads == 0) {

				?>

				<div class="cardojo-inventory-stats-block <?php if(!empty($leads_url)) { echo "cardojo-stats-has-url"; } ?>" <?php if(!empty($leads_url)) { echo "data-url=" . $leads_url; } ?>>

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Leads', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_total_leads(); ?></span>

				</div>

				<?php } else { ?>

				<div class="cardojo-inventory-stats-block <?php if(!empty($leads_url)) { echo "cardojo-stats-has-url"; } ?> cardojo-new-leads" <?php if(!empty($leads_url)) { echo "data-url=" . $leads_url; } ?>>

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'New Leads & Ups', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo esc_attr($new_leads); ?></span>

				</div>

				<?php } ?>

			</div>

			<div class="col-md-2 col-sm-4">

				<?php

					$vehicles_url = "";

					if ( cardojo_get_permalink( 'inventory' ) ) {

						$vehicles_url = esc_url(cardojo_get_permalink( 'inventory' ));

					}

				?>

				<div class="cardojo-inventory-stats-block <?php if(!empty($vehicles_url)) { echo "cardojo-stats-has-url"; } ?>" <?php if(!empty($vehicles_url)) { echo "data-url=" . $vehicles_url; } ?>>

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Vehicles', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_total_cars(); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<?php

					$deals_url = "";

					if ( cardojo_get_permalink( 'deals' ) ) {

						$deals_url = esc_url(cardojo_get_permalink( 'deals' ));

					}

				?>

				<div class="cardojo-inventory-stats-block <?php if(!empty($deals_url)) { echo "cardojo-stats-has-url"; } ?>" <?php if(!empty($deals_url)) { echo "data-url=" . $deals_url; } ?>>

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Deals', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_get_total_deals(); ?></span>

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

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Total Cost', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_clean_price(cardojo_get_total_cost()); ?></span>

				</div>

			</div>

			<div class="col-md-2 col-sm-4">

				<div class="cardojo-inventory-stats-block cardojo-green-background">

					<span class="cardojo-inventory-stats-block-title"><?php esc_html_e( 'Potential Profit', 'cardojo' ) ?></span>
					<span class="cardojo-inventory-stats-block-value" class="overviewText"><?php echo cardojo_clean_price(cardojo_get_potential_profit()); ?></span>

				</div>

			</div>

		</div>

		<?php

			$search_args = array(
				'post_type'           => 'lead',
				'posts_per_page'      => -1,
				'post_status'         => array( 'publish' ),
				'author'              => get_current_user_id()
			) ;

			$leads_query = new WP_Query;
			$leads = $leads_query->query( $search_args );

			$current = 0;
			$leads_array = array();

			if ( $leads ) : 

				foreach ( $leads as $lead ) :

					$lead_ID = $lead->ID; 

					$lead_first_name = esc_attr(get_post_meta($lead_ID, 'lead_first_name',true));
					$lead_last_name = esc_attr(get_post_meta($lead_ID, 'lead_last_name',true));

					$lead_vehicle_id = esc_attr(get_post_meta($lead_ID, 'lead_vehicle_id',true));
					$vehicle_year = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_year',true));
					$vehicle_model = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_model',true));
					$vehicle_trim_desc_init = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_trim_desc_init',true));
					$vehicle_make_desc_init = esc_attr(get_post_meta($lead_vehicle_id, 'vehicle_make_desc_init',true));

					$vehicle_name = $vehicle_year . " " . $vehicle_make_desc_init . " " . $vehicle_model . " " . $vehicle_trim_desc_init;

					$lead_mobile_phone = esc_attr(get_post_meta($lead_ID, 'lead_mobile_phone',true));

					$lead_appointment_strtotime = esc_attr(get_post_meta($lead_ID, 'lead_appointment_strtotime',true));
					$now = strtotime(date("Y-m-d H:i:s")); 

					if( !empty($lead_appointment_strtotime) AND ($lead_appointment_strtotime > $now) ) {

						$current++;
						$leads_array[$current]['id'] = $lead_ID;
						$leads_array[$current]['first_name'] = $lead_first_name;
						$leads_array[$current]['last_name'] = $lead_last_name;
						$leads_array[$current]['vehicle_name'] = $vehicle_name;
						$leads_array[$current]['phone'] = $lead_mobile_phone;
						$leads_array[$current]['date'] = $lead_appointment_strtotime;

					}

				endforeach;

			endif;

			if( $current > 0) {

		?>

		<div class="options_group">

			<div class="row">

				<div class="col-md-12">

					<h2 class="options_group_heading"><?php esc_html_e('Appointments', 'cardojo' ); ?></h2>

					<table id="cardojo_lead_appointments_table" class="car-manager-cars table-hover" data-edit-url="<?php if ( ! cardojo_get_permalink( 'submit_lead_form' ) ) { echo "no-page"; } else { echo esc_url(cardojo_get_permalink( 'submit_lead_form' )); } ?>">

						<thead>
							<tr>
								<th class="text-center"><?php esc_html_e( 'Name', 'cardojo' ); ?></th>
								<th><?php esc_html_e( 'Vehicle', 'cardojo' ); ?></th>
								<th class="text-center"><?php esc_html_e( 'Phone', 'cardojo' ); ?></th>
								<th class="text-center"><?php esc_html_e( 'Date', 'cardojo' ); ?></th>
							</tr>
						</thead>

						<tbody>

						<?php

						for( $i = 1; $i <= $current; ++$i ){

							?>

							<tr data-id="<?php echo esc_attr($leads_array[$i]['id']); ?>">
								<td class="text-center"><?php echo esc_attr($leads_array[$i]['first_name']); ?> <?php echo esc_attr($leads_array[$i]['last_name']); ?></td>
								<td><?php echo wp_kses($leads_array[$i]['vehicle_name'], true); ?></td>
								<td class="text-center"><?php echo esc_attr($leads_array[$i]['phone']); ?></td>
								<td class="text-center"><?php echo date( 'Y-m-d h:i A', $leads_array[$i]['date'] ); ?></td>
							</tr>

							<?php

						}

						?>

						</tbody>

					</table>

				</div>

			</div>

		</div>

		<?php } ?>

		<div class="row">

			<div class="col-md-6">

				<div class="options_group">

					<h2 class="options_group_heading heading_with_border"><?php esc_html_e('Sales', 'cardojo' ); ?> <?php $current_year = date('Y'); echo esc_attr($current_year); ?></h2>

					<div id="myChart" class="bar-chart"></div>

					<script type="text/javascript">

						(function( $ ) {
							'use strict';

							jQuery("document").ready(function(){
	    				
			    				google.charts.load('current', {'packages':['bar']});
						      	google.charts.setOnLoadCallback(drawChart);

						      	function drawChart() {
						        
							        var data = google.visualization.arrayToDataTable([
							          // ['Month', 'Orders', 'Customers'],
							          ['Month', 'Sales'],
							          ['<?php esc_html_e('Jan.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "01" ); ?>],
							          ['<?php esc_html_e('Feb.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "02" ); ?>],
							          ['<?php esc_html_e('Mar.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "03" ); ?>],
							          ['<?php esc_html_e('Apr.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "04" ); ?>],
							          ['<?php esc_html_e('May', 'cardojo' ); ?>',      <?php echo cardojo_get_total_sales_by_month( "05" ); ?>],
							          ['<?php esc_html_e('Jun.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "06" ); ?>],
							          ['<?php esc_html_e('Jul.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "07" ); ?>],
							          ['<?php esc_html_e('Aug.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "08" ); ?>],
							          ['<?php esc_html_e('Sep.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "09" ); ?>],
							          ['<?php esc_html_e('Oct.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "10" ); ?>],
							          ['<?php esc_html_e('Nov.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "11" ); ?>],
							          ['<?php esc_html_e('Dec.', 'cardojo' ); ?>',     <?php echo cardojo_get_total_sales_by_month( "12" ); ?>]
							        ]);

							        var options = {
							          bars: 'vertical',
							          vAxis: {format: 'decimal'},
							          height: 320,
							          margin: 0,
							          bar: {groupWidth: 30},
							          colors: ['#d5effb', '#7cb8ee']
							        };

							        var chart = new google.charts.Bar(document.getElementById('myChart'));
							        chart.draw(data, google.charts.Bar.convertOptions(options));

						      	}

						    });
							///// end document ready /////

						})( jQuery );

		    		</script>

				</div>

			</div>

			<?php 

				$total_cars_by_make = cardojo_get_total_cars_by_make();

				if( !empty($total_cars_by_make) ) {

					$total = count($total_cars_by_make);

			?>

			<div class="col-md-6">

				<div class="options_group">

					<h2 class="options_group_heading heading_with_border"><?php esc_html_e('Inventory', 'cardojo' ); ?></h2>

					<div id="piechart"></div>

					<script type="text/javascript">

						(function( $ ) {
							'use strict';

							jQuery("document").ready(function(){
	    				
			    				google.charts.load('current', {'packages':['corechart']});
						      	google.charts.setOnLoadCallback(drawPie);

						      	function drawPie() {

							        var data = google.visualization.arrayToDataTable([
						          		['<?php esc_html_e('Make', 'cardojo' ); ?>',        '<?php esc_html_e('Amount', 'cardojo' ); ?>'],
						          		<?php

						          			for( $i = 1; $i <= $total; ++$i ){

						          				?>
						          				['<?php echo esc_attr($total_cars_by_make[$i]['make']); ?>', <?php echo esc_attr($total_cars_by_make[$i]['amount']); ?>],
						          				<?php

						          			}

						          		?>
							        ]);

							        var options = {
							          	colors: [
							          		<?php

							          			for( $i = 1; $i <= $total; ++$i ){

							          				$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    												$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
							          				//$color = dechex(rand(0x000000, 0xFFFFFF));
							          				echo "'".$color."',";

							          			}

							          		?>
							          		],
							          	height: 320,
							          	is3D: true
							        };

							        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
							        chart.draw(data, options);

						    	}

						    });
							///// end document ready /////

						})( jQuery );

		    		</script>

		    	</div>

			</div>

			<?php } ?>

			<div class="col-md-12">

				<div class="options_group">

					<h2 class="options_group_heading heading_with_border"><?php esc_html_e('Views', 'cardojo' ); ?></h2>

					<div id="myViews" style="width: 100%; height: 700px;"></div>

					<script type="text/javascript">

						(function( $ ) {
							'use strict';

							jQuery("document").ready(function(){
	    				
			    				google.charts.load('current', {'packages':['bar']});
      							google.charts.setOnLoadCallback(drawStuff);

						      	function drawStuff() {
							      	var data = new google.visualization.arrayToDataTable([
								        ['<?php esc_html_e('Vehicles', 'cardojo' ); ?>', '<?php esc_html_e('Views', 'cardojo' ); ?>'],

								        <?php

								        	$search_args = apply_filters( 'cardojo_get_inventory_cars_args', array(
												'post_type'           => 'vehicle',
												'post_status'         => 'publish',
												'posts_per_page'      => '20',
												'orderby'             => 'meta_value_num',
												'meta_key'            => 'post_views_count',
												'order'               => 'DESC',
												'ignore_sticky_posts' => 1,
												'author'              => get_current_user_id()

											) );

											$search_args = apply_filters( 'cardojo_search_filter_parameters', $search_args );
											$cars_query = new WP_Query;
											$cars = $cars_query->query( $search_args );

											foreach ( $cars as $car ) {

												$car_ID = $car->ID; 

												$vehicle_year = esc_attr(get_post_meta($car_ID, 'vehicle_year',true));
												$vehicle_make = esc_attr(get_post_meta($car_ID, 'vehicle_make',true));
												$vehicle_model = esc_attr(get_post_meta($car_ID, 'vehicle_model',true));
												$vehicle_trim_desc_init = esc_attr(get_post_meta($car_ID, 'vehicle_trim_desc_init',true));
												$vehicle_make_desc_init = esc_attr(get_post_meta($car_ID, 'vehicle_make_desc_init',true));
												$vehicle_stock = esc_attr(get_post_meta($car_ID, 'vehicle_stock',true));
												$vehicle_vin = esc_attr(get_post_meta($car_ID, 'vehicle_vin',true));

												$vehicle_full_name = $vehicle_year . " " . $vehicle_make_desc_init . " " . $vehicle_model . " " . $vehicle_trim_desc_init . " " . $vehicle_stock;

												echo "['" . $vehicle_full_name . "', " . cardojo_getPostViews($car_ID) . "],";
											}

								        ?>
							      	]);

							      	var options = {
							          	width: '100%',
							          	legend: { position: 'none' },
							          	bars: 'horizontal', // Required for Material Bar Charts.
							          	axes: {
							            	x: {
							              		0: { side: 'top', label: '<?php esc_html_e('Views', 'cardojo' ); ?>'} // Top x-axis.
							            	}
							          	},
							          	bar: { groupWidth: "100%" }
							        };

							      	var chart = new google.charts.Bar(document.getElementById('myViews'));
        							chart.draw(data, options);
    							}

						    });
							///// end document ready /////

						})( jQuery );

		    		</script>

				</div>

			</div>

		</div>

	</div>

</div>
