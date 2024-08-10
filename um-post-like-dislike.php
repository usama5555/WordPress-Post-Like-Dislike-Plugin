<?php
/*
 * Plugin Name:       UM Post Like & Dislike
 * Plugin URI:        https://wordpress.org/
 * Description:       Post like and dislike
 * Version:           1.0.0
 * Author:            Usama Maqsood
 * Author URI:        https://wordpress.org/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       umlike
 */

if (!defined('WPINC')) {
    die;
}

if (!defined('UMP_PLUGIN_VERSION')) {
    define('UMP_PLUGIN_VERSION', '1.0.0');
}

if (!defined('UMP_PLUGIN_DIR')) {
    define('UMP_PLUGIN_DIR', plugin_dir_url(__FILE__));
}

if (!function_exists('ump_plugin_scripts')) {
    function ump_plugin_scripts() {
        wp_enqueue_style('ump-css', UMP_PLUGIN_DIR . 'assets/css/style.css');
        wp_enqueue_script('ump-js', UMP_PLUGIN_DIR . 'assets/js/main.js');
        wp_enqueue_script('ump-ajax', UMP_PLUGIN_DIR . 'assets/js/ajax.js');
        wp_localize_script('ump-ajax', 'ump_ajax_url', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
    add_action('wp_enqueue_scripts', 'ump_plugin_scripts');
}

// Setting menu & page
require plugin_dir_path(__FILE__) . '/inc/settings.php';

// Create table for our plugin
require plugin_dir_path(__FILE__) . '/inc/db.php';

// Create Like and Dislike button using filter
require plugin_dir_path(__FILE__) . '/inc/btns.php';

// Plugin Like Btn Ajax Function

function ump_like_btn_ajax_action() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $table_name = $wpdb->prefix . "ump_like_system"; 

    if (isset($_POST['pid']) && isset($_POST['uid'])) {
        $user_id = intval($_POST['uid']);
        $post_id = intval($_POST['pid']);

        // Check if the record exists
        $record_exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE user_id = %d AND post_id = %d", $user_id, $post_id));

        if ($record_exists) {
            // Update existing record
            $wpdb->update(
                $table_name,
                array(
                    'like_count' => 1,
                    'dislike_count' => 0
                ),
                array(
                    'user_id' => $user_id,
                    'post_id' => $post_id
                ),
                array(
                    '%d',
                    '%d'
                ),
                array(
                    '%d',
                    '%d'
                )
            );
        } else {
            // Insert new record
            $wpdb->insert(
                $table_name,
                array(
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                    'like_count' => 1,
                    'dislike_count' => 0
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d'
                )
            );
        }
        
        // Return updated like and dislike counts
        $like_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND like_count = 1", $post_id));
        $dislike_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND dislike_count = 1", $post_id));

        echo json_encode(array('like_count' => $like_count, 'dislike_count' => $dislike_count));
    }

    wp_die();
}
add_action('wp_ajax_ump_like_btn_ajax_action', 'ump_like_btn_ajax_action');
add_action('wp_ajax_nopriv_ump_like_btn_ajax_action', 'ump_like_btn_ajax_action');




// Plugin Dislike Btn Ajax Function
function ump_dislike_btn_ajax_action() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $table_name = $wpdb->prefix . "ump_like_system"; 

    if (isset($_POST['pid']) && isset($_POST['uid'])) {
        $user_id = intval($_POST['uid']);
        $post_id = intval($_POST['pid']);

        // Check if the record exists
        $record_exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE user_id = %d AND post_id = %d", $user_id, $post_id));

        if ($record_exists) {
            // Update existing record
            $wpdb->update(
                $table_name,
                array(
                    'like_count' => 0,
                    'dislike_count' => 1
                ),
                array(
                    'user_id' => $user_id,
                    'post_id' => $post_id
                ),
                array(
                    '%d',
                    '%d'
                ),
                array(
                    '%d',
                    '%d'
                )
            );
        } else {
            // Insert new record
            $wpdb->insert(
                $table_name,
                array(
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                    'like_count' => 0,
                    'dislike_count' => 1
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d'
                )
            );
        }
        
         // Return updated like and dislike counts
         $like_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND like_count = 1", $post_id));
         $dislike_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_id = %d AND dislike_count = 1", $post_id));
 
         echo json_encode(array('like_count' => $like_count, 'dislike_count' => $dislike_count));
    }

    wp_die();
}
add_action('wp_ajax_ump_dislike_btn_ajax_action', 'ump_dislike_btn_ajax_action');
add_action('wp_ajax_nopriv_ump_dislike_btn_ajax_action', 'ump_dislike_btn_ajax_action');



