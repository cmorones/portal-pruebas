<?php
/**
Template Name: Boletines de prensa
 */
get_header(); 
global $post;
$excerpt = get_the_excerpt();
?>
<style type="text/css">
.essb_links.essb_template_grey-blocks-retina .essb_hide_name li a, .essb_links.essb_template_grey-blocks-retina .essb_force_hide li a {
    padding: 6px 8px 0px !important;
}
</style>

<div id="wrapper">



    
<main id="primary" class="content-area">
        
    <article id="wrap-textos">
        <h2 class="titulo-entrada"><?php the_title(); ?></h2>   
         
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'posts_per_page' => 6,
  'post_type' => 'boletin',
  'paged' => $paged,
  'order' => 'DESC',
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
     <?php  the_content(); ?>
     <!-- <a href="<?php the_permalink(); ?>">Ver más</a> -->
     <div class="boletin_listado">
<?php
if( have_rows('boletin_listado') ):
    while ( have_rows('boletin_listado') ) : the_row();
?> 
      <div class="b_lista"><?php the_sub_field('b_lista') ?></div>

<?php  endwhile; else :
	// Nada por aquí
endif;
?>
     </div>
     
     <div class="fotosHD">
         
<?php if( get_field('boletin_descarga') ): ?>
   <?php  if (get_field('boletin_titulo_descarga') ): ?>
      <p><a href="<?php the_field('boletin_descarga'); ?>" title="<?php the_field('boletin_titulo_descarga'); ?>" target="<?php if( get_field('pdf_ventana_nueva') ) {echo "_self";} else{ echo "_blank"; } ?>"><?php the_field('boletin_titulo_descarga'); ?></a></p>
    <?php else: ?>
      <p><a href="<?php the_field('boletin_descarga'); ?>" title="Descargar PDF" target="<?php if( get_field('pdf_ventana_nueva') ) {echo "_self";} else{ echo "_blank"; } ?>">Descargar PDF</a></p>
    <?php endif; ?> 	
<?php endif; ?>
       
        
<?php if( get_field('boletin_url') ): ?>
   <?php  if (get_field('boletin_titulo_hd') ): ?>
     	<a href="<?php the_field('boletin_url') ; ?>" target="_blank" title="<?php the_field('boletin_titulo_hd') ; ?>"><?php the_field('boletin_titulo_hd') ; ?></a>
    <?php else: ?>
    	<a href="<?php the_field('boletin_url') ; ?>" target="_blank">Fotografías en alta resolución disponibles en prensa > archivo fotográfico</a>
    <?php endif; ?>
<?php else: ?>	
	<a href="<?php echo get_permalink(126) ?>" target="_blank">Fotografías en alta resolución disponibles en prensa > archivo fotográfico</a>
<?php endif; ?>
        
        
     </div>
 </div>
        
<?php $permalink = get_permalink(); ?>
        <div class="wrapPost100">
            <div class='BoxCm'>Compartir:</div>
            <?php echo do_shortcode('[easy-social-share buttons="twitter,facebook" counters=0 template="grey-blocks-retina" text="Dirección General de Música" url="'.$permalink.'"]') ?>
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