<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.squareonemd.co.uk
 * @since             1.0.0
 * @package           Tismy_User_Profile_Upload
 *
 * @wordpress-plugin
 * Plugin Name:       Tismy User Profile Upload
 * Plugin URI:        http://www.squareonemd.co.uk/
 * Description:       Upload your own user profile picture rather than falling back to the default or having your users create a Gravatar account.
 * Version:           1.0.1
 * Author:            Elliott Richmond Square One
 * Author URI:        http://www.squareonemd.co.uk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tismy-user-profile-upload
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tismy-user-profile-upload-activator.php
 */
function activate_tismy_user_profile_upload() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tismy-user-profile-upload-activator.php';
	Tismy_User_Profile_Upload_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tismy-user-profile-upload-deactivator.php
 */
function deactivate_tismy_user_profile_upload() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tismy-user-profile-upload-deactivator.php';
	Tismy_User_Profile_Upload_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tismy_user_profile_upload' );
register_deactivation_hook( __FILE__, 'deactivate_tismy_user_profile_upload' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tismy-user-profile-upload.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tismy_user_profile_upload() {

	$plugin = new Tismy_User_Profile_Upload();
	$plugin->run();

}
run_tismy_user_profile_upload();
