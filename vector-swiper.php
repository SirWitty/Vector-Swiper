<?php

	/*
	Plugin Name: Vector Swiper
	Plugin URI: 
	Description: EDIT THIS
	Author: Samuel William Reinhardt
	Version: 1.0
	Author URI: http://vectorarrow.com/
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
		wp_enqueue_style('vector_css', SWR_VAS_PATH.'css/basic.css');
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
			
			$swiper.='<div class="swiper-slide basic-slide">'.$img.'</div>';
				
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
/* Fullscreen Swiper */

	function fullscreen_script(){
		print "<script>
				var swiper = new Swiper('.fullscreen-container');
				</script>";
	}

	function fullscreen_get_swiper($a){
		wp_enqueue_style('vector_css', SWR_VAS_PATH.'css/fullscreen.css');
		add_action('wp_footer', 'fullscreen_script');

		$swiper= '
		<div class="fullscreen-container swiper-container">
			<div class="fullscreen-wrapper swiper-wrapper">
		  		';

		$args = array(
				'post_type'=> 'swiper-image',
				 'category_name='=> 'uncategorized',
			);
		
		query_posts($a);
		
		
		if (have_posts()) : while (have_posts()) : the_post(); 
			$img= get_the_post_thumbnail( $post->ID, 'full' );
			
			$swiper.='<div class="fullscreen-slide swiper-slide">'.$img.'</div>';
				
		endwhile; endif; wp_reset_query();


		$swiper.= '
		</ul>
		</div>
		</div>';
		
		return $swiper;
	}

	function fullscreen_insert_swiper($atts, $content=null){
	    $a = shortcode_atts( array(
	    	'post_type' => 'swiper-image',
	        'category_name' => '',
	    ), $atts );

		$swiper= fullscreen_get_swiper($a);

		return $swiper;

	}


	add_shortcode('fullscreen_swiper', 'fullscreen_insert_swiper');

	function fullscreen_swiper(){

		print fullscreen_get_swiper();

	}

?>