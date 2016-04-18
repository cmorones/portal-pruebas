<?php
/*
 * The main template file
 */
get_header(); ?>


<div id="wrapper">
    
<main id="primary" class="content-area">
            
    <article id="wrap-textos">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
     <h2 class="titulo-entrada"><?php the_title(); ?></h2>
    <?php the_content(); ?>
    <?php the_time('F jS, Y') ?>
    <?php the_author() ?>
    <?php endwhile; else: ?>Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>
    
    </article>


        <?php get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->

<?php get_footer(); ?>