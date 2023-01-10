<?php

/**
 * Plugin Name:       Lunch list
 * Description:       Lunch lists for your site
 * Requires at least: 5.8
 * Requires PHP:      8.1
 */

namespace LunchList;

include plugin_dir_path(__FILE__) . 'includes/post-type.php';
include plugin_dir_path(__FILE__) . 'includes/acf-fields.php';
include plugin_dir_path(__FILE__) . 'LunchList.php';

function register_block()
{
    register_block_type(plugin_dir_path(__FILE__) . 'blocks/todays-lunch/');
    register_block_type(plugin_dir_path(__FILE__) . 'blocks/this-weeks-lunch/');
}
add_action('init', __NAMESPACE__ . '\register_block');

add_filter('lunch_list/set_lunch_days', function ($days) {
    return [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];
});

// Set a default text for a day that has no lunch
add_filter('lunch_list/no_lunch', function () {
    return '<p>No lunch served</p>';
});
