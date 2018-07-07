<?php

add_action('rest_api_init', 'universityLikeRoutes');

//CREATING CUSTOM API ENDPOINTS

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
    if (is_user_logged_in()) {
        $professor = sanitize_text_field($data['professorId']);

        $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' =>  $professor,
                )
            )
        ));

        //if like does not already exist from user
        if ($existQuery->found_posts == 0 AND get_post_type($professor) == 'professor') {
            //create new professor like post
            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => "Test with ID",
                'meta_input' => array(
                    //see custom fields
                    'liked_professor_id' => $professor,
                )
            ));
        } else {
            die("Invalid professor id");
        }


    } else {
        die("Only logged in users can create a like.");
    }



}

function console_log($data){
    echo '<script>';
    echo 'console.log('. json_encode($data) . ')';
    echo '</script>';
}

function deleteLike($data){
    // console.log('delete');
    $likeId = sanitize_text_field($data['like']);
    //user can only delete like if it is theirs.
    console_log($likeId);
    if (get_current_user_id() == get_post_field('post_author', $likeId) AND get_post_type($likeId) == 'like'){
        wp_delete_post($likeId, true);
        return 'Congrats you MOFO!!!! Like deleted!!';
    } else {
        //cancel the current request
        die("You do not have permission to delete that." . $likeId);
    }
}