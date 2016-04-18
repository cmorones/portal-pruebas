<?php
get_header();
global $post;

?>
<div id="wrapper">
    
<main id="primary" class="content-area">
            
    <article id="wrap-textos">
        <h2 class="titulo-entrada"><?php the_title(); ?></h2>   

        
        
    <?php

    if ( have_posts() ) : 
        //if(function_exists('wp_paginate')) {wp_paginate();} 
        while ( have_posts() ) : the_post();
 
   $imagen = get_field('archf_imagen');

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
            </div>
        </div> <div class="clear"></div>
          
     
        
    <?php the_content(); ?>

      
    <?php endwhile;?>
  

        
    <?php else: ?>
        Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>


    </article>


        <?php get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>