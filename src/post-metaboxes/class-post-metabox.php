<?php
/**
 * Genesis CMB2 Post Metaboxes
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
	protected $metabox_args = [];

	/**
	 * Metabox fields.
	 *
	 * @var array
	 */
	protected $fields = [];

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	public function __construct( array $config ) {
		$this->set_properties( (array) $config );
	}

	/**
	 * Set the class properties.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	protected function set_properties( array $config ) {

		foreach ( $config as $property => $value ) {

			if ( 'fields' === $property ) {
				$this->{$property} = (array) $value;
			} else {
				$this->metabox_args[ $property ] = $value;
			}
		}
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 0.1.0
	 */
	protected function init() {
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

		static $count = 0;
		$count ++;

		if ( empty( $this->metabox_args['id'] ) ) {
			$this->metabox_args['id'] = "fj_utility_metabox-{$count}";
		}

		$cmb = new_cmb2_box( (array) $this->metabox_args );

		foreach ( (array) $this->fields as $field_args ) {

			$field_args['name'] = __( $field_args['name'], FJ_UTILITY_TEXT_DOMAIN );

			// Set our CMB2 fields.
			$cmb->add_field( $field_args );
		}
	}
}
