<?php get_header();
    pageBanner(array(
        'title' => 'Past Events',
        'subtitle' => 'A recap of our past events!'
    ))
?>

<div class="container container--narrow page-section">
<?php

$today = date('Ymd');
//tell Wordpress what we want to query from the database
$pastEvents = new WP_Query(array(
    //-1 returns all posts that meet conditions
    'paged' => get_query_var('paged', 1),
    'posts_per_page' => 1,
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'compare' => '<',
            'value' => $today
        )
    )
));

// $pastEvents = new WP_Query(array(
//     'post_type' => 'event'
// ));

while($pastEvents->have_posts()){
    $pastEvents->the_post();
    get_template_part('template-parts/content-event');
}
echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
));
?>


</div>



<?php get_footer(); ?>