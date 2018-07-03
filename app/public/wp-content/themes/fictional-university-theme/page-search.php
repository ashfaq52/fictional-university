    <?php

    get_header();

    while(have_posts()) {
    the_post();
    pageBanner();
    ?>




    <div class="container container--narrow page-section">

    <?php
        //gets the ID of the parent post; if there is an ID, means the page is a child page.
        $parentPageID = wp_get_post_parent_id(get_the_id());
        if ($parentPageID) { ?>
        <!-- echo "I am a child page."; -->
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
            <a class="metabox__blog-home-link" href="<?php echo get_permalink($parentPageID); ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
                Back to <?php echo get_the_title($parentPageID); ?>
            </a>
            <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
        <?php }
    ?>


    <?php
        // only fills up the array if page is a child
        $testArray = get_pages(array(
        'child_of' => get_the_ID()
        ));
        // Only display menu if the page has a parent or the page is a parent
        if($parentPageID or $testArray) { ?>
        <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($parentPageID); ?>"><?php echo get_the_title($parentPageID); ?></a></h2>
        <ul class="min-list">
            <?php
            if($parentPageID){
                //returns the ID of the parent page.
                $findChildrenOf = $parentPageID;
            } else {
                //returns the ID of the current page
                $findChildrenOf = get_the_ID();
            }
            wp_list_pages(array(
                'title_li' => NULL,
                'child_of' => $findChildrenOf,
                'sort_column' => 'menu_order',
            ));
            ?>
        </ul>
        </div>
    <?php } ?>

    <div class="generic-content">
        <!-- The action tells the form to add this information to the root of the URL (not 100% understanding) -->
        <!-- "get" ensures that the content of the form ends up in the URL -->
        <form
            class="search-form"
            method="get"
            action="<?php echo esc_url(site_url('/')); ?>">
            <label class="headline headline--medium" for="s">Perform a New Search: </label>
            <div class="search-form-row">
                <input class="s" placeholder="What are you looking for?" id="s" type="search" name="s">
                <input class="search-submit" type="submit" value="Search">
            </div>
        </form>
    </div>
    </div>

    <?php }

    get_footer();

    ?>