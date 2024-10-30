(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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

	$(document).ready(
	
	function() {

		jQuery.fn.exists = function(){return this.length>0;}

		$("#cq-make").change(function() {
			jQuery("#vehicle_make_desc_init").val( $("#cq-make").val() );
		});

		$("#cq-trim").change(function() {
			jQuery("#vehicle_trim_desc_init").val( $("#cq-trim").val() );
		});

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

			jQuery( ".date_picker_past" ).datepicker({
		      	changeMonth: true,
		      	changeYear: true,
		      	yearRange: "-100:-15",
		      	setDate: new Date(),
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

		if( jQuery("#cardojo-color-field").exists() ) {
			jQuery( '.cardojo-color-field' ).wpColorPicker();
		}

		jQuery('.cardojo-select-color').change(function(){
		    var value = jQuery( 'input.cardojo-select-color:checked' ).val();
		    jQuery("#vehicle_exterior_color").val(value);
		});

		jQuery('.cardojo-select-interior-color').change(function(){
		    var value = jQuery( 'input.cardojo-select-interior-color:checked' ).val();
		    jQuery("#vehicle_interior_color").val(value);
		});

		if ( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ) {
	        jQuery( '#cardojo-term-color' ).wpColorPicker();
	    } else {
	        jQuery( '#colorpicker' ).farbtastic( '#cardojo-term-color' );
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
		var divId = jQuery( '#vehicle_expenses_container .vehicle_expenses_item:last-child' ).attr( 'data-id' );

		jQuery('#car_expenses').on('click', '.add_new_expense', function(e) {
            e.preventDefault();

            divId++;

            var $newexpense = $( '<div class="vehicle_expenses_item" data-id="'+divId+'"><div class="cardojo-col-3"><label for="vehicle_expenses" class="control-label">'+cardojoSettings.expense_label+' ('+cardojoSettings.expense_currency+')</label><input type="text" id="vehicle_expenses" name="vehicle_expenses['+divId+'][price]" value="" placeholder="200" /></div><div class="cardojo-col-half"><label for="vehicle_expenses" class="control-label">'+cardojoSettings.expense_desc+'</label><textarea cols="20" rows="4" class="input-text" name="vehicle_expenses['+divId+'][desc]" placeholder="'+cardojoSettings.expense_desc_placeholder+'"></textarea></div><div class="cardojo-col-3"><div class="delete_expense"><i class="fa fa-times" aria-hidden="true"></i> '+cardojoSettings.expense_delete+'</div></div></div>' );
        	jQuery('#vehicle_expenses_container').append( $newexpense );
        });

        jQuery('#vehicle_expenses_container').on('click', '.delete_expense', function(e) {
			jQuery(this).parent().parent().remove();
     	});

		// Car Gallery
		var image_custom_uploader, this_image_holder, attachment;
		var divId = jQuery( '#vehicle_gallery_more_images .cardojo-col-5:last-child' ).attr( 'data-id' );

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
            	var $newimage = $( '<div data-id="'+divId+'" class="cardojo-col-5"><div class="vehicle_gallery_image_holder_no_image add_more_button"><img class="image-holder" src="" alt=""/><div class="vehicle_gallery_image_holder_no_image_inner"><div class="your_image_url_button"><i class="fa fa-cloud-upload" aria-hidden="true"></i>'+cardojoSettings.upload_image+'</div></div><div class="vehicle_gallery_image_holder_with_image_inner"><div class="your_image_url_button_remove"><i class="fa fa-trash" aria-hidden="true"></i>'+cardojoSettings.remove_image+'</div></div></div></div>' );
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

})( jQuery );
