<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="container justify-content-center d-flex mt-5 mb-3">
  <article id="post-<?php the_ID(); ?>" class="col-12 col-lg-8" >
  	<header class="entry-header">
  		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
  	</header><!-- .entry-header -->

  	<div>
  		<?php the_content(); ?>
  	</div><!-- .entry-content -->
  	<div class="clearfix"></div>
    <small class="entry-meta">
  		<?php mmbeta_posted_on(); ?>
  	</small><!-- .entry-meta -->
  </article><!-- #post-## -->
</div>