<?php
/**
 * Apply Settings
 *
 * @package     ForwardJump\Utility
 * @since       1.0.0
 * @author      Tim Jensen
 * @link        https://www.timjensen.us
 * @license     GNU General Public License 2.0+
 */

namespace ForwardJump\Utility\ApplySettings;

use function ForwardJump\Utility\AdvancedCustomFields\deactivate_acf;

add_action( 'plugins_loaded', __NAMESPACE__ . '\apply_enabled_options', 2 );
/**
 * Checks the plugin options and applies them as required.
 */
function apply_enabled_options() {

	$fj_options = get_option( 'fj_options' );

	if ( isset( $fj_options['header_scripts'] ) ) {

		add_action( 'wp_head', function() use ( $fj_options ) {
			echo $fj_options['header_scripts'];
		} );
	}

	if ( isset( $fj_options['gf_honeypot'] ) && 'on' === $fj_options['gf_honeypot'] ) {

		add_filter( 'gform_form_post_get_meta', 'ForwardJump\Utility\GravityForms\enforce_honeypots' );
	}

	if ( isset( $fj_options['gf_hidden_labels'] ) && 'on' === $fj_options['gf_hidden_labels'] ) {

		add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
	}
}
