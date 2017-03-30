<?php
/**
 * Custom Post Types Handler
 *
 * @package     ForwardJump\Utility
 * @since       0.1.1
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\CustomPostTypes;

/**
 * Class Custom_Post_Types
 *
 * @since   0.1.1
 *
 * @package ForwardJump\Utility\CustomPostTypes
 */
class Custom_Post_Types {

	/**
	 * CPT configuration array.
	 *
	 * @since 0.1.1
	 *
	 * @var array
	 */
	private $config = [];

	/**
	 * Post type key. Must not exceed 20 characters and may
	 * only contain lowercase alphanumeric characters, dashes,
	 * and underscores.
	 *
	 * @since 0.1.1
	 *
	 * @var array
	 */
	private $post_type = '';

	/**
	 * Array of arguments for registering a post type.
	 *
	 * @since 0.1.1
	 *
	 * @var array
	 */
	private $args = '';

	/**
	 * Custom_Post_Types constructor.
	 *
	 * @since 0.1.1
	 *
	 * @param array $config
	 */
	public function __construct( array $config ) {
		$this->config    = $config;
		$this->post_type = empty( $this->config['post_type'] ) ? false : $this->config['post_type'];
		$this->args      = empty( $this->config['args'] ) ? null : (array) $this->config['args'];
		$this->init();
	}

	/**
	 * Hook into the WordPress lifecycle to register the CPT.
	 *
	 * @since 0.1.1
	 */
	protected function init() {
		add_action( 'init', [ $this, 'register_custom_post_type' ] );
	}

	/**
	 * Register the custom post type.
	 *
	 * @since 0.1.1
	 *
	 * @return void
	 */
	public function register_custom_post_type() {

		$singular_label = empty( $this->config['args']['labels']['singular'] ) ? $this->post_type : (string) $this->config['args']['labels']['singular'];
		$plural_label   = empty( $this->config['args']['labels']['plural'] ) ? $this->post_type : (string) $this->config['args']['labels']['plural'];

		$this->args['labels'] = $this->get_post_type_labels( $singular_label, $plural_label );

		register_post_type( $this->post_type, $this->args );
	}

	/**
	 * Get the post type labels.
	 *
	 * @since 0.1.1
	 *
	 * @param string $singular_label Singular label for the Custom Post Type.
	 * @param string $plural_label   Plural label for the Custom Post Type.
	 *
	 * @return array
	 */
	protected function get_post_type_labels( $singular_label, $plural_label ) {

		return [
			'name'                  => _x( $plural_label, 'post type general name', FJ_UTILITY_TEXT_DOMAIN ),
			'singular_name'         => _x( $singular_label, 'post type singular name', FJ_UTILITY_TEXT_DOMAIN ),
			'add_new'               => _x( 'Add New', $this->post_type, FJ_UTILITY_TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'new_item'              => __( 'New ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'view_item'             => __( 'View ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'view_items'            => __( 'View ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'search_items'          => __( 'Search ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'not_found'             => __( 'No ' . $plural_label . ' found.', FJ_UTILITY_TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'No ' . $plural_label . ' found in Trash.', FJ_UTILITY_TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent ' . $singular_label . ':', FJ_UTILITY_TEXT_DOMAIN ),
			'all_items'             => __( 'All ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'archives'              => __( 'All ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'attributes'            => __( $singular_label . ' Attributes', FJ_UTILITY_TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'featured_image'        => 'Featured Image',
			'set_featured_image'    => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image'    => 'Use as featured image',
			'filter_items_list'     => __( 'Filter ' . $plural_label . ' list', FJ_UTILITY_TEXT_DOMAIN ),
			'items_list_navigation' => __( $plural_label . ' list navigation', FJ_UTILITY_TEXT_DOMAIN ),
			'items_list'            => __( $plural_label . ' list', FJ_UTILITY_TEXT_DOMAIN ),
			'menu_name'             => __( $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'name_admin_bar'        => _x( $singular_label, 'add new on admin bar', FJ_UTILITY_TEXT_DOMAIN ),
		];
	}
}