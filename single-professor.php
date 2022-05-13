<?php
get_header();
while (have_posts()) {

    the_post();
    pageBanner();
?>


    <div class="container container--narrow page-section">
        <div class="generic-content">
            <div class="row group">
                <div class="one-third"><?php the_post_thumbnail('prefessorPotrait'); ?></div>
                <div class="two-third"><?php the_content();  ?></div>
            </div>
        </div>
        <?php

        $relatedPrograms = get_field('related_programs');
        if ($relatedPrograms) : ?>
            <hr class="section-break">
            <h2 class="headline headline--medium">Subject(s) Taught</h2>
            <ul class="link-list min-list">
                <?php
                //print_r($relatedPrograms);
                foreach ($relatedPrograms as $relatedProgram) {
                ?>
                    <li><a href="<?php echo get_permalink($relatedProgram) ?>"><?= get_the_title($relatedProgram); ?></a></li>
            <?php
                }
            endif;
            ?>
            </ul>
    </div>
<?php }

get_footer();
