<?php
/**
Template Name: Fotografias
 */
get_header(); 
global $post;

?>

<div id="wrapper">



    
<main id="primary" class="content-area">
        
    <article id="wrap-textos">
        <h2 class="titulo-entrada"><?php the_title(); ?></h2>   
         
    <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
   'orderby' => 'title',
    'order' => 'ASC',
  'posts_per_page' => 100,
  'post_type' => 'archivo-de-fotos',
  'paged' => $paged
  
  
);
// The Query
query_posts($args);
    
    if ( have_posts() ) : if(function_exists('wp_paginate')) {wp_paginate();}  while ( have_posts() ) : the_post();
    
    
    
   $imagen = get_field('archf_imagen');
   if( !empty($imagen) )  {
	$url = $imagen['url'];
	$title = $imagen['title'];
	$alt = $imagen['alt'];
	$caption = $imagen['caption'];

	// thumbnail
	$size = 'archfotografico';
	$thumb = $imagen['sizes'][ $size ];
	$width = $imagen['sizes'][ $size . '-width' ];
	$height = $imagen['sizes'][ $size . '-height' ];
    }
        ?>

       
        <div class="wrapPost100">
            <div class="width50">
               <?php if( !empty($imagen) ): ?>
                <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                <?php endif; ?>
            </div>
            
            <div class="width50">
                <span><?php the_field('archf_titulo_de_fotografia'); ?></span>
                <span><?php the_field('archf_contenido'); ?></span>
                <?php if( get_field('arch_descarga_de_imagen') ): ?>
                <span><a href="<?php the_field('arch_descarga_de_imagen'); ?>" target="_blank">Descargar imagen</a></span>
                <?php endif; ?>
                <span><?php the_content(); ?></span>
            </div>
        </div> <div class="clear"></div>
          

        


       
      
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