<?php get_header(); ?>

<?php
while (have_posts()) {

    the_post();
    pageBanner();
?>


    <div class="container container--narrow page-section">
        <?php
        $parent_id = wp_get_post_parent_id(get_the_ID());
        if ($parent_id) {
        ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?= get_permalink($parent_id) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?= get_the_title($parent_id) ?></a> <span class="metabox__main"><?= the_title() ?></span>
                </p>
            </div>
        <?php  } ?>

        <?php
        $checkForChildPage = get_pages([
            'child_of' => get_the_ID(),
        ]);
        if ($parent_id or $checkForChildPage) : ?>
            <div class="page-links">
                <h2 class="page-links__title"><a href="<?= get_permalink($parent_id) ?>"><?php echo get_the_title($parent_id);  ?></a></h2>
                <ul class="min-list">
                    <!-- <li class="current_page_item"><a href="#">Our History</a></li>
                <li><a href="#">Our Goals</a></li> -->
                    <?php
                    if ($parent_id) {
                        $findChildrenPagesOf = $parent_id;
                    } else {
                        $findChildrenPagesOf = get_the_ID();
                    }
                    wp_list_pages([
                        'child_of' => $findChildrenPagesOf,
                        'title_li' => NULL,
                        'sort_column' => 'menu_order'
                    ])
                    ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>
    </div>
<?php } ?>

<?php get_footer(); ?>