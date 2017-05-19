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
	 * Arguments for enqueuing the script. Each script must be in its own array.
	 *
	 * @var null
	 */
	protected $scripts = [];

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
	}

	/**
	 * Adds the shortcode.
	 *
	 * @return void
	 */
	public function init() {
		add_shortcode( $this->tag, [ $this, 'shortcode_callback' ] );
	}

	/**
	 * Shortcode callback to run when the shortcode is found.
	 *
	 * @param array|null $atts User defined attributes in shortcode tag.
	 * @return string
	 */
	public function shortcode_callback( $atts ) {

		$this->enqueue_scripts();

		$atts = shortcode_atts( (array) $this->args, (array) $atts, $this->tag );

		ob_start();

		include $this->view;

		return ob_get_clean();
	}

	/**
	 * Enqueues the necessary scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		if ( empty( $this->scripts ) ) {
			return;
		}

		$defaults = [
			'handle'    => null,
			'src'       => null,
			'deps'      => [ 'jquery' ],
			'ver'       => false,
		];

		foreach ( (array) $this->scripts as $script ) {
			$args = array_merge( $defaults, (array) $script );

			// Check if this script is already enqueued.
			if ( wp_script_is( $args['handle'] ) ) {
				continue;
			}

			wp_enqueue_script( $args['handle'], $args['src'], $args['deps'], $args['ver'], true );
		}
	}
}
