<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$user_id = get_current_user_id();
	$posts_per_page = "10";
			        
	$search_args = array(
		'post_type'           => 'filter',
		'post_status'         => 'publish',
		'posts_per_page'      => $posts_per_page,
		'offset'              => ( max( 1, get_query_var('paged') ) - 1 ) * $posts_per_page,
		'orderby'             => 'date',
		'order'               => 'desc'
	);

	$filters_query = new WP_Query;
	$filters = $filters_query->query( $search_args );

	$max_num_pages = $filters_query->max_num_pages;

?>

<div id="cardojo-inventory">

	<div class="table-toolbar">

		<div class="row">

			<div class="col-sm-3">

				<div class="dataTables_length" id="posts_per_page">

					<?php

						$paged    = max( 1, get_query_var('paged') );
						$per_page = $posts_per_page;
						$total    = $filters_query->found_posts;
						$first    = ( $per_page * $paged ) - $per_page + 1;
						$last     = min( $total, $posts_per_page * $paged );

						if ( $total <= $per_page || -1 == $per_page ) {
							/* translators: %d: total results */
							printf( _n( 'Showing the single filter', 'Showing all %d filters', $total, 'cardojo' ), $total );
						} else {
							/* translators: 1: first result 2: last result 3: total results */
							printf( _nx( 'Showing the single filter', 'Showing %1$d to %2$d of %3$d', $total, 'with first and last filter', 'cardojo' ), $first, $last, $total );
						}

					?>

				</div>

			</div>

		</div>

	</div>

	<table id="cardojo_filters_table" class="car-manager-cars">
		<thead>
			<tr>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Date', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Name', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Email', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Phone', 'cardojo' ); ?></th>

				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Make', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Model', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Fuel Type', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Price', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Year', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Mileage', 'cardojo' ); ?></th>
				<th class="hidden-sm hidden-xs"><?php esc_html_e( 'Condition', 'cardojo' ); ?></th>
				
				<th class="visible-xs"><?php esc_html_e( 'Filter', 'cardojo' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php 

				if ( ! $filters ) : 

			?>
				<tr>
					<td colspan="9"><?php esc_html_e( 'There are no filters yet.', 'cardojo' ); ?></td>
				</tr>
			<?php else : ?>
				<?php foreach ( $filters as $filter ) : ?>

					<?php 

						$filter_ID = $filter->ID; 

						$post_filter_make = get_post_meta($filter_ID, 'filter_make',true);
				        $post_filter_model = get_post_meta($filter_ID, 'filter_model',true);
				        $post_filter_fuel_type = get_post_meta($filter_ID, 'filter_fuel_type',true);
				        $post_filter_price = get_post_meta($filter_ID, 'filter_price',true);
				        $post_filter_year = get_post_meta($filter_ID, 'filter_year',true);
				        $post_filter_mileage = get_post_meta($filter_ID, 'filter_mileage',true);
				        $post_filter_condition = get_post_meta($filter_ID, 'filter_condition',true);

				        $post_filter_email = get_post_meta($filter_ID, 'filter_email',true);
						$post_filter_user_id = get_post_meta($filter_ID, 'filter_user_id',true);

						$post_mobile_phone = esc_attr(get_post_meta($post_filter_user_id, 'lead_mobile_phone',true));

						$post_first_name = esc_attr(get_post_meta($post_filter_user_id, 'lead_first_name',true));
						$post_last_name = esc_attr(get_post_meta($post_filter_user_id, 'lead_last_name',true));

					?>

					<tr class="listing-item" data-id="<?php echo esc_attr($filter_ID); ?>">

						<td class="hidden-sm hidden-xs">
							<?php echo get_the_date( get_option('date_format'), $filter_ID ); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_first_name); ?> <?php echo esc_attr($post_last_name); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_filter_email); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_mobile_phone); ?>
						</td>

						<td class="hidden-xs">
							<?php echo esc_attr($post_filter_make); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_filter_model); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_filter_fuel_type); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_filter_price); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_filter_year); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php echo esc_attr($post_filter_mileage); ?>
						</td>

						<td class="hidden-sm hidden-xs">
							<?php if( empty($post_filter_condition)) { esc_html_e( 'Used', 'cardojo' ); } else { esc_html_e( 'New', 'cardojo' ); }; ?>
						</td>

						<td class="visible-xs">
							<br><?php esc_html_e( 'Date', 'cardojo' ); ?>: <?php echo get_the_date( get_option('date_format'), $filter_ID ); ?>
							<strong><?php echo esc_attr($post_first_name); ?> <?php echo esc_attr($post_last_name); ?></strong>
							<br><?php esc_html_e( 'Email', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_email); ?>
							<br><?php esc_html_e( 'Phone', 'cardojo' ); ?>: <?php echo esc_attr($post_mobile_phone); ?>
							<br><?php esc_html_e( 'Make', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_make); ?>
							<br><?php esc_html_e( 'Model', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_model); ?>
							<br><?php esc_html_e( 'Fuel Type', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_fuel_type); ?>
							<br><?php esc_html_e( 'Price', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_price); ?>
							<br><?php esc_html_e( 'Year', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_year); ?>
							<br><?php esc_html_e( 'Mileage', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_mileage); ?>
							<br><?php esc_html_e( 'Condition', 'cardojo' ); ?>: <?php echo esc_attr($post_filter_condition); ?>
						</td>

					</tr>

				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php get_cardojo_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
</div>
