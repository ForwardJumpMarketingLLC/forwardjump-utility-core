<?php
/**
 * Plugin Name: ForwardJump Utility - CORE
 * Plugin URI: https://github.com/ForwardJumpMarketingLLC/forwardjump-utility-core
 * Description: The ForwardJump core functionality plugin.
 *
 * Version: 1.6.3
 *
 * Author: Tim Jensen
 * Author URI: https://forwardjump.com/
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.  You may NOT assume that you can use any other
 * version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * Text Domain: forwardjump-utility-core
 *
 * GitHub Plugin URI: https://github.com/ForwardJumpMarketingLLC/forwardjump-utility-core
 * GitHub branch: master
 *
 * @package ForwardJump\Utility
 * PHP Version 5.6
 */

namespace ForwardJump\Utility;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$constants = [
	'FJ_UTILITY_TEXT_DOMAIN' => 'forwardjump-utility-core',
	'FJ_UTILITY_DIR' => __DIR__ . '/',
	'FJ_UTILITY_CONFIG_DIR' => __DIR__ . '/config/',
	'FJ_UTILITY_FILE' => __FILE__,
	'FJ_UTILITY_URL' => plugins_url( null, __FILE__ ),
];

/**
 * Define our constants.
 */
array_walk( $constants, function ( $value, $constant ) {

	if ( ! defined( $constant ) ) {
		define( $constant, $value );
	}

} );

if ( is_admin() ) {
	require_once FJ_UTILITY_DIR . 'vendor/CMB2/init.php';
}

require FJ_UTILITY_DIR . 'vendor/timothyjensen/acf-field-group-values/acf-field-group-values.php';

require_once FJ_UTILITY_DIR . 'vendor/autoload.php';
