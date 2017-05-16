<?php
/**
 * Settings Module
 *
 * @package     ForwardJump\Utility\Settings
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\Settings;

/**
 * Class Settings_Page
 *
 * @package ForwardJump\Utility\Settings
 */
class Settings_Page {

	/**
	 * The capability required for this menu to be displayed to the user.
	 *
	 * @var string
	 */
	private $capability = 'manage_options';

	/**
	 * Menu page type.
	 *
	 * @var string
	 */
	private $menu_page_type = 'menu';

	/**
	 * Menu page parent.
	 *
	 * @var string
	 */
	private $menu_page_parent = '';

	/**
	 * Menu page order/priority.
	 *
	 * @var int
	 */
	private $menu_page_priority = 10;

	/**
	 * Menu icon.
	 *
	 * @var string
	 */
	private $menu_page_icon = '';

	/**
	 * Menu slug.
	 *
	 * @var string
	 */
	private $menu_slug = '';

	/**
	 * Menu title..
	 *
	 * @var string
	 */
	private $menu_title = '';

	/**
	 * Options page title.
	 *
	 * @var string
	 */
	private $page_title = '';

	/**
	 * Option name.
	 *
	 * @var string
	 */
	private $option_name = '';

	/**
	 * Option group name.
	 *
	 * @var string
	 */
	private $option_group = '';

	/**
	 * Options page metabox id
	 *
	 * @var string
	 */
	private $metabox_id = '';

	/**
	 * Options page metabox fields.
	 *
	 * @var array
	 */
	private $metabox_fields = [];

	/**
	 * Options page view file.
	 *
	 * @var string
	 */
	private $view_file = FJ_UTILITY_SETTINGS_DIR . '/views/admin-form.php';

	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Configuration array for the settings page.
	 */
	public function __construct( $config ) {
		$this->set_properties( (array) $config );
	}

	/**
	 * Sets the class properties.
	 *
	 * @since 0.5.0
	 *
	 * @param array $config Configuration array for the settings page.
	 * @return void
	 */
	protected function set_properties( array $config ) {

		foreach ( $config as $property => $value ) {

			if ( isset( $this->{$property} ) ) {
				$this->{$property} = $value;
			}
		}

		if ( empty( $this->option_group ) ) {
			$this->option_group = $this->option_name;
		}
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 0.1.0
	 */
	public function init() {
		add_action( 'admin_init', array( $this, 'register_setting' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ), $this->menu_page_priority );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );
	}

	/**
	 * Register our setting to WP
	 *
	 * @since  0.1.0
	 */
	public function register_setting() {
		register_setting( $this->option_group, $this->option_name );
	}

	/**
	 * Add menu options page
	 *
	 * @since 0.1.0
	 */
	public function add_options_page() {

		$menu_page_args = [
			__( $this->page_title, FJ_UTILITY_TEXT_DOMAIN ),
			__( $this->menu_title, FJ_UTILITY_TEXT_DOMAIN ),
			$this->capability,
			$this->menu_slug,
			[ $this, 'admin_page_display' ],
		];

		if ( 'submenu' === $this->menu_page_type && ! empty( $this->menu_page_parent ) ) {
			array_unshift( $menu_page_args, $this->menu_page_parent );
		}

		if ( 'menu' === $this->menu_page_type ) {
			array_push( $menu_page_args, $this->menu_page_icon, $this->menu_page_priority );
		}

		call_user_func_array( "add_{$this->menu_page_type}_page", $menu_page_args );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2.
	 *
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		include $this->view_file;
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 *
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		if ( empty( $this->metabox_fields ) ) {
			return;
		}

		$cmb = new_cmb2_box( [
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => true,
			'show_on'    => [
				'key'   => 'options-page',
				'value' => [ $this->option_name ],
			],
		] );

		foreach ( $this->metabox_fields as $field ) {
			$cmb->add_field( $field );
		}
	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 *
	 * @param  int   $object_id Option key.
	 * @param  array $updated   Array of updated fields.
	 *
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {

		if ( $object_id !== $this->option_name || empty( $updated ) ) {
			return;
		}

		add_settings_error(
			$this->option_name . '-notices',
			'',
			__( 'Settings updated.', FJ_UTILITY_TEXT_DOMAIN ),
			'updated'
		);

		settings_errors( $this->option_name . '-notices' );
	}
}
