(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery("document").ready(function(){

		jQuery.fn.exists = function(){return this.length>0;}

		$("#cq-make").change(function() {
			jQuery("#vehicle_make_desc_init").val( $("#cq-make").val() );
		});

		$("#cq-trim").change(function() {
			jQuery("#vehicle_trim_desc_init").val( $("#cq-trim").val() );
		});

		jQuery('.cardojo-select-color').change(function(){
		    var value = jQuery( 'input.cardojo-select-color:checked' ).val();
		    jQuery("#vehicle_exterior_color").val(value);
		});

		jQuery('.cardojo-select-interior-color').change(function(){
		    var value = jQuery( 'input.cardojo-select-interior-color:checked' ).val();
		    jQuery("#vehicle_interior_color").val(value);
		});


		/****************
		**  Update Account
		*****************/
		if ($('#cardojo-update-user-form').length) {

			$('#cardojo-update-user-form #password').keypress(function() {
				$('#cardojo-update-user-form #password-error').removeClass("visible");
			    $(this).focus();
			});

			$('#cardojo-update-user-form #repeat_password').keypress(function() {
				$('#cardojo-update-user-form #repeat_password-error').removeClass("visible");
			    $(this).focus();
			});

			$('#cardojo_update_account').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				var password = $("#cardojo-update-user-form #password").val();
	    		var confirmPassword = $("#cardojo-update-user-form #repeat_password").val();

				if ( password != '' ) { // Validate repeat password

					if ( password != confirmPassword ) { // Validate repeat password
						errors = 1;
						$('#cardojo-update-user-form #repeat_password-error').addClass("visible");
						$('html, body').animate({
					        scrollTop: $("#cardojo-update-user-form #repeat_password").offset().top - 180
					    }, 500);
						return;
					}

				}

				if( errors == 0 ) {
					jQuery("#cardojo-update-user-form").submit();
				} else {
					return false;
				}

			});

		}

        /*-----------------------------------------------------------------------------------*/
        /* Subscribe to Filter
        /*-----------------------------------------------------------------------------------*/
        $('#subscribe-filter').click(function(e){

        	e.stopPropagation();
        	e.preventDefault();

        	if( $( "#subscribe-filter-email-holder" ).exists() ) {

        		$( "#subscribe-filter-email-holder" ).css("display", "block");

        	} else {

	            var subscribe_filter = {
	                beforeSubmit:  function(){
	                    $('#subscribe-filter .fa-spinner').css("display", "inline-block");
	                },  // pre-submit callback
	                success: function(data){
	                	$('#subscribe-filter .fa-spinner').css("display", "none");
	                	$('#subscribe-filter .fa-check').css("display", "inline-block");
	                	console.log(data);
	                },
	                error: function(data){
	                    $('#subscribe-filter .fa-exclamation-triangle').css("display", "inline-block");
	                    $('#subscribe-filter .fa-spinner').css("display", "none");
	                    console.log(data);
	                }
	            };

	            $('#subscribe-filter-form').ajaxSubmit( subscribe_filter );

        	}
            
        });

        /*-----------------------------------------------------------------------------------*/
        /* Subscribe to Filter
        /*-----------------------------------------------------------------------------------*/
        $('.delete-user-filter').click(function(e){

        	e.stopPropagation();
        	e.preventDefault();

        	var $id = $(this).data('id');
            var $this = $(this);

        	var remove_filter = {
                beforeSubmit:  function(){
                    $this.find('span').html('<i class="fa fa-spinner fa-spin"></i>');
                },  // pre-submit callback
                success: function(data){
                	$this.find('span').html('<i class="fa fa-check"></i>');
                	$('#user-filter-'+$id).fadeOut( "normal", function() {
					    $(this).remove();
				  	});
                },
                error: function(data){
                    $this.find('span').html('<i class="fa fa-exclamation-triangle"></i>');
                }
            };

            $('#remove-filter-form-'+$id).ajaxSubmit( remove_filter );
            
        });

        $('#subscribe-filter-save').click(function(e){

        	e.stopPropagation();
        	e.preventDefault();

        	if( $("#filter_email_x").val().length ) {

        		$("#filter_email").val( $("#filter_email_x").val() );
        		$("#subscribe-filter-email-holder").css("display", "none");

	        	var subscribe_filter = {
		            beforeSubmit:  function(){
		                $('#subscribe-filter .fa-spinner').css("display", "inline-block");
		            },  // pre-submit callback
		            success: function(){
		            	$('#subscribe-filter .fa-spinner').css("display", "none");
		            	$('#subscribe-filter .fa-check').css("display", "inline-block");
		            },
		            error: function(){
		                $('#subscribe-filter .fa-exclamation-triangle').css("display", "inline-block");
		            }
		        };

		        $('#subscribe-filter-form').ajaxSubmit( subscribe_filter );

        	} else {

        		$("#filter_email_x").addClass('cardojo-submit-email-error');

        	}
            
        });

        $('#subscribe-filter-close').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            $("#subscribe-filter-email-holder").css("display", "none");
            console.log("nununu1");
        });

		/*-----------------------------------------------------------------------------------*/
        /* Add to favorites
        /*-----------------------------------------------------------------------------------*/
        $('a.add-to-favorite').click(function(e){
            e.preventDefault();

            var $id = $(this).data('id');
            var $this = $(this);
            var add_to_fav_opptions = {
                target:        $this,   // target element(s) to be updated with server response
                beforeSubmit:  function(){
                    $this.html('<i class="fa fa fa-spinner fa-spin"></i>');
                },  // pre-submit callback
                success: function(){
                	$this.addClass('favorited');
                    $this.html('<i class="fa fa-heart-o"></i><i class="fa fa-heart"></i>');
                },
                error: function(){
                    $this.html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                }
            };

            $('#add-to-favorite-form-'+$id).ajaxSubmit( add_to_fav_opptions );
        });

        /*-----------------------------------------------------------------------------------*/
        /* Remove from favorites
        /*-----------------------------------------------------------------------------------*/
        $('a.remove-from-favorite').click(function(e){
            e.preventDefault();
            var $id = $(this).data('id');
            var $this = $(this);
            var remove_from_fav_opptions = {
                target:        $this,   // target element(s) to be updated with server response
                beforeSubmit:  function(){
                    $this.html('<i class="fa fa fa-spinner fa-spin"></i>');
                },  // pre-submit callback
                success: function(){
                	$this.removeClass('favorited');
                    $this.html('<i class="fa fa-heart-o"></i><i class="fa fa-heart"></i>');
                },
                error: function(){
                    $this.html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                }
            };

            $('#add-to-favorite-form-'+$id).ajaxSubmit( remove_from_fav_opptions );
        });

		$( '#order_review' ).on('change', 'input[name=payment_method]', function() {
	    	if ( $('#payment_method_accountfunds').size() ) {
	    		$('body').trigger( 'update_checkout' );
	    	}
	    });

		/****************
		**  Register Company Account
		*****************/
		$('#show_reset_password').on('click', function(e) {

			e.preventDefault();

			jQuery("#reset-password-form").css("display", "block");
			jQuery("#autentification-form").css("display", "none");

		});

		$('#hide_reset_password').on('click', function(e) {

			e.preventDefault();

			jQuery("#reset-password-form").css("display", "none");
			jQuery("#autentification-form").css("display", "block");

		});
		
		if ($('#register-employer-form').length) {

			$('#register-employer-form #password').keypress(function() {
				$('#register-employer-form #password-error').removeClass("visible");
			    $(this).focus();
			});

			$('#register-employer-form #repeat_password').keypress(function() {
				$('#register-employer-form #repeat_password-error').removeClass("visible");
			    $(this).focus();
			});

			$('#register-employer-form #email').keypress(function() {
				$('#register-employer-form #email-error').removeClass("visible");
			    $(this).focus();
			});

			$('#register-employer-form #username').keypress(function() {
				$('#register-employer-form #username-error').removeClass("visible");
			    $(this).focus();
			});

			// $('input[name="blt_make_featured_image"]').prop('checked', true);

			$('#register_company_form').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				var username = $("#register-employer-form #username").val();
				var password = $("#register-employer-form #password").val();
	    		var confirmPassword = $("#register-employer-form #repeat_password").val();

	    		if ( username == '' ) { // Validate repeat password
					errors = 1;
					$('#register-employer-form #username-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $("#register-employer-form #username").offset().top - 180
				    }, 500);
					return;
				}

				if ( password == '' ) { // Validate repeat password
					errors = 1;
					$('#register-employer-form #password-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $("#register-employer-form #password").offset().top - 180
				    }, 500);
					return;
				}

				if ( password != confirmPassword ) { // Validate repeat password
					errors = 1;
					$('#register-employer-form #repeat_password-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $("#register-employer-form #repeat_password").offset().top - 180
				    }, 500);
					return;
				}

				if ( ( $('#register-employer-form #email').length ) && ! validateEmail( $('#register-employer-form #email').val() ) ) { // Validate email
					errors = 1;
					$('#register-employer-form #email-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $("#register-employer-form #email").offset().top - 180
				    }, 500);
					return;
				}

				if( errors == 0 ) {
					jQuery("#register-employer-form").submit();
				} else {
					return false;
				}

			});

		}

		/****************
		**  Login
		*****************/
		if ($('#autentification-form').length) {

			$('#autentificare').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				if( errors == 0 ) {
					jQuery("#autentification-form").submit();
				} else {
					return false;
				}

			});
		}

		/****************
		**  Reset Password
		*****************/
		if ($('#reset-password-form').length) {

			$('#reset_password').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				if( errors == 0 ) {
					jQuery("#reset-password-form").submit();
				} else {
					return false;
				}

			});
		}

		// Reports Nav
		if( jQuery( ".caredojo_sales_reports_nav" ).exists() ) {

			jQuery( ".caredojo_sales_reports_nav_item" ).on( 'click', function(e) {

				e.preventDefault();

				jQuery( ".caredojo_sales_reports_nav li" ).removeClass("active");
				jQuery( this ).addClass("active");

				var id = $(this).data('id');
				jQuery( ".caredojo_sales_reports_container" ).removeClass("active");
				jQuery( "#"+id ).addClass("active");

			});

		}

		// Contacts Nav
		if( jQuery( ".caredojo_contact_forms_nav" ).exists() ) {

			jQuery( ".caredojo_contact_forms_nav_item" ).on( 'click', function(e) {

				e.preventDefault();

				jQuery( ".caredojo_contact_forms_nav li" ).removeClass("active");
				jQuery( this ).addClass("active");

				var id = $(this).data('id');
				jQuery( ".caredojo_contact_forms_container" ).removeClass("active");
				jQuery( "#"+id ).addClass("active");

			});

		}

		// Edit Deal
		if( jQuery( ".cardojo-stats-has-url" ).exists() ) {

			jQuery( ".cardojo-stats-has-url" ).on( 'click', function(e) {

				e.preventDefault();

				var cardojo_stat_url = $(this).data('url');
				location.href = cardojo_stat_url;

			});

		}

		if( jQuery("#customer_type").exists() ) {

			jQuery('#customer_type').change(function(){

				if( $(this).val() == "New Customer" ) {
					jQuery("#existing_customer_container").css("display", "none");
				} else {
					jQuery("#existing_customer_container").css("display", "block");
				}

			});

		}

		if( jQuery("#existing_customer").exists() ) {

			jQuery('#existing_customer').change(function(){

		       var selected = $(this).find('option:selected');
		       var first_name = selected.data('first-name');
		       var middle_name = selected.data('middle-name');
		       var last_name = selected.data('last-name');
		       var address_1 = selected.data('address-1');
		       var address_2 = selected.data('address-2');
		       var city = selected.data('city');
		       var state = selected.data('state');
		       var zip = selected.data('zip');
		       var home_phone = selected.data('home-phone');
		       var mobile_phone = selected.data('mobile-phone');
		       var work_phone = selected.data('work-phone');
		       var email = selected.data('email');
		       var birth_date = selected.data('birth-date');
		       var social_security = selected.data('social-security');
		       var driver_license_state = selected.data('driver-license-state');
		       var driver_license_number = selected.data('driver-license-number');
		       var driver_license_exp = selected.data('driver-license-exp');

		       jQuery("#deal_first_name").val(first_name);
		       jQuery("#deal_middle_name").val(middle_name);
		       jQuery("#deal_last_name").val(last_name);
		       jQuery("#deal_address_1").val(address_1);
		       jQuery("#deal_address_2").val(address_2);
		       jQuery("#deal_city").val(city);
		       jQuery("#deal_state").val(state);
		       jQuery("#deal_zip").val(zip);
		       jQuery("#deal_home_phone").val(home_phone);
		       jQuery("#deal_mobile_phone").val(mobile_phone);
		       jQuery("#deal_work_phone").val(work_phone);
		       jQuery("#deal_email").val(email);
		       jQuery("#deal_birth_date").val(birth_date);
		       jQuery("#deal_social_security").val(social_security);
		       jQuery("#deal_driver_license_state").val(driver_license_state);
		       jQuery("#deal_driver_license_number").val(driver_license_number);
		       jQuery("#deal_driver_license_exp").val(driver_license_exp);

		    });

		}

		// Co Buyer
		if( jQuery("#cobuyer_customer_type").exists() ) {

			jQuery('#cobuyer_customer_type').change(function(){

				if( $(this).val() == "New Customer" ) {
					jQuery("#existing_cobuyer_customer_container").css("display", "none");
				} else {
					jQuery("#existing_cobuyer_customer_container").css("display", "block");
				}

			});

		}

		if( jQuery("#cobuyer_existing_customer").exists() ) {

			jQuery('#cobuyer_existing_customer').change(function(){

		       var selected = $(this).find('option:selected');
		       var first_name = selected.data('first-name');
		       var middle_name = selected.data('middle-name');
		       var last_name = selected.data('last-name');
		       var address_1 = selected.data('address-1');
		       var address_2 = selected.data('address-2');
		       var city = selected.data('city');
		       var state = selected.data('state');
		       var zip = selected.data('zip');
		       var home_phone = selected.data('home-phone');
		       var mobile_phone = selected.data('mobile-phone');
		       var work_phone = selected.data('work-phone');
		       var email = selected.data('email');
		       var birth_date = selected.data('birth-date');
		       var social_security = selected.data('social-security');
		       var driver_license_state = selected.data('driver-license-state');
		       var driver_license_number = selected.data('driver-license-number');
		       var driver_license_exp = selected.data('driver-license-exp');

		       jQuery("#deal_cobuyer_first_name").val(first_name);
		       jQuery("#deal_cobuyer_middle_name").val(middle_name);
		       jQuery("#deal_cobuyer_last_name").val(last_name);
		       jQuery("#deal_cobuyer_address_1").val(address_1);
		       jQuery("#deal_cobuyer_address_2").val(address_2);
		       jQuery("#deal_cobuyer_city").val(city);
		       jQuery("#deal_cobuyer_state").val(state);
		       jQuery("#deal_cobuyer_zip").val(zip);
		       jQuery("#deal_cobuyer_home_phone").val(home_phone);
		       jQuery("#deal_cobuyer_mobile_phone").val(mobile_phone);
		       jQuery("#deal_cobuyer_work_phone").val(work_phone);
		       jQuery("#deal_cobuyer_email").val(email);
		       jQuery("#deal_cobuyer_birth_date").val(birth_date);
		       jQuery("#deal_cobuyer_social_security").val(social_security);
		       jQuery("#deal_cobuyer_driver_license_state").val(driver_license_state);
		       jQuery("#deal_cobuyer_driver_license_number").val(driver_license_number);
		       jQuery("#deal_cobuyer_driver_license_exp").val(driver_license_exp);

		    });

		}

		if( jQuery("#deal_vehicle_id").exists() ) {

			jQuery('#deal_vehicle_id').change(function(){
		       var selected = $(this).find('option:selected');
		       var sku = selected.data('sku');
		       var year = selected.data('year');
		       var make = selected.data('make');
		       var model = selected.data('model');
		       var trim = selected.data('trim');
		       var vin = selected.data('vin');
		       var color = selected.data('color');
		       var mileage = selected.data('mileage');
		       var price = selected.data('price');
		       var cost = selected.data('cost');
		       jQuery("#deal_vehicle_sku").val(sku);
		       jQuery("#deal_vehicle_year").val(year);
		       jQuery("#deal_vehicle_make").val(make);
		       jQuery("#deal_vehicle_model").val(model);
		       jQuery("#deal_vehicle_trim").val(trim);
		       jQuery("#deal_vehicle_vin").val(vin);
		       jQuery("#deal_vehicle_color").val(color);
		       jQuery("#deal_vehicle_mileage").val(mileage);
		       jQuery("#deal_vehicle_price").val(price);
		       jQuery("#deal_purchase_cost").val(cost);
		    });

		}

		if( jQuery("#lead_vehicle_id").exists() ) {

			jQuery('#lead_vehicle_id').change(function(){
		       var selected = $(this).find('option:selected');
		       var sku = selected.data('sku');
		       var year = selected.data('year');
		       var make = selected.data('make');
		       var model = selected.data('model');
		       var trim = selected.data('trim');
		       var vin = selected.data('vin');
		       var color = selected.data('color');
		       var mileage = selected.data('mileage');
		       var price = selected.data('price');
		       jQuery("#lead_vehicle_sku").val(sku);
		       jQuery("#lead_vehicle_year").val(year);
		       jQuery("#lead_vehicle_make").val(make);
		       jQuery("#lead_vehicle_model").val(model);
		       jQuery("#lead_vehicle_trim").val(trim);
		       jQuery("#lead_vehicle_vin").val(vin);
		       jQuery("#lead_vehicle_color").val(color);
		       jQuery("#lead_vehicle_mileage").val(mileage);
		       jQuery("#lead_vehicle_price").val(price);
		    });

		}

		jQuery( '#btnGroupResidence button' ).on( 'click', function() {

	        jQuery( '#btnGroupResidence button' ).removeClass("active");
	        jQuery( this ).addClass("active");

	        var target = $(this).data('target');
	        jQuery(".lead_buyer_residences").removeClass("active");
	        jQuery( "#"+target ).addClass("active");

	    } );

	    jQuery( '#btnGroupEmployer button' ).on( 'click', function() {

	        jQuery( '#btnGroupEmployer button' ).removeClass("active");
	        jQuery( this ).addClass("active");

	        var target = $(this).data('target');
	        jQuery(".lead_buyer_employers").removeClass("active");
	        jQuery( "#"+target ).addClass("active");

	    } );

	    //
	    jQuery( '#btnGroupCoBuyerResidence button' ).on( 'click', function() {

	        jQuery( '#btnGroupCoBuyerResidence button' ).removeClass("active");
	        jQuery( this ).addClass("active");

	        var target = $(this).data('target');
	        jQuery(".lead_cobuyer_buyer_residences").removeClass("active");
	        jQuery( "#"+target ).addClass("active");

	    } );

	    jQuery( '#btnGroupCoBuyerEmployer button' ).on( 'click', function() {

	        jQuery( '#btnGroupCoBuyerEmployer button' ).removeClass("active");
	        jQuery( this ).addClass("active");

	        var target = $(this).data('target');
	        jQuery(".lead_cobuyer_buyer_employers").removeClass("active");
	        jQuery( "#"+target ).addClass("active");

	    } );
	    //

		if( jQuery(".date_picker_past").exists() ) {

			var date = new Date();
			date.setFullYear( date.getFullYear() - 16 );

			jQuery( ".date_picker_past" ).datepicker({
		      	changeMonth: true,
		      	changeYear: true,
		      	yearRange: "-100:-15",
		      	setDate: date,
		    });

		}

		if( jQuery(".date_picker_future").exists() ) {

		    jQuery( ".date_picker_future" ).datepicker({
		      	changeMonth: true,
		      	changeYear: true,
		      	yearRange: "-0:+50",
		      	setDate: new Date(),
		    });

		}

		if( jQuery(".date_picker_range").exists() ) {

			jQuery( ".date_picker_range" ).datepicker({
		      	changeMonth: true,
		      	changeYear: true,
		      	yearRange: "-10:+10",
		      	setDate: new Date(),
		    });

		}

		if( jQuery(".time_picker").exists() ) {

		    jQuery(".time_picker").timePicker({
				show24Hours: false,
				separator: ':',
				step: 30
			});

		}

		if( jQuery(".selectpicker").exists() ) {

			jQuery('.selectpicker').selectpicker({
			  	liveSearch: true
			});

		}

		// Edit Deal
		if( jQuery("#cardojo_deals_table").exists() ) {

			var lead_edit_url = $("#cardojo_deals_table").data('edit-url');

			$("#cardojo_deals_table tbody").on('click', 'tr', function(e){

				e.preventDefault();

				if(lead_edit_url == "no-page") {

					alert("Lead submission page doesn't exist.");

				} else {

					var lead_id = $(this).data('id');
					location.href = lead_edit_url + "/?action=edit&deal_id=" + lead_id + "#amortization_schedule_table";

				}

			});

		}

		$('#cardojo_submit_deal').on('click', function(e) {

			e.preventDefault();

			jQuery("#submit-deal-cardojo-form").submit();

		});

		//

		// Edit Lead
		if( jQuery("#cardojo_leads_table").exists() ) {

			var lead_edit_url = $("#cardojo_leads_table").data('edit-url');

			$("#cardojo_leads_table tbody").on('click', 'tr', function(e){

				e.preventDefault();

				if(lead_edit_url == "no-page") {

					alert("Lead submission page doesn't exist.");

				} else {

					var lead_id = $(this).data('id');
					location.href = lead_edit_url + "/?action=edit&lead_id=" + lead_id;

				}

			});

		}

		// Edit Lead
		if( jQuery("#cardojo_lead_appointments_table").exists() ) {

			var lead_edit_url = $("#cardojo_lead_appointments_table").data('edit-url');

			$("#cardojo_lead_appointments_table tbody").on('click', 'tr', function(e){

				e.preventDefault();

				if(lead_edit_url == "no-page") {

					alert("Lead submission page doesn't exist.");

				} else {

					var lead_id = $(this).data('id');
					location.href = lead_edit_url + "/?action=edit&lead_id=" + lead_id;

				}

			});

		}

		$('#cardojo_submit_lead').on('click', function(e) {

			e.preventDefault();

			jQuery("#submit-lead-cardojo-form").submit();

		});

		$('#cardojo_submit_vehicle').on('click', function(e) {

			e.preventDefault();

			jQuery("#submit-cardojo-form").submit();

		});

		$('#cardojo_save_expenses').on('click', function(e) {

			e.preventDefault();

			jQuery("#cardojo-add-expenses").submit();

		});

		// Location map
		if( jQuery("#map-canvas").exists() ) {

			var geocoder;
			var map;
			var marker;

			var geocoder = new google.maps.Geocoder();

			function geocodePosition(pos) {
			  	geocoder.geocode({
			    	latLng: pos
			  	}, function(responses) {
				    if (responses && responses.length > 0) {
				      updateMarkerAddress(responses[0].formatted_address);
				    } else {
				      updateMarkerAddress('Cannot determine address at this location.');
				    }
			  	});
			}

			function updateMarkerPosition(latLng) {
			  	jQuery('#vehicle_location_latitude').val(latLng.lat());
			  	jQuery('#vehicle_location_longitude').val(latLng.lng());
			}

			function updateMarkerAddress(str) {
			  	jQuery('#vehicle_location_address').val(str);
			}

			function initialize() {

			  	var latlng = new google.maps.LatLng(jQuery("#vehicle_location_latitude").val(), jQuery("#vehicle_location_longitude").val());
			  	var mapOptions = {
			    	zoom: 16,
			    	center: latlng
			  	}

			  	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			  	geocoder = new google.maps.Geocoder();

			  	marker = new google.maps.Marker({
			  		position: latlng,
			    	map: map,
			    	draggable: true
			  	});

			  	// Add dragging event listeners.
			  	google.maps.event.addListener(marker, 'dragstart', function() {
			    	updateMarkerAddress('Dragging...');
			  	});
			  
			  	google.maps.event.addListener(marker, 'drag', function() {
			    	updateMarkerPosition(marker.getPosition());
			  	});
			  
			  	google.maps.event.addListener(marker, 'dragend', function() {
			    	geocodePosition(marker.getPosition());
			  	});

			}

			google.maps.event.addDomListener(window, 'load', initialize);
			         
		  	initialize();
			          
		  	jQuery(function() {

		  		if( jQuery("#vehicle_location_address").exists() ) {
			    
				    jQuery("#vehicle_location_address").autocomplete({
				      	//This bit uses the geocoder to fetch address values
				      	source: function(request, response) {
					        geocoder.geocode( {'address': request.term }, function(results, status) {
					          	response(jQuery.map(results, function(item) {
						            return {
						              	label:  item.formatted_address,
						              	value: item.formatted_address,
						              	latitude: item.geometry.location.lat(),
						              	longitude: item.geometry.location.lng()
						            }
					          	}));
					        })
				      	},
				      	//This bit is executed upon selection of an address
				      	select: function(event, ui) {
				        	jQuery("#vehicle_location_latitude").val(ui.item.latitude);
				        	jQuery("#vehicle_location_longitude").val(ui.item.longitude);

				        	var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);

				        	marker.setPosition(location);
				        	map.setZoom(16);
				        	map.setCenter(location);

				      	}
				    });
				}
		  	});
			  
		  	//Add listener to marker for reverse geocoding
		  	google.maps.event.addListener(marker, 'drag', function() {
			    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
			      	if (status == google.maps.GeocoderStatus.OK) {
				        if (results[0]) {
				          	jQuery('#vehicle_location_address').val(results[0].formatted_address);
				          	jQuery('#vehicle_location_latitude').val(marker.getPosition().lat());
				          	jQuery('#vehicle_location_longitude').val(marker.getPosition().lng());
				        }
			      	}
			    });
		  	});

		  	if( jQuery("#vehicle_condition").exists() ) {

				jQuery('#vehicle_location').change(function(){
			       var selected = $(this).find('option:selected');
			       var name = selected.data('name');
			       var mobile = selected.data('mobile');
			       var phone = selected.data('phone');
			       var email = selected.data('email');
			       var address = selected.data('address');
			       var latitude = selected.data('latitude');
			       var longitude = selected.data('longitude');
			       jQuery("#vehicle_location_name").val(name);
			       jQuery("#vehicle_location_mobile_phone").val(mobile);
			       jQuery("#vehicle_location_phone").val(phone);
			       jQuery("#vehicle_location_email").val(email);
			       jQuery("#vehicle_location_address").val(address);
			       jQuery("#vehicle_location_latitude").val(latitude);
			       jQuery("#vehicle_location_longitude").val(longitude);
			       initialize();
			    });

			}
		  	
		};
		// End location map

		//
		function restoreSorting() {
			jQuery(".sorting_asc").addClass("sorting");
			jQuery(".sorting_asc").removeClass("sorting_asc");
			jQuery(".sorting_desc").addClass("sorting");
			jQuery(".sorting_desc").removeClass("sorting_desc");
		}

		// Leads Orderby
		jQuery( '.cardojo-leads-filter' ).on( 'click', '#refresh-leads-filter', function() {
			jQuery( '.cardojo-leads-filter' ).submit();
		});

		// Deals Orderby
		jQuery( '.cardojo-deals-filter' ).on( 'click', '#refresh-deals-filter', function() {
			jQuery( '.cardojo-deals-filter' ).submit();
		});

		// Leads Reset Filter
		jQuery( '.cardojo-leads-filter' ).on( 'click', '#clear-leads-filter', function() {

			restoreSorting();
			jQuery("#orderby").val("default");
			jQuery("select.cardojo-leads-select-start-date option").removeAttr("selected");
			jQuery('select.cardojo-leads-select-start-date option[value="30daysago"]').attr('selected', 'selected');
			jQuery("select.cardojo-leads-select-end-date option").removeAttr("selected");
			jQuery('select.cardojo-leads-select-end-date option[value="today"]').attr('selected', 'selected');
			jQuery("select.cardojo-leads-select-ppp option").removeAttr("selected");
			jQuery( '.cardojo-leads-filter' ).submit();

			jQuery(this).remove();
		});

		$('.lead-sorting-date').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("date_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("date_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-name').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("name_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("name_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-sku').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("sku_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("sku_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-status').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("status_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("status_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-uptype').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("uptype_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("uptype_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-adsource').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("adsource_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("adsource_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-websiteleadtype').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("webleadtype_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("webleadtype_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-appointment').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("appointment_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("appointment_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		$('.lead-sorting-phone').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("phone_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("phone_asc");
			}

			jQuery( '.cardojo-leads-filter' ).submit();

		});

		// Deals Reset Filter
		jQuery( '.cardojo-deals-filter' ).on( 'click', '#clear-deals-filter', function() {

			restoreSorting();
			jQuery("#orderby").val("default");
			jQuery("select.cardojo-deals-select-start-date option").removeAttr("selected");
			jQuery('select.cardojo-deals-select-start-date option[value="30daysago"]').attr('selected', 'selected');
			jQuery("select.cardojo-deals-select-end-date option").removeAttr("selected");
			jQuery('select.cardojo-deals-select-end-date option[value="today"]').attr('selected', 'selected');
			jQuery("select.cardojo-deals-select-ppp option").removeAttr("selected");
			jQuery( '.cardojo-deals-filter' ).submit();

			jQuery(this).remove();
		});

		$('.deal-sorting-date').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("date_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("date_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		$('.deal-sorting-name').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("name_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("name_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		$('.deal-sorting-sku').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("sku_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("sku_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		$('.deal-sorting-vehicle-name').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("vehicle_name_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("vehicle_name_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		$('.deal-sorting-price').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("price_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("price_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		$('.deal-sorting-profit').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("profit_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("profit_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		$('.deal-sorting-age').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("age_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("age_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		$('.deal-sorting-next-payment').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("#orderby").val("next_payment_desc");
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("#orderby").val("next_payment_asc");
			}

			jQuery( '.cardojo-deals-filter' ).submit();

		});

		// Inventory Filter
		jQuery( '.cardojo-inventory-filter' ).on( 'change', 'select.cardojo-inventory-select-filter', function() {
			jQuery( '.cardojo-inventory-filter' ).submit();
		});

		// Inventory Orderby
		jQuery( '.cardojo-inventory-filter' ).on( 'change', 'select.cardojo-inventory-select-order', function() {
			jQuery( '.cardojo-inventory-filter' ).submit();
		});

		// Inventory Posts Per Page
		jQuery( '.cardojo-inventory-filter' ).on( 'change', 'select.cardojo-inventory-select-ppp', function() {
			jQuery( '.cardojo-inventory-filter' ).submit();
		});

		// Inventory Reset Filter
		jQuery( '.cardojo-inventory-filter' ).on( 'click', '#clear-inventory-filter', function() {

			restoreSorting();
			jQuery("input.cardojo-filter-keyword").val("");
			jQuery("select.cardojo-inventory-select-filter option").removeAttr("selected");
			jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
			jQuery("select.cardojo-inventory-select-ppp option").removeAttr("selected");
			jQuery( '.cardojo-inventory-filter' ).submit();

			jQuery(this).remove();
		});

		$('.sorting-vehicle').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="year_desc"]').attr('selected', 'selected');
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="year_asc"]').attr('selected', 'selected');
			}

			jQuery( '.cardojo-inventory-filter' ).submit();

		});

		$('.sorting-mileage').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="mileage_desc"]').attr('selected', 'selected');
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="mileage_asc"]').attr('selected', 'selected');
			}

			jQuery( '.cardojo-inventory-filter' ).submit();

		});

		$('.sorting-cost').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="cost_desc"]').attr('selected', 'selected');
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="cost_asc"]').attr('selected', 'selected');
			}

			jQuery( '.cardojo-inventory-filter' ).submit();

		});

		$('.sorting-price').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="price_desc"]').attr('selected', 'selected');
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="price_asc"]').attr('selected', 'selected');
			}

			jQuery( '.cardojo-inventory-filter' ).submit();

		});

		$('.sorting-age').on('click', function(e) {

			e.preventDefault();

			if( jQuery(this).hasClass("sorting_asc") ) {
				restoreSorting();
				jQuery(this).removeClass("sorting_asc");
				jQuery(this).addClass("sorting_desc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="age_desc"]').attr('selected', 'selected');
			} else {
				restoreSorting();
				jQuery(this).removeClass("sorting");
				jQuery(this).removeClass("sorting_desc");
				jQuery(this).addClass("sorting_asc");
				jQuery("select.cardojo-inventory-select-order option").removeAttr("selected");
				jQuery('select.cardojo-inventory-select-order option[value="age_asc"]').attr('selected', 'selected');
			}

			jQuery( '.cardojo-inventory-filter' ).submit();

		});

		if( jQuery("#mail_sent_status").exists() && (jQuery('#mail_sent_status').val() == 1) ) {
			
			jQuery('html, body').animate({
		        scrollTop: $("#cd-form-wrapp").offset().top - 100
		    }, 500);

		};

		// bootstrap carousel touch swipe support
	  	jQuery("#cd-item-slider, #cd-main-carousel").swipe({
		    swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
		      	if (direction == 'left') jQuery(this).carousel('next');
		      	if (direction == 'right') jQuery(this).carousel('prev');
		    },
	    	allowPageScroll:"vertical"
	  	});

		/****************
		**  Contact Car Dealer 
		*****************/
		if ($('#cardojo-contact-dealer').length) {

			$('#cardojo-contact-dealer #userName').keypress(function() {
				$('#cardojo-contact-dealer #userName-error').removeClass("visible");
			    $(this).focus();
			});

			$('#cardojo-contact-dealer #userMail').keypress(function() {
				$('#cardojo-contact-dealer #userMail-error').removeClass("visible");
			    $(this).focus();
			});

			$('#cardojo-contact-dealer #userPhone').keypress(function() {
				$('#cardojo-contact-dealer #userPhone-error').removeClass("visible");
			    $(this).focus();
			});

			// $('input[name="blt_make_featured_image"]').prop('checked', true);

			$('#cardojo-contact-dealer-submit').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				if ( $('#cardojo-contact-dealer #userName').length && ( $('#cardojo-contact-dealer #userName').val() == '' ) ) { // // Validate name
					errors = 1;
					$('#cardojo-contact-dealer #userName-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $("#cardojo-contact-dealer #userName").offset().top - 180
				    }, 500);
					return;
				}

				if ( ( $('#cardojo-contact-dealer #userMail').length ) && ! validateEmail( $('#cardojo-contact-dealer #userMail').val() ) ) { // Validate userMail
					errors = 1;
					$('#cardojo-contact-dealer #userMail-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $("#cardojo-contact-dealer #userMail").offset().top - 180
				    }, 500);
					return;
				}

				if ( $('#cardojo-contact-dealer #userPhone').length && ( $('#cardojo-contact-dealer #userPhone').val() == '' ) ) { // // Validate name
					errors = 1;
					$('#cardojo-contact-dealer #userPhone-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $("#cardojo-contact-dealer #userPhone").offset().top - 180
				    }, 500);
					return;
				}

				if( errors == 0 ) {
					jQuery("#cardojo-contact-dealer").submit();
				} else {
					return false;
				}

			});

		}

		/****************
		**  Submit Financial Application
		*****************/
		if ($('.contact-form-application').length) {

			$('.contact-form-application #lead_first_name').keypress(function() {
				$('.contact-form-application #lead_first_name-error').removeClass("visible");
			    $(this).focus();
			});

			$('.contact-form-application #lead_email').keypress(function() {
				$('.contact-form-application #lead_email-error').removeClass("visible");
			    $(this).focus();
			});

			$('.contact-form-application #lead_mobile_phone').keypress(function() {
				$('.contact-form-application #lead_mobile_phone-error').removeClass("visible");
			    $(this).focus();
			});

			// $('input[name="blt_make_featured_image"]').prop('checked', true);

			$('#cardojo_submit_application').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				if ( $('.contact-form-application #lead_first_name').length && ( $('.contact-form-application #lead_first_name').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.contact-form-application #lead_first_name-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".contact-form-application #lead_first_name").offset().top - 180
				    }, 500);
					return;
				}

				if ( $('.contact-form-application #lead_mobile_phone').length && ( $('.contact-form-application #lead_mobile_phone').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.contact-form-application #lead_mobile_phone-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".contact-form-application #lead_mobile_phone").offset().top - 180
				    }, 500);
					return;
				}

				if ( ( $('.contact-form-application #lead_email').length ) && ! validateEmail( $('.contact-form-application #lead_email').val() ) ) { // Validate userMail
					errors = 1;
					$('.contact-form-application #lead_email-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".contact-form-application #lead_email").offset().top - 180
				    }, 500);
					return;
				}

				if( errors == 0 ) {
					$('#cardojo_submit_application .fa').css("display", "inline-block");
					jQuery(".contact-form-application").submit();
				} else {
					return false;
				}

			});

		}

		/****************
		**  Submit Pre-Qualify
		*****************/
		if ($('.pre-qualify-form-application').length) {

			$('.pre-qualify-form-application #lead_first_name').keypress(function() {
				$('.pre-qualify-form-application #lead_first_name-error').removeClass("visible");
			    $(this).focus();
			});

			$('.pre-qualify-form-application #lead_email').keypress(function() {
				$('.pre-qualify-form-application #lead_email-error').removeClass("visible");
			    $(this).focus();
			});

			$('.pre-qualify-form-application #lead_mobile_phone').keypress(function() {
				$('.pre-qualify-form-application #lead_mobile_phone-error').removeClass("visible");
			    $(this).focus();
			});

			// $('input[name="blt_make_featured_image"]').prop('checked', true);

			$('#cardojo_qualify_me').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				if ( $('.pre-qualify-form-application #lead_first_name').length && ( $('.pre-qualify-form-application #lead_first_name').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.pre-qualify-form-application #lead_first_name-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".pre-qualify-form-application #lead_first_name").offset().top - 180
				    }, 500);
					return;
				}

				if ( $('.pre-qualify-form-application #lead_mobile_phone').length && ( $('.pre-qualify-form-application #lead_mobile_phone').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.pre-qualify-form-application #lead_mobile_phone-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".pre-qualify-form-application #lead_mobile_phone").offset().top - 180
				    }, 500);
					return;
				}

				if ( ( $('.pre-qualify-form-application #lead_email').length ) && ! validateEmail( $('.pre-qualify-form-application #lead_email').val() ) ) { // Validate userMail
					errors = 1;
					$('.pre-qualify-form-application #lead_email-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".pre-qualify-form-application #lead_email").offset().top - 180
				    }, 500);
					return;
				}

				if( errors == 0 ) {
					$('#cardojo_qualify_me .fa').css("display", "inline-block");
					jQuery(".pre-qualify-form-application").submit();
				} else {
					return false;
				}

			});

		}

		/****************
		**  Submit Trade-In
		*****************/
		if ($('.trade-in-form-application').length) {

			$('.trade-in-form-application #lead_first_name').keypress(function() {
				$('.trade-in-form-application #lead_first_name-error').removeClass("visible");
			    $(this).focus();
			});

			$('.trade-in-form-application #lead_email').keypress(function() {
				$('.trade-in-form-application #lead_email-error').removeClass("visible");
			    $(this).focus();
			});

			$('.trade-in-form-application #lead_mobile_phone').keypress(function() {
				$('.trade-in-form-application #lead_mobile_phone-error').removeClass("visible");
			    $(this).focus();
			});

			// $('input[name="blt_make_featured_image"]').prop('checked', true);

			$('#cardojo_submit_tradein').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				if ( $('.trade-in-form-application #lead_first_name').length && ( $('.trade-in-form-application #lead_first_name').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.trade-in-form-application #lead_first_name-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".trade-in-form-application #lead_first_name").offset().top - 180
				    }, 500);
					return;
				}

				if ( $('.trade-in-form-application #lead_mobile_phone').length && ( $('.trade-in-form-application #lead_mobile_phone').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.trade-in-form-application #lead_mobile_phone-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".trade-in-form-application #lead_mobile_phone").offset().top - 180
				    }, 500);
					return;
				}

				if ( ( $('.trade-in-form-application #lead_email').length ) && ! validateEmail( $('.trade-in-form-application #lead_email').val() ) ) { // Validate userMail
					errors = 1;
					$('.trade-in-form-application #lead_email-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".trade-in-form-application #lead_email").offset().top - 180
				    }, 500);
					return;
				}

				if( errors == 0 ) {
					$('#cardojo_submit_tradein .fa').css("display", "inline-block");
					jQuery(".trade-in-form-application").submit();
				} else {
					return false;
				}

			});

		}

		/****************
		**  Submit test Drive
		*****************/
		if ($('.test-drive-form-application').length) {

			$('.test-drive-form-application #lead_first_name').keypress(function() {
				$('.test-drive-form-application #lead_first_name-error').removeClass("visible");
			    $(this).focus();
			});

			$('.test-drive-form-application #lead_email').keypress(function() {
				$('.test-drive-form-application #lead_email-error').removeClass("visible");
			    $(this).focus();
			});

			$('.test-drive-form-application #lead_mobile_phone').keypress(function() {
				$('.test-drive-form-application #lead_mobile_phone-error').removeClass("visible");
			    $(this).focus();
			});

			// $('input[name="blt_make_featured_image"]').prop('checked', true);

			$('#cardojo_request_test_drive').on('click', function(e) {

				e.preventDefault();

				var errors = 0;

				if ( $('.test-drive-form-application #lead_first_name').length && ( $('.test-drive-form-application #lead_first_name').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.test-drive-form-application #lead_first_name-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".test-drive-form-application #lead_first_name").offset().top - 180
				    }, 500);
					return;
				}

				if ( $('.test-drive-form-application #lead_mobile_phone').length && ( $('.test-drive-form-application #lead_mobile_phone').val() == '' ) ) { // // Validate name
					errors = 1;
					$('.test-drive-form-application #lead_mobile_phone-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".test-drive-form-application #lead_mobile_phone").offset().top - 180
				    }, 500);
					return;
				}

				if ( ( $('.test-drive-form-application #lead_email').length ) && ! validateEmail( $('.test-drive-form-application #lead_email').val() ) ) { // Validate userMail
					errors = 1;
					$('.test-drive-form-application #lead_email-error').addClass("visible");
					$('html, body').animate({
				        scrollTop: $(".test-drive-form-application #lead_email").offset().top - 180
				    }, 500);
					return;
				}

				if( errors == 0 ) {
					$('#cardojo_submit_tradein .fa').css("display", "inline-block");
					jQuery(".test-drive-form-application").submit();
				} else {
					return false;
				}

			});

		}

		function validateEmail(email) { 
		 	// http://stackoverflow.com/a/46181/11236		  
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		    return re.test(email);
		}

	 	// changing background from html
	  	jQuery.each(jQuery("[data-bg]"), function(){
	      	if (jQuery(this).attr("data-bg").length > 0){
	        	jQuery(this).css("background-image", "url("+ jQuery(this).attr("data-bg") +")");
	      	}
	  	});

	  	var drgflag = true;

	  	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			drgflag = false;
		}

	  	// Location map
	  	if( jQuery("#cd-map").exists() ) {

			var map;
			var marker;

			function initialize() {

			  	var latlng = new google.maps.LatLng(jQuery("#vehicle_location_latitude").val(), jQuery("#vehicle_location_longitude").val());
			  	var mapOptions = {
			    	zoom: 16,
			    	center: latlng,
			    	scrollwheel: false,
            		mapTypeControl: false,
            		draggable: drgflag,
			  	}

			  	map = new google.maps.Map(document.getElementById('cd-map'), mapOptions);

			  	marker = new google.maps.Marker({
			  		position: latlng,
			    	map: map,
			    	draggable: drgflag,
			  	});

			}

			google.maps.event.addDomListener(window, 'load', initialize);
			         
		  	initialize();

	  	}

		if( jQuery("#vehicle_condition").exists() ) {

			var val2 = jQuery("#vehicle_condition").val();

			if( val2 === "Used" ) {
			    jQuery(".show-hide-condition").css({"display":"block"});
			} else {
			    jQuery(".show-hide-condition").css({"display":"none"});
			}
			
			jQuery("#vehicle_condition").change(function() {
			    var val2 = jQuery(this).val();
			    if( val2 === "Used" ) {
			        jQuery(".show-hide-condition").css({"display":"block"});
			    } else {
			        jQuery(".show-hide-condition").css({"display":"none"});
			    }
			});

		}

		if( jQuery(".taxonomy-subcategory-select").exists() ) {

			var val2 = jQuery(".taxonomy-subcategory-select").val();

			if( val2 !== "na" ) {
			    jQuery(this).closest('.cardojo-checkbox-sub-category').find('.vehicle_comfort_sub_main').attr('checked', true);
			} else {
			    jQuery(this).closest('.cardojo-checkbox-sub-category').find('.vehicle_comfort_sub_main').attr('checked', false);
			}
			
			jQuery(".taxonomy-subcategory-select").change(function() {
			    var val2 = jQuery(this).val();
			    if( val2 !== "na" ) {
			        jQuery(this).closest('.cardojo-checkbox-sub-category').find('.vehicle_comfort_sub_main').attr('checked', true);
			    } else {
			        jQuery(this).closest('.cardojo-checkbox-sub-category').find('.vehicle_comfort_sub_main').attr('checked', false);
			    }
			});

			jQuery('.vehicle_comfort_sub_main').change(function() {
			    if( jQuery(this).is(":checked") ) {
			        jQuery(this).closest('.cardojo-checkbox-sub-category').find('.taxonomy-subcategory-select option:nth-child(2)').attr('selected', 'selected');
			    } else {
			        jQuery(this).closest('.cardojo-checkbox-sub-category').find('.taxonomy-subcategory-select option:nth-child(1)').attr('selected', 'selected');
			    }
			});

		}

		if( jQuery("#vehicle_discount").exists() ) {

			if( $('#vehicle_discount').is(":checked") ) {
			    jQuery(".new-discounted-price").css({"display":"block"});
			} else {
			    jQuery(".new-discounted-price").css({"display":"none"});
			}
			
			jQuery("#vehicle_discount").change(function() {
			    if( $('#vehicle_discount').is(":checked") ) {
			        jQuery(".new-discounted-price").css({"display":"block"});
			    } else {
			        jQuery(".new-discounted-price").css({"display":"none"});
			    }
			});

		}

	    jQuery( '.editinline' ).on( 'click', function() {

	        var tag_id = jQuery( this ).parents( 'tr' ).attr( 'id' ),
				color  = jQuery( 'td.color i', '#' + tag_id ).attr( 'data-color' );

	        jQuery( ':input[name="term-color"]', '.inline-edit-row' ).val( color );

	    } );

		if (document.getElementById("setting-cardojo_currency")) {
			$('#setting-cardojo_currency').select2();
		};

		// Car Expenses
		var divIdExpenses = jQuery( '#vehicle_expenses_container .vehicle_expenses_item:last-child' ).attr( 'data-id' );

		jQuery('#car_expenses').on('click', '.add_new_expense', function(e) {
            e.preventDefault();

            divIdExpenses++;

            var $newexpense = $( '<div class="vehicle_expenses_item" data-id="'+divIdExpenses+'"><div class="cardojo-col-3"><label for="vehicle_expenses" class="control-label">'+cardojoSettings.expense_label+' ('+cardojoSettings.expense_currency+')</label><input type="text" id="vehicle_expenses" name="vehicle_expenses['+divIdExpenses+'][price]" value="" placeholder="200" /></div><div class="cardojo-col-half"><label for="vehicle_expenses" class="control-label">'+cardojoSettings.expense_desc+'</label><textarea cols="20" rows="4" class="input-text" name="vehicle_expenses['+divIdExpenses+'][desc]" placeholder="'+cardojoSettings.expense_desc_placeholder+'"></textarea></div><div class="cardojo-col-3"><div class="delete_expense"><i class="fa fa-times" aria-hidden="true"></i> '+cardojoSettings.expense_delete+'</div></div></div>' );
        	jQuery('#vehicle_expenses_container').append( $newexpense );
        });

        jQuery('#vehicle_expenses_container').on('click', '.delete_expense', function(e) {
			jQuery(this).parent().parent().remove();
     	});

		// Car Gallery
		var image_custom_uploader, this_image_holder, attachment;
		var divId = jQuery( '#vehicle_gallery_more_images .col-md-3:last-child' ).attr( 'data-id' );

		jQuery('#vehicle_gallery_main_images').on('click', '.vehicle_gallery_image_holder_has_image', function(e) {
			this_image_holder = jQuery(this);
            this_image_holder.find('.vehicle_gallery_image_url').val('');
            this_image_holder.find('img.image-holder').attr('src', '');
            this_image_holder.find('.vehicle_gallery_image_id').val('');
            this_image_holder.removeClass("vehicle_gallery_image_holder_has_image");
            this_image_holder.addClass("vehicle_gallery_image_holder_no_image");
            this_image_holder.css("background-image", "none");
     	});

        jQuery('#vehicle_gallery_main_images').on('click', '.vehicle_gallery_image_holder_no_image', function(e) {
            e.preventDefault();

            this_image_holder = jQuery(this);

            //If the uploader object has already been created, reopen the dialog
            if (image_custom_uploader) {
                image_custom_uploader.open();
                return;
            }

            //Extend the wp.media object
            image_custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            image_custom_uploader.on('select', function() {
                attachment = image_custom_uploader.state().get('selection').first().toJSON();
                var url = '';
                url = attachment['url'];
                var attachId = '';
				attachId = attachment['id'];
				this_image_holder.find('img.image-holder').attr('src', url);
                this_image_holder.find('.vehicle_gallery_image_url').val(url);
                this_image_holder.find('.vehicle_gallery_image_id').val(attachId);
                this_image_holder.css("background-image", "url(" + url + ")");
                this_image_holder.removeClass("vehicle_gallery_image_holder_no_image");
            	this_image_holder.addClass("vehicle_gallery_image_holder_has_image");
            });

            $( "img.image-holder" ).load(function() {
            	this_image_holder.addClass("vehicle_gallery_image_loaded");
            });

            //Open the uploader dialog
            image_custom_uploader.open();
     	});

        // More images
     	jQuery('#vehicle_gallery_more_images').on('click', '.vehicle_gallery_image_holder_has_image', function(e) {
			jQuery(this).parent().remove();
     	});

        jQuery('#vehicle_gallery_more_images').on('click', '.vehicle_gallery_image_holder_no_image', function(e) {
            e.preventDefault();

            this_image_holder = jQuery(this);

            //If the uploader object has already been created, reopen the dialog
            if (image_custom_uploader) {
                image_custom_uploader.open();
                return;
            }

            //Extend the wp.media object
            image_custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            image_custom_uploader.on('select', function() {
                attachment = image_custom_uploader.state().get('selection').first().toJSON();
                var url = '';
                url = attachment['url'];
                var attachId = '';
				attachId = attachment['id'];
                this_image_holder.css("background-image", "url(" + url + ")");
                this_image_holder.removeClass("vehicle_gallery_image_holder_no_image");
            	this_image_holder.addClass("vehicle_gallery_image_holder_has_image");
            	this_image_holder.find('img.image-holder').attr('src', url);

            	this_image_holder.append( '<input type="hidden" class="vehicle_gallery_image_url" name="vehicle_image_extended_gallery['+divId+'][url]" value="" /><input type="hidden" class="vehicle_gallery_image_id" name="vehicle_image_extended_gallery['+divId+'][id]" value="" />' );
            	this_image_holder.find('.vehicle_gallery_image_url').val(url);
                this_image_holder.find('.vehicle_gallery_image_id').val(attachId);

            	divId++;
            	var $newimage = $( '<div data-id="'+divId+'" class="col-md-3 col-sm-6"><div class="vehicle_gallery_image_holder_no_image add_more_button"><img class="image-holder" src="" alt=""/><div class="vehicle_gallery_image_holder_no_image_inner"><div class="your_image_url_button"><i class="fa fa-cloud-upload" aria-hidden="true"></i>'+cardojoSettings.upload_image+'</div></div><div class="vehicle_gallery_image_holder_with_image_inner"><div class="your_image_url_button_remove"><i class="fa fa-trash" aria-hidden="true"></i>'+cardojoSettings.remove_image+'</div></div></div></div>' );
            	jQuery('#vehicle_gallery_more_images').append( $newimage );
            });

            $( "img.image-holder" ).load(function() {
            	this_image_holder.addClass("vehicle_gallery_image_loaded");
            });

            //Open the uploader dialog
            image_custom_uploader.open();
     	});

		$(".numericonly").keypress(function(event) {
		  	// Backspace, tab, enter, end, home, left, right
		  	// We don't support the del key in Opera because del == . == 46.
		  	var controlKeys = [8, 9, 13, 35, 36, 37, 39];
		  	// IE doesn't support indexOf
		  	var isControlKey = controlKeys.join(",").match(new RegExp(event.which));
		  	// Some browsers just don't raise events for control keys. Easy.
		  	// e.g. Safari backspace.
		  	if (!event.which || // Control keys in most browsers. e.g. Firefox tab is 0
		      	(49 <= event.which && event.which <= 57) || // Always 1 through 9
		      	(48 == event.which && $(this).attr("value")) || // No 0 first digit
		      	isControlKey) { // Opera assigns values for control keys.
		    	return;
		  	} else {
		    	event.preventDefault();
		  	}
		});

	  	if( jQuery("#select-car-model").exists() ) {

			var base_url = "https://www.carqueryapi.com/api/0.3/";

			//Create a variable for the CarQuery object.  You can call it whatever you like.
		    //var carquery = new CarQuery();
		    var car_init_year, car_init_make, car_init_model, car_init_trim;

		    if( jQuery("#vehicle_make_init").exists() && jQuery("#vehicle_make_init").val() != '' ) {
		    	car_init_make = jQuery("#vehicle_make_init").val();
		    }

		    if( jQuery("#vehicle_model_init").exists() && jQuery("#vehicle_model_init").val() != '' ) {
		    	car_init_model = jQuery("#vehicle_model_init").val();
		    }

		    if( jQuery("#vehicle_year_init").exists() && jQuery("#vehicle_year_init").val() != '' ) {
		    	car_init_year = jQuery("#vehicle_year_init").val();
		    }

		    if( jQuery("#vehicle_trim_id_init").exists() && jQuery("#vehicle_trim_id_init").val() != '' ) {
		    	car_init_trim = jQuery("#vehicle_trim_id_init").val();
		    }

		    $.getJSON(base_url+"?callback=?", {cmd:"getMakes"}, function(data) {

		    	if(!responseError(data)) {

				   	var options = '<option value="">Please choose a make</option>';
					var makes = data.Makes;

					for (var key in makes) {

				   	   	if (makes.hasOwnProperty(key)) {

					   	   	var s = '';
					   	   	if(car_init_make != null && car_init_make == makes[key].make_id) s = 'selected="selected"';

							options += '<option value="' + makes[key].make_id + '" '+s+'>' + makes[key].make_display + '</option>';

					   	}

					}
				
					$("select#cq-make").html(options);

			   	}

			});

		    if( car_init_make != null ) {

		    	populateModel( car_init_make );
		    	$("select#cq-model").html("<option value=''>Loading Model Data...</option>");

		    }

			$("#cq-make").change(function() {

				jQuery("#vehicle_year_init").val("");
				jQuery("#vehicle_make_init").val("");
				jQuery("#vehicle_model_init").val("");
				jQuery("#vehicle_trim_id_init").val("");
				jQuery("#vehicle_trim_desc_init").val("");
				jQuery("#vehicle_make_desc_init").val("");
				
				car_init_make = jQuery("#cq-make").val();

				populateModel( car_init_make );
				$("select#cq-model").html("");
				$("select#cq-year").html("");
				$("select#cq-trim").html("");

			});

			function populateModel( car_init_make ) {

				$.getJSON(base_url+"?callback=?", {cmd:"getModels", make:car_init_make}, function(data) {

			    	if(!responseError(data)) {

					   	var options = '<option value="">Please choose a make</option>';
						var models = data.Models;

						for (var key in models) {

					   	   	if (models.hasOwnProperty(key)) {

						   	   	var s = '';
						   	   	if(car_init_model != null && car_init_model == models[key].model_name) s = 'selected="selected"';

								options += '<option value="' + models[key].model_name + '" '+s+'>' + models[key].model_name + '</option>';

						   	}

						}
					
						$("select#cq-model").html(options);

				   	}

				});

			}

			if( car_init_model != null ) {

		    	populateYars( car_init_make, car_init_model );
		    	$("select#cq-year").html("<option value=''>Loading Years...</option>");

		    }

			$("#cq-model").change(function() {
				
				car_init_model = jQuery("#cq-model").val();

				populateYars( car_init_make, car_init_model );
				$("select#cq-year").html("");
				$("select#cq-trim").html("");

			});

			function populateYars( car_init_make, car_init_model ) {

				$.getJSON(base_url+"?callback=?", {cmd:"getTrims", make:car_init_make, model:car_init_model}, function(data) {

			    	if(!responseError(data)) {

					   	var options = '<option value="">Please choose a year</option>';
						var years = data.Trims;
						var result = [];

						for (var key in years) {

					   	   	if (years.hasOwnProperty(key)) {

					   	   		var e = years[key].model_year;

					   	   		if ($.inArray(e, result) == -1) {

					   	   			result.push(e);

					   	   			var s = '';
							   	   	if( car_init_year != null && car_init_year == e ) s = 'selected="selected"';

									options += '<option value="' + e + '" '+s+'>' +e + '</option>';

					   	   		}

						   	}

						}
					
						$("select#cq-year").html(options);

				   	}

				});

			}

			if( car_init_model != null && car_init_year != null) {

		    	populateTrims( car_init_model, car_init_year );
		    	$("select#cq-trim").html("<option value=''>Loading Trims...</option>");

		    }

			$("#cq-year").change(function() {
				
				car_init_year = jQuery("#cq-year").val();
				car_init_model = jQuery("#cq-model").val();

				populateTrims( car_init_model, car_init_year );
				$("select#cq-trim").html("<option value=''>Loading Trims...</option>");

			});

			function populateTrims( car_init_model, car_init_year ) {

				$.getJSON(base_url+"?callback=?", {cmd:"getTrims", model:car_init_model, year:car_init_year}, function(data) {

			    	if(!responseError(data)) {

					   	var options = '<option value="">Please choose a trim</option>';
						var trims = data.Trims;

						for (var key in trims) {

					   	   	if (trims.hasOwnProperty(key)) {

					   	   		var trim_display = trims[key].model_trim;
        						if(trim_display == "") trim_display = "None";

						   	   	var s = '';
						   	   	if(car_init_trim != null && car_init_trim == trims[key].model_id) s = 'selected="selected"';

								options += '<option value="' + trims[key].model_id + '" '+s+'>' + trim_display + '</option>';

						   	}

						}
					
						$("select#cq-trim").html(options);

				   	}

				});

			}

	    	//Run the carquery init function to get things started:
			//carquery.init();
		     
		    //Optionally, you can pre-select a vehicle by passing year / make / model / trim to the init function:
		    //carquery.init(car_init_year, car_init_make, car_init_model, car_init_trim);
		    //carquery.init('2000', 'dodge', 'Viper', 11636);

		    //Optional: Pass sold_in_us:true to the setFilters method to show only US models.  
			//carquery.setFilters( {sold_in_us:0} );
			
		    //Optional: initialize the year, make, model, and trim drop downs by providing their element IDs
			//carquery.initYearMakeModelTrim('cq-year', 'cq-make', 'cq-model', 'cq-trim');
			//carquery.initMakeModelTrimList('cq-make', 'cq-model', 'cq-trim', 'trim-data-list');

		    //Optional: set the onclick event for a button to show car data.
			$('#cq-show-data').click( function(e){ 

				e.preventDefault();

				//carquery.populateCarData('car-model-data');

				// My own function for pupalte car data
        
		        //Get Car Model JSON for the selected make
		    	$.getJSON(base_url+"?callback=?", {cmd:"getModel", model:car_init_trim}, function(data) {
		    	
			    	if(!responseError(data)) {

			    		//var out = sender.carDataHTML(data[0]);
			    		var model_body = data[0].model_body;
			    		if( model_body != null ) {
			    			jQuery('#vehicle_body_style option').attr('selected', false);
								jQuery("#vehicle_body_style option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_body_style").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_body_style option:contains('+ model_body +')').length) {
						    	jQuery("#vehicle_body_style option").filter(function() {
								    return $(this).text() == model_body;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_body_style').append( '<option value="'+ model_body +'" selected="selected">'+ model_body +'</option>' );
							}
							jQuery("#vehicle_body_style").addClass("bg-success");
			    		}

			    		var model_doors = data[0].model_doors;
			    		if( model_doors != null ) {
			    			jQuery('#vehicle_doors option').attr('selected', false);
							jQuery("#vehicle_doors option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_doors").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_doors option:contains('+ model_doors +')').length) {
							   	jQuery("#vehicle_doors option").filter(function() {
								    return $(this).text() == model_doors;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_doors').append( '<option value="'+ model_doors +'" selected="selected">'+ model_doors +'</option>' );
							}
							jQuery("#vehicle_doors").addClass("bg-success");
			    		}

			    		var model_seats = data[0].model_seats;
			    		if( model_seats != null ) {
			    			jQuery('#vehicle_seats option').attr('selected', false);
							jQuery("#vehicle_seats option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_seats").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_seats option:contains('+ model_seats +')').length) {
							   	jQuery("#vehicle_seats option").filter(function() {
								    return $(this).text() == model_seats;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_seats').append( '<option value="'+ model_seats +'" selected="selected">'+ model_seats +'</option>' );
							}
							jQuery("#vehicle_seats").addClass("bg-success");
			    		}

			    		var model_engine_fuel = data[0].model_engine_fuel;
			    		if( model_engine_fuel != null ) {
			    			jQuery('#vehicle_fuel_type option').attr('selected', false);
							jQuery("#vehicle_fuel_type option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_fuel_type").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_fuel_type option:contains('+ model_engine_fuel +')').length) {
							   	jQuery("#vehicle_fuel_type option").filter(function() {
								    return $(this).text() == model_engine_fuel;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_fuel_type').append( '<option value="'+ model_engine_fuel +'" selected="selected">'+ model_engine_fuel +'</option>' );
							}
							jQuery("#vehicle_fuel_type").addClass("bg-success");
			    		}

			    		var model_engine_l = data[0].model_engine_l;
			    		if( model_engine_l != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_engine_volume_l").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_engine_volume_l").val(model_engine_l);
			    			jQuery("#vehicle_engine_volume_l").addClass("bg-success");
			    		}

			    		var model_engine_cc = data[0].model_engine_cc;
			    		if( model_engine_cc != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_engine_volume_ccm").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_engine_volume_ccm").val(model_engine_cc);
			    			jQuery("#vehicle_engine_volume_ccm").addClass("bg-success");
			    		}

			    		var model_engine_position = data[0].model_engine_position;
			    		if( model_engine_position != null ) {
			    			jQuery('#vehicle_engine_position option').attr('selected', false);
							jQuery("#vehicle_engine_position option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_engine_position").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_engine_position option:contains('+ model_engine_position +')').length) {
							   	jQuery("#vehicle_engine_position option").filter(function() {
								    return $(this).text() == model_engine_position;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_engine_position').append( '<option value="'+ model_engine_position +'" selected="selected">'+ model_engine_position +'</option>' );
							}
							jQuery("#vehicle_engine_position").addClass("bg-success");
			    		}

			    		var model_engine_cyl = data[0].model_engine_cyl;
			    		if( model_engine_cyl != null ) {
			    			jQuery('#vehicle_cilinders option').attr('selected', false);
							jQuery("#vehicle_cilinders option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_cilinders").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_cilinders option:contains('+ model_engine_cyl +')').length) {
							   	jQuery("#vehicle_cilinders option").filter(function() {
								    return $(this).text() == model_engine_cyl;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_cilinders').append( '<option value="'+ model_engine_cyl +'" selected="selected">'+ model_engine_cyl +'</option>' );
							}
							jQuery("#vehicle_cilinders").addClass("bg-success");
			    		}

			    		var model_engine_power_hp = data[0].model_engine_power_hp;
			    		if( model_engine_power_hp != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_power_hp").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_power_hp").val(model_engine_power_hp);
			    			jQuery("#vehicle_power_hp").addClass("bg-success");
			    		}

			    		var model_engine_power_kw = data[0].model_engine_power_kw;
			    		if( model_engine_power_kw != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_power_kw").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_power_kw").val(model_engine_power_kw);
			    			jQuery("#vehicle_power_kw").addClass("bg-success");
			    		}

			    		var model_engine_power_rpm = data[0].model_engine_power_rpm;
			    		if( model_engine_power_rpm != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_max_power_rpm").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_max_power_rpm").val(model_engine_power_rpm);
			    			jQuery("#vehicle_max_power_rpm").addClass("bg-success");
			    		}

			    		var model_engine_torque_nm = data[0].model_engine_torque_nm;
			    		if( model_engine_torque_nm != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_torque_nm").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_torque_nm").val(model_engine_torque_nm);
			    			jQuery("#vehicle_torque_nm").addClass("bg-success");
			    		}

			    		var model_engine_torque_rpm = data[0].model_engine_torque_rpm;
			    		if( model_engine_torque_rpm != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_max_torque_rpm").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_max_torque_rpm").val(model_engine_torque_rpm);
			    			jQuery("#vehicle_max_torque_rpm").addClass("bg-success");
			    		}

			    		var model_engine_type = data[0].model_engine_type;
			    		if( model_engine_type != null ) {
			    			jQuery('#vehicle_engine_type option').attr('selected', false);
							jQuery("#vehicle_engine_type option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_engine_type").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_engine_type option:contains('+ model_engine_type +')').length) {
							   	jQuery("#vehicle_engine_type option").filter(function() {
								    return $(this).text() == model_engine_type;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_engine_type').append( '<option value="'+ model_engine_type +'" selected="selected">'+ model_engine_type +'</option>' );
							}
							jQuery("#vehicle_engine_type").addClass("bg-success");
			    		}

			    		var model_transmission_type = data[0].model_transmission_type;
			    		if( model_transmission_type != null ) {
			    			jQuery('#vehicle_transmission option').attr('selected', false);
							jQuery("#vehicle_transmission option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_transmission").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_transmission option:contains('+ model_transmission_type +')').length) {
							   	jQuery("#vehicle_transmission option").filter(function() {
								    return $(this).text() == model_transmission_type;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_transmission').append( '<option value="'+ model_transmission_type +'" selected="selected">'+ model_transmission_type +'</option>' );
							}
							jQuery("#vehicle_transmission").addClass("bg-success");
			    		}

			    		var model_drive = data[0].model_drive;
			    		if( model_drive != null ) {
			    			jQuery('#vehicle_drive option').attr('selected', false);
							jQuery("#vehicle_drive option:selected").removeAttr("selected");
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_drive").offset().top - 100
						    }, 200);
						    if (jQuery('#vehicle_drive option:contains('+ model_drive +')').length) {
							   	jQuery("#vehicle_drive option").filter(function() {
								    return $(this).text() == model_drive;
								}).attr('selected', 'selected');
							} else {
								jQuery('#vehicle_drive').append( '<option value="'+ model_drive +'" selected="selected">'+ model_drive +'</option>' );
							}
							jQuery("#vehicle_drive").addClass("bg-success");
			    		}

			    		var model_0_to_100_kph = data[0].model_0_to_100_kph;
			    		if( model_0_to_100_kph != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_accel_0_100").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_accel_0_100").val(model_0_to_100_kph);
			    			jQuery("#vehicle_accel_0_100").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var consumption_mixed = data[0].model_lkm_mixed;
			    		} else {
			    			var consumption_mixed = data[0].model_mpg_mixed;
			    		}
			    		if( consumption_mixed != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_consumption_combined").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_consumption_combined").val(consumption_mixed);
			    			jQuery("#vehicle_consumption_combined").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var consumption_urban = data[0].model_lkm_city;
			    		} else {
			    			var consumption_urban = data[0].model_mpg_city;
			    		}
			    		if( consumption_urban != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_consumption_urban").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_consumption_urban").val(consumption_urban);
			    			jQuery("#vehicle_consumption_urban").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var consumption_highway = data[0].model_lkm_hwy;
			    		} else {
			    			var consumption_highway = data[0].model_mpg_hwy;
			    		}
			    		if( consumption_highway != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_consumption_highway").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_consumption_highway").val(consumption_highway);
			    			jQuery("#vehicle_consumption_highway").addClass("bg-success");
			    		}

			    		var model_co2 = data[0].model_co2;
			    		if( model_co2 != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_emissions").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_emissions").val(model_co2);
			    			jQuery("#vehicle_emissions").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var vehicle_fuel_tank = data[0].model_fuel_cap_l;
			    		} else {
			    			var vehicle_fuel_tank = data[0].model_fuel_cap_g;
			    		}
			    		if( vehicle_fuel_tank != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_fuel_tank").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_fuel_tank").val(vehicle_fuel_tank);
			    			jQuery("#vehicle_fuel_tank").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var vehicle_length = data[0].model_length_mm;
			    		} else {
			    			var vehicle_length = data[0].model_length_in;
			    		}
			    		if( vehicle_length != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_length").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_length").val(vehicle_length);
			    			jQuery("#vehicle_length").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var vehicle_width = data[0].model_width_mm;
			    		} else {
			    			var vehicle_width = data[0].model_width_in;
			    		}
			    		if( vehicle_width != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_width").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_width").val(vehicle_width);
			    			jQuery("#vehicle_width").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var vehicle_height = data[0].model_height_mm;
			    		} else {
			    			var vehicle_height = data[0].model_height_in;
			    		}
			    		if( vehicle_height != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_height").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_height").val(vehicle_height);
			    			jQuery("#vehicle_height").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var vehicle_wheelbase = data[0].model_wheelbase_mm;
			    		} else {
			    			var vehicle_wheelbase = data[0].model_wheelbase_in;
			    		}
			    		if( vehicle_wheelbase != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_wheelbase").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_wheelbase").val(vehicle_wheelbase);
			    			jQuery("#vehicle_wheelbase").addClass("bg-success");
			    		}

			    		if( cardojoSettings.measurement_type == "metric" ) {
			    			var vehicle_weight = data[0].model_weight_kg;
			    		} else {
			    			var vehicle_weight = data[0].model_weight_lbs;
			    		}
			    		if( vehicle_weight != null ) {
			    			$('html, body').animate({
						        scrollTop: $("#vehicle_weight").offset().top - 100
						    }, 200);
			    			jQuery("#vehicle_weight").val(vehicle_weight);
			    			jQuery("#vehicle_weight").addClass("bg-success");
			    		}

			    		console.log(data[0]);

			        }

		        });

		        // End

			});

		    //Optional: initialize the make, model, trim lists by providing their element IDs.
			//carquery.initMakeModelTrimList('cq-make', 'cq-model', 'cq-trim', 'trim-data-list');

		    //Optional: set minimum and/or maximum year options.
			//carquery.year_select_min = 1941;
			//carquery.year_select_max = 2017;
		 
		    //Optional: initialize search interface elements.
		    //The IDs provided below are the IDs of the text and select inputs that will be used to set the search criteria.
		    //All values are optional, and will be set to the default values provided below if not specified.
		     
			var searchArgs = ({
		         body_id:                       "cq-body"
		        ,default_search_text:           "Keyword Search"
		        ,doors_id:                      "cq-doors"
		        ,drive_id:                      "cq-drive"
		        ,engine_position_id:            "cq-engine-position"
		        ,engine_type_id:                "cq-engine-type"
		        ,fuel_type_id:                  "cq-fuel-type"
		        ,min_cylinders_id:              "cq-min-cylinders"
		        ,min_mpg_hwy_id:                "cq-min-mpg-hwy"
		        ,min_power_id:                  "cq-min-power"
		        ,min_top_speed_id:              "cq-min-top-speed"
		        ,min_torque_id:                 "cq-min-torque"
		        ,min_weight_id:                 "cq-min-weight"
		        ,min_year_id:                   "cq-min-year"
		        ,max_cylinders_id:              "cq-max-cylinders"
		        ,max_mpg_hwy_id:                "cq-max-mpg-hwy"
		        ,max_power_id:                  "cq-max-power"
		        ,max_top_speed_id:              "cq-max-top-speed"
		        ,max_weight_id:                 "cq-max-weight"
		        ,max_year_id:                   "cq-max-year"
		        ,search_controls_id:            "cq-search-controls"
		        ,search_input_id:               "cq-search-input"
		        ,search_results_id:             "cq-search-results"
		        ,search_result_id:              "cq-search-result"
		        ,seats_id:                      "cq-seats"
		    }); 
			 
		    //carquery.initSearchInterface(searchArgs);

		    // If creating a search interface, set onclick event for the search button.  Make sure the ID used matches your search button ID.
			$('#cq-search-btn').click( function(){ 
				//carquery.search(); 
			});

			$("#cq-trim").change(function() {
				jQuery("#vehicle_trim_desc_init").val( $("#cq-trim option:selected").text() );
				car_init_trim = jQuery("#cq-trim option:selected").val();
			});

			$("#cq-make").change(function() {
				jQuery("#vehicle_make_desc_init").val( $("#cq-make option:selected").text() );
				jQuery(".bg-success").removeClass("bg-success");
			});

			function responseError(data)
		    {
		    	if(typeof data.error != 'undefined' && data.error != '')
			{
			 	alert(data.error);
				return true;
			}
			else
				return false;
		    }

		}

  	});
	///// end document ready /////

})( jQuery );
