<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div id="wrapper">
    
<main id="primary" class="content-area">
            
    <article id="wrap-textos">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
     <h2 class="titulo-entrada"><?php the_title(); ?></h2>
    <?php the_content(); ?>

    <?php endwhile; else: ?>Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>
    
    </article>


        <?php get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>