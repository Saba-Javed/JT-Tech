<?php
/**
 * Admin functionality for the JT Tech Test plugin.
 *
 * @package JT_Tech_Test
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles everything that happens in wp-admin for this plugin.
 */
class JT_Tech_Test_Admin {

	/**
	 * Hook suffix of the plugin's admin page.
	 *
	 * Used to only enqueue assets on our own screen.
	 *
	 * @var string
	 */
	protected static $hook_suffix = '';

	/**
	 * Hook the plugin into WordPress.
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'register_menu' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Register the plugin admin menu page.
	 */
	public static function register_menu() {
		self::$hook_suffix = add_menu_page(
			__( 'JT Tech Test', 'jt-tech-test' ),
			__( 'JT Tech Test', 'jt-tech-test' ),
			'manage_options',
			'jt-tech-test',
			array( __CLASS__, 'render_page' ),
			'dashicons-admin-generic',
			80
		);
	}

	/**
	 * Enqueue the admin stylesheet, but only on the plugin's own screen.
	 *
	 * @param string $hook_suffix The current admin page hook suffix.
	 */
	public static function enqueue_assets( $hook_suffix ) {
		if ( '' === self::$hook_suffix || self::$hook_suffix !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style(
			'jt-tech-test-admin',
			JT_TECH_TEST_PLUGIN_URL . 'assets/admin.css',
			array(),
			JT_TECH_TEST_VERSION
		);
	}

	/**
	 * Render the plugin admin page.
	 */
	public static function render_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'jt-tech-test' ) );
		}
		?>
		<div class="wrap jt-tech-test-wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<p><?php esc_html_e( 'The JT Tech Test plugin is active and working correctly.', 'jt-tech-test' ); ?></p>

			<div class="jt-tech-test-card">
				<h2><?php esc_html_e( 'Plugin details', 'jt-tech-test' ); ?></h2>
				<ul>
					<li>
						<strong><?php esc_html_e( 'Version:', 'jt-tech-test' ); ?></strong>
						<?php echo esc_html( JT_TECH_TEST_VERSION ); ?>
					</li>
					<li>
						<strong><?php esc_html_e( 'Plugin file:', 'jt-tech-test' ); ?></strong>
						<?php echo esc_html( plugin_basename( JT_TECH_TEST_PLUGIN_FILE ) ); ?>
					</li>
				</ul>
			</div>
		</div>
		<?php
	}
}
