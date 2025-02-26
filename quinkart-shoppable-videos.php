<?php
/*
Plugin Name: QuinKart Shoppable Videos
Plugin URI: https://quinkart.com
Description: A WooCommerce plugin to display shoppable reels with order, wishlist, and share buttons.
Version: 1.0.0
Author: QuinKart Team
Author URI: https://quinkart.com
License: GPL2
Text Domain: quinkart-shoppable-videos
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('QSV_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('QSV_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include core files
require_once QSV_PLUGIN_DIR . 'includes/shortcode.php';

// Activation hook
function qsv_activate_plugin() {
    // Code to run on activation (if needed)
}
register_activation_hook(__FILE__, 'qsv_activate_plugin');

// Deactivation hook
function qsv_deactivate_plugin() {
    // Code to run on deactivation (if needed)
}
register_deactivation_hook(__FILE__, 'qsv_deactivate_plugin');


// Enqueue styles and scripts-- change 2
function qsv_enqueue_assets() {
    wp_enqueue_style('qsv-styles', QSV_PLUGIN_URL . 'assets/css/styles.css');
    wp_enqueue_script('qsv-scripts', QSV_PLUGIN_URL . 'assets/js/scripts.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'qsv_enqueue_assets');

add_action('wp_enqueue_scripts', 'qsv_enqueue_assets');
