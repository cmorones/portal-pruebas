<?php
get_header(); 
global $post;
$excerpt = get_the_excerpt();
?>

<div id="wrapper">
  
<main id="primary" class="content-area">
  
    <article id="wrap-textos">
        <h2 class="titulo-entrada">Blog Música UNAM</h2>
<?php
if ( have_posts() ) :  while ( have_posts() ) : the_post();
?>

        <div class="wrapPost100">
             <div class="imgMemorias">
                  <div class="fechablog"><?php the_date(); ?></div>
                 <?php if ( get_field('blogm_img_post' )): ?>
                 <img  src="<?php the_field('blogm_img_post' ); ?>" alt="<?php the_title(); ?>" /> 
                 <?php endif; ?>
             </div>
             <div class="wrapTblog">
                 <h1 class="titleMemorias"><?php the_title(); ?></h1>
                 <div class="txtblog">
                    <?php if (get_field('blogm_escrito_por' )) : ?>
                     <div class="ttA">Publicación escrita por:</div>
                     <div class="ttB"><?php  the_field('blogm_escrito_por' ); ?></div>
                   <?php endif; ?>
                 </div>
           </div>
            <?php the_content(); ?>
            <?php // comments_template(); ?>
            <div class="cleargrey"></div>
        </div> 
        
        
        <div class="wrapPost100">
            <div class='BoxCm'>Compartir:</div>
            <?php echo do_shortcode('[easy-social-share buttons="twitter,facebook" counters=0 template="grey-blocks-retina" text="mensaje"]') ?>

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