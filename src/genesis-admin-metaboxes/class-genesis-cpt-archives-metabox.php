<?php
/**
 * Genesis CPT Archives Metabox class.
 *
 * @package ForwardJump\Utility\GenesisAdminMetaboxes
 * @since   0.3.1
 * @author  Tim Jensen
 * @link    https://forwardjump.com/
 * @license GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\GenesisAdminMetaboxes;

/**
 * CMB2 Genesis CPT Archives Metabox
 *
 * @version 0.1.1
 */
class Genesis_CPT_Archives_Metabox extends Genesis_CMB2_Admin_Metabox {

	/**
	 * Set the class properties.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	protected function set_properties( array $config ) {
		parent::set_properties( $config );

		$this->post_type  = empty( $config['post_type'] ) ? null : $config['post_type'];
		$this->metabox_id = sprintf( 'genesis-cpt-archive-settings-metabox-%s', $this->post_type );
		$this->key        = sprintf( 'genesis-cpt-archive-settings-%s', $this->post_type );
		$this->admin_hook = sprintf( '%1$s_page_genesis-cpt-archive-%1$s', $this->post_type );
		$this->admin_page = 'cpt_archives_settings';
	}
}
