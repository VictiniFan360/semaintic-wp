<?php get_header(); ?>

<article class="single-post container mt-4">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <header class="single-header">
            <h1 class="single-title"><?php the_title(); ?></h1>

            <p class="single-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo get_the_date(); ?>
                </time>
            </p>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <figure class="single-thumbnail">
                <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
            </figure>
        <?php endif; ?>

        <section class="single-content">
            <?php the_content(); ?>
        </section>

        <nav class="single-navigation" aria-label="Navegación entre entradas">
            <div class="nav-previous">
                <?php previous_post_link('%link', '← Entrada anterior'); ?>
            </div>

            <div class="nav-next">
                <?php next_post_link('%link', 'Entrada siguiente →'); ?>
            </div>
        </nav>

    <?php endwhile; endif; ?>
</article>

<?php get_footer(); ?>