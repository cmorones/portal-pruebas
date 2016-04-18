<?php
/**
Template Name: Full
 */
get_header(); ?>
<style type="text/css">
article#wrap-textos {width: 100%; max-width: 940px;}
</style>
<div id="wrapper">



    
<main id="primary" class="content-area">
            
    <article id="wrap-textos">

        
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>

    <?php endwhile; else: ?>Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>
    
    </article>


        <?php # get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>