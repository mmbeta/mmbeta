<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
    <?php

      $args = array(
          'post_type' => array('preistraeger', 'post', 'page'),
        );
      $query = new WP_Query( $args );
      

      if ($query->have_posts()): ?>

            <?php while ($query->have_posts()): $query->the_post();
              get_field('teaser-typ') ? $teaser_typ = get_field('teaser-typ') : $teaser_typ = 'Standard';
              
              get_template_part( 'teasers/teaser', $teaser_typ );
            endwhile;
            ?>

      <?php endif;?>
		
		</main><!-- #main -->

	</div><!-- #primary -->


<div class="col-xs-12">
	<?php get_footer(); ?>
</div>