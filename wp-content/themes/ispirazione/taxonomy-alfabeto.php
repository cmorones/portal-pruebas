<?php
get_header(); 
?>
<?php $abc = array(
	'smallest'                  => 14, 
	'largest'                   => 14,
	'unit'                      => 'pt', 
	'number'                    => 45,  
	'format'                    => 'flat',
	'separator'                 => "\n",
	'orderby'                   => 'name', 
	'order'                     => 'ASC',
	'exclude'                   => null, 
	'include'                   => null, 
	'topic_count_text_callback' => default_topic_count_text,
	'link'                      => 'view', 
	'taxonomy'                  => 'alfabeto', 
	'echo'                      => true,
	'child_of'                  => null, // see Note!
); ?>



<div id="wrapper">
    
<main id="primary" class="content-area">
        
    <article id="wrap-textos">
        <h2 class="titulo-entrada">Archivo fotográfico</h2>   
        <div class="abcde"><?php wp_tag_cloud( $abc ); ?></div>

<?php

    if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
    
    
    
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

    </article>


        <?php get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>