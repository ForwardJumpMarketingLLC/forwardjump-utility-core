<?php
/**
 * CMB2 Post Metaboxes
 *
 * @package     ForwardJump\Utility
 * @author      Tim Jensen <tim@forwardjump.com>
 * @license     GNU General Public License 2.0+
 * @link        https://forwardjump.com
 * @since       0.4.0
 */

namespace ForwardJump\Utility\PostMetaboxes;

/**
 * Class Post_Metabox
 *
 * @version 0.1.0
 *
 * @package ForwardJump\Utility
 */
class Post_Metabox {

	/**
	 * Metabox args.
	 *
	 * @var array
	 */
	protected $metabox_config = [];

	/**
	 * Metabox fields.
	 *
	 * @var array
	 */
	protected $fields_config = [];

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	public function __construct( array $config ) {
		$this->metabox_config = (array) $config['metabox'];
		$this->fields_config  = (array) $config['fields'];

		$this->metabox_config['title'] = isset( $this->metabox_config['title'] ) ? __( $this->metabox_config['title'], FJ_UTILITY_TEXT_DOMAIN ) : '';

		static $count = 0;
		$count ++;

		if ( empty( $this->metabox_config['id'] ) ) {
			$this->metabox_config['id'] = "fj_utility_metabox-{$count}";
		}
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 0.1.0
	 */
	public function init() {
		add_action( 'cmb2_admin_init', [ $this, 'init_metabox' ] );
	}

	/**
	 * Register our post metabox.
	 *
	 * @since  0.1.0
	 *
	 * @return void.
	 */
	public function init_metabox() {
		$cmb = new_cmb2_box( (array) $this->metabox_config );

		foreach ( (array) $this->fields_config as $field_args ) {
			$field_args['name'] = __( $field_args['name'], FJ_UTILITY_TEXT_DOMAIN );

			// Set our CMB2 fields.
			$cmb->add_field( $field_args );
		}
	}
}
