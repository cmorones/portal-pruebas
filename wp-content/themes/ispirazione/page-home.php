<?php
/**
Template Name: Inicio-Home
 */

get_header(); ?>
<style type="text/css">
article#wrap-textos {width: 100%; max-width: 960px; }
article#wrap-textos, aside {
    margin: 20px 10px 0px 0px;
}
</style>

<?php include_once 'parte-streaming.php'; ?>

<div id="wrapper">
    
<main id="primary" class="content-area">
            
    <article id="wrap-textos">
        <div class="sliderInicio"><?php # echo get_new_royalslider(2); ?></div>
        <div class="sliderInicio"><?php echo do_shortcode('[sliderpro id="1"]'); ?></div>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>

    <?php endwhile; else: ?>Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>
    
    </article>


        <?php # get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>