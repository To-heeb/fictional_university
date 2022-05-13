<?php
get_header();
while (have_posts()) {

    the_post();
    pageBanner();
?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('campus') ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a> <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
        <div class="generic-content"><?php the_content(); ?></div>
        <div class="acf-map">
            <?php $mapLocation = get_field('map_location') ?>
            <div class='marker' data-lat='<?= $mapLocation['lat'] ?>' data-lng='<?= $mapLocation['lng'] ?>'>
                <h3><?php echo $mapLocation['address'] ?></h3>
            </div>
        </div>
        <?php
        $relatedPrograms = new WP_Query([
            'post_type' => 'program',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => 'related_campus',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"',
                ]
            ]
        ]);

        if ($relatedPrograms->have_posts()) {
            echo '<hr class="section-break">';
            echo "<h2 class='headline headline--medium'>Programs Available At This Campus</h2>";
            echo '<ul class="min-list link-list">';
            while ($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post(); ?>
                <li class=''>
                    <a class="" href="<?php the_permalink(); ?>"><?= the_title(); ?></a>
                </li>
        <?php
            }
            echo '</ul>';
        }

        wp_reset_postdata();

        $today = date('Ymd');
        $homePageEvents = new WP_Query([
            'post_type' => 'event',
            'posts_per_page' => 2,
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                ],
                [
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID($relatedPrograms) . '"',
                ]
            ]
        ]);
        if ($homePageEvents->have_posts()) {
            echo '<hr class="section-break">';
            $title = get_the_title();
            echo "<h2 class='headline headline--medium'>Upcoming {$title} Events</h2>";
            while ($homePageEvents->have_posts()) {
                $homePageEvents->the_post();
                get_template_part('template-parts/content', 'event');
            }
        }
        ?>
    </div>
<?php
}
get_footer();
