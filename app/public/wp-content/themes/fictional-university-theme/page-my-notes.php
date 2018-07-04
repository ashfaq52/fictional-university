    <?php

    /*if someone manually types in my-notes into the url when he/she is not logged in
    he/she will be redirected to the homepage.
    */
    if (!is_user_logged_in()) {
        wp_redirect(esc_url(site_urL('/')));
        exit;
    }

    get_header();

    while(have_posts()) {
        the_post();
        pageBanner();
        ?>




    <div class="container container--narrow page-section">
        <ul class="min-list link-list" id="my-notes">
            <?php
                $userNotes = new WP_Query(array(
                    'post-type' => 'note',
                    'posts-per-page' => -1,
                    'author' => get_current_user_id(),
                ));

                while($userNotes->have_posts()) {
                    $userNotes->the_post(); ?>
                    <li>
                        <!-- Whenever you're using information from the database as the value for an HTML element
                        you want to wrap it in esc_attr (for security reasons);
                        -->
                        <input class="note-title-field" value="<?php echo esc_attr(get_the_title()); ?>">
                        <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
                        <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
                        <textarea class="note-body-field"> <?php echo esc_attr(get_the_content()); ?>
                        </textarea>
                    </li>
                    <?php
                }
            ?>
        </ul>
    </div>

    <?php }

    get_footer();

    ?>