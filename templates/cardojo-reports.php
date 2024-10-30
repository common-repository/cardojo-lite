<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div id="cardojo-reports">
	
	<div class="table-toolbar">

		<div class="options_group">

			<div class="row">

				<div class="col-md-12">

					<ul class="caredojo_sales_reports_nav">
						<li class="caredojo_sales_reports_nav_item active" data-id="reports_sales_by_month"><?php esc_html_e('Sales by Month', 'cardojo' ); ?></li>
						<li class="caredojo_sales_reports_nav_item" data-id="reports_sales_by_year"><?php esc_html_e('Sales by Year', 'cardojo' ); ?></li>
						<li class="caredojo_sales_reports_nav_item" data-id="reports_sales_by_make"><?php esc_html_e('Sales by Make', 'cardojo' ); ?></li>
						<li class="caredojo_sales_reports_nav_item" data-id="reports_sales_by_model"><?php esc_html_e('Sales by Model', 'cardojo' ); ?></li>
						<li class="caredojo_sales_reports_nav_item" data-id="reports_sales_by_trim"><?php esc_html_e('Sales by Trim', 'cardojo' ); ?></li>
					</ul>

					<div class="caredojo_sales_reports_container active" id="reports_sales_by_month">

						<table class="cardojo_sales_reports car-manager-cars">

							<thead>
								<tr>
									<th class="text-center"><?php esc_html_e( 'Month/Year', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Vehicles Sold', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Average Profit', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Total Profit', 'cardojo' ); ?></th>
								</tr>
							</thead>

							<tbody>

								<?php 

									$start = strtotime(date("Y-m")); 
								    $startmoyr = date('Y', $start) . date('m', $start);
								    $end_date = cardojo_get_first_deal_date();
								    $end = strtotime($end_date);
								    $endmoyr = date('Y', $end) . date('m', $end);

								    while ($startmoyr >= $endmoyr) {

								    	$results = cardojo_get_total_sales_by_month_extended( date('m', $start), date('Y', $start) );

								    	$sales = $results['sales'];
								    	$total_profit = $results['total_profit'];
								    	if( $sales > 0 ) {
								    		$avg_profit = $total_profit / $sales;
								    	} else {
								    		$avg_profit = 0;
								    	}

								    	?>

										<tr>
											<td class="text-center"><?php echo date('F', $start); ?> <?php echo date('Y', $start); ?></td>
											<td class="text-center"><?php echo esc_attr($sales); ?></td>
											<td class="text-center"><?php echo cardojo_clean_price($avg_profit); ?></td>
											<td class="text-center"><?php echo cardojo_clean_price($total_profit); ?></td>
										</tr>

								    	<?php

								        $start = strtotime("-1month", $start);
								        $startmoyr = date('Y', $start) . date('m', $start);
								    }

								?>

							</tbody>

						</table>

					</div>

					<div class="caredojo_sales_reports_container" id="reports_sales_by_year">

						<table class="cardojo_sales_reports car-manager-cars">

							<thead>
								<tr>
									<th class="text-center"><?php esc_html_e( 'Year', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Vehicles Sold', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Average Profit', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Total Profit', 'cardojo' ); ?></th>
								</tr>
							</thead>

							<tbody>

								<?php 

									$start = strtotime(date("Y")); 
								    $startmoyr = date('Y', $start);
								    $end_date = cardojo_get_first_deal_date();
								    $end = strtotime($end_date);
								    $endmoyr = date('Y', $end);

								    while ($startmoyr >= $endmoyr) {

								    	$results = cardojo_get_total_sales_by_year_extended( date('Y', $start) );

								    	$sales = $results['sales'];
								    	$total_profit = $results['total_profit'];
								    	if( $sales != 0 ) {
								    		$avg_profit = $total_profit / $sales;
								    	} else {
								    		$avg_profit = $total_profit;
								    	}

								    	?>

										<tr>
											<td class="text-center"><?php echo date('Y', $start); ?></td>
											<td class="text-center"><?php echo esc_attr($sales); ?></td>
											<td class="text-center"><?php echo cardojo_clean_price($avg_profit); ?></td>
											<td class="text-center"><?php echo cardojo_clean_price($total_profit); ?></td>
										</tr>

								    	<?php

								        $start = strtotime("-1year", $start);
								        $startmoyr = date('Y', $start);
								    }

								?>

							</tbody>

						</table>

					</div>

					<div class="caredojo_sales_reports_container" id="reports_sales_by_make">

						<table class="cardojo_sales_reports car-manager-cars">

							<thead>
								<tr>
									<th class="text-center"><?php esc_html_e( 'Vehicle', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Vehicles Sold', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Avg. Days to Sell', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Average Profit', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Total Profit', 'cardojo' ); ?></th>
								</tr>
							</thead>

							<tbody>

								<?php 

									$total_cars_by_make = cardojo_get_total_sales_by_make();

									if( !empty($total_cars_by_make) ) {

										$total = count($total_cars_by_make);

										for( $i = 1; $i <= $total; ++$i ){

						    	?>

									<tr>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['make']); ?></td>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['amount']); ?></td>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['age']); ?></td>
										<td class="text-center"><?php echo cardojo_clean_price($total_cars_by_make[$i]['avg_profit']); ?></td>
										<td class="text-center"><?php echo cardojo_clean_price($total_cars_by_make[$i]['total_profit']); ?></td>
									</tr>

							    <?php

										}

							    	}

								?>

							</tbody>

						</table>

					</div>

					<div class="caredojo_sales_reports_container" id="reports_sales_by_model">

						<table class="cardojo_sales_reports car-manager-cars">

							<thead>
								<tr>
									<th class="text-center"><?php esc_html_e( 'Vehicle', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Vehicles Sold', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Avg. Days to Sell', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Average Profit', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Total Profit', 'cardojo' ); ?></th>
								</tr>
							</thead>

							<tbody>

								<?php 

									$total_cars_by_make = cardojo_get_total_sales_by_model();

									if( !empty($total_cars_by_make) ) {

										$total = count($total_cars_by_make);

										for( $i = 1; $i <= $total; ++$i ){

						    	?>

									<tr>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['make']); ?></td>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['amount']); ?></td>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['age']); ?></td>
										<td class="text-center"><?php echo cardojo_clean_price($total_cars_by_make[$i]['avg_profit']); ?></td>
										<td class="text-center"><?php echo cardojo_clean_price($total_cars_by_make[$i]['total_profit']); ?></td>
									</tr>

							    <?php

										}

							    	}

								?>

							</tbody>

						</table>

					</div>

					<div class="caredojo_sales_reports_container" id="reports_sales_by_trim">

						<table class="cardojo_sales_reports car-manager-cars">

							<thead>
								<tr>
									<th class="text-center"><?php esc_html_e( 'Vehicle', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Vehicles Sold', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Avg. Days to Sell', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Average Profit', 'cardojo' ); ?></th>
									<th class="text-center"><?php esc_html_e( 'Total Profit', 'cardojo' ); ?></th>
								</tr>
							</thead>

							<tbody>

								<?php 

									$total_cars_by_make = cardojo_get_total_sales_by_trim();

									if( !empty($total_cars_by_make) ) {

										$total = count($total_cars_by_make);

										for( $i = 1; $i <= $total; ++$i ){

						    	?>

									<tr>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['make']); ?></td>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['amount']); ?></td>
										<td class="text-center"><?php echo esc_attr($total_cars_by_make[$i]['age']); ?></td>
										<td class="text-center"><?php echo cardojo_clean_price($total_cars_by_make[$i]['avg_profit']); ?></td>
										<td class="text-center"><?php echo cardojo_clean_price($total_cars_by_make[$i]['total_profit']); ?></td>
									</tr>

							    <?php

										}

							    	}

								?>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>
