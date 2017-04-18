<?php
/**
 * Genesis Theme Settings Metabox
 *
 * @package ForwardJump\Utility
 * @since   0.3.1
 * @author  Tim Jensen <tim@forwardjump.com>
 * @link    https://forwardjump.com/
 * @license GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\GenesisAdminMetaboxes;

/**
 * Class Genesis_Settings_Metabox
 *
 * @version 0.1.1
 *
 * @package ForwardJump\Utility
 */
class Genesis_Settings_Metabox extends Genesis_CMB2_Admin_Metabox {

	/**
	 * Set the class properties.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	protected function set_properties( array $config ) {
		parent::set_properties( $config );

		$this->metabox_id     = 'fj_utility_genesis_settings';
		$this->key            = 'genesis-settings';
		$this->admin_hook     = 'toplevel_page_genesis';
		$this->admin_page     = 'theme_settings';
	}
}
