<?php

  get_header();

  while(have_posts()) {
    the_post();
    pageBanner(array(
      'title' => 'Hello',
      'subtitle' => 'this is the subtitle',
      'photo' => "https://www.bestvalueschools.com/wp-content/uploads/2015/06/UC-San-Diego1-1024x786.jpg"

    ));
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
      <?php the_content(); ?>
    </div>
  </div>

  <?php }

  get_footer();

?>