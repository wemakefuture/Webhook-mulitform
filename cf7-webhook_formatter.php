<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://juvo-design.de
 * @since             1.0.0
 * @package           CF7_Webhook_Formatter
 *
 * @wordpress-plugin
 * Plugin Name:       CF7 Webhook Formatter
 * Plugin URI:        https://www.wemakefuture.com/
 * Description:       Simple plugin to format the webhook body as needed.
 * Version:           1.0.0
 * Author:            Justin Vogt
 * Author URI:        https://www.wemakefuture.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cf7-webhook-formatter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
use CF7_Webhook_Formatter\Activator;
use CF7_Webhook_Formatter\Deactivator;
use CF7_Webhook_Formatter\CF7_Webhook_Formatter;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin absolute path
 */
define( 'CF7_WEBHOOK_FORMATTER_PATH', plugin_dir_path( __FILE__ ) );
define( 'CF7_WEBHOOK_FORMATTER_URL', plugin_dir_url( __FILE__ ) );

/**
 * Use Composer PSR-4 Autoloading
 */
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 */
function activate_cf7_webhook_formatter() {
    Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_cf7_webhook_formatter() {
    Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cf7_webhook_formatter' );
register_deactivation_hook( __FILE__, 'deactivate_cf7_webhook_formatter' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cf7_webhook_formatter() {

	$plugin = new CF7_Webhook_Formatter();
	$plugin->run();

}
run_cf7_webhook_formatter();
