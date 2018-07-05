<?php

function university_post_types() {

    //EVENT POST TYPE
    register_post_type('campus', array(
        'capability_type' => 'campus',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array(
            'slug' => 'campuses',
        ),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-location-alt', //google "wordpress dashicons" to get list of wordpress admin icons
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus',
        )
    ));

    //EVENT POST TYPE
    register_post_type('event', array(
        'capability_type' => 'event',
        'map_meta_cap' => true,
        // two above properties are used for user role management in Lecture 72
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
        'supports' => array('title'),
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
        'show_in_rest' => true,
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

    //NOTE POST TYPE
    register_post_type('note', array(
        //this gives non-admin users the ability to create notes
        'capability_type' => 'note',
        'map_meta_cap' => true,
        //so that we can work with the custom post type from the REST API.
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'public' => false,
        //show in the Admin dashboard
        'show_ui' => true,
        'menu_icon' => 'dashicons-welcome-write-blog', //google "wordpress dashicons" to get list of wordpress admin icons
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note',
        )
    ));
}

add_action('init', 'university_post_types');
