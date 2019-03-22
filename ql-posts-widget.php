<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bowo.io
 * @since             0.1.0
 * @package           Ql_Posts_Widget
 *
 * @wordpress-plugin
* Plugin Name:       Posts Widget with Thumbnails
 * Plugin URI:        https://github.com/qriouslad/ql-posts-widget
 * Description:       WordPress plugin to add a widget that lists posts with thumbnails.
 * Version:           0.3.0
 * Author:            Bowo
 * Author URI:        https://bowo.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ql-posts-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'QL_POSTS_WIDGET_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ql-posts-widget-activator.php
 */
function activate_ql_posts_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ql-posts-widget-activator.php';
	Ql_Posts_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ql-posts-widget-deactivator.php
 */
function deactivate_ql_posts_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ql-posts-widget-deactivator.php';
	Ql_Posts_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ql_posts_widget' );
register_deactivation_hook( __FILE__, 'deactivate_ql_posts_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ql-posts-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ql_posts_widget() {

	$plugin = new Ql_Posts_Widget();
	$plugin->run();

}
run_ql_posts_widget();
