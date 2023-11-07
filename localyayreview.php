<?php
/*
 * Plugin Name:       Local Yay Review
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Quyet Tran Vu
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    die('We\'re sorry, but you can not directly access this file.');
}

define('LOCAL_REVIEW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('LOCAL_REVIEW_PLUGIN_URL', plugin_dir_url(__FILE__));
define('LOCAL_REVIEW_IS_DEVELOPMENT', true);
if (!wp_installing()) {
    add_action(
        'plugins_loaded',
        function () {
            include LOCAL_REVIEW_PLUGIN_PATH . 'includes/pages/local-review-admin.php';
        }
    );
    add_action('init', function () {
        register_post_type('yayhero');
    });
}