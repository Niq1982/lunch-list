<?php

/**
 * Register post type
 */
add_action('init', function () {
    $labels = array(
        'name'                  => _x('Lounaslistat', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Lounaslista', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Lounaslistat', 'text_domain'),
        'name_admin_bar'        => __('Lounaslista', 'text_domain'),
        'archives'              => __('Lounaslista-arkisto', 'text_domain'),
        'attributes'            => __('Lounaslistan ominaisuudet', 'text_domain'),
        'all_items'             => __('Kaikki lounaslistat', 'text_domain'),
        'add_new_item'          => __('Lisää uusi lounaslista', 'text_domain'),
        'add_new'               => __('Lisää uusi', 'text_domain'),
        'new_item'              => __('Uusi lounaslista', 'text_domain'),
        'edit_item'             => __('Muokkaa lounaslistaa', 'text_domain'),
        'update_item'           => __('Päivitä lounaslista', 'text_domain'),
        'view_item'             => __('Näytä lounaslista', 'text_domain'),
        'view_items'            => __('Näytä lounaslistat', 'text_domain'),
        'search_items'          => __('Etsi lounaslistaa', 'text_domain'),
        'not_found'             => __('Ei löytynyt', 'text_domain'),
        'not_found_in_trash'    => __('Ei löytynyt roskakorista', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Lounaslista', 'text_domain'),
        'description'           => __('Lounaslistat', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-food',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'rewrite'               => false,
        'capability_type'       => 'page',
    );
    register_post_type('lunch_list', $args);
});
