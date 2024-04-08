<?php get_header(); ?>

<main class="main">
    <div class="main__inner">
        <?php if( have_posts() ): the_post(); ?>
            <div id="page-header">
            </div>
            <div id="page-content">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>