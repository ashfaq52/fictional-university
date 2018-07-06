<?php

    get_header();

    while(have_posts()) {
        the_post();
        pageBanner();
        ?>



    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('professor'); ?>">
            <i class="fa fa-home" aria-hidden="true"></i>
            Professors Home
            </a>
        <span class="metabox__main"><?php the_title();?></span>
        </p>
        </div>

        <div class="generic-content">
            <div class="row group">

                <div class="one-third">
                    <?php the_post_thumbnail('professorPortrait'); ?>
                </div>

                <div class="two-thirds">
                    <?php

                    $likeCount = new WP_Query(array(
                        'post_type' => 'like',
                        'meta_query' => array(
                            array(
                                'key' => 'liked_professor_id',
                                'compare' => '=',
                                'value' => get_the_ID(),
                            )
                        )
                    ));

                    $existStatus = "no";

                    $existQuery = new WP_Query(array(
                        'author' => get_current_user_id(),
                        'post_type' => 'like',
                        'meta_query' => array(
                            array(
                                'key' => 'liked_professor_id',
                                'compare' => '=',
                                'value' => get_the_ID(),
                            )
                        )
                    ));

                    if ($existQuery->found_posts){
                        $existStatus = 'yes';
                    }

                    ?>
                    <span class="like-box" data-exists="<?php echo $existStatus; ?>">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
                    </span>
                    <?php the_content(); ?>
                </div>

            </div>
        <?php  ?>

        </div>

        <?php

            //we are getting Wordpress post objects
            $relatedPrograms = get_field('related_programs');

            if($relatedPrograms){
                echo '<hr class="section-break">';
                echo '<h4 class="headline headline--medium">Subject(s) Taught</h4>';
                echo '<ul class="link-list min-list">';
                foreach($relatedPrograms as $program) { ?>

                    <li>
                        <a href="<?php echo get_the_permalink($program) ?>">
                            <?php echo get_the_title($program); ?>
                        </a>
                    </li>
                <?php }
                echo '</ul>';
            }
        ?>

    </div>


    <?php }

    get_footer();

?>