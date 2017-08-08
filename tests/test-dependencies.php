<?php
/**
 * Class Test_Dependencies
 *
 * @package Forwardjump_Utility_Core
 */

/**
 * Test plugin dependencies.
 */
class Test_Dependencies extends WP_UnitTestCase {

	/**
	 * Set up.
	 */
	function setUp() {
		parent::setUp();

		set_current_screen( 'edit-post' );

		// Require the plugin bootstrap file so that the CMB2 dependency
		// is read into memory.
		require FJ_UTILITY_FILE;
		$cmb_init = \CMB2_Bootstrap_2251::initiate();
		$cmb_init->include_cmb();
	}

	/**
	 * Tear down.
	 */
	function tearDown() {
		parent::tearDown();
	}

	/**
	 * Plugin constants are defined.
	 */
	function test_are_constants_defined() {
		$this->assertTrue( defined( 'FJ_UTILITY_TEXT_DOMAIN' ) );
		$this->assertTrue( defined( 'FJ_UTILITY_DIR' ) );
		$this->assertTrue( defined( 'FJ_UTILITY_CONFIG_DIR' ) );
		$this->assertTrue( defined( 'FJ_UTILITY_SETTINGS_DIR' ) );
		$this->assertTrue( defined( 'FJ_UTILITY_SHORTCODES_DIR' ) );
		$this->assertTrue( defined( 'FJ_UTILITY_FILE' ) );
	}

	/**
	 * Composer autoloader exists.
	 */
	function test_composer_autoload_exists() {
		$this->assertTrue( file_exists( dirname( __DIR__ ) . '/vendor/autoload.php' ) );
	}

	/**
	 * CMB2 is loaded.
	 */
	function test_is_cmb2_loaded() {
		$this->assertTrue( function_exists( 'new_cmb2_box' ) );
	}
}
