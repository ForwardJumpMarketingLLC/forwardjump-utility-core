<?php
/**
 * Plugin Name: ForwardJump Utility - CORE
 * Plugin URI: https://bitbucket.org/forwardjump/forwardjump-utility-core
 * Description: The ForwardJump core functionality plugin.
 *
 * Version: 0.5.0
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
 * Text Domain: forwardjump-utility
 *
 * BitBucket Plugin URI: https://bitbucket.org/forwardjump/forwardjump-utility-core
 * BitBucket branch: master
 *
 * @package ForwardJump\Utility
 * PHP Version 5.4
 */

namespace ForwardJump\Utility;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( 'FJ_UTILITY_TEXT_DOMAIN', 'forwardjump-utility' );
define( 'FJ_UTILITY_DIR', __DIR__ . '/' );
define( 'FJ_UTILITY_FILE', __FILE__ );

require_once FJ_UTILITY_DIR . 'vendor/autoload.php';
