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

add_action( 'plugins_loaded', __NAMESPACE__ . '\apply_enabled_options', 2 );
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

	if ( isset( $fj_options['gf_honeypot'] ) && 'on' === $fj_options['gf_honeypot'] ) {

		add_filter( 'gform_form_post_get_meta', 'ForwardJump\Utility\Functions\GravityForms\enforce_honeypots' );
	}

	if ( isset( $fj_options['gf_hidden_labels'] ) && 'on' === $fj_options['gf_hidden_labels'] ) {

		add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
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
