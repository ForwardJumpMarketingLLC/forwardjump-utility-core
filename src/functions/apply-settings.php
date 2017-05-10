<?php
/**
 * Apply Settings
 *
 * @package     ForwardJump\Utility
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://forwardjump.com/
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\Functions\ApplySettings;

use ForwardJump\Utility\PostMetaboxes\Post_Metabox;

add_action( 'plugins_loaded', __NAMESPACE__ . '\apply_enabled_options', 12 );
/**
 * Checks the plugin options and applies them as required.
 */
function apply_enabled_options() {

	$fj_options = get_option( 'fj_options' );

	if ( isset( $fj_options['header_scripts'] ) ) {

		add_action( 'wp_head', function () use ( $fj_options ) {
			echo $fj_options['header_scripts'];
		} );
	}

	if ( isset( $fj_options['footer_scripts'] ) ) {

		add_action( 'wp_footer', function () use ( $fj_options ) {
			echo $fj_options['footer_scripts'];
		} );
	}

	if ( isset( $fj_options['gf_honeypot'] ) && filter_var( $fj_options['gf_honeypot'], FILTER_VALIDATE_BOOLEAN ) ) {

		add_filter( 'gform_form_post_get_meta', 'ForwardJump\Utility\Functions\GravityForms\enforce_honeypots' );
	}

	if ( isset( $fj_options['gf_hidden_labels'] ) && filter_var( $fj_options['gf_hidden_labels'], FILTER_VALIDATE_BOOLEAN ) ) {

		add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
	}

	if ( isset( $fj_options['fj_allow_hide_on_404'] ) && filter_var( $fj_options['fj_allow_hide_on_404'], FILTER_VALIDATE_BOOLEAN ) ) {

		add_filter( 'wp_list_pages_excludes', __NAMESPACE__ . '\\exclude_pages_from_wp_list_pages' );
		add_action( 'genesis_meta', __NAMESPACE__ . '\\add_noindex_meta_tags' );

		if ( is_admin() ) {
			new Post_Metabox( include FJ_UTILITY_DIR . '/src/post-metaboxes/config/exclude-from-wp-list-pages.php' );
		}
	}
}

/**
 * Show an error message to remind admins to make production sites public to search engines,
 * and staging sites hidden from search engines.
 *
 * @since 0.4.2
 *
 * @return void
 */
add_action( 'admin_notices', function () {

	$is_blog_public = get_option( 'blog_public' );
	$is_dev_site = preg_match( '/(dev|staging|localhost)/i', home_url() );
	$options_reading_url = get_admin_url( null, 'options-reading.php' );

	if ( ! $is_blog_public && ! $is_dev_site ) {
		?>
		<div class="notice error">
			<p>Search engines are discouraged. If this is a production site, make sure to change the search engine visibility under <a href="<?php echo esc_url( $options_reading_url ); ?>">Reading Settings</a>.</p>
		</div>
		<?php
	} elseif ( $is_blog_public && $is_dev_site ) {
		?>
		<div class="notice error">
			<p>Search engines are encouraged. If this is a staging site, make sure to discourage search engine visibility under <a href="<?php echo esc_url( $options_reading_url ); ?>">Reading Settings</a>.</p>
		</div>
		<?php
	}
} );

/**
 * Adds noindex meta tags to pages that have been designated to hide on 404 pages.
 *
 * @return void
 */
function add_noindex_meta_tags() {

	if ( ! is_page() ) {
		return;
	}

	$add_noindex = get_post_meta( get_the_ID(), 'fj_hide_on_404', true );

	if ( ! filter_var( $add_noindex, FILTER_VALIDATE_BOOLEAN ) ) {
		return;
	}

	add_action( 'wp_head', 'wp_no_robots', 1 );
}

/**
 * Excludes selected pages from being listed using `wp_list_pages()`.
 *
 * @param array $exclude_array Page IDs to exclude from `wp_list_pages()`.
 * @return array
 */
function exclude_pages_from_wp_list_pages( $exclude_array ) {

	$exclude_pages = new \WP_Query( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'nopaging'    => true,
		'meta_query'  => array(
			array(
				'key'     => 'fj_hide_on_404',
				'value'   => array( 'on' ),
				'compare' => 'IN',
			),
		),
		'fields' => 'ids',
	) );

	wp_reset_postdata();

	return array_merge( (array) $exclude_array, (array) $exclude_pages->posts );
}
