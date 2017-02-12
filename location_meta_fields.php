<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://codepixelz.com
 * @since             1.0.0
 * @package           Location_meta_fields
 *
 * @wordpress-plugin
 * Plugin Name:       Location with Meta Fields
 * Plugin URI:        http://codepixelz.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            codepixelz
 * Author URI:        http://codepixelz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       location_meta_fields
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-location_meta_fields-activator.php
 */
function activate_location_meta_fields() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-location_meta_fields-activator.php';
	Location_meta_fields_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-location_meta_fields-deactivator.php
 */
function deactivate_location_meta_fields() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-location_meta_fields-deactivator.php';
	Location_meta_fields_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_location_meta_fields' );
register_deactivation_hook( __FILE__, 'deactivate_location_meta_fields' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-location_meta_fields.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_location_meta_fields() {

	$plugin = new Location_meta_fields();
	$plugin->run();

}
run_location_meta_fields();
