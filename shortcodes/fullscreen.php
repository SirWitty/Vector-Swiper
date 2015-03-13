<?php
/* Fullscreen Swiper */

	function fullscreen_script(){
		print "<script>
				var swiper = new Swiper('.fullscreen-container');
				</script>";
	}

	function fullscreen_get_swiper($a){
		wp_enqueue_style('fullscreen_css', SWR_VAS_PATH.'css/fullscreen.css');
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
			
			$swiper.='<div class="fullscreen-slide swiper-slide">
			<div class="fullscreen-image-wrap">
			'.$img.'
			</div>
			</div>';
				
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