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


      <?php

      // topics set?
      if( have_rows('themen') ){
        global $post;
        $post->background_color = get_field('artikel-header-farbe')['color'];
        $post->contrast_color = get_field('artikel-header-contrast')['contrast-color'];
        $post->shop_link = get_field('artikel-header-shop-link');
        get_template_part( 'hp/hp', 'aufmacher' );
      }

      ?>


			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>