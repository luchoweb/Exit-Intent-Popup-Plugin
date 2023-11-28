<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Exit Intent Popup
 * Plugin URI:        https://luchoweb.dev
 * Description:       Coding Allstars Wordpress Dev Trial Task 1
 * Version:           1.0.0
 * Author:            Lucho Web
 * Author URI:        https://luchoweb.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       exit-intent-popup
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'EXIT_INTENT_POPUP_VERSION', '1.0.0' );

function activate_exit_intent_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exit-intent-popup-activator.php';
	Exit_Intent_Popup_Activator::activate();
}

function deactivate_exit_intent_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exit-intent-popup-deactivator.php';
	Exit_Intent_Popup_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_exit_intent_popup' );
register_deactivation_hook( __FILE__, 'deactivate_exit_intent_popup' );

require plugin_dir_path( __FILE__ ) . 'includes/class-exit-intent-popup.php';

function run_exit_intent_popup() {

	$plugin = new Exit_Intent_Popup();
	$plugin->run();

}
run_exit_intent_popup();
