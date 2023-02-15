<?php

/**
 * Plugin Name:       Buyer Plan
 * Plugin URI:        https://github.com/AbhijitSarker
 * Description:       Custom plugin for buyer plans
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Abhijit Sarker
 * Author URI:        https://github.com/AbhijitSarker
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       buyer_plans
 * Domain Path:       /languages
 */


if (!defined('ABSPATH')) {
    die;
}


//Defining the constants
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define("PLUGINS_PATH_ASSETS", plugin_dir_url(__FILE__) . 'assets/');


//cmb2 path required
require_once PLUGIN_DIR_PATH . 'inc/cmb2/init.php';
require_once PLUGIN_DIR_PATH . 'inc/cmb2/functions.php';


add_action('wp_enqueue_scripts', 'buyer_plans_enqueue_files');

function buyer_plans_enqueue_files()
{

    wp_enqueue_style('style', PLUGINS_PATH_ASSETS . 'css/style.css');

    wp_enqueue_script('jqueryscript', PLUGINS_PATH_ASSETS . 'js/jquery.min.js', array('jquery'));
    wp_enqueue_script('script', PLUGINS_PATH_ASSETS . 'js/script.js');
}



function buyer_plans()
{

    $labels = array(
        'name' => _x('Plans', 'plural'),
        'singular_name' => _x('Plans', 'singular'),
        'menu_name' => _x('Plans', 'admin menu'),
        'name_admin_bar' => _x('Plans', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New Plan'),
        'new_item' => __('New Plan'),
        'edit_item' => __('Edit Plan'),
        // 'view_item' => __('View plan'),
        'all_items' => __('All plans'),
        'search_items' => __('Search Plans'),
        'not_found' => __('No Plans found.'),
    );

    $args = array(
        'labels' => $labels,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_menu' => true,
        'show_ui' => true,
        'public' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'plans'),
        'has_archive' => true,
        'hierarchical' => false,
    );

    register_post_type('plans', $args);
}

add_action('init', 'buyer_plans');
/*Custom Post type end*/


//remove text editor from post edit page
add_action('init', function () {
    remove_post_type_support('plans', 'editor');
}, 99);




// create databse table
global $jal_db_version;
$jal_db_version = '1.0';

function jal_install()
{
    global $wpdb;

    $table_name = $wpdb->prefix . "buyer_plan";

    //create or update the table
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        url varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('jal_db_version', $jal_db_version);
}



function jal_install_data()
{
    global $wpdb;

    //Adding Initial Data
    $welcome_name = 'Vighnatha Homes';
    $welcome_text = 'Congratulations, you just completed the installation!';

    $table_name = $wpdb->prefix . 'buyer_plan';

    $wpdb->insert(
        $table_name,
        array(
            'time' => current_time('mysql'),
            'name' => $welcome_name,
            'text' => $welcome_text,
        )
    );
}


//Calling the functions
register_activation_hook(__FILE__, 'jal_install');
register_activation_hook(__FILE__, 'jal_install_data');



// // if (is_user_logged_in()) {
// //     $user = wp_get_current_user();
// //     $roles = (array) $user->roles;
// //     $role = ($roles[0]);
// //     // print_r($role);
// // }

// if ($role == 'houzez_buyer') {
// 
?>
<!-- //     <style>
//         .menu-item-2650 {
//             display: none;
//         }
//     </style> -->
<?php
// }
// if ($role == 'houzez_seller') {
// 
?>
<!-- //     <style>
//         .menu-item-2795 {
//             display: none;
//         }
//     </style> -->
<?php
// }
