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

function createLike($data){
    $professor = sanitize_text_field($data['professorId']);

    wp_insert_post(array(
        'post_type' => 'like',
        'post_status' => 'publish',
        'post_title' => "Test with ID",
        'meta_input' => array(
            //see custom fields
            'liked_professor_id' => $professor,

        )
    ));
}

function deleteLike(){
    return 'Thanks for deleting a like';
}