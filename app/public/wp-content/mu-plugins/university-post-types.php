<?php

function university_post_types() {

    //EVENT POST TYPE
    register_post_type('event', array(
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array(
            'slug' => 'events',
        ),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-calendar', //google "wordpress dashicons" to get list of wordpress admin icons
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event',
        )
    ));

    //PROGRAM POST TYPE
    register_post_type('program', array(
        'supports' => array('title', 'editor'),
        'rewrite' => array(
            'slug' => 'programs',
        ),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-awards', //google "wordpress dashicons" to get list of wordpress admin icons
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program',
        )
    ));

    //PROFESSOR POST TYPE
    //tip: Command + D performs the same function and find and replace
    register_post_type('professor', array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array(
            'slug' => 'professors',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-welcome-learn-more', //google "wordpress dashicons" to get list of wordpress admin icons
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor',
        )
    ));
}

add_action('init', 'university_post_types');