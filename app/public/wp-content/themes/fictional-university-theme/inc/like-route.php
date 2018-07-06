<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes(){
    //These are custom APIs that are will be called by the Like.js file when a "heart" is pressed.
    register_rest_route('university/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike',
    ));

    register_rest_route('university/v1', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike',
    ));
}

function createLike(){
    return 'Thanks for trying to create a like';
}

function deleteLike(){
    return 'Thanks for deleting a like';
}