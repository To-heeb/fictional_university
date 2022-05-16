<div class="post-item">
    <h2 class="headline headline--medium headline--post-title"><a href="<?= the_permalink() ?>"><?php the_title(); ?></a></h2>
    <div class="metabox">
        <p>Posted by <?= the_author_posts_link() ?> on <?= the_time('n-j-y') ?> in <?php echo get_the_category_list(', ') ?></p>
    </div>
    <div class="generic-content">
        <p><?= the_excerpt(); ?></p>
        <p><a href="<?= the_permalink() ?>" class="btn btn--blue">Continue reading &raquo;</a></p>
    </div>
</div>