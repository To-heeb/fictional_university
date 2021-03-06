<?php get_header();

pageBanner([
    'title' => 'Our Campuses',
    'subtitle' => 'We have several conveniently located campuses'
]);
?>

<div class="container container--narrow page-section">
    <div class="acf-map">
        <?php
        while (have_posts()) {
            the_post();
            $mapLocation = get_field('map_location');
        ?>
            <div class='marker' data-lat='<?= $mapLocation['lat'] ?>' data-lng='<?= $mapLocation['lng'] ?>'>
                <h3><a href="<?= the_permalink() ?>"><?php echo $mapLocation['address'] ?></a> </h3>
            </div>
        <?php }
        echo paginate_links();
        ?>
    </div>
</div>

<?php get_footer(); ?>