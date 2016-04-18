<?php
/**
Template Name: Memorias
 */
get_header(); 
global $post;
$excerpt = get_the_excerpt();
?>

<div id="wrapper">



    
<main id="primary" class="content-area">
        
    <article id="wrap-textos">
        <h2 class="titulo-entrada"><?php the_title(); ?></h2>   
         
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'posts_per_page' => 7,
  'post_type' => 'archivo-memorias',
  'paged' => $paged,
    'order' => 'ASC',
);
// The Query
query_posts($args);
    
    if ( have_posts() ) : if(function_exists('wp_paginate')) {wp_paginate();}  while ( have_posts() ) : the_post();

?>

       
        <div class="wrapPost100">
            <h1 class="titleMemorias"><?php the_title(); ?></h1>
            <div class="imgMemorias"><?php the_post_thumbnail('archmemorias'); ?></div>  
           
        </div> 

 <div class="wrapPost100">
     <?php  the_excerpt(); ?>
     <a href="<?php the_permalink() ?>">Ver más</a>
     <div class="cleargrey"></div>
 </div>
        
<?php $permalink = get_permalink(); ?>
        <div class="wrapPost100">
            <div class='BoxCm'>Compartir:</div>
            <?php echo do_shortcode('[easy-social-share buttons="twitter,facebook" counters=0 template="grey-blocks-retina" text="Memorias" url="'.$permalink.'"]') ?>
             <div class="cleargrey"></div>
        </div>
        
    <div class="clear"></div> 
    <?php endwhile;?>
  
        
    <?php else: ?>
        Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>
<?php
wp_reset_query();
?> 
    </article>


        <?php get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>