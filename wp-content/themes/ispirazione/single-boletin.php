<?php
get_header(); 
global $post;
$excerpt = get_the_excerpt();
?>


<div id="wrapper">



    
<main id="primary" class="content-area">
        
    <article id="wrap-textos">
        <h2 class="titulo-entrada"><?php the_title(); ?></h2>   
         
<?php
    if ( have_posts() ) :  while ( have_posts() ) : the_post();
?>

       
        <div class="wrapPost100">
            <h1 class="titleMemorias"><?php the_title(); ?></h1>
            <div class="imgMemorias"><?php the_post_thumbnail('archmemorias'); ?></div>  
           
        </div> 

 <div class="wrapPost100">
     <?php  the_content(); ?>
     
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
     
     <div class="fotosHD"><a href="<?php echo get_permalink(126) ?>" target="_blank">Fotografías en alta resolución disponibles en prensa > archivo fotográfico</a></div>
 </div>
        <div class="wrapPost100">
            <div class='BoxCm'>Compartir:</div>
            <?php echo do_shortcode('[easy-social-share buttons="twitter,facebook" counters=0 template="grey-blocks-retina" text="Dirección General de Música"]') ?>
             <div class="cleargrey"></div>
        </div>
        
    <div class="clear"></div> 
    <?php endwhile;?>
  
        
    <?php else: ?>
        Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>
    </article>


        <?php get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>