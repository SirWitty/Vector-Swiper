<?php

	/*
	Plugin Name: Vector Swiper
	Plugin URI: 
	Description: EDIT THIS
	Author: Samuel William Reinhardt
	Version: 1.0
	Author URI: http://vectorarrow.com/
	*/
/* Shortcode list
	[basic_swiper post_type='' category_name='']
	[fullscreen_swiper post_type='' category_name='']
*/
	/*Some Set-up*/
	define('SWR_VAS_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
	define('SWR_VAS_NAME', "Vector Swiper");
	define ("SWR_VAS_VERSION", "1.0");

	/*Files to Include*/
	require_once('swiper-slide.php');


	wp_enqueue_script('vectorswiper', SWR_VAS_PATH.'js/swiper.jquery.min.js', array('jquery'));
	wp_enqueue_style('vectorswiper_css', SWR_VAS_PATH.'css/swiper.min.css');
	

/* Basic Swiper (smaller images, used in posts) */

	function basic_script(){
		print "<script>
				var swiper = new Swiper('.basic-container');
				</script>";
	}

	function basic_get_swiper($a){
		wp_enqueue_style('basic_css', SWR_VAS_PATH.'css/basic.css');
		add_action('wp_footer', 'basic_script');

		$swiper= '
		<div class="basic-container swiper-container">
			<div class="swiper-wrapper basic-wrapper">
		  		';

		$args = array(
				'post_type'=> 'swiper-image',
				 'category_name='=> 'uncategorized',
			);
		
		query_posts($a);
		
		
		if (have_posts()) : while (have_posts()) : the_post(); 
			$img= get_the_post_thumbnail( $post->ID, 'large' );
			
			$swiper.='<div class="swiper-slide basic-slide"><img width="800" height="420" src="'
			.wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' )['0'].
			'" class="attachment-large wp-post-image" alt="Gallery Image"></div>';
			// $swiper.='<div class="swiper-slide basic-slide">'.$img.'</div>';
				
		endwhile; endif; wp_reset_query();


		$swiper.= '
		</ul>
		</div>
		</div>';
		
		return $swiper;
	}

	function basic_insert_swiper($atts, $content=null){
	    $a = shortcode_atts( array(
	    	'post_type' => 'swiper-image',
	        'category_name' => '',
	    ), $atts );

		$swiper= basic_get_swiper($a);

		return $swiper;

	}


	add_shortcode('basic_swiper', 'basic_insert_swiper');

	function basic_swiper(){

		print basic_get_swiper();

	}
	require_once('shortcodes/carousel.php');
	require_once('shortcodes/fullscreen.php');
?>