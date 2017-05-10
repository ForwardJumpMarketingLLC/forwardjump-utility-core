<?php
/**
 * Add Shortcode Class.
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

	/**
	 * Shortcode tag.
	 *
	 * @var null
	 */
	protected $tag;

	/**
	 * Entire list of supported shortcode attributes and their defaults.
	 *
	 * @var null
	 */
	protected $args;

	/**
	 * Path to the view file used for rendering the data.
	 *
	 * @var null
	 */
	protected $view;

	/**
	 * Arguments for enqueuing the script.
	 *
	 * @var null
	 */
	protected $scripts;

	/**
	 * Add_Shortcode constructor.
	 *
	 * @param $config
	 * @return void
	 */
	public function __construct( $config ) {
		$this->tag     = empty( $config['tag'] ) ? null : $config['tag'];
		$this->args    = empty( $config['args'] ) ? null : $config['args'];
		$this->view    = empty( $config['view'] ) ? null : $config['view'];
		$this->scripts = empty( $config['scripts'] ) ? null : $config['scripts'];

		$this->add_shortcode();
	}

	/**
	 * Adds the shortcode.
	 *
	 * @return void
	 */
	protected function add_shortcode() {
		add_shortcode( $this->tag, [ $this, 'shortcode_callback' ] );
	}

	/**
	 * Shortcode callback to run when the shortcode is found.
	 *
	 * @param array|null $atts User defined attributes in shortcode tag.
	 * @return string
	 */
	public function shortcode_callback( $atts ) {

		if ( $this->scripts ) {
			$this->enqueue_scripts( $this->scripts );
		}

		$atts = shortcode_atts( $this->args, (array) $atts, $this->tag );

		ob_start();

		include $this->view;

		return ob_get_clean();
	}

	/**
	 * Enqueues the necessary scripts.
	 *
	 * @param array $scripts Arguments for enqueuing the script. Each script
	 *                       must be in its own array.
	 * @return void
	 */
	protected function enqueue_scripts( array $scripts ) {

		$defaults = [
			'handle'    => null,
			'src'       => null,
			'deps'      => [ 'jquery' ],
			'ver'       => false,
			'in_footer' => true,
		];

		foreach ( (array) $scripts as $script ) {
			$args = array_merge( $defaults, (array) $script );

			wp_enqueue_script( $args['handle'], $args['src'], $args['deps'], $args['ver'], $args['in_footer'] );
		}
	}
}
