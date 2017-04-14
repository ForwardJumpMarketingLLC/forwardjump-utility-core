<?php
/**
 * Genesis CPT Archives Metabox class.
 *
 * @package ForwardJump\Utility\GenesisAdminMetaboxes
 * @since   0.2.4
 * @author  Tim Jensen
 * @link    https://forwardjump.com/
 * @license GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\GenesisAdminMetaboxes;

/**
 * CMB2 Genesis CPT Archives Metabox
 *
 * To fetch these options, use `genesis_get_cpt_option()`, e.g.
 *    // In CPT archive template:
 *    if ( genesis_has_post_type_archive_support() ) {
 *        $color = genesis_get_cpt_option( 'test_colorpicker' );
 *    }
 *
 * @version 0.3.0
 */
class Genesis_CPT_Archives_Metabox {

	/**
	 * CPT slug
	 *
	 * @var string
	 */
	protected $post_type = '';

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
	 * Admin hook
	 *
	 * @var string
	 */
	protected $admin_hook = '';

	/**
	 * Option key, and option page slug
	 *
	 * @var string
	 */
	protected $key = '';

	/**
	 * Constructor
	 *
	 * @since 0.2.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	public function __construct( array $config ) {

		$this->set_properties( (array) $config );
		$this->hooks();
	}

	/**
	 * Set the class properties.
	 *
	 * @since 0.3.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	protected function set_properties( array $config ) {

		$this->post_type  = empty( $config['post_type'] ) ? null : $config['post_type'];
		$this->metabox_title = empty( $config['metabox_title'] ) ? null : $config['metabox_title'];
		$this->metabox_fields = empty( $config['metabox_fields'] ) ? null : (array) $config['metabox_fields'];

		$this->metabox_id = sprintf( 'genesis-cpt-archive-settings-metabox-%1$s', $this->post_type );
		$this->admin_hook = sprintf( '%1$s_page_genesis-cpt-archive-%1$s', $this->post_type );
		$this->key        = sprintf( 'genesis-cpt-archive-settings-%1$s', $this->post_type );
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 0.2.0
	 */
	protected function hooks() {
		add_action( 'admin_menu', array( $this, 'admin_hooks' ) );
		add_action( 'cmb2_admin_init', array( $this, 'init_metabox' ) );
	}

	/**
	 * Add admin hooks.
	 *
	 * @since 0.2.0
	 */
	public function admin_hooks() {
		// Include CMB CSS in the head to avoid FOUC.
		add_action( "admin_print_styles-{$this->admin_hook}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );

		// Hook into the Genesis cpt settings save and add in the CMB2 sanitized values.
		add_filter( "sanitize_option_genesis-cpt-archive-settings-{$this->post_type}", array( $this, 'add_sanitized_values' ), 999 );

		// Hook up our Genesis metabox.
		add_action( 'genesis_cpt_archives_settings_metaboxes', array( $this, 'add_meta_box' ) );
	}

	/**
	 * Hook up our Genesis metabox.
	 *
	 * @since 0.2.0
	 */
	public function add_meta_box() {
		$cmb = $this->init_metabox();
		add_meta_box(
			$cmb->cmb_id,
			$cmb->prop( 'title' ),
			array( $this, 'output_metabox' ),
			$this->admin_hook,
			$cmb->prop( 'context' ),
			$cmb->prop( 'priority' )
		);
	}

	/**
	 * Output our Genesis metabox.
	 *
	 * @since 0.2.0
	 */
	public function output_metabox() {
		$cmb = $this->init_metabox();
		$cmb->show_form( $cmb->object_id(), $cmb->object_type() );
	}

	/**
	 * If saving the cpt settings option, add the CMB2 sanitized values.
	 *
	 * @since 0.2.0
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

	/**
	 * Register our Genesis metabox and return the CMB2 object.
	 *
	 * @since 0.2.0
	 *
	 * @return \CMB2 object.
	 */
	public function init_metabox() {

		static $count = 0;
		$count ++;

		$cmb = cmb2_get_metabox( array(
			'id'           => $this->metabox_id . "-{$count}",
			'title'        => __( $this->metabox_title, FJ_UTILITY_TEXT_DOMAIN ),
			'hookup'       => false, // We'll handle ourselves. (add_sanitized_values())
			'cmb_styles'   => false, // We'll handle ourselves. (admin_hooks())
			'context'      => 'main', // Important for Genesis.
			// 'priority'     => 'low', // Defaults to 'high'.
			'object_types' => array( $this->admin_hook ),
			'show_on'      => array(
				// These are important, don't remove.
				'key'   => 'options-page',
				'value' => array( $this->key ),
			),
		), $this->key, 'options-page' );

		foreach ( (array) $this->metabox_fields as $field_args ) {
			// Set our CMB2 fields.
			$cmb->add_field( $field_args );
		}

		return $cmb;
	}
}
