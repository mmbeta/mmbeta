<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-lg-6 col-lg-offset-3" >
	<header class="entry-header">
		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
	</header><!-- .entry-header -->

	<div>
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<small class="entry-meta col-xs-12 col-lg-8 col-lg-offset-2">
		<?php mmbeta_posted_on(); ?>
	</small><!-- .entry-meta -->

</article><!-- #post-## -->