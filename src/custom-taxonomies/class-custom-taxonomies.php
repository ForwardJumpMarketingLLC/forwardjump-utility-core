<?php
/**
 * Custom Taxonomies Handler
 *
 * @package     ForwardJump\Utility
 * @since       0.1.2
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\CustomTaxonomies;

/**
 * Class Custom_Taxonomies
 *
 * @since 0.1.2
 *
 * @package ForwardJump\Utility\CustomTaxonomies
 */
class Custom_Taxonomies {

	/**
	 * Taxonomy configuration array.
	 *
	 * @since 0.1.2
	 *
	 * @var array
	 */
	private $config = [];

	/**
	 * Taxonomy key, must not exceed 32 characters.
	 *
	 * @since 0.1.2
	 *
	 * @var string
	 */
	private $taxonomy = '';

	/**
	 * Array of object types with which the taxonomy should be associated.
	 *
	 * @since 0.1.2
	 *
	 * @var bool|mixed|string
	 */
	private $object_type = [];

	/**
	 * Array of arguments for registering a taxonomy.
	 *
	 * @since 0.1.2
	 *
	 * @var array
	 */
	private $args = [];

	/**
	 * Custom_Taxonomies constructor.
	 *
	 * @param array $config
	 *
	 * @since 0.1.2
	 */
	public function __construct( array $config ) {
		$this->config      = $config;
		$this->taxonomy    = empty( $this->config['taxonomy'] ) ? false : $this->config['taxonomy'];
		$this->object_type = empty( $this->config['object_type'] ) ? false : $this->config['object_type'];
		$this->args        = empty( $this->config['args'] ) ? null : (array) $this->config['args'];
		$this->init();
	}

	/**
	 * Hooks into the lifecycle to register the taxonomy.
	 *
	 * @since 0.1.2
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'init', [ $this, 'register_custom_taxonomy' ] );
	}

	/**
	 * Register the custom post type.
	 *
	 * @since 0.1.2
	 *
	 * @return void
	 */
	public function register_custom_taxonomy() {

		$singular_label = empty( $this->config['args']['labels']['singular'] ) ? $this->taxonomy : (string) $this->config['args']['labels']['singular'];
		$plural_label   = empty( $this->config['args']['labels']['plural'] ) ? $this->taxonomy : (string) $this->config['args']['labels']['plural'];

		$this->args['labels'] = $this->get_taxonomy_labels( $singular_label, $plural_label );

		register_taxonomy( $this->taxonomy, $this->object_type, $this->args );
	}

	/**
	 * Get the post type labels.
	 *
	 * @since 0.1.2
	 *
	 * @param string $singular_label Singular label for the Custom Post Type.
	 * @param string $plural_label   Plural label for the Custom Post Type.
	 *
	 * @return array
	 */
	protected function get_taxonomy_labels( $singular_label, $plural_label ) {

		return [
			'name'                  => _x( $plural_label, 'taxonomy general name', FJ_UTILITY_TEXT_DOMAIN ),
			'singular_name'         => _x( $singular_label, 'taxonomy singular name', FJ_UTILITY_TEXT_DOMAIN ),
			'search_items'          => __( 'Search ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'popular_items'         => __( 'Popular ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'all_items'             => __( 'All ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'parent_item'           => __( 'Parent ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent ' . $singular_label . ':', FJ_UTILITY_TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'view_item'             => __( 'View ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'update_item'           => __( 'Update ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New ' . $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'new_item_name'         => __( 'New ' . $singular_label . ' Name', FJ_UTILITY_TEXT_DOMAIN ),
			'not_found'             => __( 'No ' . $plural_label . ' found.', FJ_UTILITY_TEXT_DOMAIN ),
			'no_terms'              => __( 'No ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'items_list_navigation' => __( $plural_label . ' list navigation', FJ_UTILITY_TEXT_DOMAIN ),
			'items_list'            => __( $plural_label . ' list', FJ_UTILITY_TEXT_DOMAIN ),
			'menu_name'             => __( $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
			'name_admin_bar'        => __( $singular_label, FJ_UTILITY_TEXT_DOMAIN ),
			'archives'              => __( 'All ' . $plural_label, FJ_UTILITY_TEXT_DOMAIN ),
		];
	}
}