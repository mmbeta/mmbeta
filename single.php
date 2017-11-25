<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
      <div class="row m-b">
      <?php $slider_name = get_field('slider'); ?>

      <?php

      // topics set?
      if( have_rows('ausgabenthemen') ){
        get_template_part( 'template-parts/ausgabe', 'themen' );
      }

      ?>





      <?php

        if($slider_name !== '' && function_exists('putRevSlider') ){
          $theSlider = new RevSlider();
          $arrSliders = $theSlider->getArrSliders();
          foreach ($arrSliders as $slider) {
            if($slider->getAlias() === $slider_name){
              putRevSlider( $slider_name );
            }
          }
        } 
      ?>
      </div>
			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>