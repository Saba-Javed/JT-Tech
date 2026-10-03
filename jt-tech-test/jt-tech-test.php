<?php
/**
 * Plugin Name:       JT Tech Test
 * Plugin URI:        https://github.com/Saba-Javed/JT-Tech
 * Description:       Minimal WordPress admin test plugin that registers an admin menu page and enqueues its own admin stylesheet.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Saba-Javed
 * Author URI:        https://github.com/Saba-Javed
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jt-tech-test
 *
 * @package JT_Tech_Test
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'JT_TECH_TEST_VERSION', '1.0.0' );
define( 'JT_TECH_TEST_PLUGIN_FILE', __FILE__ );
define( 'JT_TECH_TEST_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'JT_TECH_TEST_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once JT_TECH_TEST_PLUGIN_DIR . 'includes/class-admin.php';

/**
 * Bootstrap the plugin.
 *
 * Runs on `plugins_loaded` so that translations and other plugins are ready.
 */
function jt_tech_test_init() {
	JT_Tech_Test_Admin::init();
}
add_action( 'plugins_loaded', 'jt_tech_test_init' );

/**
 * Activation callback.
 *
 * Stores the installed plugin version so future updates can detect it.
 */
function jt_tech_test_activate() {
	update_option( 'jt_tech_test_version', JT_TECH_TEST_VERSION );
}
register_activation_hook( __FILE__, 'jt_tech_test_activate' );
