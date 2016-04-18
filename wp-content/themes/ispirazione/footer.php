<script>jQuery(document).ready(function($){  $.daisyNav();  });</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/javascript.js" ></script>


<div class="wrap_sociales_flotante">
  <?php if(get_field('theme_facebook_url', 'option')): ?>
    <a class="sociales_fb" href="<?php the_field('theme_facebook_url', 'option'); ?>" title="facebook"></a>
  <?php endif; ?><?php if(get_field('theme_twitter_url', 'option')): ?>
    <a class="sociales_tw" href="<?php the_field('theme_twitter_url', 'option'); ?>" title="twitter"></a>
  <?php endif; ?><?php if(get_field('theme_twitter_url', 'option')): ?>
    <a class="sociales_yb" href="<?php the_field('theme_youtube_url', 'option'); ?>" title="youtube"></a>
  <?php endif; ?><?php if(get_field('theme_email', 'option')): ?>
    <a class="sociales_ml" href="mailto:<?php the_field('theme_email', 'option'); ?>?Subject=Contacto UNAM Música" title="contacto"></a>
  <?php endif; ?>
</div><!-- .wrap_sociales_flotante -->

<div class="wrap-boletin">
    <div class="contBoletin">
        <div class="BoletinB1"><?php gravity_form(1, $display_title=false, $display_description=false, $display_inactive=false, $field_values=null, $ajax=false, $tabindex); ?></div>
        <div class="BoletinB2">A través de nuestra cartelera obtén los últimos detalles, información de eventos, comentarios y más de Música UNAM. <a href="/aviso-de-privacidad/" target="_blank" class="">Aviso legal</a></div>
    </div>
</div><!-- .rap-boletin -->


    <div class="wrap_toogle_mapa" style="display:none;">
        <div class="boxtoogle_mapa">
            <div class="txt_mapa">MAPA DE SITIO</div>
            <div class="too_mapa"></div>
        </div>
    </div>

<footer id="footer">
    <div class="siteinfo">
        <div class="blockWF01">
            <?php if(function_exists('dynamic_sidebar')){dynamic_sidebar('Widget Footer 1');} ?>
        </div>
        <div class="blockWF02">
            <?php if(function_exists('dynamic_sidebar')){dynamic_sidebar('Widget Footer 2');} ?>
        </div>
        <div class="blockWF03">
            <?php if(function_exists('dynamic_sidebar')){dynamic_sidebar('Widget Footer 3');} ?>
        </div>
        <div class="blockWF04">
            <?php if(function_exists('dynamic_sidebar')){dynamic_sidebar('Widget Footer 4');} ?>
        </div>
        <div class="blockWF05">
            <?php if(function_exists('dynamic_sidebar')){dynamic_sidebar('Widget Footer 5');} ?>
        </div>
        <div class="blockWF06">
            <?php if(function_exists('dynamic_sidebar')){dynamic_sidebar('Widget Footer 6');} ?>
        </div> 
    </div><!-- .site-info -->

    
<div class="wrap-bloques-logos">
<!-- <div class="blcklog01">  <?php #do_action('slideshow_deploy', '512'); ?> </div>-->
  
  <div class="blcklog02">
    <div class="titleLogos">SITIOS DE INTERÉS</div>
    <div class="sliderLogos02">
        <?php do_action('slideshow_deploy', '514'); ?>
    </div>
  </div>
</div>
    
    <div class="wraptxtpie">
        <div class="txtpie01">
Última actualización - abril 2016<br/>
Copyright 2015 MUSICA UNAM • Diseño y administración e:de . Desarrollo LabCitrico<br/><br/>
            
        Hecho en México, Universidad Nacional Autónoma de México (UNAM), todos los derechos reservados 2015. Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica. De otra forma, requiere permiso previo por escrito de la institución.<br/><br/>
        Powered by <a href="http://labcitrico.com/" title="LabCitrico">LabCitrico</a>. <a href="http://e-de.com.mx/" title="e:de">e:de</a>.     
        </div>
        <div class="txtpie02">
           <div class="sliderLogos01">
            <?php do_action('slideshow_deploy', '512'); ?>
           </div>
        </div>
    </div>
</footer><!-- #footer -->
<?php wp_footer(); ?>


</body>

</html>
