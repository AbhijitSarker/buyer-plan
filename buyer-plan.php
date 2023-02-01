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


//cmb2 path required
require_once PLUGIN_DIR_PATH . 'inc/cmb2/init.php';
require_once PLUGIN_DIR_PATH . 'inc/cmb2/functions.php';

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






// /*
//  * Step 1. Add Link (Tab) to My Account menu
//  */
// add_filter('woocommerce_account_menu_items', 'woo493_add_links_account_page', 40);
// function woo493_add_links_account_page($menu_links)
// {

//     $menu_links = array_slice($menu_links, 0, 3, true)
//         + array('new-bookmarks' => 'bookmark')
//         + array_slice($menu_links, 3, NULL, true);

//     return $menu_links;
// }


// /*
//  * Step 2. Register Permalink Endpoint
//  */
// add_action('init', 'woo493_endpoints');
// function woo493_endpoints()
// {

//     // WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
//     add_rewrite_endpoint('new-bookmarks', EP_PAGES);
// }
