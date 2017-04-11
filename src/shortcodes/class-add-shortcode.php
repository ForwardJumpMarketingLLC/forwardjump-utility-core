<?php
/**
 * Title
 *
 * @package     ForwardJump\Utility\Shortcodes
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @link        https://www.timjensen.us
 * @since       0.2.0
 */

namespace ForwardJump\Utility\Shortcodes;

/**
 * Class Add_Shortcode
 *
 * @package ForwardJump\Utility\Shortcodes
 */
class Add_Shortcode {

	protected $slug;

	protected $args;

	protected $view;

	protected $scripts;

	public function __construct( $config ) {
		$this->slug    = empty( $config['slug'] ) ? null : $config['slug'];
		$this->args    = empty( $config['args'] ) ? null : $config['args'];
		$this->view    = empty( $config['view'] ) ? null : $config['view'];
		$this->scripts = empty( $config['scripts'] ) ? null : $config['scripts'];

		$this->add_shortcode();
	}

	protected function add_shortcode() {
		add_shortcode( $this->slug, [ $this, 'shortcode_callback' ] );
	}

	public function shortcode_callback( $atts ) {

		$atts = array_merge( $this->args, (array) $atts );

		ob_start();

		include $this->view;

		return ob_get_clean();
	}

	public static function enqueue_scripts( array $scripts ) {

		$defaults = [
			'handle'    => 'fj-utility-script-module',
			'src'       => '',
			'deps'      => [ 'jquery' ],
			'ver'       => false,
			'in_footer' => true,
		];

		$args = array_merge( $defaults, (array) $scripts );

		wp_enqueue_script( $args['handle'], $args['src'], $args['deps'], $args['ver'], $args['in_footer'] );
	}
}
