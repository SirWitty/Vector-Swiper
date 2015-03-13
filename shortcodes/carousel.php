<?php
/* Carousel Swiper */

	function carousel_script(){
		print "<script>
				var swiper = new Swiper('.carousel-container', {
					slidesPerView: '3',
			        spaceBetween: 30
				});
				</script>";
	}

	function carousel_get_swiper($a){
		wp_enqueue_style('carousel_css', SWR_VAS_PATH.'css/carousel.css');
		add_action('wp_footer', 'carousel_script');

		$swiper= '
		<div class="carousel-container swiper-container">
			<div class="carousel-wrapper swiper-wrapper">
		  		';

		$args = array(
				'post_type'=> 'swiper-image',
				 'category_name='=> 'uncategorized',
			);
		
		query_posts($a);
		
		
		if (have_posts()) : while (have_posts()) : the_post(); 
			$img= get_the_post_thumbnail( $post->ID, 'large' );
			
			$swiper.='<div class="carousel-slide swiper-slide">
			<div class="carousel-image-wrap">
			<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">
			<h3>
			'.get_the_title( $thumbnail->ID ).
			'</h3>'
			.$img.'
			</a>
			</div>
			</div>';
				
		endwhile; endif; wp_reset_query();


		$swiper.= '
		</ul>
		</div>
		</div>';
		
		return $swiper;
	}

	function carousel_insert_swiper($atts, $content=null){
	    $a = shortcode_atts( array(
	    	'post_type' => 'swiper-image',
	        'category_name' => '',
	    ), $atts );

		$swiper= carousel_get_swiper($a);

		return $swiper;

	}


	add_shortcode('carousel_swiper', 'carousel_insert_swiper');

	function carousel_swiper(){

		print carousel_get_swiper();

	}
	?>