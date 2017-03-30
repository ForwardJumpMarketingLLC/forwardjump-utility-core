<?php
/**
 * Gravity Forms
 *
 * This file provides custom functionality for Gravity Forms plugin
 *
 * @package      ForwardJump Utility
 * @since        1.0.0
 */

namespace ForwardJump\Utility\Functions\GravityForms;

/**
 * Enforce anti-spam honeypot on all Gravity forms.
 *
 * @param array $form
 *
 * @return array $form
 */
function enforce_honeypots( $form ) {

	$form['enableHoneypot'] = true;

	return $form;
}