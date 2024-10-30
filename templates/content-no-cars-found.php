<?php if ( defined( 'DOING_AJAX' ) ) : ?>
	<li class="no_car_listings_found"><?php _e( 'There are no listings matching your search.', 'cardojo' ); ?></li>
<?php else : ?>
	<p class="no_car_listings_found"><?php _e( 'There are currently no vacancies.', 'cardojo' ); ?></p>
<?php endif; ?>