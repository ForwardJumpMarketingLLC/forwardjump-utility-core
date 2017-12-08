<?php
/**
 * Class Test_Classes
 *
 * @package Forwardjump_Utility_Core
 */

/**
 * Test_Classes.
 */
class Test_Classes extends WP_UnitTestCase {

	/**
	 * Set up.
	 */
	function setUp() {
		parent::setUp();

		set_current_screen( 'edit-post' );

		// Require the plugin bootstrap file so that the CMB2 dependency
		// is read into memory.
		require FJ_UTILITY_FILE;
		$cmb_init = \CMB2_Bootstrap_2262::initiate();
		$cmb_init->include_cmb();
	}

	/**
	 * Tear down.
	 */
	function tearDown() {
		parent::tearDown();
	}

	/**
	 * Register post type.
	 */
	function test_register_post_type() {
		$cpt = require FJ_UTILITY_CONFIG_DIR . 'examples/example-custom-post-types-config.php';
		$cpt = $cpt[0];

		$registered_cpt = new \ForwardJump\Utility\CustomPostTypes\Custom_Post_Type( $cpt );
		$registered_cpt->register_custom_post_type();
		$get_post_type_object = get_post_type_object( $cpt['post_type'] );

		$this->assertInstanceOf( 'ForwardJump\Utility\CustomPostTypes\Custom_Post_Type', $registered_cpt );
		$this->assertEquals( $get_post_type_object->name, $cpt['post_type'] );
	}

	/**
	 * Register taxonomy.
	 */
	function test_register_taxonomy() {
		$taxo = require FJ_UTILITY_CONFIG_DIR . 'examples/example-custom-taxonomies-config.php';
		$taxo = $taxo[0];

		$registered_taxo = new \ForwardJump\Utility\CustomTaxonomies\Custom_Taxonomy( $taxo );
		$registered_taxo->register_custom_taxonomy();
		$get_taxonomy = get_taxonomy( $taxo['taxonomy'] );

		$this->assertInstanceOf( 'ForwardJump\Utility\CustomTaxonomies\Custom_Taxonomy', $registered_taxo );
		$this->assertEquals( $get_taxonomy->name, $taxo['taxonomy'] );
	}

	/**
	 * Genesis CPT Archive Settings meta box.
	 */
	function test_genesis_cpt_metaboxes() {
		$metabox = require FJ_UTILITY_CONFIG_DIR . 'examples/example-genesis-cpt-archives-config.php';
		$metabox = $metabox[0];
		$metabox['metabox']['id'] = 'fj_test_genesis_cpt_metabox';

		$genesis_cpt_metabox = new \ForwardJump\Utility\GenesisAdminMetaboxes\Genesis_CPT_Archives_Meta_Box( $metabox );

		$this->assertInstanceOf( 'ForwardJump\Utility\GenesisAdminMetaboxes\Genesis_CPT_Archives_Meta_Box', $genesis_cpt_metabox );

		$genesis_cpt_metabox->init_metabox();

		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );

		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}

	/**
	 * Genesis Theme Settings meta box.
	 */
	function test_genesis_theme_metaboxes() {
		$metabox = require FJ_UTILITY_CONFIG_DIR . 'examples/example-genesis-theme-settings-config.php';
		$metabox = $metabox[0];
		$metabox['metabox']['id'] = 'fj_test_genesis_theme_metabox';

		$genesis_theme_metabox = new \ForwardJump\Utility\GenesisAdminMetaboxes\Genesis_Theme_Settings_Meta_Box( $metabox );

		$this->assertInstanceOf( 'ForwardJump\Utility\GenesisAdminMetaboxes\Genesis_Theme_Settings_Meta_Box', $genesis_theme_metabox );

		$genesis_theme_metabox->init_metabox();

		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );

		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}

	/**
	 * Post meta box.
	 */
	function test_post_metaboxes() {
		$metabox = require FJ_UTILITY_CONFIG_DIR . 'examples/example-post-metabox-config.php';
		$metabox = $metabox[0];
		$metabox['metabox']['id'] = 'fj_test_post_metabox';

		$post_metabox = new \ForwardJump\Utility\PostMetaboxes\Post_Metabox( $metabox );
		$post_metabox->init_metabox();

		$this->assertInstanceOf( 'ForwardJump\Utility\PostMetaboxes\Post_Metabox', $post_metabox );

		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );
		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}

	/**
	 * Settings page.
	 */
	function test_settings_pages() {
		$settings_page_config = require FJ_UTILITY_CONFIG_DIR . 'settings-page-config.php';
		$settings_page_config = $settings_page_config[0];

		$settings_page = new \ForwardJump\Utility\Settings\Settings_Page( $settings_page_config );
		$this->assertInstanceOf( 'ForwardJump\Utility\Settings\Settings_Page', $settings_page );
	}

	/**
	 * Shortcodes.
	 */
	function test_shortcodes() {
		$shortcode_config = require FJ_UTILITY_CONFIG_DIR . 'shortcodes-config.php';
		$shortcode_config = $shortcode_config[0];

		$shortcode = new \ForwardJump\Utility\Shortcodes\Add_Shortcode( $shortcode_config );
		$this->assertInstanceOf( 'ForwardJump\Utility\Shortcodes\Add_Shortcode', $shortcode );

		$shortcode->init();
		$this->assertTrue( shortcode_exists( $shortcode_config['tag'] ) );
	}

	/**
	 * Term meta box.
	 */
	function test_term_metaboxes() {
		$metabox = require FJ_UTILITY_CONFIG_DIR . 'examples/example-term-metabox-config.php';
		$metabox = $metabox[0];
		$metabox['metabox']['id'] = 'fj_test_term_metabox';

		$term_metabox = new \ForwardJump\Utility\TermMetaboxes\Term_Metabox( $metabox );
		$this->assertInstanceOf( 'ForwardJump\Utility\TermMetaboxes\Term_Metabox', $term_metabox );

		$term_metabox->init_metabox();
		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );
		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}
}
