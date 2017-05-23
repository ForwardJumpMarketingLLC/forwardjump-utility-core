<?php
/**
 * CMB2 Term Metaboxes
 *
 * @package     ForwardJump\Utility
 * @author      Tim Jensen <tim@forwardjump.com>
 * @license     GNU General Public License 2.0+
 * @link        https://forwardjump.com
 * @since       1.1.0
 */

namespace ForwardJump\Utility\TermMetaboxes;

use ForwardJump\Utility\PostMetaboxes\Post_Metabox;

/**
 * Class Term_Metabox
 *
 * @version 0.1.0
 *
 * @package ForwardJump\Utility
 */
class Term_Metabox extends Post_Metabox {

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	public function __construct( array $config ) {
		parent::__construct( $config );

		$this->metabox_config['object_types'] = [ 'term' ];
	}
}
