<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Template Core Functions
 *
 * Template Core Functions specifically created for car listings
 *
 * @author 		Alex Gurghis
 * @category 	Core
 * @package 	CarDojo/Core Functions
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

// Core Functions

/**
 * Get the price format depending on the currency position.
 *
 * @return string
 */
function get_cardojo_price_format() {
	$currency_pos = get_option( 'cardojo_currency_position' );
	$format = '%1$s%2$s';

	switch ( $currency_pos ) {
		case 'left' :
			$format = '%1$s%2$s';
		break;
		case 'right' :
			$format = '%2$s%1$s';
		break;
		case 'left_space' :
			$format = '%1$s&nbsp;%2$s';
		break;
		case 'right_space' :
			$format = '%2$s&nbsp;%1$s';
		break;
	}

	return apply_filters( 'cardojo_price_format', $format, $currency_pos );
}

/**
 * cardojo_get_price_thousand_separator function.
 *
 * @access public
 * @return array
 */
function cardojo_get_price_thousand_separator() {
	$separator = apply_filters( 'cardojo_get_price_thousand_separator', get_option( 'cardojo_thousand_separator' ) );
	return $separator ? stripslashes( $separator ) : '.';
}

/**
 * Return the decimal separator for prices.
 * @since  2.3
 * @return string
 */
function cardojo_get_price_decimal_separator() {
	$separator = apply_filters( 'cardojo_get_price_decimal_separator', get_option( 'cardojo_decimal_separator' ) );
	return $separator ? stripslashes( $separator ) : '.';
}

/**
 * Return the number of decimals after the decimal point.
 * @since  2.3
 * @return int
 */
function cardojo_get_price_decimals() {
	$decimals = apply_filters( 'cardojo_get_price_decimals', get_option( 'cardojo_price_num_decimals', 2 ) );
	return absint( $decimals );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * @param string|array $var
 * @return string|array
 */
function cardojo_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'cardojo_clean', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	}
}

/**
 * cardojo_format_decimal function.
 *
 * @access public
 * @return array
 */
function cardojo_format_decimal( $number, $dp = false, $trim_zeros = false ) {
	$locale   = localeconv();
	$decimals = array( cardojo_get_price_thousand_separator(), $locale['decimal_point'], $locale['mon_decimal_point'] );

	// Remove locale from string.
	if ( ! is_float( $number ) ) {
		$number = cardojo_clean( str_replace( $decimals, '.', $number ) );
		$number = preg_replace( '/[^0-9\.,-]/', '', $number );
	}

	if ( false !== $dp ) {
		$dp     = intval( '' == $dp ? wc_get_price_decimals() : $dp );
		$number = number_format( floatval( $number ), $dp, '.', '' );

	// DP is false - don't use number format, just return a string in our format
	} elseif ( is_float( $number ) ) {
		$number = cardojo_clean( str_replace( $decimals, '.', strval( $number ) ) );
	}

	if ( $trim_zeros && strstr( $number, '.' ) ) {
		$number = rtrim( rtrim( $number, '0' ), '.' );
	}

	return $number;
}

/**
 * Get Base Currency Code.
 *
 * @return string
 */
function get_cardojo_currency() {
	return apply_filters( 'cardojo_currency', get_option( 'cardojo_currency' ) );
}

/**
 * Get Forms SSL Validation
 *
 * @return string
 */
function get_cardojo_ssl_hide_forms() {
	return apply_filters( 'cardojo_ssl_hide_forms', get_option( 'cardojo_ssl_hide_forms' ) );
}

/**
 * Get Google Map API Key
 *
 * @return string
 */
function get_google_map_api_key() {
	return apply_filters( 'cardojo_googlemap_key', get_option( 'cardojo_googlemap_key' ) );
}


/**
 * Get full list of currency codes.
 *
 * @return array
 */
function get_cardojo_currencies() {
	return array_unique(
		apply_filters( 'cardojo_currencies',
			array(
				'AED' => __( 'United Arab Emirates dirham', 'cardojo' ),
				'AFN' => __( 'Afghan afghani', 'cardojo' ),
				'ALL' => __( 'Albanian lek', 'cardojo' ),
				'AMD' => __( 'Armenian dram', 'cardojo' ),
				'ANG' => __( 'Netherlands Antillean guilder', 'cardojo' ),
				'AOA' => __( 'Angolan kwanza', 'cardojo' ),
				'ARS' => __( 'Argentine peso', 'cardojo' ),
				'AUD' => __( 'Australian dollar', 'cardojo' ),
				'AWG' => __( 'Aruban florin', 'cardojo' ),
				'AZN' => __( 'Azerbaijani manat', 'cardojo' ),
				'BAM' => __( 'Bosnia and Herzegovina convertible mark', 'cardojo' ),
				'BBD' => __( 'Barbadian dollar', 'cardojo' ),
				'BDT' => __( 'Bangladeshi taka', 'cardojo' ),
				'BGN' => __( 'Bulgarian lev', 'cardojo' ),
				'BHD' => __( 'Bahraini dinar', 'cardojo' ),
				'BIF' => __( 'Burundian franc', 'cardojo' ),
				'BMD' => __( 'Bermudian dollar', 'cardojo' ),
				'BND' => __( 'Brunei dollar', 'cardojo' ),
				'BOB' => __( 'Bolivian boliviano', 'cardojo' ),
				'BRL' => __( 'Brazilian real', 'cardojo' ),
				'BSD' => __( 'Bahamian dollar', 'cardojo' ),
				'BTC' => __( 'Bitcoin', 'cardojo' ),
				'BTN' => __( 'Bhutanese ngultrum', 'cardojo' ),
				'BWP' => __( 'Botswana pula', 'cardojo' ),
				'BYR' => __( 'Belarusian ruble', 'cardojo' ),
				'BZD' => __( 'Belize dollar', 'cardojo' ),
				'CAD' => __( 'Canadian dollar', 'cardojo' ),
				'CDF' => __( 'Congolese franc', 'cardojo' ),
				'CHF' => __( 'Swiss franc', 'cardojo' ),
				'CLP' => __( 'Chilean peso', 'cardojo' ),
				'CNY' => __( 'Chinese yuan', 'cardojo' ),
				'COP' => __( 'Colombian peso', 'cardojo' ),
				'CRC' => __( 'Costa Rican col&oacute;n', 'cardojo' ),
				'CUC' => __( 'Cuban convertible peso', 'cardojo' ),
				'CUP' => __( 'Cuban peso', 'cardojo' ),
				'CVE' => __( 'Cape Verdean escudo', 'cardojo' ),
				'CZK' => __( 'Czech koruna', 'cardojo' ),
				'DJF' => __( 'Djiboutian franc', 'cardojo' ),
				'DKK' => __( 'Danish krone', 'cardojo' ),
				'DOP' => __( 'Dominican peso', 'cardojo' ),
				'DZD' => __( 'Algerian dinar', 'cardojo' ),
				'EGP' => __( 'Egyptian pound', 'cardojo' ),
				'ERN' => __( 'Eritrean nakfa', 'cardojo' ),
				'ETB' => __( 'Ethiopian birr', 'cardojo' ),
				'EUR' => __( 'Euro', 'cardojo' ),
				'FJD' => __( 'Fijian dollar', 'cardojo' ),
				'FKP' => __( 'Falkland Islands pound', 'cardojo' ),
				'GBP' => __( 'Pound sterling', 'cardojo' ),
				'GEL' => __( 'Georgian lari', 'cardojo' ),
				'GGP' => __( 'Guernsey pound', 'cardojo' ),
				'GHS' => __( 'Ghana cedi', 'cardojo' ),
				'GIP' => __( 'Gibraltar pound', 'cardojo' ),
				'GMD' => __( 'Gambian dalasi', 'cardojo' ),
				'GNF' => __( 'Guinean franc', 'cardojo' ),
				'GTQ' => __( 'Guatemalan quetzal', 'cardojo' ),
				'GYD' => __( 'Guyanese dollar', 'cardojo' ),
				'HKD' => __( 'Hong Kong dollar', 'cardojo' ),
				'HNL' => __( 'Honduran lempira', 'cardojo' ),
				'HRK' => __( 'Croatian kuna', 'cardojo' ),
				'HTG' => __( 'Haitian gourde', 'cardojo' ),
				'HUF' => __( 'Hungarian forint', 'cardojo' ),
				'IDR' => __( 'Indonesian rupiah', 'cardojo' ),
				'ILS' => __( 'Israeli new shekel', 'cardojo' ),
				'IMP' => __( 'Manx pound', 'cardojo' ),
				'INR' => __( 'Indian rupee', 'cardojo' ),
				'IQD' => __( 'Iraqi dinar', 'cardojo' ),
				'IRR' => __( 'Iranian rial', 'cardojo' ),
				'IRT' => __( 'Iranian toman', 'cardojo' ),
				'ISK' => __( 'Icelandic kr&oacute;na', 'cardojo' ),
				'JEP' => __( 'Jersey pound', 'cardojo' ),
				'JMD' => __( 'Jamaican dollar', 'cardojo' ),
				'JOD' => __( 'Jordanian dinar', 'cardojo' ),
				'JPY' => __( 'Japanese yen', 'cardojo' ),
				'KES' => __( 'Kenyan shilling', 'cardojo' ),
				'KGS' => __( 'Kyrgyzstani som', 'cardojo' ),
				'KHR' => __( 'Cambodian riel', 'cardojo' ),
				'KMF' => __( 'Comorian franc', 'cardojo' ),
				'KPW' => __( 'North Korean won', 'cardojo' ),
				'KRW' => __( 'South Korean won', 'cardojo' ),
				'KWD' => __( 'Kuwaiti dinar', 'cardojo' ),
				'KYD' => __( 'Cayman Islands dollar', 'cardojo' ),
				'KZT' => __( 'Kazakhstani tenge', 'cardojo' ),
				'LAK' => __( 'Lao kip', 'cardojo' ),
				'LBP' => __( 'Lebanese pound', 'cardojo' ),
				'LKR' => __( 'Sri Lankan rupee', 'cardojo' ),
				'LRD' => __( 'Liberian dollar', 'cardojo' ),
				'LSL' => __( 'Lesotho loti', 'cardojo' ),
				'LYD' => __( 'Libyan dinar', 'cardojo' ),
				'MAD' => __( 'Moroccan dirham', 'cardojo' ),
				'MDL' => __( 'Moldovan leu', 'cardojo' ),
				'MGA' => __( 'Malagasy ariary', 'cardojo' ),
				'MKD' => __( 'Macedonian denar', 'cardojo' ),
				'MMK' => __( 'Burmese kyat', 'cardojo' ),
				'MNT' => __( 'Mongolian t&ouml;gr&ouml;g', 'cardojo' ),
				'MOP' => __( 'Macanese pataca', 'cardojo' ),
				'MRO' => __( 'Mauritanian ouguiya', 'cardojo' ),
				'MUR' => __( 'Mauritian rupee', 'cardojo' ),
				'MVR' => __( 'Maldivian rufiyaa', 'cardojo' ),
				'MWK' => __( 'Malawian kwacha', 'cardojo' ),
				'MXN' => __( 'Mexican peso', 'cardojo' ),
				'MYR' => __( 'Malaysian ringgit', 'cardojo' ),
				'MZN' => __( 'Mozambican metical', 'cardojo' ),
				'NAD' => __( 'Namibian dollar', 'cardojo' ),
				'NGN' => __( 'Nigerian naira', 'cardojo' ),
				'NIO' => __( 'Nicaraguan c&oacute;rdoba', 'cardojo' ),
				'NOK' => __( 'Norwegian krone', 'cardojo' ),
				'NPR' => __( 'Nepalese rupee', 'cardojo' ),
				'NZD' => __( 'New Zealand dollar', 'cardojo' ),
				'OMR' => __( 'Omani rial', 'cardojo' ),
				'PAB' => __( 'Panamanian balboa', 'cardojo' ),
				'PEN' => __( 'Peruvian nuevo sol', 'cardojo' ),
				'PGK' => __( 'Papua New Guinean kina', 'cardojo' ),
				'PHP' => __( 'Philippine peso', 'cardojo' ),
				'PKR' => __( 'Pakistani rupee', 'cardojo' ),
				'PLN' => __( 'Polish z&#x142;oty', 'cardojo' ),
				'PRB' => __( 'Transnistrian ruble', 'cardojo' ),
				'PYG' => __( 'Paraguayan guaran&iacute;', 'cardojo' ),
				'QAR' => __( 'Qatari riyal', 'cardojo' ),
				'RON' => __( 'Romanian leu', 'cardojo' ),
				'RSD' => __( 'Serbian dinar', 'cardojo' ),
				'RUB' => __( 'Russian ruble', 'cardojo' ),
				'RWF' => __( 'Rwandan franc', 'cardojo' ),
				'SAR' => __( 'Saudi riyal', 'cardojo' ),
				'SBD' => __( 'Solomon Islands dollar', 'cardojo' ),
				'SCR' => __( 'Seychellois rupee', 'cardojo' ),
				'SDG' => __( 'Sudanese pound', 'cardojo' ),
				'SEK' => __( 'Swedish krona', 'cardojo' ),
				'SGD' => __( 'Singapore dollar', 'cardojo' ),
				'SHP' => __( 'Saint Helena pound', 'cardojo' ),
				'SLL' => __( 'Sierra Leonean leone', 'cardojo' ),
				'SOS' => __( 'Somali shilling', 'cardojo' ),
				'SRD' => __( 'Surinamese dollar', 'cardojo' ),
				'SSP' => __( 'South Sudanese pound', 'cardojo' ),
				'STD' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra', 'cardojo' ),
				'SYP' => __( 'Syrian pound', 'cardojo' ),
				'SZL' => __( 'Swazi lilangeni', 'cardojo' ),
				'THB' => __( 'Thai baht', 'cardojo' ),
				'TJS' => __( 'Tajikistani somoni', 'cardojo' ),
				'TMT' => __( 'Turkmenistan manat', 'cardojo' ),
				'TND' => __( 'Tunisian dinar', 'cardojo' ),
				'TOP' => __( 'Tongan pa&#x2bb;anga', 'cardojo' ),
				'TRY' => __( 'Turkish lira', 'cardojo' ),
				'TTD' => __( 'Trinidad and Tobago dollar', 'cardojo' ),
				'TWD' => __( 'New Taiwan dollar', 'cardojo' ),
				'TZS' => __( 'Tanzanian shilling', 'cardojo' ),
				'UAH' => __( 'Ukrainian hryvnia', 'cardojo' ),
				'UGX' => __( 'Ugandan shilling', 'cardojo' ),
				'USD' => __( 'United States dollar', 'cardojo' ),
				'UYU' => __( 'Uruguayan peso', 'cardojo' ),
				'UZS' => __( 'Uzbekistani som', 'cardojo' ),
				'VEF' => __( 'Venezuelan bol&iacute;var', 'cardojo' ),
				'VND' => __( 'Vietnamese &#x111;&#x1ed3;ng', 'cardojo' ),
				'VUV' => __( 'Vanuatu vatu', 'cardojo' ),
				'WST' => __( 'Samoan t&#x101;l&#x101;', 'cardojo' ),
				'XAF' => __( 'Central African CFA franc', 'cardojo' ),
				'XCD' => __( 'East Caribbean dollar', 'cardojo' ),
				'XOF' => __( 'West African CFA franc', 'cardojo' ),
				'XPF' => __( 'CFP franc', 'cardojo' ),
				'YER' => __( 'Yemeni rial', 'cardojo' ),
				'ZAR' => __( 'South African rand', 'cardojo' ),
				'ZMW' => __( 'Zambian kwacha', 'cardojo' ),
			)
		)
	);
}

/**
 * Get Currency symbol.
 *
 * @param string $currency (default: '')
 * @return string
 */
function get_cardojo_currency_symbol( $currency = '' ) {
	if ( ! $currency ) {
		$currency = get_cardojo_currency();
	}

	$symbols = apply_filters( 'cardojo_currency_symbols', array(
		'AED' => '&#x62f;.&#x625;',
		'AFN' => '&#x60b;',
		'ALL' => 'L',
		'AMD' => 'AMD',
		'ANG' => '&fnof;',
		'AOA' => 'Kz',
		'ARS' => '&#36;',
		'AUD' => '&#36;',
		'AWG' => '&fnof;',
		'AZN' => 'AZN',
		'BAM' => 'KM',
		'BBD' => '&#36;',
		'BDT' => '&#2547;&nbsp;',
		'BGN' => '&#1083;&#1074;.',
		'BHD' => '.&#x62f;.&#x628;',
		'BIF' => 'Fr',
		'BMD' => '&#36;',
		'BND' => '&#36;',
		'BOB' => 'Bs.',
		'BRL' => '&#82;&#36;',
		'BSD' => '&#36;',
		'BTC' => '&#3647;',
		'BTN' => 'Nu.',
		'BWP' => 'P',
		'BYR' => 'Br',
		'BZD' => '&#36;',
		'CAD' => '&#36;',
		'CDF' => 'Fr',
		'CHF' => '&#67;&#72;&#70;',
		'CLP' => '&#36;',
		'CNY' => '&yen;',
		'COP' => '&#36;',
		'CRC' => '&#x20a1;',
		'CUC' => '&#36;',
		'CUP' => '&#36;',
		'CVE' => '&#36;',
		'CZK' => '&#75;&#269;',
		'DJF' => 'Fr',
		'DKK' => 'DKK',
		'DOP' => 'RD&#36;',
		'DZD' => '&#x62f;.&#x62c;',
		'EGP' => 'EGP',
		'ERN' => 'Nfk',
		'ETB' => 'Br',
		'EUR' => '&euro;',
		'FJD' => '&#36;',
		'FKP' => '&pound;',
		'GBP' => '&pound;',
		'GEL' => '&#x10da;',
		'GGP' => '&pound;',
		'GHS' => '&#x20b5;',
		'GIP' => '&pound;',
		'GMD' => 'D',
		'GNF' => 'Fr',
		'GTQ' => 'Q',
		'GYD' => '&#36;',
		'HKD' => '&#36;',
		'HNL' => 'L',
		'HRK' => 'Kn',
		'HTG' => 'G',
		'HUF' => '&#70;&#116;',
		'IDR' => 'Rp',
		'ILS' => '&#8362;',
		'IMP' => '&pound;',
		'INR' => '&#8377;',
		'IQD' => '&#x639;.&#x62f;',
		'IRR' => '&#xfdfc;',
		'IRT' => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
		'ISK' => 'kr.',
		'JEP' => '&pound;',
		'JMD' => '&#36;',
		'JOD' => '&#x62f;.&#x627;',
		'JPY' => '&yen;',
		'KES' => 'KSh',
		'KGS' => '&#x441;&#x43e;&#x43c;',
		'KHR' => '&#x17db;',
		'KMF' => 'Fr',
		'KPW' => '&#x20a9;',
		'KRW' => '&#8361;',
		'KWD' => '&#x62f;.&#x643;',
		'KYD' => '&#36;',
		'KZT' => 'KZT',
		'LAK' => '&#8365;',
		'LBP' => '&#x644;.&#x644;',
		'LKR' => '&#xdbb;&#xdd4;',
		'LRD' => '&#36;',
		'LSL' => 'L',
		'LYD' => '&#x644;.&#x62f;',
		'MAD' => '&#x62f;.&#x645;.',
		'MDL' => 'MDL',
		'MGA' => 'Ar',
		'MKD' => '&#x434;&#x435;&#x43d;',
		'MMK' => 'Ks',
		'MNT' => '&#x20ae;',
		'MOP' => 'P',
		'MRO' => 'UM',
		'MUR' => '&#x20a8;',
		'MVR' => '.&#x783;',
		'MWK' => 'MK',
		'MXN' => '&#36;',
		'MYR' => '&#82;&#77;',
		'MZN' => 'MT',
		'NAD' => '&#36;',
		'NGN' => '&#8358;',
		'NIO' => 'C&#36;',
		'NOK' => '&#107;&#114;',
		'NPR' => '&#8360;',
		'NZD' => '&#36;',
		'OMR' => '&#x631;.&#x639;.',
		'PAB' => 'B/.',
		'PEN' => 'S/.',
		'PGK' => 'K',
		'PHP' => '&#8369;',
		'PKR' => '&#8360;',
		'PLN' => '&#122;&#322;',
		'PRB' => '&#x440;.',
		'PYG' => '&#8370;',
		'QAR' => '&#x631;.&#x642;',
		'RMB' => '&yen;',
		'RON' => 'lei',
		'RSD' => '&#x434;&#x438;&#x43d;.',
		'RUB' => '&#8381;',
		'RWF' => 'Fr',
		'SAR' => '&#x631;.&#x633;',
		'SBD' => '&#36;',
		'SCR' => '&#x20a8;',
		'SDG' => '&#x62c;.&#x633;.',
		'SEK' => '&#107;&#114;',
		'SGD' => '&#36;',
		'SHP' => '&pound;',
		'SLL' => 'Le',
		'SOS' => 'Sh',
		'SRD' => '&#36;',
		'SSP' => '&pound;',
		'STD' => 'Db',
		'SYP' => '&#x644;.&#x633;',
		'SZL' => 'L',
		'THB' => '&#3647;',
		'TJS' => '&#x405;&#x41c;',
		'TMT' => 'm',
		'TND' => '&#x62f;.&#x62a;',
		'TOP' => 'T&#36;',
		'TRY' => '&#8378;',
		'TTD' => '&#36;',
		'TWD' => '&#78;&#84;&#36;',
		'TZS' => 'Sh',
		'UAH' => '&#8372;',
		'UGX' => 'UGX',
		'USD' => '&#36;',
		'UYU' => '&#36;',
		'UZS' => 'UZS',
		'VEF' => 'Bs F',
		'VND' => '&#8363;',
		'VUV' => 'Vt',
		'WST' => 'T',
		'XAF' => 'Fr',
		'XCD' => '&#36;',
		'XOF' => 'Fr',
		'XPF' => 'Fr',
		'YER' => '&#xfdfc;',
		'ZAR' => '&#82;',
		'ZMW' => 'ZK',
	) );

	$currency_symbol = isset( $symbols[ $currency ] ) ? $symbols[ $currency ] : '';

	return apply_filters( 'cardojo_currency_symbol', $currency_symbol, $currency );
}

// Add Menu Order
add_action( 'admin_init', 'posts_order_wpse_91866' );

function posts_order_wpse_91866() {
    add_post_type_support( 'post', 'page-attributes' );
}

/**
 * Maybe set menu_order if the featured status of a car is changed
 */
function cardojo_update_menu_order( $object_id, $meta_key, $meta_value ) {
	global $wpdb;

	if ( '1' == $meta_value ) {
		$wpdb->update( $wpdb->posts, array( 'menu_order' => -1 ), array( 'ID' => $object_id ) );
	} else {
		$wpdb->update( $wpdb->posts, array( 'menu_order' => 0 ), array( 'ID' => $object_id, 'menu_order' => -1 ) );
	}

	clean_post_cache( $object_id );
}

/**
 * Format the price with a currency symbol.
 *
 * @param float $price
 * @param array $args (default: array())
 * @return string
 */
function cardojo_price( $price, $args = array() ) {
	extract( apply_filters( 'cardojo_price_args', wp_parse_args( $args, array(
		'ex_tax_label'       => false,
		'currency'           => '',
		'decimal_separator'  => cardojo_get_price_decimal_separator(),
		'thousand_separator' => cardojo_get_price_thousand_separator(),
		'decimals'           => cardojo_get_price_decimals(),
		'price_format'       => get_cardojo_price_format(),
	) ) ) );

	$negative        = $price < 0;
	$price           = apply_filters( 'raw_cardojo_price', floatval( $negative ? $price * -1 : $price ) );
	$price           = apply_filters( 'formatted_cardojo_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, '<span class="cardojo-Price-currencySymbol">' . get_cardojo_currency_symbol( $currency ) . '</span>', $price );
	$return          = '<span class="cardojo-Price-amount amount">' . $formatted_price . '</span>';


	return apply_filters( 'cardojo_price', $return, $price, $args );
}

/**
 * Format the price with a currency symbol.
 *
 * @param float $price
 * @param array $args (default: array())
 * @return string
 */
function cardojo_clean_price( $price, $args = array() ) {
	extract( apply_filters( 'cardojo_clean_price_args', wp_parse_args( $args, array(
		'ex_tax_label'       => false,
		'currency'           => '',
		'decimal_separator'  => cardojo_get_price_decimal_separator(),
		'thousand_separator' => cardojo_get_price_thousand_separator(),
		'decimals'           => cardojo_get_price_decimals(),
		'price_format'       => get_cardojo_price_format(),
	) ) ) );

	$negative        = $price < 0;
	$price           = apply_filters( 'raw_cardojo_price', floatval( $negative ? $price * -1 : $price ) );
	$price           = apply_filters( 'formatted_cardojo_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format,  get_cardojo_currency_symbol( $currency ), $price );
	$return          = $formatted_price;


	return apply_filters( 'cardojo_clean_price', $return, $price, $args );
}

/**
 * Format the thousand number.
 *
 * @param float $number
 * @param array $args (default: array())
 * @return string
 */
function cardojo_number( $number, $args = array() ) {
	extract( apply_filters( 'cardojo_number_args', wp_parse_args( $args, array(
		'thousand_separator' => cardojo_get_price_thousand_separator(),
	) ) ) );

	$decimals           = get_option( 'cardojo_price_num_decimals' );
	$decimal_separator  = get_option( 'cardojo_decimal_separator' );
	$thousand_separator = get_option( 'cardojo_thousand_separator' );
	$negative           = $number < 0;
	$number             = apply_filters( 'raw_cardojo_number', floatval( $negative ? $number * -1 : $number ) );
	$number             = apply_filters( 'formatted_cardojo_number', number_format( $number, $decimals, $decimal_separator, $thousand_separator ), $number, $decimals, $decimal_separator, $thousand_separator );

	$return             = $number;


	return apply_filters( 'cardojo_number', $return, $number, $args );
}


function cd_category_has_children( $term_ID ) {

	global $wpdb;
	$category_children_check = $wpdb->get_results(" SELECT * FROM wp_term_taxonomy WHERE parent = '$term_ID' ");

 	if ($category_children_check) {
      	return true;
 	} else {
      	return false;
 	}

}

if ( defined( 'CARDOJO_USE_WPMAIL' ) ) {
	add_filter( 'wp_mail_content_type', 'cd_set_content_type' );
	function cd_set_content_type( $content_type ) {
		return 'text/html; charset=ISO-8859-1';
	}
}

/**
 * True if an the user can edit a car.
 *
 * @return bool
 */
function cardojo_user_can_edit_car( $car_id ) {
	$can_edit = true;

	if ( ! is_user_logged_in() || ! $car_id ) {
		$can_edit = false;
	} else {
		$car      = get_post( $car_id );

		if ( ! $car || ( absint( $car->post_author ) !== get_current_user_id() && ! current_user_can( 'edit_post', $car_id ) ) ) {
			$can_edit = false;
		}
	}

	return apply_filters( 'cardojo_user_can_edit_car', $can_edit, $car_id );
}

if ( ! function_exists( 'cardojo_search' ) ) {
	/**
	 * Properties Search Filter
	 *
	 * @param $search_args
	 * @return mixed
	 */
	function cardojo_search( $search_args ) {

		$tax_query = array();   // taxonomy query array
		$meta_query = array();  // meta query qrray

		/* Keyword Based Search */
		if ( isset ( $_GET[ 'keyword' ] ) ) {
			$keyword = trim( $_GET[ 'keyword' ] );
			if ( ! empty( $keyword ) ) {
				$search_args[ 's' ] = $keyword;
			}
		}

		/* Filter by */
		if ( ( ! empty( $_GET[ 'filterby' ] ) ) && ( $_GET[ 'filterby' ] != 'all' ) && ( $_GET[ 'filterby' ] != 'Sold' ) && ( $_GET[ 'filterby' ] != 'Featured' )  && ( $_GET[ 'filterby' ] != 'Promoted' )  && ( $_GET[ 'filterby' ] != 'Pending' )  && ( $_GET[ 'filterby' ] != 'Draft' ) ) {
			$meta_query[] = array(
				'key' => 'vehicle_condition',
				'value' => $_GET[ 'filterby' ],
			);
		}

		if ( ( ! empty( $_GET[ 'filterby' ] ) ) && ( $_GET[ 'filterby' ] == 'Sold' ) ) {
			$meta_query[] = array(
				'key' => '_sold',
				'value' => 1,
			);
		} else {
			$meta_query[] = array(
				'key' => '_sold',
				'value' => 0,
			);
		}

		if ( ( ! empty( $_GET[ 'filterby' ] ) ) && ( $_GET[ 'filterby' ] == 'Featured' ) ) {
			$meta_query[] = array(
				'key' => '_featured',
				'value' => 1,
			);
		}

		if ( ( ! empty( $_GET[ 'filterby' ] ) ) && ( $_GET[ 'filterby' ] == 'Promoted' ) ) {
			$meta_query[] = array(
				'key' => '_promoted',
				'value' => 1,
			);
		}

		/* Sort By Year */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'year_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_year';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'year_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_year';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Make */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'make_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'vehicle_make';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'make_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'vehicle_make';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Model */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'model_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'vehicle_model';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'model_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'vehicle_model';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Mileage */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'mileage_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_mileage';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'mileage_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_mileage';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Cost */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'cost_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_cost';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'cost_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_cost';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Price */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'price_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_price';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'price_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'vehicle_price';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Price */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'age_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'date';
			$search_args[ 'order' ] = 'DESC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'age_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'date';
			$search_args[ 'order' ] = 'ASC';
		}


		/* if more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query[ 'relation' ] = 'AND';
		}

		/* if more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query[ 'relation' ] = 'AND';
		}

		if ( $tax_count > 0 ) {
			$search_args[ 'tax_query' ] = $tax_query;
		}

		/* if meta query has some values then add it to base home page query */
		if ( $meta_count > 0 ) {
			$search_args[ 'meta_query' ] = $meta_query;
		}

		return $search_args;
	}

	add_filter( 'cardojo_search_parameters', 'cardojo_search' );
}

if ( ! function_exists( 'cardojo_leads_search' ) ) {
	/**
	 * Properties Search Filter
	 *
	 * @param $search_args
	 * @return mixed
	 */
	function cardojo_leads_search( $search_args ) {

		$tax_query = array();   // taxonomy query array
		$meta_query = array();  // meta query qrray

		/* Sort By Year */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'date_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'date';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'date_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'date';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Make */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'name_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'name';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'name_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'name';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Model */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'sku_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'lead_vehicle_sku';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'sku_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'lead_vehicle_sku';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Mileage */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'status_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_status';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'status_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_status';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Cost */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'uptype_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_up_type';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'uptype_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_up_type';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Price */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'adsource_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_ad_source';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'adsource_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_ad_source';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Price */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'webleadtype_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_websiteleadtype';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'webleadtype_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_websiteleadtype';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Price */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'appointment_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_appointment_strtotime';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'appointment_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_appointment_strtotime';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Price */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'phone_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_mobile_phone';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'phone_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'lead_mobile_phone';
			$search_args[ 'order' ] = 'DESC';
		}

		/* if more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query[ 'relation' ] = 'AND';
		}

		/* if more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query[ 'relation' ] = 'AND';
		}

		if ( $tax_count > 0 ) {
			$search_args[ 'tax_query' ] = $tax_query;
		}

		/* if meta query has some values then add it to base home page query */
		if ( $meta_count > 0 ) {
			$search_args[ 'meta_query' ] = $meta_query;
		}

		return $search_args;
	}

	add_filter( 'cardojo_leads_search_parameters', 'cardojo_leads_search' );
}

if ( ! function_exists( 'cardojo_deals_search' ) ) {
	/**
	 * Properties Search Filter
	 *
	 * @param $search_args
	 * @return mixed
	 */
	function cardojo_deals_search( $search_args ) {

		$tax_query = array();   // taxonomy query array
		$meta_query = array();  // meta query qrray

		/* Sort By Year */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'date_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'date';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'date_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'date';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Make */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'name_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'name';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'name_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'name';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Vehicle SKU */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'sku_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_sku';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'sku_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_sku';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Vehicle Name */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'vehicle_name_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_name';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'vehicle_name_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_name';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Vehicle Price */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'price_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_price';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'price_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_price';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Vehicle Profit */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'profit_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_profit';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'profit_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_profit';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Vehicle Age */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'age_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_age';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'age_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_vehicle_age';
			$search_args[ 'order' ] = 'DESC';
		}

		/* Sort By Vehicle Next Payment */
		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'next_payment_asc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_loan_next_payments_date';
			$search_args[ 'order' ] = 'ASC';
		}

		if ( ( isset( $_GET[ 'orderby' ] ) && ( $_GET[ 'orderby' ] == 'next_payment_desc' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value';
			$search_args[ 'meta_key' ] = 'deal_loan_next_payments_date';
			$search_args[ 'order' ] = 'DESC';
		}

		/* if more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query[ 'relation' ] = 'AND';
		}

		/* if more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query[ 'relation' ] = 'AND';
		}

		if ( $tax_count > 0 ) {
			$search_args[ 'tax_query' ] = $tax_query;
		}

		/* if meta query has some values then add it to base home page query */
		if ( $meta_count > 0 ) {
			$search_args[ 'meta_query' ] = $meta_query;
		}

		return $search_args;
	}

	add_filter( 'cardojo_deals_search_parameters', 'cardojo_deals_search' );
}


/**
 * Duplicate a listing.
 * @param  int $post_id
 * @return int 0 on fail or the post ID.
 */
function cardojo_duplicate_listing( $post_id ) {
	if ( empty( $post_id ) || ! ( $post = get_post( $post_id ) ) ) {
		return 0;
	}

	global $wpdb;

	/**
	 * Duplicate the post.
	 */
	$new_post_id = wp_insert_post( array(
		'comment_status' => $post->comment_status,
		'ping_status'    => $post->ping_status,
		'post_author'    => $post->post_author,
		'post_content'   => $post->post_content,
		'post_excerpt'   => $post->post_excerpt,
		'post_name'      => $post->post_name,
		'post_parent'    => $post->post_parent,
		'post_password'  => $post->post_password,
		'post_status'    => 'draft',
		'post_title'     => $post->post_title,
		'post_type'      => $post->post_type,
		'to_ping'        => $post->to_ping,
		'menu_order'     => $post->menu_order
	) );

	/**
	 * Copy taxonomies.
	 */
	$taxonomies = get_object_taxonomies( $post->post_type );

	foreach ( $taxonomies as $taxonomy ) {
		$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
		wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
	}

	/*
	 * Duplicate post meta, aside from some reserved fields.
	 */
	$post_meta = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, meta_value FROM {$wpdb->postmeta} WHERE post_id=%d", $post_id ) );

	if ( ! empty( $post_meta ) ) {
		$post_meta = wp_list_pluck( $post_meta, 'meta_value', 'meta_key' );
		foreach ( $post_meta as $meta_key => $meta_value ) {
			if ( in_array( $meta_key, apply_filters( 'cardojo_duplicate_listing_ignore_keys', array( '_sold', '_submit_fee', '_promoted', '_featured', '_paid_featured', 'vehicle_expenses', 'vehicle_image_gallery', 'vehicle_image_extended_gallery' ) ) ) ) {
				continue;
			}
			update_post_meta( $new_post_id, $meta_key, $meta_value );
		}
	}

	$vehicle_image_gallery = get_post_meta($post_id, 'vehicle_image_gallery',true);
	$vehicle_image_extended_gallery = get_post_meta($post_id, 'vehicle_image_extended_gallery',true);
	$vehicle_expenses = get_post_meta($post_id, 'vehicle_expenses',true);

	update_post_meta( $new_post_id, 'vehicle_image_gallery', $vehicle_image_gallery );
	update_post_meta( $new_post_id, 'vehicle_image_extended_gallery', $vehicle_image_extended_gallery );
	update_post_meta( $new_post_id, 'vehicle_expenses', $vehicle_expenses );

	update_post_meta( $new_post_id, '_sold', 0 );
	update_post_meta( $new_post_id, '_promoted', 0 );
	update_post_meta( $new_post_id, '_featured', 0 );
	update_post_meta( $new_post_id, '_paid_featured', 0 );
	update_post_meta( $new_post_id, '_sold_date', "" );
	update_post_meta( $new_post_id, '_submit_fee', 0 );

	return $new_post_id;
}

/**
 * Get the page ID of a page if set, with PolyLang compat.
 * @param  string $page e.g. car_dashboard, submit_car_form, cars
 * @return int
 */
function cardojo_get_page_id( $page ) {
	$page_id = get_option( 'cardojo_' . $page . '_page_id', false );
	if ( $page_id ) {
		return apply_filters( 'wpml_object_id', absint( function_exists( 'pll_get_post' ) ? pll_get_post( $page_id ) : $page_id ), 'page', TRUE );
	} else {
		return 0;
	}
}

/**
 * Get the permalink of a page if set
 * @param  string $page e.g. car_dashboard, submit_car_form, cars
 * @return string|bool
 */
function cardojo_get_permalink( $page ) {
	if ( $page_id = cardojo_get_page_id( $page ) ) {
		return get_permalink( $page_id );
	} else {
		return false;
	}
}


/**
 * Class wrapper for Front End Media example
 */
class Front_End_Media {

	/**
	 * A simple call to init when constructed
	 */
	function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {
		load_plugin_textdomain(
			'frontend-media',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'ajax_query_attachments_args', array( $this, 'filter_media' ) );
		add_shortcode( 'frontend-button', array( $this, 'frontend_shortcode' ) );
	}

	/**
	 * Call wp_enqueue_media() to load up all the scripts we need for media uploader
	 */
	function enqueue_scripts() {
		wp_enqueue_media();
	}

	/**
	 * This filter insures users only see their own media
	 */
	function filter_media( $query ) {
		// admins get to see everything
		if ( ! current_user_can( 'manage_options' ) )
			$query['author'] = get_current_user_id();

		return $query;
	}

	function frontend_shortcode( $args ) {
		// check if user can upload files
		if ( current_user_can( 'upload_files' ) ) {
			$str = __( 'Select File', 'frontend-media' );
			return '<input id="frontend-button" type="button" value="' . $str . '" class="button" style="position: relative; z-index: 1;"><img id="frontend-image" />';
		}

		return __( 'Please Login To Upload', 'frontend-media' );
	}
}

new Front_End_Media();

// Update _sold and _submit_fee meta on post creation
add_action( 'transition_post_status', 'cardojo_add_sold_meta_on_post_creation', 10, 3 );
function cardojo_add_sold_meta_on_post_creation( $new_status, $old_status, $post ) {
    if ( 'publish' !== $new_status )
        return;

    $subject = 'publish' === $old_status
        ? __( 'Edited: %s', 'cardojo' )
        : __( 'New post: %s', 'cardojo' );

    $post_id = $post->ID;
    update_post_meta($post_id, '_sold', 0);
    update_post_meta($post_id, '_submit_fee', 0);
    cardojo_send_vehicle_notifications( $post_id );
}

// Get Total Vehicles of current author
function cardojo_get_total_cars() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish' ),
		'author'              => get_current_user_id(),
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Total vehicles all users
function cardojo_get_total_cars_all_users() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish' )
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Total cars dashboard
function cardojo_get_total_cars_all() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Average Photots
function cardojo_get_avg_photos() {

	$i = 0;

	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_image_gallery = get_post_meta(get_the_ID(), 'vehicle_image_gallery',true);
			$vehicle_image_extended_gallery = get_post_meta(get_the_ID(), 'vehicle_image_extended_gallery',true);

			if(!empty($vehicle_image_gallery)) {

				foreach ($vehicle_image_gallery as $vehicle_image_gallery_item) {
					
					if( !empty($vehicle_image_gallery_item['url']) ) {
						$i++;
					}

				}

			}

			if(!empty($vehicle_image_extended_gallery)) {

				foreach ($vehicle_image_extended_gallery as $vehicle_image_extended_gallery_item) {
					
					if( !empty($vehicle_image_extended_gallery_item['url']) ) {
						$i++;
					}

				}

			}

		endwhile;

	endif; wp_reset_postdata();

	if( $total != 0 ) {
		$avg_photos = $i / $total;
	} else {
		$avg_photos = $i;
	}

	return $avg_photos;

}

// Average Mileage
function cardojo_get_avg_mileage() {

	$i = 0;

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_mileage = get_post_meta(get_the_ID(), 'vehicle_mileage',true);
			if(!empty($vehicle_mileage)) {
				$i = $i + $vehicle_mileage;
			}

		endwhile;

	endif; wp_reset_postdata();

	if( $total != 0 ) {
		$avg_mileage = $i / $total;
	} else {
		$avg_mileage = $i;
	}

	return $avg_mileage;

}

// Average Days
function cardojo_get_avg_days() {

	$i = 0;

	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish' ),
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;
	$cars = 0;

	$format = get_option('date_format');

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$pfx_date = get_the_date( $format, get_the_ID() ); 
			$sold = esc_attr(get_post_meta(get_the_ID(), '_sold_date',true));

			if(!empty($sold)) {
				$now = $sold;
			} else {
				$now = strtotime(date("Y-m-d H:i:s")); 
			}

			$days = ($now - strtotime($pfx_date)) / (60 * 60 * 24); 
			$i = $i + round($days);

			$cars++;

		endwhile;

	endif; wp_reset_postdata();

	if( $total != 0 ) {
		$avg_days = $i / $total;
	} else {
		$avg_days = $i;
	}

	return round($avg_days);

}

// Average Cost
function cardojo_get_avg_cost() {

	$i = 0;

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));
			$i = $i + $vehicle_cost;

		endwhile;

	endif; wp_reset_postdata();

	if( $total != 0 ) {
		$avg_cost = $i / $total;
	} else {
		$avg_cost = $i;
	}

	return $avg_cost;

}

// Total Cost
function cardojo_get_total_cost() {

	$i = 0;

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish' ),
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));
			$i = $i + $vehicle_cost;

		endwhile;

	endif; wp_reset_postdata();

	return $i;

}


// New Leads
function cardojo_get_new_leads() {

	
	$search_args = array(
		'post_type'           => 'lead',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'tax_query' => array(
			array(
				'taxonomy' => 'lead_status',
				'field'    => 'slug',
				'terms'    => 'new',
			),
		),
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Total Leads
function cardojo_get_total_leads() {

	
	$search_args = array(
		'post_type'           => 'lead',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id()
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Floor Leads
function cardojo_get_floor_leads() {

	
	$search_args = array(
		'post_type'           => 'lead',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'tax_query' => array(
			array(
				'taxonomy' => 'lead_up_type',
				'field'    => 'slug',
				'terms'    => 'floor-up',
			),
		),
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Floor Leads
function cardojo_get_internet_leads() {

	
	$search_args = array(
		'post_type'           => 'lead',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'tax_query' => array(
			array(
				'taxonomy' => 'lead_up_type',
				'field'    => 'slug',
				'terms'    => 'internet-up',
			),
		),
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Floor Leads
function cardojo_get_phone_leads() {

	
	$search_args = array(
		'post_type'           => 'lead',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'tax_query' => array(
			array(
				'taxonomy' => 'lead_up_type',
				'field'    => 'slug',
				'terms'    => 'phone-up',
			),
		),
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	return $total;

}

// Total Deals
function cardojo_get_total_deals() {

	
	$search_args = array(
		'post_type'           => 'deal',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id()
	);

	$deals_query = new WP_Query( $search_args );
	$total    = $deals_query->found_posts;

	return $total;

}

// Closed Deals
function cardojo_get_closed_deals() {

	
	$search_args = array(
		'post_type'           => 'deal',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish', 'pending', 'draft' ),
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => 'deal_loan_next_payments_date',
		        'value' => 'done'        
		    )
		)
	);

	$deals_query = new WP_Query( $search_args );
	$total    = $deals_query->found_posts;

	return $total;

}

// Total Profit
function cardojo_get_deals_total_profit() {

	$i = 0;

	
	$search_args = array(
		'post_type'           => 'deal',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id()
	);

	$deals_query = new WP_Query( $search_args );
	$total    = $deals_query->found_posts;
	$total_profit = "";

	if ( $deals_query->have_posts() ) :

		while ( $deals_query->have_posts() ) : $deals_query->the_post();

			$vehicle_profit = esc_attr(get_post_meta(get_the_ID(), 'deal_vehicle_profit',true));
			$total_profit = $total_profit + $vehicle_profit;

		endwhile;

	endif; wp_reset_postdata();

	return $total_profit;

}

// Average Profit
function cardojo_get_deals_avg_profit() {

	$i = 0;

	
	$search_args = array(
		'post_type'           => 'deal',
		'posts_per_page'      => -1,
		'post_status'         => array( 'publish' ),
		'author'              => get_current_user_id()
	);

	$deals_query = new WP_Query( $search_args );
	$total    = $deals_query->found_posts;

	if ( $deals_query->have_posts() ) :

		while ( $deals_query->have_posts() ) : $deals_query->the_post();

			$vehicle_profit = esc_attr(get_post_meta(get_the_ID(), 'deal_vehicle_profit',true));
			$i = $i + $vehicle_profit;

		endwhile;

	endif; wp_reset_postdata();

	if( $total != 0 ) {
		$avg_profit = $i / $total;
	} else {
		$avg_profit = $i;
	}

	return $avg_profit;

}

// Potential Profit
function cardojo_get_potential_profit() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total    = $cars_query->found_posts;

	$total_profit = 0;
	$price = 0;
	$cost = 0;
	$profit = 0;

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$price = esc_attr(get_post_meta(get_the_ID(), 'vehicle_price',true));
			$cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));

			$profit = $price - $cost;

			$total_profit = $total_profit + $profit;

		endwhile;

	endif; wp_reset_postdata();

	return $total_profit;

}

// Total Cars by Make
function cardojo_get_total_cars_by_make() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 0
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$car_makers = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_make_desc_init = esc_attr(get_post_meta(get_the_ID(), 'vehicle_make_desc_init',true));
			$car_makers[] = $vehicle_make_desc_init;

		endwhile;

	endif; wp_reset_postdata();

	$car_makers_unique = array_unique($car_makers);

	$i = 0;
	$total_cars = array();

	foreach ( $car_makers_unique as $car_maker ) {

		$i++;

		
		$search_args = array(
			'post_type'           => 'vehicle',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'author'              => get_current_user_id(),
			'meta_query' => array(
				'relation' => 'AND',
			    array(
			        'key' => '_sold',
			        'value' => 0
			    ),
			    array(
			        'key' => 'vehicle_make_desc_init',
			        'value' => $car_maker
			    )
			)
		);

		$deals_query = new WP_Query( $search_args );
		$total    = $deals_query->found_posts;

		$total_cars[$i]['make'] = $car_maker;
		$total_cars[$i]['amount'] = $total;

	}

	return $total_cars;

}

// Total Sales by Month
function cardojo_get_total_sales_by_month( $month ) {

	$total_sales = 0;
	$current_year = date('Y');
	$current_month = $month;
	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
			'relation' => 'AND',
		    array(
		        'key' => '_sold_date_year',
		        'value' => $current_year
		    ),
		    array(
		        'key' => '_sold_date_month',
		        'value' => $current_month
		    ),
		    array(
		        'key' => '_sold',
		        'value' => 1
		    )
		)
	);

	$cars_query   = new WP_Query( $search_args );
	$total_sales  = $cars_query->found_posts;

	return $total_sales;

}

// Total Sales by Month Extended
function cardojo_get_total_sales_by_month_extended( $month, $year ) {

	$total_sales = 0;
	$current_year = $year;
	$current_month = $month;
	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
			'relation' => 'AND',
		    array(
		        'key' => '_sold_date_year',
		        'value' => $current_year
		    ),
		    array(
		        'key' => '_sold_date_month',
		        'value' => $current_month
		    ),
		    array(
		        'key' => '_sold',
		        'value' => 1
		    )
		)
	);

	$total_sales = array();
	$profit = 0;

	$cars_query                 = new WP_Query( $search_args );
	$total_sales['sales']         = $cars_query->found_posts;

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));
			$price = esc_attr(get_post_meta(get_the_ID(), 'vehicle_price',true));
			$deal_profit = $price - $vehicle_cost;
			$profit = $profit + $deal_profit;

		endwhile;

	endif; wp_reset_postdata();

	$total_sales['total_profit'] = $profit;

	return $total_sales;

}

// Geat First Deal Date
function cardojo_get_first_deal_date() {

	$format = get_option('date_format');
	$first_date = date($format); 
	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => 1,
		'author'              => get_current_user_id(),
		'orderby' => 'date',
		'order'   => 'ASC',
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 1
		    )
		)

	);

	$cars_query   = new WP_Query( $search_args );
	
	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_sold_date = esc_attr(get_post_meta(get_the_ID(), '_sold_date',true));
			$vehicle_sold_date = date($format, $vehicle_sold_date);
			$first_date = $vehicle_sold_date;

		endwhile;

	endif; wp_reset_postdata();

	return $first_date;

}

// Total Sales by Year Extended
function cardojo_get_total_sales_by_year_extended( $year ) {

	$total_sales = 0;

	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
			'relation' => 'AND',
		    array(
		        'key' => '_sold_date_year',
		        'value' => $year
		    ),
		    array(
		        'key' => '_sold',
		        'value' => 1
		    )
		)

	);

	$total_sales = array();
	$profit = 0;

	$cars_query                 = new WP_Query( $search_args );
	$total_sales['sales']         = $cars_query->found_posts;

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));
			$price = esc_attr(get_post_meta(get_the_ID(), 'vehicle_price',true));
			$deal_profit = $price - $vehicle_cost;
			$profit = $profit + $deal_profit;

		endwhile;

	endif; wp_reset_postdata();

	$total_sales['total_profit']  = $profit;

	return $total_sales;

}

// Total Sales by Make
function cardojo_get_total_sales_by_make() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 1
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$car_makers = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$deal_vehicle_make = esc_attr(get_post_meta(get_the_ID(), 'vehicle_make_desc_init',true));
			$car_makers[] = $deal_vehicle_make;

		endwhile;

	endif; wp_reset_postdata();

	$car_makers_unique = array_unique($car_makers);

	$i = 0;
	$total_cars = array();

	foreach ( $car_makers_unique as $car_maker ) {

		$i++;

		$search_args = array(
			'post_type'           => 'vehicle',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'author'              => get_current_user_id(),
			'meta_query' => array(
				'relation' => 'AND',
			    array(
			        'key' => 'vehicle_make_desc_init',
			        'value' => $car_maker
			    ),
			    array(
			        'key' => '_sold',
			        'value' => 1
			    )
			)
		);

		$deals_query = new WP_Query( $search_args );
		$total    = $deals_query->found_posts;

		$cars_age = 0;
		$total_profit = 0;

		if ( $deals_query->have_posts() ) :

			while ( $deals_query->have_posts() ) : $deals_query->the_post();

				$format = get_option('date_format');
				$pfx_date = get_the_date( $format, get_the_ID() ); 
				$sold = esc_attr(get_post_meta(get_the_ID(), '_sold_date',true));

				if(!empty($sold)) {
					$now = $sold;
				} else {
					$now = strtotime(date("Y-m-d H:i:s")); 
				}

				$age = ($now - strtotime($pfx_date)) / (60 * 60 * 24); 
				$cars_age = $cars_age + $age;

				$vehicle_cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));
				$price = esc_attr(get_post_meta(get_the_ID(), 'vehicle_price',true));
				$total_profit = $price - $vehicle_cost;

			endwhile;

		endif; wp_reset_postdata();

		$total_cars[$i]['make'] = $car_maker;
		$total_cars[$i]['amount'] = $total;
		$total_cars[$i]['age'] = round($cars_age/$total);
		$total_cars[$i]['avg_profit'] = $total_profit/$total;
		$total_cars[$i]['total_profit'] = $total_profit;

	}

	return $total_cars;

}

// Total Sales by Model
function cardojo_get_total_sales_by_model() {
	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 1
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$car_makers = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$deal_vehicle_make = esc_attr(get_post_meta(get_the_ID(), 'vehicle_model',true));
			$car_makers[] = $deal_vehicle_make;

		endwhile;

	endif; wp_reset_postdata();

	$car_makers_unique = array_unique($car_makers);

	$i = 0;
	$total_cars = array();

	foreach ( $car_makers_unique as $car_maker ) {

		$i++;
		
		$search_args = array(
			'post_type'           => 'vehicle',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'author'              => get_current_user_id(),
			'meta_query' => array(
				'relation' => 'AND',
			    array(
			        'key' => 'vehicle_model',
			        'value' => $car_maker
			    ),
			    array(
			        'key' => '_sold',
			        'value' => 1
			    )
			)
		);

		$deals_query = new WP_Query( $search_args );
		$total    = $deals_query->found_posts;

		$cars_age = 0;
		$total_profit = 0;

		if ( $deals_query->have_posts() ) :

			while ( $deals_query->have_posts() ) : $deals_query->the_post();

				$deal_vehicle_make = esc_attr(get_post_meta(get_the_ID(), 'vehicle_make_desc_init',true));

				$format = get_option('date_format');
				$pfx_date = get_the_date( $format, get_the_ID() ); 
				$sold = esc_attr(get_post_meta(get_the_ID(), '_sold_date',true));

				if(!empty($sold)) {
					$now = $sold;
				} else {
					$now = strtotime(date("Y-m-d H:i:s")); 
				}

				$age = ($now - strtotime($pfx_date)) / (60 * 60 * 24); 
				$cars_age = $cars_age + $age;

				$vehicle_cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));
				$price = esc_attr(get_post_meta(get_the_ID(), 'vehicle_price',true));
				$total_profit = $price - $vehicle_cost;

			endwhile;

		endif; wp_reset_postdata();

		$total_cars[$i]['make'] = $deal_vehicle_make . " " . $car_maker;
		$total_cars[$i]['amount'] = $total;
		$total_cars[$i]['age'] = round($cars_age/$total);
		$total_cars[$i]['avg_profit'] = $total_profit/$total;
		$total_cars[$i]['total_profit'] = $total_profit;

	}

	return $total_cars;

}

// Total Sales by trim
function cardojo_get_total_sales_by_trim() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1,
		'author'              => get_current_user_id(),
		'meta_query' => array(
		    array(
		        'key' => '_sold',
		        'value' => 1
		    )
		)
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$car_makers = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$deal_vehicle_make = esc_attr(get_post_meta(get_the_ID(), 'vehicle_trim_id',true));
			$car_makers[] = $deal_vehicle_make;

		endwhile;

	endif; wp_reset_postdata();

	$car_makers_unique = array_unique($car_makers);

	$i = 0;
	$total_cars = array();

	foreach ( $car_makers_unique as $car_maker ) {

		$i++;
		
		$search_args = array(
			'post_type'           => 'vehicle',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'author'              => get_current_user_id(),
			'meta_query' => array(
				'relation' => 'AND',
			    array(
			        'key' => 'vehicle_trim_id',
			        'value' => $car_maker
			    ),
			    array(
			        'key' => '_sold',
			        'value' => 1
			    )
			)
		);

		$deals_query = new WP_Query( $search_args );
		$total    = $deals_query->found_posts;

		$cars_age = 0;
		$total_profit = 0;

		if ( $deals_query->have_posts() ) :

			while ( $deals_query->have_posts() ) : $deals_query->the_post();

				$deal_vehicle_make = esc_attr(get_post_meta(get_the_ID(), 'vehicle_make_desc_init',true));
				$deal_vehicle_model = esc_attr(get_post_meta(get_the_ID(), 'vehicle_model',true));
				$vehicle_trim_desc_init = esc_attr(get_post_meta(get_the_ID(), 'vehicle_trim_desc_init',true));

				$format = get_option('date_format');
				$pfx_date = get_the_date( $format, get_the_ID() ); 
				$sold = esc_attr(get_post_meta(get_the_ID(), '_sold_date',true));

				if(!empty($sold)) {
					$now = $sold;
				} else {
					$now = strtotime(date("Y-m-d H:i:s")); 
				}

				$age = ($now - strtotime($pfx_date)) / (60 * 60 * 24); 
				$cars_age = $cars_age + $age;

				$vehicle_cost = esc_attr(get_post_meta(get_the_ID(), 'vehicle_cost',true));
				$price = esc_attr(get_post_meta(get_the_ID(), 'vehicle_price',true));
				$total_profit = $price - $vehicle_cost;

			endwhile;

		endif; wp_reset_postdata();

		$total_cars[$i]['make'] = $deal_vehicle_make . " " . $deal_vehicle_model . " " . $vehicle_trim_desc_init;
		$total_cars[$i]['amount'] = $total;
		$total_cars[$i]['age'] = round($cars_age/$total);
		$total_cars[$i]['avg_profit'] = $total_profit/$total;
		$total_cars[$i]['total_profit'] = $total_profit;

	}

	return $total_cars;

}

// Get Car Makes and Models
function cardojo_get_total_makes_and_models() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$car_makers = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$deal_vehicle_make = esc_attr(get_post_meta(get_the_ID(), 'vehicle_make_desc_init',true));
			$car_makers[] = $deal_vehicle_make;

		endwhile;

	endif; wp_reset_postdata();

	$car_makers_unique = array_unique($car_makers);

	$i = 0;

	foreach ( $car_makers_unique as $car_maker ) {

		$i++;

		
		$search_args = array(
			'post_type'           => 'vehicle',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'meta_query' => array(
			    array(
			        'key' => 'vehicle_make_desc_init',
			        'value' => $car_maker
			    )
			)
		);

		$deals_query = new WP_Query( $search_args );
		$total    = $deals_query->found_posts;
		$vehicle_models = array();

		if ( $deals_query->have_posts() ) :

			while ( $deals_query->have_posts() ) : $deals_query->the_post();

				$vehicle_make_clean = esc_attr(get_post_meta(get_the_ID(), 'vehicle_make',true));
				$vehicle_models[] = esc_attr(get_post_meta(get_the_ID(), 'vehicle_model',true));

			endwhile;

		endif; wp_reset_postdata();

		$total_cars[$i]['make'] = $car_maker;
		$total_cars[$i]['make_clean'] = $vehicle_make_clean;
		$total_cars[$i]['model'] = array_unique($vehicle_models);

	}

	return $total_cars;

}

// Get Maximum Price
function cardojo_get_max_price() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$maximum_price = "0";

	$vehicle_prices = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_price = esc_attr(get_post_meta(get_the_ID(), 'vehicle_price',true));
			$vehicle_prices[] = $vehicle_price;

		endwhile;

	endif; wp_reset_postdata();

	if(!empty($vehicle_prices)) {
		$maximum_price = max($vehicle_prices);
	}

	return $maximum_price;

}

// Get Minimum Year
function cardojo_get_min_year() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$minimum_year = "0";

	$vehicle_years = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_year = esc_attr(get_post_meta(get_the_ID(), 'vehicle_year',true));
			if(!empty($vehicle_year)) {
				$vehicle_years[] = $vehicle_year;
			}

		endwhile;

	endif; wp_reset_postdata();

	if(!empty($vehicle_years)) {
		$minimum_year = min($vehicle_years);
	}

	return $minimum_year;

}

// Get Maximum Year
function cardojo_get_max_year() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$maximum_year = "0";

	$vehicle_years = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_year = esc_attr(get_post_meta(get_the_ID(), 'vehicle_year',true));
			if(!empty($vehicle_year)) {
				$vehicle_years[] = $vehicle_year;
			}

		endwhile;

	endif; wp_reset_postdata();

	if(!empty($vehicle_years)) {
		$maximum_year = max($vehicle_years);
	}

	return $maximum_year;

}

// Get Minimum Mileage
function cardojo_get_min_mileage() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$minimum_mileage = "0";

	$vehicle_mileages = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_mileage = esc_attr(get_post_meta(get_the_ID(), 'vehicle_mileage',true));
			$vehicle_mileages[] = $vehicle_mileage;

		endwhile;

	endif; wp_reset_postdata();

	if(!empty($vehicle_mileages)) {
		$minimum_mileage = min($vehicle_mileages);
	}

	return $minimum_mileage;

}

// Get Maximum Mileage
function cardojo_get_max_mileage() {

	
	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1
	);

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	$maximum_mileage = "0";

	$vehicle_mileages = array();

	if ( $cars_query->have_posts() ) :

		while ( $cars_query->have_posts() ) : $cars_query->the_post();

			$vehicle_mileage = esc_attr(get_post_meta(get_the_ID(), 'vehicle_mileage',true));
			$vehicle_mileages[] = $vehicle_mileage;

		endwhile;

	endif; wp_reset_postdata();

	if(!empty($vehicle_mileages)) {
		$maximum_mileage = max($vehicle_mileages);
	}

	return $maximum_mileage;

}

// Car Search Filter Total
function cardojo_search_filter_total() {

	$tax_query = array();   // taxonomy query array
	$meta_query = array();  // meta query qrray

	$search_args = array(
		'post_type'           => 'vehicle',
		'post_status'         => array( 'publish' ),
		'posts_per_page'      => -1
	);

	/* Car Make */
	if ( ( ! empty( $_GET[ 'make' ] ) ) && ( $_GET[ 'make' ] != '0' ) ) {
		$meta_query[] = array(
			'key' => 'vehicle_make_desc_init',
			'value' => $_GET[ 'make' ],
		);
	}

	/* Car Model */
	if ( ( ! empty( $_GET[ 'model' ] ) ) && ( $_GET[ 'model' ] != '0' ) ) {
		$meta_query[] = array(
			'key' => 'vehicle_model',
			'value' => $_GET[ 'model' ],
		);
	}

	/* Fuel Type */
	if ( ( ! empty( $_GET[ 'fuel_type' ] ) ) && ( $_GET[ 'fuel_type' ] != '0' ) ) {
		$tax_query[] = array(
			'taxonomy' => 'vehicle_fuel_type',
			'field' => 'term_id',
			'terms' => $_GET[ 'fuel_type' ],
		);
	}

	/* vehicle Price */
	if ( isset( $_GET[ 'price' ] ) && ( $_GET[ 'price' ] != 'any' ) ) {
		$price = $_GET[ 'price' ];
		if ( $price >= 0 ) {
			$meta_query[] = array(
				'key' => 'vehicle_price',
				'value' => $price,
				'type' => 'NUMERIC',
				'compare' => '<='
			);
		}
	}

	/* vehicle Price */
	if ( isset( $_GET[ 'vehicle_year' ] ) && ( $_GET[ 'vehicle_year' ] != 'any' ) ) {
		$vehicle_year = $_GET[ 'vehicle_year' ];
		if ( $vehicle_year >= 0 ) {
			$meta_query[] = array(
				'key' => 'vehicle_year',
				'value' => $vehicle_year,
				'type' => 'NUMERIC',
				'compare' => '>='
			);
		}
	}

	/* vehicle Mileage */
	if ( isset( $_GET[ 'mileage' ] ) && ( $_GET[ 'mileage' ] != 'any' ) ) {
		$mileage = $_GET[ 'mileage' ];
		$mileage = trim($mileage, 'K');
		$mileage = $mileage * 1000;
		if ( $mileage >= 0 ) {
			$meta_query[] = array(
				'key' => 'vehicle_mileage',
				'value' => $mileage,
				'type' => 'NUMERIC',
				'compare' => '<='
			);
		}
	}

	/* Car Condition */
	if ( ( ! empty( $_GET[ 'vehicle_condition' ] ) ) && ( $_GET[ 'vehicle_condition' ] == "on" ) ) {
		$meta_query[] = array(
			'key' => 'vehicle_condition',
			'value' => 'New',
		);
	}

	/* if more than one taxonomies exist then specify the relation */
	$tax_count = count( $tax_query );
	if ( $tax_count > 1 ) {
		$tax_query[ 'relation' ] = 'AND';
	}

	/* if more than one meta query elements exist then specify the relation */
	$meta_count = count( $meta_query );
	if ( $meta_count > 1 ) {
		$meta_query[ 'relation' ] = 'AND';
	}

	if ( $tax_count > 0 ) {
		$search_args[ 'tax_query' ] = $tax_query;
	}

	/* if meta query has some values then add it to base home page query */
	if ( $meta_count > 0 ) {
		$search_args[ 'meta_query' ] = $meta_query;
	}

	$cars_query = new WP_Query( $search_args );
	$total      = $cars_query->found_posts;

	return $total;
}

/**
* Car Search Filter
*/
if ( ! function_exists( 'cardojo_search_filter' ) ) {
	/**
	 * Properties Search Filter
	 *
	 * @param $search_args
	 * @return mixed
	 */
	function cardojo_search_filter( $search_args ) {

		$tax_query = array();   // taxonomy query array
		$meta_query = array();  // meta query qrray

		/* Car Make */
		if ( ( ! empty( $_GET[ 'make' ] ) ) && ( $_GET[ 'make' ] != '0' ) ) {
			$meta_query[] = array(
				'key' => 'vehicle_make_desc_init',
				'value' => $_GET[ 'make' ],
			);
		}

		/* Car Model */
		if ( ( ! empty( $_GET[ 'model' ] ) ) && ( $_GET[ 'model' ] != '0' ) ) {
			$meta_query[] = array(
				'key' => 'vehicle_model',
				'value' => $_GET[ 'model' ],
			);
		}

		/* Fuel Type */
		if ( ( ! empty( $_GET[ 'fuel_type' ] ) ) && ( $_GET[ 'fuel_type' ] != '0' ) ) {
			$tax_query[] = array(
				'taxonomy' => 'vehicle_fuel_type',
				'field' => 'term_id',
				'terms' => $_GET[ 'fuel_type' ],
			);
		}

		/* vehicle Price */
		if ( isset( $_GET[ 'price' ] ) && ( $_GET[ 'price' ] != 'any' ) ) {
			$price = $_GET[ 'price' ];
			if ( $price >= 0 ) {
				$meta_query[] = array(
					'key' => 'vehicle_price',
					'value' => $price,
					'type' => 'NUMERIC',
					'compare' => '<='
				);
			}
		}

		/* vehicle Price */
		if ( isset( $_GET[ 'vehicle_year' ] ) && ( $_GET[ 'vehicle_year' ] != 'any' ) ) {
			$vehicle_year = $_GET[ 'vehicle_year' ];
			if ( $vehicle_year >= 0 ) {
				$meta_query[] = array(
					'key' => 'vehicle_year',
					'value' => $vehicle_year,
					'type' => 'NUMERIC',
					'compare' => '>='
				);
			}
		}

		/* vehicle Mileage */
		if ( isset( $_GET[ 'mileage' ] ) && ( $_GET[ 'mileage' ] != 'any' ) ) {
			$mileage = $_GET[ 'mileage' ];
			$mileage = trim($mileage, 'K');
			$mileage = $mileage * 1000;
			if ( $mileage >= 0 ) {
				$meta_query[] = array(
					'key' => 'vehicle_mileage',
					'value' => $mileage,
					'type' => 'NUMERIC',
					'compare' => '<='
				);
			}
		}

		/* Car Condition */
		if ( ( ! empty( $_GET[ 'vehicle_condition' ] ) ) && ( $_GET[ 'vehicle_condition' ] == "on" ) ) {
			$meta_query[] = array(
				'key' => 'vehicle_condition',
				'value' => 'New',
			);
		}

		/* if more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query[ 'relation' ] = 'AND';
		}

		/* if more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query[ 'relation' ] = 'AND';
		}

		if ( $tax_count > 0 ) {
			$search_args[ 'tax_query' ] = $tax_query;
		}

		/* if meta query has some values then add it to base home page query */
		if ( $meta_count > 0 ) {
			$search_args[ 'meta_query' ] = $meta_query;
		}

		return $search_args;
	}

	add_filter( 'cardojo_search_filter_parameters', 'cardojo_search_filter' );
}


/*
|--------------------------------------------------------------------------
| Post views function
|--------------------------------------------------------------------------
*/

// function to display number of posts.
function cardojo_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

// function to count views.
function cardojo_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// function to set post visited by specific user ( new when added in filter ).
function cardojo_setPostVisited($postID) {

	if ( is_user_logged_in() ) {

		$user_id = get_current_user_id();

		if( !empty($user_id) ) {
			$filter_user_id = get_post_meta($postID, 'filter_user_'.$user_id, true);
			if( !empty($filter_user_id) ) {
				update_post_meta($postID, 'filter_user_'.$user_id, 'old');
			}
		}

	}

}

// Views Admin Column
add_filter('manage_edit-vehicle_columns', 'vehicle_views_column');
function vehicle_views_column($columns) {
    $columns['views'] = 'Views';
    return $columns;
}

add_action('manage_vehicle_posts_custom_column',  'vehicle_views_show_columns');
function vehicle_views_show_columns($name) {
    global $post;
    switch ($name) {
        case 'views':
            $views = cardojo_getPostViews( $post->ID );
            echo $views;
    }
}

// Orderby views
add_filter("manage_edit-vehicle_sortable_columns", 'concerts_sort');
function concerts_sort($columns) {
	$custom = array(
		'views' 	=> 'views'
	);
	return wp_parse_args($custom, $columns);
	/* or this way
		$columns['concertdate'] = 'concertdate';
		$columns['city'] = 'city';
		return $columns;
	*/
}

/*
 * ADMIN COLUMN - SORTING - ORDERBY
 * http://scribu.net/wordpress/custom-sortable-columns.html#comment-4732
 */
add_filter( 'request', 'views_column_orderby' );
function views_column_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'views' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => 'post_views_count',
			//'orderby' => 'meta_value_num', // does not work
			'orderby' => 'meta_value'
			//'order' => 'asc' // don't use this; blocks toggle UI
		) );
	}
	return $vars;
}

// Login / Register / Reset Password Function
add_action('wp_loaded', 'cardojo_login_register_function');
function cardojo_login_register_function(){
    
    if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

		if( isset( $_POST['ajaxLoginFunction_nonce'] ) && wp_verify_nonce( $_POST['ajaxLoginFunction_nonce'], 'ajaxLoginFunction_html' ) ){

			$creds                  = array();
			$creds['user_login']    = sanitize_email( $_POST['email'] );
			$creds['user_password'] = trim( $_POST['password'] );
			$secure_cookie          = null;
			
			if ( ! force_ssl_admin() ) {

				$user = is_email( $creds['user_login'] ) ? get_user_by( 'email', $creds['user_login'] ) : get_user_by( 'login', sanitize_user( $creds['user_login'] ) );

				if ( $user && get_user_option( 'use_ssl', $user->ID ) ) {
					$secure_cookie = true;
					force_ssl_admin( true );
				}

			}

			if ( force_ssl_admin() ) {
				$secure_cookie = true;
			}

			if ( is_null( $secure_cookie ) && force_ssl_login() ) {
				$secure_cookie = false;
			}

			$user = wp_signon( $creds, $secure_cookie );
			header("Refresh:0");

			if ( ! is_wp_error( $user ) ) {
				
			} else {

				if ( $user->errors ) {
					$errors['invalid_user'] = __('<span class="error-title">Error</span>Error with email or password.', 'cardojo'); 
				} else {
					$errors['invalid_user_credentials'] = __( '<span class="error-title">Error</span>Email and password required.', 'cardojo' );
				}

			}

		} elseif( isset( $_POST['ajaxResetPasswordFunction_nonce'] ) && wp_verify_nonce( $_POST['ajaxResetPasswordFunction_nonce'], 'ajaxResetPasswordFunction_html' ) ){
			
			$email = sanitize_email( $_POST['email'] );

			$user = get_user_by( 'email', $email );
			$td_user_id = $user->ID;

			if( !empty($td_user_id)) {

				$new_password = wp_generate_password( 12, false ); 

				if ( isset($new_password) ) {

					wp_set_password( $new_password, $td_user_id );

					$admin_email = get_option( 'admin_email' );
					$headers = "From: ".$admin_email . "\r\n";
					$subject = "Parolă nouă!";
					$msg = "Reset password.\nYour login details\nNew Password: $new_password";
					wp_mail( $email, $subject, $msg, $headers ); 

					$success['success_password_reset'] = __('<span class="success-title">Succes</span>Passwords has been reset. Check your email inbox for new password.', 'cardojo');

				}

			} else {

				$errors['invalid_email'] = __("<span class='error-title'>Error</span>Email doesn't exist.", 'cardojo'); 

			} // end if/else

		} elseif( isset( $_POST['ajaxRegisterDealerFunction_nonce'] ) && wp_verify_nonce( $_POST['ajaxRegisterDealerFunction_nonce'], 'ajaxRegisterDealerFunction_html' ) ){

			$username  = sanitize_user( $_POST['username'] );
			$email     = sanitize_email( $_POST['email'] );
			$password  = trim( $_POST['password'] ); 

			if( email_exists( $email )) {

			  	$errors['invalid_email'] = __('<span class="error-title">Error</span>Email is in use already.', 'cardojo'); 

			} else {

				$user_id = wp_create_user( $username, $password, $email );
				$user_id_role = new WP_User($user_id);
				$user_id_role->set_role('dealer');

				$from = get_option('admin_email');
			  	$headers = 'From: '.$from . "\r\n";
			  	$subject = "Succesful registration";
			  	$msg = "Succesful registration.\nLogin info:\nEmail: $email\nPassword: $password";
			  	wp_mail( $email, $subject, $msg, $headers );

			  	$login_data = array();
			  	$login_data['user_login'] = $email;
			  	$login_data['user_password'] = $password;
			  	$secure_cookie          = null;

			  	if ( ! force_ssl_admin() ) {

					$user = is_email( $login_data['user_login'] ) ? get_user_by( 'email', $login_data['user_login'] ) : get_user_by( 'login', sanitize_user( $login_data['user_login'] ) );

					if ( $user && get_user_option( 'use_ssl', $user->ID ) ) {
						$secure_cookie = true;
						force_ssl_admin( true );
					}

				}

				if ( force_ssl_admin() ) {
					$secure_cookie = true;
				}

				if ( is_null( $secure_cookie ) && force_ssl_login() ) {
					$secure_cookie = false;
				}

			  	wp_signon( $login_data, $secure_cookie );
			  	header("Refresh:0");

			}

		}

	}
}

//
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  	show_admin_bar(false);
	}
}

// Check if user have sufficient funds
function cardojo_user_sufficient_funds( $customer_id, $amount ) {
	
	$funds = get_user_meta( $customer_id, 'account_funds', true );

	if( $funds >= $amount ) {
		return true;
	} else {
		return false;
	}

}

/*-----------------------------------------------------------------------------------*/
/*	Send Notifications
/*-----------------------------------------------------------------------------------*/
function cardojo_send_vehicle_notifications( $vehicle_id ) {

	if ( get_post_type( $vehicle_id ) == 'vehicle' ) {
	
		$vehicle_make = esc_attr(get_post_meta($vehicle_id, 'vehicle_make',true));
		$vehicle_model = esc_attr(get_post_meta($vehicle_id, 'vehicle_model',true));
		$vehicle_year = esc_attr(get_post_meta($vehicle_id, 'vehicle_year',true));
		$vehicle_price = esc_attr(get_post_meta($vehicle_id, 'vehicle_price',true));
		$vehicle_mileage = esc_attr(get_post_meta($vehicle_id, 'vehicle_mileage',true));
		$vehicle_condition = esc_attr(get_post_meta($vehicle_id, 'vehicle_condition',true));
		$vehicle_fuel_type = get_the_terms($vehicle_id, 'vehicle_fuel_type' );
		if(!empty($vehicle_fuel_type)) {
			$term_vehicle_fuel_type = $vehicle_fuel_type[0]->name;
		} else {
			$term_vehicle_fuel_type = "";
		}

		$vehicle_url = get_permalink( $vehicle_id );
		$vehicle_name = get_the_title( $vehicle_id );

		if( $vehicle_condition == "Used" ) {
			$vehicle_condition = "";
		} elseif( $vehicle_condition == "New" ) {
			$vehicle_condition = "on";
		}

	    //
		$site_name = get_bloginfo('name');

		$email_list = array();

		// New
		$filter_args = array(
			'post_type'           => 'filter',
			'posts_per_page'      => -1,
			'post_status'         => array( 'publish' ),
			'orderby'             => 'ID',
			'order'               => 'DESC'
		);

		$filters_query = new WP_Query;
		$filters = $filters_query->query( $filter_args );

		if ( $filters ) :

			foreach ( $filters as $filter ) :

				$filter_ID = $filter->ID; 

				$post_filter_email = get_post_meta($filter_ID, 'filter_email',true);
				$post_filter_user_id = get_post_meta($filter_ID, 'filter_user_id',true);
		        $post_filter_make = get_post_meta($filter_ID, 'filter_make',true);
		        $post_filter_model = get_post_meta($filter_ID, 'filter_model',true);
		        $post_filter_fuel_type = get_post_meta($filter_ID, 'filter_fuel_type',true);
		        $post_filter_price = get_post_meta($filter_ID, 'filter_price',true);
		        $post_filter_year = get_post_meta($filter_ID, 'filter_year',true);
		        $post_filter_mileage = get_post_meta($filter_ID, 'filter_mileage',true);
		        $post_filter_condition = get_post_meta($filter_ID, 'filter_condition',true);

		        if( $post_filter_make == "0" ) {
					$filter_by_make = 1;
				} elseif( $post_filter_make == $vehicle_make ) {
					$filter_by_make = 1;
				} else {
					$filter_by_make = 0;
				}

				if( $post_filter_model == "0" ) {
					$filter_by_model = 1;
				} elseif( $post_filter_model == $vehicle_model ) {
					$filter_by_model = 1;
				} else {
					$filter_by_model = 0;
				}

				if( $post_filter_fuel_type == "0" ) {
					$filter_by_fuel = 1;
				} elseif( $post_filter_fuel_type == $term_vehicle_fuel_type ) {
					$filter_by_fuel = 1;
				} else {
					$filter_by_fuel = 0;
				}

				if( $post_filter_year <= $vehicle_year ) {
					$filter_by_year = 1;
				} else {
					$filter_by_year = 0;
				}

				if( $post_filter_price >= $vehicle_price ) {
					$filter_by_price = 1;
				} else {
					$filter_by_price = 0;
				}

				if( $post_filter_mileage >= $vehicle_mileage ) {
					$filter_by_mileage = 1;
				} else {
					$filter_by_mileage = 0;
				}

				if( empty($post_filter_condition) ) {
					$filter_by_condition = 1;
				} elseif( $post_filter_condition == $vehicle_condition ) {
					$filter_by_condition = 1;
				} else {
					$filter_by_condition = 0;
				}

		        if ( $filter_by_make == 1 AND $filter_by_model == 1 AND $filter_by_fuel == 1 AND $filter_by_year == 1 AND $filter_by_price == 1 AND $filter_by_mileage == 1 AND $filter_by_condition == 1 ) { 

		        	$email_list[] = $post_filter_email;

		        	// Add to car filter id and view = new;
		        	$filter_IDs = array();
		        	$filter_IDs = get_post_meta($vehicle_id, 'filter_ids',true);
		        	$filter_IDs[] = $filter_ID;
		        	$filter_IDs = array_unique($filter_IDs);

		        	update_post_meta($vehicle_id, 'filter_ids', $filter_IDs);
		        	update_post_meta($vehicle_id, 'filter_user_'.$post_filter_user_id, 'new');

		        }

			endforeach;

		endif;
		// End New

		$email_list_unique = array_unique($email_list);

	    if( !empty($email_list_unique)) {

	    	foreach($email_list_unique as $email) {

	    		// Send Email
		    	if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
					$eol="\r\n";
				} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
					$eol="\r";
				} else {
					$eol="\n";
				}

				// Message for car dealer
				$from = get_option('admin_email');
			  	$subject = __('Vehicle notification from ', 'cardojo').$site_name;
			  	$headers = "From: " . $from . $eol;
				$headers .= "Reply-To: " . $from . $eol;
				$headers .= "MIME-Version: 1.0".$eol;
				$headers .= "Content-Type: text/html; charset=ISO-8859-1".$eol;

				$email_content = "".__('New vehicle added matching your criteria', 'cardojo')."<br><br><a href='".$vehicle_url."'>".$vehicle_name."</a>";

			  	$msg = $email_content;

			  	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
			  	$mail_sent = wp_mail( $email, $subject, $msg, $headers );

			  	// Add new notification
			  	$user = get_user_by( 'email', $email );
			  	if(!empty($user)) {

			  		$user_id = $user->ID;
			  		$notifications = array();
			  		$notifications = get_user_meta( $user_id, 'vehicle_notifications', true );
			  		$notifications[] = $vehicle_id;
			  		update_user_meta( $user_id, 'vehicle_notifications', $notifications );

			  	}

	    	}

	    }

	}

}

/*-----------------------------------------------------------------------------------*/
/*	Subscribe to Filter
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_subscribe-filter', 'cardojo_subscribe_filter_ajax_handler' );
function cardojo_subscribe_filter_ajax_handler() {

	if( isset($_POST['filter_email']) ){

        $filter_email = sanitize_email($_POST['filter_email']);
        $filter_make = sanitize_text_field($_POST['filter_make']);
        $filter_model = sanitize_text_field($_POST['filter_model']);
        $filter_fuel_type = sanitize_text_field($_POST['filter_fuel_type']);
        $filter_price = sanitize_text_field($_POST['filter_price']);
        $filter_year = sanitize_text_field($_POST['filter_year']);
        $filter_mileage = sanitize_text_field($_POST['filter_mileage']);
        $filter_condition = sanitize_text_field($_POST['filter_condition']);

        if( !empty($filter_email) ){

        	$filter_exists = 0;
        	$new_filter_exists = 0;

        	// Add filter subscription as custom post type
        	$filter_args = array(
				'post_type'           => 'filter',
				'posts_per_page'      => -1,
				'post_status'         => array( 'publish' )
			);

			$filters_query = new WP_Query;
			$filters = $filters_query->query( $filter_args );

			if ( $filters ) :

				foreach ( $filters as $filter ) :

					$filter_ID = $filter->ID; 

					$post_filter_email = "";
			        $post_filter_make = "";
			        $post_filter_model = "";
			        $post_filter_fuel_type = "";
			        $post_filter_price = "";
			        $post_filter_year = "";
			        $post_filter_mileage = "";
			        $post_filter_condition = "";

					$post_filter_email = get_post_meta($filter_ID, 'filter_email',true);
			        $post_filter_make = get_post_meta($filter_ID, 'filter_make',true);
			        $post_filter_model = get_post_meta($filter_ID, 'filter_model',true);
			        $post_filter_fuel_type = get_post_meta($filter_ID, 'filter_fuel_type',true);
			        $post_filter_price = get_post_meta($filter_ID, 'filter_price',true);
			        $post_filter_year = get_post_meta($filter_ID, 'filter_year',true);
			        $post_filter_mileage = get_post_meta($filter_ID, 'filter_mileage',true);
			        $post_filter_condition = get_post_meta($filter_ID, 'filter_condition',true);

			        if ( $post_filter_email == $filter_email AND $post_filter_make == $filter_make AND $post_filter_model == $filter_model AND $post_filter_fuel_type == $filter_fuel_type AND $post_filter_price == $filter_price AND $post_filter_year == $filter_year AND $post_filter_mileage == $filter_mileage AND $post_filter_condition == $filter_condition ) { 

			        	$new_filter_exists = 1;

			        }
					

				endforeach;

			endif;

			if( $new_filter_exists == 0 ) {

        		// Add new custom post type "filter" with filter meta
        		$postNewTitle = $filter_email . " " . $filter_make . " " . $filter_model . " " . $filter_fuel_type . " " . $filter_price . " " . $filter_year . " " . $filter_mileage . " " . $filter_condition;

				$my_post = array(
					'post_author'   => 1,
				  	'post_name'     => sanitize_title( $postNewTitle ),
				  	'post_title'    => $postNewTitle,
				  	'post_status'   => 'publish',
				  	'post_type'     => 'filter',
				);
				 
				// Insert the post into the database
				$td_post_id = wp_insert_post( $my_post );

				$user = get_user_by( 'email', $filter_email );
				$filter_user_id = $user->ID;

				// Filter Meta
				update_post_meta($td_post_id, 'filter_email', $filter_email);
				update_post_meta($td_post_id, 'filter_user_id', $filter_user_id);
				update_post_meta($td_post_id, 'filter_make', $filter_make);
				update_post_meta($td_post_id, 'filter_model', $filter_model);
				update_post_meta($td_post_id, 'filter_fuel_type', $filter_fuel_type);
				update_post_meta($td_post_id, 'filter_price', $filter_price);
				update_post_meta($td_post_id, 'filter_year', $filter_year);
				update_post_meta($td_post_id, 'filter_mileage', $filter_mileage);
				update_post_meta($td_post_id, 'filter_condition', $filter_condition);

				// Sene email to admin
				// Send Email
		    	if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
					$eol="\r\n";
				} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
					$eol="\r";
				} else {
					$eol="\n";
				}

				// Message for car dealer
				$email = get_option('admin_email');
				$from = $filter_email;
			  	$subject = __('Filter notification from ', 'cardojo').$site_name;
			  	$headers = "From: " . $from . $eol;
				$headers .= "Reply-To: " . $from . $eol;
				$headers .= "MIME-Version: 1.0".$eol;
				$headers .= "Content-Type: text/html; charset=ISO-8859-1".$eol;

				$email_content = "".__('New filter subscription', 'cardojo')."<br><br>".__('Email', 'cardojo').": ".$filter_email."<br>".__('Make', 'cardojo').": ".$filter_make."<br>".__('Model', 'cardojo').": ".$filter_model."<br>".__('Fuel Type', 'cardojo').": ".$filter_fuel_type."<br>".__('Price to', 'cardojo').": ".$filter_price."<br>".__('From Year', 'cardojo').": ".$filter_year."<br>".__('Mileage up to', 'cardojo').": ".$filter_mileage."<br>".__('Condition', 'cardojo').": ".$filter_condition;
  
			  	$msg = $email_content;

			  	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
			  	$mail_sent = wp_mail( $email, $subject, $msg, $headers );

        	}
			// End

        }

    } else {

        _e('Invalid Paramenters!', 'cardojo');

    }

    echo "ceva";

    die;

}

/*-----------------------------------------------------------------------------------*/
/*	Delete Filter
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_remove_filter_set', 'cardojo_remove_filter_set_ajax_handler' );
function cardojo_remove_filter_set_ajax_handler() {

	if( isset($_POST['filter_id']) ){

		$filter_id = sanitize_text_field($_POST['filter_id']);
		if ( cardojo_user_can_edit_car( $filter_id ) ) {

			wp_trash_post( $filter_id );

		}

	} else {

        _e('Invalid Paramenters!', 'cardojo');

    }

    die;

}

/*-----------------------------------------------------------------------------------*/
/*	Add to favorite
/*-----------------------------------------------------------------------------------*/
if( 'POST' == $_SERVER['REQUEST_METHOD'] AND !empty($_POST['action']) AND $_POST['action'] == 'add_to_favorite' ) {

	if( isset($_POST['listing_id']) AND isset($_POST['user_id']) ){

        $listing_id = sanitize_text_field($_POST['listing_id']);
        $user_type = sanitize_text_field($_POST['user_type']);
        $user_id = sanitize_text_field($_POST['user_id']);

        if( !empty($listing_id) && !empty($user_id) ){

        	if( $user_type == 'id' ) {

        		$vehicle_favs_id = array();
            	$vehicle_favs_id = get_post_meta($listing_id, 'users_fav',true);
            	$vehicle_favs_id[] = $user_id;

            	update_post_meta($listing_id, 'users_fav', $vehicle_favs_id);

        	} elseif( $user_type == 'ip' ) {

        		$vehicle_favs_ip = array();
            	$vehicle_favs_ip = get_post_meta($listing_id, 'ips_fav',true);
            	$vehicle_favs_ip[] = $user_id;

            	update_post_meta($listing_id, 'ips_fav', $vehicle_favs_ip);

        	}

        }

    } else {

        _e('Invalid Paramenters!', 'cardojo');

    }

    die;

}

/*-----------------------------------------------------------------------------------*/
/*	Already added to favorite
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'is_added_to_favorite' ) ){

    function is_added_to_favorite( $user_type, $user_id, $listing_id ){
        global $wpdb;

        if( $user_type == 'id' ) {

    		$vehicle_favs = array();
        	$vehicle_favs = get_post_meta($listing_id, 'users_fav',true);

    	} elseif( $user_type == 'ip' ) {

    		$vehicle_favs = array();
        	$vehicle_favs = get_post_meta($listing_id, 'ips_fav',true);

    	}

        if ( !empty($vehicle_favs) AND in_array( $user_id, $vehicle_favs )) {
            return true;
        } else {
            return false;
        }

    }

}

/*-----------------------------------------------------------------------------------*/
// Remove from favorites
/*-----------------------------------------------------------------------------------*/
if( 'POST' == $_SERVER['REQUEST_METHOD'] AND !empty($_POST['action']) AND $_POST['action'] == 'remove_from_favorites' ) {

    if( isset($_POST['listing_id']) && isset($_POST['user_id']) ){

        $listing_id = sanitize_text_field($_POST['listing_id']);
        $user_type = sanitize_text_field($_POST['user_type']);
        $user_id = sanitize_text_field($_POST['user_id']);

        if( $user_type == "id" ) {

    		$vehicle_favs = array();
        	$vehicle_favs = get_post_meta($listing_id, 'users_fav',true);
        	$vehicle_favs = array_diff($vehicle_favs, array($user_id));

        	update_post_meta($listing_id, 'users_fav', $vehicle_favs);

    	} elseif( $user_type == "ip" ) {

    		$vehicle_favs = array();
        	$vehicle_favs = get_post_meta($listing_id, 'ips_fav',true);
        	$vehicle_favs = array_diff($vehicle_favs, array($user_id));

        	update_post_meta($listing_id, 'ips_fav', $vehicle_favs);

    	}

    } else {

        echo 1;
        /* Invalid parameters! */

    }
    
    die;

}

/*-----------------------------------------------------------------------------------*/
/*	Get USer IP Address
/*-----------------------------------------------------------------------------------*/
function CarDojoGetIP() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Save user payout information
/*-----------------------------------------------------------------------------------*/
function cardojo_user_save_payout( $user_id, $amount, $car_id, $payment_type ) {

	if( !empty($user_id) ) {

		$payouts = array();
		$payouts_data = array();
		$payouts = get_user_meta( $user_id, 'account_payouts', true );

		$payouts_data['user_id'] = $user_id;
		$payouts_data['date'] = date("Y-m-d H:i:s");
		$payouts_data['amount'] = $amount;
		$payouts_data['car_id'] = $car_id;
		$payouts_data['car_url'] = get_permalink($car_id);
		$payouts_data['car_title'] = get_the_title($car_id);
		$payouts_data['car_sku'] = esc_attr(get_post_meta($car_id, 'vehicle_stock',true));
		$payouts_data['payment_type'] = $payment_type;

		$payouts[] = $payouts_data;
		update_user_meta( $user_id, 'account_payouts', $payouts );

	}

}

/*-----------------------------------------------------------------------------------*/
/*	Check if user exists
/*-----------------------------------------------------------------------------------*/
function cardojo_user_id_exists($user){

    global $wpdb;
    $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->users WHERE ID = %d", $user));
    if($count == 1){ return true; }else{ return false; }

}


/*-----------------------------------------------------------------------------------*/
/*	Dealer User Meta
/*-----------------------------------------------------------------------------------*/
add_action( 'show_user_profile', 'dealer_user_meta_fields' );
add_action( 'edit_user_profile', 'dealer_user_meta_fields' );
add_action( 'personal_options_update', 'save_dealer_user_meta_fields' );
add_action( 'edit_user_profile_update', 'save_dealer_user_meta_fields' );

function dealer_user_meta_fields( $user ) {
	if ( in_array( 'dealer', (array) $user->roles ) OR in_array( 'administrator', (array) $user->roles ) ) {
		$dealer_name = get_user_meta( $user->ID, 'dealer_name', true );
		$mobile_phone = get_user_meta( $user->ID, 'mobile_phone', true );
		$office_phone = get_user_meta( $user->ID, 'office_phone', true );
	    ?>
		<h3><?php _e( 'Dealer Info', 'cardojo' ); ?></h3>
		<table class="form-table">
			<tr>
                <th><label for="dealer_name"><?php _e( 'Name', 'cardojo' ); ?></label></th>
                <td>
                    <input type="text" name="dealer_name" id="dealer_name" value="<?php echo esc_attr( $dealer_name ); ?>" class="regular-text" /><br/>
                </td>
            </tr>
            <tr>
                <th><label for="mobile_phone"><?php _e( 'Mobile Phone', 'cardojo' ); ?></label></th>
                <td>
                    <input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo esc_attr( $mobile_phone ); ?>" class="regular-text" /><br/>
                </td>
            </tr>
            <tr>
                <th><label for="office_phone"><?php _e( 'Office Phone', 'cardojo' ); ?></label></th>
                <td>
                    <input type="text" name="office_phone" id="office_phone" value="<?php echo esc_attr( $office_phone ); ?>" class="regular-text" /><br/>
                </td>
            </tr>
		</table>
		<?php
	}
}

function save_dealer_user_meta_fields( $user_id ) {

	if(isset($_POST['dealer_name'])) {
		$dealer_name = sanitize_text_field($_POST['dealer_name']);
	} else {
		$dealer_name = "";
	}
	update_user_meta( $user_id, 'dealer_name', esc_attr($dealer_name) );

	if(isset($_POST['mobile_phone'])) {
		$mobile_phone = sanitize_text_field($_POST['mobile_phone']);
	} else {
		$mobile_phone = "";
	}
	update_user_meta( $user_id, 'mobile_phone', esc_attr($mobile_phone) );

	if(isset($_POST['office_phone'])) {
		$office_phone = sanitize_text_field($_POST['office_phone']);
	} else {
		$office_phone = "";
	}
	update_user_meta( $user_id, 'office_phone', esc_attr($office_phone) );

}

/*-----------------------------------------------------------------------------------*/
/*	Dealer User Meta
/*-----------------------------------------------------------------------------------*/
add_action( 'show_user_profile', 'demo_user_meta_fields' );
add_action( 'edit_user_profile', 'demo_user_meta_fields' );
add_action( 'personal_options_update', 'save_demo_user_meta_fields' );
add_action( 'edit_user_profile_update', 'save_demo_user_meta_fields' );

function demo_user_meta_fields( $user ) {
	if ( in_array( 'dealer', (array) $user->roles ) ) {
		$demo_account = get_user_meta( $user->ID, 'demo_account', true );
	    ?>
		<h3><?php _e( 'Demo Account', 'cardojo' ); ?></h3>
		<table class="form-table">
			<tr>
                <th><label for="demo_account"><?php _e( 'Demo', 'cardojo' ); ?></label></th>
                <td>
                    <input type="checkbox" name="demo_account" <?php if( $demo_account == "on" ) { echo "checked"; } ?>>
                </td>
            </tr>
		</table>
		<?php
	}
}

function save_demo_user_meta_fields( $user_id ) {

	if(isset($_POST['demo_account'])) {
		$demo_account = sanitize_text_field($_POST['demo_account']);
	} else {
		$demo_account = "";
	}
	update_user_meta( $user_id, 'demo_account', esc_attr($demo_account) );

}

/*-----------------------------------------------------------------------------------*/
/*	Vehcile back end extra columns
/*-----------------------------------------------------------------------------------*/
add_filter('manage_edit-vehicle_columns', 'vehicle_extra_columns');
function vehicle_extra_columns($columns) {
    $columns['owner'] = 'Owner';
    $columns['type'] = 'Type';
    return $columns;
}

add_action('manage_vehicle_posts_custom_column',  'vehicle_extra_show_columns');
function vehicle_extra_show_columns($name) {
    global $post;
    switch ($name) {
        case 'owner':
            $author_id = $post->post_author;
            $dealer_name = get_user_meta( $author_id, 'dealer_name', true );
            if( empty($dealer_name)) {
            	$user = get_userdata( $author_id ); 
				$dealer_name = $user->user_nicename;
            }
            echo $dealer_name;
            break;
        case 'type':
        	$car_ID = $post->ID;
            if ( get_post_status ( $car_ID ) == 'publish' )  {
				$sold = esc_attr(get_post_meta($car_ID, '_sold',true));
				$featured = esc_attr(get_post_meta($car_ID, '_featured',true));
				$promoted = esc_attr(get_post_meta($car_ID, '_promoted',true));
				if( $sold == 1 ) {
					$vehicle_type = esc_html_e( 'Sold', 'cardojo' );
				} elseif( $featured == 1 ) {
					$vehicle_type = esc_html_e( 'Featured', 'cardojo' );
				} elseif( $promoted == 1 ) {
					$vehicle_type = esc_html_e( 'Promoted', 'cardojo' );
				} else {
					$vehicle_type = esc_html_e( 'Published', 'cardojo' );
				}
			} else {
				$vehicle_type = get_post_status ( $car_ID );
			}
            echo $vehicle_type;
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Vehcile back end extra columns
/*-----------------------------------------------------------------------------------*/
$acc_funds = get_option( 'cardojo_enable_account_funds' );
if ( $acc_funds == 1 AND !is_woocommerce_active() ) {
  	add_action( 'admin_notices', 'my_wc_notice' );
}

function my_wc_notice() {
  	?>
  	<div class="notice notice-error is-dismissible">
      	<p><?php _e( 'Please install WooCommerce, it is required for monetization to work properly!', 'cardojo' ); ?></p>
  	</div>
  	<?php
}