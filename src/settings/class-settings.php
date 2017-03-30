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
	private $capability = '';

	/**
	 * Menu page type.
	 *
	 * @var string
	 */
	private $menu_page_type = '';

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
	private $menu_page_priority = '';

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
	 * Configuration file.
	 *
	 * @var array
	 */
	private $config = [];

	/**
	 * View file.
	 *
	 * @var string
	 */
	private $view_file = '';

	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = (array) $config;

		$this->set_capability();
		$this->set_menu_page_type();
		$this->set_menu_page_parent();
		$this->set_menu_page_priority();
		$this->set_menu_page_icon();
		$this->set_menu_slug();
		$this->set_menu_title();
		$this->set_page_title();
		$this->set_option_name();
		$this->set_option_group();
		$this->set_metabox_id();
		$this->set_metabox_fields();
		$this->set_view_file();

		$this->init();
	}

	/**
	 * Sets the capability required for this menu to be displayed to the user..
	 *
	 * @since 0.1.0
	 */
	protected function set_capability() {
		$this->capability = ! empty( $this->config['capability'] ) ? $this->config['capability'] : 'manage_options';
	}

	/**
	 * Sets the menu page type.  Either 'options', 'menu', or 'submenu'.
	 *
	 * @since 0.1.0
	 */
	protected function set_menu_page_type() {
		$this->menu_page_type = ! empty( $this->config['menu_page_type'] ) ? $this->config['menu_page_type'] : 'menu';
	}

	/**
	 * Sets the menu page parent.
	 *
	 * @since 0.1.0
	 */
	protected function set_menu_page_parent() {
		$this->menu_page_parent = ! empty( $this->config['menu_page_parent'] ) ? $this->config['menu_page_parent'] : null;
	}

	/**
	 * Sets the menu page priority.
	 *
	 * @since 0.1.0
	 */
	protected function set_menu_page_priority() {
		$this->menu_page_priority = ! empty( $this->config['menu_page_priority'] ) ? $this->config['menu_page_priority'] : 10;
	}

	/**
	 * Sets the menu page icon.
	 *
	 * @since 0.1.0
	 */
	protected function set_menu_page_icon() {
		$this->menu_page_icon = ! empty( $this->config['menu_page_icon'] ) ? $this->config['menu_page_icon'] : null;
	}

	/**
	 * Sets the menu slug.
	 *
	 * @since 0.1.0
	 */
	protected function set_menu_slug() {
		$this->menu_slug = ! empty( $this->config['menu_slug'] ) ? $this->config['menu_slug'] : null;
	}

	/**
	 * Sets the menu title.
	 *
	 * @since 0.1.0
	 */
	protected function set_menu_title() {
		$this->menu_title = ! empty( $this->config['menu_title'] ) ? $this->config['menu_title'] : null;
	}

	/**
	 * Sets the Options Page title.
	 *
	 * @since 0.1.0
	 */
	protected function set_page_title() {
		$this->page_title = ! empty( $this->config['page_title'] ) ? $this->config['page_title'] : null;
	}

	/**
	 * Sets the option name.
	 *
	 * @since 0.1.0
	 */
	protected function set_option_name() {
		$this->option_name = ! empty( $this->config['option_name'] ) ? $this->config['option_name'] : null;
	}

	/**
	 * Sets the option group.
	 *
	 * @since 0.1.0
	 */
	protected function set_option_group() {
		$this->option_group = ! empty( $this->config['option_group'] ) ? $this->config['option_group'] : $this->option_name;
	}

	/**
	 * Sets the metabox ID.
	 *
	 * @since 0.1.0
	 */
	protected function set_metabox_id() {
		$this->metabox_id = ! empty( $this->config['metabox_id'] ) ? $this->config['metabox_id'] : null;
	}

	/**
	 * Sets the metabox fields.
	 *
	 * @since 0.1.0
	 */
	protected function set_metabox_fields() {
		$this->metabox_fields = ! empty( $this->config['metabox_fields'] ) ? $this->config['metabox_fields'] : [];
	}

	/**
	 * Sets the view file.
	 *
	 * @since 0.1.0
	 */
	protected function set_view_file() {
		$this->view_file = ! empty( $this->config['view_file'] ) ? $this->config['view_file'] : null;
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
			__( $this->menu_title ),
			$this->capability,
			$this->menu_slug,
			[ $this, 'admin_page_display' ]
		];

		if ( 'submenu' == $this->menu_page_type && ! empty( $this->menu_page_parent ) ) {
			array_unshift( $menu_page_args, $this->menu_page_parent );
		}

		if ( 'menu' == $this->menu_page_type ) {
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

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => true,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->option_name, )
			),
		) );

		foreach ( $this->metabox_fields as $field ) {
			$cmb->add_field( $field );
		}
	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 *
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
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
			'updated' );

		settings_errors( $this->option_name . '-notices' );
	}
}