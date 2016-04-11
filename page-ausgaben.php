<?php
/**
 * The template for displaying the Ausgaben-Page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php $query = new WP_Query( array( 'category_name' => 'heftvorschau' ) ); ?>
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>

        <?php the_title(); ?>
        <?php the_excerpt(); ?>


      <?php endwhile; // End of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>