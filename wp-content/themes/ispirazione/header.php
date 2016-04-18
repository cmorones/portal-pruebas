<!DOCTYPE html>
<html>
    <head>
        <title><?php  bloginfo('name'); ?></title>
        
<meta charset="UTF-8">
<meta name="author" content="DAR - LabCitrico">
<meta name="viewport" content="width=device-width, initial-scale=1" />

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery.magnific-popup.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/responsivo.css" media="all" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/menu.css" media="all" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->



    <?php wp_head(); ?> 

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/estilos.css" media="all" />
</head>


<body>

 <header>
     <div class="cabeza">
         <div id="logo"><a href="http://www.unam.mx/" title="Inicio" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/img/logotipo.png" /></a> </div><!-- logo -->
         <div class="logo-2">
             <div class="logotxt"><a href="<?php bloginfo('url'); ?>" class="dirGral"></a></div>
             <div class="logomsc"></div>
         </div>
     </div>

<div class="menu-toggle-button" data-menu-id="menunav"> Menu ≡</div>

<div id="nav">
<?php
$defaults = array(
	'theme_location'  => 'primary',
	'menu'            => '',
	'container'       => 'false',
	'container_class' => '',
	'container_id'    => 'nav',
	'menu_class'      => 'menu-list',
	'menu_id'         => 'menunav',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );
?>

 </div>
    
    
<div id="search">
 <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
 <input type="text" value="Buscar" onclick="this.value='';" name="s" id="s" class="searchtxt"/>
 <input name="" type="button" onclick="submit();" value="Buscar" class="btn" />
 </form>
 </div>
</header>
    
    <div class="eventosslider">
        <div id="fakeLoader"></div>
        <?php echo do_shortcode('[add_eventon_dv cal_id="0" fixed_day="1" ux_val="X" lang="L1"]'); ?>
    </div>