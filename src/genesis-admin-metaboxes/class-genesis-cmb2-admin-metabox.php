<?php
/**
 * Genesis CMB2 Admin Metaboxes
 *
 * @package     ForwardJump\Utility
 * @author      Tim Jensen <tim@forwardjump.com>
 * @license     GNU General Public License 2.0+
 * @link        https://forwardjump.com
 * @since       0.3.1
 */

namespace ForwardJump\Utility\GenesisAdminMetaboxes;

/**
 * Class Genesis_CMB2_Admin_Metabox
 *
 * @version 0.1.1
 *
 * @package ForwardJump\Utility
 */
abstract class Genesis_CMB2_Admin_Metabox {

	/**
	 * Metabox title.
	 *
	 * @var string
	 */
	protected $metabox_title = '';

	/**
	 * Metabox fields.
	 *
	 * @var array
	 */
	protected $metabox_fields = [];

	/**
	 * Metabox id
	 *
	 * @var string
	 */
	protected $metabox_id = '';

	/**
	 * Metabox priority. Either 'high' or 'low'.
	 *
	 * @var string
	 */
	protected $metabox_priority = '';

	/**
	 * Option key, and option page slug
	 *
	 * @var string
	 */
	protected $key = '';

	/**
	 * CPT slug
	 *
	 * @var string
	 */
	protected $post_type = '';

	/**
	 * Admin hook
	 *
	 * @var string
	 */
	protected $admin_hook = '';

	/**
	 * The admin page slug.
	 *
	 * @var string
	 */
	protected $admin_page = '';

	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	public function __construct( array $config ) {
		$this->set_properties( (array) $config );
		$this->init();
	}

	/**
	 * Set the class properties.
	 *
	 * @since 0.1.1
	 *
	 * @param array $config Metabox configuration array.
	 */
	protected function set_properties( array $config ) {
		$this->metabox_title = empty( $config['metabox_title'] ) ? null : $config['metabox_title'];
		$this->metabox_fields = empty( $config['metabox_fields'] ) ? null : (array) $config['metabox_fields'];
		$this->metabox_priority = ( isset( $config['metabox_priority'] ) && 'low' === $config['metabox_priority'] ) ? 'low' : 'high';
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 0.1.0
	 */
	protected function init() {
		add_action( 'admin_menu', [ $this, 'admin_hooks' ] );
		add_action( 'cmb2_admin_init', [ $this, 'init_metabox' ] );
	}

	/**
	 * Add admin hooks.
	 *
	 * @since 0.1.0
	 */
	public function admin_hooks() {
		// Include CMB CSS in the head to avoid FOUC.
		add_action( "admin_print_styles-{$this->admin_hook}", [ 'CMB2_hookup', 'enqueue_cmb_css' ] );

		// Hook into the Genesis cpt settings save and add in the CMB2 sanitized values.
		add_filter( "sanitize_option_{$this->key}", [ $this, 'add_sanitized_values' ], 999 );

		// Hook up our Genesis metabox.
		add_action( "genesis_{$this->admin_page}_metaboxes", [ $this, 'add_meta_box' ] );
	}

	/**
	 * Hook up our Genesis metabox.
	 *
	 * @since 0.1.0
	 */
	public function add_meta_box() {
		$cmb = $this->init_metabox();
		add_meta_box(
			$cmb->cmb_id,
			$cmb->prop( 'title' ),
			[ $this, 'output_metabox' ],
			$this->admin_hook,
			$cmb->prop( 'context' ),
			$cmb->prop( 'priority' )
		);
	}

	/**
	 * Output our Genesis metabox.
	 *
	 * @since 0.1.0
	 */
	public function output_metabox() {
		$cmb = $this->init_metabox();
		$cmb->show_form( $cmb->object_id(), $cmb->object_type() );
	}

	/**
	 * Register our Genesis metabox and return the CMB2 object.
	 *
	 * @since  0.1.0
	 *
	 * @return \CMB2 instance.
	 */
	public function init_metabox() {

		static $count = 0;
		$count ++;

		$cmb = cmb2_get_metabox( [
			'id'           => $this->metabox_id . "-{$count}",
			'title'        => __( $this->metabox_title, FJ_UTILITY_TEXT_DOMAIN ),
			'hookup'       => false, // Handled with $this->add_sanitized_values().
			'cmb_styles'   => false, // Handled with $this->admin_hooks().
			'context'      => 'main', // Important for Genesis.
			'priority'     => $this->metabox_priority, // Defaults to 'high'.
			'object_types' => [ $this->admin_hook ],
			'show_on'      => [
				// These are important, don't remove.
				'key'   => 'options-page',
				'value' => [ $this->key ],
			],
		], $this->key, 'options-page' );

		foreach ( (array) $this->metabox_fields as $field_args ) {
			// Set our CMB2 fields.
			$cmb->add_field( $field_args );
		}

		return $cmb;
	}

	/**
	 * If saving the cpt settings option, add the CMB2 sanitized values.
	 *
	 * @since 0.1.0
	 *
	 * @param array $new_value Array of values for the setting.
	 *
	 * @return array Updated array of values for the setting.
	 */
	public function add_sanitized_values( $new_value ) {
		if ( ! empty( $_POST ) ) {
			$cmb = $this->init_metabox();

			$new_value = array_merge(
				$new_value,
				$cmb->get_sanitized_values( $_POST )
			);
		}

		return $new_value;
	}
}
