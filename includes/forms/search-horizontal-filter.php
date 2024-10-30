<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cardojo_horizontal_search_filter( $shortcode_filter ) { ?>

	<?php

		$page_url = "";

		if( isset($shortcode_filter) AND $shortcode_filter == 1 ) {

			$page_url = cardojo_get_permalink( 'cars' );

		} else {

			$page_url = get_permalink();

		}

		// Enqueue styles
		wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_style( 'bootstrap-select' );

		// Enqueue scripts
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'time-picker' );
		wp_enqueue_script( 'bootstrap-select' );

		$results_status = 0;

		$make = "0";
		if ( isset( $_GET['make'] ) ) {

	        $make = $_GET['make'];

	        if($make != "0" ) {
	        	$results_status = 1;
	        }

	    }

	    $model = "0";
		if ( isset( $_GET['model'] ) ) {

	        $model = $_GET['model'];

	        if( $model != "0" ) {
	        	$results_status = 1;
	        }

	    }

	    $fuel_type = "";
		if ( isset( $_GET['fuel_type'] ) ) {

	        $fuel_type = $_GET['fuel_type'];

	        if( $fuel_type != "0" ) {
	        	$results_status = 1;
	        }

	    }

	    $price_max = cardojo_get_max_price();
	    $price = $price_max;
		if ( isset( $_GET['price'] ) ) {

	        $price = $_GET['price'];

	        if( $price != $price_max ) {
	        	$results_status = 1;
	        }

	    }

	    $vehicle_min_year = cardojo_get_min_year();
	    $vehicle_year = $vehicle_min_year;
		if ( isset( $_GET['vehicle_year'] ) ) {

	        $vehicle_year = $_GET['vehicle_year'];

	        if( $vehicle_year != $vehicle_min_year ) {
	        	$results_status = 1;
	        }

	    }

	    $vehicle_condition = "";
		if ( isset( $_GET['vehicle_condition'] ) ) {

	        $vehicle_condition = $_GET['vehicle_condition'];
	        $results_status = 1;

	    }

	    $mileage_max = cardojo_get_max_mileage();
	    $mileage = $mileage_max;
		if ( isset( $_GET['mileage'] ) ) {

	        $mileage = $_GET['mileage'];
	        $mileage = trim($mileage, 'K');
	        
	        if( ( $mileage * 1000 ) != $mileage_max ) {
	        	$results_status = 1;
	        }

	    }

	    if( !empty($page_url)) {

	?>

	<div class="row"> 
	
		<form id="cardojo-advance-search-form" class="cardojo-horizontal-car-filter" action="<?php echo esc_url($page_url); ?>" method="get">
		
			<div class="col-sm-6 col-md-4 col-lg-3"> 

				<div class="form-group"> 

					<label for="cd-carmake"><?php esc_html_e('Make', 'cardojo' ); ?></label> 
					<select id="make" name="make" class="selectpicker" data-show-subtext="true" data-live-search="true" style="display: none;">
						<option value="0" <?php selected( 0, $make ); ?>><?php esc_html_e('Any', 'cardojo' ); ?></option>
						<?php 

							$total_cars_by_make = cardojo_get_total_makes_and_models();

							if( !empty($total_cars_by_make) ) {

								$total = count($total_cars_by_make);

								for( $i = 1; $i <= $total; ++$i ){

				    	?>
						<option value="<?php echo esc_attr($total_cars_by_make[$i]['make_clean']); ?>" <?php selected( $total_cars_by_make[$i]['make_clean'], $make ); ?>><?php echo esc_attr($total_cars_by_make[$i]['make']); ?></option>
						<?php

								}

					    	}

						?>
					</select>

					<script>
	              		jQuery("document").ready(function(){

							// object literal holding data for option elements
							var Select_List_Data = {
							    
							    'model': { // name of associated select box
							        
							        // names match option values in controlling select box
							        <?php 

										$total_cars_by_make = cardojo_get_total_makes_and_models();

										if( !empty($total_cars_by_make) ) {

											$total = count($total_cars_by_make);

											for( $i = 1; $i <= $total; ++$i ){

							    	?>'<?php echo esc_attr($total_cars_by_make[$i]['make_clean']); ?>': {
							        	text: [<?php 

													if( !empty($total_cars_by_make[$i]['model']) ) {

														$total_models = count($total_cars_by_make[$i]['model']);

														for( $j = 0; $j <= $total_models; ++$j ){

															if(!empty($total_cars_by_make[$i]['model'][$j])) {

										    	?>'<?php echo esc_attr($total_cars_by_make[$i]['model'][$j]); ?>',<?php
						            						}

														}

											    	}

												?>]
							        },
							       <?php

											}

								    	}

									?>
							    
							    }    
							};

							// removes all option elements in select box 
							// removeGrp (optional) boolean to remove optgroups
							function removeAllOptions(sel, removeGrp) {
							    var len, groups, par;
							    if (removeGrp) {
							        groups = sel.getElementsByTagName('optgroup');
							        len = groups.length;
							        for (var i=len; i; i--) {
							            sel.removeChild( groups[i-1] );
							        }
							    }
							    
							    len = sel.options.length;
							    for (var i=len; i; i--) {
							        par = sel.options[i-1].parentNode;
							        par.removeChild( sel.options[i-1] );
							    }
							}

							function appendDataToSelect(sel, obj) {

							    var f = document.createDocumentFragment();
							    var labels = [], group, opts;

							    if(obj != '0') {
							    
								    function addOptions(obj) {
								        var f = document.createDocumentFragment();
								        var o;

								        o = document.createElement('option');
							            o.appendChild( document.createTextNode( '<?php esc_html_e('Any', 'cardojo' ); ?>' ) );
							            o.value = '0';
								        f.appendChild(o);
								        
								        for (var i=0, len=obj.text.length; i<len; i++) {
								            o = document.createElement('option');
								            o.appendChild( document.createTextNode( obj.text[i] ) );
								            
								            o.value = obj.text[i];

								            if( o.value == '<?php echo esc_attr($model); ?>' ) {
								            	o.setAttribute('selected', 'selected');
								            }
								            
								            f.appendChild(o);
								        }
								        
								        return f;
								    }
								    
								    if ( obj.text ) {
								        opts = addOptions(obj);
								        f.appendChild(opts);
								    } else {
								        for ( var prop in obj ) {
								            if ( obj.hasOwnProperty(prop) ) {
								                labels.push(prop);
								            }
								        }
								        
								        for (var i=0, len=labels.length; i<len; i++) {
								            group = document.createElement('optgroup');
								            group.label = labels[i];
								            f.appendChild(group);
								            opts = addOptions(obj[ labels[i] ] );
								            group.appendChild(opts);
								        }
								    }

								} else {

									var f = document.createDocumentFragment();
							        var o;

							        o = document.createElement('option');
						            o.appendChild( document.createTextNode( '<?php esc_html_e('Select a make', 'cardojo' ); ?>' ) );
						            o.value = '0';
							        f.appendChild(o);

								}
							    sel.appendChild(f);

							    $('.selectpicker').selectpicker('refresh');

							}

							$('select#make').on('change', function(){

							   	var selected = $('select#make option:selected').val();

							   	// name of associated select box
							    var relName = 'model';
							    
							    // reference to associated select box 
							    var relList = this.form.elements[ relName ];
							    
							    // get data from object literal based on selection in controlling select box (this.value)
							    var obj = Select_List_Data[ relName ][ selected ];

							   	if(selected != '0') {
								    
								    // remove current option elements
								    removeAllOptions(relList, true);
								    
								    // call function to add optgroup/option elements
								    // pass reference to associated select box and data for new options
								    appendDataToSelect(relList, obj);

								} else {

									// remove current option elements
								    removeAllOptions(relList, true);
								    
								    // call function to add optgroup/option elements
								    // pass reference to associated select box and data for new options
								    appendDataToSelect(relList, '0');

								}

							});

							// populate associated select box as page loads
							(function() { // immediate function to avoid globals
							    
							    var form = document.forms['cardojo-advance-search-form'];
	    
							    // reference to controlling select box
							    var sel = form.elements['model'];
							    sel.selectedIndex = '<?php echo esc_attr($make); ?>';
							    selected = '<?php echo esc_attr($make); ?>';
							    
							    // name of associated select box
							    var relName = 'model';
							    // reference to associated select box
							    var rel = form.elements[ relName ];
							    
							    // get data for associated select box passing its name
							    // and value of selected in controlling select box
							    var data = Select_List_Data[ relName ][ selected ];

							   	if(selected != '0') {

							   		// remove current option elements
								    removeAllOptions(rel, true);
								    
								    // call function to add optgroup/option elements
								    // pass reference to associated select box and data for new options
								    appendDataToSelect(rel, data);

								} else {

									// remove current option elements
								    removeAllOptions(rel, true);
								    
								    // call function to add optgroup/option elements
								    // pass reference to associated select box and data for new options
								    appendDataToSelect(rel, '0');

								}
							    
							}());

					  	})
	              	</script>

				</div>

			</div>

			<div class="col-sm-6 col-md-4 col-lg-3">

				<div class="form-group"> 

					<label for="cd-carmodel"><?php esc_html_e('Model', 'cardojo' ); ?></label>
					<select id="model" name="model" class="selectpicker" data-show-subtext="true" data-live-search="true" style="display: none;"> 
						<option value="0"><?php esc_html_e('Select a make', 'cardojo' ); ?></option>
					</select>

				</div>

			</div>

			<div class="col-sm-6 col-md-4 col-lg-3"> 

				<div class="form-group"> 

					<label for="cd-fuel"><?php esc_html_e('Fuel type', 'cardojo' ); ?></label>
					<select name="fuel_type" class="selectpicker" data-show-subtext="true" data-live-search="true" style="display: none;">
						
						<option value="0"><?php esc_html_e('Any', 'cardojo' ); ?></option>
						<?php

							$categories = get_categories( array('taxonomy' => 'vehicle_fuel_type', 'hide_empty' => false,  'parent' => 0) );

							foreach ($categories as $category) {

								$option = '<option value="'.$category->term_id.'" '. selected( $fuel_type, $category->term_id ) .' >';
								$option .= $category->cat_name;
								$option .= '</option>';

								echo $option;

							}

						?>

					</select>

				</div>

			</div>

			<div class="col-sm-6 col-md-4 col-lg-3"> 

				<div class="form-group custom-range"> 

					<p>
	                    <label for="priceUp2"><?php esc_html_e('Price up to', 'cardojo' ); ?> <span>(<?php $cardojo_currency = get_option( 'cardojo_currency' ); if(!empty($cardojo_currency)) { echo esc_html_e('in', 'cardojo' ); echo " "; echo $cardojo_currency; } ?>)</span></label>
	                    <input type="text" id="priceUp2" name="price" readonly class="pull-left">
	              	</p>
	              	<div id="priceUpRange2" class="pull-right"></div>
	              	<div class="clearfix"></div>

	              	<script>
	              		jQuery("document").ready(function(){

							$( "#priceUpRange2" ).slider({
							    range: "min",
							    min: 0,
							    max: <?php echo cardojo_get_max_price(); ?>,
							    value: <?php echo esc_attr($price); ?>,
							    slide: function( event, ui ) {
							      $( "#priceUp2" ).val( ui.value );
							    }
						  	});
						  	$( "#priceUp2" ).val( $( "#priceUpRange2" ).slider( "value" ) );

					  	})
	              	</script>

				</div>

			</div>

			<div class="clearfix"></div>

			<div class="col-sm-6 col-md-4 col-lg-3"> 

				<div class="form-group custom-range"> 

					<p>
	                    <label for="cd-registration2"><?php esc_html_e('1st registration from', 'cardojo' ); ?> <span><?php esc_html_e('year', 'cardojo' ); ?></span></label>
	                    <input type="text" name="vehicle_year" id="cd-registration2" readonly class="pull-left">
	              	</p>
	              	<div id="registrationRange2" class="pull-right"></div>

					<script>
	              		jQuery("document").ready(function(){

							$( "#registrationRange2" ).slider({
							    range: "max",
							    min: <?php echo cardojo_get_min_year(); ?>,
							    max: <?php echo cardojo_get_max_year(); ?>,
							    value: <?php echo esc_attr($vehicle_year); ?>,
							    slide: function( event, ui ) {
							      $( "#cd-registration2" ).val( ui.value );
							    }
						  	});
						  	$( "#cd-registration2" ).val( $( "#registrationRange2" ).slider( "value" ) );

					  	})
	              	</script>
				
				</div>

			</div>

			<div class="col-sm-6 col-md-4 col-lg-3"> 

				<div class="form-group custom-range">

					<p>
	                    <label for="cd-mileage2"><?php esc_html_e('Mileage up to', 'cardojo' ); ?> <span><?php $unit_system = get_option( 'cardojo_measurement_type' ); if( empty($unit_system) OR $unit_system == "metric") { echo "Km"; } else { echo "Mi"; } ?></span></label>
	                    <input type="text" name="mileage" id="cd-mileage2" readonly class="pull-left">
	              	</p>
	              	<div id="mileageRange2" class="pull-right"></div>

	              	<script>

	              		<?php

	              			$min_mileage = cardojo_get_min_mileage();
	              			if( $min_mileage >= 1000 ) {
	              				$min_mileage = $min_mileage / 1000;
	              			}

	              			$max_mileage = cardojo_get_max_mileage();
	              			if( $max_mileage >= 1000 ) {
	              				$max_mileage = $max_mileage / 1000;
	              			}

	              		?>
	              		jQuery("document").ready(function(){

							$( "#mileageRange2" ).slider({
							    range: "min",
							    min: <?php echo esc_attr($min_mileage); ?>,
							    max: <?php echo esc_attr($max_mileage); ?>,
							    value: <?php echo esc_attr($mileage); ?>,
							    slide: function( event, ui ) {
							      $( "#cd-mileage2" ).val( ui.value + "K");
							    }
						  	});
						  	$( "#cd-mileage2" ).val( $( "#mileageRange2" ).slider( "value" ) + "K");

					  	})
	              	</script>

				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-lg-3"> 

				<div class="form-group"> 

					<div class="custom-checkbox pull-left">
						
						<input name="vehicle_condition" type="checkbox" <?php if($vehicle_condition == "on") { echo "checked"; } ?>>
						<label><?php esc_html_e('Show new cars only', 'cardojo' ); ?></label> 

					</div> 

				</div>

			</div>

			<div class="col-sm-6 col-md-4 col-lg-3"> 

				<div class="form-group"> 

					<button type="submit" class="btn btn-default cardojo-filter-button"><?php esc_html_e('Search through', 'cardojo' ); ?> <span id="cd-cars-nr-list"><?php echo cardojo_get_total_cars_all_users(); ?></span> <?php esc_html_e('cars', 'cardojo' ); ?></button> 

				</div> 

			</div>

		</form>

		<?php if( $results_status == 1) { ?>

		<div class="col-md-12">

			<div class="cardojo-filter-results">

				<div class="row"> 

					<div class="col-sm-12 col-md-6">

						<?php echo cardojo_search_filter_total(); ?> <?php esc_html_e( 'listings were found matching your search criteria.', 'cardojo' ); ?>

					</div>

					<div class="col-sm-12 col-md-6 cardojo-search-filter-results-buttons">

						<a href="<?php echo esc_url($page_url); ?>"><?php esc_html_e( 'Reset', 'cardojo' ); ?></a>
						
						<?php if ( ! is_user_logged_in() ) { ?>
						<span id="subscribe-filter">
							<i class="fa fa fa-spinner fa-spin"></i>
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
							<i class="fa fa-check" aria-hidden="true"></i>
							<?php esc_html_e( 'Subscribe', 'cardojo' ); ?>
							<span id="subscribe-filter-email-holder">
								<input type="text" id="filter_email_x" value="" placeholder="<?php esc_html_e( 'your email', 'cardojo' ); ?>"/>
								<span id="subscribe-filter-save"><?php esc_html_e( 'Submit', 'cardojo' ); ?></span>
								<span id="subscribe-filter-close"><?php esc_html_e( 'Close', 'cardojo' ); ?></span>
							</span>
						</span>
						<?php } else { ?>
						<a id="subscribe-filter" href="#">
							<i class="fa fa fa-spinner fa-spin"></i>
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
							<i class="fa fa-check" aria-hidden="true"></i>
							<?php esc_html_e( 'Subscribe', 'cardojo' ); ?>
						</a>
						<?php } ?>

						<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="subscribe-filter-form">
							<input type="hidden" id="filter_email" name="filter_email" value="<?php $current_user = wp_get_current_user(); echo esc_attr($current_user->user_email); ?>" />
							<input type="hidden" name="filter_make" value="<?php echo esc_attr($make); ?>" />
	                        <input type="hidden" name="filter_model" value="<?php echo esc_attr($model); ?>" />
	                        <input type="hidden" name="filter_fuel_type" value="<?php echo esc_attr($fuel_type); ?>" />
	                        <input type="hidden" name="filter_price" value="<?php echo esc_attr($price); ?>" />
	                        <input type="hidden" name="filter_year" value="<?php echo esc_attr($vehicle_year); ?>" />
	                        <input type="hidden" name="filter_mileage" value="<?php echo esc_attr($mileage * 1000); ?>" />
	                        <input type="hidden" name="filter_condition" value="<?php echo esc_attr($vehicle_condition); ?>" />
	                        <input type="hidden" name="action" value="subscribe-filter" />
	                    </form>

					</div>

				</div>

			</div>

		</div>

		<?php } ?>

	</div>

	<?php } else { ?>

	<div class="row">
	
		<div class="col-sm-12">

			<?php esc_html_e( 'Point the search result page in settings.', 'cardojo' ); ?>

		</div>

	</div>

	<?php } ?>

<?php } ?>