<?php
define('CPT_NAME', "Swiper Images");
define('CPT_SINGLE', "Swiper Image");
define('CPT_TYPE', "swiper-image");
define('CPT_THUMB_SIZE', 500);

add_theme_support('post-thumbnails', array('swiper-image'));  
  
function swr_vas_register() {  
    $args = array(  
        'label' => __(CPT_NAME),  
        'singular_label' => __(CPT_SINGLE),  
        'public' => true,  
        'show_ui' => true, 
        'taxonomies' => array('category'), 
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
  
    register_post_type(CPT_TYPE , $args );  
    set_post_thumbnail_size(CPT_THUMB_SIZE);
}  


add_action('init', 'swr_vas_register');

?>