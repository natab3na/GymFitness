<?php
//**consultas reutilizables */
require get_template_directory() . '/inc/queries.php';
require get_template_directory() . '/inc/shortcodes.php';

//cuando el tema es activado
function gymfitness_setup(){
    //habilitar imagenes destacadas
    add_theme_support( 'post-thumbnails' );

    //titulos seo
    add_theme_support('title-tag');

    //agregar imagenes de tamaño personalizado
    add_image_size('square', 350, 350, true);
    add_image_size('portrait', 350, 724, true);
    add_image_size('cajas', 400, 375, true);
    add_image_size('mediano', 700, 400, true);
    add_image_size('blog', 966, 644, true);

}
add_action('after_setup_theme','gymfitness_setup');


//menus de navegacion, agregar mas utilizando arreglo
function gymfitness_menu(){
    register_nav_menus( array ( //funcion de wp para crear menus
            'menu-principal' => __('Menu principal', 'gymfitness')//nombre servidor=> (__ para que cambie idioma) nombre usuario + text domain
    ));
}

add_action('init', 'gymfitness_menu');

//Scripts y Styles
function gymfitness_scripts_styles(){
    //carga hoja de estilos css
    wp_enqueue_style('style', get_stylesheet_uri(),array('normalize','googleFont'), '1.0.0');//nombre archivo css-funcion para leer la ruta-arreglo o dependencias-version-
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css ', array(), '8.0.1');
    wp_enqueue_style('slicknavCSS', get_template_directory_uri() . '/css/slicknav.min.css', array(),'1.0.0' );
    if(is_page('galeria')):
        wp_enqueue_style('lightboxCSS', get_template_directory_uri() . '/css/lightbox.min.css', array(),'2.11.0' );
    endif; 
    
    if(is_page('contacto')):
        wp_enqueue_style('leaftletCSS', 'https://unpkg.com/leaflet@1.9.2/dist/leaflet.css', array(),'1.9.2' );
    endif; 

    if(is_page('inicio')):
        wp_enqueue_style('bxSliderCSS', get_template_directory_uri() . '/css/jquery.bxslider.css', array(), '4.2.12');
    endif;

    //carga fuentes google fonts
    wp_enqueue_style('googleFont', 'https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway:wght@400;700;900&family=Staatliches&display=swap', array(), '1.0.0');

    //hoja de estilos de js
    wp_enqueue_script('slicknavJS', get_template_directory_uri() .'/js/jquery.slicknav.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('scripts', get_template_directory_uri() .'/js/scripts.js', array('jquery', 'slicknavJS' ), '1.0.0', true);
    if(is_page('galeria')):
        wp_enqueue_script('lightboxCSS', get_template_directory_uri() .'/js/lightbox.min.js', array('jquery'), '2.11.0', true);
    endif;

    if(is_page('contacto')):
        wp_enqueue_script('leafletCSS', 'https://unpkg.com/leaflet@1.9.2/dist/leaflet.js', array(), '1.9.2', true);
    endif;

    if(is_page('inicio')):
        wp_enqueue_script('bxSliderJS', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), '4.2.12', true);
    endif;
}   


add_action('wp_enqueue_scripts', 'gymfitness_scripts_styles');//hooks para llamar la funcion 

//Widgets

function gymfitness_widgets(){
    register_sidebar( array(
        'name' => 'Sidebar 1',
        'id' => 'sidebar_1',
        'before_widget'=> '<div class="widget">',
        'after_widget'=> '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => 'Sidebar 2',
        'id' => 'sidebar_2',
        'before_widget'=> '<div class="widget">',
        'after_widget'=> '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>',
    ) );
}
add_action('widgets_init','gymfitness_widgets');

/**Imagen Hero */

function gymfitness_hero_image(){
    //obtener id pagina principal
    $front_page_id = get_option('page_on_front');
    //obtener el id de la imagen
    $id_imagen = get_field('imagen_hero', $front_page_id);
    //obtener la imagen
    $imagen = wp_get_attachment_image_src($id_imagen , 'full')[0];

    //style css
    wp_register_style('custom', false);
    wp_enqueue_style('custom');

    $imagen_destacada_css = "
        body.home .site-header {
            background-image: linear-gradient( rgba(0,0,0,0.75), rgba(0,0,0,0.75)  ), url($imagen) ;
        }
    ";
    wp_add_inline_style('custom',  $imagen_destacada_css);


}
add_action('init','gymfitness_hero_image' );