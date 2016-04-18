<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/***************************
 ******* ACF include
 ***************************/
// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = get_stylesheet_directory() . '/acf/';
    
    // return
    return $path;
    
}
 

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_stylesheet_directory_uri() . '/acf/';
    
    // return
    return $dir;
    
}
 

// 3. Hide ACF field group menu item
if ( ! is_admin() ) {
    add_filter('acf/settings/show_admin', '__return_false');
}

// 4. Include ACF
include_once( get_stylesheet_directory() . '/acf/acf.php' );



/*******************************
 ******* ACF Opciones del theme
 *******************************/
if( function_exists('acf_add_options_page') ) {
	
acf_add_options_page(array(
		'page_title' 	=> 'Ajustes del theme UNAM Música',
		'menu_title'	=> 'UNAM',
		'menu_slug' 	=> 'theme-ajustes',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Redes Sociales',
		'menu_title'	=> 'Social',
		'parent_slug'	=> 'ajustes-redes-sociales',
	));
        
	
}









add_theme_support('post-thumbnails');
	
#Define tamaños personalizados de imagen
if ( function_exists( 'add_image_size' ) ) {  
    add_image_size('archfotografico', 301, 187, true);
    add_image_size('archmemorias', 621, 268, true);
}  
#Añade los tamaños personalizados en el editor del post
add_filter('image_size_names_choose', 'excite_image_sizes');  
function excite_image_sizes($sizes) {  
    $addsizes = array(  
        "Imagen - Memorias" => __( "archmemorias"),
    );  
    $newsizes = array_merge($sizes, $addsizes);  
    return $newsizes;  
}





/* Extracto personalizado */
function wpse52673_filter_excerpt_length( $length ) {
    // Return (integer) value for
    // word-length of excerpt
    return 95;
}
add_filter( 'excerpt_length', 'wpse52673_filter_excerpt_length' );


/* Template para Tax Blog Musica 
add_filter('single_template', 'single_template_terms');
function single_template_terms($template) {
    foreach( (array) wp_get_object_terms(get_the_ID(), get_taxonomies(array('public' => true, '_builtin' => false))) as $term ) {
        if ( file_exists(TEMPLATEPATH . "/single-{$term->slug}.php") )
            return TEMPLATEPATH . "/single-{$term->slug}.php";
    }
    return $template;
} */

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

/*
* Switch default core markup for search form, comment form, and comments
* to output valid HTML5.
*/
add_theme_support( 'html5', array(
'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');


register_nav_menu( 'primary', __( 'Principal', 'Inspiracion' ) );

/*
Registrar widgets
 */
function ispirazione_widgets_init() {
    
register_sidebar(array(
 'name' => 'Sidebar',
 'before_widget' => '<div class="widget">',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));

register_sidebar(array(
 'name' => 'Widget Footer 1',
 'before_widget' => '<div class="widget">',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));
register_sidebar(array(
 'name' => 'Widget Footer 2',
 'before_widget' => '<div class="widget">',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));
register_sidebar(array(
 'name' => 'Widget Footer 3',
 'before_widget' => '<div class="widget">',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));
register_sidebar(array(
 'name' => 'Widget Footer 4',
 'before_widget' => '<div class="widget">',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));
register_sidebar(array(
 'name' => 'Widget Footer 5',
 'before_widget' => '<div class="widget">',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));
register_sidebar(array(
 'name' => 'Widget Footer 6',
 'before_widget' => '<div class="widget">',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));


}
add_action( 'widgets_init', 'ispirazione_widgets_init' );


/**
 * Function and filter to force tag.php (tag archives) to display only custom post types. 
 */
function add_custom_types_to_tag_archives( $query ) {
    if( is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        $post_types = array( 'archivo-de-fotos' );
        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tag_archives' );

add_filter( ‘xmlrpc_methods’, function( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
} );


