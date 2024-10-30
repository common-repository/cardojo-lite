<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Template Functions
 *
 * Template functions specifically created for car listings
 *
 * @author 		Alex Gurghis
 * @category 	Core
 * @package 	CarDojo/Template
 * @version     1.0.2
 */

/**
 * Get and include template files.
 *
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function get_cardojo_template( $template_name, $args = array(), $template_path = 'cardojo', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}
	include( locate_cardojo_template( $template_name, $template_path, $default_path ) );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @param string $template_name
 * @param string $template_path (default: 'cardojo')
 * @param string|bool $default_path (default: '') False to not load a default
 * @return string
 */
function locate_cardojo_template( $template_name, $template_path = 'cardojo', $default_path = '' ) {
	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template && $default_path !== false ) {
		$default_path = $default_path ? $default_path : CARDOJO_PLUGIN_DIR . '/templates/';
		if ( file_exists( trailingslashit( $default_path ) . $template_name ) ) {
			$template = trailingslashit( $default_path ) . $template_name;
		}
	}

	// Return what we found
	return apply_filters( 'cardojo_locate_template', $template, $template_name, $template_path );
}

/**
 * Get template part (for templates in loops).
 *
 * @param string $slug
 * @param string $name (default: '')
 * @param string $template_path (default: 'cardojo')
 * @param string|bool $default_path (default: '') False to not load a default
 */
function get_cardojo_template_part( $slug, $name = '', $template_path = 'cardojo', $default_path = '' ) {
	$template = '';

	if ( $name ) {
		$template = locate_cardojo_template( "{$slug}-{$name}.php", $template_path, $default_path );
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/cardojo/slug.php
	if ( ! $template ) {
		$template = locate_cardojo_template( "{$slug}.php", $template_path, $default_path );
	}

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 * Add custom body classes
 * @param  array $classes
 * @return array
 */
function cardojo_body_class( $classes ) {
	$classes   = (array) $classes;
	$classes[] = sanitize_title( wp_get_theme() );

	return array_unique( $classes );
}

add_filter( 'body_class', 'cardojo_body_class' );

/**
 * Return whether or not the position has been marked as sold
 *
 * @param  object $post
 * @return boolean
 */
function is_position_sold( $post = null ) {
	$post = get_post( $post );
	return $post->_sold ? true : false;
}

/**
 * Return whether or not the position has been featured
 *
 * @param  object $post
 * @return boolean
 */
function is_position_featured( $post = null ) {
	$post = get_post( $post );
	return $post->_featured ? true : false;
}

/**
 * Return whether or not the position has been featured
 *
 * @param  object $post
 * @return boolean
 */
function is_position_promoted( $post = null ) {
	$post = get_post( $post );
	return $post->_promoted ? true : false;
}

/**
 * the_car_permalink function.
 *
 * @access public
 * @return void
 */
function the_car_permalink( $post = null ) {
	echo get_the_car_permalink( $post );
}

/**
 * get_the_car_permalink function.
 *
 * @access public
 * @param mixed $post (default: null)
 * @return string
 */
function get_the_car_permalink( $post = null ) {
	$post = get_post( $post );
	$link = get_permalink( $post );

	return apply_filters( 'the_car_permalink', $link, $post );
}

/**
 * the_car_location function.
 * @param  boolean $map_link whether or not to link to google maps
 * @return [type]
 */
function the_car_location( $map_link = true, $post = null ) {
	$location = get_the_car_location( $post );

	if ( $location ) {
		if ( $map_link ) {
			// If linking to google maps, we don't want anything but text here
			echo apply_filters( 'the_car_location_map_link', '<a class="google_map_link" href="' . esc_url( 'http://maps.google.com/maps?q=' . urlencode( strip_tags( $location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ) . '" target="_blank">' . esc_html( strip_tags( $location ) ) . '</a>', $location, $post );
		} else {
			echo wp_kses_post( $location );
		}
	} else {
		echo wp_kses_post( apply_filters( 'the_car_location_anywhere_text', __( 'Anywhere', 'cardojo' ) ) );
	}
}

/**
 * get_the_car_location function.
 *
 * @access public
 * @param mixed $post (default: null)
 * @return void
 */
function get_the_car_location( $post = null ) {
	$post = get_post( $post );
	if ( $post->post_type !== 'vehicle' ) {
		return;
	}

	return apply_filters( 'the_car_location', $post->_car_location, $post );
}

/**
 * car_class function.
 *
 * @access public
 * @param string $class (default: '')
 * @param mixed $post_id (default: null)
 * @return void
 */
function car_class( $class = '', $post_id = null ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', get_car_class( $class, $post_id ) ) . '"';
}

/**
 * get_car_class function.
 *
 * @access public
 * @return array
 */
function get_car_class( $class = '', $post_id = null ) {
	if ( ! get_option( 'cardojo_enable_types' ) ) {
		return get_post_class( array( 'car_classes' ), $post_id );
	}

	$post = get_post( $post_id );

	if ( $post->post_type !== 'vehicle' ) {
		return array();
	}

	$classes = array();

	if ( empty( $post ) ) {
		return $classes;
	}

	$classes[] = 'car';

	if ( is_position_featured( $post ) ) {
		$classes[] = 'car_featured';
	}

	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	}

	return get_post_class( $classes, $post->ID );
}

