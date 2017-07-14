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
	 * Combined and filtered attribute list.
	 *
	 * @var null
	 */
	protected $atts;

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
	 *
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
		add_filter( 'the_content', [ $this, 'strip_empty_p_and_br_tags' ] );
	}

	/**
	 * Shortcode callback to run when the shortcode is found.
	 *
	 * @param array|null $atts User defined attributes in shortcode tag.
	 *
	 * @return string
	 */
	public function shortcode_callback( $atts, $content = '' ) {

		$this->atts = shortcode_atts( (array) $this->args, (array) $atts, $this->tag );

		$atts = $this->atts;

		$this->enqueue_scripts();

		if ( empty( $this->view ) ) {
			return;
		}

		ob_start();

		include $this->view;

		return ob_get_clean();
	}

	/**
	 * Enqueues the necessary scripts.
	 *
	 * @return void
	 */
	protected function enqueue_scripts() {

		if ( empty( $this->scripts ) ) {
			return;
		}

		$defaults = [
			'handle' => null,
			'src'    => null,
			'deps'   => [ 'jquery' ],
			'ver'    => false,
		];

		foreach ( (array) $this->scripts as $script ) {
			$args = array_merge( $defaults, (array) $script );

			// Check if this script is already enqueued.
			if ( wp_script_is( $args['handle'] ) ) {
				continue;
			}

			wp_enqueue_script( $args['handle'], $args['src'], $args['deps'], $args['ver'], true );

			if ( isset( $script['localize_script'] ) ) {
				$this->localize_scripts( $script );
			}
		}
	}

	/**
	 * Localizes the registered script with data.
	 *
	 * @param array $script Arguments for the script that is being enqueued.
	 */
	protected function localize_scripts( array $script ) {
		$data = empty( $script['localize_script']['data'] ) ? $this->atts : $script['localize_script']['data'];

		if ( ! empty( $script['localize_script']['encode'] ) ) {
			$encoding = $script['localize_script']['encode'];

			foreach ( (array) $data as $key => $item ) {
				$data[ $key ] = call_user_func_array(
					"{$encoding}_encode",
					[ wp_kses( trim( $item ), [] ) ]
				);
			}
		}

		$object_name = str_replace( '-', '_', $script['handle'] . '-data' );

		wp_localize_script( $script['handle'], $object_name, $data );
	}

	/**
	 * Filters the content to remove any extra paragraph or break tags
	 * caused by shortcodes.
	 *
	 * @author Thomas Griffin
	 * @link   https://thomasgriffin.io/remove-empty-paragraph-tags-shortcodes-wordpress/
	 * @since  1.0.0
	 *
	 * @param string $content String of HTML content.
	 *
	 * @return string $content Amended string of HTML content.
	 */
	function strip_empty_p_and_br_tags( $content ) {

		$array = array(
			'<p>['    => '[',
			']</p>'   => ']',
			']<br />' => ']',
		);

		return strtr( $content, $array );
	}
}
